@extends('layouts.dash')
@section('content')
<!-- Main Content -->
<?php $count = count($pictures); ?>
<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h4 style="font-family: monospace;font-size: small;color: #34395e;"><i class="fas fa-map-marker-alt" style="color: #e20a0a;font-size: 16px;padding-left: 5px;"></i> {{Str::upper($rest['address'])}}</h4>
          <div class="card-header-action">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Voir tout</button>

            <!-- Start Add Model -->

            <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
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
                              <form action="#" class="dropzone" id="mydropzone" enctype="multipart/form-data">
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
                      <button type="button"  name="delete" id="delete" class="btn btn-danger delete" data-toggle="tooltip" data-original-title="Supprimer"><i class="far fa-trash-alt"></i></button>

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
                              <img src="../storage/{{$room->id}}/{{$pictures[0]['file_name']}}" alt="}" class="imagecheck-image" style="height:165px; Width: 165px">
                            </figure>
                          </label>
                        </div>
                        @else
                        @foreach ($pictures as $pic)
                        <div>
                          <label class="imagecheck">
                            <input type="checkbox" name="imagecheck-input[]" class="imagecheck-input" id="pas" value="{{$pic['id']}}" />
                            <figure class="imagecheck-figure">
                              <img src="../storage/{{$room->id}}/{{$pic['file_name']}}" value="{{$pic['id']}}" alt="}" class="imagecheck-image" style="height:165px; Width: 165px">
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
            <!-- <a href="#" class="btn btn-danger">Supprimer tout</a> -->
          </div>
        </div>
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
                    <img class="d-block w-100 img-fluid" src="../storage/{{$room->id}}/{{$pictures[0]['file_name']}}" alt="First slide" style="height:500px;">
                  </div>
                </div>
                @elseif($count>1)
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100 img-fluid" src="../storage/{{$room->id}}/{{$pictures[0]['file_name']}}" alt="First slide" style="height:500px;">
                  </div>
                  @foreach (array_slice($pictures,1) as $pic)
                  <div class="carousel-item">
                    <img class="d-block w-100 img-fluid" src="../storage/{{$room->id}}/{{$pic['file_name']}}" alt="Second slide" style="height:500px;">
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

          <div class="card-body p-2">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="table-responsive">
                    {{-- <div class="section-title mt-0">text here </div> --}}
                    <table id="Myexample" class="table" style="width:100%">
                      <caption>Liste des reservations du cet chambre</caption>
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
               { data: 'reservation_id', name: 'reservation_id'},
               { data: 'name', name: 'name'},
               { data: 'email', name: 'email'},
               { 
                 "render": function (data, type, row, meta){
                  return ('<div class="buttons"><b data-toggle="tooltip" title="" data-original-title="'+moment(row.arrival_date).format('LL')+'">'+moment(row.arrival_date, "YYYYMMDD").fromNow()+'</b></div>');
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
<script>
  $("#checkAll").click(function() {
    $('input:checkbox').not(this).prop('checked', this.checked);
  });
</script>
@endsection