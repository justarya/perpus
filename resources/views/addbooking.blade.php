@extends('layouts.master')
@section('title','Buat Booking')
@section('content')
<div class="top">
  <h1>Buat Booking</h1>
</div>
<form action="/peminjaman/booking/add" method="POST">
  @if(\Session::has('alert-danger'))
    <div class="alert alert-danger" role="alert">{{\Session::get('alert-danger')}}</div>
  @endif
  @if(\Session::has('alert'))
    <div class="alert alert-success" role="alert">{{\Session::get('alert')}}</div>
  @endif
  @if($errors->any())
    @foreach ($errors->all() as $error)
      <div class="alert alert-danger" role="alert">{{$error}}</div>
    @endforeach
  @endif
  {{csrf_field()}}
  <div class="form-group">
    <label for="form--nama">Nama Peminjam</label>
    <input type="text" name="nama" class="form-control" id="form--nama" placeholder="Masukan nama">
  </div>
  <div class="form-group">
    <label for="form--alamat">Alamat Peminjam</label>
    <textarea name="alamat" class="form-control" id="form--alamat" placeholder="Masukan Alamat"></textarea>
  </div>
  <div class="form-group">
    <label for="form--buku">Judul Buku</label>
    <select name="buku" id="form--buku" class="custom-select">
      <option value="">Pilih Buku</option>
      @foreach ($bukus as $buku)
      <option value="{{$buku->id_buku}}">{{$buku->judul_buku}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="form--tanggal">Tanggal Peminjam</label>
    <input type="text" name="date" class="form-control" id="form--tanggal" value="{{date('d/m/Y')}}" disabled>
  </div>
  <div class="form-group">
    <label for="form--status">Status Peminjam</label>
    <input type="text" name="status" class="form-control" id="form--status" value="Booking" disabled>
  </div>
  <div class="form-group">
    <button class="btn btn-primary" type="submit" name="submit">Create</button>
    @if(\Session::get('status') == 1 )
    <a href="/stokbuku" role="button" class="btn btn-default">Cancel</a>
    @endif
  </div>
</form>
@endsection