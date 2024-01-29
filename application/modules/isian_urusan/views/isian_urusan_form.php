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
                        <a href="<?php echo base_url('isian_urusan') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form action="<?php echo $action; ?>" method="post">
            	            <div class="form-group <?php if(form_error('kode_urusan')) echo 'has-error'?> ">
                                <label for="varchar">Kode Urusan</label>
                                <input type="text" class="form-control" name="kode_urusan" id="kode_urusan" placeholder="Kode Urusan" value="<?php echo $kode_urusan; ?>" />
                                <?php echo form_error('kode_urusan', '<small style="color:red">','</small>') ?>
                            </div>
            	            <div class="form-group <?php if(form_error('opd')) echo 'has-error'?> ">
                                <label for="varchar">Opd</label>
                                <input type="text" class="form-control" name="opd" id="opd" placeholder="Opd" value="<?php echo $opd; ?>" />
                                <?php echo form_error('opd', '<small style="color:red">','</small>') ?>
                            </div>
            	            <div class="form-group <?php if(form_error('tahun')) echo 'has-error'?> ">
                                <label for="year">Tahun</label>
                                <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun" value="<?php echo $tahun; ?>" />
                                <?php echo form_error('tahun', '<small style="color:red">','</small>') ?>
                            </div>
                    	    <input type="hidden" name="id_isian_urusan" value="<?php echo $id_isian_urusan; ?>" /> 
                    	    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>