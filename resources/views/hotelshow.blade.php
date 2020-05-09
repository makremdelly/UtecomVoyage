@extends('layouts.dash')
@section('content')
    <!-- Main Content -->
    <?php $count = count($pictures); ?>
<div class="section-body">
     <div class="row">
       <div class="col-12">
            <div class="card card-primary">
                <div class="card-body">
                  <div class="card">
                    <div class="card-body">
                      <h6 style="font-family: monospace;font-size: small;color: #34395e;"><i class="fas fa-map-marker-alt" style="color: #e20a0a;font-size: 16px;padding-left: 5px;"></i> {{Str::upper($hotel->address)}}</h6>
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
                            <img class="d-block w-100 img-fluid" src="../storage/{{$hotel->id}}/{{$pictures[0]['file_name']}}" alt="First slide" style="height:500px;">
                          </div>
                        </div>
                       @elseif($count>1)
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img class="d-block w-100 img-fluid" src="../storage/{{$hotel->id}}/{{$pictures[0]['file_name']}}"  alt="First slide" style="height:500px;">
                          </div>
                          @foreach (array_slice($pictures,1) as $pic)
                            <div class="carousel-item">
                              <img class="d-block w-100 img-fluid" src="../storage/{{$hotel->id}}/{{$pic['file_name']}}" alt="Second slide" style="height:500px;">
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
                    <h1 style="text-align:center;margin:0;font-family: monospace;color: #383d5f;">{{Str::upper($hotel->name)}}</h1>
                    <div style="text-align:center;">
                      @switch ($hotel->stars) 
                      @case ('1')
                      <h1><i class="fas fa-star" style="font-size:x-large;color:#FFD700;"></i></h1>
                        @break
                      @case ('2')
                      <h1><i class="fas fa-star" style="font-size:x-large;color:#FFD700;"></i><i class="fas fa-star" style="font-size:x-large;color:#FFD700;"></i></h1>
                        @break
                      @case ('3')
                      <h1><i class="fas fa-star" style="font-size:x-large;color:#FFD700;"></i><i class="fas fa-star" style="font-size:x-large;color:#FFD700;"></i><i class="fas fa-star" style="font-size:x-large;color:#FFD700;"></i></h1>
                        @break
                      @case ('4')
                      <h1><i class="fas fa-star fa-10x" style="font-size:x-large;color:#FFD700;"></i><i class="fas fa-star" style="font-size:x-large;color:#FFD700;"></i><i class="fas fa-star" style="font-size:x-large;color:#FFD700;"></i><i class="fas fa-star" style="font-size:x-large;color:#FFD700;"></i></h1>
                        @break
                      @case ('5')
                      <h1><i class="fas fa-star" style="font-size:x-large;color:#FFD700;"></i><i class="fas fa-star" style="font-size:x-large;color:#FFD700;"></i><i class="fas fa-star" style="font-size:x-large;color:#FFD700;"></i><i class="fas fa-star" style="font-size:x-large;color:#FFD700;"></i><i class="fas fa-star"style="font-size:x-large;color:#FFD700;"></i></h1>
                        @break  
                      @endswitch
                    </div>
                    {{-- <div style="text-align:center;"> --}}
                      {{-- next thing goes here --}}
                    {{-- </div> --}}
                      <hr>
                      <blockquote style="font-family: monospace;height: 60px;font-size: unset;font-style: unset;">
                          Créé le {{Str::limit($hotel->created_at,10,(''))}}
                      </blockquote>
                      <div class="row">
                          <div class="col-12 col-md-8 col-lg-8" style="word-spacing: 5px;line-height: 26pt;">
                           {{$hotel->description}}
                          </div>
                          <div class="col-12 col-md-4 col-lg-4">
                              <div class="pricing">
                                  <div class="pricing-title">
                                      les plus populaires à l'hôtel
                                  </div>
                                  <div class="pricing-padding" style="padding: 15px;">
                                    <div class="pricing-details">
                                      @foreach ($service as $s)
                                      <div class="pricing-item">
                                        <i class="{{$s['icon']}}" style="font-size: 20px;"></i>
                                      <div class="pricing-item-label" data-toggle="tooltip" title="" data-original-title="{{$s['description']}}" style="padding-left: 8px;cursor: help;"> {{Str::upper($s['name'])}}</div>
                                      </div>
                                      @endforeach
                                    </div>
                                  </div>
                                </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header">
                            <h4>Gestionnaires :</h4>
                            <div class="card-header-action">
                              <a data-collapse="#mycard-collapse" class="btn btn-primary" href="#"><i class="fas fa-minus"></i></a>
                            </div>
                          </div>
                          <div class="collapse show" id="mycard-collapse" style="">
                            <div class="card-body">
                              <div class="row">
                                @foreach ($owners as $owner)
                                  <div class="col mb-4 mb-lg-0 text-center">
                                    <img alt="image" class="mr-3 rounded-circle" width="50" height="50" src="{{$owner['picture']}}">
                                    <div class="mt-2 font-weight-bold" style="padding-right: 17px;">{{$owner['name']}}</div>
                                  </div>
                                @endforeach
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- <div class="card"> --}}
                        <div class="card-header">
                          <h4>Réservations : <div class="badge badge-info" style="vertical-align: unset;background-color: #6777ef;border-radius:0%;">{{$rest['reservations_count']}}</div></h4>
                        </div>
                        <div class="card-body p-2">
                          <div class="row">
                            <div class="col-12">
                              <div class="card">
                                    <div class="table-responsive">
                                  {{-- <div class="section-title mt-0">text here </div> --}}
                                  <table id="Myexample" class="table" style="width:100%">
                                    <caption>Liste des reservations du cet Hotel</caption>
                                    <thead>
                                      <tr>
                                        <th class="me">#</th>
                                        <th class="me">Client</th>
                                        <th class="me">Email</th>
                                        <th class="me">Date reservation</th>
                                        <th class="me">Montant payé</th>
                                        <th class="notmee">Details</th>
                                      </tr>
                                    </thead>
                                  </table>
                                </div>
                                </div>
                              </div> 
                          </div>
                        </div>
                      {{-- </div> --}}
                </div>
              </div>
            </div> 
        </div>
    </div>
</div>
<script>
   $(document).ready(function() {
    $('#Myexample thead tr ').clone(true).appendTo( '#Myexample thead' );
       $('#Myexample thead tr:eq(0) th.me').each( function (i) {
          var title = $(this).text();
          $(this).html( '<input type="text" class="form-control input-sm" placeholder="'+title+'" />' );
           $( 'input', this ).on( 'keyup change', function () {
               if ( table.column(i).search() !== this.value ) {
                   table
                       .column(i)
                       .search( this.value )
                       .draw();
               }
           } );
       } );
       $('#Myexample thead tr:eq(0) th.notmee ').html('');

       var table = $('#Myexample').DataTable( {
         "language": {
               "lengthMenu": "Afficher _MENU_ élements",
               "zeroRecords": "Rien trouvé - désolé",
               "info": "Afficher la page _PAGE_ de _PAGES_",
               "infoEmpty": "Aucun enregistrement disponible",
               "infoFiltered": "(filtré à partir du _MAX_ total d'enregistrements)",
               "search": "Chercher:",
               "loadingRecords": "Chargement...",
               "processing": "En traitement...",
               "paginate": {
                   "previous": "Précédent",
                   "next": "Suivant"
               }, 
             },
             "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
        "columnDefs":
            [ {
               "targets": 5,
               "orderable":false,
               "searchable":false,
           } ],
           "drawCallback":function(e,setting){
              $("[data-toggle='tooltip']").tooltip();
              $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              
           },
           serverSide: true,
           processing: true,
           "ajax": {
             "url": window.location.href+'/reservationcollection',
             "type": "get",
             "dataType": "json",
             "dataSrc": "data",
             "headers": "Content-Type: application/json",
             "deferRender": true,
           },
           tooltip:true,
           autoheight:true,
           
           columns: [
               { data: 'id', name: 'id'},
               { data: 'user_name', name: 'user_name'},
               { data: 'user_email', name: 'user_email'},
               { 
                 "render": function (data, type, row, meta){
                  return ('<div class="buttons"><b data-toggle="tooltip" title="" data-original-title="'+moment(row.created_at).format('LL')+'">'+moment(row.created_at, "YYYYMMDD").fromNow()+'</b></div>');
                 }
               },
               { data: 'amount', name:'amount'},
               {
                   "render": function (data, type, row, meta){ 
                    return('<a href="'+window.location.href+'/reservation/'+row.id+'" class="btn btn-outline-primary get-meme" value="'+row.id+'">Détail</a>');
                   },
               }
           ],  
       });
   });
</script>
@endsection

