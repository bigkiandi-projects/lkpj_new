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
                        <a href="<?php echo base_url('bidang') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group <?php if(form_error('kdBid')) echo 'has-error'?> ">
                            <label for="varchar">KdBid</label>
                            <input type="text" class="form-control" name="kdBid" id="kdBid" placeholder="KdBid" value="<?php echo $kdBid; ?>" />
                            <?php echo form_error('kdBid', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('nmBid')) echo 'has-error'?> ">
                            <label for="nmBid">NmBid</label>
                            <textarea class="form-control" rows="3" name="nmBid" id="nmBid" placeholder="NmBid"><?php echo $nmBid; ?></textarea>
                            <?php echo form_error('nmBid', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('p_id')) echo 'has-error'?> ">
                            <label for="varchar">P Id</label>
                            <input type="text" class="form-control" name="p_id" id="p_id" placeholder="P Id" value="<?php echo $p_id; ?>" />
                            <?php echo form_error('p_id', '<small style="color:red">','</small>') ?>
                        </div>
	    <input type="hidden" name="idBid" value="<?php echo $idBid; ?>" /> 
	    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
	</form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>