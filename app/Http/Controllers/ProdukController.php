<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;
use DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Produk::orderBy('NmProduk','ASC')->get();
        return view('produk.index', compact('products'));
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
        try{
            $products = Produk::all();
            $count = count($products)+1;
            
            $produk = new Produk();
            $produk->KdProduk = "Pd".$count;
            $produk->NmProduk = $request->get('productName');
            $produk->HNA = $request->get('hnaProduct');

            if($produk->save()){
                return redirect()->route('produk.index')->with('status','Data produk baru berhasil disimpan');
            }else{
                return redirect()->route('produk.index')->with('error', 'Data produk baru gagal disimpan, silahkan coba lagi');
            }
         }catch(\PDOException $e){
            return redirect()->route('produk.index')->with('error', 'Data produk baru gagal disimpan, silahkan coba lagi');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        //
    }

    public function getEditPage($id){
        $produk = DB::table('produk')->where('KdProduk','=',$id)->get();
        return view('produk.edit', compact('produk'));
    }

    public function save_edit(Request $request){
        // dd($request->all());
        try{
            DB::table('produk')->where('KdProduk', '=', $request->get('productCode'))->update(['NmProduk' => $request->get('editProductName') ,'HNA' => $request->get('editHnaProduct')]);

            return redirect()->route('produk.index')->with('status','Data produk berhasil diubah');
        }catch(\PDOException $e){
            return redirect()->route('produk.index')->with('error', 'Data produk gagal diubah, silahkan coba lagi');
        }
    }

    public function deleteData($id){
        try{
            $delete =  DB::table('produk')->where('KdProduk', '=', $id)->delete();
            
            return redirect()->route('produk.index')->with('status','Data produk berhasil dihapus');
        }catch(\PDOException $e){
            return redirect()->route('produk.index')->with('error', 'Data produk gagal dihapus, silahkan coba lagi');
        }
    }
}
