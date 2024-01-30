<?php

function displayUserTable($data) {
    $l= 0;
    foreach ($data as $user) {
        echo "<tr>";
        echo "<td>".$user->kdOpd."</td>";
        echo "<td>" . $user->nmOpd . "</td>";
        echo "<td>" . countAccounts($user->bid) . "</td>";
        echo "<td>" . countCurrencies($user->bid) . "</td>";
        echo "<td>" . countRates($user->bid) . "</td>";
        echo "<td>" . countRatesInRange($user->bid, 0, 65) . "</td>";
        echo "<td>" . countRatesInRange($user->bid, 65, 90) . "</td>";
        echo "<td>" . countRatesInRange($user->bid, 90, PHP_INT_MAX) . "</td>";
        echo "</tr>";
    }

}


function countAccounts($banks) {
    $count = 0;
    foreach ($banks as $bank) {
        $count += count($bank->prg);
    }
    return $count;
}

function countCurrencies($banks) {
    $count = 0;
    foreach ($banks as $bank) {
        foreach ($bank->prg as $account) {
            $count += count($account->keg);
        }
    }
    return $count;
}

function countRates($banks) {
    $count = 0;
    foreach ($banks as $bank) {
        foreach ($bank->prg as $account) {
            foreach ($account->keg as $currency) {
                $count += count($currency->subkeg);
            }
        }
    }
    return $count;
}


function countRatesInRange($banks, $min, $max) {
    $count = 0;
    foreach ($banks as $bank) {
        foreach ($bank->prg as $account) {
            foreach ($account->keg as $currency) {
                foreach ($currency->subkeg as $rate) {
                    if ($rate->presentasi > $min && $rate->presentasi < $max) {
                        $count++;
                    }
                }
            }
        }
    }
    return $count;
}


?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <div class="info-card pull-left">
                    <h4><i class="fas fa-poll"></i> <?php echo $judul ?></h4>
                    <div class="info-app yellow">
                        <i class="fas fa-info-circle"></i>
                    Rekapitulasi Jumlah Program/Kegiatan/Sub Kegiatan & Persentase Capaian Kinerja Tahun <?= $this->session->userdata('ta') ?>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="box-title">
                        <a href="<?php echo base_url('capaian') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">

                <div class="table-responsive">
                    <table class="table table-bordered" width="100%">
                    	
                    <thead class="bg-primary">
	                    <tr>
                            <th rowspan="2">Kode</th>
						    <th rowspan="2">Nama Perangkat Daerah</th>
						    <th colspan="3">Jumlah</th>
						    <th colspan="3">Realisasi Kegiatan %</th>
	                    </tr>
	                    <tr>
	                    	<th>Program</th>
	                    	<th>Kegiatan</th>
	                    	<th>Sub Kegiatan</th>

	                    	<th>≤65</th>
	                    	<th>65-90</th>
	                    	<th>>90</th>
	                    </tr>
                    </thead>

                    <tbody>
                    	<?php displayUserTable($rk); ?>
                    </tbody>

                    </table>
                </div>
                 
            </div>
        </div>
    
    </div>

</div>
