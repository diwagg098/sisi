@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
      <div class="p-5">
          <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Create an User</h1>
          </div>
          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
         @endif
          <form class="user" action="{{ route('users.add')}}" method="POST">
            @csrf
              <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="nama_user" id="exampleInputEmail"
                      placeholder="Nama">
              </div>
              <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail"
                      placeholder="Email">
              </div>
              <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="username" id="exampleInputEmail"
                      placeholder="Username">
              </div>
              <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="no_hp" id="exampleInputEmail"
                      placeholder="No Hp">
              </div>
              <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="wa" id="exampleInputEmail"
                      placeholder="No WhatsApp">
              </div>
              <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="jabatan" id="exampleInputEmail"
                      placeholder="jabatan">
              </div>
              <div class="form-group">
                  <input type="number" class="form-control form-control-user" name="gaji" id="exampleInputEmail"
                      placeholder="gaji/bulan">
              </div>
              <label for="">join date</label>
              <div class="form-group">
                  <input type="date" class="form-control form-control-user" name="join_date" id="exampleInputEmail"
                      placeholder="join date">
              </div>
              <div class="form-group">
                  <select name="status" id="" class="form-control">
                    <option value="">-- Status karyawan --</option>
                    <option value="tetap">Tetap</option>
                    <option value="kontrak">Kontrak</option>
                    <option value="magang">Magang</option>
                  </select>
              </div>
              
              <div class="form-group">
                  <input type="password" class="form-control form-control-user" name="pin" id="exampleInputEmail"
                      placeholder="PIN">
              </div>
              <div class="form-group">
                  <input type="password" class="form-control form-control-user" name="password" id="exampleInputEmail"
                      placeholder="Password">
              </div>
                <span>Pilih Akses :</span>
                <div class="form-group">
                    <div class="row">
                        @foreach ($menus as $menu) 
                        <div class="col-md-2">
                            <div class="custom-control custom-checkbox small">
                                <label for="">{{ $menu->menu_name}}</label>
                                <input type="checkbox" value="{{ $menu->id}}" name="menus[]"> 
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
              <button class="btn btn-primary" type="submit">Create User</button>
          </form>
          <hr>
      </div>
  </div>
</div>
@endsection