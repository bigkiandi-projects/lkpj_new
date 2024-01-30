<?php $pengaturan = $this->db->get('pengaturan')->row_array(); ?>

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
                <h2>0</h2>
                <h4 class="text-green">Pagu</h4>
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
        <h4>GRAFIK PERSENTASE PROGRES PENYUSUNAN CAPAIAN KINERJA</h4>
        <h4>PER / OPD <?= $this->session->userdata('ta') ?></h4>

        <div id="progres"></div>
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
      "endValue": 70,
      "axisFill": {
        "fillOpacity": 1,
        "fill": "#88AB75",
        "zIndex": -1
      }
    }, {
      "value": 70,
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
        "fill": "#DE8F6E",
        "zIndex": -1
      }
    }]
  }],

  // Add hands
  "hands": [{
    "type": "ClockHand",
    "value": 0,
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
label.text = "0 %";
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
      "endValue": 70,
      "axisFill": {
        "fillOpacity": 1,
        "fill": "#88AB75",
        "zIndex": -1
      }
    }, {
      "value": 70,
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
        "fill": "#DE8F6E",
        "zIndex": -1
      }
    }]
  }],

  // Add hands
  "hands": [{
    "type": "ClockHand",
    "value": 0,
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
label.text = "0%";

</script>


<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("progres", am4charts.XYChart);
chart.padding(40, 40, 40, 40);

var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.dataFields.category = "opd";
categoryAxis.renderer.minGridDistance = 1;
categoryAxis.renderer.inversed = true;
categoryAxis.renderer.grid.template.disabled = true;

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.min = 0;

var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.categoryY = "opd";
series.dataFields.valueX = "prog";
series.tooltipText = "{valueX.value}"
series.columns.template.strokeOpacity = 0;
series.columns.template.column.cornerRadiusBottomRight = 5;
series.columns.template.column.cornerRadiusTopRight = 5;

var labelBullet = series.bullets.push(new am4charts.LabelBullet())
labelBullet.label.horizontalCenter = "left";
labelBullet.label.dx = 10;
labelBullet.label.text = "{values.valueX.workingValue.formatNumber('#.0as')}";
labelBullet.locationX = 1;

// as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
series.columns.template.adapter.add("fill", function(fill, target){
  return chart.colors.getIndex(target.dataItem.index);
});

categoryAxis.sortBySeries = series;
chart.data = [
    {
      "opd": "DINAS PENDIDIKAN DAN KEBUDAYAAN",
      "prog": 0
    },
    {
      "opd": "DINAS KESEHATAN",
      "prog": 0
    },
    {
      "opd": "DINAS PEMBERDAYAAN MASYARAKAT DAN DESA",
      "prog": 0
    },
    {
      "opd": "DINAS PEKERJAAN UMUM DAN PENATAAN RUANG",
      "prog": 0
    },
    {
      "network": "DINAS PERDAGANGAN, PERINDUSTRIAN DAN TENAGA KERJA",
      "prog": 0
    },
    {
      "opd": "SEKRETARIAT DAERAH",
      "prog": 0
    },
    {
      "opd": "DINAS SOSIAL",
      "prog": 0
    },
    {
      "opd": "BADAN PERENCANAAN",
      "prog": 0
    },
    {
      "opd": "DINAS SATUAN POLISI PP DAN KEBAKARAN",
      "prog": 0
    },
    {
      "opd": "DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU",
      "prog": 0
    },
    {
      "opd": "BADAN PENANGGULANGAN BENCANA DAERAH",
      "prog": 0
    },
    {
      "opd": "DINAS PPPA, PENGENDALIAN PENDUDUK DAN KELUARGA BERENCANA",
      "prog": 0
    }
  ]



}); // end am4core.ready()
</script>