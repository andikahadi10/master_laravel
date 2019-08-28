<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use App\BarangModel;
use App\SatuanModel;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = BarangModel::where('barang_id_parent','=','0')->get();
        $satuan = SatuanModel::orderBy('satuan_id', 'DESC')->get();
        return view('admin.barang.index', compact('barang','satuan'));
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
      $barang = new BarangModel;
      $barang ->barang_kode = $request['barang_kode'];
      $barang ->barang_nama = $request['barang_nama'];
      $barang ->barang_id_parent = $request['barang_id_parent'];
      $barang ->satuan_id = $request['satuan_id'];
      $barang ->barang_status_bahan = $request['barang_status_bahan'];
      $barang -> save();
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
      $barang = BarangModel::find($id);
      echo json_encode($barang);
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
      $barang = BarangModel::find($id);
      $barang ->barang_kode = $request['barang_kode'];
      $barang ->barang_nama = $request['barang_nama'];
      $barang ->barang_id_parent = $request['barang_id_parent'];
      $barang ->satuan_id = $request['satuan_id'];
      $barang ->barang_status_bahan = $request['barang_status_bahan'];
      $barang->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = BarangModel::find($id);
        $barang->delete();
    }

    public function listData()
    {
        $barang = BarangModel::join('tbl_satuan','tbl_satuan.satuan_id','=','tbl_barang.satuan_id')->orderBy('barang_id', 'DESC')->get();
        $no = 0;
        $data = array();
        $bahan = "";
        foreach ($barang as $list) {

          $barang_id = $list->barang_id_parent;
          if ($barang_id!=0) {
            $nama_barang = BarangModel::where('barang_id', '=', $barang_id)->value('barang_nama');
          }else {
            $nama_barang = "--";
          }

          if ($list->barang_status_bahan=="1") {
            $bahan = "Bahan Baku";
          }elseif ($list->barang_status_bahan=="2") {
            $bahan = "Pendukung";
          }


            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->barang_kode;
            $row[] = $list->barang_nama;
            $row[] = $nama_barang;
            $row[] = $list->satuan_nama;
            $row[] = $bahan;
            $row[] = '<a href="'.route('detail_harga_barang.show',$list->barang_id).'" class="btn btn-success" data-toggle="tooltip" data-placement="botttom" title="Detail Harga Barang"><i class="fa fa-eye"></i></a>
            <a onclick="editForm('.$list->barang_id.')" class="btn btn-primary" data-toggle="tooltip" data-placement="botttom" title="Edit Data"  style="color:white;"><i class="fa  fa-edit"></i></a>
            <a onclick="deleteData('.$list->barang_id.')" class="btn btn-danger" data-toggle="tooltip" data-placement="botttom" title="Hapus Data" style="color:white;"><i class="fa  fa-trash"></i></a>';
            $data[] = $row;

        }

        $output = array("data" => $data);
        return response()->json($output);

    }

}
