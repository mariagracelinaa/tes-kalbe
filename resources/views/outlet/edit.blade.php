@extends('layouts.gentelella')

@section('content')
    <form method="POST" action="{{ url('/outlet-save-edit') }}">
        @csrf
        @method('POST')
        <div class="form-group">
            <label>Kode Outlet</label>
            <input type="text" class="form-control" value="{{$outlet[0]->KdOutlet}}" disabled>
        </div>
        <input type="hidden" value="{{$outlet[0]->KdOutlet}}" id="outletCode" name="outletCode">
        <div class="form-group">
            <label>Nama Outlet</label>
            <input type="text" class="form-control" id="editOutletName" name="editOutletName" placeholder="Masukkan nama outlet" value="{{$outlet[0]->NmOutlet}}">

            @error('editOutletName')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label>Alamat Outlet</label>
            <input type="text" class="form-control" id="editOutletAddress" name="editOutletAddress"
                placeholder="Masukkan alamat outlet" value="{{$outlet[0]->Alamat}}">

            @error('editOutletAddress')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="editOutletStatus" id="editOutletStatus" class="form-control">
                @if ($outlet[0]->Aktif == 1)
                    <option value="{{$outlet[0]->Aktif}}" selected>Aktif</option>
                @else
                    <option value="{{$outlet[0]->Aktif}}">Aktif</option>
                @endif

                @if ($outlet[0]->Aktif == 0)
                    <option value="{{$outlet[0]->Aktif}}" selected>Tidak Aktif</option>
                @else
                    <option value="{{$outlet[0]->Aktif}}">Tidak Aktif</option>
                @endif
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
