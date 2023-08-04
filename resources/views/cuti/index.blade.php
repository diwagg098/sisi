@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Leaves</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Tanggal Cuti</th>
                            <th>Alasan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $row->nama_user }}</td>
                            <td>{{ $row->jabatan}}</td>
                            <td>{{ date('d-m-Y', strtotime($row->tanggal))}}</td>
                            <td>{{ $row->reason}}</td>
                            <td>{{ $row->status}}</td>
                            <td>
                                @if ($row->status == "PENDING")
                                <form action="{{ url('/cuti/approve')}}" method="POST">
                                    @csrf
                                    <input type="text" value="{{ $row->id}}" name="id_cuti" hidden>
                                    <input type="hidden" value="approved" name="status">
                                    <button type="submit" class="btn btn-success btn-circle btn-sm">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                                @endif
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