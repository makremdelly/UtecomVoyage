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
        <div class="card-body">
          <div class="card">
            <div class="card-body">
              <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                @if ($count==0)
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100" src="../img/nohotel.jpg" alt="First slide" style="height:500px;">
                  </div>
                </div>
                @elseif($count==1)
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100 img-fluid" src="../storage/{{$voyage->id}}/{{$pictures[0]['file_name']}}" alt="First slide" style="height:500px;">
                  </div>
                </div>
                @elseif($count>1)
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100 img-fluid" src="../storage/{{$voyage->id}}/{{$pictures[0]['file_name']}}" alt="First slide" style="height:500px;">
                  </div>
                  @foreach (array_slice($pictures,1) as $pic)
                  <div class="carousel-item">
                    <img class="d-block w-100 img-fluid" src="../storage/{{$voyage->id}}/{{$pic['file_name']}}" alt="Second slide" style="height:500px;">
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
          </div>
          <h1 style="text-align:center;margin:0;font-family: monospace;color: #383d5f;">{{Str::upper($voyage->depart)}}</h1></br>
        </div>
        <hr>
        <nav class="nav nav-tabs" id="myNavTabs">
          <a class="nav-item nav-link active" href="#Informations">
            <h5>Informations</h5>
          </a>
          <a class="nav-item nav-link" href="#Programme">
            <h5>Programme</h5>
          </a>
          <a class="nav-item nav-link" href="#Gallery">
            <h5>Galerie</h5>
          </a>
          <a class="nav-item nav-link" href="#Maps">
            <h5>Maps</h5>
          </a>
        </nav>
        <div class="tab-content">


          <div class="tab-pane active" id="Informations">
            <br>
            <div class="text-center">
              <h3>{{$voyage->type}}</h3>
              <h4>Du {{$voyage->startDate}} au {{$voyage->endDate}}</h4>
            </div>
            <br>


            <div class="row" style="padding: 15px;">
              <div class="col-4">
                <div class="activities">
                  <div class="activity">
                    <div class="activity-icon bg-primary text-white shadow-primary">
                      <i class="fas fa-comment-alt"></i>
                    </div>
                    @if ($voyage->type=='Voyages organisés')
                    <div class="activity-detail">
                      <div class="mb-2">
                        <span class="text-job text-primary">2 min ago</span>
                        <span class="bullet"></span>
                        <a class="text-job" href="#">View</a>
                        <div class="float-right dropdown">
                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                          <div class="dropdown-menu">
                            <div class="dropdown-title">Options</div>
                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-list"></i> Detail</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon text-danger trigger--fire-modal-1" data-confirm="Wait, wait, wait...|This action can't be undone. Want to take risks?" data-confirm-text-yes="Yes, IDC"><i class="fas fa-trash-alt"></i> Archive</a>
                          </div>
                        </div>
                      </div>
                      <p>Have commented on the task of "<a href="#">Responsive design</a>".</p>
                    </div>
                  </div>
                  <div class="activity">
                    <div class="activity-icon bg-primary text-white shadow-primary">
                      <i class="fas fa-comment-alt"></i>
                    </div>
                    <div class="activity-detail">
                      <div class="mb-2">
                        <span class="text-job text-primary">2 min ago</span>
                        <span class="bullet"></span>
                        <a class="text-job" href="#">View</a>
                        <div class="float-right dropdown">
                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                          <div class="dropdown-menu">
                            <div class="dropdown-title">Options</div>
                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-list"></i> Detail</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon text-danger trigger--fire-modal-1" data-confirm="Wait, wait, wait...|This action can't be undone. Want to take risks?" data-confirm-text-yes="Yes, IDC"><i class="fas fa-trash-alt"></i> Archive</a>
                          </div>
                        </div>
                      </div>
                      <p>Have commented on the task of "<a href="#">Responsive design</a>".</p>
                    </div>
                  </div>
                  <div class="activity">
                    <div class="activity-icon bg-primary text-white shadow-primary">
                      <i class="fas fa-comment-alt"></i>
                    </div>
                    <div class="activity-detail">
                      <div class="mb-2">
                        <span class="text-job text-primary">2 min ago</span>
                        <span class="bullet"></span>
                        <a class="text-job" href="#">View</a>
                        <div class="float-right dropdown">
                          <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                          <div class="dropdown-menu">
                            <div class="dropdown-title">Options</div>
                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                            <a href="#" class="dropdown-item has-icon"><i class="fas fa-list"></i> Detail</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon text-danger trigger--fire-modal-1" data-confirm="Wait, wait, wait...|This action can't be undone. Want to take risks?" data-confirm-text-yes="Yes, IDC"><i class="fas fa-trash-alt"></i> Archive</a>
                          </div>
                        </div>
                      </div>
                      <p>Have commented on the task of "<a href="#">Responsive design</a>".</p>
                    </div>
                    @endif
                  </div>
                </div>
              </div>

              <div class="col-4">
                <div>
                  <div class="card-header">
                    <h4 class="text-danger mb-2" style="text-transform: uppercase;">Note Importante</h4>
                  </div>
                  <div class="card-body">
                    {!! $voyage['description'] !!}
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="pricing pricing-highlight">
                  <!-- <div class="pricing-title"> -->
                  <div class="pricing-padding " style="padding: 15px;">
                    <!-- <span class="badge badge-info "> à partir de {{$voyage->prix}} Dt</span> -->


                    CE PRIX COMPREND :
                  </div>
                  <div class="pricing-padding">
                    <div class="pricing-details">
                      <div class="pricing-item">
                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                        <div class="pricing-item-label">Aéroport / Hôtels / Aéroport.</div>
                      </div>
                      <div class="pricing-item">
                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                        <div class="pricing-item-label">Visites selon programme.</div>
                      </div>
                      <div class="pricing-item">
                        <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                        <div class="pricing-item-label">Mise à la disposition de bus</div>
                      </div>
                    </div>
                  </div>
                  <div class="pricing-cta">
                    <!-- <a href="#" style="padding: 10px !important;">à partir de {{$voyage->prix}} Dt</a> -->
                    <div class="badge badge-info " style="padding: 10px !important;"> à partir de {{$voyage->prix}} Dt</div>

                  </div>
                </div>
              </div>
              <!-- <blockquote style="font-family: monospace;height: 60px;font-size: unset;font-style: unset;">
                Créé le {{Str::limit($voyage->created_at,10,(''))}}
              </blockquote>
              <h2 style="text-align:center; font-family: serif;">{{$voyage->type}}</h2>
              <h4 style="text-align:center; font-family: serif;">Du {{$voyage->startDate}} au {{$voyage->endDate}} </h4></br></br>
              <div class="row">
                <div class="col-12 col-md-8 col-lg-8" style="word-spacing: 5px;line-height: 26pt;">
                  <div class="row">
                    <div class="form-group col-md-6 col-12"> -->
              <!-- <h5 style="color: #383d5f;">Ce voyage comprend </h5>
                      @if ($voyage->type=='Voyages organisés')
                      <li><strong>Vol Aller: {{$voyage->villeD}} - {{$voyage->depart}}</strong></li>
                      <li><strong>Vol Retour: {{$voyage->depart}} - {{$voyage->villeD}}</strong></li>
                      <li><strong>Transferts: Aéroport / Hôtels / Aéroport</strong></li>
                      @else
                      <strong> <i class="fas fa-exclamation-triangle"></i> </strong><br>
                      @endif
                      <br> -->
              <!-- <h5 style="color: #383d5f;"> Note Importante </h5>

                      <div class="invoice-print">
                        {!! $voyage['description'] !!}
                      </div> -->

              <!-- </div>
                    <div class="form-group col-md-6 col-12">
                      <h5 style="color: #383d5f;"> Départs</h5>
                      <li><strong>{{$voyage->villeD}} (Parc de l'agence) le {{$voyage->startDate}}</strong></li>
                    </div>
                  </div>
                </div> -->
              <!-- <div class="col-12 col-md-4 col-lg-4">
                  <div class="pricing">
                    <div class="badges">
                      <span class="badge badge-info "> à partir de {{$voyage->prix}} Dt</span>
                    </div>
                    <div class="pricing-title">
                      Ce prix comprend :
                    </div> -->
              <!-- <div class="pricing-padding" style="padding: 15px;">
                      <div class="pricing-details">
                        <div class="pricing-item">
                          <i style="font-size: 20px;"></i>
                          <div class="pricing-item-label" data-toggle="tooltip" title="" style="padding-left: 8px;cursor: help;">
                            @if ($voyage->type=='Voyages organisés' || $voyage->type=='عمرة')
                            <li><strong>Transferts Aéroport / Hôtels / Aéroport.</strong></li>
                            @endif
                            <li><strong>Visites selon programme,</strong></li>
                            <li><strong>Mise à la disposition de bus et guide selon programme</strong></li>
                            <li><strong>Hébergement {{$numberDay}} Nuits à 3* ou similaire,</strong></li>
                          </div> -->
              <!-- </div>
                      </div>
                    </div> -->
              <!-- </div> -->
              <!-- </div> -->
            </div>
            <div class="hero bg-dark text-white" style="margin: 10px 0 10px 0;padding: 20px !important;">
              <div class="hero-inner">
                <p class="lead text-center" style="text-transform: uppercase;"><i class="fa fa-info-circle" style="font-size: x-large;"></i> DEPART : {{$voyage->villeD}} (Parc de l'agence) le {{$voyage->startDate}}</p>
              </div>
            </div>
          </div>




          <div class="tab-pane" id="Programme">
            @if(count($programmes) > 0 )
            <div class="card-header">
              <h4></h4>
              <div class="card-header-action">
                <a href="/programme/{{$voyage->id }}" id="IdVoyage" class="btn btn-icon btn-primary float-right" data-toggle="tooltip" data-original-title="Modifier"><i class="fas fa-edit"></i></a><br><br>
                <!-- <button type="submit" value="{{$voyage->id}}" class="btn btn-danger deleteAll" data-toggle="tooltip" data-original-title="Supprimer"><i class="far fa-trash-alt"></i></button> -->
              </div>
            </div>
            <div class="program-box">
              <div class="invoice" id="printMe">
                <div class="invoice-print">
                  @foreach ($programmes as $programme)
                  {!! $programme['Programme'] !!}
                </div>
              </div>
            </div>



            <div style="text-align:center;margin-bottom:20px;">
              <!-- <button class="btn btn-warning btn-icon icon-left print-window" style="cursor:grab;"><i class="fas fa-print"></i><a onclick="printPageArea('printableArea')"> Imprimer</a></button> -->
              <button class="btn btn-warning btn-icon icon-left" style="cursor:grab;" onclick="printDiv('printMe')"><i class="fas fa-print"></i>Imprimer</button>
            </div>
            @endforeach
            <!-- <div class="breadcrumb-item active"><a href="/programme/{{$voyage->id }}" id="IdVoyage"><i style="font-size: smaller;"></i><b>Cliquez ici pour modifier un programme</b></a></div></br> -->
            <!-- <a href="/voyages/' + row.id + '" class="btn btn-icon icon-left btn-primary"><i class="fas fa-eye"></i>Voir</a> -->
            <!-- <button href="/addprogramme/{{$voyage->id }}" class="btn btn-primary" id="voyageId"  > Modifier</button> -->
            @else
            <div class="text-center">
              <strong> <i class="fas fa-exclamation-triangle"></i> Aucune programe n'est associé</strong><br>
              <div class="breadcrumb-item active"><a href="/programme/{{$voyage->id }}"><i style="font-size: smaller;"></i><b>Cliquez ici pour ajouter un programme</b></a></div></br>
            </div>

            @endif
          </div>








          <div class="tab-pane" id="Gallery">
            <div class="gallery gallery-fw center" data-item-height="100">
              <div class="card">
                <div class="card-header">
                  <h4></h4>
                  <div class="card-header-action">


                    <label>
                      <b class="btn btn-secondary">
                        <input type="checkbox" id="checkAll" class="d-none"><b data-toggle="tooltip" data-original-title="Tout sélectionner"><i class="fa fa-check"></i></b>
                      </b>
                    </label>



                    <!-- <button type="button" class="btn btn-primary" data-toggle="tooltip" data-original-title="Ajouter"><i class="fas fa-plus"></i></button> -->
                    <b data-toggle="tooltip" data-original-title="Ajouter"><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus"></i></button></b>
                    <!-- Start Add Model -->
                    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <form method="POST" action="{{ route('image.add' , $voyage->id) }}" class="dropzone" id="mydropzone" enctype="multipart/form-data">
                            @csrf
                            <div class="fallback">
                              <input type="file" name="photo" multiple>
                            </div>
                            <!-- <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                              <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div> -->
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- End Add Model -->
                    <!-- <button type="submit" value="{{$voyage->id}}" class="btn btn-danger deleteAll" data-toggle="tooltip" data-original-title="Supprimer"><i class="far fa-trash-alt"></i></button> -->
                    <button type="button" value="{{$voyage->id}}" name="delete" id="delete" class="btn btn-danger delete" data-toggle="tooltip" data-original-title="Supprimer"><i class="far fa-trash-alt"></i></button>
                    <!-- <input type="checkbox" id="checkAll" class="d-none" >Check All -->
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
                      <!-- <div class="gallery-item" data-image="../img/nohotel.jpg" style="height:190px; Width: 190px"></div> -->
                      @elseif($count==1)
                      <div>
                        <label class="imagecheck mb-4">
                          <input name="imagecheck" type="checkbox" value="{{$pictures[0]['id']}}" class="imagecheck-input" />
                          <figure class="imagecheck-figure">
                            <img src="../storage/{{$voyage->id}}/{{$pictures[0]['file_name']}}" alt="}" class="imagecheck-image" style="height:165px; Width: 165px">
                          </figure>
                        </label>
                      </div>
                      <!-- <div class="gallery-item" data-image="../storage/{{$voyage->id}}/{{$pictures[0]['file_name']}}" data-title="{{$pictures[0]['id']}}" style="height:190px; Width: 190px"><button style="width:37px;position: inherit;left:80px; border-radius: 20px; top: 78%;" class="btn btn-icon icon-left btn-danger delete" data-toggle="tooltip" title="Supprimer" type="submit" value="{{$pictures[0]['id']}}"><i class="far fa-trash-alt"></i> </button></div> -->
                      @else
                      @foreach ($pictures as $pic)
                      <!-- <div class="card">
                        <div class="card-body">
                          <div class="card-header">
                            <div class="card-header-action"> -->
                      <!-- <button style="width:37px;position: inherit;left:px; border-radius: 20px; top: 78%;" class="btn btn-icon icon-left btn-danger delete" data-toggle="tooltip" title="Supprimer" type="submit" value="{{$pic['id']}}"><i class="far fa-trash-alt"></i> </button> -->
                      <!-- <a href="#" value="{{$pic['id']}}" class="btn btn-primary delete">Voir</a>
                            </div>
                          </div> -->
                      <!-- <a href="../storage/{{$voyage->id}}/{{$pic['file_name']}}" class="chocolat-image" title="Just an example"> -->
                      <!-- <label class="imagecheck">
                            <input name="imagecheck" type="checkbox" value="{{$pic['id']}}" class="imagecheck-input" />
                            <figure class="imagecheck-figure">
                              <img src="../storage/{{$voyage->id}}/{{$pic['file_name']}}" value="{{$pic['id']}}" alt="}" class="imagecheck-image" style="height:165px; Width: 165px">
                            </figure>
                          </label>
                        </div>
                      </div> -->

                      <!-- <div class="card-header" style="border-bottom:hidden;">
                            <a href="#" value="{{$pic['id']}}" class="btn btn-primary delete">Voir</a>
                          </div> -->

                      <div>
                        <label class="imagecheck">
                          <!-- <input name="imagecheck" value="{{$pic['id']}}" id="img" type="checkbox" class="imagecheck-input" /> -->

                          <input type="checkbox" name="imagecheck-input[]" class="imagecheck-input" id="pas" value="{{$pic['id']}}" />

                          <figure class="imagecheck-figure">
                            <img src="../storage/{{$voyage->id}}/{{$pic['file_name']}}" value="{{$pic['id']}}" alt="}" class="imagecheck-image" style="height:165px; Width: 165px">
                          </figure>
                        </label>
                      </div>

                      <!-- <div class="gallery-item" data-image="../storage/{{$voyage->id}}/{{$pic['file_name']}}" data-title="{{$pic['id']}}" style="height:190px; Width: 190px"><button style="width:37px;position: inherit;left:80px; border-radius: 20px; top: 78%;" class="btn btn-icon icon-left btn-danger delete" data-toggle="tooltip" title="Supprimer" type="submit" value="{{$pic['id']}}"><i class="far fa-trash-alt"></i> </button></div> -->


                      <!-- <form method="post" action="{{ route('image.update',$voyage->id) }}" enctype="multipart/form-data"> -->
                      <!-- @csrf -->
                      <!-- <input type="hidden" name="id" value="{{$pic['id']}}" /> -->
                      <!-- <input type="file" name="photo" /> -->
                      <!-- <button class='btn btn-primary'>Modifier</button> -->
                      <!-- </form> -->
                      @endforeach
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>



          <div class="tab-pane" id="Maps">Tous les témoignages</div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h4>LES PLUS POPULAIRES :</h4>
      <div class="card-header-action">
        <a data-collapse="#mycard-collapse" class="btn btn-primary" href="#"><i class="fas fa-minus"></i></a>
      </div>
    </div>
    <div class="collapse show" id="mycard-collapse">
      <div class="card-body">
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

<script>
  $('#myNavTabs a').click(function(evt) {
    evt.preventDefault();
    $(this).tab('show');
  });


  // $('.delete').click(function(e) {
  //   let id = $(this).val();
  //   $.ajaxSetup({
  //     headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //     }
  //   });

  //   let text = "Photo va être supprimé !";
  //   swal({
  //       title: "Êtes-vous sûr ?",
  //       text: text,
  //       icon: "warning",
  //       buttons: ["Annuler", "Supprimer!"],
  //       dangerMode: true,
  //     })
  //     .then((willDelete) => {
  //       if (willDelete) {

  //         $.ajax({
  //           method: 'DELETE', // Type of response and matches what we said in the route
  //           url: '/voyage/deleteimage/' + id, // This is the url we gave in the route
  //           data: {
  //             'willDelete': willDelete
  //           }, // a JSON object to send back
  //           success: function(response) { // What to do if we succeed
  //             location.reload();
  //             console.log('done');
  //           }
  //         });
  //         let text1 = "Photo est supprimé avec succès"
  //         swal({
  //           title: "Termié",
  //           icon: "success",
  //           text: text1,
  //           timer: 1000,
  //           buttons: false,
  //           closeOnEsc: false,
  //           closeOnClickOutside: false,
  //         });
  //       } else {
  //         e.preventDefault();
  //         swal({
  //           title: "ANNULÉ",
  //           text: "vous avez annulé la suppression de cet photo",
  //           icon: "error",
  //         });
  //         console.log('cancel deleting');
  //       }
  //     });
  // });


  // $('.deleteAll').click(function(e) {
  //   let id = $(this).val();
  //   $.ajaxSetup({
  //     headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //     }
  //   });

  //   let text = "Tout photos va être supprimé !";
  //   swal({
  //       title: "Êtes-vous sûr ?",
  //       text: text,
  //       icon: "warning",
  //       buttons: ["Annuler", "Supprimer!"],
  //       dangerMode: true,
  //     })
  //     .then((willDelete) => {
  //       if (willDelete) {

  //         $.ajax({
  //           method: 'DELETE', // Type of response and matches what we said in the route
  //           url: '/voyage/deletall/' + id, // This is the url we gave in the route
  //           data: {
  //             'willDelete': willDelete
  //           }, // a JSON object to send back
  //           success: function(response) { // What to do if we succeed
  //             location.reload();
  //             console.log('done');
  //           }
  //         });
  //         let text1 = "Tout photos sont supprimé avec succès"
  //         swal({
  //           title: "Termié",
  //           icon: "success",
  //           text: text1,
  //           timer: 1000,
  //           buttons: false,
  //           closeOnEsc: false,
  //           closeOnClickOutside: false,
  //         });
  //       } else {
  //         e.preventDefault();
  //         swal({
  //           title: "ANNULÉ",
  //           text: "vous avez annulé la suppression",
  //           icon: "error",
  //         });
  //         console.log('cancel deleting');
  //       }
  //     });
  // });



  //   $(document).ready(function() {

  //   $.ajaxSetup({
  //       headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //       }
  //   });
  //   function getVoyage(id){
  //     $.ajax({
  //       url:'http://utecom.test/voyage/'+id,
  //       method:'GET',
  //       success:function(data){
  //      console.log(data.data);
  //     //$('#type option[value='+data.dat+').attr('selected','selected');

  //          $("#voyageId").val(data.data[0].id);
  //         $("#jour").val(data.data[0].Date);
  //         $("#programme").val(data.data[0].Programme);

  //       }
  //     });
  //   }

  //   $('button[href="/addprogramme/{{$voyage->id }}"]').on('click',function(){
  //     console.log("clicked");
  //     var id= $(this).val();
  //     getVoyage(id);
  //   });
  //   $('#editForm').on('submit', function(e){
  //       e.preventDefault();

  //       var id = $('#voyageId').val();
  //       console.log($('#editForm').serialize());
  //       $.ajax({
  //           type: "POST",
  //           url: "/Updateprogramme/" +id,
  //           data: $('voyageId').serialize(),

  //           success: function (response) {
  //             console.log()
  //               console.log(response);
  //               let text2 = "Bien ,votre changement a été effectuée avec succès"
  //           swal({
  //             title: "Termié",
  //             icon: "success",
  //             text: text2,
  //             timer: 4000,
  //             buttons: false,
  //             closeOnEsc: false,
  //             closeOnClickOutside: false,
  //           });

  //           },
  //           error:function(error,status){
  //               console.log(error);
  //               console.log(status);
  //           }
  //       });
  //   });

  // });

  // $('.print-window').click(function() {
  //   window.print("");
  // });


  // print
  function printDiv(invoice) {
    var printContents = document.getElementById(invoice).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;

  }

  // $("#mydropzone").dropzone({ url: "add/voyage/16" });
  // var myDropzone = new Dropzone("#mydropzone", { url: "add/voyage/16"});
  // myDropzone.options.myAwesomeDropzone = {
  // paramName: "file", // The name that will be used to transfer the file
  // maxFilesize: 2, // MB
  // accept: function(file, done) {
  //   console.log('done');
  // }
  // };

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

  // $("#pas").click(function() {
  //   if ($('.imagecheck-input:checked').prop('checked')) {
  //     console.log('yes');
  //     $('#checkAll').show();
  //     $('#checkAll').removeClass('d-none');

  //   } else {
  //     console.log('no');
  //     $('#checkAll').hide();
  //   }
  // });
</script>



@endsection