<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminCategoryController extends Controller
{

  public function __construct(){
    $this->middleware('admin');
  }

  public function index() {
    $categories = Category::all()->where('category_id',0)->sortByDesc('id');

    return view('backend.category.index')->with('categories',$categories);
  }

  public function create() {    
    return view('backend.category.create');
  }

  public function store(Request $request) {
    $validator = Validator::make($request->all(), [
      'name' => 'required|min:2',
      'keyw' => 'required|min:2',
      'desc' => 'required|min:5',
      'lang' => 'required|string',
      'category_id' => 'sometimes|integer',
      'banner_photo' => 'sometimes|file|image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    if($validator->fails()) {
      return response()->json(['error' => $validator->errors],422);
    }

    try {      
      $category = Category::create($request->all());     

      $category->update([
        'banner_photo' => $request->banner_photo->store('uploads/categories', 'public')
      ]);

      $image = Image::make(public_path('storage/' . $category->banner_photo))->fit(1400, 206);
      $image->save();
      
      return response()->json(['mes' => 'Kateqoriya uğurla əlavə edildi...']);
    }catch(Exception $e) {
      return response()->json(['error' => 'Kateqoriya əlavə edilərkən xəta baş verdi'.$e->getMessage()],422);
    } 
  }

  public function edit(Category $category) {
    return view('backend.category.edit')->with('category', $category);
  }

  public function getCategory(Category $category) {
    return response()->json(['category' => $category],200);
  }

  public function subcategories(Category $category) {
    return view('backend.category.subindex',compact('category'));
  }

  public function update(Request $request , Category $category) {
    $validator = Validator::make($request->all(), [
      'name' => 'required|min:2',
      'keyw' => 'required|min:2',
      'desc' => 'required|min:5',
      'lang' => 'required|string',
      'category_id' => 'sometimes|integer',
      'banner_photo' => 'sometimes|file|image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    if($validator->fails()) {
      return response()->json(['error' => $validator->errors],422);
    }

    try {      
      $category->update($validator->validated());    
      
      if($request->has('banner_photo')):
        if($category->banner_photo != null) {
          Storage::delete('public/' . $category->banner_photo);
        }
        
        $category->update([
          'banner_photo' => $request->banner_photo->store('uploads/categories', 'public')
        ]);
  
        $image = Image::make(public_path('storage/' . $category->banner_photo))->fit(1400, 206);
        $image->save();
      endif;  
      
      return response()->json(['mes' => 'Kateqoriya uğurla yeniləndi...','category' => $category]);
    }catch(Exception $e) {
      return response()->json(['error' => 'Kateqoriya yenilənərkən xəta baş verdi'.$e->getMessage()],422);
    } 
  }

  public function destroy(Category $category) {
    try{

      if($category->photo) {
        Storage::delete('public/'.$category->photo);
      }

      $category->delete();

      return response()->json(['mes' => 'Kateqoriya uğurla silindi..'],200);

    }catch(Exception $e) {
      return response()->json(['error' => 'Kateqoriya silinərkən xəta baş verdi..'],422);
    }
  }

  public function getCategories() {
    return response()->json(['categories' => Category::latest()->where('category_id', 0)->get()]);
  }
    
}
