<?php

namespace App\Http\Controllers;

use App\Diskon;
use App\Outlet;
use App\Produk;
use DB;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Diskon::all();
        $outlets = Outlet::where('Aktif','=',1)->orderBy('NmOutlet','ASC')->get();
        $products = Produk::orderBy('NmProduk','ASC')->get();
        return view('diskon.index', compact('discounts','outlets','products'));
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
        // dd($request->all());
        $noSurat = Diskon::all();
        $count = count($noSurat)+1;

        $diskon_h = new Diskon();
        $diskon_h->NoSurat = "sd-".$count;
        $diskon_h->KdOutlet = $request->get('outlet');
        $diskon_h->Awal = $request->get('startDate');
        $diskon_h->Akhir = $request->get('endDate');

        if($diskon_h->save()){
            DB::table('Diskon_D')
                ->insert(['NoSurat' => $diskon_h->NoSurat, 'KdProduk' => $request->get('product'), 'Diskon' => $request->get('discount'), 'Min' => $request->get('min'), 'Max' => $request->get('max')]);
            
            return redirect()->route('diskon.index')->with('status','Data diskon baru berhasil disimpan');
        }else{
            
            return redirect()->route('diskon.index')->with('error', 'Data diskon baru gagal disimpan, silahkan coba lagi');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function show(Diskon $diskon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function edit(Diskon $diskon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diskon $diskon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diskon  $diskon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diskon $diskon)
    {
        //
    }

}
