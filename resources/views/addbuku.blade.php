@extends('layouts.master')
@section('title','Add Buku')
@section('content')
<div class="top">
  <h1>Add Buku</h1>
</div>
<form action="/buku/add" method="POST">
  @if($errors->any())
    @foreach ($errors->all() as $error)
      <div class="alert alert-danger" role="alert">
        {{$error}}  
      </div> 
    @endforeach
  @endif
  {{csrf_field()}}
  <div class="form-group">
    <label for="form--kode">Kode Buku</label>
    <input type="number" name="kode_buku" class="form-control" id="form--kode" placeholder="Kode" value="{{old('kode_buku')}}">
  </div>
  <div class="form-group">
    <label for="form--judul">Judul Buku</label>
    <input type="text" name="judul_buku" class="form-control" id="form--judul" placeholder="Judul" value="{{old('judul_buku')}}">
  </div>
  <div class="form-group">
    <label for="form--pengarang">Pengarang</label>
    <input type="text" name="pengarang" class="form-control" id="form--pengarang" placeholder="Pengarang" value="{{old('pengarang')}}">
  </div>
  <div class="form-group">
    <label for="form--kategori">Kategori</label>
    <input type="text" name="kategori" class="form-control" id="form--kategori" placeholder="Kategori" value="{{old('kategori')}}">
  </div>
  <div class="form-group">
    <button class="btn btn-primary" type="submit" name="submit">Add</button>
    <a href="/buku" role="button" class="btn btn-default">Cancel</a>
  </div>
</form>
@endsection