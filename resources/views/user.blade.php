@extends('layouts.master')
@section('title','User List')
@section('content')
<div class="top">
  <h1>User List</h1>
  <a href="#" onclick="window.print();" role="button" class="btn btn-light">Print</a>
  <a href="/user/add" role="button" class="btn btn-primary">Add</a>
  <form action="{{ url()->current() }}">
    <input type="text" name="cari" placeholder="Cari..." class="form-control" value="<?php if(isset($_GET['cari'])){ echo $_GET['cari'];}?>">
  </form>
</div>
@if(\Session::has('alert'))
<div class="alert alert-success" role="alert">{{\Session::get('alert')}}</div>
@endif
<table class="table">
  <thead>
    <th>ID</th>
    <th>Username</th>
    <th>Status</th>
    <th class="th-action">Action</th>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <tr>
      <td>{{$user->id}}</td>
      <td>{{$user->username}}</td>
      <td>@php
        if($user->status == 0){echo 'User';}
        if($user->status == 1){echo 'Admin';}
        @endphp</td>
      <td class="td-action"><a href="/user/edit/{{$user->id}}">Edit</a> | <a href="#" onclick="confirmURL('Apakah anda yakin ingin menghapus ini?','/user/delete/{{$user->id}}')">Delete</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection