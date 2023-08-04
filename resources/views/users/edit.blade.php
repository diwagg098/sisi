@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
      <div class="p-5">
          <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Create an User</h1>
          </div>
          <form class="user" action="{{ url('/users/edit/' . $user->id)}}" method="POST">
            @csrf
              <div class="form-group">
                <label for="">Name</label>
                  <input type="text" class="form-control form-control-user" name="name" value="{{ $user->nama_user}}" id="exampleInputEmail"
                      placeholder="Nama">
              </div>
              <div class="form-group">
                <label for="">Email</label>
                  <input type="email" class="form-control form-control-user" name="email" value="{{ $user->email}}" id="exampleInputEmail"
                      placeholder="Email">
              </div>
              <div class="form-group">
                <label for="">Username</label>
                  <input type="text" class="form-control form-control-user" name="username" value="{{ $user->username}}" id="exampleInputEmail"
                      placeholder="Username">
              </div>
              <div class="form-group">
                <label for="">No Hp</label>
                  <input type="text" class="form-control form-control-user" name="no_hp" value="{{ $user->no_hp}}" id="exampleInputEmail"
                      placeholder="No Hp">
              </div>
              <div class="form-group">
                <label for="">No WhatsApp</label>
                  <input type="text" class="form-control form-control-user" name="wa" value="{{ $user->wa}}" id="exampleInputEmail"
                      placeholder="No WhatsApp">
              </div>
              <div class="form-group">
                <label for="">Status</label>
                <select name="status" id="status" class="form-control">
                  <option value="active">Active</option>
                  <option value="non_active">Non-active</option>
                </select>
              </div>
              <button class="btn btn-primary" type="submit">Edit User</button>
          </form>
          <hr>
      </div>
  </div>
</div>
@endsection