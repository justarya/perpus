@extends('layouts.master')
@section('title','User List')
@section('content')
<div class="top">
  <h1>Peminjaman Selesai</h1>
  <a href="#" onclick="window.print();" role="button" class="btn btn-light">Print</a>
  <form action="{{ url()->current() }}">
    <input type="text" name="cari" placeholder="Cari..." class="form-control" value="<?php if(isset($_GET['cari'])){ echo $_GET['cari'];}?>">
  </form>
</div>
@if(\Session::has('alert'))
<div class="alert alert-success" role="alert">{{\Session::get('alert')}}</div>
@endif
<table class="table">
  <thead>
    <th>Id Peminjaman</th>
    <th>Nama Peminjam</th>
    <th>Alamat Peminjam</th>
    <th>Judul Buku</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Pengembalian</th>
  </thead>
  <tbody>
    @foreach ($peminjamans as $peminjaman)
    <tr>
      <td>{{$peminjaman->id}}</td>
      <td>{{$peminjaman->nama_peminjam}}</td>
      <td>{{$peminjaman->alamat_peminjam}}</td>
      <td>{{$peminjaman->buku->judul_buku}}</td>
      <td>{{$peminjaman->tanggal_pinjam}}</td>
      <td>{{$peminjaman->tanggal_kembali}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection