<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; //panggil model
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model; //jika pakai eloquent
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
        $ar_role = ['admin','manajemen','staff'];
        $ar_isactive = ['yes','no','banned'];
        return view('backend.user.form', compact('ar_role','ar_isactive'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            //tentukan validasi data berdasarkan constraint field
            [
                'name' => 'required|max:45',
                'email' => 'required|unique:users|email',
                'password' => 'required|min:8',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|min:2|max:9000',//KB
            ],
            //custom pesan errornya berbahasa indonesia
            [
                'name.required'=>'Nama Wajib Diisi',
                'name.max'=>'Nama Maksimal 45 karakter',
                'email.required'=>'Email Wajib Diisi',
                'email.email'=>'Email Harus Berformat Email',
                'email.unique'=>'Email Sudah Ada',
                'password.required'=>'Password Wajib Diisi',
                'password.min'=>'Password Minimal 8 Karakter',
                'foto.min'=>'Ukuran file kurang 2 KB',
                'foto.max'=>'Ukuran file melebihi 9000 KB',
                'foto.image'=>'File foto bukan gambar',
                'foto.mimes'=>'Extension file selain jpg,jpeg,png,gif,svg',
            ]
        );

        //Asset::create($request->all());
        //return redirect()->route('asset.index')->with('success','Asset created successfully!!!');
        
        //------------apakah user  ingin upload foto------------
        if(!empty($request->foto)){
            $fileName = 'foto_'.date("Ymd_h-i-s").'.'.$request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('backend/assets/img'),$fileName);
        }
        else{
            $fileName = '';
        }
        //lakukan insert data dari request form dgn query builder
        try{
            DB::table('users')->insert(
                [
                    'name'=>$request->name,
                    'email'=>$request->email,
                    //'password'=>$request->password,
                    'password' => Hash::make($request->password),
                    'role'=>$request->role,
                    'isactive'=>$request->isactive,
                    'foto'=>$fileName,
                    'created_at'=>now(),
                ]);
        
            return redirect()->route('backend.user.index')
                            ->with('success','Data User Baru Berhasil Disimpan');
        }
        catch (\Exception $e){
            //return redirect()->back()
            return redirect()->route('backend.user.index')
                ->with('error', 'Terjadi Kesalahan Saat Input Data!');
        }  
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rs = User::find($id);
        return view('backend.user.detail',compact('rs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ar_role = ['admin','manajemen','staff'];
        $ar_isactive = ['yes','no','banned'];
        $row = User::find($id);
        return view('backend.user.form_edit', compact('ar_role','ar_isactive','row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            //tentukan validasi data berdasarkan constraint field
            [
                'name' => 'required|max:45',
                'email' => 'required|unique:users|email',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|min:2|max:9000',//KB
            ],
            //custom pesan errornya berbahasa indonesia
            [
                'name.required'=>'Nama Wajib Diisi',
                'name.max'=>'Nama Maksimal 45 karakter',
                'email.required'=>'Email Wajib Diisi',
                'email.email'=>'Email Harus Berformat Email',
                'email.unique'=>'Email Sudah Ada',
                'foto.min'=>'Ukuran file kurang 2 KB',
                'foto.max'=>'Ukuran file melebihi 9000 KB',
                'foto.image'=>'File foto bukan gambar',
                'foto.mimes'=>'Extension file selain jpg,jpeg,png,gif,svg',
            ]
        );
        //------------ambil foto lama apabila user ingin ganti foto-----------
        $foto = DB::table('users')->select('foto')->where('id',$id)->get();
        foreach($foto as $f){
            $namaFileFotoLama = $f->foto;
        }
        //------------apakah user  ingin ubah upload foto baru-----------
        if(!empty($request->foto)){
            //jika ada foto lama, hapus foto lamanya terlebih dahulu
            if(!empty($namaFileFotoLama)) unlink('backend/assets/img'.$namaFileFotoLama);
            //lalukan proses ubah foto lama menjadi foto baru
            $fileName = 'foto_'.date("Ymd_h-i-s").'.'.$request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('backend/assets/img'),$fileName);
        }
        else{
            $fileName = $namaFileFotoLama;
        }
        //lakukan update data dari request form edit
        DB::table('users')->where('id',$id)->update(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'role'=>$request->role,
                'isactive'=>$request->isactive,
                'foto'=>$fileName,
                'updated_at'=>now(),
            ]);
       
        return redirect('/user'.'/'.$id)
                        ->with('success','Data User Berhasil Diubah');
    }

    public function editProfile(Request $request, string $id)
    {
        $validated = $request->validate(
            //tentukan validasi data berdasarkan constraint field
            [
                'name' => 'required|max:45',
                'email' => 'required|unique:users|email',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|min:2|max:9000',//KB
            ],
            //custom pesan errornya berbahasa indonesia
            [
                'name.required'=>'Nama Wajib Diisi',
                'name.max'=>'Nama Maksimal 45 karakter',
                'email.required'=>'Email Wajib Diisi',
                'email.email'=>'Email Harus Berformat Email',
                'email.unique'=>'Email Sudah Ada',
                'foto.min'=>'Ukuran file kurang 2 KB',
                'foto.max'=>'Ukuran file melebihi 9000 KB',
                'foto.image'=>'File foto bukan gambar',
                'foto.mimes'=>'Extension file selain jpg,jpeg,png,gif,svg',
            ]
        );
        //------------ambil foto lama apabila user ingin ganti foto-----------
        $foto = DB::table('users')->select('foto')->where('id',$id)->get();
        foreach($foto as $f){
            $namaFileFotoLama = $f->foto;
        }
        //------------apakah user  ingin ubah upload foto baru-----------
        if(!empty($request->foto)){
            //jika ada foto lama, hapus foto lamanya terlebih dahulu
            if(!empty($namaFileFotoLama)) unlink('backend/assets/img/'.$namaFileFotoLama);
            //lalukan proses ubah foto lama menjadi foto baru
            $fileName = 'foto_'.date("Ymd_h-i-s").'.'.$request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('backend/assets/img'),$fileName);
        }
        else{
            $fileName = $namaFileFotoLama;
        }
        //lakukan update data dari request form edit
        DB::table('users')->where('id',$id)->update(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'foto'=>$fileName,
                'updated_at'=>now(),
            ]);
       
        return redirect('/user'.'/'.$id)
                        ->with('success','Data User Berhasil Diubah');
    }
    
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('message','Password Updated Successfully');

        }else{

            return redirect()->back()->with('message','Current Password does not match with Old Password');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //sebelum hapus data, hapus terlebih dahulu fisik file fotonya jika ada
        $row = User::find($id);
        if(!empty($row->foto)) unlink('admin/image/'.$row->foto);
        //hapus datanya dari tabel
        User::where('id',$id)->delete();
        return redirect()->route('user.index')
                        ->with('success','Data User Berhasil Dihapus');
    }

    public function userProfile(string $id)
    {
        $rs = User::find($id);
        return view('backend.user.detail',compact('rs'));
    }


    
}
