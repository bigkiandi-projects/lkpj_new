
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
                        <a href="<?php echo base_url('permendagri') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                 <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                     <table class="table">
	    <tr><td>Kode</td><td><?php echo $Kode; ?></td></tr>
	    <tr><td>Bidang Urusan Program Kegiatan Sub Kegiatan</td><td><?php echo $Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan; ?></td></tr>
	    <tr><td>Kinerja</td><td><?php echo $Kinerja; ?></td></tr>
	    <tr><td>Indikator</td><td><?php echo $Indikator; ?></td></tr>
	    <tr><td>Satuan</td><td><?php echo $Satuan; ?></td></tr>
	    <tr><td>P Id</td><td><?php echo $p_id; ?></td></tr>
	</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>