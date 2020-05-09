@extends('layouts.dash')
@section('content')

<div class="container box">
    <div class="panel panel-default">
        <div class="panel-body">
            <form method="post" id="message">
                @csrf
                <div>
                    <input name="voyage" id="voyageid" value="{{$voyage[0]['id']}}" hidden>
                    <h1 style="font-family: inherit; font-size: x-large; color: #3586dc; text-align: center; padding-top: 15px;">Voyage N°{{$voyage[0]['id']}}: {{$voyage[0]['type']}}</h1>
                    <br>
                </div>
            </form>
            <div id="message"></div>

        </div>
    </div>
    <br>
    {{ csrf_field() }}
    <div id="summernote"></div>
    <br>
    <div style="text-align:center;margin-bottom:20px;">
        <button id="add" class="btn btn-primary btn-icon icon-left btn-xs prrrrr" style="cursor:grab;"> Enregistrer</button>
        <button id="edit" class="btn btn-primary btn-icon icon-left d-none btn-xs trrr" style="cursor:grab;"> Modifier</button>
        <!-- <button id="add" class="btn btn-success btn-xs prrrrr">add</button> -->
        <!-- <button id="edit" class="btn btn-success d-none btn-xs trrr">edit</button> -->
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#summernote').summernote();
        // var b=false;
        // $('.note-table').hide();
        // note color 
        // $('.note-color').find('.note-btn').click(function(){
        //     if (!b) {
        //         console.log('show');
        //         $('.note-color').find('.dropdown-menu').show();
        //         b = true;
        //     }else{
        //         console.log('hide');
        //         $('.note-color').find('.dropdown-menu').hide();
        //         b = false;
        //     }
        //     console.log('clicked',b);
        // });

        // note fontname 
        // $('.note-fontname').find('.note-btn').click(function(){
        //     if (!b) {
        //         console.log('show');
        //         $('.note-fontname').find('.dropdown-menu').attr('style','display: block !important');
        //         $('.note-fontname').find('.dropdown-menu').css('margin-top','310px');
        //         b = true;
        //     }else{
        //         console.log('hide');
        //         $('.note-fontname').find('.dropdown-menu').attr('style','display: none !important');
        //         b = false;
        //     }
        //     console.log('clicked',b);
        // });

        // note style 
        // $('.note-style').find('.note-btn').click(function(){
        //     if (!b) {
        //         console.log('show');
        //         $('.note-style').find('.dropdown-menu').attr('style','display: block !important');
        //         $('.note-style').find('.dropdown-menu').css('margin-top','310px');
        //         b = true;
        //     }else{
        //         console.log('hide');
        //         $('.note-style').find('.dropdown-menu').attr('style','display: none !important');
        //         b = false;
        //     }
        //     console.log('clicked',b);
        // });

        // note para 
        // $('.note-para').find('.note-btn').click(function(){
        //     if (!b) {
        //         console.log('show');
        //         $('.note-para').find('.dropdown-menu').attr('style','display: block !important');
        //         $('.note-para').find('.dropdown-menu').css('margin-top','310px');
        //         b = true;
        //     }else{
        //         console.log('hide');
        //         $('.note-para').find('.dropdown-menu').attr('style','display: none !important');
        //         b = false;
        //     }
        //     console.log('clicked',b);
        // });



        var voyage_id = $('#voyageid').val();
        var _token = $('input[name="_token"]').val();
        var programme_id;
        fetch_data();

        function fetch_data() {

            $.ajax({
                url: "/program/fetch_data",
                dataType: "json",
                data: {
                    voyage_id: voyage_id,
                    _token: _token
                },
                success: function(data) {
                    // var html = '';
                    // html += data[count].Programme;
                    // $('tbody').html(html);
                    console.log('done', data);
                    if (data.length > 0) {
                        programme_id = data[0].id;
                        console.log('here1');
                        $('#add').hide();
                        $('#edit').show();
                        $('#edit').removeClass('d-none');
                        $('#summernote').summernote("code", data[0].Programme);
                        console.log('programme_id', programme_id);
                    } else {
                        console.log('here2');
                        $('#add').show();
                        $('#edit').hide();
                        $('#summernote').summernote("code", '');
                    }

                }
            });
        }

        $(document).on('click', '#add', function(e) {
            var programme = $("#summernote").summernote('code');
            var voyage_id = $('#voyageid').val();


            if (programme != '' && voyage_id != '') {
                $.ajax({
                    url: "{{ route('programme.add_data') }}",
                    method: "POST",
                    data: {
                        programme: programme,
                        voyage_id: voyage_id,
                        _token: _token
                    },
                    success: function(data) {
                        // $('#message').html(data);
                        let text2 = "Bien ,votre programme est ajouté avec succes"
                        swal({
                            title: "Termié",
                            icon: "success",
                            text: text2,
                            timer: 4000,
                            buttons: false,
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                        });
                        setTimeout(function() {
                            window.location.href = "/voyages/" + voyage_id;
                        }, 3000);
                        fetch_data();
                    }
                });
            } else {
                // $('#message').html("<div class='alert alert-danger'>Both Fields are required</div>");
                 e.preventDefault();
                swal({
                    title: "Entrez votre programme",
                    icon: "error",
                });
                console.log('cancel deleting');
            }
        });

        $(document).on('click', '#edit', function(e) {
            var programme = $("#summernote").summernote('code');
            var voyage_id = $('#voyageid').val();

            if (programme != '') {
                $.ajax({
                    url: "{{ route('programme.update_data') }}",
                    method: "POST",
                    data: {
                        column_name: 'Programme',
                        column_value: programme,
                        id: programme_id,
                        _token: _token
                    },
                    success: function(data) {
                        let text2 = "Bien ,votre modification a été effectuée avec succès"
                        swal({
                            title: "Termié",
                            icon: "success",
                            text: text2,
                            timer: 4000,
                            buttons: false,
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                        });
                        setTimeout(function() {
                            window.location.href = "/voyages/" + voyage_id;
                        }, 3000);
                    }
                })
            } else {
                // $('#message').html("<div class='alert alert-danger'>Enter some value</div>");
                e.preventDefault();
                swal({
                    title: "Entrez votre programme",
                    icon: "error",
                });
                console.log('cancel deleting');
            }
        });


        // $(document).on('click', '.delete', function() {
        //     var id = $(this).attr("id");
        //     if (confirm("Are you sure you want to delete this records?")) {
        //         $.ajax({
        //             url: "{{ route('programme.delete_data') }}",
        //             method: "POST",
        //             data: {
        //                 id: id,
        //                 _token: _token
        //             },
        //             success: function(data) {
        //                 $('#message').html(data);
        //                 fetch_data();
        //             }
        //         });
        //     }
        // });


    });
</script>


@endsection