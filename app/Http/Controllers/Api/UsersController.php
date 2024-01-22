<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; //panggil model
use App\Http\Resources\UsersResource; //panggil resource
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model; //jika pakai eloquent
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return new UsersResource(true,'Data User',$users);
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:45',
            'email' => 'required|email',
            'password' => 'required|max:45',
            'role' => 'required|max:45',
            'isactive' => 'required|max:45',
        ]);

        //cek error atau tidak inputan data
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        //proses menyimpan data yg diinput
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'isactive'=> $request->isactive,
        ]);

        return new UsersResource(true, 'Data User Berhasil diinput',$user);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //$user = User::find($id);
        
        $user = DB::table('users')
            ->select('id','name', 'email', 'password', 'role', 'isactive')
            ->where('id', $id)
            ->first();
            
        if($user){
            return new UsersResource(true,'Detail User',$user);
        }
        else{
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Data User Tidak Ditemukan',
                ],404);
        }    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:45',
            'email' => 'required|email',
            'password' => 'required|max:45',
            'role' => 'required|max:45',
            'isactive' => 'required|max:45',
        ]);

        //cek error atau tidak inputan data
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        //proses mengedit data lama
        $user = User::whereId($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'isactive'=> $request->isactive,
        ]);
        return new UsersResource(true, 'Data User Berhasil diubah',$user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::whereId($id)->first();
        $user->delete();
        return new UsersResource(true, 'Data User Berhasil dihapus',$user);
    }
}
