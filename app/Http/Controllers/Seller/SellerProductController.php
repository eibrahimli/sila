<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class SellerProductController extends Controller
{

  protected $spec = [];

  public function index()
  {
    $products = auth()->user()->stores->products()->where('status', '1')->orderByDesc('id')->get();
    $active = 'aktiv';
    return view('seller.product.index', compact('products', 'active'));
  }

  public function notActiveIndex()
  {
    $products = auth()->user()->stores->products()->where('status', '0')->orderByDesc('id')->get();

    return view('seller.product.index', compact('products'));
  }


  public function create()
  {
    return view('seller.product.create');
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


  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'category_id' => 'required',
      'brand_id' => 'required',
      'title' => 'required|min:5',
      'desc' => 'required|min:5',
      'price' => 'required',
      'keyw' => 'required|min:5',
      'lang' => 'required|string|min:2'
    ]);

    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 422);
    }

    try {
      $product = auth()->user()->stores->products()->create($validator->validated());

      return response()->json(['mes' => 'Məhsul uğurlu şəkildə əlavə edildi...', 'id' => $product->id]);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Məhsul əlavə edilirkən xəta baş verdi...' . $e->getMessage()], 422);
    }
  }


  public function show($id)
  {
    //
  }


  public function edit(Product $product)
  {
    return view('seller.product.edit')->with('product', $product);
  }

  public function getSingleProduct(Product $product)
  {
    return response()->json(['product' => $product], 200);
  }

  public function getSpecs(Product $product)
  {
    return response()->json(unserialize($product->spec));
  }

  public function getPhotos(Product $product)
  {
    return response()->json($product->stocks()->where('color_id', 0)->get());
  }

  public function updateProductStock(Product $product, Request $request)
  {
    $validators = Validator::make($request->all(), [
      'color_id' => 'required|integer',
      'quantity' => 'required|integer',
      'photo' => 'required|file|image|mimes:jpg,jpeg,png,svg,gif,webp'
    ]);

    if ($validators->fails()) {
      return response()->json(['error' => $validators->errors()], 422);
    }

    try {
      $stock = $product->stocks()->create($validators->validated());

      if ($request->has('photo')) {
        $stock->update([
          'photo' => $request->photo->store('uploads/product/colors', 'public')
        ]);

        $image = Image::make(public_path('storage/' . $stock->photo))->fit(720, 660);
        $image->save();

      }
      return response()->json(['mes' => 'Stok uğurla yeniləndi...'], 200);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Stok yenilənmədi...' . $e->getMessage()], 422);
    }
  }

  public function updatePhotos(Request $request, Product $product)
  {
    if (auth()->id() != $product->store->user->id) {
      return response()->json(['error' => 'Bu məhsulu dəyişməyə icazəniz yoxdur...'], 422);
    }
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

  public function updateProductSpecs(Product $product, Request $request)
  {
    if ($this->checkProductRelatedToCurrentUser($product->store->user->id)):
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
    endif;

    return $this->productIsNotYours();
  }

  public function update(Request $request, Product $product)
  {
    if (auth()->id() != $product->store->user->id) {
      return response()->json(['error' => 'Bu məhsulu dəyişməyə icazəniz yoxdur...'], 422);
    }
    $messages = [
      'stock.required' => 'Stok boş ola bilməz.',
      'stock.numeric' => 'Stok yalnızca rəqəm olmalıdır',
      'photo.required' => 'Məhsulunun əsas şəkli seçilməlidir',
      'photo.file' => 'Məhsulunun əsas şəkli fayl olmalıdır.',
      'photo.image' => 'Məhsulunun əsas şəkli tipi şəkil olmalıdır.',
    ];
    $validate = Validator::make($request->all(), [
      'stock' => 'required|numeric',
      'photo' => 'required|file|image|mimes:jpg,jpeg,png,gif,svg,webp'
    ], $messages);

    if ($validate->fails()) {
      return response()->json(['error' => $validate->errors()], 422);
    }

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
      if ($request->has('photo')) {
        $product->update([
          'photo' => $request->photo->store('uploads/product', 'public'),
          'stock' => $request->stock,
        ]);
        $image = Image::make(public_path('storage/' . $product->photo))->fit(212, 220);
        $image->save(public_path('storage/' . $product->photo), 100);
      }

      $product->update(['spec' => serialize($this->spec)]);
      return response()->json(['mes' => 'Məhsul uğurla yeniləndi...'], 200);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Məhsul yenilənirkən xəta baş verdi...'], 422);
    }

  }

  public function updateProduct(Product $product, Request $request)
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
      if ($product->store->user->id == auth()->id()) {
        $product->update($validator->validated());

        if ($request->has('photo')) {
          Storage::delete('public/' . $oldPhoto);
          $product->update([
            'photo' => $request->photo->store('uploads/product', 'public')
          ]);

          $image = Image::make(public_path('storage/' . $product->photo))->fit(720, 660);
          $image->save();
        }
      } else {
        return response()->json(['error' => 'Bu məhsulu dəyişməyə icazəniz yoxdur...'], 422);
      }
      return response()->json(['mes' => 'Məhsul uğurlu şəkildə redaktə edildi...', 'product' => $product]);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Məhsul yenilənirkən xəta baş verdi...'], 422);
    }
  }

  public function destroy(Product $product)
  {
    if ($this->checkProductRelatedToCurrentUser($product->store->user->id)):
      try {
        $product->delete();
        return response()->json(['mes' => 'Məhsul uğurlu şəkildə silindi...'], 200);
      } catch (\Exception $e) {
        return response()->json(['error' => 'Məhsul silinərkən xəta baş verdi...'], 422);
      }
    endif;

    return $this->productIsNotYours();
  }

  public function deletePhotos(Product $product, Request $request)
  {
    if (auth()->id() == $product->store->user_id):
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
    else:
      return response()->json(['mes' => 'Silmək istədiyiniz məhsulunu şəkli sizə aid deil!!'], 422);
    endif;
  }

  private function checkProductRelatedToCurrentUser($id)
  {
    return auth()->id() == $id;
  }

  private function productIsNotYours()
  {
    return response()->json(['error' => 'Məhsul sizə aid deil'], 422);
  }
}
