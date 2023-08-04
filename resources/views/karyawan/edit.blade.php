@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
      <div class="p-5">
          <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Edit Karyawan</h1>
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
          <form class="user" action="{{ url('/karyawan/update/' . $data->id)}}" method="POST">
            @method('PUT')
            @csrf
              <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                      placeholder="Nama" disabled>
              </div>
              <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="jabatan" id="exampleInputEmail"
                      placeholder="jabatan" value="{{ $data->jabatan}}">
              </div>
              <div class="form-group">
                  <input type="number" class="form-control form-control-user" name="gaji" id="exampleInputEmail"
                      placeholder="gaji/bulan" value="{{ $data->gaji}}">
              </div>
              <label for="">join date</label>
              <div class="form-group">
                  <input type="date" class="form-control form-control-user" name="join_date" id="exampleInputEmail"
                      placeholder="join date" value="{{ date('Y-m-d', strtotime($data->join_date))}}">
              </div>
              <div class="form-group">
                  <select name="status" id="" class="form-control">
                    <option value="{{ $data->status}}">{{ $data->status}}</option>
                    <option value="tetap">Tetap</option>
                    <option value="kontrak">Kontrak</option>
                    <option value="magang">Magang</option>
                  </select>
              </div>
              <button class="btn btn-primary" type="submit">update karyawan</button>
          </form>
          <hr>
      </div>
  </div>
</div>
@endsection