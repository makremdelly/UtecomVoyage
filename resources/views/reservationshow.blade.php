@extends('layouts.dash')
@section('content')
<link href="{{ asset('css/all.css') }}" rel="stylesheet" media="print" type="text/css">
<style type="text/css">
  @media print {
    html * {
      visibility: hidden;
    }

    head * {
      visibility: hidden;
    }

    .invoice * {
      visibility: visible;
    }

    .invoice {
      zoom: 147%;
      margin-top: -90px;
    }

    @page {
      margin-top: 0;
      /* this affects the margin in the printer settings */
      margin-bottom: 0;
    }

    /* div { border: 1px solid black;} */
  }
</style>
<!-- Main Content -->
<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="invoice">
          <div class="invoice-print">
            <div class="row">
              <div class="col-lg-12">
                <div class="invoice-title">
                  <h2 style="font-family: serif;">{{$hotel['0']['name']}}</h2>
                  <span>

                  </span>
                  <div class="invoice-number" style="font-size: initial;">Resérvation #Réf00{{$reservation[0]['id']}}</div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-6">
                    <address>
                      {{$hotel['0']['address']}}<br>
                      {{$hotel['0']['country']}}<br>
                      {{$hotel['0']['city']}},{{$hotel['0']['type']}} ,{{$hotel['0']['postcode']}}<br>
                      {{$hotel['0']['phone']}}<br>
                    </address>
                  </div>
                  <div class="col-md-6 text-md-right">
                    <address>
                      <strong>Détails du client:</strong><br>
                      {{$reservation['0']['user_name']}}<br>
                      {{$reservation['0']['user_email']}}<br>
                      {{$reservation['0']['phone']}}<br>
                    </address>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <address>
                      <strong>Payment Method:</strong><br>
                      <div><i class="fab fa-cc-visa" style="font-size: x-large;color:#1a1f71;"></i>
                        <span style="position: absolute;margin: 1px 0 0 4px;">Visa ending **** 1234</span>
                      </div>
                      {{$reservation['0']['user_email']}}
                    </address>
                  </div>
                  <div class="col-md-6 text-md-right">
                    <address>
                      {{-- <strong style="font-size: initial;color: cornflowerblue;">Date de réservation:</strong><br> --}}
                      <span style="font-size: initial;color: green;">Date D'arrivée <i class="fas fa-check-double"></i></span><br>
                      {{date("H:i A",strtotime(($reservation['0']['arrival_date'])))}}<br>
                      {{date("d.m.Y",strtotime(($reservation['0']['arrival_date'])))}}
                      <br>
                      <span style="font-size: initial;color: #e60a0a;">Date de Départ <i class="fas fa-times"></i></span><br>
                      {{date("H:i A",strtotime(($reservation['0']['departure_date'])))}}<br>
                      {{date("d.m.Y",strtotime(($reservation['0']['departure_date'])))}}
                      <br>
                    </address>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-12">
                <div class="section-title">Résumé de la réservation :</div>
                <br>
                <div class="table-responsive">
                  <table class="table table-striped table-hover table-md">
                    <tbody>
                      <tr>
                        <th data-width="40" style="width: 40px;"></th>
                        <th>Chambre</th>
                        <th>Vue</th>
                        <th class="text-center">Personnes</th>
                        <th class="text-center">Prix</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-right">Total</th>
                      </tr>
                      @php
                      $id = 1;
                      $Quant = 1;
                      $Subtotal = 0;
                      @endphp
                      @foreach ($rooms as $room)
                      <tr>
                        <td>{{$Quant}}x</td>
                        <td>{{$room['name']}}</td>
                        <td>{{$room['vue']}}</td>
                        <td class="text-center">
                          @switch($room['type'])
                          @case('Single')
                          <i class="fas fa-user" style="font-size: large;"></i>
                          @break
                          @case('Double')
                          <i class="fas fa-user-friends" style="font-size: large;"></i>
                          @break
                          @case('Triple')
                          <i class="fas fa-users" style="font-size: large;"></i>
                          @break
                          @case('Quad')
                          <i class="fas fa-user-friends" style="font-size: large;"></i>
                          <i class="fas fa-user-friends" style="font-size: large;"></i>
                          @break
                          @case('Queen')
                          <i class="fas fa-chess-queen" style="font-size: large;"></i>
                          @break
                          @case('King')
                          <i class="fas fa-chess-king" style="font-size: large;"></i>
                          @break
                          @endswitch
                        </td>
                        <td class="text-center">€ {{$offers['0']['price']}}</td>
                        <td class="text-center">{{$Quant}}</td>
                        <td class="text-right">€ {{$offers['0']['price']}}</td>
                      </tr>
                      @php
                      $id ++;
                      $Subtotal += 500 ;
                      @endphp
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="row mt-4">
                  <div class="col-lg-12 text-right">
                    <hr class="mt-2 mb-2">
                    <div class="invoice-detail-item">
                      <div class="invoice-detail-item">
                        @if($offers['0']['discount'] == null )
                        <div class="invoice-detail-value invoice-detail-value-lg">€ {{$offers['0']['price']}}</div>
                        @else
                        <div class="invoice-detail-name">Remise</div>
                        <div class="invoice-detail-value">€ {{$remise}}</div>
                      </div>
                      <div class="invoice-detail-name">Prix final</div>
                      <div class="invoice-detail-value invoice-detail-value-lg">€ {{$offers['0']['discount']}}</div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div style="text-align:center;margin-bottom:20px;">
          <button class="btn btn-warning btn-icon icon-left print-window" style="cursor:grab;"><i class="fas fa-print"></i> Imprimer</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $('.print-window').click(function() {
    window.print();
  });
</script>
@endsection