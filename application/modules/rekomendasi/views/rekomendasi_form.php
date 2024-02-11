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
                        <a href="<?php echo base_url('rekomendasi') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                    <form action="<?php echo $action; ?>" method="post">

                        <div class="form-group">
                            <label for="varchar">Opd</label>
                            <select name="opd" class="form-control" id="opdnya">

                                <?php if($button == 'Update') { ?>

                                <option value="<?= $this->uri->segment(4); ?>" data-value="<?= $this->uri->segment(5); ?>" selected>
                                    <?= $this->uri->segment(5).' '.urldecode($this->uri->segment(6));?>
                                </option>

                                <?php } else { ?>
                                    <?php foreach($d_opd as $a) { ?>
                                        <option value="<?= $a->id_user ?>" data-value="<?= $a->kdOpd ?>">
                                            <?= $a->kdOpd.' '.$a->nmOpd ?>
                                        </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="varchar">Urusan</label>
                            <select name="kode_urusan" class="form-control" id="urusannya">
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="rekomendasi">Rekomendasi</label>
                            <textarea class="form-control" rows="3" name="rekomendasi" id="rekomendasi" placeholder="Rekomendasi"><?php echo $rekomendasi; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="tindak_lanjut">Tindak Lanjut</label>
                            <textarea class="form-control" rows="3" name="tindak_lanjut" id="tindak_lanjut" placeholder="Tindak Lanjut"><?php echo $tindak_lanjut; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="tujuan">Tujuan/Masalah Yang Diselesaikan</label>
                            <textarea class="form-control" rows="3" name="tujuan" id="tujuan" placeholder="Tujuan"><?php echo $tujuan; ?></textarea>
                        </div>
                        
                        <input type="hidden" class="form-control" name="kode_opd" value="" id="kode_opd" /> 
                        <input type="hidden" class="form-control" name="urusan_name" value="" id="urusan_name" /> 

                        <input type="hidden" name="id_rek" value="<?php echo $id_rek; ?>" /> 
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
                    $('#urusannya').empty();
                    // Mengisi combo box kedua dengan nilai yang diperoleh dari Ajax
                    $.each(response, function(key, value) {
                        $('#urusannya').append('<option value="' + value.kdUrus + '">' + value.nmUrus + '</option>');
                    });

                    $('#urusannya').trigger('change');
                    $('#opdnya').trigger('change');
                }
            });

        }
         // detek event on load
        var opd = $('#opdnya').find(':selected').data('value');
        get_ajax(opd);

        $('#opdnya').change(function() {

            var opd = $(this).find(':selected').data('value');
            get_ajax(opd);
            $('#kode_opd').val(opd);
        });

        $('#urusannya').change(function(){
            var test = $(this).find(':selected').text();
            $('#urusan_name').val(test);
        });

    });
</script>