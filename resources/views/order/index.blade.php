@extends('layouts.gentelella')

@section('content')
    <form method="POST" action="{{ url('order') }}">
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
            <label>Tanggal Order</label>
            <input type="date" class="form-control" id="date" name="date">
        </div>
        <div class="form-group">
            <label>Jumlah</label>
            <input type="text" class="form-control" id="qty" name="qty"
                placeholder="Masukkan harga produk" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

            @error('qty')
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
                <th>No Order</th>
                <th>Kode Outlet</th>
                <th>Nama Outlet</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Total Bayar</th>
                <th style="width: 15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($orders as $o)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $o->NoOrder }}</td>
                    <td>{{ $o->KdOutlet }}</td>
                    <td>{{ $o->NmOutlet }}</td>
                    <td>{{ Carbon\Carbon::parse($o->Tanggal)->format('d M Y') }}</td>
                    @if ($o->Lunas == 1)
                        <td>Lunas</td>
                    @else
                        <td>Belum Lunas</td>
                    @endif
                    <td>{{ number_format($o->TotalBayar) }}</td>
                    <td>
                        <a href="{{url('/cetak-laporan-order/'.$o->NoOrder)}}" class="btn btn-warning btn-xs">Cetak</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
