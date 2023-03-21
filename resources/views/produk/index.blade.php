@extends('layouts.gentelella')

@section('content')
    <form method="POST" action="{{ url('produk') }}">
        @csrf
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" class="form-control" id="productName" name="productName" placeholder="Masukkan nama produk">

            @error('productName')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="text" class="form-control" id="hnaProduct" name="hnaProduct"
                placeholder="Masukkan harga produk" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

            @error('hnaProduct')
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
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>HNA</th>
                <th style="width: 15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($products as $p)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $p->KdProduk }}</td>
                    <td>{{ $p->NmProduk }}</td>
                    <td>{{ number_format($p->HNA) }}</td>
                    <td>
                        <a href="{{url('/produk/edit/'.$p->KdProduk)}}" class="btn btn-warning btn-xs">Ubah</a>
                        <form method="POST" action="{{url('/produk-dalete/'.$p->KdProduk)}}">
                            @csrf
                            <input type="submit" value="Hapus" class="btn btn-danger btn-xs"
                                onclick="if(!confirm('Apakah anda yakin ingin menghapus data {{ $p->NmProduk }}')) return false">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
