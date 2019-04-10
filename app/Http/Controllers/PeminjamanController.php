<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Peminjaman;
use App\StokBuku;
use App\Buku;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class PeminjamanController extends Controller
{
    public function loadApp(){
        return Redirect('/peminjaman/booking');
    }
    public function loadPublic(){
        return Redirect('/peminjaman/booking/add');
    }
    public function loadBooking(Request $request){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }

        $data['peminjamans'] = Peminjaman::where('status_peminjaman',0)->get();
        if(!empty($request->cari)){
            $data['peminjamans'] = Peminjaman::where('status_peminjaman',3)->where('nama_peminjam','like','%'.$request->cari.'%')->get();
        }

        return View('booking', $data);
    }
    public function konfirmasiBooking($id){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }
        
        $peminjaman = Peminjaman::where('id',$id)->first();
        $peminjaman->status_peminjaman = 1;
        $peminjaman->tanggal_kembali = Carbon::now()->addDays(7)->format('Y-m-d');
        $peminjaman->save();
        
        return redirect('/peminjaman/booking')->with('alert','Berhasil dikonfirmasi!');
    }
    public function cancelBooking($id){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }
        
        $peminjaman = Peminjaman::where('id',$id)->first();
        $peminjaman->status_peminjaman = 4;
        $peminjaman->save();
        
        return redirect('/peminjaman/booking')->with('alert','Berhasil dibatalkan!');
    }
    public function loadPinjam(Request $request){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }
        
        $data['peminjamans'] = Peminjaman::where('status_peminjaman',1)->get();
        
        if(!empty($request->cari)){
            $data['peminjamans'] = Peminjaman::where('status_peminjaman',1)->where('nama_peminjam','like','%'.$request->cari.'%')->get();
        }

        return View('pinjam', $data);
    }
    public function konfirmasiPinjam($id){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }

        $peminjamans = Peminjaman::where('id',$id)->first();
        $tanggalKembali = $peminjamans->tanggal_kembali;
        
        $peminjaman = Peminjaman::where('id',$id)->first();
        if(Carbon::now()->lte(Carbon::parse($peminjamans->tanggal_kembali))){ //sekarang >= pengembalian
            $peminjaman->status_peminjaman = 3; //status = selesai
            $peminjaman->denda  = 0;

            $buku = StokBuku::where('id_buku',$peminjamans->id_buku)->first();
            $buku->jumlah_buku += 1;
        }else{
            $peminjaman->status_peminjaman = 2;//status = denda
            $days = Carbon::parse($peminjaman->tanggal_kembali)->diffInDays(Carbon::now());
            $peminjaman->denda = 5000 * $days;
        }
        $peminjaman->save();
        
        return redirect('/peminjaman/pinjam')->with('alert','Berhasil Dikonfirmasi!');
    }
    public function loadAddBooking(){
        if(Session::get('login') == false){
            return redirect('/login');
        }
        
        $data['bukus'] = DB::table('daftar_buku')->join('stok_buku','daftar_buku.id','=','stok_buku.id_buku')->where('stok_buku.jumlah_buku','>=',1)->get();
        return view('addbooking',$data);
    }
    public function storeAddBooking(Request $request){
        $this->validate($request, [
            'nama'=>'required|max:255',
            'alamat'=>'required',
            'buku'=>'required',
        ]);

        $stokbuku = StokBuku::where('id_buku',$request->buku)->first();
        $stokbukus = StokBuku::where('id_buku',$request->buku)->first();
        if($stokbukus->jumlah_buku >= 1){
            $stokbuku->jumlah_buku -= 1;
            $stokbuku->save();
        }else{
            return redirect('/peminjaman/booking/add')->with('alert-danger','Buku Sudah Habis');
        }

        $peminjaman = new Peminjaman;
        $peminjaman->nama_peminjam = $request->nama;
        $peminjaman->alamat_peminjam = $request->alamat;
        $peminjaman->id_buku = $request->buku;
        $peminjaman->tanggal_pinjam = Carbon::now()->format('Y-m-d');
        $peminjaman->status_peminjaman = 0;

        $peminjaman->save();
        
        return redirect('/peminjaman/booking/add')->with('alert','Booking berhasil dilakukan');
    }
    public function loadSelesai(Request $request){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }
        
        $data['peminjamans'] = Peminjaman::where('status_peminjaman',3)->get();
        if(!empty($request->cari)){
            $data['peminjamans'] = Peminjaman::where('status_peminjaman',3)->where('nama_peminjam','like','%'.$request->cari.'%')->get();
        }

        return View('selesai', $data);
    }
    public function loadDenda(Request $request){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }

        $data['peminjamans'] = Peminjaman::where('status_peminjaman',2)->get();

        if(!empty($request->cari)){
            $data['peminjamans'] = Peminjaman::where('status_peminjaman',2)->where('nama_peminjam','like','%'.$request->cari.'%')->get();
        }
        return View('denda', $data);
    }
    public function konfirmasiDenda($id){
        if(Session::get('login') == false){
            return redirect('/login');
        }else if(Session::get('status') == '0'){
            return redirect('/public');
        }

        $peminjaman = Peminjaman::where('id',$id)->first();
        $peminjaman->denda = 0;
        $peminjaman->status_peminjaman = 3;
        $peminjaman->save();

        return redirect('/peminjaman/denda')->with('alert','Berhasil dibayar!');
    }
}
