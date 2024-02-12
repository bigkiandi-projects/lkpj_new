<?php

    function cariObjek($array, $string) {
        $equal = array();
        foreach ($array as $objek) {
            if ($objek->nmOpd === $string) {
                $equal[] = $objek;
            }
        }
        return $equal;
    }

    // String yang ingin dicari
    $cariString = strtoupper($this->session->userdata('nama_user'));

    // Memanggil fungsi untuk mencari objek
    $find = cariObjek($opd, $cariString);

    $uker = cariObjek($opd, $unit_kerja);

?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="box-title">
                        <h4><?php echo $judul ?></h4>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="box-title">
                        <a href="<?php echo base_url('narasi') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form action="<?php echo $action; ?>" method="post">
                    	    <div class="form-group">
                                <label for="varchar">Unit Kerja</label>
                                <?php if($this->session->userdata('level') == 'Opd') { ?>
                                <select class="form-control select2" name="opd" id="opd">
                                    <option value="<?= $find[0]->nmOpd ?>" data-value="<?= $find[0]->kdOpd ?>"><?= $find[0]->nmOpd ?></option>
                                </select>
                                <?php } else { ?>
                                    <?php if($button == 'Update') { ?>
                                        <select class="form-control select2" name="opd" id="opd">
                                            <option value="<?= $uker[0]->nmOpd ?>" data-value="<?= $uker[0]->kdOpd ?>"><?= $uker[0]->nmOpd ?></option>
                                        </select>
                                    <?php } else { ?>
                                        <select class="form-control select2" name="opd" id="opd">
                                        <?php foreach ($opd as $a) { ?>
                                        <option value="<?= $a->nmOpd ?>" data-value="<?= $a->kdOpd ?>"><?= $a->kdOpd.' '.$a->nmOpd ?></option>
                                        <?php } ?>
                                        </select>
                                    <?php } ?>
                                <?php } ?>
                            </div>

                    	    <div class="form-group">
                                <label for="varchar">Urusan</label>
                                <select name="urusan" class="form-control" id="urusan">
                                    <option value=""></option>
                                </select>
                            </div>

                    	    <div class="form-group">
                                <label for="uraian_kegiatan">Uraian Kegiatan</label>
                                <textarea class="form-control" rows="6" name="uraian_kegiatan" id="uraian_kegiatan" placeholder="Uraian Kegiatan"><?php echo $uraian_kegiatan; ?></textarea>
                            </div>

                    	    <input type="hidden" name="id_narasi" value="<?php echo $id_narasi; ?>" /> 
                    	    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
                    	</form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        function get_ajax(opd) {

            // Mengirim permintaan Ajax untuk mendapatkan nilai baru
            $.ajax({
                url: "<?php echo base_url('rekomendasi/check_ur'); ?>",
                type: "GET",
                data: {
                    opd: opd
                },
                dataType: "json",
                success: function(response) {
                    // Mengosongkan combo box kedua
                    $('#urusan').empty();
                    // Mengisi combo box kedua dengan nilai yang diperoleh dari Ajax
                    $.each(response, function(key, value) {
                        $('#urusan').append('<option value="' + value.nmUrus + '">' + value.nmUrus + '</option>');
                    });

                    $('#urusan').trigger('change');
                }
            });

        }
         // detek event on load
        var opd = $('#opd').find(':selected').data('value');
        get_ajax(opd);

        $('#opd').change(function(){
            var test = $(this).find(':selected').data('value');
            get_ajax(test);
        });

    });
</script>