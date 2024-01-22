<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; //panggil model
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model; //jika pakai eloquent
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $ar_user = User::orderBy('id', 'desc')->get();
        return view('backend.user.index', compact('ar_user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //sebelum hapus data, hapus terlebih dahulu fisik file fotonya jika ada
        $row = User::find($id);
        if(!empty($row->foto)) unlink('backend/image/'.$row->foto);
        //hapus datanya dari tabel
        User::where('id',$id)->delete();
        return redirect()->route('user.index')
                        ->with('success','Data User Berhasil Dihapus');
    }

    public function apiUsers(){
        $users = User::all();
        return response()->json(
            [
                'success'=>true,
                'message'=>'Data User',
                'data'=>$users
            ],200);
    }

    public function apiUserDetail($id){
        $user = User::find($id);
        if($user){
            return response()->json(
                [
                    'success'=>true,
                    'message'=>'Data User Detail',
                    'data'=>$user
                ],200);
        }
        else{
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Data User Tidak Ditemukan',
                ],404);
        }    
    }
}

