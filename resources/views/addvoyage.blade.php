@extends('layouts.dash')
@section('content')
<div class="row mt-sm-4">
  <div class="col-12 col-md-12 col-lg-10">
    <div class="card card-primary profile-widget">
      <div class="profile-widget-header">
        <form method="POST" action="{{ route('added.post.show') }}" id="signup-form" class="signup-form" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-6 col-12">
                <label>Type</label>
                <select type="text" class="form-control" id="type" name="type">
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
                <select type="text" class="form-control" id="villeD" name="villeD">
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
                  <div class="form-group col-md-6 col-12">
                    <input type="date" class="form-control" name="startDate" placeholder="Date de départ" />
                  </div>
                  <div class="form-group col-md-6 col-12">
                    <input type="date" class="form-control" name="endDate" placeholder="Date de retour" />
                  </div>
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
              <textarea class="form-control" name="description" rows="5"></textarea>
            </div>
          </div>

          <div class="card-footer text-right">
            <button class="btn btn-primary" type="submit">Enregistrer</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection