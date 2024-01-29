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
                        <a href="<?php echo base_url('capaian') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group <?php if(form_error('idOpd')) echo 'has-error'?> ">
                            <label for="varchar">IdOpd</label>
                            <input type="text" class="form-control" name="idOpd" id="idOpd" placeholder="IdOpd" value="<?php echo $idOpd; ?>" />
                            <?php echo form_error('idOpd', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('kd')) echo 'has-error'?> ">
                            <label for="varchar">Kd</label>
                            <input type="text" class="form-control" name="kd" id="kd" placeholder="Kd" value="<?php echo $kd; ?>" />
                            <?php echo form_error('kd', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('target')) echo 'has-error'?> ">
                            <label for="varchar">Target</label>
                            <input type="text" class="form-control" name="target" id="target" placeholder="Target" value="<?php echo $target; ?>" />
                            <?php echo form_error('target', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('real_target')) echo 'has-error'?> ">
                            <label for="varchar">Real Target</label>
                            <input type="text" class="form-control" name="real_target" id="real_target" placeholder="Real Target" value="<?php echo $real_target; ?>" />
                            <?php echo form_error('real_target', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('alokasi_ang')) echo 'has-error'?> ">
                            <label for="bigint">Alokasi Ang</label>
                            <input type="text" class="form-control" name="alokasi_ang" id="alokasi_ang" placeholder="Alokasi Ang" value="<?php echo $alokasi_ang; ?>" />
                            <?php echo form_error('alokasi_ang', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('real_ang')) echo 'has-error'?> ">
                            <label for="bigint">Real Ang</label>
                            <input type="text" class="form-control" name="real_ang" id="real_ang" placeholder="Real Ang" value="<?php echo $real_ang; ?>" />
                            <?php echo form_error('real_ang', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('presentasi')) echo 'has-error'?> ">
                            <label for="bigint">Presentasi</label>
                            <input type="text" class="form-control" name="presentasi" id="presentasi" placeholder="Presentasi" value="<?php echo $presentasi; ?>" />
                            <?php echo form_error('presentasi', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('permasalahan')) echo 'has-error'?> ">
                            <label for="permasalahan">Permasalahan</label>
                            <textarea class="form-control" rows="3" name="permasalahan" id="permasalahan" placeholder="Permasalahan"><?php echo $permasalahan; ?></textarea>
                            <?php echo form_error('permasalahan', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('upaya')) echo 'has-error'?> ">
                            <label for="upaya">Upaya</label>
                            <textarea class="form-control" rows="3" name="upaya" id="upaya" placeholder="Upaya"><?php echo $upaya; ?></textarea>
                            <?php echo form_error('upaya', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('tl')) echo 'has-error'?> ">
                            <label for="tl">Tl</label>
                            <textarea class="form-control" rows="3" name="tl" id="tl" placeholder="Tl"><?php echo $tl; ?></textarea>
                            <?php echo form_error('tl', '<small style="color:red">','</small>') ?>
                        </div>
	    <div class="form-group <?php if(form_error('tahun')) echo 'has-error'?> ">
                            <label for="year">Tahun</label>
                            <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun" value="<?php echo $tahun; ?>" />
                            <?php echo form_error('tahun', '<small style="color:red">','</small>') ?>
                        </div>
	    <input type="hidden" name="idCapai" value="<?php echo $idCapai; ?>" /> 
	    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
	</form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>