@extends('layouts.master')
@section('title','Denda')
@section('content')
<div class="top">
  <h1>Denda</h1>
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
    <th>Tanggal Kembali</th>
    <th>Denda</th>
    <th class="th-action">Action</th>
  </thead>
  <tbody>
    @foreach ($peminjamans as $peminjaman)
    <tr>
      <td>{{$peminjaman->id}}</td>
      <td>{{$peminjaman->nama_peminjam}}</td>
      <td>{{$peminjaman->alamat_peminjam}}</td>
      <td>{{$peminjaman->buku->judul_buku}}</td>
      <td>{{$peminjaman->tanggal_kembali}}</td>
      <td>Rp. {{number_format($peminjaman->denda, 2)}}</td>
      <td class="td-action"><a href="#" onclick="confirmURL('Apakah Anda yakin Denda sebesar Rp. {{number_format($peminjaman->denda,2)}} Sudah dibayar?','/peminjaman/denda/konfirmasi/{{$peminjaman->id}}')">Konfirmasi Pembayaran</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection