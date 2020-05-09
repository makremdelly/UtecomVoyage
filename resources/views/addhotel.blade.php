@extends('layouts.dash')
@section('content')


    <div class="main">

        <div class="container">
            <h2>Nouvel Hôtel </h2>
            <form method="POST" action="{{ route('add.post.show') }}" id="signup-form" class="signup-form" enctype="multipart/form-data">
            @csrf
                    <h3>
                        <span class="icon"><i class="fa fa-list-alt"></i></span>
                        <span class="title_text">Général</span>
                    </h3>
                    <fieldset>
                        <legend>
                            
                            <span class="step-number">Etape 1 / 4</span>
                        </legend>
                        <div class="form-group">
                            <label for="first_name" class="form-label required">Nom</label>
                            <input type="text" name="first_name" id="first_name" />
                        </div>


                        <div class="form-group">
                            <label for="first_name" class="form-label required">Etoiles</label>
                            <input type="text" name="star" id="first_name" />
                        </div>
                       

                        <div class="form-group">
                            <label for="user_name" class="form-label required">Téléphone</label>
                            <input type="tel" pattern="^\+?\s*(\d+\s?){8,}$" name="phone" id="phone"  required />

                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1" class="form-label required">Description de l'hotel</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1"  name="description" rows="3"></textarea>
                         </div>

                    </fieldset>

                    <h3>
                        <span class="icon"><i class="fa fa-map-marker"></i></span>
                        <span class="title_text">Localisation</span>
                    </h3>
                    <fieldset>
                    <div class="container">
                           <div class="dummy-container">
                              <div class="form-group" id="address-mini-form">
                              <input type="text" class="form-control autocomplete-address" id="delivery_address" />
                    </div>
                        
                    </fieldset>

                    <h3>
                        <span class="icon"><i class="fa fa-info-circle"></i></span>
                        <span class="title_text">Service</span>
                    </h3>
                    <fieldset>
                        <legend>
                            <span class="step-heading">Offical Informaltion: </span>
                            <span class="step-number">Etape 3 / 4</span>
                        </legend>
                       
                        <div class="form-group">
                            <label for="designation" class="form-label required">Designation</label>
                            <input type="text" name="designation" id="designation" />
                        </div>

                    </fieldset>

                    <h3>
                        <span class="icon"><i class="fa fa-images"></i></span>
                        <span class="title_text">Galerie</span>
                    </h3>
                    <fieldset>
                        <legend>
                            <span class="step-number">Etape 4 / 4</span>
                        </legend>
                    
                         <div>

                        <label for="title">Title</label>
            <input type="text" id="title" class="form-control" name="title">
        </div>

       
                        <input type="file" name="image"  multiple="multiple" class="form-control" id="picture">


                     

                    </fieldset>
                    
            </form>
        </div>

    </div>
  
 
@endsection