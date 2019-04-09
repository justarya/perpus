@extends('layouts.master')
@section('title','User List')
@section('content')
<div class="top">
  <h1>Buku list</h1>
  <a href="/buku/add" role="button" class="btn btn-primary">Add</a>
  <form action="{{ url()->current() }}">
    <input type="text" name="cari" placeholder="Cari..." class="form-control" value="<?php if(isset($_GET['cari'])){ echo $_GET['cari'];}?>">
  </form>
</div>
<table class="table">
  <thead>
    <th>Id</th>
    <th>Kode Buku</th>
    <th>Judul Buku</th>
    <th>Pengarang</th>
    <th>Kategori</th>
    <th>Action</th>
  </thead>
  <tbody>
    @foreach ($bukus as $buku)
    <tr>
      <td>{{$buku->id}}</td>
      <td>{{$buku->kode_buku}}</td>
      <td>{{$buku->judul_buku}}</td>
      <td>{{$buku->pengarang}}</td>
      <td>{{$buku->kategori}}</td>
      <td><a href="/buku/edit/{{$buku->id}}">Edit</a> | <a href="/buku/delete/{{$buku->id}}">Delete</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection