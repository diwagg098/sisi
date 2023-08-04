@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Menu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="/menu/create" class="btn btn-primary">add menu</a>
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Menu Name</th>
                            <th>Level</th>
                            <th>Link</th>
                            <th>Menu Icon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $row->menu_name }}</td>
                            <td>{{ $row->level->level}}</td>
                            <td>{{ $row->menu_link}}</td>
                            <td>{{ $row->menu_icon }}</td>
                            <td>
                                <div class="">
                                    <a href="/menu/edit/{{$row->id}}" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <form action="{{ url('/menu/' . $row->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-circle btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection