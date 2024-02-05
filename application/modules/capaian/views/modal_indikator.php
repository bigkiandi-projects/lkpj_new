<div>
	<form method="post" action="<?= base_url('capaian/save_edit_indikator/').$id ?>" id="formIndikator">


	<table class="table table-bordered" width="100%">
        <tr>
            <td width="90" style="background-color:#F5F5DC;"><b>Kode</b> <small class="text-red">*</small></td>
            <td><?= $result->kd ?></td>
        </tr>

        <tr>
            <td width="90" style="background-color:#F5F5DC;"><b>Program/Kegiatan</b> <small class="text-red">*</small></td>
            <td><?= $result->program ?></td>
        </tr>
        <tr>
            <td width="90" style="background-color:#F5F5DC;"><b>Indikator Kinerja</b> <small class="text-red">*</small></td>
            <td>
            	<div class="form-group">
			   		<textarea class="form-control" name="indikator"><?= $result->indikator ?></textarea>
			   	</div>
            </td>
        </tr>

    </table>


   </form>
</div>