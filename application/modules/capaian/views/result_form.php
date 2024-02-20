<?php
require ('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

function fetch_opd($cp) {

    foreach($cp as $op){

        echo "<tr class='opd_target' style='background-color: #8bbdda'>";

        echo "<td><b>".$op->kdOpd."</b></td>";
        echo "<td colspan='5'><b>".$op->nmOpd."</b></td>";
        echo "<td class='opd' id-opd='".$op->kdOpd."'>A</td>";
        echo "<td class='opd2' id-opd='".$op->kdOpd."'>R</td>";
        echo "<td class='opd_persen'>R</td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";


        echo "</tr>";

        if(!empty($op->sub)){

            fetch_bid($op->sub, $op->kdOpd);
        }

    }

}

function fetch_bid($cp, $kdOpd){

    foreach($cp as $bid) {
        echo "<tr><td colspan='5'><i>".$bid->nmBid."</i></td></tr>";
        if(!empty($bid->sub)){
            fetch_prog($bid->sub, $kdOpd);
        }

    }

}

function fetch_prog($cp, $kdOpd) {

    foreach($cp as $prg) {

        echo    "<tr class='prg_target' style='background-color: #b2d3e6'>";


        echo    "<td><b>".$prg->kd."</b></td>";
        echo    "<td colspan='5'><b>".$prg->program."</b></td>";
        echo    "<td class='prg' id='".$prg->kd."' data-opd='".$kdOpd."'>A</td>";
        echo    "<td class='prg2' id='".$prg->kd."' data-opd2='".$kdOpd."'>R</td>";
        echo    "<td class='prg_persen'>R</td>";
        echo    "<td></td>";
        echo    "<td></td>";
        echo    "<td></td>";
        echo    "<td>
                <div class='btn-group'>
                    <a class='btn btn-primary btn-flat btn-sm' data-toggle='modal' data-target='#kegmodal' data-url='".base_url('capaian/edit_cp/').$prg->idCapai."'><span class='glyphicon glyphicon-edit'></span></a>
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

        echo "<tr class='keg_target' style='background-color: #d8e9f3'>";

        echo        "<td><b>".$kgt->kd."</b></td>";
        echo        "<td colspan='5'><b>".$kgt->program."</b></td>";
        echo        "<td class='kgt' data-kd='".$kd."'></td>";
        echo        "<td class='kgt-real' data-kd2='".$kd."'>R</td>";
        echo        "<td class='kgt_persen'>R</td>";
        echo        "<td></td>";
        echo        "<td></td>";
        echo        "<td></td>";
        echo        "<td>
                    <div class='btn-group'>
                        <a class='btn btn-primary btn-flat btn-sm' data-toggle='modal' data-target='#kegmodal' data-url='".base_url('capaian/edit_cp/').$kgt->idCapai."'><span class='glyphicon glyphicon-edit'></span></a>
                        <a data-href='".base_url('capaian/hapus_cp/').$kgt->idCapai."' class='btn btn-danger btn-flat btn-sm hapus'><span class='glyphicon glyphicon-trash'></span></a>
                    </div>
                    </td>";

        echo "</tr>";

        if(!empty($kgt->sub)){

            fetch_subkeg($kgt->sub);
        }

    }

}

function fetch_subkeg($cp){
    foreach($cp as $sk){

        echo "<tr class='subkeg_target'>";

        echo    "<td>".$sk->kd."</td>";
        echo    "<td>".$sk->program."</td>";
        echo    "<td>".$sk->indikator."</td>";
        echo    "<td>".$sk->satuan."</td>";
        echo    "<td>".$sk->target."</td>";
        echo    "<td>".$sk->real_target."</td>";
        echo    "<td class='alokasi'>".$sk->alokasi_ang."</td>";
        echo    "<td class='realisasi'>".$sk->real_ang."</td>";
        echo    "<td class='presentasi'>".$sk->presentasi."</td>";
        echo    "<td>".$sk->permasalahan."</td>";
        echo    "<td>".$sk->upaya."</td>";
        echo    "<td>".$sk->tl."</td>";
        echo    "<td>
                <div class='btn-group'>
                    <a class='btn btn-primary btn-flat btn-sm' data-toggle='modal' data-target='#myModal' data-url='".base_url('capaian/edit_cp/').$sk->idCapai."'><span class='glyphicon glyphicon-edit'></span></a>
                    <a data-href='".base_url('capaian/hapus_cp/').$sk->idCapai."' class='btn btn-danger btn-flat btn-sm hapus'><span class='glyphicon glyphicon-trash'></span></a>
                </div>
                </td>";

        echo "</tr>";

    }

}

// =====ekspor tabel=======
$opdnya = $this->input->get('namaOpd');
function xbid($cp) {
    // Lokasi file spreadsheet yang sudah ada
    $file_path = './assets/upload/file_spreadsheet_updated.xlsx';

    // $newfile = './assets/upload/'.$opdnya.'.xlsx';
    // $copy_file = copy($file_path, $newfile);

    // Baca file spreadsheet yang sudah ada
    $spreadsheet = IOFactory::load($file_path);

    // Dapatkan lembar aktif (active sheet)
    $sheet = $spreadsheet->getActiveSheet();

    // Data yang ingin Anda tambahkan ke baris tertentu
    $rowIndex = 9;

    // Looping data users
    foreach ($cp as $xopd) {

        foreach($xopd->sub as $bid) {

            foreach($bid->sub as $prog) {
                $sheet->setCellValue('A'.$rowIndex, $prog->idCapai);
                $sheet->getStyle('A'.$rowIndex)->getFont()->setBold(true);

                $sheet->setCellValue('B'.$rowIndex, $prog->kd);
                $sheet->getStyle('B'.$rowIndex)->getFont()->setBold(true);

                $sheet->mergeCells('C'.$rowIndex.':'.'E'.$rowIndex);
                $sheet->setCellValue('C'.$rowIndex, $prog->program);
                $sheet->getStyle('C'.$rowIndex)->getFont()->setBold(true);

                $sheet->getStyle('A'.$rowIndex.':M'.$rowIndex)->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('dfdfdf');

                $sheet->getStyle('A'.$rowIndex.':M'.$rowIndex)->getBorders()
                        ->getOutline()
                        ->setBorderStyle(Border::BORDER_THIN)
                        ->setColor(new Color('666666'));

                $sheet->getStyle('A'.$rowIndex.':C'.$rowIndex)->getBorders()
                        ->getInside()
                        ->setBorderStyle(Border::BORDER_THIN)
                        ->setColor(new Color('666666'));

                $rowIndex++;

                foreach($prog->sub as $keg) {
                    $sheet->setCellValue('A'.$rowIndex, $keg->idCapai);
                    $sheet->getStyle('A'.$rowIndex)->getFont()->setBold(true);

                    $sheet->setCellValue('B'.$rowIndex, $keg->kd);
                    $sheet->getStyle('B'.$rowIndex)->getFont()->setBold(true);

                    $sheet->mergeCells('C'.$rowIndex.':'.'E'.$rowIndex);
                    $sheet->setCellValue('C'.$rowIndex, $keg->program);
                    $sheet->getStyle('C'.$rowIndex)->getFont()->setBold(true);

                    $sheet->getStyle('A'.$rowIndex.':N'.$rowIndex)->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()
                        ->setARGB('f0f0f0');

                    $sheet->getStyle('A'.$rowIndex.':M'.$rowIndex)->getBorders()
                        ->getOutline()
                        ->setBorderStyle(Border::BORDER_THIN)
                        ->setColor(new Color('666666'));

                    $sheet->getStyle('A'.$rowIndex.':C'.$rowIndex)->getBorders()
                        ->getInside()
                        ->setBorderStyle(Border::BORDER_THIN)
                        ->setColor(new Color('666666'));

                    $rowIndex++;

                    foreach($keg->sub as $subkeg) {
                        $sheet->setCellValue('A'.$rowIndex, $subkeg->idCapai);
                        $sheet->setCellValue('B'.$rowIndex, $subkeg->kd);
                        $sheet->setCellValue('C'.$rowIndex, $subkeg->program);
                        $sheet->setCellValue('D'.$rowIndex, $subkeg->indikator);
                        $sheet->setCellValue('E'.$rowIndex, $subkeg->satuan);
                        $sheet->setCellValue('F'.$rowIndex, $subkeg->target);
                        $sheet->setCellValue('G'.$rowIndex, $subkeg->real_target);
                        $sheet->setCellValue('H'.$rowIndex, $subkeg->alokasi_ang);
                        $sheet->setCellValue('I'.$rowIndex, $subkeg->real_ang);
                        $sheet->setCellValue('J'.$rowIndex, $subkeg->presentasi);
                        $sheet->setCellValue('K'.$rowIndex, $subkeg->permasalahan);
                        $sheet->setCellValue('L'.$rowIndex, $subkeg->upaya);
                        $sheet->setCellValue('M'.$rowIndex, $subkeg->tl);

                        $sheet->getStyle('A'.$rowIndex.':M'.$rowIndex)->getBorders()
                        ->getAllBorders()
                        ->setBorderStyle(Border::BORDER_THIN)
                        ->setColor(new Color('666666'));

                        $sheet->getStyle('F'.$rowIndex.':M'.$rowIndex)->getAlignment()
                        ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);


                        $rowIndex++;
                    }

                }
            }
        }

    }

    // Simpan file spreadsheet dengan perubahan yang baru saja Anda buat
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('./assets/upload/export/excel/test.xlsx');
}

function get_data($cp) {
    // Lokasi file spreadsheet yang sudah ada
    $file_path = './assets/upload/file_spreadsheet_updated.xlsx';

    // Baca file spreadsheet yang sudah ada
    $spreadsheet = IOFactory::load($file_path);

    // Dapatkan lembar aktif (active sheet)
    $sheet = $spreadsheet->getActiveSheet();

    $highestRow = $sheet->getHighestRow(); 
    $highestColumn = $sheet->getHighestColumn();

    $dataArray = $sheet
    ->rangeToArray(
        'A9:'. $highestColumn . $highestRow,     // The worksheet range that we want to retrieve
        NULL,        // Value that should be returned for empty cells
        TRUE,        // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
        FALSE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
        FALSE         // Should the array be indexed by cell row and cell column
    );

    return $dataArray;
}

?>


<style type="text/css">
	table.table-bordered > thead > tr > th{
      border:1px solid #c8c8c8;
      text-align: center;
      vertical-align: middle;
  	}
  	table.table-bordered > tbody > tr > td{
    	border:0.5px solid #c8c8c8;
  	}
</style>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default">

            <div class="box-header with-border">
                <div class="alert bg-gray color-palette">
                    <h4><i class="fas fa-poll"></i> DATA CAPAIAN KINERJA <span class="text-yellow"><?= $nmOpd ?></span></h4>
                    <p><span class="glyphicon glyphicon-info-sign"></span> Jika data program/kegiatan/sub kegiatan tidak ada, silahkan tambahkan data tersebut pada menu <b>Generator</b> atau Klik Disini</p>
                    <p><span class="glyphicon glyphicon-info-sign"></span> Gunakan Form Input di bawah ini untuk melakukan pengisian data melalui upload file excel. Anda di haruskan mengupload file excel mengikuti template yang telah di sediakan melalui download tempalate di bawah ini :</p>
                    <br>

                   <div class="row">
	                   <div class="col-md-6">
                        <form method="get" action="">
		                    <div class="input-group">
								<input type="file" class="form-control">
								<span class="input-group-btn">
								<button type="submit" class="btn btn-default">Proses</button>
								</span>
							</div>
                        </form>
						</div>
						<div class="col-md-6">
                            <form method="get" action="<?= base_url('capaian/get_excel_import_format') ?>">
                                <input type="hidden" name="opd" value="<?= $this->input->get('opd'); ?>">
                                <input type="hidden" name="namaOpd" value="<?= $this->input->get('namaOpd'); ?>">
                                <input type="hidden" name="idOpd" value="<?= $this->input->get('idOpd'); ?>">
                                <input type="hidden" name="tahun" value="<?= $this->input->get('tahun'); ?>">
							     <button type="submit" class="btn bg-warning"><span class="glyphicon glyphicon-download-alt"></span> Download Template Pengisian</button>
                            </form>
						</div>
					</div>

                </div>
            </div>
            <div class="box-body">

                <div class="text-right">
                	<a href="<?php echo base_url('capaian/form_isian') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                	<button class="btn btn-success"><span class="glyphicon glyphicon-log-out"></span> Unduh Laporan Ke Excel</button>
                </div>

                <div class="table-responsive">
                	<table class="table table-bordered" style="font-size: 12px;">
                		<thead class="bg-primary">
                			<th>Kode</th>
                			<th rowspan="2">OPD/Program/Kegiatan/Sub Kegiatan</th>
                			<th>Indikator Kinerja</th>
                			<th>Satuan</th>
                			<th>Target</th>
                			<th>Realisasi Target</th>
                			<th>Alokasi Anggaran</th>
                			<th>Realisasi Anggaran</th>
                			<th>%</th>
                			<th>Permasalahan</th>
                			<th>Upaya Mengatasi Permasalahan</th>
                			<th>Tindak Lanjut</th>
                			<th width="85">Opsi</th>
                		</thead>
                		<tbody>
                            <?= fetch_opd($cp) ?>
                		</tbody>
                	</table>
                </div>
                <pre>
                    <?= xbid($cp) ?>
                </pre>
            </div>

            <!-- MODAL -->

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

            <div class="modal modal-default modal-md fade" id="kegmodal">
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

        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

    $("#opd").change(function(){
        var element = $("option:selected", this);
        var myTag = element.attr("data-nama");
        var myId = element.attr("data-id");

        $('#namaOpd').val(myTag);
        $('#idOpd').val(myId);
    });

    // hitung nilai alokasi sub kegiatan ke kegiatan
    $("tr:has(td.kgt)").each(function() {
        var sum = 0;
        $(this).nextUntil(':not(:has(td.alokasi))').children(':nth-child(7)').each(function() {
            sum += parseInt(this.innerHTML, 10);
        });
        $(this).children(':eq(2)').text(sum.toLocaleString()).css('font-weight', 'bold');
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
    $('.opd').each(function(){
        var ab = $(this).attr('id-opd');
        var ttl =0;

        $("[data-opd='"+ab+"']").each(function() {
          var text = parseRaw($(this).text());
          ttl += text;
        });
        $(this).text(ttl.toLocaleString()).css('font-weight', 'bold');

    });

    // REALIASI CALCULATION

    // hitung nilai alokasi sub kegiatan ke kegiatan
    $("tr:has(td.kgt-real)").each(function() {
        var sum = 0;
        $(this).nextUntil(':not(:has(td.realisasi))').children(':nth-child(8)').each(function() {
            sum += parseInt(this.innerHTML, 10);
        });
        $(this).children(':eq(3)').text(sum.toLocaleString()).css('font-weight', 'bold');
    });

    // rubah nilai sub kegiatan ke string lokal
    $('td.realisasi').each(function(){
        var a = parseInt($(this).text());
        $(this).text(a.toLocaleString());
    });

    // hitung nilai alokasi kegiatan ke program
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
     $(".subkeg_target").each(function() {
         var alokasi = parseInt($(this).find(".alokasi").text());
         var realisasi = parseInt($(this).find(".realisasi").text());
         var subtotal = hitungPersen(realisasi, alokasi);
         $(this).find(".presentasi").text(subtotal);
         if(!isNaN(subtotal))
             total+=subtotal;
     });

     $(".keg_target").each(function() {
         var alokasi = parseInt($(this).find(".kgt").text());
         var realisasi = parseInt($(this).find(".kgt-real").text());
         var subtotal = hitungPersen(realisasi, alokasi);
         $(this).find(".kgt_persen").text(subtotal);
         if(!isNaN(subtotal))
             total+=subtotal;
     });

     $(".prg_target").each(function() {
         var alokasi = parseInt($(this).find(".prg").text());
         var realisasi = parseInt($(this).find(".prg2").text());
         var subtotal = hitungPersen(realisasi, alokasi);
         $(this).find(".prg_persen").text(subtotal);
         if(!isNaN(subtotal))
             total+=subtotal;
     });

     $(".opd_target").each(function() {
         var alokasi = parseInt($(this).find(".opd").text());
         var realisasi = parseInt($(this).find(".opd2").text());
         var subtotal = hitungPersen(realisasi, alokasi);
         $(this).find(".opd_persen").text(subtotal);
         if(!isNaN(subtotal))
             total+=subtotal;
     });


    // fungsi-fungsi konversi

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

    function hitungPersen(numerator, denominator) {
      let result = (numerator / denominator) * 100;
      
      if (Number.isInteger(result)) {
        return result;
      } else {
        return result.toFixed(2);
      }
    }

    // MODAL EDIT

    $('#myModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Tombol yang memicu modal
      var url = button.data('url'); // URL untuk memuat konten modal dari server
      var modal = $(this);
      modal.find('.modal-body').load(url);
    });

    // edit kegiatan
    $('#kegmodal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Tombol yang memicu modal
      var url = button.data('url'); // URL untuk memuat konten modal dari server
      var modal = $(this);
      modal.find('.modal-body').load(url);
    });

    $(document).ready(function(){
        $('#myModal').on('shown.bs.modal', function (event) {
            $('.uang').mask('000.000.000.000.000', {reverse: true});
        });
    });

    
    $(document).on("click", ".hapus", function () {
      hapus($(this).data("href"));
    });




});

</script>
