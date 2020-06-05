@extends('layouts.dash')
@section('content')

  <div class="container">    
     <br />
     <h3 align="center">NOUVEL AUTOCAR</h3>
     <br />
   <div class="table-responsive">
                <form method="post" id="dynamic_form" >
                @csrf
                 <span id="result"></span>
                 <table class="table table-bordered table-striped" id="user_table">
               <thead>
                <tr>
                    <th width="20%">Type</th>
                    <th width="15%">Nombre de place</th>
                    <th width="55%">Matricule</th>
                    <th width="10%">Action</th>
                </tr>
               </thead>
               <tbody>

               </tbody>
               <tfoot>
                <tr>
                    <td colspan="3" align="right">&nbsp;</td>
                    <td>
                  @csrf
                  <input type="submit" name="save" id="save" class="btn btn-primary" value="Enregistrer" />
                 </td>
                </tr>
               </tfoot>
           </table>
                </form>
   </div>
  </div>
 
<script>
$(document).ready(function(){
    
 var count = 1;

 dynamic_field(count);

 function dynamic_field(number)
 {
  html = '<tr>';
        html += '<td><input type="text" name="type[]" class="form-control" /></td>';
        html += '<td><input type="text" name="nbplace[]" class="form-control" /></td>';
        html += '<td><input type="text" name="matricule[]" class="form-control" /></td>';
        if(number > 1)
        {
            html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Supprimer</button></td></tr>';
            $('tbody').append(html);
        }
        else
        {   
            html += '<td><button type="button" name="add" id="add" class="btn btn-success">Ajouter</button></td></tr>';
            $('tbody').html(html);
        }
 }

 $(document).on('click', '#add', function(){
  count++;
  dynamic_field(count);
 });

 $(document).on('click', '.remove', function(){
  count--;
  $(this).closest("tr").remove();
 });
 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
 $('#dynamic_form').on('submit', function(event){
        event.preventDefault();
       
        $.ajax({
            url:'{{route('addA.post.show') }}',
            method:'post',
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function(){
                $('#save').attr('disabled','disabled');
            },
            success:function(data)
            {
                if(data.error)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<p>'+data.error[count]+'</p>';
                    }
                    swal({
              title: "veuillez renseigner tous les champs",
              icon: "warning",
            });
            console.log('warning');                }
                else{
                setTimeout(function() {
                  window.location.href= "/autocars";
                }, 3000);
                let text2 = "Bien ,votre autocar a été ajouté avec succès"
                swal({
                  title: "Termié",
                  icon: "success",
                  text: text2,
                  timer: 4000,
                  buttons: false,
                  closeOnEsc: false,
                  closeOnClickOutside: false,
                });
            }}
        })
 });

});
</script>


@endsection
