<div class="tab-pane" id="Programme">
            @if(count($programmes) > 0 )
            <div class="card-header">
              <h4>
              </h4>
              <div class="card-header-action">
                <a href="/programme/{{$voyage->id }}" id="IdVoyage" class="btn btn-icon btn-primary float-right" data-toggle="tooltip" data-original-title="Modifier"><i class="fas fa-edit"></i></a><br><br>
              </div>
            </div>
            <div class="card-body">
              <div class="invoice" id="printMe">
                <div class="invoice-print">
                  <div class="program-box">
                    @foreach ($programmes as $programme)
                    {!! $programme['Programme'] !!}
                  </div>
                </div>
              </div>
              <div style="text-align:center;margin-bottom:20px;">
                <button class="btn btn-warning btn-icon icon-left" style="cursor:grab;" onclick="printDiv('printMe')"><i class="fas fa-print"></i>Imprimer</button>
              </div>
              @endforeach
              @else
              <div class="text-center">
                <strong> <i class="fas fa-exclamation-triangle"></i> Aucune programe n'est associé</strong><br>
                <div class="breadcrumb-item active"><a href="/programme/{{$voyage->id }}"><i style="font-size: smaller;"></i><b>Cliquez ici pour ajouter un programme</b></a></div></br>
              </div>
              @endif
            </div>
          </div>