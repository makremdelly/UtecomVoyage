@extends('layouts.dash')
@section('content')


<!-- Main Content -->
<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            {{-- <div class="section-title mt-0">text here </div> --}}
            <table id="reservations" class="table table-hover table-responsive-sm" style="width:100%">
              <thead>
                <tr>
                  <th class="me" id="notmee" style="width:90px;">Status</th>
                  <th class="me" style="width: 40px;">#</th>
                  <th class="me">Client</th>
                  <th class="me">Email</th>
                  <th class="me" id="notme_voy" style="width:90px;">Voyage</th>
                  <th class="me">Date de réservation</th>
                  <th class="me">Montant payé</th>
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
<script>
  $(document).ready(function() {
    $('#reservations thead tr ').clone(true).appendTo('#reservations thead');
    $('#reservations thead tr:eq(0) th.me').each(function(i) {
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

    $('#reservations thead tr:eq(0) th#notmee.me ').html(`<select class="form-control" id="statut">
        <option value="">Tous</option>
        <option value ="Acceptée" >Acceptée</option>
        <option value="Refusée">Refusée</option>
        <option value="En attente">En attente</option>
        <option value="En attente de paiement">En attente de paiement</option>
        <option value="Expirée">Expirée</option>
      </select>`);
    $('#statut').on('keyup change', function() {
      if (this.value == null) {
        table.clear();
      } else
      if (table.column(0).search() !== this.value) {
        table
          .column(0)
          .search(this.value)
          .draw();
        console.log(this.value);
      }
    });

    $('#reservations thead tr:eq(0) th#notme_voy.me ').html(`<select class="form-control" id="type">
        <option value="">Tous</option>
        <option value ="Voyages organisés" >Voyages organisés</option>
        <option value="carte">carte</option>
        <option value="Circuit Sud">Circuit Sud</option>
        <option value="Circuit Nord">Circuit Nord</option>
        <option value="Croisière">Croisière</option>
        <option value="séjour">séjour</option>
        <option value="عمرة">عمرة</option>
      </select>`);
    $('#type').on('keyup change', function() {
      if (this.value == null) {
        table.clear();
      } else
      if (table.column(4).search() !== this.value) {
        table
          .column(4)
          .search(this.value)
          .draw();
        console.log(this.value);
      }
    });

//BTN ACTIVATE
$('.activate').click(function (e){
                e.preventDefault();
                let id = $(this).val();
                $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                  });
                  $.ajax({
                    method: 'put', // Type of response and matches what we said in the route
                    url: '/reservations/activate/'+id,// This is the url we gave in the route
                  });
                swal({
                  title: "Activé",
                  text: "abonnement activé avec succès",
                  icon: "success",
                  timer: 1300,
                  buttons: false,
                  closeOnEsc: false,
                  closeOnClickOutside: false,
                })
                table.ajax.reload();
              })


    var table = $('#reservations').DataTable({
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
        "targets": 6,
        "orderable": false,
        "searchable": false,
      }],
      "drawCallback": function(e, setting) {
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
        "url": window.location.href + '/allreservations',
        "type": "get",
        "dataType": "json",
        "dataSrc": "data",
        "headers": "Content-Type: application/json",
        "deferRender": true,
      },
      tooltip: true,
      autoheight: true,

      columns: [{
          data: 'status',
          name: 'status',
          "render": function(data, type, row, meta) {
            switch (row.status) {
              case 'Refusée':
                return ('<div class="badge badge-danger">Refusée</div>');
                break;
              case 'Acceptée':
                return ('<div class="badge badge-success">Acceptée</div>');
                break;
              case 'En attente':
                return ('<div class="badge badge-warning">En attente</div>');
                break;
              case 'En attente de paiement':
                return ('<div class="badge badge-warning">En attente de paiement</div>');
                break;
              case 'Expirée':
                return ('<div class="badge badge-danger">Expirée</div>');
                break;
            }
          }
        },
        {
          data: 'res_id',
          name: 'res_id',
          "render": function(data, type, row, meta) {
                return ('<div class="text-primary" style="font-family: monospace;font-size: large;">Réf00'+ row.res_id +'</div>');
            }
        },
        {
          data: 'user_name',
          name: 'user_name'
        },
        {
          data: 'user_email',
          name: 'user_email'
        },
        // {
        //   data: 'voyage_type',
        //   name: 'voyage_type'
        // },
        {
          data: 'voyage_type',
          name: 'voyage_type',
          "render": function(data, type, row, meta) {
            switch (row.voyage_type) {
              case 'Voyages organisés':
                return ('Voyages organisés');
                break;
              case 'carte':
                return ('carte');
                break;
                case 'Circuit Sud':
                return ('Circuit Sud');
                break;
                case 'Circuit Nord':
                return ('Circuit Nord');
                break;
                case 'Croisière':
                return ('Croisière');
                break;
                case 'séjour':
                return ('séjour');
                break;
                case 'عمرة':
                return ('عمرة');
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
          "render": function(data, type, row, meta) {
            if (row.amount == null) {
              return ('Non payé');
            } else {
              return row.amount ;
            }
          }
        },
        // {
        //   "render": function(data, type, row, meta) {
        //     return ('<a href="/hotels/' + row.hotel_id + '/reservation/' + row.id + '" class="btn btn-outline-primary get-meme" value="' + row.id + '">Détails</a>');
        //   },
        // }
        {
          "render": function(data, type, row, meta) {
            switch (row.status) {
              case 'Acceptée':
                return ('<a href="/hotels/' + row.voyage_id + '/reservation/' + row.id + '" class="btn btn-outline-primary get-meme" value="' + row.id + '" style="width:90px;position: inherit;left: 51px;">Détails</a>');
                break;
              case 'Refusée':
                return ('<a href="/hotels/' + row.voyage_id + '/reservation/' + row.id + '" class="btn btn-outline-primary get-meme" value="' + row.id + '" style="width:90px;position: inherit;left: 51px;">Détails</a>');
                break;
              case 'En attente':
                return ('<div class="btn-group" style="width:80px;position: inherit;left: 51px;"><form method="post" action="/reservations/activate/' + row.id + '">@method('PATCH ')@csrf<div class="buttons"><b data-toggle="tooltip" data-original-title="Accepter la réservation"> <button  class="btn btn-outline-success activate" style="width:40px;position: inherit;left: 51px;" type="submit"><i class="fa fa-check" aria-hidden="true"></i></button></b></div></form><form method="post" action="/reservations/refuse/' + row.id + '">@method('PATCH ')@csrf<div class="buttons"><b data-toggle="tooltip" data-original-title="Refuser la réservation"><button class="btn btn-outline-danger" style="width:40px;position: inherit;left: 51px;" value="'+row.id+'"><i class="fa fa-times" aria-hidden="true"></i></button></b></div></form></div>');
                break;
                case 'En attente de paiement':
                  return ('<a href="/hotels/' + row.voyage_id + '/reservation/' + row.id + '" class="btn btn-outline-primary get-meme" value="' + row.id + '" style="width:90px;position: inherit;left: 51px;">Détails</a>');
                break;
                case 'Expirée':
                  return ('<a href="/hotels/' + row.voyage_id + '/reservation/' + row.id + '" class="btn btn-outline-primary get-meme" value="' + row.id + '" style="width:90px;position: inherit;left: 51px;">Détails</a>');
                break;
            }
          },
        }
      ],
    });
  });
</script>


@endsection