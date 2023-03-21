<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Sales Order</title>
</head>

<style>
    .line-title{
        border: 0;
        border-style: inset;
        border-top: 1px solid #000;
    }

    tr, td {
        text-align: center;
    }
</style>
<body style="background-color: white;" onload="window.print()">
    <div class="row">
        <div class="col-md-12">
            
                <table style="width: 100%; padding: 50px;">
                    <hr class="line-title">
                        <div>
                            <div style="width:80%">
                                <p align="center">
                                    Sales Order
                                </p>
                            </div> 
                        </div>
                    <hr/>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Order</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                                {{-- <th>Diskon</th> --}}
                                <th>Sub Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php $no = 1; $i = 0 @endphp
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{$d->NoOrder}}</td>
                                    <td>{{$d->NmProduk}}</td>
                                    <td>{{$d->Jumlah}}</td>
                                    <td>{{$d->Jumlah * $d->Harga}}</td>
                                    <td>{{$d->TotalBayar}}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                          </tbody>
                    </table>
                </table>
        </div>
    </div>
</body>
</html>