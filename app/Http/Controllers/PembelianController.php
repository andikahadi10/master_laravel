<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PembelianModel;
use App\SupplierModel;
use App\LogStokModel;
use App\StokModel;
use App\DetailPembelianModel;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.pembelian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $id_pembelian = PembelianModel::max('pembelian_id');
      $id_pembelian++;
      $jumlah = DetailPembelianModel::where('pembelian_id',$id_pembelian)->sum('pembelian_detail_jumlah');

      $ppn = '';

      if ($pajak == 'ya') {
        $ppn = ($jumlah*10)/100;
      }else{
        $ppn = 0;
      }


        $pembelian = new PembelianModel;
        $pembelian->supplier_id = $request['supplier_id'];
        $pembelian->pembelian_no_faktur = $request['pembelian_no_faktur'];
        $pembelian->pembelian_tanggal = $request['pembelian_tanggal'];
        $pembelian->pembelian_ppn_status = $request['pembelian_ppn_status'];
        $pembelian->pembelian_cara_bayar = $request['pembelian_cara_bayar'];
        $pembelian->pembelian_jumlah = $request['pembelian_jumlah'];
        $pembelian->pembelian_ppn_jumlah = $request['pembelian_ppn_jumlah'];
        $pembelian->pembelian_ongkir = $request['pembelian_ongkir'];
        $pembelian->pembelian_total = $request['pembelian_total'];
        $pembelian->save();

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
        //
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
      $pembelian = PembelianModel::find($id);
      $pembelian->suplier_id = $request['suplier_id'];
      $pembelian->pembelian_no_faktur = $request['pembelian_no_faktur'];
      $pembelian->pembelian_tanggal = $request['pembelian_tanggal'];
      $pembelian->pembelian_ppn_status = $request['pembelian_ppn_status'];
      $pembelian->pembelian_cara_bayar = $request['pembelian_cara_bayar'];
      $pembelian->pembelian_jumlah = $request['pembelian_jumlah'];
      $pembelian->pembelian_ppn_jumlah = $request['pembelian_ppn_jumlah'];
      $pembelian->pembelian_ongkir = $request['pembelian_ongkir'];
      $pembelian->pembelian_total = $request['pembelian_total'];
      $pembelian->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembelian = PembelianModel::find($id);
        $pembelian->delete();

    }

    public function listData()
    {
        $pembelian = PembelianModel::orderBy('pembelian_tanggal', 'DESC')->get();
        $no = 0;
        $data = array();
        foreach ($pembelian as $list) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->pembelian_no_faktur;
            $row[] = $list->pembelian_tanggal;
            $row[] = $list->suplier_id;
            $row[] = $list->pembelian_total;
            $row[] = '<a onclick="editForm('.$list->pembelian_id.')" class="btn btn-primary" data-toggle="tooltip" data-placement="botttom" title="Edit Data"  style="color:white;"><i class="fa  fa-edit"></i></a>
            <a onclick="deleteData('.$list->pembelian_id.')" class="btn btn-danger" data-toggle="tooltip" data-placement="botttom" title="Hapus Data" style="color:white;"><i class="fa  fa-trash"></i></a>';
            $data[] = $row;

        }

        $output = array("data" => $data);
        return response()->json($output);

    }

    public function totalBarang(Request $request)
    {
      $id_pembelian = PembelianModel::max('pembelian_id');
      $id_pembelian++;
      $pajak = $request['pajak'];
      $ongkir = $request['ongkir'];
      // $id = $request['id'];
      $jumlah = DetailPembelianModel::where('pembelian_id',$id_pembelian)->sum('pembelian_detail_jumlah');

      $ppn = '';

      if ($pajak == 'ya') {
        $ppn = ($jumlah*10)/100;
      }else{
        $ppn = 0;
      }

      $total = $jumlah+$ppn+$ongkir;

      return response()->json($total);
    }

}
