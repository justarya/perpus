@extends('layouts.master')
@section('title','User List')
@section('content')
<div class="top">
  <h1>Booking</h1>
  <a href="/peminjaman/booking/add" role="button" class="btn btn-primary">Add</a>
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
    <th>Nama Peminjam</th>
    <th>Alamat Peminjam</th>
    <th>Judul Buku</th>
    <th>Tanggal Pinjam</th>
    <th>Action</th>
  </thead>
  <tbody>
    @foreach ($peminjamans as $peminjaman)
    <tr>
      <td>{{$peminjaman->id}}</td>
      <td>{{$peminjaman->nama_peminjam}}</td>
      <td>{{$peminjaman->alamat_peminjam}}</td>
      <td>{{$peminjaman->buku->judul_buku}}</td>
      <td>{{$peminjaman->tanggal_pinjam}}</td>
      <td><a href="/peminjaman/booking/konfirmasi/{{$peminjaman->id}}">Konfirmasi</a> | <a href="javascript:void(0)" onclick="confirmURL('Apakah Anda Yakin Mau Membatalkannya?','/peminjaman/booking/cancel/{{$peminjaman->id}}')">Cancel</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection