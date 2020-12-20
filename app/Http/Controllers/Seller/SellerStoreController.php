<?php

namespace App\Http\Controllers\Seller;

use App\Models\Store;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SellerStoreController extends Controller
{

    public function index()
    {
        return view('seller.store.index');
    }

    public function create()
    {
        if (auth()->user()->stores()->count() > 0) {
            return redirect()->back()->with('status', 'Yalnızca bir mağazanız ola bilər. Gələcəkdə daha çox mağaza əlavə etmək şansınız olacaq');
        }
        return view('seller.store.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|string|unique:stores',
            'address' => 'required|min:5',
            'number' => 'required',
            'desc' => 'required|min:5',
            'keyw' => 'required|min:3'
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()],422);
        }

        try{
            auth()->user()->stores()->create($request->all());

            return response()->json(['mes' => 'Mağaza uğurlu şəkildə əlavə edildi'],200);
        }catch(Exception $e) {
            return response()->json(['mes' => 'Mağaza əlavə edərkən xəta baş verdi'],422);
        }

    }

    public function edit(Store $store) {

        return view('seller.store.edit',compact('store'));
    }

    public function getStore(Store $store) {
      return response()->json(['store' => $store]);
    }

    public function update(Store $store, Request $request) {
      $validator = Validator::make($request->all(), [
        'name' => 'sometimes|min:2|string',
        'address' => 'sometimes|min:5',
        'number' => 'sometimes',
        'desc' => 'sometimes|min:5',
        'keyw' => 'sometimes|min:3'
      ]);

      if($validator->fails()) {
        return response()->json(['error' => $validator->errors()],422);
      }

      try{
        $store->update($request->all());

        return response()->json(['mes' => 'Mağaza uğurlu şəkildə yeniləndi'],200);
      }catch(Exception $e) {
        return response()->json(['mes' => 'Mağaza yenilənərkən xəta baş verdi'],422);
      }
    }

    public function destroy(Store $store) {
      if(auth()->user()->stores()->first()->id == $store->id):
        try{
          $store->delete();

          return response()->json(['mes' => 'Mağaza uğurla silindi...'],200);
        } catch(\Exception $e) {
          return response()->json(['error' => 'Mağaza silinərkən xəta baş verdi...'],422);
        }
      else:
        return response()->json(['error' => 'Silməyə çalışdığınız mağaza sizə aid deil...'],422);
      endif;
    }

}
