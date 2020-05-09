@extends('layouts.dash')
@section('content')
<!-- Main Content -->
<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <!-- <div class="breadcrumb-item active"><a href="/addvoyage/"><i class="fas fa-plus" style="font-size: smaller;"></i><b>  Nouvel Voyage</b></a></div></br>  -->
          <!-- <div class="breadcrumb-item active"><a href="/addvoyage/"><i class="fas fa-plus" style="font-size: smaller;"></i><b>  Nouvel Voyage</b></a></div></br>  -->

          <!-- Start Add Model -->
          <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ajouter un voyage</h5>
                  <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                  <a data-dismiss="modal" class=" btn btn-icon btn-light" aria-label="Close"><i class="fas fa-times"></i></a>
                  <!-- <span aria-hidden="true">&times;</span> -->
                  </button>
                </div>
                <form method="POST" action="{{ route('added.post.show') }}" id="signup-form" class="signup-form" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                    <div class="row">
                      <div class="form-group col-md-6 col-12">
                        <label>Type</label>
                        <select class="form-control" name="type">
                          <option value='0'>Voyages</option>
                          <option value="Voyages organisés">Voyages organisés</option>
                          <option value="carte">Voyage à la carte</option>
                          <option value="Circuit Sud">Circuit Sud</option>
                          <option value="Circuit Nord">Circuit Nord</option>
                          <option value="Croisière">Croisière</option>
                          <option value="séjour">Séjour</option>
                          <option value="عمرة">عمرة</option>
                        </select>
                        <div class="invalid-feedback">
                          select votre type de voyage
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Nombre des places</label>
                        <input type="text" class="form-control" name="nbplace">
                        <div class="invalid-feedback">
                          veuillez saisir le nombre du place
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6 col-12">
                        <label>Ville de départ</label>
                        <select type="text" class="form-control" name="villeD">
                          <option value="Tunis">Tunis</option>
                        </select>
                        <div class="invalid-feedback">
                          veuillez choisir votre ville de depart
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>Destination</label>

                            <select type="text" class="form-control" name="depart">
                              <option value="France" selected="selected">France </option>
                              <option value="Afrique_Centrale">Afrique_Centrale </option>
                              <option value="Afrique_du_sud">Afrique_du_Sud </option>
                              <option value="Algerie">Algerie </option>
                              <option value="Allemagne">Allemagne </option>
                              <option value="Arabie_Saoudite">Arabie_Saoudite </option>
                              <option value="Argentine">Argentine </option>
                              <option value="Australie">Australie </option>
                              <option value="Bahrein">Bahrein </option>
                              <option value="Belgique">Belgique </option>
                              <option value="Bresil">Bresil </option>
                              <option value="Bulgarie">Bulgarie </option>
                              <option value="Canada">Canada </option>
                              <option value="Canaries">Canaries </option>
                              <option value="Cap_vert">Cap_Vert </option>
                              <option value="Chili">Chili </option>
                              <option value="Chine">Chine </option>
                              <option value="Cote_d_Ivoire">Côte_d_Ivoire </option>
                              <option value="Danemark">Danemark </option>
                              <option value="Egypte">Egypte </option>
                              <option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option>
                              <option value="Espagne">Espagne </option>
                              <option value="Etats_Unis">Etats_Unis </option>
                              <option value="Ethiopie">Ethiopie </option>
                              <option value="France">France </option>
                              <option value="Grece">Grece </option>
                              <option value="Hawaii">Hawaii </option>
                              <option value="Hong_Kong">Hong_Kong </option>
                              <option value="Irlande">Irlande </option>
                              <option value="Islande">Islande </option>
                              <option value="Italie">italie </option>
                              <option value="Japon">Japon </option>
                              <option value="Jordanie">Jordanie </option>
                              <option value="Koweit">Koweit </option>
                              <option value="Luxembourg">Luxembourg </option>
                              <option value="Lybie">Lybie </option>
                              <option value="Malaisie">Malaisie </option>
                              <option value="Maldives">Maldives </option>
                              <option value="Maroc">Maroc </option>
                              <option value="Mexique">Mexique </option>
                              <option value="Norvege">Norvege </option>
                              <option value="Oman">Oman </option>
                              <option value="Palestine">Palestine </option>
                              <option value="Panama">Panama </option>
                              <option value="Portugal">Portugal </option>
                              <option value="Qatar">Qatar </option>
                              <option value="Russie">Russie </option>
                              <option value="Suisse">Suisse </option>
                              <option value="Thailande">Thailande </option>
                              <option value="Tunisie">Tunisie </option>
                              <option value="Turquie">Turquie </option>
                            </select>
                            <div class="invalid-feedback">
                              veuillez choisir votre destination
                            </div>
                          </div>
                          <div class="form-group col-md-6 col-12">
                            <label>Ville de arrivée</label>
                            <input type="text" class="form-control" name="retour" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6 col-12">
                        <label>Periode</label>
                        <div class="row">
                          <!-- <div class="form-group col-md-6 col-12">
                            <input type="date" class="form-control" name="startDate" placeholder="Date de départ" />
                          </div> -->

                          <div class="md-form">
                          <input placeholder="Selected date" type="text" name="startDate" id="date-picker-example" class="form-control datepicker">
                          </div>

                          <div class="md-form">
                          <input placeholder="Selected date" type="text" name="endDate" id="date-picker-example" class="form-control datepicker">
                          </div>

                          <!-- <div class="form-group col-md-6 col-12">
                            <input type="date" class="form-control" name="endDate" placeholder="Date de retour" />
                          </div> -->
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Prix</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Dt</span>
                          </div>
                          <input type="text" class="form-control" name="prix" aria-label="Amount (to the nearest dollar)">
                          <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                          </div>
                        </div>
                        <div class="invalid-feedback">
                          veuillez saisir votre destination
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-md-6 col-12">
                        <label>Autocars</label>
                        <select type="text" class="form-control" name="autocar">
                          <option value='0'>Tous les autocars disponibles</option>
                          @php
                          $autocar = \App\Models\Autocar::all();
                          @endphp
                          @foreach ($autocar as $autocar)

                          @if ($autocar->status == 'disponiblé')
                          <option value="{{$autocar->id}}">{{$autocar->Matricule}}</option>
                          @endif
                          @endforeach
                        </select>
                        <div class="invalid-feedback">
                          select votre autocars
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Photo</label>
                        <input type="file" class="form-control" name="photo[]" multiple>
                        <div class="invalid-feedback">
                          veuillez saisir la description
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Note important</label>
                      <textarea class="summernote" name="description" rows="5"></textarea>
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
                  <h5 class="modal-title" id="exampleModalLabel">Modifier un voyage</h5>
                  <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                  <a data-dismiss="modal" class=" btn btn-icon btn-light" aria-label="Close"><i class="fas fa-times"></i></a>
                  <!-- <span aria-hidden="true">&times;</span> -->
                  </button>
                </div>
                <form method="post" id="editForm" class="signup-form" enctype="multipart/form-data">




                  <div class="modal-body">

                    <div class="row">
                      <div class="form-group col-md-6 col-12">
                        <label>Type</label>
                        <select class="form-control" id="type" name="type">
                          <option value='0'>Voyages</option>
                          <option value="Voyages organisés">Voyages organisés</option>
                          <option value="carte">Voyage à la carte</option>
                          <option value="Circuit Sud">Circuit Sud</option>
                          <option value="Circuit Nord">Circuit Nord</option>
                          <option value="Croisière">Croisière</option>
                          <option value="séjour">Séjour</option>
                          <option value="عمرة">عمرة</option>
                        </select>
                        <div class="invalid-feedback">
                          select votre type de voyage
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Nombre des places</label>
                        <input type="text" class="form-control" id="nbplace" name="nbplace">
                        <div class="invalid-feedback">
                          veuillez saisir le nombre du place
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6 col-12">
                        <label>Ville de départ</label>
                        <select class="form-control" id="villeD" name="villeD">
                          <option value="Tunis">Tunis</option>
                        </select>
                        <div class="invalid-feedback">
                          veuillez choisir votre ville de depart
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>Destination</label>

                            <select class="form-control" id="depart" name="depart">
                              <option value="France" selected="selected">France </option>
                              <option value="Afrique_Centrale">Afrique_Centrale </option>
                              <option value="Afrique_du_sud">Afrique_du_Sud </option>
                              <option value="Algerie">Algerie </option>
                              <option value="Allemagne">Allemagne </option>
                              <option value="Arabie_Saoudite">Arabie_Saoudite </option>
                              <option value="Argentine">Argentine </option>
                              <option value="Australie">Australie </option>
                              <option value="Bahrein">Bahrein </option>
                              <option value="Belgique">Belgique </option>
                              <option value="Bresil">Bresil </option>
                              <option value="Bulgarie">Bulgarie </option>
                              <option value="Canada">Canada </option>
                              <option value="Canaries">Canaries </option>
                              <option value="Cap_vert">Cap_Vert </option>
                              <option value="Chili">Chili </option>
                              <option value="Chine">Chine </option>
                              <option value="Cote_d_Ivoire">Côte_d_Ivoire </option>
                              <option value="Danemark">Danemark </option>
                              <option value="Egypte">Egypte </option>
                              <option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option>
                              <option value="Espagne">Espagne </option>
                              <option value="Etats_Unis">Etats_Unis </option>
                              <option value="Ethiopie">Ethiopie </option>
                              <option value="France">France </option>
                              <option value="Grece">Grece </option>
                              <option value="Hawaii">Hawaii </option>
                              <option value="Hong_Kong">Hong_Kong </option>
                              <option value="Irlande">Irlande </option>
                              <option value="Islande">Islande </option>
                              <option value="Italie">italie </option>
                              <option value="Japon">Japon </option>
                              <option value="Jordanie">Jordanie </option>
                              <option value="Koweit">Koweit </option>
                              <option value="Luxembourg">Luxembourg </option>
                              <option value="Lybie">Lybie </option>
                              <option value="Malaisie">Malaisie </option>
                              <option value="Maldives">Maldives </option>
                              <option value="Maroc">Maroc </option>
                              <option value="Mexique">Mexique </option>
                              <option value="Norvege">Norvege </option>
                              <option value="Oman">Oman </option>
                              <option value="Palestine">Palestine </option>
                              <option value="Panama">Panama </option>
                              <option value="Portugal">Portugal </option>
                              <option value="Qatar">Qatar </option>
                              <option value="Russie">Russie </option>
                              <option value="Suisse">Suisse </option>
                              <option value="Thailande">Thailande </option>
                              <option value="Tunisie">Tunisie </option>
                              <option value="Turquie">Turquie </option>
                            </select>
                            <div class="invalid-feedback">
                              veuillez choisir votre destination
                            </div>
                          </div>
                          <div class="form-group col-md-6 col-12">
                            <label>Ville de arrivée</label>
                            <input type="text" class="form-control" id="retour" name="retour" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6 col-12">
                        <label>Periode</label>
                        <div class="row">
                          <!-- <div class="form-group col-md-6 col-12">
                            <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Date de départ" />
                          </div>
                          <div class="form-group col-md-6 col-12">
                            <input type="date" class="form-control" id="endDate" name="endDate" placeholder="Date de retour" />
                          </div> -->

                          <div class="md-form">
                          <input placeholder="Selected date" type="text" name="startDate" id="date-picker-example" class="form-control datepicker">
                          </div>

                          <div class="md-form">
                          <input placeholder="Selected date" type="text" name="endDate" id="date-picker-example" class="form-control datepicker">
                          </div>


                        </div>
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Prix</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Dt</span>
                          </div>
                          <input type="text" class="form-control" id="prix" name="prix" aria-label="Amount (to the nearest dollar)">
                          <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                          </div>
                        </div>
                        <div class="invalid-feedback">
                          veuillez saisir votre destination
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-md-6 col-12">
                        <label>Autocars</label>
                        <select type="text" class="form-control" id="autocar" name="autocar">
                          <option value='0'>Tous les autocars disponibles</option>
                          @php
                          $autocar = \App\Models\Autocar::all();
                          @endphp
                          @foreach ($autocar as $autocar)

                          @if ($autocar->status == 'disponiblé')
                          <option value="{{$autocar->id}}">{{$autocar->Matricule}}</option>
                          @endif
                          @endforeach
                        </select>
                        <div class="invalid-feedback">
                          select votre autocars
                        </div>
                      </div>
                      <div class="form-group col-md-6 col-12">
                        <label>Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo[]" multiple>
                        <div class="invalid-feedback">
                          veuillez saisir la description
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Note important</label>
                      <textarea class="summernote" id="description" name="description" ></textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="voyageId" id="voyageId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" id="modifier" class="btn btn-primary">Modifier</button>
                  </div>


                </form>
              </div>
            </div>
          </div>
          <!-- End Edit Model -->










          <div class="table-responsive">
            <!-- Button trigger modal -->
            <!-- <div align="right"> -->
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"> -->
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" title="Nouvel Voyage" data-target=".bd-example-modal-lg"><i class="fas fa-plus" style="font-size: smaller;"></i></button> -->
            <!-- </div> -->

            <div align="right">
              <div class="buttons"><b data-toggle="tooltip" data-original-title="Cliquez ici pour ajouter un voyage"><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus" style="font-size: smaller;"></i></button></b></div>
            </div>
            </br>

            {{-- <div class="section-title mt-0">text here </div> --}}
            <table id="voyages" class="table table-hover table-responsive-sm" style="width:100%">
              <thead>
                <tr>
                  <th class="me">id</th>
                  <th class="me">Type</th>
                  <th class="me">Ville de départ</th>
                  <th class="me">Destination</th>
                  <th class="me">Date de départ</th>
                  <th class="me">Date de retour</th>
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

<script>
  $(document).ready(function() {

    $('#voyages thead tr ').clone(true).appendTo('#voyages thead');
    $('#voyages thead tr:eq(0) th.me').each(function(i) {
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

    var table = $('#voyages').DataTable({
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
      "lengthMenu": [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "Tous"]
      ],
      "columnDefs": [{
        target: 1,
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

          let text = "Voyage Numero : " + id + " va être supprimé !";
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
                  url: '/voyage/destroy/' + id, // This is the url we gave in the route
                  data: {
                    'willDelete': willDelete
                  }, // a JSON object to send back
                  success: function(response) { // What to do if we succeed
                    console.log('done');
                  }
                });
                let text1 = "Voyage Numero : " + id + " est supprimé avec succès"
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
                  text: "vous avez annulé la suppression de cet voyage",
                  icon: "error",
                });
                console.log('cancel deleting');
              }
            });
        })


        $(document).ready(function() {
          // Update Data

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });


          $(document).ready(function() {
  $('.summernote').summernote('code');
});

          function getVoyage(id) {
            $.ajax({
              url: 'http://utecom.test/voyage/' + id,
              method: 'GET',
              success: function(data) {
                console.log(data.data);
                //$('#type option[value='+data.dat+').attr('selected','selected');

                $("#voyageId").val(data.data[0].id);
                $("#nbplace").val(data.data[0].NbPlace);
                $("#type").val(data.data[0].type).change();
                $("#villeD").val(data.data[0].villeD);
                $("#depart").val(data.data[0].depart).change();
                $("#retour").val(data.data[0].retour);
                $("#autocar_id").val(data.data[0].autocar_id);
                $("#prix").val(data.data[0].prix);
                $("#startDate").val(data.data[0].startDate);
                $("#endDate").val(data.data[0].endDate);
                $("#photo").val(data.data[0].photo);
                // $("#description").val(data.data[0].description);
                $('#description').summernote("code",data.data[0].description);
                console.log("code",data.data[0].description);



              }

            });
          }

          $('button[href="#myModal"]').on('click', function() {
            console.log("clicked");
            var id = $(this).val();
            getVoyage(id);
          });
          $('#editForm').on('submit', function(e) {
            e.preventDefault();

            var id = $('#voyageId').val();
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

        });

      },






      serverSide: true,
      processing: true,
      "ajax": {
        "url": window.location.href + '/allvoyages',
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
          data: 'type',
          name: 'type'
        },
        {
          data: 'villeD',
          name: 'villeD'
        },
        {
          data: 'depart',
          name: 'depart'
        },
        {
          data: 'startDate',
          name: 'startDate'
        },
        {
          data: 'endDate',
          name: 'endDate'
        },

        {
          "render": function(data, type, row, meta) {
            return ('<div class="btn-group"><a href="/voyages/' + row.id + '" class="btn btn-icon icon-left btn-primary"><i class="fas fa-eye"></i>Voir</a><button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button> <div class="dropdown-menu"  x-placement="bottom-start" style="position: absolute; top: 0px; left: 0px; will-change: transform; padding: 0px; width:0;"><div class="btn-group-vertical" style="width:100px;position: inherit;left: 51px;" role="group" aria-label="Basic example"><button href="#myModal" data-toggle="modal" class="dropdown-item btn btn-icon icon-left btn-info " id="' + row.id + '" value="' + row.id + '" ><i class="far fa-edit"></i> Modifier</button><button class="dropdown-item btn btn-icon icon-left btn-danger delete-row"  type="submit" value="' + row.id + '"><i class="far fa-trash-alt"></i> Supprimer</button></div></div></div></div>');
          },
        }

      ],
    });
  });
</script>
@endsection