<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-right">
                    <div class="box-title">
                        <a href="<?php echo base_url('tugas_pembantuan') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
                <div class="info-card pull-left">
                    <h4><i class="fas fa-briefcase"></i> <?php echo $judul ?></h4>
                    <div class="info-app yellow">
                        <i class="fas fa-info-circle"></i>
                        Halaman Tambah Data
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                <table class="table table-bordered">

                <form action="<?php echo $action; ?>" method="post">
                <tr>
                    <td width="220" style="background-color:#F5F5DC;"><b>SKPD Pelaksana</b> <small class="text-red">*</small></td>
                    <td>
                        <div class="form-group <?php if(form_error('skpd_pelaksana')) echo 'has-error'?> ">
                        <input type="text" class="form-control" name="skpd_pelaksana" id="skpd_pelaksana" placeholder="Skpd Pelaksana" value="<?php echo $skpd_pelaksana; ?>" readonly/>
                        <?php echo form_error('skpd_pelaksana', '<small style="color:red">','</small>') ?>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td width="220" style="background-color:#F5F5DC;"><b>Instansi Pemberi Tugas</b> <small class="text-red">*</small></td>
                    <td>
                        <div class="form-group <?php if(form_error('instansi_pemberi_tugas')) echo 'has-error'?> ">
                        <input type="text" class="form-control" name="instansi_pemberi_tugas" id="instansi_pemberi_tugas" placeholder="Instansi Pemberi Tugas" value="<?php echo $instansi_pemberi_tugas; ?>" />
                        <?php echo form_error('instansi_pemberi_tugas', '<small style="color:red">','</small>') ?>
                    </div>
                    </td>
                </tr>

                <tr>
                    <td width="220" style="background-color:#F5F5DC;"><b>Dasar Hukum</b> <small class="text-red">*</small></td>
                    <td>
                        <div class="form-group <?php if(form_error('dasar_hukum')) echo 'has-error'?> ">
                        <textarea class="form-control" rows="3" name="dasar_hukum" id="dasar_hukum" placeholder="Dasar Hukum"><?php echo $dasar_hukum; ?></textarea>
                        <?php echo form_error('dasar_hukum', '<small style="color:red">','</small>') ?>
                    </div>
                    </td>
                </tr>

                <tr>
                    <td width="220" style="background-color:#F5F5DC;"><b>Program Keg Output</b> <small class="text-red">*</small></td>
                    <td>
                        <div class="form-group <?php if(form_error('program_keg_output')) echo 'has-error'?> ">
                        <textarea class="form-control" rows="3" name="program_keg_output" id="program_keg_output" placeholder="Program Keg Output"><?php echo $program_keg_output; ?></textarea>
                        <?php echo form_error('program_keg_output', '<small style="color:red">','</small>') ?>
                    </div>
                    </td>
                </tr>

                <tr>
                    <td width="220" style="background-color:#F5F5DC;"><b>Lokasi</b> <small class="text-red">*</small></td>
                    <td>
                        <div class="form-group <?php if(form_error('lokasi')) echo 'has-error'?> ">
                        <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi" value="<?php echo $lokasi; ?>" autocomplete="off"/>
                        <?php echo form_error('lokasi', '<small style="color:red">','</small>') ?>
                    </div>
                    </td>
                </tr>

                <tr>
                    <td width="220" style="background-color:#F5F5DC;"><b>Alokasi Anggaran</b> <small class="text-red">*</small></td>
                    <td>
                        <div class="form-group <?php if(form_error('alokasi_anggaran')) echo 'has-error'?> ">
                        <input type="text" class="form-control uang" name="alokasi_anggaran" id="alokasi" placeholder="Alokasi Anggaran" value="<?php echo $alokasi_anggaran; ?>" autocomplete="off"/>
                        <?php echo form_error('alokasi_anggaran', '<small style="color:red">','</small>') ?>
                    </div>
                    </td>
                </tr>

                <tr>
                    <td width="220" style="background-color:#F5F5DC;"><b>Realisasi Anggaran</b> <small class="text-red">*</small></td>
                    <td>
                        <div class="form-group <?php if(form_error('realisasi_anggaran')) echo 'has-error'?> ">
                        <input type="text" class="form-control uang" name="realisasi_anggaran" id="realisasi" placeholder="Realisasi Anggaran" value="<?php echo $realisasi_anggaran; ?>" autocomplete="off"/>
                        <?php echo form_error('realisasi_anggaran', '<small style="color:red">','</small>') ?>
                    </div>
                    </td>
                </tr>

                <tr>
                    <td width="220" style="background-color:#F5F5DC;"><b>Persentase</b> <small class="text-red">*</small></td>
                    <td>
                        <div class="form-group <?php if(form_error('persentase')) echo 'has-error'?> ">
                        <input type="text" class="form-control persen" name="persentase" id="persentase" placeholder="Persentase" value="<?php echo $persentase; ?>" / readonly>
                        <?php echo form_error('persentase', '<small style="color:red">','</small>') ?>
                    </div>
                    </td>
                </tr>

                <tr>
                    <td width="220" style="background-color:#F5F5DC;"><b>Realisasi Capaian</b> <small class="text-red">*</small></td>
                    <td>
                        <div class="form-group <?php if(form_error('realisasi_capaian')) echo 'has-error'?> ">
                        <textarea class="form-control" rows="3" name="realisasi_capaian" id="realisasi_capaian" placeholder="Realisasi Capaian"><?php echo $realisasi_capaian; ?></textarea>
                        <?php echo form_error('realisasi_capaian', '<small style="color:red">','</small>') ?>
                    </div>
                    </td>
                </tr>

                </table>
                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.uang').mask('000.000.000.000.000,00', {reverse: true, placeholder: ""});
    });

    $('.uang').on('input', function() {
        hitungPersentase();
    });


        function hitungPersentase() {
            var alokasi = parseFloat($('#alokasi').cleanVal());
            var realisasi = parseFloat($('#realisasi').cleanVal());

            if (!isNaN(alokasi) && !isNaN(realisasi) && alokasi !== 0) {
                var persentase = (realisasi / alokasi * 100).toFixed(0);
                $('#persentase').val(persentase + "%");
            } else {
                $('#persentase').val("");
            }
        }

</script>