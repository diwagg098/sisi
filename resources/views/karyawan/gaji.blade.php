@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Data Gaji dan Denda</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Karyawan</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Gaji</th>
                <th scope="col">Denda</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @for($i = 0; $i < count($data); $i++)
                <tr>
                    <th scope="row">{{ $i + 1}}</th>
                    <td>{{ $data[$i]['nama_user']}}</td>
                    <td>{{ $data[$i]['jabatan']}}</td>
                    <td>{{ 'Rp ' . number_format($data[$i]['gaji'], 0,',','.')}}</td>
                    <td>{{ 'Rp ' . number_format($data[$i]['denda'], 0, ',','.')}}</td>
                    <td>{{ 'Rp ' . number_format($data[$i]['gaji'] - $data[$i]['denda'],0,',','.')}}</td>
                </tr>
            @endfor
        </tbody>
    </table>
</div>
@endsection