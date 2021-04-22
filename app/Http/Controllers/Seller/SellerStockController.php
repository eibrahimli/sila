<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class SellerStockController extends Controller
{
  public function getColorsRelatedToProduct(Product $product)
  {
    if ($this->checkProductRelatedToCurrentUser($product->store->user->id)):
      $stocks = $product->stocks()->where('color_id', '!=', 0)->get();
      return response()->json(['colors' => $stocks], 200);
    endif;

    return $this->productIsNotYours();
  }

  public function deleteColorStock(Product $product, Request $request)
  {
    if ($this->checkProductRelatedToCurrentUser($product->store->user->id)):

      if ($product->stocks()->where('id', $request->id)->count() > 0):
        $validator = Validator::make($request->all(), [
          'color_id' => 'required',
          'photo' => 'sometimes|file|image|mimes:jpg,png,jpeg,gif,webp,svg',
          'quantity' => 'required',
        ]);

        if($validator->fails()) {
          return response()->json(['error' => $validator->errors()],422);
        }

        $stock = Stock::find($request->id);
        $oldPhoto = $stock->photo;
        $stock->update($validator->validated());

        if($request->has('photo')) {
          Storage::delete('public/'.$oldPhoto);
          $stock->update([
            'photo' => $request->photo->store('uploads/product/colors','public')
          ]);

          $image = Image::make(public_path('storage/'.$stock->photo))->fit(720,660);
          $image->save();
        }

        return $this->productUpdatedSuccessfully();
      endif;

      return $this->stockIsNotYours();
    endif;

    return $this->productIsNotYours();

  }

  public function deleteSingleColorStock(Product $product, Request $request) {
      if($this->checkProductRelatedToCurrentUser($product->store->user->id)):
          $validator = Validator::make($request->all(), [
              'stock' => ['required', 'integer']
          ]);

          if($validator->fails()) {
              return response()->json(['error' => $validator->errors()],422);
          }

          try{
            $stock = Stock::find($request->stock);

            if($stock) {
                Storage::delete('public/'.$stock->photo);
                $stock->delete();
                return response()->json(['mes' => 'Məhsul stoku uğurlu şəkildə silindi...'],200);
            } else {
                return response()->json(['error' => 'Silmək istədiyiniz məhsul stoku bazada mövcud deil...'],422);
            }

          } catch (\Exception $e) {
              return response()->json(['error' => 'Məhsul stoku silinərkən xəta baş verdi...'],422);
          }
      endif;

      return $this->productIsNotYours();
  }

  private function checkProductRelatedToCurrentUser($id)
  {
    return auth()->id() == $id;
  }

  private function productIsNotYours()
  {
    return response()->json(['error' => 'Məhsul sizə aid deil'], 422);
  }
  public function stockIsNotYours() {
    return response()->json(['error' => 'Məhsulun belə bir rəngi yoxdur...'], 422);
  }
  public function productUpdatedSuccessfully() {
    return response()->json(['mes' => 'Məhsul rəngi uğurla yeniləndi...'],200);
  }
}
