<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use App\BarangModel;
use App\StokModel;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $barang = BarangModel::All();
      return view('admin.stok.index', compact('barang'));
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
      $stok = new StokModel;
      $stok ->barang_id = $request['barang_id'];
      $stok ->stok_harga_beli = $request['stok_harga_beli'];
      $stok ->stok_harga_jual = $request['stok_harga_jual'];
      $stok ->stok_jumlah = '0';
      $stok -> save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $stok = StokModel::find($id);
      echo json_encode($stok);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $stok = StokModel::find($id);
      $stok ->stok_fisik = $request['stok_fisik'];
      $stok->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $stok = StokModel::find($id);
      $stok->delete();
    }

    public function listData()
    {
        $stok = StokModel::select(DB::raw('tbl_stok.stok_id as stok_id, tbl_barang.barang_nama as barang_nama, tbl_barang.barang_kode as barang_kode, tbl_stok.stok_jumlah as stok_jumlah, tbl_stok.stok_fisik as stok_fisik, tbl_stok.updated_at as updated_at'))
                ->join('tbl_barang', 'tbl_stok.barang_id','=', 'tbl_barang.barang_id')
                ->orderBy('stok_id', 'DESC')->get();
        $no = 0;
        $data = array();
        foreach ($stok as $list) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->barang_nama." (".$list->barang_kode.")";
            $row[] = "<div align='center'>".$list->stok_jumlah."</div>";
            $row[] = "<div align='center'>".$list->stok_fisik."</div>";
            $row[] = date('d M Y - H:m:s', $list->updated_at->timestamp);
            $row[] = '<a href="'.route('log_stok.show',$list->stok_id).'" class="btn btn-success" data-toggle="tooltip" data-placement="botttom" title="Lihat Persediaan Barang"><i class="fa fa-eye"></i></a>
            <a onclick="editForm('.$list->stok_id.')" class="btn btn-primary" data-toggle="tooltip" data-placement="botttom" title="Update Stok Fisik"  style="color:white;"><i class="fa  fa-edit"></i></a>';
            $data[] = $row;

        }

        $output = array("data" => $data);
        return response()->json($output);

    }

}
