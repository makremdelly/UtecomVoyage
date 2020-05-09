@extends('layouts.dash')
@section('content')
<div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-10">
        <div class="card card-primary profile-widget">
            <div class="profile-widget-header">
              <form method="post" action="{{ route('parametre.update', ['id' => $user->id])  }}" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf   
                <?php $userpicval=Auth::user()->picture ?>
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
                  <div class="profile-widget-item-label">Totale Visites</div>
                  <div class="profile-widget-item-value">0</div>
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
                        <input id="oldpassword" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" value="" name="password" placeholder="Ancien mot de passe" >
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
    </div>
</div>
@endsection
