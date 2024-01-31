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
                        <a href="<?php echo base_url('bidang_add') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <form action="<?php echo $action; ?>" method="post">

                        	    <div class="form-group">
                                    <label for="varchar">Pilih Bidang</label>
                                    <select class="form-control select2" id="bidAppend">
                                        <option disabled selected>---</option>
                                        <?php foreach($bidang as $a) { ?>
                                            <option value="<?= $a->kdBid ?>" data-bid="<?= $a->nmBid ?>">
                                                <?= $a->kdBid." ".$a->nmBid ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group <?php if(form_error('kode_bidang')) echo 'has-error'?> ">
                                    <input type="text" class="form-control" name="kode_bidang" id="kode_bidang" placeholder="Kode Bidang" value="<?php echo $kode_bidang; ?>" readonly />
                                    <?php echo form_error('kode_bidang', '<small style="color:red">','</small>') ?>
                                </div>

                                <div class="form-group <?php if(form_error('nama_bidang')) echo 'has-error'?> ">
                                    <input type="text" class="form-control" name="nama_bidang" id="nama_bidang" placeholder="Nama Bidang" value="<?php echo $nama_bidang; ?>" readonly />
                                    <?php echo form_error('nama_bidang', '<small style="color:red">','</small>') ?>
                                </div>
                        	    

                        	    <input type="hidden" name="id_ba" value="<?php echo $id_ba; ?>" /> 
                        	    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>

                        	</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $( "#bidAppend" ).on( "change", function() {
        var element = $("option:selected", this);
        nm = element.attr("data-bid") + " ";
        id = element.val();
        $('#nama_bidang').val(nm);
        $('#kode_bidang').val(id);
    });
</script>