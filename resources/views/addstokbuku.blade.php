@extends('layouts.master')
@section('title','Add Stok Buku')
@section('content')
<div class="top">
  <h1>Add Buku</h1>
</div>
<form action="/stokbuku/add" method="POST">
  @if($errors->any())
    @foreach ($errors->all() as $error)
      <div class="alert alert-danger" role="alert">
        {{$error}}  
      </div> 
    @endforeach
  @endif
  {{csrf_field()}}
  <div class="form-group">
    <label for="form--buku">Buku</label>
    <select name="buku" id="form--buku" class="form-control">
        <option value="">Pilih Buku</option>
      @foreach ($bukus as $buku)
      <option value="{{$buku->id}}">{{$buku->judul_buku}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="form--rak-buku">Nomor Rak Buku</label>
    <input type="text" name="rak_buku" class="form-control" id="form--rak-buku" placeholder="Nomor Rak Buku" value="{{old('rak_buku')}}">
  </div>
  <div class="form-group">
    <label for="form--jumlah">Jumlah Buku</label>
    <input type="number" name="jumlah_buku" class="form-control" id="form--jumlah" placeholder="Jumlah Buku" value="{{old('jumlah_buku')}}">
  </div>
  <div class="form-group">
    <button class="btn btn-primary" type="submit" name="submit">Add</button>
    <a href="/stokbuku" role="button" class="btn btn-default">Cancel</a>
  </div>
</form>
@endsection