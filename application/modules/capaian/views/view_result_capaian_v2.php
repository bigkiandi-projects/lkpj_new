<style type="text/css">
	table.table-bordered > thead > tr > th{
      border:0.5px solid #c8c8c8;
      text-align: center;
      vertical-align: middle;
      background-color: #605ca8;
      color: #fff;
  	}
  	table.table-bordered > tbody > tr > td{
    	border:0.5px solid #c8c8c8;
  	}
    table.dataTable th {
        font-size: 0.9em;
    }
    table.dataTable td {
        font-size: 0.9em;
    }
    table.dataTable tr.opede {
        background-color: #9f9dca;
        font-weight: bold;
    }
    table.dataTable tr.prog {
        background-color: #bfbddc;
        font-weight: bold;
    }
    table.dataTable tr.keg {
        background-color: #dfdeed;
        font-weight: bold;
    }
    .info-card h4 {
        font-weight: bold;
        font-size: 30px;
    }
    
</style>

<?php

function fetch_opd($cp){

    foreach($cp as $op){

        echo    "<tr class='opede'>";
        echo    "<td>".$op->kdOpd."</td>";
        echo    "<td colspan='6'>".$op->nmOpd."</td>";
        echo    "<td style='display: none;'></td>
                <td style='display: none;'></td>
                <td style='display: none;'></td>
                <td style='display: none;'></td>
                <td style='display: none;'></td>";
        echo    "<td class='al-opd text-right' id-opd='".$op->kdOpd."'>A</td>";
        echo    "<td class='opd2 text-right' id-opd='".$op->kdOpd."'>R</td>";
        echo    "<td class='opd_persen text-right'>P</td>";
        echo    "<td style='display: none;'></td>";
        echo    "<td></td>
                <td></td>
                <td></td>";
        echo    "<td width='70'>
                </td>
             </tr>";

        if(!empty($op->sub)){

            fetch_bid($op->sub, $op->kdOpd);
        }

    }

}

function fetch_bid($cp, $kdOpd){

    foreach($cp as $bid) {
        // echo "<tr><td colspan='5'><i>".$bid->nmBid."</i></td></tr>";
        if(!empty($bid->sub)){
            fetch_prog($bid->sub, $kdOpd);
        }

    }

}

function fetch_prog($cp, $kdOpd) {

    foreach($cp as $prg) {

        echo    "<tr class='prog'>
                <td>".$prg->kd."</td>";
        echo    "<td colspan='6'>".$prg->program."</td>";
        echo    '<td style="display: none;"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>';
        echo    "<td class='prg text-right' id='".$prg->kd."' data-opd='".$kdOpd."'>A</td>";
        echo    "<td class='prg2 text-right' id='".$prg->kd."' data-opd2='".$kdOpd."'>R</td>";
        echo    "<td class='prg_persen text-right'>P</td>
                <td style='display: none;'></td>
                <td></td>
                <td></td>
                <td></td>";

        echo    "<td width='70'>
                    <div class='btn-group'>
                        <a class='btn btn-primary btn-flat btn-sm' data-toggle='modal' data-target='#indimodal' data-url='".base_url('capaian/edit_indikator/').$prg->idCapai."'><span class='glyphicon glyphicon-edit'></span></a>
                        <a data-href='".base_url('capaian/hapus_cp/').$prg->idCapai."' class='btn btn-danger btn-flat btn-sm hapus'><span class='glyphicon glyphicon-trash'></span></a>
                    </div>
                </td>";
        echo    "</tr>";

        if(!empty($prg->sub)){

            fetch_keg($prg->sub, $prg->kd);
        }

    }

}

function fetch_keg($cp, $kd){

    foreach($cp as $kgt){

        echo    "<tr class='keg'>";
        echo    "<td>".$kgt->kd."</td>";
        echo    "<td colspan='6'>".$kgt->program."</td>";
        echo    "<td style='display: none;'></td>
                <td style='display: none;'></td>
                <td style='display: none;'></td>
                <td style='display: none;'></td>
                <td style='display: none;'></td>";
        echo    "<td class='kgt text-right' data-kd='".$kd."'>A</td>";
        echo    "<td class='kgt-real text-right' data-kd2='".$kd."'>R</td>";
        echo    "<td class='kgt_persen text-right'>P</td>
                <td style='display: none;'></td>
                <td></td>
                <td></td>
                <td></td>";
        echo    "<td width='70'>
                    <div class='btn-group'>
                        <a class='btn btn-primary btn-flat btn-sm' data-toggle='modal' data-target='#indimodal' data-url='".base_url('capaian/edit_indikator/').$kgt->idCapai."'><span class='glyphicon glyphicon-edit'></span></a>
                        <a data-href='".base_url('capaian/hapus_cp/').$kgt->idCapai."' class='btn btn-danger btn-flat btn-sm hapus'><span class='glyphicon glyphicon-trash'></span></a>
                    </div>
                </td>";
        echo    "</tr>";

        if(!empty($kgt->sub)){

            fetch_subkeg($kgt->sub);
        }

    }

}

function fetch_subkeg($cp){
    foreach($cp as $sk){

        echo    "<tr class='subkeg'>";
        echo    "<td>".$sk->kd."</td>";
        echo    "<td>".$sk->program."</td>";
        echo    "<td>".$sk->indikator."</td>";
        echo    "<td>".$sk->satuan."</td>";
        echo    "<td class='target-fisik text-right'>".$sk->target."</td>";
        echo    "<td class='real-fisik text-right'>".$sk->real_target."</td>";
        echo    "<td class='persen-fisik text-right'>RF</td>";
        echo    "<td class='alokasi text-right'>".$sk->alokasi_ang."</td>";
        echo    "<td class='realisasi text-right'>".$sk->real_ang."</td>";
        echo    "<td class='presentasi text-right'>".$sk->presentasi."</td>
                <td style='display: none;'></td>";
        echo    "<td>".$sk->permasalahan."</td>";
        echo    "<td>".$sk->upaya."</td>";
        echo    "<td>".$sk->tl."</td>";
        echo    "<td width='70'>
                    <div class='btn-group'>
                        <a class='btn btn-primary btn-flat btn-sm' data-toggle='modal' data-target='#myModal' data-url='".base_url('capaian/edit_cp/').$sk->idCapai."'><span class='glyphicon glyphicon-edit'></span></a>
                        <a data-href='".base_url('capaian/hapus_cp/').$sk->idCapai."' class='btn btn-danger btn-flat btn-sm hapus'><span class='glyphicon glyphicon-trash'></span></a>
                    </div>
                </td>";
        echo "</tr>";

    }

}


?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-dark">
            <div class="box-header with-border">
                <div class="info-card">
                    <h4><i class="fas fa-chart-line"></i> <?php echo $judul ?></h4>
                    <div class="info-app yellow">
                        <i class="fas fa-info-circle"></i>
                    Form Pengisian Data Capaian Kinerja. Mohon agar memperhatikan batas waktu pengisian sebagaimana tertera.
                    </div>
                </div>
            </div>
            <div class="box-body">

            <div class="table-responsive">
                    <table class="table table-bordered" width="100%">

                        <tr>
                            <td width="90" style="background-color:#F5F5DC;"><b>Organisasi Perangkat Daerah</b> <small class="text-red">*</small></td>
                            <td>
                                <div class="form-group">
                                    <input class="form-control" type="text" value="<?= $nmOpd ?>" disabled>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color:#F5F5DC;"><b>Tahun LKPJ</b> <small class="text-red">*</small></td>
                            <td>
                                <div class="form-group">
                                    <input class="form-control" type="text" value="<?= $this->session->userdata('ta') ?>" disabled>
                                </div>
                            </td>
                        </tr>

                        <!-- <tr>
                            <td style="background-color:#F5F5DC;"><b>Progres Penyusunan (%)</b></td>
                            <td>
                                <button class="btn btn-success"><i class="far fa-file-excel"></i> Unduh Ke Excel</button>
                                <button class="btn btn-danger" disabled><i class="far fa-file-pdf"></i> Unduh Ke PDF</button>
                            </td>
                        </tr> -->

                        <!-- <tr>
                            <td style="background-color:#F5F5DC;">Import Data Dari File Excel</td>
                            <td>
                                <button class="btn btn-default" disabled><i class="fas fa-download"></i> Download Template</button>
                                <button class="btn btn-primary" disabled><i class="fas fa-file-upload"></i> Import</button>
                                <p class="text-warning">Fitur ini sedang dalam tahap pengembangan dan uji coba keamanan sistem</p>
                            </td>
                        </tr> -->

                    </table>
                </div>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <tr>
                                <th rowspan="2">Kode</th>
                                <th rowspan="2">OPD/Urusan/Program/Kegiatan/Sub Kegiatan</th>
                                <th rowspan="2">Indikator Kinerja</th>
                                <th rowspan="2">Satuan</th>
                                <th colspan="3">Fisik</th>
                                <th colspan="3">Keuangan</th>
                                <th rowspan="2">Permasalahan</th>
                                <th rowspan="2">Upaya Mengatasi Permasalahan</th>
                                <th rowspan="2">Tindak Lanjut</th>
                                <th rowspan="2">Opsi</th>
                            </tr>
                            <tr>
                                <th>Target</th>
                                <th>Real</th>
                                <th>%</th>
                                <th>Alokasi</th>
                                <th>Real</th>
                                <th>%</th>
                                <th style="display: none;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= fetch_opd($cp) ?>
                        </tbody>

                    </table>
                </div>

                <div class="modal modal-default modal-md fade" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-gray">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Form Pembaharuan Data</h4>
                            </div>
                            <div class="modal-body">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                                <button type="submit" form="myform" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal modal-default modal-md fade" id="indimodal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-gray">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Form Update Indikator Kinerja</h4>
                            </div>
                            <div class="modal-body">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                                <button type="submit" form="formIndikator" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
                 
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $("#opd").change(function(){
        var element = $("option:selected", this);
        var myTag = element.attr("data-nama");
        var myId = element.attr("data-id");

        $('#namaOpd').val(myTag);
        $('#idOpd').val(myId);
    });

    $(document).ready(function () {
        $('#example').DataTable({
            "ordering": false,
            "columnDefs" : [{
                "targets": '_all',
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).css('padding', '2px');
                }
            }]
        });
    });

    $(document).ready(function () {
        $('#example2').DataTable({
            "ordering": false,
            "columnDefs" : [{
                "targets": '_all',
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).css('padding', '2px');
                }
            }]
        });
    });

    // hitung nilai alokasi sub kegiatan ke kegiatan
    $("tr:has(td.kgt)").each(function() {
        var sum = 0;
        $(this).nextUntil(':not(:has(td.alokasi))').children(':nth-child(8)').each(function() {
            sum += parseInt(this.innerHTML, 10);
        });
        $(this).children(':eq(7)').text(sum.toLocaleString()).css('font-weight', 'bold');
    });

    // rubah nilai sub kegiatan ke string lokal
    $('td.alokasi').each(function(){
        var a = parseInt($(this).text());
        $(this).text(a.toLocaleString());
    });

    // hitung nilai alokasi kegiatan ke program
    $('.prg').each(function(){
        var ab = $(this).attr('id');
        var ttl =0;

        $("[data-kd='"+ab+"']").each(function() {
          var text = parseRaw($(this).text());
          ttl += text;
        });
        $(this).text(ttl.toLocaleString()).css('font-weight', 'bold');

    });

    // hitung nilai alokasi program ke opd
    $('.al-opd').each(function(){
        var ab = $(this).attr('id-opd');
        var ttl =0;

        $("[data-opd='"+ab+"']").each(function() {
          var text = parseRaw($(this).text());
          ttl += text;
        });
        $(this).text(ttl.toLocaleString()).css('font-weight', 'bold');

    });

    // REALIASI CALCULATION

    // hitung nilai realisasi sub kegiatan ke kegiatan
    $("tr:has(td.kgt-real)").each(function() {
        var sum = 0;
        $(this).nextUntil(':not(:has(td.realisasi))').children(':nth-child(9)').each(function() {
            sum += parseInt(this.innerHTML, 10);
        });
        $(this).children(':eq(8)').text(sum.toLocaleString()).css('font-weight', 'bold');
    });

    // rubah nilai sub kegiatan ke string lokal
    $('td.realisasi').each(function(){
        var a = parseInt($(this).text());
        $(this).text(a.toLocaleString());
    });

    // hitung nilai realisasi kegiatan ke program
    $('.prg2').each(function(){
        var ab = $(this).attr('id');
        var ttl =0;

        $("[data-kd2='"+ab+"']").each(function() {
          var text = parseRaw($(this).text());
          ttl += text;
        });
        $(this).text(ttl.toLocaleString()).css('font-weight', 'bold');

    });

    // hitung nilai alokasi program ke opd
    $('.opd2').each(function(){
        var ab = $(this).attr('id-opd');
        var ttl =0;

        $("[data-opd2='"+ab+"']").each(function() {
          var text = parseRaw($(this).text());
          ttl += text;
        });
        $(this).text(ttl.toLocaleString()).css('font-weight', 'bold');

    });

    // PERSENTASE CALCULATION
    var total = 0;
    // FISIK
    $(".subkeg").each(function() {
         var target_fisik = parseRaw($(this).find(".target-fisik").text());
         var real_fisik = parseRaw($(this).find(".real-fisik").text());
         var subtotal = hitungPersen(real_fisik, target_fisik);
         var color = coloring(subtotal);
         $(this).find(".persen-fisik").text(subtotal).css('color', color).css('font-weight', 'bold');
         if(!isNaN(subtotal))
             total+=subtotal;
     });

    // KEU
     $(".subkeg").each(function() {
         var alokasi = parseRaw($(this).find(".alokasi").text());
         var realisasi = parseRaw($(this).find(".realisasi").text());
         var subtotal = hitungPersen(realisasi, alokasi);
         var color = coloring(subtotal);
         $(this).find(".presentasi").text(subtotal).css('color', color).css('font-weight', 'bold');
         
         if(!isNaN(subtotal))
             total+=subtotal;
     });

     $(".keg").each(function() {
         var alokasi = parseRaw($(this).find(".kgt").text());
         var realisasi = parseRaw($(this).find(".kgt-real").text());
         var subtotal = hitungPersen(realisasi, alokasi);
         var color = coloring(subtotal);
         $(this).find(".kgt_persen").text(subtotal).css('color', color).css('font-weight', 'bold');
         if(!isNaN(subtotal))
             total+=subtotal;
     });

     $(".prog").each(function() {
         var alokasi = parseRaw($(this).find(".prg").text());
         var realisasi = parseRaw($(this).find(".prg2").text());
         var subtotal = hitungPersen(realisasi, alokasi);
         var color = coloring(subtotal);
         $(this).find(".prg_persen").text(subtotal).css('color', color).css('font-weight', 'bold');
         if(!isNaN(subtotal))
             total+=subtotal;
     });

     $(".opede").each(function() {
         var alokasi = parseRaw($(this).find(".al-opd").text());
         var realisasi = parseRaw($(this).find(".opd2").text());
         var subtotal = hitungPersen(realisasi, alokasi);
         var color = coloring(subtotal);
         $(this).find(".opd_persen").text(subtotal).css('color', color).css('font-weight', 'bold');
         if(!isNaN(subtotal))
             total+=subtotal;
     });


    // FUNGSI KONVERSI

    function cln(str) {
      var arr = str.split(".");
      arr.pop();
      var newStr = arr.join(".");
      return newStr;
    }

    function parseRaw(str) {
      var sum = str.replace(/,/g, ''); // hapus koma
      sum = parseInt(sum); // konversi ke tipe data angka
      return sum;
    }

    // clean persentase

    function hitungPersen(realisasi, alokasi) {

    var result = (realisasi / alokasi) * 100;
      
        if (Number.isInteger(result)) {
            return result;
        } else {
            return result.toFixed(2);
        }
    }

    function coloring(subtotal) {
        switch(true) {
            case subtotal <= 65:
                color = 'red';
                return color;
                break;
            case(subtotal > 65) && (subtotal <= 90) :
                color = 'orange';
                return color;
                break;
            case(subtotal > 90) && (subtotal <= 100) :
                color = 'green';
                return color;
                break;
         }
    }


    $('#myModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Tombol yang memicu modal
      var url = button.data('url'); // URL untuk memuat konten modal dari server
      var modal = $(this);
      modal.find('.modal-body').load(url);
    });

    $('#indimodal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Tombol yang memicu modal
      var url = button.data('url'); // URL untuk memuat konten modal dari server
      var modal = $(this);
      modal.find('.modal-body').load(url);
    });

    $(document).ready(function(){
        $('#myModal').on('shown.bs.modal', function (event) {
            $('.uang').mask('000.000.000.000.000,00', {reverse: true});
        });
    });

    
    $(document).on("click", ".hapus", function () {
      hapus($(this).data("href"));
    });

</script>
