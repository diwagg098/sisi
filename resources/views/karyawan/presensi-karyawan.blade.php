@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Presensi Karyawan</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <form action="{{ url('/karyawan/ambil-absen')}}" method="POST">
                        @csrf
                        <div class="d-inline">
                            <div class="mb-3">
                                <div class="">
                                    <label for="">Tanggal</label>
                                    <input type="date" name="tanggal" max="{{ now()->toDateString()}}" class="form-control">
                                    <input type="hidden" name="id_karyawan" value="{{ $karyawan->id}}">
                                    <button type="submit" class="btn btn-primary mt-2">Ambil Absen</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col">
            <form action="{{ url('/cuti/submit-leave')}}" method="POST">
                @csrf
                <div class="d-inline">
                    <div class="mb-3">
                        <div class="">
                            <label for="">Ajukan Cuti</label>
                            <input type="date" name="tanggal" min="{{ now()->toDateString()}}" class="form-control">
                            <input type="hidden" name="id_karyawan" value="{{ $karyawan->id}}">
                            <input type="text" name="reason" class="form-control mt-2" placeholder="alasan cuti">
                            <button type="submit" class="btn btn-primary mt-2">Ajukan Cuti</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
            <h2 class="text-center">Rekap Absensi</h2>
            <div class="table-responsive p-4">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Waktu keterlambatan</th>
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($absensi as $row)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $row->tanggal }}</td>
                            <td>{{ $row->status}}</td>
                            <td>{{ $row->waktu_keterlambatan}}</td>
                            <td>{{ 'Rp ' . number_format($row->denda, 0, ',','.')}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <h2 class="text-center">Pengajuan Cuti</h2>
            <div class="table-responsive p-4">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Alasan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($leaves as $row)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $row->tanggal }}</td>
                            <td>{{ $row->reason}}</td>
                            <td>{{ $row->status}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection