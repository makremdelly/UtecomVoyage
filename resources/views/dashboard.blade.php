@extends('layouts.dash')
@section('content')
<!-- Main Content -->
<div class="section-body">
  <div class="row">
    {{-- CARD 1 --}}
    <div class="col-lg-3 col-md-3 col-sm-12">
      <div class="card card-primary" style="height: 150px;border-radius:unset">
        <div class="card-header" style="border-bottom:hidden;">
          <h1 style="font-size: large;font-family: sans-serif;">Revenu</h1>
        </div>
        <div class="card-body">
          <div>
            <span style="font-size: large;color:#2a944d;">
              <i class="fas fa-caret-up" style="font-size: large;"></i> 30000 €
            </span>
            <i class="fas fa-dollar-sign float-right" style="font-size:30px;"></i>
          </div>
          <span style="font-size: x-small;font-family: sans-serif;">De la semaine dernière</span>
        </div>
      </div>
    </div>

    {{-- CARD 2 --}}
    <div class="col-lg-3 col-md-3 col-sm-12">
      <div class="card card-primary" style="height: 150px;border-radius:unset">
        <div class="card-header" style="border-bottom:hidden;">
          <h1 style="font-size: large;font-family: sans-serif;">Réservations</h1>
        </div>
        <div class="card-body">
          <div>
            <span style="font-size: large;color:#dc3545;">
              <i class="fas fa-caret-down" style="font-size: large;"></i> {{$reservations}}
            </span>
            <i class="far fa-calendar-check float-right" style="font-size:30px;"></i>
          </div>
          <span style="font-size: x-small;font-family: sans-serif;">De la semaine dernière</span>
        </div>
      </div>
    </div>

    {{-- CARD 3 --}}
    <div class="col-lg-3 col-md-3 col-sm-12">
      <div class="card card-primary" style="height: 150px;border-radius:unset">
        <div class="card-header" style="border-bottom:hidden;">
          <h1 style="font-size: large;font-family: sans-serif;">Visites</h1>
        </div>
        <div class="card-body">
          <div>
            <span style="font-size: large;color:#2a944d;">
              <i class="fas fa-caret-up" style="font-size: large;"></i> 1200
            </span>
            <i class="fas fa-eye float-right" style="font-size:30px;"></i>
          </div>
          <span style="font-size: x-small;font-family: sans-serif;">De la semaine dernière</span>
        </div>
      </div>
    </div>
    {{-- CARD 4 --}}
    <div class="col-lg-3 col-md-3 col-sm-12">
      <div class="card card-primary" style="height: 150px;border-radius:unset">
        <div class="card-header" style="border-bottom:hidden;">
          <h1 style="font-size: large;font-family: sans-serif;">Taux de remplissage</h1>
        </div>
        <div class="card-body">
          <div>
            <span style="font-size: large;font-family: sans-serif;">{{$rooms}}</span>
            <i class="fas fa-bed float-right" style="font-size:30px;"></i>
          </div>
          <span style="font-size: x-small;font-family: sans-serif;">De la semaine dernière</span>
        </div>
      </div>
    </div>


    {{-- END CARDS --}}
  </div>
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h4>Taux d'inscription durant : 23/05/2019-11/07/2019</h4>
        </div>
        <div class="card-body">
          <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
            <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
              <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
            </div>
            <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
              <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
            </div>
          </div>
          <canvas id="pie-chart" width="800" height="450"></canvas>
        </div>
        <div class="statistic-details mt-sm-4">
          <div class="statistic-details-item">
            <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 7%</span>
            <div class="detail-value">€243</div>
            <div class="detail-name">Gain d'aujourd'hui</div>
          </div>
          <div class="statistic-details-item">
            <span class="text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 23%</span>
            <div class="detail-value">€2,902</div>
            <div class="detail-name">Le gain de cette semaine</div>
          </div>
          <div class="statistic-details-item">
            <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 9%</span>
            <div class="detail-value">€12,821</div>
            <div class="detail-name">Le gain de ce mois</div>
          </div>
          <div class="statistic-details-item">
            <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 19%</span>
            <div class="detail-value">€92,142</div>
            <div class="detail-name">Le gain de cette année</div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4" style="height: 100%;">
      <div class="card gradient-bottom">
        <div class="card-header">
          <h4>Top 5 Hotels</h4>
        </div>
        <div class="card-body" id="top-5-scroll" tabindex="2" style="height: 315px; overflow: hidden; outline: none;">
          <ul class="list-unstyled list-unstyled-border">
            <li class="media">
              <img class="mr-3 rounded" width="55" src="../../../../img/avatar/avatar-1.png" alt="product">
              <div class="media-body">
                <div class="float-right">
                  <div class="font-weight-600 text-muted text-small">86 Reservations</div>
                </div>
                <div class="media-title">Hotel Marhaba</div>
                <div class="mt-1">
                  <div class="budget-price">
                    <div class="budget-price-square bg-primary" data-width="64%" style="width: 64%;"></div>
                    <div class="budget-price-label">€68,714</div>
                  </div>
                  <div class="budget-price">
                    <div class="budget-price-square bg-danger" data-width="43%" style="width: 43%;"></div>
                    <div class="budget-price-label">€38,700</div>
                  </div>
                </div>
              </div>
            </li>
            <li class="media">
              <img class="mr-3 rounded" width="55" src="../../../../img/avatar/avatar-1.png" alt="product">
              <div class="media-body">
                <div class="float-right">
                  <div class="font-weight-600 text-muted text-small">67 Reservations</div>
                </div>
                <div class="media-title">Hotel Dar El sada</div>
                <div class="mt-1">
                  <div class="budget-price">
                    <div class="budget-price-square bg-primary" data-width="84%" style="width: 84%;"></div>
                    <div class="budget-price-label">€107,133</div>
                  </div>
                  <div class="budget-price">
                    <div class="budget-price-square bg-danger" data-width="60%" style="width: 60%;"></div>
                    <div class="budget-price-label">€91,455</div>
                  </div>
                </div>
              </div>
            </li>
            <li class="media">
              <img class="mr-3 rounded" width="55" src="../../../../img/avatar/avatar-1.png" alt="product">
              <div class="media-body">
                <div class="float-right">
                  <div class="font-weight-600 text-muted text-small">63 Reservations</div>
                </div>
                <div class="media-title">Hotel test 2</div>
                <div class="mt-1">
                  <div class="budget-price">
                    <div class="budget-price-square bg-primary" data-width="34%" style="width: 34%;"></div>
                    <div class="budget-price-label">€3,717</div>
                  </div>
                  <div class="budget-price">
                    <div class="budget-price-square bg-danger" data-width="28%" style="width: 28%;"></div>
                    <div class="budget-price-label">€2,835</div>
                  </div>
                </div>
              </div>
            </li>
            <li class="media">
              <img class="mr-3 rounded" width="55" src="../../../../img/avatar/avatar-1.png" alt="product">
              <div class="media-body">
                <div class="float-right">
                  <div class="font-weight-600 text-muted text-small">28 Reservations</div>
                </div>
                <div class="media-title">Hotel phénix</div>
                <div class="mt-1">
                  <div class="budget-price">
                    <div class="budget-price-square bg-primary" data-width="45%" style="width: 45%;"></div>
                    <div class="budget-price-label">€13,972</div>
                  </div>
                  <div class="budget-price">
                    <div class="budget-price-square bg-danger" data-width="30%" style="width: 30%;"></div>
                    <div class="budget-price-label">€9,660</div>
                  </div>
                </div>
              </div>
            </li>
            <li class="media">
              <img class="mr-3 rounded" width="55" src="../../../../img/avatar/avatar-1.png" alt="product">
              <div class="media-body">
                <div class="float-right">
                  <div class="font-weight-600 text-muted text-small">19 Reservations</div>
                </div>
                <div class="media-title">Hotel beb bhar</div>
                <div class="mt-1">
                  <div class="budget-price">
                    <div class="budget-price-square bg-primary" data-width="35%" style="width: 35%;"></div>
                    <div class="budget-price-label">€7,391</div>
                  </div>
                  <div class="budget-price">
                    <div class="budget-price-square bg-danger" data-width="28%" style="width: 28%;"></div>
                    <div class="budget-price-label">€5,472</div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="card-footer pt-3 d-flex justify-content-center">
          <div class="budget-price justify-content-center">
            <div class="budget-price-square bg-primary" data-width="20" style="width: 20px;"></div>
            <div class="budget-price-label">Reservations</div>
          </div>
          <div class="budget-price justify-content-center">
            <div class="budget-price-square bg-danger" data-width="20" style="width: 20px;"></div>
            <div class="budget-price-label">Visistes</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-8 col-md-12 col-12 col-sm-12">
      <div class="card">
        <div class="card-header">
          <h4>Moyenne des reservations :
          </h4>
          <div class="card-header-action">
          </div>
        </div>
        <div class="card-body">
          <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
            <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
              <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
            </div>
            <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
              <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
            </div>
          </div>
          <div id="chart" style="min-height: 365px;">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
      labels: ["annulé", "Inscrit"],
      datasets: [{
        label: "Population (millions)",
        backgroundColor: ["#3e95cd", "#8e5ea2"],
        data: [2478, 5267]
      }]
    },
    options: {
      animateScale: true,
      title: {
        display: true,
        text: 'Taux d\'inscription'
      }
    }
  });

  var options = {
    chart: {
      height: 350,
      type: 'line',
      shadow: {
        enabled: false,
        color: '#bbb',
        top: 3,
        left: 2,
        blur: 3,
        opacity: 1
      },
    },
    stroke: {
      width: 7,
      curve: 'smooth'
    },
    series: [{
      name: 'Réservations',
      data: [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5, 13, 9, 17, 2, 7, 5]
    }],
    xaxis: {
      type: 'datetime',
      categories: ['1/11/2000', '2/11/2000', '3/11/2000', '4/11/2000', '5/11/2000', '6/11/2000', '7/11/2000', '8/11/2000', '9/11/2000', '10/11/2000', '11/11/2000', '12/11/2000', '1/11/2001', '2/11/2001', '3/11/2001', '4/11/2001', '5/11/2001', '6/11/2001'],
    },
    title: {
      text: 'Réservations',
      align: 'left',
      style: {
        fontSize: "16px",
        color: '#666'
      }
    },
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'dark',
        gradientToColors: ['#FDD835'],
        shadeIntensity: 1,
        type: 'horizontal',
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 100, 100, 100]
      },
    },
    markers: {
      size: 4,
      opacity: 0.9,
      colors: ["#FFA41B"],
      strokeColor: "#fff",
      strokeWidth: 2,

      hover: {
        size: 7,
      }
    },
    yaxis: {
      min: -10,
      max: 40,
      title: {
        text: 'Engagement',
      },
    }
  }

  var chart = new ApexCharts(
    document.querySelector("#chart"),
    options
  );

  chart.render();

  $(document).ready(function() {

    // $('.listhotels').on( 'keyup change', function () {
    //     console.log(this.value);

    // $('#reportrange').daterangepicker();
    // $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
    //   console.log(picker.startDate.format('YYYY-MM-DD'));
    //   console.log(picker.endDate.format('YYYY-MM-DD'));
    // });

    // $('#daterange').daterangepicker();
    // $('#daterange').on('apply.daterangepicker', function(ev, picker) {
    //   console.log(picker.startDate.format('YYYY-MM-DD'));
    //   console.log(picker.endDate.format('YYYY-MM-DD'));
    // });


    //  } );
  });
</script>
@endsection