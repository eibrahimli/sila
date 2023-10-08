<?php

namespace App\Http\Controllers\Admin;

use App\Mail\ProductActivated;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class AdminProductController extends Controller
{
  public function activeIndex()
  {
    $products = Product::all()->where('status', 1)->sortByDesc('id');
    $active = 'aktiv';
    return view('backend.product.index', compact('products', 'active'));
  }

  public function NotActiveIndex()
  {
    $products = Product::all()->where('status', 0)->sortByDesc('id');

    return view('backend.product.index', compact('products'));
  }

  public function activeProduct(Product $product)
  {
    $product->update(['status' => '1']);

    Mail::to($product->store->user->email)->send(new ProductActivated($product));

    if (Mail::failures()):
      return back()->with('danger', 'Satıcıya mail göndərilərkən xəta baş verdi');
    endif;

    return back()->with('success', 'Satıcı məhsulu aktivləşdirildi...');
  }

  public function show($id)
  {
    //
  }

  public function edit(Product $product)
  {
    return view('backend.product.edit', compact('product'));
  }

  public function update(Request $request, Product $product)
  {
    $validator = Validator::make($request->all(), [
      'category_id' => 'required',
      'brand_id' => 'required',
      'title' => 'required|min:5',
      'desc' => 'required|min:5',
      'price' => 'required',
      'keyw' => 'required|min:5',
      'lang' => 'required|string|min:2',
      'stock' => 'required',
      'photo' => 'sometimes|file|image|mimes:png,jpeg,jgg,gif,webp,svg'
    ]);

    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 422);
    }

    $oldPhoto = $product->photo;

    try {
      $product->update($validator->validated());

      if ($request->has('photo')) {
        
        if(Storage::exists('public/' . $oldPhoto)) {
          Storage::delete('public/' . $oldPhoto);
        }

        $product->update([
          'photo' => $request->photo->store('uploads/product', 'public')
        ]);

        $image = Image::make(public_path('storage/' . $product->photo))->fit(720, 660);
        $image->save();
      }

      return response()->json(['mes' => 'Məhsul uğurlu şəkildə redaktə edildi...', 'product' => $product]);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Məhsul yenilənirkən xəta baş verdi...'], 422);
    }
  }

  public function destroy(Product $product)
  {
    if ($product->delete()):
      return response()->json(['mes' => 'Məhsul uğurlu şəkildə silindi...'], 200);
    endif;

    return response()->json(['error' => 'Məhsul silinərkən xəta baş verdi...'], 422);
  }

  // Ajax Request Methods

  public function getSingleProduct(Product $product)
  {
    $specs = unserialize($product->spec);

    //Brands
    $brands = Brand::all()->sortByDesc('id');
    foreach ($brands as $brand):
      $data[] = [
        'id' => $brand->id,
        'label' => $brand->name,
      ];
    endforeach;
    $brands = $data;

    // Colors

    $data = [];

    $colors = Color::all()->sortByDesc('id');
    foreach ($colors as $color):
      $data[] = [
        'id' => $color->id,
        'label' => $color->name,
      ];
    endforeach;

    $colors = $data;
    $productColors = $product->stocks()->where('color_id', '!=', 0)->get();
    $photos = $product->stocks()->where('color_id', 0)->get();

    return response()->json(['productColors' => $productColors,'product' => $product, 'colors' => $colors, 'brands' => $brands, 'specs' => $specs,'photos' => $photos], 200);
  }

  public function getCat()
  {

    $categories = Category::all()->where('category_id', 0);

    foreach ($categories as $index => $category):
      $data[$index] = [
        'id' => $category->id,
        'label' => $category->name,
      ];
      if (count($category->categories) > 0):
        $data[$index]['children'] = $this->getSubCat($category->id);
      endif;
    endforeach;


    return response()->json($data, 200);
  }

  public function getSubCat($cat)
  {
    $categories = Category::where('id', $cat)->first()->categories;

    foreach ($categories as $index => $category):
      $data[$index] = [
        'id' => $category->id,
        'label' => $category->name,
      ];
      if (count($category->categories) > 0):
        $data[$index]['children'] = $this->getSubCat($category->id);
      endif;
    endforeach;

    return $data;
  }

  public function updateSpecs(Product $product, Request $request) {
    $this->spec = json_decode($request->specs, true);

    foreach ($this->spec as $spec) {
      $validator = Validator::make($spec, [
        'name' => 'required|min:3',
        'value' => 'required|min:1'
      ]);

      if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
      }
    }

    try {
      $product->update(['spec' => serialize($this->spec)]);
      return response()->json(['mes' => 'Məhsul uğurla yeniləndi...'], 200);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Məhsul yenilənirkən xəta baş verdi...'], 422);
    }
  }

  public function updatePhotos(Product $product, Request $request) {
    $validator = Validator::make($request->all(), [
      'file' => 'sometimes|file|image|mimes:jpg,jpeg,png,gif,svg,webp'
    ]);

    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 422);
    }

    try {
      if ($request->has('file')) {
        $path = $request->file->store('uploads/product/photos', 'public');
        $product->stocks()->create([
          'color_id' => 0,
          'photo' => $path,
          'quantity' => 0
        ]);
        $image = Image::make(public_path('storage/' . $path))->fit(720, 660);
        $image->save(public_path('storage/' . $path), 100);
      }
    } catch (\Exception $e) {
      return response()->json(['error' => 'Məhsulun şəkilləri yenilənərkən xəta baş verdi'], 422);
    }
  }


}
