@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Karyawan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Gaji</th>
                            <th>Join Date</th>
                            <th>Status Karyawan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $row->user->nama_user }}</td>
                            <td>{{ $row->jabatan}}</td>
                            <td>{{ $row->gaji}}</td>
                            <td>{{ date('d-m-Y', strtotime($row->join_date))}}</td>
                            <td>{{ $row->status}}</td>
                            <td>
                                <a href="/karyawan/edit/{{$row->id}}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
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