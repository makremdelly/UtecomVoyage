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
            <div class="modal-dialog">
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
                    <div class="form-group">
                      <label>Nom</label>
                      <input type="text" class="form-control" name="name" />
                    </div>
                    <div class="form-group">
                      <label>Etoiles</label>
                      <select class="form-control" id="star" name="star">
                        <option value="">Choisir</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                      </select>
                    </div>
                    <label>Téléphone</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-phone"></i>
                        </div>
                      </div>
                      <input type="text" class="form-control phone-number" pattern="^\+?\s*(\d+\s?){8,}$" name="phone">
                    </div>
                    <div class="form-group">
                      <label>Adresse</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-map-marker-alt"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control" name="address" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="form-label">Service</label>
                      <div class="selectgroup selectgroup-pills">
                        <label class="selectgroup-item">
                          <input type="checkbox" name="designation" value="PARKING" class="selectgroup-input" checked="">
                          <span class="selectgroup-button">PARKING</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" name="designation" value="WIFI" class="selectgroup-input">
                          <span class="selectgroup-button">WIFI</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" name="designation" value="SALLE DE SPORT" class="selectgroup-input">
                          <span class="selectgroup-button">SALLE DE SPORT</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" name="designation" value="ASCENSEUR" class="selectgroup-input">
                          <span class="selectgroup-button">ASCENSEUR</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" name="designation" value="JARDIN" class="selectgroup-input">
                          <span class="selectgroup-button">JARDIN</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" name="designation" value="Petit-déjeuner" class="selectgroup-input">
                          <span class="selectgroup-button">Petit-déjeuner</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" name="designation" value="Bagagerie" class="selectgroup-input">
                          <span class="selectgroup-button">Bagagerie</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="checkbox" name="designation" value="Climatisation" class="selectgroup-input">
                          <span class="selectgroup-button">Climatisation</span>
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Galerie</label>
                      <input type="file" name="image[]" multiple="multiple" class="form-control" id="picture">
                    </div>
                    <div class="form-group">
                      <label>Description de l'hotel</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
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
            return ('<div class="btn-group"><a href="/hotels/' + row.id + '" class="btn btn-icon icon-left btn-primary"><i class="fas fa-eye"></i>Voir</a><button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button><form method="post" action="/hotels/destroy/' + row.id + '">{{ method_field('DELETE ') }}<input type="hidden" name="_token" value="{{ csrf_token() }}"><div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; top: 0px; left: 0px; will-change: transform; padding: 0px; width:0;"><button class="dropdown-item btn btn-icon icon-left btn-danger delete-row" style="width:100px;position: inherit;left: 51px;" type="submit" value="' + row.id + '"><i class="far fa-trash-alt"></i> Supprimer</button></div></form></div>');
          },
        }
      ],
    });
  });
</script>
@endsection