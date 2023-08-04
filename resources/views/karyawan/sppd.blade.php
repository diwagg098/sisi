@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <form class="user" action="{{ url('/karyawan/upload')}}" method="POST" enctype="multipart/form-data">
        <span class="ml-2">Upload SPPD</span>
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="nama_file" id="exampleInputEmail"
                    placeholder="Judul File">
                </div>
            </div>
            <div class="col-6">    
                <div class="form-group">
                    <input type="file" class="" name="file">
                </div>
            </div>
        </div>
          <button type="submit" class="btn btn-primary mb-4">Upload</button>
    </form>
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
                            <th>Nama File</th>
                            <th>URL link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $row->nama_file}}</td>
                                <td><a href="{{ Storage::url($row->url) }}" target="_blank">Tautan ke File</a>                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection