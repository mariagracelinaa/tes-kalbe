@extends('layouts.gentelella')

@section('content')
    <form method="POST" action="{{ url('/produk-save-edit') }}">
        @csrf
        <div class="form-group">
            <label>Kode Produk</label>
            <input type="text" class="form-control" value="{{$produk[0]->KdProduk}}" disabled>
        </div>
        <input type="hidden" value="{{$produk[0]->KdProduk}}" id="productCode" name="productCode">
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" class="form-control" id="editProductName" name="editProductName" placeholder="Masukkan nama produk" value="{{$produk[0]->NmProduk}}">

            @error('editProductName')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="text" class="form-control" id="editHnaProduct" name="editHnaProduct" placeholder="Masukkan harga produk"
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="{{$produk[0]->HNA}}">

            @error('editHnaProduct')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
