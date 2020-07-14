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
<?php $count = count($pictures); ?>
<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h6 style="font-family: monospace;font-size: small;color: #34395e;"><i class="fas fa-map-marker-alt" style="color: #e20a0a;font-size: 16px;padding-left: 5px;"></i> {{Str::upper($voyage->villeD)}} - {{Str::upper($voyage->depart)}} </h6>
        </div>
        <div class="card-body">
          <div class="row">
            {{-- CARD 1 --}}
            <div class="col-lg-7 col-md-3 col-sm-12">
              <div class="card h-100 text-dark shadow-lg p-1 mb-5 bg-white rounded" style="color:#f2f7fb;border-radius:unset">
                <div class="card-body">
                  <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                    @if ($count==0)
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block w-100" src="../img/nohotel.jpg" alt="First slide">
                      </div>
                    </div>
                    @elseif($count==1)
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block w-100 img-fluid" src="../storage/{{$voyage->id}}/{{$pictures[0]['file_name']}}" alt="First slide">
                      </div>
                    </div>
                    @elseif($count>1)
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block w-100 img-fluid" src="../storage/{{$voyage->id}}/{{$pictures[0]['file_name']}}" alt="First slide">
                      </div>
                      @foreach (array_slice($pictures,1) as $pic)
                      <div class="carousel-item">
                        <img class="d-block w-100 img-fluid" src="../storage/{{$voyage->id}}/{{$pic['file_name']}}" alt="Second slide">
                      </div>
                      @endforeach
                    </div>
                    @endif
                    @if ($count>1)
                    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                    @endif
                  </div>
                </div>
                <hr>
                <div class="card-header">
                  <h4>
                  </h4>
                  <div class="card-header-action">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg">Voir tout</button>
                    <!-- Start Add Model -->
                    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-whitesmoke">
                            <h5></h5>
                            <div class="card-header-action">
                              <label>
                                <b class="btn btn-secondary">
                                  <input type="checkbox" id="checkAll" class="d-none"><b data-toggle="tooltip" data-original-title="Tout sélectionner"><i class="fa fa-check"></i></b>
                                </b>
                              </label>
                              <b data-toggle="tooltip" data-original-title="Ajouter"><button type="button" class="btn btn-primary" data-toggle="modal" href="#myModal2"><i class="fas fa-plus"></i></button></b>
                              <!-- Start Add Model -->
                              <div class="modal" id="myModal2" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title"></h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="POST" action="{{ route('image.add' , $voyage->id) }}" class="dropzone" id="mydropzone" enctype="multipart/form-data">
                                        @csrf
                                        <div class="fallback">
                                          <input type="file" name="photo" multiple>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- End Add Model -->
                              <button type="button" value="{{$voyage->id}}" name="delete" id="delete" class="btn btn-danger delete" data-toggle="tooltip" data-original-title="Supprimer"><i class="far fa-trash-alt"></i></button>
                            </div>
                          </div>
                          <div class="card-body">
                            <div class="form-group">
                              <div class="row gutters-sm">
                                <?php $count = count($pictures); ?>
                                @if ($count==0)
                                <div>
                                  <label class="imagecheck mb-4">
                                    <figure class="imagecheck-figure">
                                      <img src="../img/nohotel.jpg" alt="}" class="imagecheck-image">
                                    </figure>
                                  </label>
                                </div>
                                @elseif($count==1)
                                <div>
                                  <label class="imagecheck mb-4">
                                    <input name="imagecheck" type="checkbox" value="{{$pictures[0]['id']}}" class="imagecheck-input" />
                                    <figure class="imagecheck-figure">
                                      <img src="../storage/{{$voyage->id}}/{{$pictures[0]['file_name']}}" alt="}" class="imagecheck-image" style="height:157px; Width: 157px">
                                    </figure>
                                  </label>
                                </div>
                                @else
                                @foreach ($pictures as $pic)
                                <div>
                                  <label class="imagecheck">
                                    <input type="checkbox" name="imagecheck-input[]" class="imagecheck-input" id="pas" value="{{$pic['id']}}" />

                                    <figure class="imagecheck-figure">
                                      <img src="../storage/{{$voyage->id}}/{{$pic['file_name']}}" value="{{$pic['id']}}" alt="}" class="imagecheck-image" style="height:157px; Width: 157px">
                                    </figure>
                                  </label>
                                </div>
                                @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Add Model -->
                  </div>
                </div>
              </div>
            </div>
            {{-- CARD 2 --}}
            <div class="col-lg-5 col-md-3 col-sm-12">
              <div class="card h-100 text-dark shadow-lg p-1 mb-5 bg-white rounded" style="color:#f2f7fb;border-radius:unset">
                <div class="card-header border" style="border-bottom:hidden;">
                  <h1 style="text-align:center;margin:0;font-family: monospace; font-size: xx-large	; color: dark;">{{Str::upper($voyage->type)}}</h1>
                </div>
                <div class="card-body">
                  <div>
                    <span style="font-size: large;color:#dc3545;">
                      <i class="far fa-calendar-check float-right" style="font-size:30px;"></i>
                    </span>
                    <span style="font-size: x-medium;font-weight: bold;font-family: monospace;">Du {{$voyage->startDate}} au {{$voyage->endDate}}</span>
                  </div>
                  <br>
                  <div style="word-spacing: 5px;line-height: 22pt;">
                    <h1 style="margin:0;font-family: monospace; font-size:large	; color: dark;"> À propos </h1>
                    {{$voyage->description}}
                  </div>
                  <br>

                  <!-- <i class="fas fa-plane" style="font-size: x-large;"></i> -->
                  <button type="button" class="btn btn-info" data-toggle="modal" href="#myModal3">Programme<i class="fas fa-tasks pl-2"></i></button>
                  <div class="modal fade bd-example-modal-lg" id="myModal3" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title"></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          @if(count($programmes) > 0 )
                          <div class="invoice border" id="printMe">
                            <div class="invoice-print">
                              @foreach ($programmes as $programme)
                              {!! $programme['Programme'] !!}
                            </div>
                          </div>
                          <div style="text-align:center;margin-bottom:20px;">
                            <button class="btn btn-warning btn-icon icon-left" style="cursor:grab;" onclick="printDiv('printMe')"><i class="fas fa-print"></i>Imprimer</button>
                            <a href="/programme/{{$voyage->id }}" id="IdVoyage" class="btn btn-icon btn-primary"><i class="fas fa-edit"></i>Modifier</a>
                          </div>
                          @endforeach
                          @else
                          <div class="text-center">
                            <strong> <i class="fas fa-exclamation-triangle"></i> Aucune programe n'est associé</strong><br>
                            <div class="breadcrumb-item active"><a href="/programme/{{$voyage->id }}"><i style="font-size: smaller;"></i><b>Cliquez ici pour ajouter un programme</b></a></div></br>
                          </div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <a href="#footer" class="btn btn-success float-right"> Tarifs<i class="fas fa-angle-double-down pl-2"></i></a>
                </div>
                <div>


                  <div class=" font-weight-normal share px-4">
                    Partager sur:
                    <a href="https://www.your-domain.com/your-page.html" target="_blank" class="btn mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored transparent mx-2" data-upgraded=",MaterialButton"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=https://www.lowcost.tn/voyage/voyage-organise-istanbul-pas-cher.html" target="_blank" class="btn mdl-button mdl-js-ripple-effect mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored transparent mx-2" data-upgraded=",MaterialButton,MaterialRipple"><i class="fab fa-twitter"></i></a>
                    <a href="https://plus.google.com/share?url=https://www.lowcost.tn/voyage/voyage-organise-istanbul-pas-cher.html" target="_blank" class="btn mdl-button mdl-js-ripple-effect mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored transparent mx-2" data-upgraded=",MaterialButton,MaterialRipple "><i class="fab fa-google-plus-g"></i></a>
                  </div>
                  <!-- <a target="_blank" title="Facebook" href="https://www.facebook.com/sharer.php?u=https://tontonduweb.com/previews-warc/genieCivil/article1.html" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');return false;"><img src="plugins/iconrs/facebook_icon.png" alt="Facebook" /></a>
                  <a target="_blank" title="Twitter" href="https://twitter.com/share?url=https://bit.ly/2sI7H3v" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=700');return false;"><img src="plugins/iconrs/twitter_icon.png" alt="Twitter" /></a>
                  <a target="_blank" title="Google +" href="https://plus.google.com/share?url=https://tontonduweb.com/previews-warc/genieCivil/article1.html" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=450,width=650');return false;"><img src="plugins/iconrs/gplus_icon.png" alt="Google Plus" /></a>
                  <a target="_blank" title="Envoyer par mail" href="mailto:?Subject=Regarde ça c'est cool !&amp;Body=regarde%20cet%20article%20c'est%20super !%20 https://tontonduweb.com/previews-warc/genieCivil/article1.html" rel="nofollow"><img src="plugins/iconrs/email_icon.png" alt="email" /></a> -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body" id="footer">
          <div class="row">
            <div class="col-12">
              <div class="pricing pricing-highlight text-dark shadow-lg p-1 mb-5 bg-white rounded" style="color:#f2f7fb;">
                <div class="pricing-cta">
                  <div class="badge badge-secondary " style="padding: 10px !important;"> à partir de {{$voyage->prix}} Dt</div>
                </div>
                <div class="card-body">
                  <div class="row">
                    {{-- CARD 1 --}}
                    <div class="col-lg-6 col-md-3 col-sm-12">
                      <div class="card h-75">
                        <p><strong><u>Ce prix comprend</u></strong> : </p>
                        <p></p>
                        <ul>
                          <li><strong>Transferts Aéroport / Hôtels / Aéroport.</strong></li>
                          <li><strong>Hébergement 07 Nuits en BB à&nbsp; Wolcott Hotel 3* ou similaire,</strong></li>
                          <li><strong>Visites selon programme</strong></li>
                          <li><strong>Mise à la disposition de bus et guide selon programme</strong></li>
                          <li><strong>Billets d’avion (non annulable ni remboursable après émission)</strong></li>
                        </ul>
                        <p></p>
                      </div>
                    </div>
                    {{-- CARD 2 --}}
                    <div class="col-lg-6 col-md-3 col-sm-12">
                      <div class="card h-75">
                        <p><strong><u>Ce prix ne comprend pas</u></strong> : </p>
                        <p></p>
                        <ul>
                          <li><strong>les frais de visas</strong></li>
                          <li><strong>City Taxe en extra payable par les clients sur place&nbsp; au Tour Leader 20€ par personne ainsi qu’un Pourboire guides et chauffeurs de 20€ .</strong><strong><span style="font-size: small;">(Obligatoire).</span></strong></li>
                          <li><strong>Les excursions en Extra.</strong></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card-body">

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>LES PLUS POPULAIRES :</h4>
                  <div class="card-header-action">
                    <a data-collapse="#mycard-collapse" class="btn btn-primary" href="#"><i class="fas fa-minus"></i></a>
                  </div>
                </div>
                <div class="collapse show" id="mycard-collapse">
                  <div class="hero bg-dark text-white" style="margin: 10px 0 10px 0;padding: 20px !important;">

                    <div class="row">
                      <div class="col mb-4 mb-lg-0  ">
                        <a href="{{ route('autocars.show') }}"><i class="fa fa-bus"></i>
                          @if ($voyage->autocar_id== NULL)
                          <strong>pas de autocar</strong>
                          @else
                          @php
                          $autocar = \App\Models\Autocar::all();
                          @endphp
                          @foreach ($autocar as $autocar)
                          @if($voyage->autocar_id == $autocar->id)
                          <strong>{{$autocar->type}}</strong>
                          @endif
                          @endforeach
                          @endif
                      </div>
                      <div class="col mb-4 mb-lg-0  ">
                        @if ($voyage->hotel_id== NULL)
                        <a href="#"><i class="fa fa-hotel"></i>
                          <strong>pas de hotel</strong>
                          @else
                          @php
                          $hotel = \App\Models\Hotel::all();
                          @endphp
                          @foreach ($hotel as $hotel)
                          @if($voyage->hotel_id == $hotel->id)
                          <a href="/hotels/{{$hotel->id }}"><i class="fa fa-hotel"></i>
                            <strong>{{$hotel->name}}</strong>
                            @endif
                            @endforeach
                            @endif
                      </div>
                      <div class="col mb-4 mb-lg-0  ">
                        <a href="#" onclick="return false;"><i class="fa fa-plane"></i>
                          @if ($voyage->type=='Voyages organisés' || $voyage->type=='عمرة')
                          <strong> {{$voyage->villeD}} - {{$voyage->depart}}</strong>
                          @else
                          <strong> pas de vol</strong>
                          @endif
                      </div>
                      <div class="col mb-4 mb-lg-0  ">
                        <a href="#" onclick="return false;"><i class="fa fa-clock"></i>
                          <strong> {{$numberDay}} Jours</strong>
                      </div>
                      <div class="col mb-4 mb-lg-0  ">
                        <a href="#" onclick="return false;"><i class="fa fa-map-marker-alt"></i>
                          <strong> {{$voyage->retour}}</strong>
                      </div>
                      <div class="mt-2 font-weight-bold" style="padding-right: 17px;"></div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>









      </div>
    </div>
  </div>

  <script>
    $('#myNavTabs a').click(function(evt) {
      evt.preventDefault();
      $(this).tab('show');
    });
    // print
    function printDiv(invoice) {
      var printContents = document.getElementById(invoice).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }


    $(document).on('click', '#delete', function(e) {
      var id = [];
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      swal({
          title: "Êtes-vous sûr ?",
          icon: "warning",
          buttons: ["Annuler", "Supprimer!"],
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $('.imagecheck-input:checked').each(function() {
              id.push($(this).val());
            });

            if (id.length > 0) {
              $.ajax({
                url: "{{ route('CheckImage.delete')}}",
                method: 'DELETE',
                data: {
                  id: id,
                  'willDelete': willDelete
                },
                success: function(data) {
                  console.log('done');
                  location.reload();
                }
              });
              swal({
                title: "Termié",
                icon: "success",
                timer: 4000,
                buttons: false,
                closeOnEsc: false,
                closeOnClickOutside: false,
              });
            } else {
              swal({
                title: "Veuillez cocher au moins une photo ",
                icon: "warning",
              });
              console.log('warning');
            }
          } else {
            e.preventDefault();
            swal({
              title: "ANNULÉ",
              text: "vous avez annulé la suppression de photo",
              icon: "error",
            });
            console.log('test');
          }
        });
    });

    $("#checkAll").click(function() {
      $('input:checkbox').not(this).prop('checked', this.checked);
    });
  </script>



  @endsection