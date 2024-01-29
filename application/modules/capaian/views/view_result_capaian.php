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

<div class="row">
    <div class="col-xs-12">
        <div class="box box-dark">
            <div class="box-header with-border">
                <div class="info-card">
                    <h4><i class="fas fa-chart-line"></i> <?php echo $judul ?></h4>
                    <div class="info-app yellow">
                        <i class="fas fa-info-circle"></i>
                    Pilih OPD untuk melihat Data Capaian Kinerja.
                    </div>
                </div>
            </div>
            <div class="box-body">

                <div class="table-responsive">
                    <table class="table table-bordered" width="100%">
                        <form method="get" action="<?= base_url('capaian/view_result_cp') ?>">
                            <tr>
                                <td width="30" style="background-color:#F5F5DC;"><b>Organisasi Perangkat Daerah</b> <small class="text-red">*</small></td>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control" name="opd" id="opd">
                                            <option disabled selected>---</option>
                                            <option value="1">1.00 SEMUA OPD</option>
                                            <?php foreach($opd as $a) { ?>
                                                <option value="<?= $a->kdOpd ?>" data-nama="<?= $a->nmOpd ?>" data-id="<?= $a->idOpd ?>"><?= $a->kdOpd." ".$a->nmOpd ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" name="namaOpd" id="namaOpd">
                                        <input type="hidden" name="idOpd" id="idOpd">
                                    </div>
                                </td>
                            </tr>
                        <tr>
                            <td style="background-color:#F5F5DC;"><b>Pilih Tahun LKPJ</b> <small class="text-red">*</small></td>
                            <td>
                                <div class="form-group">
                                    <select class="form-control" name="tahun">
                                        <option disabled selected>---</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                    </select>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td style="background-color:#F5F5DC;">Opsi</td>
                            <td>
                                <button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Cari</button>
                            </td>
                        </tr>

                        </form>

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
                <th rowspan="2" width="55">Opsi</th>
            </tr>
            <tr>
                <th>Target</th>
                <th>Real</th>
                <th>Persentase</th>
                <th>Alokasi</th>
                <th>Real</th>
                <th>Persentase</th>
                <th style="display: none;"></th>
            </tr>
            <!-- <tr style="font-size:10px;" class="head">
                <th>a</th>
                <th>b</th>
                <th>c</th>
                <th>d</th>
                <th>e</th>
                <th>f</th>
                <th>g = (f/e)*100</th>
                <th>h</th>
                <th>i</th>
                <th>j = (i/h)*100</th>
                <th style="display: none;"></th>
                <th>k</th>
                <th>l</th>
                <th>m</th>
                <th>n</th>
            </tr> -->
        </thead>
        <tbody>
            <tr class="opede">
                <td>1.01</td>
                <td colspan="6">DINAS PENDIDIKAN DAN KEBUDAYAAN</td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td class="al-opd" id-opd="1.01">A</td>
                <td class="opd2" id-opd="1.01">R</td>
                <td class="opd_persen">P</td>
                <td style="display: none;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td width="70">
                    <div class='btn-group'>
                        <a class='btn btn-primary btn-flat btn-xs' ><span class='glyphicon glyphicon-edit'></span></a>
                        <a class='btn btn-danger btn-flat btn-xs hapus'><span class='glyphicon glyphicon-trash'></span></a>
                    </div>
                </td>
            </tr>

            <tr class="prog">
                <td>X.XX.01</td>
                <td colspan="6">PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA</td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td class="prg" id="X.XX.01" data-opd="1.01">A</td>
                <td class="prg2" id="X.XX.01" data-opd2="1.01">R</td>
                <td class="prg_persen">P</td>
                <td style="display: none;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td width="70">
                    <div class='btn-group'>
                        <a class='btn btn-primary btn-flat btn-xs' ><span class='glyphicon glyphicon-edit'></span></a>
                        <a class='btn btn-danger btn-flat btn-xs hapus'><span class='glyphicon glyphicon-trash'></span></a>
                    </div>
                </td>
            </tr>

            <tr class="keg">
                <td>X.XX.01.201</td>
                <td colspan="6">Perencanaan, Penganggaran, dan Evaluasi Kinerja Perangkat Daerah</td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td class="kgt" data-kd="X.XX.01">A</td>
                <td class="kgt-real" data-kd2="X.XX.01">R</td>
                <td class="kgt_persen">P</td>
                <td style="display: none;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td width="70">
                    <div class='btn-group'>
                        <a class='btn btn-primary btn-flat btn-xs' ><span class='glyphicon glyphicon-edit'></span></a>
                        <a class='btn btn-danger btn-flat btn-xs hapus'><span class='glyphicon glyphicon-trash'></span></a>
                    </div>
                </td>
            </tr>

            <tr class="subkeg">
                <td>X.XX.01.201.05</td>
                <td>Penyusunan Dokumen Perencanaan Perangkat Daerah</td>
                <td>Jumlah Dokumen Perencanaan Perangkat Daerah</td>
                <td>Dokumen</td>
                <td class="target-fisik">10</td>
                <td class="real-fisik">7</td>
                <td class="persen-fisik">RF</td>
                <td class="alokasi">15000000</td>
                <td class="realisasi">10000000</td>
                <td class="presentasi">%</td>
                <td style="display: none;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td width="70">
                    <div class='btn-group'>
                        <a class='btn btn-primary btn-flat btn-xs' ><span class='glyphicon glyphicon-edit'></span></a>
                        <a class='btn btn-danger btn-flat btn-xs hapus'><span class='glyphicon glyphicon-trash'></span></a>
                    </div>
                </td>
            </tr>

            <tr class="subkeg">
                <td>X.XX.01.201.06</td>
                <td>Penganggaran Kinerja ASN</td>
                <td>Jumlah Dokumen Perencanaan Perangkat Daerah</td>
                <td>Dokumen</td>
                <td class="target-fisik">5</td>
                <td class="real-fisik">5</td>
                <td class="persen-fisik">RF</td>
                <td class="alokasi">12000000</td>
                <td class="realisasi">10000000</td>
                <td class="presentasi">%</td>
                <td style="display: none;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td width="70">
                    <div class='btn-group'>
                        <a class='btn btn-primary btn-flat btn-xs' ><span class='glyphicon glyphicon-edit'></span></a>
                        <a class='btn btn-danger btn-flat btn-xs hapus'><span class='glyphicon glyphicon-trash'></span></a>
                    </div>
                </td>
            </tr>

            <tr class="subkeg">
                <td>X.XX.01.201.07</td>
                <td>Penganggaran Kinerja ASN</td>
                <td>Jumlah Dokumen Perencanaan Perangkat Daerah</td>
                <td>Unit</td>
                <td class="target-fisik">125</td>
                <td class="real-fisik">1</td>
                <td class="persen-fisik">RF</td>
                <td class="alokasi">5960000234</td>
                <td class="realisasi">960000000</td>
                <td class="presentasi">%</td>
                <td style="display: none;"></td>
                <td>Terdapat selisih antara realisasi di lapangan dengan dokumen pembayaran prestasi pekerjaan yang ajukan oleh penyedia jasa.</td>
                <td></td>
                <td></td>
                <td width="70">
                    <div class='btn-group'>
                        <a class='btn btn-primary btn-flat btn-xs' ><span class='glyphicon glyphicon-edit'></span></a>
                        <a class='btn btn-danger btn-flat btn-xs hapus'><span class='glyphicon glyphicon-trash'></span></a>
                    </div>
                </td>
            </tr>


        </tbody>

    </table>

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

</script>
