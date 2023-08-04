@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-lg-12">
      <div class="p-5">
          <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Add access User</h1>
          </div>
          <form class="user" action="{{ url('/users/edit/access/' . $user->id)}}" method="POST">
            @csrf
            @method("PUT")
            <div class="form-group">
                <div class="row">
                @foreach($menu as $item)
                <div class="col-md-2">
                        <label for="">{{ $item->menu_name}}</label>
                        <input type="checkbox" value="{{ $item->id}}" name="cb[]" @if ($user_menu->contains('menu_id', $item->id))
                        checked
                        @endif> 
                    </div>
                    @endforeach
                </div>
            </div>
                <button class="btn btn-primary" type="submit">Add Access</button>
          </form>
          <hr>
      </div>
  </div>
</div>
@endsection