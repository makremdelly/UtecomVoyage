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
                  <th class="me" style="width: 40px;">#</th>
                  <th class="me">Client</th>
                  <th class="me">Email</th>
                  <th class="me">Hotel</th>
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
    $('#reservations thead tr ').clone(true).appendTo( '#reservations thead' );
       $('#reservations thead tr:eq(0) th.me').each( function (i) {
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
      var table = $('#reservations').DataTable( {
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
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tous"]],
       "columnDefs":
            [ {
               "targets": 6,
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
            "url": window.location.href+'/allreservations',
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
              { data: 'name', name: 'name'},
              { 
                "render": function (data, type, row, meta){
                 return ('<div class="buttons"><b data-toggle="tooltip" title="" data-original-title="'+moment(row.created_at).format('LL')+'">'+moment(row.created_at, "YYYYMMDD").fromNow()+'</b></div>');
                }
              },
              { data: 'amount', name:'amount'},
              {
                  "render": function (data, type, row, meta){ 
                   return('<a href="/hotels/'+row.hotel_id+'/reservation/'+row.id+'" class="btn btn-outline-primary get-meme" value="'+row.id+'">Détail</a>');
                  },
              }
          ],  
      });
  });
</script>
@endsection
