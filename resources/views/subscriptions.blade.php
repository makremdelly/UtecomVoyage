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
            <table id="subscriptions" class="table table-hover table-responsive-sm" style="width:100%">
              <thead>
                <tr>
                  <!-- <th class="me" style="width: 40px;">#</th> -->
                  <th class="me" id="notmee" style="width:130px;">Status</th>
                  <th class="me">Client</th>
                  <th class="me">Email</th>
                  <th class="me">Numéro de téléphone</th>
                  <th class="me">Date de réservation</th>
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



<!-- start-modal -->
<!-- <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> -->
<!-- <form method="post" action="{{ route('subscription.update', '+row.id+') }}" id="form1"> -->
<!-- <form method="post" id="editForm" class="signup-form" enctype="multipart/form-data">
          @method('PATCH')
          @csrf
          <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">Montant à payer</label>
            <div class="col-md-6">
              <input id="prix" type="text" class="form-control" name="prix" required>
            </div>
          </div>
          <div style="text-align:center;margin-bottom:20px;">
            <input type="hidden" name="Id" id="Id">
            <button type="submit" id="modifier" style="cursor:grab;" class="btn btn-warning btn-icon icon-left"><i class="fa fa-credit-card" aria-hidden="true"></i> Payer</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> -->

<!-- end-modal -->



<script>
  $(document).ready(function() {
    $('#subscriptions thead tr ').clone(true).appendTo('#subscriptions thead');
    $('#subscriptions thead tr:eq(0) th.me').each(function(i) {
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

    $('#subscriptions thead tr:eq(0) th#notmee.me ').html(`<select class="form-control" id="statut">
        <option value="">Tous</option>
        <option value !="Non payé" >Payé</option>
        <option value="Non payé">Non payé</option>
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
    var table = $('#subscriptions').DataTable({
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
      "aaSorting": [],
      "lengthMenu": [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "Tous"]
      ],
      "drawCallback": function(e, setting) {
        $("[data-toggle='tooltip']").tooltip();
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

      },
      "columnDefs": [{
        "targets": 5,
        "orderable": false,
        "searchable": false,
      }],
      "drawCallback": function(e, setting) {
        $("[data-toggle='tooltip']").tooltip();
        $('.brappelle').click(function(e) {
          e.preventDefault();
          let full = $(this).val();
          let email = full.substr(full.indexOf(',') + 1, full.indexOf('|') - 2);
          let name = full.substr(full.indexOf('|') + 1, full.length);
          let id = full.substr(0, full.indexOf(','));
          console.log(full);

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          var span = document.createElement("span");
          span.innerHTML =
            `
                  <div class="card-body">
                    <form method="POST">
                      <div class="form-group floating-addon">
                        <label>Email</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="fas fa-envelope"></i>
                            </div>
                          </div>
                          <input id="email" type="email" class="form-control" name="email" placeholder="` + email + `" disabled>
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Message</label>
                        <textarea class="summernote form-control tarea" placeholder="Tapez votre message" data-height="200" style="height: 200px !important;resize: none;" name="tareaa">TEST:Retard de paiement chére client ` + name + ` , merci de proceder au reglement de votre facture avant le 20/06/2019.
Cordinalement UtecomVoyages.
Contacter sur +216 99 455 055  
                        </textarea>
                        <small style="color: #3154a5;float: left;font-style: italic;padding-top: 5px;"> *vous pouvez modifier la lettre de rappel</small>
                      </div>
                    </form>
                  </div>  
                  `;
          swal({
              content: span,
              buttons: ["Annuler", "Envoyer!"],
              className: "modal-sizee",
              closeOnEsc: false,
              closeOnClickOutside: false,
            })
            .then((willSend) => {
              if (willSend) {
                let dataa = $('.tarea').val()
                $.ajax({
                  url: '/paiements/sendreminder/' + id,
                  data: {
                    mytext: dataa,
                    myemail: email
                  },
                  type: 'get',
                  success: function(response) {},
                });
                swal({
                  title: "Envoyé",
                  icon: "success",
                  text: 'Rappel envoyé avec succés',
                  timer: 1300,
                  buttons: false,
                  closeOnEsc: false,
                  closeOnClickOutside: false,
                });
              } else {
                e.preventDefault();
                swal({
                  title: "ANNULÉ",
                  text: "vous avez annulé le Rappel",
                  icon: "error",
                });
                console.log('cancel reminder');
              }
            });
        })



        function getReservation(id) {
          $.ajax({
            url: 'http://utecom.test/paiements/' + id,
            method: 'GET',
            success: function(data) {
              console.log(data.data);
              $("#Id").val(data.data[0].id);
              $("#prix").val(data.data[0].amount_a_payer);

            }

          });
        }

        // $('button[href="#myModal"]').on('click', function() {
        //   var id = $(this).val();
        //   getReservation(id);
        //   console.log(id);
        // });
        // $('#editForm').on('submit', function(e) {
        //   e.preventDefault();
        //   var id = $('#Id').val();
        //   console.log($('#editForm').serialize());
        //   // $('.activate').click(function (e){
        //   //   e.preventDefault();
        //   //   let id = $(this).val();
        //   $.ajaxSetup({
        //     headers: {
        //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        //   });
        //   $.ajax({
        //     method: 'put', // Type of response and matches what we said in the route
        //     url: '/subscriptions/activate/' + id, // This is the url we gave in the route
        //     data: $('#editForm').serialize(),


        //     success: function(response) {
        //       console.log()
        //       console.log(response);
        //       $('#myModal').modal('hide'); //close model
        //       setTimeout(function() {
        //         window.location = window.location
        //       }, 3000);
        //       let text2 = "Bien ,votre changement a été effectuée avec succès"
        //       swal({
        //         title: "Activé",
        //         text: "abonnement activé avec succès",
        //         icon: "success",
        //         timer: 1300,
        //         buttons: false,
        //         closeOnEsc: false,
        //         closeOnClickOutside: false,
        //       })
        //       // table.ajax.reload();
        //     },
        //     error: function(error, status) {
        //       console.log(error);
        //       console.log(status);
        //     }
        //   });
        // })





































































        $('button[href="#myModal"]').click(function(e) {
          e.preventDefault();
          var id = $(this).val();
          var amount_a_payer = $(this).val();
          getReservation(amount_a_payer);
          getReservation(id);
          console.log(id);


          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          var span = document.createElement("span");
          span.innerHTML =
            `
<div class="card-body">
<form method="post" id="editForm" class="signup-form" enctype="multipart/form-data">
          @method('PATCH')
          @csrf     
             <div class="form-group floating-addon">
            <label>Le montant à payer </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
                <input id="prix" type="text" class="form-control" name="prix" placeholder="` + amount_a_payer + `" required disabled>
            </div>
            <small style="color: #3154a5;float: left;font-style: italic;padding-top: 5px;"> *vous pouvez modifier Le montant à payer</small>

        </div>
    </form>
</div>
`;
          swal({
              content: span,
              buttons: ["Annuler", "Payer!"],
              className: "modal-sizee",
              closeOnEsc: false,
              closeOnClickOutside: false,
            })
            .then((willSend) => {
              if (willSend) {
                // let amount_a_payer = $('.amount_a_payer').val()
                let amount_a_payer = $("#prix").val();


                $.ajax({
                  method: 'put',
                  url: '/paiements/activate/' + id,
                  data: {
                    amount_a_payer: amount_a_payer
                  },
                  success: function(response) {
                    setTimeout(function() {
                      window.location = window.location
                    }, 1300);
                  },
                });
                swal({
                  title: "Envoyé",
                  icon: "success",
                  text: 'Paiement effectué avec succès',
                  timer: 1300,
                  buttons: false,
                  closeOnEsc: false,
                  closeOnClickOutside: false,
                });
              } else {
                e.preventDefault();
                swal({
                  title: "ANNULÉ",
                  text: "Vous avez annulé le paiement",
                  icon: "error",
                });
                console.log('cancel reminder');
              }
            });
        })











        $('button[href="#modal"]').click(function(e) {
          e.preventDefault();
          var id = $(this).val();
          var amount_a_payer = $(this).val();
          getReservation(amount_a_payer);
          getReservation(id);
          console.log(id);


          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          var span = document.createElement("span");
          span.innerHTML =
            `
<div class="card-body">
<form method="post" id="editForm" class="signup-form" enctype="multipart/form-data">
          @method('PATCH')
          @csrf     
             <div class="form-group floating-addon">
            <label>Le montant à payer </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
                <input id="prix" type="text" class="form-control" name="prix" placeholder="` + amount_a_payer + `" required>
            </div>
            <small style="color: #3154a5;float: left;font-style: italic;padding-top: 5px;"> *vous pouvez modifier Le montant à payer</small>

        </div>
    </form>
</div>
`;
          swal({
              content: span,
              buttons: ["Annuler", "Modifier!"],
              className: "modal-sizee",
              closeOnEsc: false,
              closeOnClickOutside: false,
            })
            .then((willSend) => {
              if (willSend) {
                // let amount_a_payer = $('.amount_a_payer').val()
                let amount_a_payer = $("#prix").val();


                $.ajax({
                  method: 'put',
                  url: '/paiements/activate/' + id,
                  data: {
                    amount_a_payer: amount_a_payer
                  },
                  success: function(response) {
                    setTimeout(function() {
                      window.location = window.location
                    }, 1300);
                  },
                });
                swal({
                  title: "Modifié",
                  icon: "success",
                  text: 'Bien ,votre modification a été effectuée avec succès',
                  timer: 1300,
                  buttons: false,
                  closeOnEsc: false,
                  closeOnClickOutside: false,
                });
              } else {
                e.preventDefault();
                swal({
                  title: "ANNULÉ",
                  text: "vous avez annulé la modification",
                  icon: "error",
                });
                console.log('cancel reminder');
              }
            });
        })





























        $('.print').click(function(e) {
          e.preventDefault();
          let id = $(this).val();
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            method: 'get', // Type of response and matches what we said in the route
            url: '/paiements/print/' + id, // This is the url we gave in the route
            success: function(data) {
              console.log(data)
              var newWin = window.open('', 'Print-Window');
              newWin.document.open();
              newWin.document.write(`
                    <html>
                    <body onload="window.print()">
                      <h1 style="text-align: center;padding-top: 200px; color: #3586dc;">Facture</h1>
                        <h3 style="text-align: center;">Proprietaire : ` + data.user_name + `</h3>
                        <h3 style="text-align: center;">Hotel : ` + data.hotel_name + `</h3>
                        <h3 style="text-align: center;">Email : ` + data.user_email + `</h3>
                        <h3 style="text-align: center;">Dérnier paiement : ` + data.created_at + `</h3>
                        <h3 style="text-align: center;">Methode de paiement : ` + data.payment_method + `</h3>
                        <h3 style="text-align: center;">Montant payé : ` + data.amount + `</h3>
                    </body>
                    </html>
                      `);
              newWin.document.close();
              setTimeout(function() {
                newWin.close();
              });
            },
          });

        })

      },
      serverSide: true,
      processing: true,
      "ajax": {
        "url": window.location.href + '/allsubscriptions',
        "type": "get",
        "dataType": "json",
        "dataSrc": "data",
        "headers": "Content-Type: application/json",
        "deferRender": true,
      },
      tooltip: true,
      autoheight: true,

      columns: [
        // { data: 'id', name: 'id' },
        {
          data: 'amount',
          name: 'amount',
          "render": function(data, type, row, meta) {

            if (row.amount == 'Non payé') {
              return ('<div class="badge badge-danger">Non payé</div>');
            } else {
              return ('<div class="badge badge-success">Payé</div>');
            }
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
        {
          data: 'phone',
          name: 'phone'
        },
        {
          "render": function(data, type, row, meta) {
            return ('<div class="buttons"><b data-toggle="tooltip" title="" data-original-title="' + moment(row.created_at).format('LL') + '">' + moment(row.created_at, "YYYYMMDD").fromNow() + '</b></div>');
          }
        },

        {
          "render": function(data, type, row, meta) {

            if (row.amount == 'Non payé') {
              // return ('<div class="badge badge-danger">Non payé</div>')


              return ('<div class="btn-group"><a href="/history/' + row.user_id + '" class="btn btn-icon icon-left btn-outline-primary"><i class="fas fa-eye"></i>Voir</a><button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="sr-only">Toggle Dropdown</span></button><div class="dropdown-menu"  x-placement="bottom-start" style="position: absolute; top: 0px; left: 0px; will-change: transform; padding: 0px; width:0;"><div class="btn-group-vertical" style="width:100px;position: inherit;left: 51px;" role="group" aria-label="Basic example"><button href="#myModal" class="dropdown-item btn btn-icon icon-left btn-success" data-toggle="modal" data-target=".bd-example-modal-lg" value="' + row.id + '"><i class="far fa-check-circle"></i> Activer</button><button class="dropdown-item btn btn-icon icon-left btn-warning brappelle"  value="' + row.id + ',' + row.user_email + '|' + row.user_name + '" ><i class="fas fa-stopwatch"></i> Rappel</button></div></div></div>');


            } else {
              // return ('<div class="btn-group"><a href="/history/' + row.user_id + '" class="btn btn-icon icon-left btn-outline-primary"><i class="fas fa-eye"></i>Voir</a><button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button><div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; top: 0px; left: 0px; will-change: transform; padding: 0px; width:0;"><button href="#modal" class="dropdown-item btn btn-icon icon-left btn-info" style="width:100px;position: inherit;left: 51px;" type="submit" style="cursor:grab;" value="' + row.id + '"><i class="fas fa-edit"></i> Éditer</button></div>');
              return('<a href="/history/' + row.user_id + '" class="btn btn-icon icon-left btn-outline-primary" style="width:100px;position: inherit;left: 51px;" value="'+row.id+'"><i class="fas fa-eye"></i>Voir</a>');

            }
          }
        },



      ],
    });
  });
</script>
@endsection