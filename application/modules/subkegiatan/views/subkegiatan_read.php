
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
                        <a href="<?php echo base_url('subkegiatan') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                 <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                     <table class="table">
	    <tr><td>KdSubkeg</td><td><?php echo $kdSubkeg; ?></td></tr>
	    <tr><td>NmSubkeg</td><td><?php echo $nmSubkeg; ?></td></tr>
	    <tr><td>Kinerja</td><td><?php echo $kinerja; ?></td></tr>
	    <tr><td>Indikator</td><td><?php echo $indikator; ?></td></tr>
	    <tr><td>Satuan</td><td><?php echo $satuan; ?></td></tr>
	    <tr><td>P Id</td><td><?php echo $p_id; ?></td></tr>
	</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>