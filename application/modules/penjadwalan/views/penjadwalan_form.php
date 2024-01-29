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
                        <a href="<?php echo base_url('penjadwalan') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group <?php if(form_error('tgl_mulai')) echo 'has-error'?> ">
                            <label for="datetime">Tgl Mulai</label>
                            <input type="text" class="form-control" name="tgl_mulai" id="tgl_mulai" placeholder="Tgl Mulai" value="<?php echo $tgl_mulai; ?>" />
                            <?php echo form_error('tgl_mulai', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('tgl_selesai')) echo 'has-error'?> ">
                            <label for="datetime">Tgl Selesai</label>
                            <input type="text" class="form-control" name="tgl_selesai" id="tgl_selesai" placeholder="Tgl Selesai" value="<?php echo $tgl_selesai; ?>" />
                            <?php echo form_error('tgl_selesai', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('status')) echo 'has-error'?> ">
                            <label for="char">Status</label>
                            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                            <?php echo form_error('status', '<small style="color:red">','</small>') ?>
                        </div>
	    <input type="hidden" name="id_jadwal" value="<?php echo $id_jadwal; ?>" /> 
	    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
	</form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>