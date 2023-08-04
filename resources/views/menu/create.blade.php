@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
      <div class="p-5">
          <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Create Menu</h1>
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
          <form class="user" action="{{ url('/menu')}}" method="POST">
            @csrf
              <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="menu_name" id=""
                      placeholder="Menu Name">
              </div>
              <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="menu_link" id=""
                      placeholder="Menu Link">
              </div>
              <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="menu_icon" id=""
                      placeholder="Menu Icon">
              </div>
              <div class="form-group">
                  <select name="id_level" id="" class="form-control">
                    <option value="">-- Pilih Level --</option>
                    @foreach($data as $item)
                        <option value="{{ $item->id}}">{{ $item->level}}</option>
                    @endforeach
                  </select>
              </div>
              <button class="btn btn-primary" type="submit">Create Menu</button>
          </form>
          <hr>
      </div>
  </div>
</div>
@endsection