@extends('layouts.master')
@section('title','Add User')
@section('content')
<div class="top">
  <h1>Add User</h1>
</div>
<form action="/user/add" method="POST">
  @if($errors->any())
    @foreach ($errors->all() as $error)
      <div class="alert alert-danger" role="alert">{{$error}}</div>
    @endforeach
  @endif
  {{csrf_field()}}
  <div class="form-group">
    <label for="form--username">Username</label>
    <input type="Username" name="username" class="form-control" id="form--username" placeholder="Enter username">
  </div>
  <div class="form-group">
    <label for="form--password">Password</label>
    <input type="password" name="password" class="form-control" id="form--password" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="form--status">Status</label>
    <select name="status" id="form--status" class="custom-select">
      <option value="0">User</option>
      <option value="1">Admin</option>
    </select>
  </div>
  <div class="form-group">
    <button class="btn btn-primary" type="submit" name="submit">Add</button>
  </div>
</form>
@endsection