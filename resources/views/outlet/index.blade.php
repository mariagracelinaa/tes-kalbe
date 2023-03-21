@extends('layouts.gentelella')

@section('content')
    <form method="POST" action="{{ url('outlet') }}">
        @csrf
        <div class="form-group">
            <label>Nama Outlet</label>
            <input type="text" class="form-control" id="outletName" name="outletName" placeholder="Masukkan nama outlet">

            @error('outletName')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label>Alamat Outlet</label>
            <input type="text" class="form-control" id="outletAddress" name="outletAddress"
                placeholder="Masukkan alamat outlet">

            @error('outletAddress')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>
    <table id="custometable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Outlet</th>
                <th>Nama Outlet</th>
                <th>Alamat</th>
                <th>Status</th>
                <th style="width: 15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($outlets as $o)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $o->KdOutlet }}</td>
                    <td>{{ $o->NmOutlet }}</td>
                    <td>{{ $o->Alamat }}</td>
                    @if ($o->Aktif == 1)
                        <td>Aktif</td>
                    @else
                        <td>Tidak Aktif</td>
                    @endif
                    <td>
                        <a href="{{url('/outlet/edit/'.$o->KdOutlet)}}" class="btn btn-warning btn-xs">Ubah</a>
                        <form method="POST" action="{{url('/outlet-dalete/'.$o->KdOutlet)}}">
                            @csrf
                            <input type="submit" value="Hapus" class="btn btn-danger btn-xs"
                                onclick="if(!confirm('Apakah anda yakin ingin menghapus data {{ $o->NmOutlet }}')) return false">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
