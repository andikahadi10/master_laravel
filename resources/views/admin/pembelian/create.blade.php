<?php $hal = "pembelian"; ?>
@extends('layouts.admin.master')
@section('title', 'Pembelian')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('public/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

<style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>

@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Pembelian
    <!-- <small>Data barang</small> -->
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">


    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Belanja Barang</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <form role="form" class="form_belanja" action="{{route('detail_pembelian2.store')}}" method="post">
              {{ csrf_field() }} {{ method_field('POST') }}
            <div class="box-body">
              <div class="form-group col-md-12 " style="border:1px solid black;">

                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Nama Penyedia</label>
                    <select name="id_penyedia" class="form-control" style="width: 100%;">
                      @foreach ($supplier as $list)
                        <option value="{{$list->supplier_id}}">{{$list->supplier_nama}}</option>
                      @endforeach
                    </select>
                  </div>


                  <div class="form-group  col-md-6">
                    <label for="exampleInputPassword1">Pajak</label>
                    <select class="form-control" id="pembelian_ppn_status" name="pembelian_ppn_status">
                      <option value="ya" selected>PPN</option>
                      <option value="tidak">NON PPN</option>

                    </select>
                </div>

                </div>

                  <div class="row">
                  <div class="form-group  col-md-6">
                    <label for="exampleInputPassword1">Nomor Transaksi</label>
                    <input type="text"  name="nomor" class="form-control" value="" id="">
                  </div>
                  <div class="form-group  col-md-6">
                    <label for="exampleInputPassword1">Tanggal Transaksi</label>
                    <input type="text"  name="tanggal" class="form-control dateinput" value="<?=date('d-m-Y');?>" id="">
                  </div>

                  <!-- <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Jenis Belanja</label>
                    <select name="id_jenis_belanja" class="form-control " style="width: 100%;">

                    </select>
                  </div> -->

                  <div class="form-group  col-md-2">
                    <label for="exampleInputPassword1">Total</label>
                    <input type="number" readonly="" class="form-control text-right money" value="0"  name="bruto" placeholder="">
                    <label class="fmt-nominal pull-right" >0,00</label>
                  </div>
                   <div class="form-group col-md-2 hidden">
                    <label for="exampleInputPassword1">Potongan</label>
                    <input type="number" class="form-control text-right money" value="0"  name="potongan" placeholder="" required>
                    <label class="fmt-nominal pull-right" >0,00</label>
                  </div>
                   <div class="form-group col-md-2 hidden">
                    <label for="exampleInputPassword1">Bunga</label>
                    <input type="number" class="form-control text-right money" value="0"  name="bunga" placeholder="" required>
                    <label class="fmt-nominal pull-right" >0,00</label>
                  </div>
                   <div class="form-group  col-md-2">
                    <label for="exampleInputPassword1">Ongkir</label>
                    <input type="number" class="form-control text-right money" value="0"  name="ongkir" id="ongkir" placeholder="">
                    <label class="fmt-nominal pull-right" >0,00</label>
                  </div>
                   <div class="form-group  col-md-2">
                    <label for="exampleInputPassword1">Pembayaran</label>
                    <select class="form-control" name="pembayaran">
                      <option value="tunai" selected>Tunai</option>
                      <option value="kredit">Kredit</option>
                    </select>
                    {{-- <input type="number" class="form-control text-right money" readonly="" value="0"  name="bayar" placeholder=""> --}}
                    {{-- <label class="fmt-nominal pull-right" >0,00</label> --}}
                  </div>
                  <div class="form-group  col-md-2">
                    <label for="exampleInputPassword1">Jumlah Pajak</label>
                    <input type="number" class="form-control text-right money" readonly=""  value="0"  name="jmlPajak" placeholder="">
                    <label class="fmt-nominal pull-right" >0,00</label>
                  </div>
                  <div class="form-group  col-md-2 hide">
                    <label for="exampleInputPassword1">Dana</label>
                    <input type="number" class="form-control text-right money" readonly=""  value="0"  id="nominal_sumber_dana" placeholder="">
                    <label class="fmt-nominal pull-right" >0,00</label>
                  </div>
                  <div class="form-group  col-md-2 hide">
                    <label for="exampleInputPassword1">Sisa</label>
                    <input type="number" class="form-control text-right money" readonly=""  value="0"  id="sisa" placeholder="">
                    <label class="fmt-nominal pull-right" >0,00</label>
                  </div>
                </div> <!-- end : row -->
              </div>

              <div class="form-group col-md-12" style="border:1px solid black;">
               <h3>Detail Barang</h3>
               <hr/>

               <a href="javascript:;" class=" btn btn-sm btn-success btn_tambah" > Tambah Barang</a>
               <br/> <br/>
               <table class="table table-bordered table-hover table-striped table-barang">
                <thead>
                  <tr>

                    <th>Nama Barang</th>
                    <!-- <th>Satuan</th> -->
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                  <tr class="footernull">
                    <td colspan="6" align="center">Tidak Ada Data</td>
                  </tr>
                  <tr class="footercount" style="display: none;">
                    <td  colspan="4" align="center" ></td>
                    <td  align="right" class="total"></td>
                    <td></td>
                  </tr>
                </tfoot>
              </table>

            </div>

            <!-- div class="form-group  col-md-12">
              <div class="row">
                <div class="form-group col-md-12">

                    <label class="fmt-nominal pull-right">0,00</label>
                  </div>
                </div>
              </div> <-- end .row -->

            <!-- </div> -->


        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="" class="btn btn-md btn-warning">Kembali</a>
          <button type="submit" class="btn bg-blue btn-md pull-right"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>
        </div>

      </form>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
<!-- /.row (main row) -->



</section>

<!-- /.content -->
@include('admin.pembelian.form2')
@endsection


@section('js')
<!-- DataTables -->
<script src="{{asset('public/admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('public/admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('public/js/accounting.js')}}" charset="utf-8"></script>

<script type="text/javascript">

var formBarang = $(".form_barang");

  var formBelanja = $(".form_belanja");
  var selectPajak = formBelanja.find("select[name=pajak]");
  var inputOngkir = formBelanja.find("input[name=status_ongkir]");
  var inputNominalOngkir = formBelanja.find("input[name=nominal_ongkir]");

  $(function () {
    accounting.settings = {
          currency: {
                  symbol: "",
                  precision: 2,
                  thousand: ".",
                  decimal : ",",
                  format: {
                      pos : '%s %v',
                      neg : '%s (%v)',
                      zero : '%s %v'
                  },
          },
          number: {
            precision : 0,  // default precision on numbers is 0
            thousand: ".",
            decimal : ","
          }
    };

    var rowtempx=null;
    $('.select2').select2();


    $('#id_barang').on('change', function(e){
        var state_id = e.target.value;

        $.get('{{ url('get_data_barang') }}'+ '/' + state_id, function(data) {
            $('#barang_harga').empty();
            // $.each(data, function(index,subCatObj){
            //     $('#barang_harga').val(''+subCatObj.log_stok_saldo_harga+'');
            // });
                $('#barang_harga').val(''+data.log_stok_saldo_harga+'');
        });
    });
    // $(document).on("change", ".form_barang select[name=id_barang]", function(){
    //   var idbarang = $(this).val();
    //   $.ajax({
    //     url : "",
    //     type : "post",
    //     data : { id_barang : idbarang },
    //     dataType : "json",
    //     success : function (result) {
    //       console.log(result);
    //       $(".form_barang select[name=barang_harga]").html("");
    //       // create the option and append to Select2
    //       $.each(result, function(id, val){
    //         var option = $('<option/>');
    //         option.attr({
    //           'value': val.id,
    //           'data-beli' : val.harga_beli,
    //           'data-jual' : val.harga,
    //         }).text( "Harga Beli : "+accounting.formatMoney(val.harga_beli)+" - Harga Jual : "+accounting.formatMoney(val.harga) );
    //         $(".form_barang select[name=barang_harga]").append(option).trigger('change');
    //       })
    //     }
    //   });
    // });

    $(document).on("click",".btn_tambah",function(e){
      $('.form_barang')[0].reset();
      $('.form_barang select').val([]).change();
      $('.form_barang input[name=crud]').val("tambah");
      $('.form_barang input[type=number]').val(0).keyup();
      $('#modal-form').modal('show');
      // showModal('#modal-form');
      rowtempx=null;
    });

    $(document).on("click",".btn_edit",function(e){
      $('.form_barang')[0].reset();
      $('.form_barang select').val([]).change();
      $('.form_barang input[name=crud]').val("edit");
      // var id_satuan=$(this).attr('id_satuan');
      // var harga_satuan=$(this).attr('harga_satuan');
      var id_barang=$(this).attr('id_barang');
      var barang_harga=$(this).attr('barang_harga');
      var total=$(this).attr('total');
      var jumlah=$(this).attr('jumlah');
      // $('.form_barang select[name=id_satuan]').val(id_satuan).change();
      // $('.form_barang input[name=harga_satuan]').val(harga_satuan).keyup();
      $('.form_barang select[name=id_barang]').val(id_barang).change();
      $('.form_barang select[name=barang_harga]').val(barang_harga).change();
      $('.form_barang input[name=jumlah]').val(jumlah).keyup();
      // $('.form_barang input[name=total]').val(total).keyup();

      rowtempx=$(this).parents('tr');
      console.log(rowtempx);
      showModal("#modal-form");

    });

    $(document).on("submit",".form_barang",function(e){
      var crud = $('.form_barang input[name=crud]').val();
      var id_barang = $('.form_barang select[name=id_barang]').val();
      var nama_barang = $('.form_barang select[name=id_barang] option:selected').text();
      // var id_satuan = $('.form_barang select[name=id_satuan]').val();
      // var nama_satuan = $('.form_barang select[name=id_satuan] option:selected').text();
      // var harga_satuan = $('.form_barang input[name=harga_satuan]').val();
      // var barang_harga = $('.form_barang select[name=barang_harga] > option:selected');
      var diskon = $('.form_barang input[name=diskon]').val();
      var barang_harga = $('.form_barang input[name=barang_harga]').val();
      var jumlah = $('.form_barang input[name=jumlah]').val();
      var total = $('.form_barang input[name=total]').val();
      var attr=" nama_barang='"+nama_barang+"' id_barang='"+id_barang+"' total='"+total+"' jumlah='"+jumlah+"'  barang_harga='"+barang_harga+"' ";
      var row=""+
      // "<td>"+nama_barang+"<input type='hidden' readonly='' value='"+id_barang+"' name='id_barang[]' ><input type='hidden' readonly='' value='"+barang_harga.val()+"' name='barang_harga[]' ></td>"+
      "<td>"+nama_barang+"<input type='hidden' readonly='' value='"+id_barang+"' name='id_barang[]' ><input type='hidden' readonly='' value='"+barang_harga+"' name='barang_harga[]' ></td>"+
      // "<td>"+nama_satuan+"<input type='hidden' readonly='' value='"+id_satuan+"' name='id_satuan[]' ></td>"+
      // "<td class='text-right'><input type='' readonly value='"+50+"' class='text-right' name='harga_satuan[]' style='background:none;border:0;'></td>"+
      // "<td class='text-right'><input type='' readonly value='"+accounting.formatMoney(barang_harga.data('beli'))+"' class='text-right' name='harga_satuan[]' style='background:none;border:0;'></td>"+
      "<td class='text-right'><input type='' readonly value='"+accounting.formatMoney(barang_harga)+"' class='text-right' name='' style='background:none;border:0;'></td>"+
      "<td class='text-right'><input type='hidden' readonly value='"+parseFloat(accounting.unformat(barang_harga))+"' class='text-right' name='harga_satuan[]' style='background:none;border:0;'></td>"+
      "<td class='text-right'><input type='hidden' readonly value='"+parseFloat(accounting.unformat(diskon))+"' class='text-right' name='diskon[]' style='background:none;border:0;'></td>"+
      // "<td class='text-right'><input type='' readonly value='"+6+"' class='text-right' name='jumlah[]' style='background:none;border:0;'></td>"+
      "<td class='text-right'><input type='' readonly value='"+accounting.formatNumber(jumlah)+"' class='text-right' name='jumlah[]' style='background:none;border:0;'></td>"+
      // "<td class='text-right'><input type='' readonly value='"+60+"' class='text-right' name='tot[]' style='background:none;border:0;'></td>"+
      "<td class='text-right'><input type='' readonly value='"+accounting.formatMoney(total)+"' class='text-right' name='tot[]' style='background:none;border:0;'></td>"+
      "<td><a class='btn btn-warning btn-xs btn_edit' "+attr+"><span class='fa fa-pencil'></span> </a> <a class='btn btn-danger btn-xs btn_del'><span class='fa fa-trash'></span> </a></td>";

    if(crud=="tambah"){
      $('table.table-barang tbody').append("<tr>"+row+"</tr>");

     }else if(crud=="edit"){
      $(rowtempx).html(row);

    }

    $('#modal-form').modal('hide');
    rowtempx=null;
    reload_table();

  });

    //auto
    $(document).on("keyup"," input.money",function(e){
      setFormatMoney($(this));
    });
    $(document).on("keyup"," input.nocoma",function(e){
      setFormatThous($(this));
    });

    $(document).on("keyup"," input[name=potongan], input[name=bunga]",function(e){
      reload_table();
    });

    $(document).on("keyup",".form_barang input[name=jumlah]",function(e){
      totalCountBarang();
    });

    $(document).on("keyup",".form_barang input[name=diskon]",function(e){
      totalCountBarang();
    });
    $(document).on("change",".form_barang select[name=barang_harga]",function(e){
      totalCountBarang();
    });

    $(document).on("click"," .btn_del",function(e){
      $(this).parents('tr').remove();
      reload_table();
    });

    function reload_table(){
      //  console.log(accounting.unformat("€ 1.000.000,00", ",")); // 1000000
      var rowbarang = $('table.table-barang > tbody > tr').length;
      var xbarang = 0;

      $('.table-barang input[name="tot[]"]').each(function() {
        xbarang+=parseFloat(accounting.unformat($(this).val(),","));
        console.log(xbarang);
      });

      $('table.table-barang  tfoot tr.footercount .total ').html(accounting.formatMoney(xbarang));
      // $('table.table-pembayaran  tfoot tr.footercount .total ').html(accounting.formatMoney(xbayar));
      $('.form_barang select[name=id_barang]').val(id_barang).change();
      // $('.form_belanja input[name=bayar]').val(xbayar).keyup();

      pajak=$("#pembelian_ppn_status").val();
      ongkir=parseInt($("#ongkir").val());
      bunga=parseInt($(".form_belanja  input[name=bunga]").val());
      bruto=xbarang;
      // netto=(bruto+bunga)-potongan;
      jmlPajak=0;
      totalAkhir=0;
      if (pajak == "ya") {
        jmlPajak = (bruto*10)/100;
        totalAkhir = bruto + jmlPajak + ongkir;
      }else {
        jmlPajak = 0;
        totalAkhir = bruto + jmlPajak + ongkir;
      }

      $('.form_belanja input[name=bruto]').val(totalAkhir).keyup();

      $(".form_belanja input[name=jmlPajak]").val(jmlPajak).keyup();
      // $(".form_belanja input[name=kekurangan]").val(netto).keyup();

      if(rowbarang>0){
        $('table.table-barang  tfoot tr.footernull ').hide();
        $('table.table-barang  tfoot tr.footercount ').show();
      }else{
        $('table.table-barang  tfoot tr.footernull ').show();
        $('table.table-barang  tfoot tr.footercount ').hide();
      }
  }

  function setFormatMoney(this_)
  {
    var nilai = this_.val();
    var helpBlock = this_.parent('div').find(".fmt-nominal");
    helpBlock.html(accounting.formatMoney(nilai));
  }

  function setFormatThous(this_) {
    var nilai = this_.val();
    var helpBlock = this_.parent('div').find(".fmt-nominal");
    helpBlock.html(accounting.formatNumber(nilai));
  }

  function totalCountBarang() {
    // var harga_beli = formBarang.find("select[name=barang_harga] > option:selected").data("beli");
    // harga_satuan=parseInt(harga_beli);
    harga_satuan=parseInt($(".form_barang input[name=barang_harga]").val());
    jumlah=parseInt($(".form_barang input[name=jumlah]").val());
    diskon=parseInt($(".form_barang input[name=diskon]").val());

    $(".form_barang input[name=total]").val((jumlah * harga_satuan)-((jumlah * harga_satuan) * (diskon/100))).keyup();
  }


});
</script>

@endsection
