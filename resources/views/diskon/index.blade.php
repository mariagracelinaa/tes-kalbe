@extends('layouts.gentelella')

@section('content')
    <form method="POST" action="{{ url('diskon') }}">
        @csrf
        <div class="form-group">
            <label>Nama Outlet</label>
            <select name="outlet" id="outlet" class="form-control">
                <option value="">-- Pilih Outlet --</option>
                @foreach ($outlets as $o)
                    <option value="{{$o->KdOutlet}}">{{$o->NmOutlet}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Nama Produk</label>
            <select name="product" id="product" class="form-control">
                <option value="">-- Pilih Outlet --</option>
                @foreach ($products as $p)
                    <option value="{{$p->KdProduk}}">{{$p->NmProduk}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tanggal Awal</label>
            <input type="date" class="form-control" id="startDate" name="startDate">
        </div>
        <div class="form-group">
            <label>Tanggal Akhir</label>
            <input type="date" class="form-control" id="endDate" name="endDate">
        </div>
        <div class="form-group">
            <label>Besar Diskon</label>
            <input type="text" class="form-control" id="discount" name="discount"
                placeholder="Masukkan harga produk" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

            @error('discount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label>Minimal Diskon</label>
            <input type="text" class="form-control" id="min" name="min"
                placeholder="Masukkan harga diskon minimal" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

            @error('min')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label>Besar Diskon</label>
            <input type="text" class="form-control" id="max" name="max"
                placeholder="Masukkan harga diskon maksimal" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

            @error('max')
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
                <th>No Surat</th>
                <th>Kode Outlet</th>
                <th>Periode Awal</th>
                <th>Periode Akhir</th>
                <th style="width: 15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($discounts as $d)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $d->NoSurat }}</td>
                    <td>{{ $d->KdOutlet }}</td>
                    <td>{{ Carbon\Carbon::parse($d->Awal)->format('d M Y') }}</td>
                    <td>{{ Carbon\Carbon::parse($d->Akhir)->format('d M Y') }}</td>
                    <td>
                        {{-- <a href="" class="btn btn-warning btn-xs">Ubah</a>
                        <form method="POST" action="">
                            @csrf
                            <input type="submit" value="Hapus" class="btn btn-danger btn-xs"
                                onclick="if(!confirm('Apakah anda yakin ingin menghapus data {{ $d->NoSurat }}')) return false">
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
