@extends('layouts.dash')

@section('content')
<!-- Main Content -->
<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <!-- Start Add Model -->
          <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ajouter un hôtel </h5>
                  <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                  <a data-dismiss="modal" class=" btn btn-icon btn-light" aria-label="Close"><i class="fas fa-times"></i></a>
                  <!-- <span aria-hidden="true">&times;</span> -->
                </div>
                <form method="POST" action="{{ route('add.post.show') }}" id="signup-form" class="signup-form" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                    <div class="row">
                      <div class="form-group col-md-6 col-12"> <label>Nom</label>
                        <input type="text" class="form-control" name="name" required autofocus />
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Etoiles</label>
                        <select class="form-control" name="star" required autofocus>
                          <option value="">Choisir</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6 col-12">
                        <label>Téléphone</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="fas fa-phone"></i>
                            </div>
                          </div>
                          <input type="text" class="form-control phone-number" pattern="^\+?\s*(\d+\s?){8,}$" name="phone" required autofocus>
                        </div>
                      </div>

                      <div class="form-group col-md-6 col-12">
                        <label>Adresse</label>
                        <input type="search" id="address" name="address" required autofocus />
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-md-6 col-12"> <label>Galerie</label>
                        <input type="file" name="image[]" multiple="multiple" class="form-control" id="picture" required autofocus>
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Service</label>
                        <select class="form-control" name="service" id="service" required autofocus>
                          <option value="">Choisir</option>
                          <option value="WIFI">WIFI</option>
                          <option value="ascenseur">ascenseur</option>
                          <option value="Salle de Sport">Salle de Sport</option>
                          <option value="Parking">Parking</option>
                          <option value="jardin">jardin</option>
                        </select>
                      </div>
                    </div>


                    <div class="form-group">
                      <label>Description de l'hotel</label>
                      <textarea class="form-control" name="description" rows="3" required autofocus></textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- End Add Model -->


          <!-- Start Edit Model -->
          <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modifier un hotel</h5>
                  <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                  <a data-dismiss="modal" class=" btn btn-icon btn-light" aria-label="Close"><i class="fas fa-times"></i></a>
                  <!-- <span aria-hidden="true">&times;</span> -->
                  </button>
                </div>
                <form method="post" id="editForm" class="signup-form" enctype="multipart/form-data">
                  <div class="modal-body">

                    <div class="row">
                      <div class="form-group col-md-6 col-12"> <label>Nom</label>
                        <input type="text" class="form-control" name="name" id="name" required autofocus />
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Etoiles</label>
                        <select class="form-control" id="star" name="star" required autofocus>
                          <option value="">Choisir</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6 col-12">
                        <label>Téléphone</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="fas fa-phone"></i>
                            </div>
                          </div>
                          <input type="text" class="form-control phone-number" pattern="^\+?\s*(\d+\s?){8,}$" name="phone" id="phone" required autofocus>
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Adresse</label>
                        <input type="search" id="address1" name="address" required autofocus />
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6 col-12"> <label>Galerie</label>
                        <input type="file" name="image[]" multiple="multiple" class="form-control" id="picture" required autofocus>
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Service</label>
                        <select class="form-control" name="service" id="service" required autofocus>
                          <option value="">Choisir</option>
                          <option value="WIFI">WIFI</option>
                          <option value="ascenseur">ascenseur</option>
                          <option value="Salle de Sport">Salle de Sport</option>
                          <option value="Parking">Parking</option>
                          <option value="jardin">jardin</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Description de l'hotel</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3" required autofocus></textarea>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <input type="hidden" name="hotelId" id="hotelId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- End Edit Model -->




          <div class="table-responsive">
            <div align="right">
              <div class="buttons"><b data-toggle="tooltip" data-original-title="Cliquez ici pour ajouter un hôtel"><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus" style="font-size: smaller;"></i></button></b></div>
            </div>
            </br>
            <table id="example" class="table table-hover table-responsive-sm" style="width:100%">
              <thead>
                <tr>
                  <th class="mee" style="width:75px;">id</th>
                  <th class="mee">Nom</th>
                  <th class="mee" style="width:80px;" id="notmee">Etoiles</th>
                  <th class="mee">Date d'inscription</th>
                  <th class="mee">chambres</th>
                  <th class="mee">Reservations</th>
                  <th></th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {

    // Setup - add a text input to each footer cell
    $('#example thead tr ').clone(true).appendTo('#example thead');
    $('#example thead tr:eq(0) th.mee ').each(function(i) {
      var title = $(this).text();
      $(this).html('<input type="text" class="form-control input-sm" placeholder="' + title + '" />');
      $('input', this).on('keyup change', function() {
        if (table.column(i).search() !== this.value) {
          table
            .column(i)
            .search(this.value)
            .draw();
        }
      });
    });

    $('#example thead tr:eq(0) th#notmee.mee ').html(`<select class="form-control" id="etoiles">
        <option value="">Choisir</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>`);
    $('#etoiles').on('keyup change', function() {
      if (this.value == null) {
        table.clear();
      } else
      if (table.column(2).search() !== this.value) {
        table
          .column(2)
          .search(this.value)
          .draw();
      }

    });

    var table = $('#example').DataTable({
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

      "columnDefs": [{
        "targets": 6,
        "orderable": false,
        "searchable": false,
      }],
      "drawCallback": function(e, setting) {
        $("[data-toggle='tooltip']").tooltip();
        $('.delete-row').click(function(e) {
          e.preventDefault();
          let id = $(this).val();
          let $tr = $(this).closest('tr');
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          let text = "L'hôtel Numero : " + id + " va être supprimé !";
          swal({
              title: "Êtes-vous sûr ?",
              text: text,
              icon: "warning",
              buttons: ["Annuler", "Supprimer!"],
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $tr.find('td').fadeOut(500, function() {
                  $tr.remove();
                });
                $.ajax({
                  method: 'DELETE', // Type of response and matches what we said in the route
                  url: '/hotels/destroy/' + id, // This is the url we gave in the route
                  data: {
                    'willDelete': willDelete
                  }, // a JSON object to send back
                  success: function(response) { // What to do if we succeed
                    console.log('done');
                  }
                });
                let text1 = "L'hôtel Numero : " + id + " est supprimé avec succès"
                swal({
                  title: "Termié",
                  icon: "success",
                  text: text1,
                  timer: 1000,
                  buttons: false,
                  closeOnEsc: false,
                  closeOnClickOutside: false,
                });
              } else {
                e.preventDefault();
                swal({
                  title: "ANNULÉ",
                  text: "vous avez annulé la suppression de cet hôtel",
                  icon: "error",
                });
                console.log('cancel deleting');
              }
            });
        })



        // Update Data

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        function getHotel(id) {
          $.ajax({
            url: 'http://utecom.test/hotel/' + id,
            method: 'GET',
            success: function(data) {
              console.log(' typpeof ', typeof data)
              data = JSON.parse(data);
              console.log(' typpeof2 ', typeof data)
              $("#hotelId").val(data[0].id);
              $("#name").val(data[0].name);
              $("#star").val(data[0].stars).change();
              $("#phone").val(data[0].phone);
              $("#address1").val(data[0].address);
              $("#service").val(data[0].name).change();
              $("#exampleFormControlTextarea1").val(data[0].description);
            }
          });
        }

        $('button[href="#myModal"]').on('click', function() {
          console.log("clicked");
          var id = $(this).val();
          getHotel(id);
        });
        $('#editForm').on('submit', function(e) {
          e.preventDefault();

          var id = $('#hotelId').val();
          console.log($('#editForm').serialize());
          $.ajax({
            type: "POST",
            url: "/voyage/update/" + id,
            data: $('#editForm').serialize(),

            success: function(response) {
              console.log()
              console.log(response);
              $('#myModal').modal('hide'); //close model
              setTimeout(function() {
                window.location = window.location
              }, 3000);
              let text2 = "Bien ,votre changement a été effectuée avec succès"
              swal({
                title: "Termié",
                icon: "success",
                text: text2,
                timer: 4000,
                buttons: false,
                closeOnEsc: false,
                closeOnClickOutside: false,
              });

            },
            error: function(error, status) {
              console.log(error);
              console.log(status);
            }
          });
        });
      },

      serverSide: true,
      processing: true,
      "ajax": {
        "url": 'http://utecom.test/hotels/datacollection',
        "type": "get",
        "dataType": "json",
        "dataSrc": "data",
        "headers": "Content-Type: application/json",
        "deferRender": true,
      },
      tooltip: true,
      autoheight: true,

      columns: [{
          data: 'id',
          name: 'id'
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          "render": function(data, type, row, meta) {
            switch (row.stars) {
              case '1':
                return ('<i class="fas fa-star"></i>');
                break;
              case '2':
                return ('<i class="fas fa-star"></i><i class="fas fa-star"></i>');
                break;
              case '3':
                return ('<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>');
                break;
              case '4':
                return ('<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>');
                break;
              case '5':
                return ('<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>');
                break;
            }
          }
        },
        {
          "render": function(data, type, row, meta) {
            return ('<div class="buttons"><b data-toggle="tooltip" title="" data-original-title="' + moment(row.created_at).format('LL') + '">' + moment(row.created_at, "YYYYMMDD").fromNow() + '</b></div>');
          }
        },

        {
          data: 'rooms_count',
          name: 'rooms_count'
        },
        {
          data: 'reservations_count',
          name: 'reservations_count'
        },
        {
          "render": function(data, type, row, meta) {
            // return ('<div class="btn-group"><a href="/hotels/' + row.id + '" class="btn btn-icon icon-left btn-primary"><i class="fas fa-eye"></i>Voir</a><button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button><form method="post" action="/hotels/destroy/' + row.id + '">{{ method_field('DELETE ') }}<input type="hidden" name="_token" value="{{ csrf_token() }}"><div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; top: 0px; left: 0px; will-change: transform; padding: 0px; width:0;"><button class="dropdown-item btn btn-icon icon-left btn-danger delete-row" style="width:100px;position: inherit;left: 51px;" type="submit" value="' + row.id + '"><i class="far fa-trash-alt"></i> Supprimer</button></div></form></div>');
            // return ('<div class="btn-group"><a href="/hotels/' + row.id + '" class="btn btn-icon icon-left btn-primary"><i class="fas fa-eye"></i>Voir</a><button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button> <div class="dropdown-menu"  x-placement="bottom-start" style="position: absolute; top: 0px; left: 0px; will-change: transform; padding: 0px; width:0;"><div class="btn-group-vertical" style="width:100px;position: inherit;left: 51px;" role="group" aria-label="Basic example"><button href="#myModal" data-toggle="modal" class="dropdown-item btn btn-icon icon-left btn-info " id="' + row.id + '" value="' + row.id + '" ><i class="far fa-edit"></i> Modifier</button><form method="post" action="/hotels/destroy/' + row.id + '">{{ method_field('DELETE ') }}<input type="hidden" name="_token" value="{{ csrf_token() }}"><button class="dropdown-item btn btn-icon icon-left btn-danger delete-row" type="submit" value="' + row.id + '"><i class="far fa-trash-alt"></i> Supprimer</button></form></div></div></div></div>');
            return ('<div class="btn-group"><a href="/hotels/' + row.id + '" class="btn btn-icon icon-left btn-primary"><i class="fas fa-eye"></i>Voir</a><button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button> <div class="dropdown-menu"  x-placement="bottom-start" style="position: absolute; top: 0px; left: 0px; will-change: transform; padding: 0px; width:0;"><div class="btn-group-vertical" style="width:100px;position: inherit;left: 51px;" role="group" aria-label="Basic example"><button href="#myModal" data-toggle="modal" class="dropdown-item btn btn-icon icon-left btn-info " id="' + row.id + '" value="' + row.id + '" ><i class="far fa-edit"></i> Modifier</button><button class="dropdown-item btn btn-icon icon-left btn-danger delete-row"  type="submit" value="' + row.id + '"><i class="far fa-trash-alt"></i> Supprimer</button></div></div></div></div>');
          },
        }
      ],
    });
  });
</script>
<script>
  var placesAutocomplete = places({
    appId: 'plCZUMZQD4ER',
    apiKey: 'de73017c39b308492fe22873f2b059ad',
    container: document.querySelector('#address')
  });
  var placesAutocomplete = places({
    appId: 'plCZUMZQD4ER',
    apiKey: 'de73017c39b308492fe22873f2b059ad',
    container: document.querySelector('#address1')
  });
</script>
@endsection