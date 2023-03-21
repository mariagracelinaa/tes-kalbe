<?php

namespace App\Http\Controllers;

use App\Outlet;
use Illuminate\Http\Request;
use DB;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlets = Outlet::orderBy('Aktif','DESC')->orderBy('KdOutlet','ASC')->get();
        return view('outlet.index', compact('outlets'));
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
            $outlets = Outlet::all();
            $count = count($outlets)+1;
            
            $outlet = new Outlet();
            $outlet->KdOutlet = "Ot".$count;
            $outlet->NmOutlet = $request->get('outletName');
            $outlet->Alamat = $request->get('outletAddress');

            if($outlet->save()){
                return redirect()->route('outlet.index')->with('status','Data outlet baru berhasil disimpan');
            }else{
                return redirect()->route('outlet.index')->with('error', 'Data outlet baru gagal disimpan, silahkan coba lagi');
            }
         }catch(\PDOException $e){
            return redirect()->route('outlet.index')->with('error', 'Data outlet baru gagal disimpan, silahkan coba lagi');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function show(Outlet $outlet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function edit(Outlet $outlet)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outlet $outlet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlet $outlet)
    {
        //
    }

    public function getEditPage($id){
        $outlet = DB::table('Outlet')->where('KdOutlet','=',$id)->get();
        // dd($outlet);
        return view('outlet.edit', compact('outlet'));
    }

    public function save_edit(Request $request){
        // dd($request->all());
        try{
            DB::table('Outlet')->where('KdOutlet', '=', $request->get('outletCode'))->update(['NmOutlet' => $request->get('editOutletName') ,'Alamat' => $request->get('editOutletAddress'), 'Aktif' => $request->get('editOutletStatus')]);

            return redirect()->route('outlet.index')->with('status','Data outlet berhasil diubah');
        }catch(\PDOException $e){
            return redirect()->route('outlet.index')->with('error', 'Data outlet gagal diubah, silahkan coba lagi');
        }
    }

    public function deleteData($id){
        try{
            $delete =  DB::table('Outlet')->where('KdOutlet', '=', $id)->delete();
            
            return redirect()->route('outlet.index')->with('status','Data outlet berhasil dihapus');
        }catch(\PDOException $e){
            return redirect()->route('outlet.index')->with('error', 'Data outlet gagal dihapus, silahkan coba lagi');
        }
    }
}
