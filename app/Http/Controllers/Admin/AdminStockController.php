<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class AdminStockController extends Controller
{
  public function deletePhotos(Product $product, Request $request)
  {
    if (empty($request->checkedNames)) {
      return response()->json(['error' => 'Silinəcək şəkil seçməmisiniz!!'], 422);
    } else {
      try {
        foreach ($request->checkedNames as $stok):
          $stock = Stock::find($stok);
          Storage::delete('public/' . $stock->photo);
          $stock->delete();
        endforeach;

        return response()->json(['mes' => 'Şəkil uğurlu şəkildə silindi...'], 200);
      } catch (\Exception $e) {
        return response()->json(['error' => 'Şəkil silinərkən xəta baş verdi!!'], 422);
      }

    }
  }

  public function updateColorStock(Product $product, Request $request)
  {
    $validator = Validator::make($request->all(), [
      'color_id' => 'required',
      'photo' => 'sometimes|file|image|mimes:jpg,png,jpeg,gif,webp,svg',
      'quantity' => 'required',
    ]);

    $this->ifValidatorFails($validator);

    $stock = Stock::find($request->id);
    $oldPhoto = $stock->photo;
    $stock->update($validator->validated());

    if ($request->has('photo')) {
      Storage::delete('public/' . $oldPhoto);
      $stock->update([
        'photo' => $request->photo->store('uploads/products/colors', 'public')
      ]);

      $image = Image::make(public_path('storage/' . $stock->photo))->fit(720, 660);
      $image->save();
    }

    return $this->productUpdatedSuccessfully();
  }

  public function deleteSingleColorStock(Request $request) {
    $validator = Validator::make($request->all(), [
      'stock' => 'required|integer'
    ]);

    $this->ifValidatorFails($validator);

    $stock = Stock::where('id',$request->stock)->first();

    if($stock):
      Storage::delete('public/' . $stock->photo);
      try {
        $stock->delete();

        return response()->json(['mes' => 'Məhsul rəngi uğurla silindi'],200);
      } catch (\PDOException $e) {
        return response()->json(['error' => 'Məhsul rəngi silinərkən xəta baş verdi'],422);
      }
      else:
          return response()->json(['error'=> 'Belə bir rəng məhsula aid deil'],422);
        endif;
  }

  public function addColor(Product $product, Request $request) {
    $validators = Validator::make($request->all(), [
      'color_id' => 'required|integer',
      'quantity' => 'required|integer',
      'photo' => 'required|file|image|mimes:jpg,jpeg,png,svg,gif,webp'
    ]);

    $this->ifValidatorFails($validators);

    try {
      $stock = $product->stocks()->create($validators->validated());

      if ($request->has('photo')) {
        $stock->update([
          'photo' => $request->photo->store('uploads/products/colors', 'public')
        ]);

        $image = Image::make(public_path('storage/' . $stock->photo))->fit(720, 660);
        $image->save();

      }
      return response()->json(['mes' => 'Məhsulun rəngi uğurlu şəkildə əlavə edildi...'], 200);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Məhsulun rəngi , şəkli və stokda mövcudluluğu doldurulmalıdır...'], 422);
    }
  }

  private function productUpdatedSuccessfully() {
    return response()->json(['mes' => 'Məhsul rəngi uğurla yeniləndi...'],200);
  }

  private function ifValidatorFails($validator) {
    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 422);
    }

    return true;
  }

}
