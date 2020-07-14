@extends('layouts.dash')
@section('content')
<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
              <div class="card card-primary profile-widget shadow-lg p-1 mb-5 bg-white rounded">
                <div class="profile-widget-header">
                  <form method="post" action="{{ route('parametre.update', ['id' => $user->id])  }}" class="needs-validation" novalidate="" enctype="multipart/form-data">
                    @csrf
                    <?php $userpicval = Auth::user()->picture ?>
                    @if (empty($userpicval))
                    <div class="image-upload">
                      <label for="file-input" style="display:inline">
                        <img alt="image" src="img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture" style="cursor: pointer" data-toggle="tooltip" data-placement="right" title="" data-original-title="Cliquez pour modifier.">
                      </label>
                      <input type="file" name="picture" class="form-control {{ $errors->has('picture') ? ' is-invalid' : '' }}" style="display:none" id="file-input" value="{{ old('picture') }}">
                    </div>
                    @else
                    <div class="image-upload">
                      <label for="file-input" style="display:inline">
                        <img alt="image" src="storage/img/{{ Auth::user()->picture }}" class="rounded-circle profile-widget-picture" style="cursor: pointer" data-toggle="tooltip" data-placement="right" title="" data-original-title="Cliquez pour modifier.">
                      </label>
                      <input type="file" name="picture" class="form-control {{ $errors->has('picture') ? ' is-invalid' : '' }}" style="display:none" id="file-input" value="{{ old('picture') }}">
                    </div>
                    @endif
                    <div class="profile-widget-items">
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Totale Hotels</div>
                        <div class="profile-widget-item-value">{{$hotels}}</div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Totale Réservations</div>
                        <div class="profile-widget-item-value">{{$reservations}}</div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Totale Voyages</div>
                        <div class="profile-widget-item-value">{{$voyages}}</div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">
                          <span>
                            Totale Admin
                            <!-- <b data-toggle="tooltip" data-original-title="Cliquez ici pour afficher la liste des administrateurs"><a href="#" class="btn btn-sm btn-icon btn-light" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-caret-down" style="font-size: large;color:#dc3545;"></i></a></b> -->
                            <b data-toggle="tooltip" data-original-title="Cliquez ici pour afficher la liste des administrateurs"><a href="#footer" class="btn btn-sm btn-icon btn-light"><i class="fas fa-caret-down" style="font-size: large;color:#dc3545;"></i></a></b>
                          </span>
                        </div>
                        <div class="profile-widget-item-value">{{$admin}}
                        </div>
                      </div>
                    </div>
                    <div class="card-header">
                      <h4>Modifier Profile</h4>
                      @if ($errors->has('picture'))
                      <span style="color:red"> {{ $errors->first('picture') }} </span>
                      @endif
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group col-md-6 col-12">
                          <label>Nom</label>
                          <input type="text" class="form-control" value="{{ Auth::user()->name }}" required="" name="name">
                          <div class="invalid-feedback">
                            veuillez saisir votre nom
                          </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                          <label>Prénom</label>
                          <input type="text" class="form-control" value="{{ Auth::user()->last_name }}" name="last_name">
                          <div class="invalid-feedback">
                            veuillez saisir votre Prénom
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-6 col-12">
                          <label>Email</label>
                          <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email')  ?: Auth::user()->email }}" required="" name="email">
                          @if ($errors->has('email'))
                          <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                          </div>
                          @endif
                        </div>
                        <div class="form-group col-md-6 col-12">
                          <label>Ancien Mot de passe</label>
                          <input id="oldpassword" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" value="" name="password" placeholder="Ancien mot de passe">
                          <span toggle="#oldpassword" id="tog"></span>
                          @if ($errors->has('password'))
                          <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                          </div>
                          @endif
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-6 col-12">
                          <label>Nouveau Mot de passe</label>
                          <input id="newpassword" type="password" class="form-control {{ $errors->has('new_password') ? ' is-invalid' : '' }}" value="" name="new_password" placeholder="Nouveau mot de passe" disabled>
                          <span toggle="#newpassword" id="tog1"></span>
                          @if ($errors->has('new_password'))
                          <div class="invalid-feedback">
                            {{ $errors->first('new_password') }}
                          </div>
                          @endif
                        </div>
                        <div class="form-group col-md-6 col-12">
                          <label>Confirmez Nouveau Mot de passe</label>
                          <input id="confirmnewpassword" type="password" class="form-control {{ $errors->has('new_confirm_password') ? ' is-invalid' : '' }}" value="" name="new_password_confirmation" placeholder="confirmez Nouveau mot de passe" disabled>
                          <span toggle="#confirmnewpassword" id="tog2"></span>
                          @if ($errors->has('new_confirm_password'))
                          <div class="invalid-feedback">
                            {{ $errors->first('new_confirm_password') }}
                          </div>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary" type="submit">Enregistrer</button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="card shadow-lg p-1 mb-5 bg-white rounded" id="footer">
                <div class="table-responsive">
                  <div align="right">
                    <div class="buttons"><b data-toggle="tooltip" data-original-title="Cliquez ici pour ajouter un admin"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus" style="font-size: smaller;"></i></button></b></div>
                  </div>
                  </br>
                  <table id="admins" class="table table-hover table-responsive-sm" style="width:100%">
                    <thead>
                      <tr>
                        <th class="mee" style="width:75px;">Réf</th>
                        <th class="mee" style="width:100px;">Nom</th>
                        <th class="mee" style="width:100px;">Prénom</th>
                        <th class="mee">Email</th>
                        <th class="mee">Date d'inscription</th>
                        <th class="mee">Role</th>
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
  </div>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body alert-primary">
        <form method="POST" action="{{ route('add.admin') }}" id="signup-form" class="signup-form" enctype="multipart/form-data">
          @csrf
          <div class="login-brand image-upload">
            <label for="input" style="display:inline">
              <img src="img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture" alt="image" width="100" style="cursor: pointer" data-toggle="tooltip" data-placement="right" title="" data-original-title="Cliquez pour télécharger photo.">
            </label>
            <input type="file" name="image"  multiple="multiple" class="form-control" style="display:none" id="input">

          </div>
          <div class="form-group">
            <label>Nom</label>
            <div class="input-group">
              <!-- <input type="text" class="form-control" placeholder="Nom" name="name" required> -->
              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
              @if ($errors->has('name'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label>Prénom</label>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Prénom" name="last_name" required>
            </div>
          </div>
          <div class="form-group">
            <label>Email</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-envelope"></i>
                </div>
              </div>
              <!-- <input type="text" class="form-control" placeholder="Email" name="email" required> -->
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
              @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label>Mot de passe</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-lock"></i>
                </div>
              </div>
              <!-- <input type="password" class="form-control" placeholder="Mot de passe" name="password" required> -->
              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
              @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#admins thead tr ').clone(true).appendTo('#admins thead');
    $('#admins thead tr:eq(0) th.mee ').each(function(i) {
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
    var table = $('#admins').DataTable({
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
        target: 6,
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

          let text = "Admin Numero : " + id + " va être supprimé !";
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
                  url: '/parametre/destroy/' + id, // This is the url we gave in the route
                  data: {
                    'willDelete': willDelete,
                  }, // a JSON object to send back
                  success: function(response) { // What to do if we succeed
                    setTimeout(function() {
                      window.location = window.location
                    }, 500);
                    console.log('done');
                  }
                });
                let text1 = "Admin Numero : " + id + " est supprimé avec succès"
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
                  text: "vous avez annulé la suppression de cet admin",
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
        "url": 'http://utecom.test/parametres/alladmins',
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
          data: 'last_name',
          name: 'last_name'
        },
        {
          data: 'email',
          name: 'email'
        },
        {
          "render": function(data, type, row, meta) {
            return ('<div class="buttons"><b data-toggle="tooltip" title="" data-original-title="' + moment(row.created_at).format('LL') + '">' + moment(row.created_at, "YYYYMMDD").fromNow() + '</b></div>');
          }
        },

        {
          data: 'role_name',
          name: 'role_name',
          "render": function(data, type, row, meta) {
            switch (row.role_name) {
              case 'Administrator':
                return ('<div class="badge badge-success">Admin</div>');
                break;
              case 'Super-administrator':
                return ('<div class="badge badge-danger">Super-administrator</div>');
                break;
            }
          }
        },
        {
          "render": function(data, type, row, meta) {
            //  return('<a href="" class="btn btn-outline-danger delete-row" value="'+row.id+'">Supprimer</a>');
            return ('<form method="post" action="/parametre/destroy/' + row.id + '">{{ method_field('DELETE ') }}<input type="hidden" name="_token" value="{{ csrf_token() }}"><button class="btn btn-outline-danger delete-row" type="submit" value="' + row.id + '"> Supprimer</button></form>');

          },
        }
      ],
    });
  });
</script>
@endsection