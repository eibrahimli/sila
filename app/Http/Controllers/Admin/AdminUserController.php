<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('backend.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

       return view('backend.user.edit',compact('user'));
    }

    public function editVue(User $user) {
        return response()->json(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $validators = Validator::make($request->all(),[
            'name' => 'sometimes|min:2',
            'surname' => 'sometimes|min:2',
            'email' => 'required|email',
            'password' => 'sometimes|min:8',
            'number' => 'sometimes',
            'bank_account' => 'sometimes',
            'city' => 'sometimes',
            'role' => 'required|string',
            'adress' => 'sometimes',
            'photo' => 'sometimes|file|image|mimes:jpg,jpeg,svg,gif,png'
        ]);
        
        if($validators->fails()):
            return response()->json(['error' => $validators->errors()],422);
        endif;

        try{
            $user->update($request->except(['created_at','updated_at', 'id','_method','email_verified_at']));

            if($request->has('password')) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }

            if($request->has('photo')):
                $user->update([
                    'photo' => $request->photo->store('uploads/users','public'),
                ]);

                $image = Image::make(public_path('storage/'.$user->photo))->resize(120,120);
                $image->save();
                
            endif;
            return response()->json(['mes' => 'İstifadəçi uğurla yeniləndi','photo' => $user->photo],200);    

        } catch(Exception $e) {
            return response()->json(['error' => 'İstifadəçi yenilənərkən xəta baş verdi'],422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try{

            if($user->photo) {
                Storage::delete('public/'.$user->photo);
            }

            $user->delete();
            
            return response()->json(['mes' => 'İstifadəçi uğurla silindi'],200);
        }catch(Exception $e) {
            return response()->json(['error' => 'İstifadəçi silinirkən xəta baş verdi'],422);
        }
    }
}
