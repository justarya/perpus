<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Buku;
use App\StokBuku;

class BukuController extends Controller
{
    public function loadBuku(Request $request){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }
        
        $data['bukus'] = Buku::all();
        

        if(!empty($request->cari)){
            $data['bukus'] = Buku::where('judul_buku','like','%'.$request->cari.'%')->get();
        }

        return View('buku', $data);
    }
    public function loadAddBuku(){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }

        return View('addbuku');
    }
    public function storeAddBuku(Request $request){
        $this->validate($request, [
            'kode_buku'=>'required|numeric',
            'judul_buku'=>'required|max:225',
            'pengarang'=>'required|max:225',
            'kategori'=>'required|max:225',
        ]);

        $buku = new Buku;
        $buku->kode_buku = $request->kode_buku;
        $buku->judul_buku = $request->judul_buku;
        $buku->pengarang = $request->pengarang;
        $buku->kategori = $request->kategori;
        $buku->save();
        
        return redirect('/buku')->with('alert','Buku berhasil ditambahkan!');
    }
    public function loadEditBuku($id){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }

        $data['buku'] = Buku::where('id',$id)->first();
        
        return View('editbuku',$data);
    }
    public function storeEditBuku(Request $request, $id){
        $this->validate($request, [
            'kode_buku'=>'required|numeric',            
            'judul_buku'=>'required|max:225',
            'pengarang'=>'required|max:225',
            'kategori'=>'required|max:225',
        ]);

        $buku = Buku::where('id',$id)->first();
        $buku->kode_buku = $request->kode_buku;
        $buku->judul_buku = $request->judul_buku;
        $buku->pengarang = $request->pengarang;
        $buku->kategori = $request->kategori;
        $buku->save();
        
        return redirect('/buku')->with('alert','Buku berhasil diedit!');
    }
    public function deleteBuku($id){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }
        
        $buku = Buku::where('id',$id)->delete();

        return redirect('/buku')->with('alert','Buku berhasil dihapus!');
    }

    // Stok Buku

    public function loadStokBuku(Request $request){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }
        
        $data['stokbukus'] = StokBuku::all();
    
        if(!empty($request->cari)){
            $cari = $request->cari;
            // $data['bukus'] = StokBuku::whereHas('Buku', function($q){$q->where('judul_buku','like','%zzz%');})->get();
            $data['stokbukus'] = DB::table('stok_buku')->join('daftar_buku','stok_buku.id','=','daftar_buku.id')->where('daftar_buku.judul_buku','like','%'.$request->cari.'%')->get();
        }

        return View('stokbuku', $data);
    }
    public function loadAddStokBuku(){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }
        $data['bukus'] = Buku::all();
        
        return View('addstokbuku', $data);
    }
    public function storeAddStokBuku(Request $request){
        $this->validate($request, [
            'buku'=>'required',
            'rak_buku'=>'required|max:10',
            'jumlah_buku'=>'required|numeric|max:11',
        ]);
        
        $stokbuku = new StokBuku;
        $stokbuku->id_buku = $request->buku;
        $stokbuku->nomor_rak = $request->rak_buku;
        $stokbuku->jumlah_buku = $request->jumlah_buku;
        $stokbuku->save();
        
        return redirect('/stokbuku')->with('alert','Stok Buku berhasil ditambahkan!');
    }
    public function loadEditStokBuku($id){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }
        
        $data['bukus'] = Buku::all();
        $data['stokbuku'] = StokBuku::where('id',$id)->first();
        
        return View('editstokbuku',$data);
    }
    public function storeEditStokBuku(Request $request, $id){
        $this->validate($request, [
            'buku'=>'required',
            'rak_buku'=>'required|max:10',
            'jumlah_buku'=>'required|numeric|max:11',
        ]);

        $stokbuku = StokBuku::where('id',$id)->first();
        $stokbuku->id_buku = $request->buku;
        $stokbuku->nomor_rak = $request->rak_buku;
        $stokbuku->jumlah_buku = $request->jumlah_buku;
        $stokbuku->save();
        
        return redirect('/stokbuku')->with('alert','Stok Buku berhasil diedit!');
    }
    public function deleteStokBuku($id){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }
        
        $stokbuku = StokBuku::where('id',$id)->delete();

        return redirect('/stokbuku')->with('alert','Stok Buku berhasil dihapus!');
    }

}
