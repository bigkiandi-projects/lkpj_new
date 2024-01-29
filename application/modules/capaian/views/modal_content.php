
<div>
	<form method="post" action="<?= base_url('capaian/save_edit_cp/').$id ?>" id="myform">


	<table class="table table-bordered" width="100%">
        <tr>
            <td width="90" style="background-color:#F5F5DC;"><b>Kode</b> <small class="text-red">*</small></td>
            <td><?= $result->kd ?></td>
        </tr>

        <tr>
            <td width="90" style="background-color:#F5F5DC;"><b>Kebijakan</b> <small class="text-red">*</small></td>
            <td>
                <div class="form-group">
                    <textarea class="form-control" name="kebijakan"><?= $result->kebijakan ?></textarea>
                </div>
           </td>
        </tr>

        <tr>
            <td width="90" style="background-color:#F5F5DC;"><b>Sub Kegiatan</b> <small class="text-red">*</small></td>
            <td><?= $result->program ?></td>
        </tr>
        <tr>
            <td width="90" style="background-color:#F5F5DC;"><b>Indikator Kinerja</b> <small class="text-red">*</small></td>
            <td><?= $result->indikator ?></td>
        </tr>
        <tr>
            <td width="90" style="background-color:#F5F5DC;"><b>Satuan</b> <small class="text-red">*</small></td>
            <td><?= $result->satuan ?></td>
        </tr>

        <tr>
            <td width="90" style="background-color:#F5F5DC;"><b>Target</b> <small class="text-red">*</small></td>
            <td>
	            <div class="form-group">
			   		<input type="number" name="target" class="form-control" value="<?= $result->target ?>">
			   	</div>
		   </td>
        </tr>

        <tr>
            <td width="90" style="background-color:#F5F5DC;"><b>Realisasi Target</b> <small class="text-red">*</small></td>
            <td>
	            <div class="form-group">
			   		<input type="number" name="real_target" class="form-control" value="<?= $result->real_target ?>">
			   	</div>
		   </td>
        </tr>

        <tr>
            <td width="90" style="background-color:#F5F5DC;"><b>Alokasi Anggaran</b> <small class="text-red">*</small></td>
            <td>
	            <div class="form-group">
	            	<input type="text" name="alokasi_ang" class="form-control uang" value="<?= $result->alokasi_ang ?>">
			   	</div>
		   </td>
        </tr>

        <tr>
            <td width="90" style="background-color:#F5F5DC;"><b>Realisasi Anggaran</b> <small class="text-red">*</small></td>
            <td>
	            <div class="form-group">
	            	<input type="text" name="real_ang" class="form-control uang" value="<?= $result->real_ang ?>">
			   	</div>
		   </td>
        </tr>

        <tr>
            <td width="90" style="background-color:#F5F5DC;"><b>Permasalahan</b> <small class="text-red">*</small></td>
            <td>
	            <div class="form-group">
	            	<textarea class="form-control" rows="4" name="permasalahan"><?= $result->permasalahan ?></textarea>
			   	</div>
		   </td>
        </tr>

        <tr>
            <td width="90" style="background-color:#F5F5DC;"><b>Upaya Mengatasi Permasalahan</b> <small class="text-red">*</small></td>
            <td>
	            <div class="form-group">
	            	<textarea class="form-control" rows="4" name="upaya"><?= $result->upaya ?></textarea>
			   	</div>
		   </td>
        </tr>

        <tr>
            <td width="90" style="background-color:#F5F5DC;"><b>Tindak Lanjut Rekomendasi DPRD</b> <small class="text-red">*</small></td>
            <td>
	            <div class="form-group">
	            	<textarea class="form-control" rows="4" name="tl"><?= $result->tl ?></textarea>
			   	</div>
		   </td>
        </tr>

    </table>

   	<!-- <?php if(!empty($result->indikator)) { ?>
   	<div class="form-group">
   		<label id="kd">Target</label>
   		<input type="number" name="target" class="form-control" value="<?= $result->target ?>">
   	</div>
   	<?php } ?>

   	<?php if(!empty($result->indikator)) { ?>
   	<div class="form-group">
   		<label id="kd">Realisasi Target</label>
   		<input type="number" name="real_target" class="form-control" value="<?= $result->real_target ?>">
   	</div>
   	<?php } ?>

   	<?php if(!empty($result->indikator)) { ?>
   	<div class="form-group">
   		<label id="kd">Alokasi Anggaran</label>
   		<input type="text" name="alokasi_ang" class="form-control uang" value="<?= $result->alokasi_ang ?>">
   	</div>
   	<?php } ?>

   	<?php if(!empty($result->indikator)) { ?>
   	<div class="form-group">
   		<label id="kd">Realisasi Anggaran</label>
   		<input type="text" name="real_ang" class="form-control uang" value="<?= $result->real_ang ?>">
   	</div>
   	<?php } ?>

   	<?php if(!empty($result->indikator)) { ?>
   	<div class="form-group">
   		<label id="kd">Permasalahan</label>
   		<textarea class="form-control" rows="4" name="permasalahan"><?= $result->permasalahan ?></textarea>
   	</div>
   	<?php } ?>

   	<?php if(!empty($result->indikator)) { ?>
   	<div class="form-group">
   		<label id="kd">Upaya Mengatasi Permasalahan</label>
   		<textarea class="form-control" rows="4" name="upaya"><?= $result->upaya ?></textarea>
   	</div>
   	<?php } ?>

   	<?php if(!empty($result->indikator)) { ?>
   	<div class="form-group">
   		<label id="kd">Tindak Lanjut Rekomendasi</label>
   		<textarea class="form-control" rows="4" name="tl"><?= $result->tl ?></textarea>
   	</div>
   	<?php } ?> -->

   </form>

</div>