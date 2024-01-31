
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <div class="info-card pull-left">
                    <h4><i class="fas fa-poll"></i> <?php echo $judul ?> Pemilihan Program/Kegiatan/Sub Kegiatan</h4>
                    <div class="info-app yellow">
                        <i class="fas fa-info-circle"></i>
                        Fitur ini digunakan bagi Operator Bappeda untuk melakukan pemilihan Data Program, Kegiatan, Dan Sub Kegiatan bagi setiap OPD.
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%">
                        <form method="get" action="<?= base_url('capaian/generate') ?>">
                            <tr>
                                <td width="30" style="background-color:#F5F5DC;"><b>Organisasi Perangkat Daerah</b> <small class="text-red">*</small></td>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control" name="opd" id="opd">
                                            <option disabled selected>---</option>
                                            <?php foreach($opd as $a) { ?>
                                                <option value="<?= $a->kdOpd ?>" data-nama="<?= $a->nmOpd ?>" data-id="<?= $a->idOpd ?>"><?= $a->kdOpd." ".$a->nmOpd ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" name="namaOpd" id="namaOpd">
                                        <input type="hidden" name="idOpd" id="idOpd">
                                    </div>
                                </td>
                            <tr>
                        <tr>
                            <td style="background-color:#F5F5DC;"><b>Tahun LKPJ</b> <small class="text-red">*</small></td>
                            <td>
                                <div class="form-group">
                                    <select class="form-control" name="tahun">
                                        <option value="<?= $this->session->userdata('ta') ?>" selected><?= $this->session->userdata('ta') ?></option>
                                    </select>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td style="background-color:#F5F5DC;"><b>Status Database</b></td>
                            <td>
                                <textarea class="form-control" disabled>Kepmendagri No. 050-5889 Tahun 2021 tentang Hasil Verifikasi, Validasi, dan Inventarisasi Klasifikasi, Kodefikasi, dan Nomenklatur Perencanaan Pembangunan dan Keuangan Daerah</textarea>
                            </td>
                        </tr>

                        <tr>
                            <td style="background-color:#F5F5DC;"><b>Bidang Lainnya</b></td>
                            <td>
                                <?php foreach($bidang_add as $s) { ?>
                                    <div class="form-group">
                                        <input type="checkbox" name="ur" value="<?= $s->kode_bidang ?>">
                                        <label><?= $s->nama_bidang ?></label>
                                    </div>
                                <?php } ?>
                                <p class="text-danger"><i class="fas fa-info-circle"></i> centang jika ingin menambahkan program/keg/sub kegiatan untuk non urusan dan bidang sebagaimana tertera.</p>
                            </td>
                        </tr>

                        <tr>
                            <td style="background-color:#F5F5DC;">Opsi</td>
                            <td>
                                <button class="btn btn-primary"><i class="glyphicon glyphicon-cog"></i> Terapkan</button>
                            </td>
                        </tr>

                        </form>

                    </table>
                </div>
                 
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#opd").change(function(){
        var element = $("option:selected", this);
        var myTag = element.attr("data-nama");
        var myId = element.attr("data-id");

        $('#namaOpd').val(myTag);
        $('#idOpd').val(myId);
    });
</script>
