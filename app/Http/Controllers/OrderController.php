<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Outlet;
use App\Produk;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $orders = Order::orderBy('NoOrder','DESC')->get();
        $orders = DB::table('Order_H')->join('Outlet','Outlet.KdOutlet','=','Order_H.KdOutlet')->select('Order_H.*','Outlet.NmOutlet')->get();
        // dd($orders);
        $outlets = Outlet::where('Aktif','=',1)->orderBy('NmOutlet','ASC')->get();
        $products = Produk::orderBy('NmProduk','ASC')->get();
        return view('order.index', compact('orders', 'outlets','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Hanya bs 1 produk, jika lebih dari 1 produk maka semua dimasukkan ke foreach. Di viewnya bagian atribut name produk diubah jadi list.
        // Lalu NoOrderDt diisikan nomor urut produk di order yg diinput
        $data_diskon = DB::table('Diskon_D')
                    ->join('Diskon_H','Diskon_H.NoSurat','=','Diskon_D.NoSurat')
                    ->join('Outlet','Outlet.KdOutlet','=','Diskon_H.KdOutlet')
                    ->select('Diskon_D.Diskon as diskon','Diskon_D.Min as min','Diskon_D.Max as max')
                    ->where('Diskon_D.KdProduk','=',$request->get('product'))
                    ->where('Diskon_H.KdOutlet','=',$request->get('outlet'))
                    ->get();

        $data_product = DB::table('produk')->where('KdProduk','=', $request->get('product'))->get();

        $before_disc = $request->get('qty') * $data_product[0]->HNA;
        $disc = $before_disc*($data_diskon[0]->diskon/100);

        if($disc > $data_diskon[0]->max){
            $disc = $data_diskon[0]->max;
        }else if ($disc < $data_diskon[0]->min){
            $disc = $data_diskon[0]->min;
        }

        $totalBayar = $before_disc - $disc;

        //  ----------------------------------------------------------------------

        $current_year = date('Y');
        $count = DB::table('Order_H')->select(DB::raw('COUNT(*) as count'))->whereYear('Tanggal','=',$current_year)->get();
        $count = $count[0]->count+1;
        $order_h = new Order();
        $order_h->NoOrder = "ORD-".$current_year."-".$count;
        $order_h->KdOutlet = $request->get('outlet');
        $order_h->Tanggal =  $request->get('date');
        $order_h->Lunas = 0;
        $order_h->TotalBayar = $totalBayar;
        
        if($order_h->save()){
            $order_d = DB::table('Order_D')
                    ->insert(['NoOrder' => $order_h->NoOrder, 'KdProduk' => $request->get('product'), 'NoOrderDt' => 1, 'Jumlah' => $request->get('qty'), 'Harga' => $data_product[0]->HNA]);
            return redirect()->route('order.index')->with('status','Data order baru berhasil disimpan');
        }else{
            
            return redirect()->route('order.index')->with('error', 'Data order baru gagal disimpan, silahkan coba lagi');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    // Cetak laporan penghapusan buku
    public function printReport($id){
        $data = DB::table('Outlet')
                ->join('Order_H', 'Outlet.KdOutlet','=','Order_H.KdOutlet')
                ->join('Order_D','Order_D.NoOrder','=','Order_H.NoOrder')
                ->join('produk','produk.KdProduk','=','Order_D.KdProduk')
                ->select('Outlet.*','Order_H.*','Order_D.*','Produk.*')
                ->where('Order_H.NoOrder','=',$id)
                ->get();
        // dd($data);
                
        return view('report.printReport', compact('data'));
    }
}
