@extends('layouts.dash')
@section('content')

<link href="{{ asset('css/all.css') }}" rel="stylesheet" media="print" type="text/css">
<style type="text/css">
  @media print {
    html * {
      visibility: hidden;
    }

    head * {
      visibility: hidden;
    }

    .invoice * {
      visibility: visible;
    }

    .invoice {
      zoom: 147%;
      margin-top: -90px;
    }

    @page {
      margin-top: 0;
      /* this affects the margin in the printer settings */
      margin-bottom: 0;
    }

    /* div { border: 1px solid black;} */
  }
</style>

<!-- Main Content -->
<?php $count = count($pictures); ?>
<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-body">
          <div class="card">
            <div class="card-body">
              <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                @if ($count==0)
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100" src="../img/nohotel.jpg" alt="First slide" style="height:500px;">
                  </div>
                </div>
                @elseif($count==1)
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100 img-fluid" src="../storage/{{$voyage->id}}/{{$pictures[0]['file_name']}}" alt="First slide" style="height:500px;">
                  </div>
                </div>
                @elseif($count>1)
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100 img-fluid" src="../storage/{{$voyage->id}}/{{$pictures[0]['file_name']}}" alt="First slide" style="height:500px;">
                  </div>
                  @foreach (array_slice($pictures,1) as $pic)
                  <div class="carousel-item">
                    <img class="d-block w-100 img-fluid" src="../storage/{{$voyage->id}}/{{$pic['file_name']}}" alt="Second slide" style="height:500px;">
                  </div>
                  @endforeach
                </div>
                @endif
                @if ($count>1)
                <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
                @endif
              </div>
            </div>


            <hr>
            <div class="card-header">
              <h4>
                voyage
              </h4>
              <div class="card-header-action">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg">Voir tout</button>
                <!-- Start Add Model -->
                <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5></h5>
                        <div class="card-header-action">
                          <label>
                            <b class="btn btn-secondary">
                              <input type="checkbox" id="checkAll" class="d-none"><b data-toggle="tooltip" data-original-title="Tout sélectionner"><i class="fa fa-check"></i></b>
                            </b>
                          </label>
                          <b data-toggle="tooltip" data-original-title="Ajouter"><button type="button" class="btn btn-primary" data-toggle="modal" href="#myModal2"><i class="fas fa-plus"></i></button></b>
                          <!-- Start Add Model -->
                          <div class="modal" id="myModal2" data-backdrop="static">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title"></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form method="POST" action="{{ route('image.add' , $voyage->id) }}" class="dropzone" id="mydropzone" enctype="multipart/form-data">
                                    @csrf
                                    <div class="fallback">
                                      <input type="file" name="photo" multiple>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- End Add Model -->
                          <button type="button" value="{{$voyage->id}}" name="delete" id="delete" class="btn btn-danger delete" data-toggle="tooltip" data-original-title="Supprimer"><i class="far fa-trash-alt"></i></button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="form-group">
                          <div class="row gutters-sm">
                            <?php $count = count($pictures); ?>
                            @if ($count==0)
                            <div>
                              <label class="imagecheck mb-4">
                                <figure class="imagecheck-figure">
                                  <img src="../img/nohotel.jpg" alt="}" class="imagecheck-image">
                                </figure>
                              </label>
                            </div>
                            @elseif($count==1)
                            <div>
                              <label class="imagecheck mb-4">
                                <input name="imagecheck" type="checkbox" value="{{$pictures[0]['id']}}" class="imagecheck-input" />
                                <figure class="imagecheck-figure">
                                  <img src="../storage/{{$voyage->id}}/{{$pictures[0]['file_name']}}" alt="}" class="imagecheck-image" style="height:165px; Width: 165px">
                                </figure>
                              </label>
                            </div>
                            @else
                            @foreach ($pictures as $pic)
                            <div>
                              <label class="imagecheck">
                                <input type="checkbox" name="imagecheck-input[]" class="imagecheck-input" id="pas" value="{{$pic['id']}}" />

                                <figure class="imagecheck-figure">
                                  <img src="../storage/{{$voyage->id}}/{{$pic['file_name']}}" value="{{$pic['id']}}" alt="}" class="imagecheck-image" style="height:165px; Width: 165px">
                                </figure>
                              </label>
                            </div>
                            @endforeach
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Add Model -->
              </div>
            </div>









          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $('#myNavTabs a').click(function(evt) {
    evt.preventDefault();
    $(this).tab('show');
  });
  // print
  function printDiv(invoice) {
    var printContents = document.getElementById(invoice).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }


  $(document).on('click', '#delete', function(e) {
    var id = [];
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    swal({
        title: "Êtes-vous sûr ?",
        icon: "warning",
        buttons: ["Annuler", "Supprimer!"],
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $('.imagecheck-input:checked').each(function() {
            id.push($(this).val());
          });

          if (id.length > 0) {
            $.ajax({
              url: "{{ route('CheckImage.delete')}}",
              method: 'DELETE',
              data: {
                id: id,
                'willDelete': willDelete
              },
              success: function(data) {
                console.log('done');
                location.reload();
              }
            });
            swal({
              title: "Termié",
              icon: "success",
              timer: 4000,
              buttons: false,
              closeOnEsc: false,
              closeOnClickOutside: false,
            });
          } else {
            swal({
              title: "Veuillez cocher au moins une photo ",
              icon: "warning",
            });
            console.log('warning');
          }
        } else {
          e.preventDefault();
          swal({
            title: "ANNULÉ",
            text: "vous avez annulé la suppression de photo",
            icon: "error",
          });
          console.log('test');
        }
      });
  });

  $("#checkAll").click(function() {
    $('input:checkbox').not(this).prop('checked', this.checked);
  });
</script>



@endsection