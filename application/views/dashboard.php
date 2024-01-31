<?php 
$pengaturan = $this->db->get('pengaturan')->row_array(); 

function hitungProgres($data) {
    $l= 0;
    foreach ($data as $user) {
        $tsub = countRates($user->bid);
        $treal = countP($user->bid);
        echo "<tr>";
        echo "<td>".$user->kdOpd."</td>";
        echo "<td>" . $user->nmOpd . "</td>";
        echo "<td width='50%'>";
        echo "<div class='clearfix'>
                    <small class='pull-right'>".hitungPersentase($treal, $tsub)." %</small>
              </div>
              <div class='progress lg'>
                    <div class='progress-bar progress-bar-green' style='width: ".hitungPersentase($treal, $tsub)."%;'></div>
              </div>";

        echo "</td>";
        echo "</tr>";
    }

}

// hitung total pagu
function hitungPagu($data) {
    $hasil= 0;
    foreach ($data as $user) {
      $hasil += countPagu($user->bid);
    }
    return $hasil;
}

// hitung realisasi
function hitungReal($data) {
    $result= 0;
    foreach ($data as $user) {
      $result += countReal($user->bid);
    }
    return $result;
}

// hitung real target
function hitungFisik($data) {
    $target= 0;
    $real=0;
    foreach ($data as $user) {
      $target += countTarget_fisik($user->bid);
      $real += countReal_fisik($user->bid);
    }
    return hitungPersentase($real, $target);
}

// hitung real anggaran
function hitungRealKeu($data) {
    $alokasi= 0;
    $real=0;
    foreach ($data as $user) {
      $alokasi += countPagu($user->bid);
      $real += countReal($user->bid);
    }
    return hitungPersentase($real, $alokasi);
}

function hitungPersentase($nilai, $total) {
    // Pastikan total tidak nol untuk menghindari pembagian dengan nol
    if ($total != 0) {
        $persentase = ($nilai / $total) * 100;
        return $persentase;
    } else {
        // Total nol, tetapi jika nilai juga nol, persentase adalah 0%
        return ($nilai == 0) ? 0 : null;
    }
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

function countP($banks) {
    $count = 0;
    foreach ($banks as $bank) {
        foreach ($bank->prg as $account) {
            foreach ($account->keg as $currency) {
                foreach ($currency->subkeg as $rate) {
                    if ($rate->real_target > 1 && $rate->real_ang > 1) {
                        $count++;
                    }
                }
            }
        }
    }
    return $count;
}

function countPagu($banks) {
    $pagu = 0;
    foreach ($banks as $bank) {
        foreach ($bank->prg as $account) {
            foreach ($account->keg as $currency) {
                foreach ($currency->subkeg as $rate) {
                    $pagu += $rate->alokasi_ang;
                }
            }
        }
    }
    return $pagu;
}

function countReal($banks) {
    $real = 0;
    foreach ($banks as $bank) {
        foreach ($bank->prg as $account) {
            foreach ($account->keg as $currency) {
                foreach ($currency->subkeg as $rate) {
                    $real += $rate->real_ang;
                }
            }
        }
    }
    return $real;
}

function countTarget_fisik($banks) {
    $target = 0;
    foreach ($banks as $bank) {
        foreach ($bank->prg as $account) {
            foreach ($account->keg as $currency) {
                foreach ($currency->subkeg as $rate) {
                    $target += $rate->target;
                }
            }
        }
    }
    return $target;
}

function countReal_fisik($banks) {
    $target = 0;
    foreach ($banks as $bank) {
        foreach ($bank->prg as $account) {
            foreach ($account->keg as $currency) {
                foreach ($currency->subkeg as $rate) {
                    $target += $rate->real_target;
                }
            }
        }
    }
    return $target;
}
 $realisasinya = number_format(hitungRealKeu($rk));
?>

<script src="//cdn.amcharts.com/lib/4/core.js"></script>
<script src="//cdn.amcharts.com/lib/4/charts.js"></script>
<script src="//cdn.amcharts.com/lib/4/themes/animated.js"></script>

<style type="text/css">
  #chartdiv {
  width: 100%;
  height: 150px;
  margin-top: 15px;
}
#progres {
  width: 100%;
  height: 350px;
}
</style>

<div class="row">

  <div class="col-md-12">
    <div class="box box-default">
      <div class="box-body text-center">
        <h4>REALISASI CAPAIAN PEMERINTAH KABUPATEN SERAM BAGIAN BARAT</h4>
        <h4>TAHUN ANGGARAN <?= $this->session->userdata('ta') ?></h4>

      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="box box-default">
            <div class="box-body text-center">
              <div id="fisik"></div>

              <h4 class="text-yellow">Progres Fisik (%)</h4>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box box-default">
            <div class="box-body text-center">
              <div id="keu"></div>

              <h4 class="text-green">Progres Keuangan (%)</h4>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box box-default">
            <div class="box-body">
              <div>
                <h2>Rp. <span class="alokasi_ang"><?= number_format(hitungPagu($rk), 2, ',', '.'); ?></span></h2>
                <h4 class="text-primary">Alokasi Anggaran</h4>
              </div>
              <div>
                <h2>Rp. <span class="real_ang"><?= number_format(hitungReal($rk), 2, ',', '.'); ?></span></h2>
                <h4 class="text-green">Realisasi Anggaran</h4>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

  <!-- progres penyusunan -->
  <div class="col-md-12">
    <div class="box box-default">
      <div class="box-body text-center">
        <h4>GRAFIK PERSENTASE PROGRES PENYUSUNAN LAPORAN CAPAIAN KINERJA</h4>
        <h4>PER / OPD <?= $this->session->userdata('ta') ?></h4>

          <div class="table-responsive">
              <table class="table table-bordered" width="100%">
                  
              <thead class="bg-primary">
                  <tr>
                      <th>Kode OPD</th>
                      <th>Organisasi Perangkat Daerah</th>
                      <th>Progres Penyusunan</th>
                  </tr>
              </thead>

              <tbody>
                  <?php number_format(hitungProgres($rk), 2, ',', '.'); ?>
              </tbody>

              </table>
          </div>
          
      </div>
    </div>
  </div>

</div>

<script type="text/javascript">

am4core.useTheme(am4themes_animated);

// Create chart
var chart = am4core.createFromConfig({

  // Set inner radius
  "innerRadius": -15,
  
  // Create axis
  "xAxes": [{
    "type": "ValueAxis",
    "min": 0,
    "max": 100,
    "strictMinMax": true,

    // Add ranges
    "axisRanges": [{
      "value": 0,
      "endValue": 65,
      "axisFill": {
        "fillOpacity": 1,
        "fill": "#DE8F6E",
        "zIndex": -1
      }
    }, {
      "value": 66,
      "endValue": 90,
      "axisFill": {
        "fillOpacity": 1,
        "fill": "#DBD56E",
        "zIndex": -1
      }
    }, {
      "value": 90,
      "endValue": 100,
      "axisFill": {
        "fillOpacity": 1,
        "fill": "#88AB75",
        "zIndex": -1
      }
    }]
  }],

  // Add hands
  "hands": [{
    "type": "ClockHand",
    "value": <?= number_format(hitungFisik($rk)); ?>,
    "fill": "#2D93AD",
    "stroke": "#2D93AD",
    "innerRadius": "30%",
    "radius": "90%",
    "startWidth": 15,
    "pin": {
      "disabled": true
    }
  }]

}, "fisik", am4charts.GaugeChart);

var label = chart.radarContainer.createChild(am4core.Label);
label.isMeasured = false;
label.fontSize = 25;
label.horizontalCenter = "middle";
label.verticalCenter = "bottom";
label.text = <?= number_format(hitungFisik($rk)); ?>+"%";
</script>

<script type="text/javascript">

am4core.useTheme(am4themes_animated);

// Create chart
var chart = am4core.createFromConfig({

  // Set inner radius
  "innerRadius": -15,
  
  // Create axis
  "xAxes": [{
    "type": "ValueAxis",
    "min": 0,
    "max": 100,
    "strictMinMax": true,

    // Add ranges
    "axisRanges": [{
      "value": 0,
      "endValue": 65,
      "axisFill": {
        "fillOpacity": 1,
        "fill": "#DE8F6E",
        "zIndex": -1
      }
    }, {
      "value": 66,
      "endValue": 90,
      "axisFill": {
        "fillOpacity": 1,
        "fill": "#DBD56E",
        "zIndex": -1
      }
    }, {
      "value": 90,
      "endValue": 100,
      "axisFill": {
        "fillOpacity": 1,
        "fill": "#88AB75",
        "zIndex": -1
      }
    }]
  }],

  // Add hands
  "hands": [{
    "type": "ClockHand",
    "value": <?= $realisasinya ?>,
    "fill": "#2D93AD",
    "stroke": "#2D93AD",
    "innerRadius": "30%",
    "radius": "90%",
    "startWidth": 15,
    "pin": {
      "disabled": true
    }
  }]

}, "keu", am4charts.GaugeChart);

var label = chart.radarContainer.createChild(am4core.Label);
label.isMeasured = false;
label.fontSize = 25;
label.horizontalCenter = "middle";
label.verticalCenter = "bottom";
label.text = <?= $realisasinya ?>+"%";

</script>