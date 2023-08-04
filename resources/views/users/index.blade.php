@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="/users/add-user" class="btn btn-primary">add user</a>
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Access</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $row->nama_user }}</td>
                            <td>{{ $row->email}}</td>
                            <td>{{ $row->username}}</td>
                            <td>{{ count($row->menuUsers) }}</td>
                            <td>
                                <div class="">
                                    <a href="/users/edit/{{$row->id}}" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <a href="/users/edit/access/{{$row->id}}" class="btn btn-info btn-circle btn-sm">
                                        <i class="fa-solid fa-gear"></i>
                                    </a>
                                    <form action="{{ url('/users/delete/' . $row->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
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