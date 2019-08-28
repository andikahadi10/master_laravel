<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PembelianModel;
use App\SupplierModel;
use App\LogStokModel;
use App\StokModel;
use App\DetailPembelianModel;

class DetailPembelian2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


      $supplier = SupplierModel::orderBy('supplier_nama','DESC')->get();
      $barang = LogStokModel::select('barang_nama','tbl_barang.barang_id')->join('tbl_stok','tbl_stok.stok_id','tbl_log_stok.stok_id')
                ->join('tbl_barang','tbl_stok.barang_id','tbl_barang.barang_id')->get();

        return view('admin.pembelian.create',compact('supplier','barang','id_pembelian'));

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
      $pembelian = new PembelianModel;
      $pembelian->supplier_id = $request['id_penyedia'];
      $pembelian->pembelian_no_faktur = $request['nomor'];
      $pembelian->pembelian_tanggal = date('Y-m-d',strtotime($request['tanggal']));
      $pembelian->pembelian_ppn_status = $request['pembelian_ppn_status'];
      $pembelian->pembelian_cara_bayar = $request['pembayaran'];
      $pembelian->pembelian_jumlah = $request['pembelian_jumlah'];
      $pembelian->pembelian_ppn_jumlah = $request['jmlPajak'];
      $pembelian->pembelian_ongkir = $request['ongkir'];
      $pembelian->pembelian_total = $request['bruto'];
      // $pembelian->save();

      $id_pembelian = $pembelian->pembelian_id;

      // $detail_pembelian = new DetailPembelianModel;
      // return $detail_pembelian = $request['harga_satuan'];
      $barang_ids = $request->id_barang;
      $satuan = $request->harga_satuan;
      $jumlah = $request->jumlah;
      $total = $request->tot;

      $data = [];
      foreach($barang_ids as $key => $barang_id) {
          $data[] = [
              'barang_id' => $barang_id,
              'id_pembelian' => $id_pembelian,
              'pembelian_detail_qty' => $jumlah[$key],
              'pembelian_detail_harga' => $satuan[$key],
              'pembelian_detail_diskon' => $satuan[$key],
              'pembelian_detail_jumlah' => $total[$key]
          ];
      }
     DetailPembelianModel::insert($data);
    // dd($data);
      // $detail_pembelian->barang_id = $request['barang_id'];
      // $detail_pembelian->pembelian_detail_qty = $request['pembelian_detail_qty'];
      // $detail_pembelian->pembelian_detail_harga = $request['pembelian_detail_harga'];
      // $detail_pembelian->pembelian_detail_diskon = $request['pembelian_detail_diskon'];
      // $detail_pembelian->pembelian_detail_jumlah = $request['pembelian_detail_jumlah'];
      // $detail_pembelian->save();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
