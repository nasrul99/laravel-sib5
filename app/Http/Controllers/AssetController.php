<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset; //panggil model
use App\Models\Kategori; //panggil model
use Illuminate\Support\Facades\DB; // jika pakai query builder
use Illuminate\Database\Eloquent\Model; //jika pakai eloquent
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use PDF;
use App\Exports\AssetExport;
use Maatwebsite\Excel\Facades\Excel;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //$ar_asset = Asset::all();//eloquent
        $ar_asset = Asset::orderBy('id', 'desc')->get();
        return view('backend.asset.index', compact('ar_asset'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //ambil master data kategori u/ dilooping di select option form
        $ar_kategori = Kategori::all();
        $ar_kondisi = ['Baik','Sedang','Rusak'];
        return view('backend.asset.form', compact('ar_kategori','ar_kondisi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            //tentukan validasi data berdasarkan constraint field
            [
                'nama' => 'required|max:45',
                'kategori_id' => 'required|integer',
                'thn_beli' => 'required|integer',
                'harga' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/', //double
                'masa_umur' => 'required|between:0,99.99', //float
                'kondisi' => 'required',
                'lokasi' => 'required',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|min:2|max:9000',//KB
            ],
            //custom pesan errornya berbahasa indonesia
            [
                'nama.required'=>'Nama Wajib Diisi',
                'nama.max'=>'Nama Maksimal 45 karakter',
                'kategori_id.required'=>'Kategori Wajib Diisi',
                'kategori_id.integer'=>'Kategori Harus Bilangan Bulat',
                'thn_beli.required'=>'Tahun Beli Wajib Diisi',
                'thn_beli.integer'=>'Tahun Beli Harus Bilangan Bulat',
                'harga.required'=>'Harga Wajib Diisi',
                'harga.regex'=>'Harga Harus Berupa Angka',
                'masa_umur.required'=>'Masa Umur Wajib Diisi',
                'masa_umur.between'=>'Masa Umur Bilangan Pecahan',
                'kondisi.required'=>'Kondisi Wajib Diisi',
                'lokasi.required'=>'Lokasi Wajib Diisi',
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
            $fileName = 'asset_'.date("Ymd_h-i-s").'.'.$request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('backend/assets/img'),$fileName);
        }
        else{
            $fileName = '';
        }
        //lakukan insert data dari request form dgn query builder
        try{
            DB::table('asset')->insert(
                [
                    'nama'=>$request->nama,
                    'kategori_id'=>$request->kategori_id,
                    'thn_beli'=>$request->thn_beli,
                    'harga'=>$request->harga,
                    'masa_umur'=>$request->masa_umur,
                    'kondisi'=>$request->kondisi,
                    'lokasi'=>$request->lokasi,
                    'foto'=>$fileName,
                    //'created_at'=>now(),
                ]);
        
            return redirect()->route('asset.index')
                            ->with('success','Data Asset Baru Berhasil Disimpan');
        }
        catch (\Exception $e){
            //return redirect()->back()
            return redirect()->route('asset.index')
                ->with('error', 'Terjadi Kesalahan Saat Input Data!');
        }  
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rs = Asset::find($id);
        return view('backend.asset.detail',compact('rs'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //ambil master untuk dilooping di select option
        $ar_kategori = Kategori::all();
        $ar_kondisi = ['Baik','Sedang','Rusak'];
        //tampilkan data lama di form edit
        $row = Asset::find($id);
        return view('backend.asset.form_edit',compact('row','ar_kategori','ar_kondisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            //tentukan validasi data berdasarkan constraint field
            [
                'nama' => 'required|max:45',
                'kategori_id' => 'required|integer',
                'thn_beli' => 'required|integer',
                'harga' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/', //double
                'masa_umur' => 'required|between:0,99.99', //float
                'kondisi' => 'required',
                'lokasi' => 'required',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|min:2|max:9000',//KB
            ],
            //custom pesan errornya berbahasa indonesia
            [
                'nama.required'=>'Nama Wajib Diisi',
                'nama.max'=>'Nama Maksimal 45 karakter',
                'kategori_id.required'=>'Kategori Wajib Diisi',
                'thn_beli.required'=>'Tahun Beli Wajib Diisi',
                'thn_beli.integer'=>'Tahun Beli Harus Bilangan Bulat',
                'harga.required'=>'Harga Wajib Diisi',
                'harga.regex'=>'Harga Harus Berupa Angka',
                'masa_umur.required'=>'Masa Umur Wajib Diisi',
                'masa_umur.between'=>'Masa Umur Bilangan Pecahan',
                'kondisi.required'=>'Kondisi Wajib Diisi',
                'lokasi.required'=>'Lokasi Wajib Diisi',
                'foto.min'=>'Ukuran file kurang 2 KB',
                'foto.max'=>'Ukuran file melebihi 9000 KB',
                'foto.image'=>'File foto bukan gambar',
                'foto.mimes'=>'Extension file selain jpg,jpeg,png,gif,svg',
            ]
        );
        //------------ambil foto lama apabila user ingin ganti foto-----------
        $foto = DB::table('asset')->select('foto')->where('id',$id)->get();
        foreach($foto as $f){
            $namaFileFotoLama = $f->foto;
        }
        //------------apakah user  ingin ubah upload foto baru-----------
        if(!empty($request->foto)){
            //jika ada foto lama, hapus foto lamanya terlebih dahulu
            if(!empty($namaFileFotoLama)) unlink('backend/assets/img/'.$namaFileFotoLama);
            //lalukan proses ubah foto lama menjadi foto baru
            $fileName = 'asset_'.date("Ymd_h-i-s").'.'.$request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('backend/assets/img'),$fileName);
        }
        else{
            $fileName = $namaFileFotoLama;
        }
        //lakukan update data dari request form edit
        DB::table('asset')->where('id',$id)->update(
            [
                'nama'=>$request->nama,
                'kategori_id'=>$request->kategori_id,
                'thn_beli'=>$request->thn_beli,
                'harga'=>$request->harga,
                'masa_umur'=>$request->masa_umur,
                'kondisi'=>$request->kondisi,
                'lokasi'=>$request->lokasi,
                'foto'=>$fileName,
            ]);
       
        return redirect('/asset'.'/'.$id)
                        ->with('success','Data Asset Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //sebelum hapus data, hapus terlebih dahulu fisik file fotonya jika ada
        $row = Asset::find($id);
        if(!empty($row->foto)) unlink('backend/assets/img/'.$row->foto);
        //hapus datanya dari tabel
        Asset::where('id',$id)->delete();
        return redirect()->route('asset.index')
                        ->with('success','Data Asset Berhasil Dihapus');
    }

    public function delete($id)
    {
        //sebelum hapus data, hapus terlebih dahulu fisik file fotonya jika ada
        $row = Asset::find($id);
        if(!empty($row->foto)) unlink('backend/assets/img/'.$row->foto);
        //hapus datanya dari tabel
        Asset::where('id',$id)->delete();
        return redirect()->back();
    } 

    public function generatePDF()
    {
        $data = [
            'title' => 'Welcome to Kampus Merdeka',
            'date' => date('d-m-Y H:i:s')
        ];
          
        $pdf = PDF::loadView('backend.asset.tesPDF', $data);
    
        return $pdf->download('data_tespdf_'.date('d-m-Y_H:i:s').'.pdf');
    }

    public function assetPDF(){
        $ar_asset = Asset::all();
        $pdf = PDF::loadView('backend.asset.assetPDF', 
                              ['ar_asset'=>$ar_asset]);
        return $pdf->download('data_asset_'.date('d-m-Y_H:i:s').'.pdf');
    }

    public function assetExcel() 
    {
        return Excel::download(new AssetExport, 'data_asset_'.date('d-m-Y_H:i:s').'.xlsx');
    }
}
