@extends('layouts.master')
@section('title','Stok Buku')
@section('content')
<div class="top">
  <h1>Stok Buku</h1>
  <a href="#" onclick="window.print();" role="button" class="btn btn-light">Print</a>
  <a href="/stokbuku/add" role="button" class="btn btn-primary">Add</a>
  <form action="{{ url()->current() }}">
    <input type="text" name="cari" placeholder="Cari..." class="form-control" value="<?php if(isset($_GET['cari'])){ echo $_GET['cari'];}?>">
  </form>
</div>
@if(\Session::has('alert'))
<div class="alert alert-success" role="alert">{{\Session::get('alert')}}</div>
@endif
<table class="table">
  <thead>
    <th>Id</th>
    <th>Judul Buku</th>
    <th>Nomor Rak</th>
    <th>Jumlah Buku</th>
    <th class="th-action">Action</th>
  </thead>
  <tbody>
    @foreach ($stokbukus as $stokbuku)
    <tr>
      <td>{{$stokbuku->id}}</td>
      <td>{{$stokbuku->buku->judul_buku}}</td>
      <td>{{$stokbuku->nomor_rak}}</td>
      <td>{{$stokbuku->jumlah_buku}}</td>
      <td class="td-action"><a href="/stokbuku/edit/{{$stokbuku->id}}">Edit</a> | <a href="#" onclick="confirmURL('Apakah anda yakin ingin menghapus ini?','/stokbuku/delete/{{$stokbuku->id}}')">Delete</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection