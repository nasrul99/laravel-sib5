<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffController extends Controller{
    public function dataStaff(){
        $p1 = ['nip'=>'111', 'nama'=>'Budi Santoso','jabatan'=>'Manager','status'=>'Menikah','agama'=>'Islam'];
        $p2 = ['nip'=>'112', 'nama'=>'Siti Aminah','jabatan'=>'Asisten Manager','status'=>'Belum','agama'=>'Islam'];
        $p3 = ['nip'=>'113', 'nama'=>'Alissa','jabatan'=>'Supervisor','status'=>'Menikah','agama'=>'Kristen Protestan'];
        $p4 = ['nip'=>'114', 'nama'=>'I Putu Gede','jabatan'=>'Staff','status'=>'Belum','agama'=>'Hindu'];
        $p5 = ['nip'=>'115', 'nama'=>'Sri Rezeki','jabatan'=>'Staff','status'=>'Menikah','agama'=>'Budha'];
        $p6 = ['nip'=>'116', 'nama'=>'Hanif Rizqi','jabatan'=>'Staff','status'=>'Menikah','agama'=>'Islam'];
        //array associative
        $ar_pegawai = [$p1,$p2,$p3,$p4,$p5,$p6];
        $ar_judul = ['NO','NIP','NAMA','JABATAN','STATUS','AGAMA','GAJI POKOK','TUNJAB','BPJS','TUNKEL','ZAKAT','GAJI BERSIH'];
        //arahkan ke sebuah view dengan mengirim data2 di atas
        return view('data_staff',compact('ar_pegawai','ar_judul'));
    }
}