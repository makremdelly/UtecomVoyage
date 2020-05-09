@extends('layouts.dash')
@section('content')
	<!-- Main Content -->
<div class="section-body">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
        <div class="breadcrumb-item active"><a href="/addautocar/"><i class="fas fa-plus" style="font-size: smaller;"></i><b>   Nouvel Autocar</b></a></div></br>
					<div class="table-responsive">
            {{-- <div class="section-title mt-0">text here </div> --}}
            <table id="autocars" class="table table-hover table-responsive-sm" style="width:100%">
              <thead>
                <tr>
                <th class="me" id="notmee" style="width:130px;">Status</th>
                  <th class="me" style="width:75px;">id</th>
                  <th class="me">type</th>
                  <th class="me">nbplace</th>
                  <th class="me">matricule</th>
                  <th class="me">voyage</th>
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

    $('#autocars thead tr ').clone(true).appendTo( '#autocars thead' );
       $('#autocars thead tr:eq(0) th.me').each( function (i) {
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

       $('#autocars thead tr:eq(0) th#notmee.me ').html(`<select class="form-control" id="statut">
        <option value="">Tous</option>
        <option value="disponiblé">Disponible</option>
        <option value="non disponible">Non disponible</option>
      </select>`);

      $( '#statut' ).on( 'keyup change', function () {
            if (this.value == null) {
             table.clear();
            } else 
               if ( table.column(0).search() !== this.value ) {
                   table
                      .column(0)
                      .search( this.value )
                      .draw();
               }

           } );

   
      var table = $('#autocars').DataTable( {
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
            target:1,
               "orderable":false,
               "searchable":false,
           } ],
          "drawCallback":function(e,setting){
             $("[data-toggle='tooltip']").tooltip();
             $('.delete-row').click(function (e){
                e.preventDefault();
                let id = $(this).val();
                let $tr = $(this).closest('tr');
             $.ajaxSetup({
               headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
             });
             
          let text ="Voyage Numero : " +id+" va être supprimé !";
                swal({
                  title: "Êtes-vous sûr ?",
                  text: text,
                  icon: "warning",
                  buttons:["Annuler", "Supprimer!"],
                  dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                  $tr.find('td').fadeOut(500,function(){ 
                            $tr.remove();                    
                        }); 
                  $.ajax({
                    method: 'DELETE', // Type of response and matches what we said in the route
                    url: '/voyage/destroy/'+id,// This is the url we gave in the route
                    data: {'willDelete' : willDelete}, // a JSON object to send back
                    success: function(response){ // What to do if we succeed
                        console.log('done');
                    }
                  });
                  let text1 ="Voyage Numero : " +id+" est supprimé avec succès"
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
            "url": window.location.href+'/allautocars',
            "type": "get",
            "dataType": "json",
            "dataSrc": "data",
            "headers": "Content-Type: application/json",
            "deferRender": true,
          },
          tooltip:true,
          autoheight:true,
          columns: [
            { data: 'status', name: 'status' ,
                "render":function(data,type,row,meta){
                  switch (row.status) {
                    case 'disponiblé':
                      return ('<div class="badge badge-success">Disponible</div>');
                      break;
                    case 'non disponible':
                      return ('<div class="badge badge-danger">Non disponible</div>');
                      break;
                   
                   
                  }
                }
               },
              { data: 'id', name: 'id'},
              {data:'type',name:'type'},
              {data:'NbPlace',name:'NbPlace'},
              {data:'Matricule',name:'Matricule'},
              {data:'titre',name:'titre',
                "render":function(data,type,row,meta){
                  if (row.voyage_id == null) {
                    return ('<div style="color:green;">pas de voyage</div>');
                  }else{
                    return ('<div style="color:#e60a0a;">'+row.depart+'</div>');
                  }
                }
               },


              {
                   "render": function (data, type, row, meta){ 
                    return ('<div class="btn-group"><a href="/autocar/'+row.id+'" class="btn btn-icon icon-left btn-primary"><i class="fas fa-eye"></i>Voir</a><button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button><form method="post" action="/voyage/destroy/'+row.id+'">{{ method_field('DELETE') }}<input type="hidden" name="_token" value="{{ csrf_token() }}"><div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; top: 0px; left: 0px; will-change: transform; padding: 0px; width:0;"><button class="dropdown-item btn btn-icon icon-left btn-danger delete-row" style="width:100px;position: inherit;left: 51px;" type="submit" value="'+row.id+'"><i class="far fa-trash-alt"></i> Supprimer</button></div></form></div>');
                   },
               }
             
          ],  
      });
  });
</script>
@endsection
