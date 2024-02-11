<style type="text/css">
    input[type=file] {
    display: block !important;
    right: 1px;
    top: 1px;
    height: 34px;
    opacity: 0;
  width: 100%;
    background: none;
    position: absolute;
  overflow: hidden;
  z-index: 2;
}

.control-fileupload {
    display: block;
    border: 1px solid #d6d7d6;
    background: #FFF;
    border-radius: 4px;
    width: 100%;
    height: 36px;
    line-height: 36px;
    padding: 0px 10px 2px 10px;
  overflow: hidden;
  position: relative;
  
  &:before, input, label {
    cursor: pointer !important;
  }
  /* File upload button */
  &:before {
    /* inherit from boostrap btn styles */
    padding: 4px 12px;
    margin-bottom: 0;
    font-size: 14px;
    line-height: 20px;
    color: #333333;
    text-align: center;
    text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
    vertical-align: middle;
    cursor: pointer;
    background-color: #f5f5f5;
    background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
    background-repeat: repeat-x;
    border: 1px solid #cccccc;
    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
    border-bottom-color: #b3b3b3;
    border-radius: 4px;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
    transition: color 0.2s ease;

    /* add more custom styles*/
    content: 'Browse';
    display: block;
    position: absolute;
    z-index: 1;
    top: 2px;
    right: 2px;
    line-height: 20px;
    text-align: center;
  }
  &:hover, &:focus {
    &:before {
      color: #333333;
      background-color: #e6e6e6;
      color: #333333;
      text-decoration: none;
      background-position: 0 -15px;
      transition: background-position 0.2s ease-out;
    }
  }
  
  label {
    line-height: 24px;
    color: #999999;
    font-size: 14px;
    font-weight: normal;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    position: relative;
    z-index: 1;
    margin-right: 90px;
    margin-bottom: 0px;
    cursor: text;
  }
}
</style>

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

                <form action="<?php echo $action; ?>" method="post" enctype='multipart/form-data'>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td width="120" style="background-color:#F5F5DC;"><b>OPD</b> <small class="text-red">*</small></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="opd" id="opd" placeholder="opd" value="<?php echo $opd->nama_user; ?>" readonly/>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="background-color:#F5F5DC;"><b>Tahun</b> <small class="text-red">*</small></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun" value="<?php echo $this->session->userdata('ta'); ?>" readonly/>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="background-color:#F5F5DC;"><b>Triwulan</b> <small class="text-red">*</small></td>
                                <td>
                                    <?php if($button == 'Update') { ?>
                                        <input type="text" class="form-control" name="triwulan" value="<?= $triwulan ?>" readonly>
                                    <?php } else { ?>
                                    <div class="form-group">
                                        <select class="form-control" name="triwulan">
                                            <option selected disabled>- Pilih Triwulan -</option>
                                            <?php foreach($trw as $k) { ?>
                                                <option><?= $k ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php } ?>
                                </td>
                            </tr>

                            <tr>
                                <td style="background-color:#F5F5DC;"><b>Dokumen Perencanaan</b> <small class="text-red">*</small></td>
                                <td>
                                    <?php if($button === 'Update') {?>
                                    <div class="form-group row col-md-6">
                                        <span class="control-fileupload">
                                          <label for="fileInput">Existing File : <?= isset($data_dkg->dok_perencanaan) ? $data_dkg->dok_perencanaan : "No Data"  ?> </label>
                                          <input type="file" id="fileInput" name="renstra">
                                        </span>
                                    </div>
                                    <?php } else { ?>
                                    <div class="form-group row col-md-6">
                                        <span class="control-fileupload">
                                          <label for="fileInput">Pilih File : </label>
                                          <input type="file" id="fileInput" name="renstra">
                                        </span>
                                    </div>
                                    <?php } ?>
                                </td>
                            </tr>

                            <tr>
                                <td style="background-color:#F5F5DC;"><b>Laporan Evaluasi</b> <small class="text-red">*</small></td>
                                <td>
                                    <?php if($button === 'Update') {?>
                                    <div class="form-group row col-md-6">
                                        <span class="control-fileupload">
                                          <label for="fileInput">Existing File : <?= isset($data_dkg->lap_evaluasi) ? $data_dkg->lap_evaluasi : "No Data"  ?></label>
                                          <input type="file" id="fileInput" name="lap_evaluasi">
                                        </span>
                                    </div>
                                    <?php } else { ?>
                                    <div class="form-group row col-md-6">
                                        <span class="control-fileupload">
                                          <label for="fileInput">Pilih File : </label>
                                          <input type="file" id="fileInput" name="lap_evaluasi">
                                        </span>
                                    </div>
                                    <?php } ?>
                                </td>
                            </tr>

                            <tr>
                                <td style="background-color:#F5F5DC;"><b>Laporan LKPJ</b> <small class="text-red">*</small></td>
                                <td>
                                    <?php if($button === 'Update') {?>
                                    <div class="form-group row col-md-6">
                                        <span class="control-fileupload">
                                          <label for="fileInput">Existing File : <?= isset($data_dkg->lap_lkpj) ? $data_dkg->lap_lkpj : "No Data"  ?></label>
                                          <input type="file" id="fileInput" name="lkpj">
                                        </span>
                                    </div>
                                    <?php } else { ?>
                                    <div class="form-group row col-md-6">
                                        <span class="control-fileupload">
                                          <label for="fileInput">Pilih File : </label>
                                          <input type="file" id="fileInput" name="lkpj">
                                        </span>
                                    </div>
                                    <?php } ?>
                                </td>
                            </tr>

                            <tr>
                                <td style="background-color:#F5F5DC;"><b>Data Sektoral</b> <small class="text-red">*</small></td>
                                <td>
                                    <?php if($button === 'Update') {?>
                                    <div class="form-group row col-md-6">
                                        <span class="control-fileupload">
                                          <label for="fileInput">Existing File : <?= isset($data_dkg->data_sektoral) ? $data_dkg->data_sektoral : "No Data"  ?></label>
                                          <input type="file" id="fileInput" name="sektoral">
                                        </span>
                                    </div>
                                    <?php } else { ?>
                                    <div class="form-group row col-md-6">
                                        <span class="control-fileupload">
                                          <label for="fileInput">Pilih File : </label>
                                          <input type="file" id="fileInput" name="sektoral">
                                        </span>
                                    </div>
                                    <?php } ?>
                                </td>
                            </tr>

                            <tr>
                                <td style="background-color:#F5F5DC;"><b>Keterangan</b></td>
                                <td><p class="text-orange"><i class=" fas fa-info-circle"></i> Biarkan default jika Dokumen Tidak di ganti / di rubah.</p></td>
                            </tr>


                        </table>

                    <?php if($button === 'Update') {?>
                        <input type="hidden" name="id_data_dkg" value="<?= $data_dkg->id_data_dukung_berkas ?>">
                    <?php } ?>

                    <input type="hidden" name="id_opd" value="<?= $this->session->userdata('id_user') ?>" />

            	    <input type="hidden" name="id_data_dukung" value="<?php echo $id_data_dukung; ?>" /> 
            	    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
            	</form>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
  $('input[type=file]').change(function(){
    var t = $(this).val();
    var labelText = 'File Baru : ' + t.substr(12, t.length);
    $(this).prev('label').text(labelText);
  })
});
</script>
