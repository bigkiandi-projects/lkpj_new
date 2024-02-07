<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-right">
                    <div class="box-title">
                        <a href="<?php echo base_url('data_dukung') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>

                <div class="info-card">
                    <h4><i class="fa fa-edit"></i> <?php echo $judul ?></h4>
                    <div class="info-app yellow">
                        <i class="fas fa-info-circle"></i>
                    Form Pelaporan Data Dukung LKPJ. Harap melakukan input data sebagaimana tertera.
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                    <form action="<?php echo $action; ?>" method="post">

                        <div class="form-group <?php if(form_error('opd')) echo 'has-error'?> ">
                            <label for="varchar">OPD</label>
                            <input type="text" class="form-control" name="opd" id="opd" placeholder="opd" value="<?php echo $opd->nmOpd; ?>" readonly/>
                            <?php echo form_error('opd', '<small style="color:red">','</small>') ?>
                        </div>

                        <div class="form-group <?php if(form_error('tahun')) echo 'has-error'?> ">
                            <label for="year">Tahun</label>
                            <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun" value="<?php echo $this->session->userdata('ta'); ?>" readonly/>
                        </div>


                	    <div class="form-group <?php if(form_error('triwulan')) echo 'has-error'?> ">
                            <label for="varchar">Triwulan</label>
                            <select class="form-control">
                                <option selected disabled>-pilih triwulan-</option>
                                <option>Triwulan I</option>
                                <option>Triwulan II</option>
                                <option>Triwulan III</option>
                                <option>Triwulan IV</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Dokumen Perencanaan</label>
                            <input type="file" name="renstra">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Laporan Evaluasi</label>
                            <input type="file" name="lap_evaluasi">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Laporan LKPJ</label>
                            <input type="file" name="lkpj">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Data Sektoral</label>
                            <input type="file" name="sektoral">
                        </div>

                        <input type="hidden" name="id_opd" value="<?php echo $opd->idOpd; ?>" />

                	    <input type="hidden" name="id_data_dukung" value="<?php echo $id_data_dukung; ?>" /> 
                	    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
                	</form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>