
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
                        <a href="<?php echo base_url('kegiatan') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                 <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                     <table class="table">
	    <tr><td>KdKeg</td><td><?php echo $kdKeg; ?></td></tr>
	    <tr><td>NmKeg</td><td><?php echo $nmKeg; ?></td></tr>
	    <tr><td>P Id</td><td><?php echo $p_id; ?></td></tr>
	</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>