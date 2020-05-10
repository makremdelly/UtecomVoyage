<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'UTECOM') }}</title>
    

    <!-- Scripts -->
    <script src="{{ asset('js/all.js') }}" defer></script>
    <script src="{{ asset('js/dropzone.js') }}" defer></script>

   
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- <link rel="stylesheet" href="/css/uploadimg.css"> -->
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">


    <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <!-- momentjs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/fr.js"></script>
    {{-- Chartjs --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.6.11/apexcharts.min.js"></script>
    {{-- summernote --}}
    {{-- print js  --}}
    {{-- <link rel="stylesheet" href="  https://printjs-4de6.kxcdn.com/print.min.css">

<!-- Main css -->

    <script src="  https://printjs-4de6.kxcdn.com/print.min.js"></script> --}}



  
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js" defer></script>
  


   
      
  

    <script>
        $(function() {
        
            var start = moment().subtract(29, 'days');
            var end = moment();
        
            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
        
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                   'Aujourd\'hui': [moment(), moment()],
                   'Hier': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Les 7 derniers jours': [moment().subtract(6, 'days'), moment()],
                   'Les 30 derniers jours': [moment().subtract(29, 'days'), moment()],
                   'Ce mois-ci': [moment().startOf('month'), moment().endOf('month')],
                   'Le mois dernier': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);
        
            cb(start, end);
        
        });
  </script>
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
  tinymce.init({
    selector: 'textarea#editor',
    skin: 'bootstrap',
    plugins: 'lists, link, image, media',
    toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
    menubar: false
  });
</script>

</head>
  <body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
              <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                  <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                  <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                </ul>
                {{-- <div class="search-element">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </div> --}}
              </form>
              <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                  <?php $userpicval=Auth::user()->picture ?>
                  @if (empty($userpicval))
                  <img alt="image" src="../../../../img/avatar/avatar-1.png" class="rounded-circle mr-1">
                  @else
                  <img alt="image" src="../../../../storage/img/{{ Auth::user()->picture }}" class="rounded-circle mr-1">
                  @endif
                  <div class="d-sm-none d-lg-inline-block">Bonjour {{ Auth::user()->name }}</div></a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">Votre Profile<a href="{{ url('parametre') }}"><i class="fas fa-user-edit float-right"></i></a></div>
                    <div class="dropdown-divider"></div>
                    <h6 class="text-center"><small class="font-weight-bold">Nom:</small> <span class="font-weight-light"> {{ Auth::user()->name }}</span></h6>
                    <h6 class="text-center"><small class="font-weight-bold">Prénom:</small> <span class="font-weight-light"> {{ Auth::user()->last_name }}</span></h6>
                    <h6 class="text-center"><small class="font-weight-bold">Email:</small> <span class="font-weight-light"> {{ Auth::user()->email }}</span></h6>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
                      <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                  </div>
                </li>
              </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                  <div class="sidebar-brand">
                    <a href="/">ADMIN Utecom</a>
                  </div>
                  <div class="sidebar-brand sidebar-brand-sm">
                    <a href="/">UTECOM</a>
                  </div>
                  <ul class="sidebar-menu">
                    
                    <li class="{{ Route::is('get.dashboard') ? 'active' : ''  }}">
                      <a href="{{ route('get.dashboard') }}" class="nav-link"><i class="fas fa-columns"></i><span>Tableau de bord</span></a>
                    </li>
                    <?php 
                    $r = parse_url(URL::previous());
                    $res = substr($r['path'], strrpos($r['path'], '/')+1);
                    ?>
                    
                    <li class="{{ (Route::is('hotels.index')) || (Route::is('hotel.show'))  || (Route::is('add.show'))  || (Route::is('reservation.show')  && !($res == "reservations")) ? 'active' : ''  }}">
                      <a href="{{ route('hotels.index') }}" class="nav-link"><i class="fas fa-hotel"></i><span>Hôtels</span></a>
                    </li>
                    
                    <li class="{{  (Route::is('room.show')) ? 'active' : ''  }}">
                      <a href="{{ route('room.show') }}" class="nav-link"><i class="fa fa-bed"></i><span>Chambres</span></a>
                    </li>


                    <li class="{{  (Route::is('voyage.show')|| (Route::is('voyage.edit'))|| (Route::is('programme.add')) || (Route::is('voyages.show'))  || (Route::is('addVoyage.show'))) ? 'active' : ''  }}">
                      <a href="{{ route('voyage.show') }}" class="nav-link"><i class="fa fa-plane"></i><span>Voyages</span></a>
                    </li>

                    <li class="{{  (Route::is('autocars.show') || (Route::is('addAutocar.show'))) ? 'active' : ''  }}">
                      <a href="{{ route('autocars.show') }}" class="nav-link"><i class="fa fa-bus"></i><span>Autocars</span></a>
                    </li>


                    <li class="{{ Route::is('reservation.index') || (Route::is('reservation.show') && ($res == "reservations")) ? 'active' : ''  }}">
                    <a href="{{ route('reservation.index') }}" class="nav-link"><i class="fas fa-check-double"></i><span>Réservations</span></a>
                    </li> 

                    <li class="{{ (Route::is('get.subscription')) || (Route::is('subscription.show')) ? 'active' : ''  }}">
                      <a href="{{ route('get.subscription') }}" class="nav-link"><i class="fas fa-money-bill"></i><span>Paiements</span></a>
                    </li>

                    <li class="{{ Route::is('get.setting') ? 'active' : ''  }}">
                      <a href="{{ url('parametre') }}" class="nav-link"><i class="far fa-user"></i><span>Paramètre</span></a>
                    </li>
                  </ul>
                  
                </aside>
              </div>
              <div class="main-content">
                  <section class="section">
                      <div class="section-header">
                        @if (Route::is('get.dashboard'))
                          <select class="form-control listhotels" style="width: 40%;">
                            <option value='0'>Tous les hôtels</option>
                            @php
                                $hotels = \App\Models\Hotel::all();
                            @endphp
                            @foreach ($hotels as $hotel)
                          <option value="{{$hotel->id}}">{{$hotel->name}}</option>
                            @endforeach
                          </select>
                            <h5 style="margin-left:25px;margin-top: auto;">Date :  </h5>
                            <div id="reportrange" style="cursor: pointer;width: 275px;margin-left:18px;" class="form-control">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>                            
                          @elseif (Route::is('get.setting'))
                          <h1>Paramètre</h1>
                        @elseif (Route::is('hotels.index'))
                          <h1>Liste des Hôtels</h1>
                          @elseif (Route::is('add.show'))
                          <h1>Nouveau Hotel</h1>

                          @elseif (Route::is('voyage.show'))
                          <h1>Liste des Voyages</h1>
                          @elseif (Route::is('autocars.show'))
                          <h1>Liste des Autocars</h1>
                          @elseif (Route::is('voyages.show'))
                          <h1>Voyage numero {{$voyage->id}}</h1> 
                          @elseif (Route::is('addVoyage.show'))
                          <h1>Nouvel voyage</h1> 
                           @elseif (Route::is('voyage.edit'))
                          <?php
                        $r3 = parse_url(URL::current());
                        $endofurl3 = substr($r3['path'], strrpos($r3['path'], '/')+1);
                        ?>
                          <h1> Modifier le voyage N°:{{$endofurl3}}</h1>

                        @elseif (Route::is('hotel.show'))
                          <h1>Hôtel numero {{$hotel->id}}</h1>  
                        @elseif (Route::is('reservation.show'))
                       
                        
                        <?php
                        $r = parse_url(URL::current());
                        $endofurl = substr($r['path'], strrpos($r['path'], '/')+1);
                        ?>
                          <h1>Réservation N°:{{$endofurl}} </h1>   
                        @elseif (Route::is('reservation.index'))
                          <h1>Liste des Réservations</h1>
                        @elseif (Route::is('get.subscription'))
                          <h1>Liste des Abonnement</h1>
                          @elseif (Route::is('subscription.show'))
                          <?php
                        $r1 = parse_url(URL::current());
                        $endofurl1 = substr($r1['path'], strrpos($r1['path'], '/')+1);
                        ?>
                          <h1> Historiques du client N°:{{$endofurl1}}</h1>
                          @elseif (Route::is('programme'))
                          <?php
                        $r2 = parse_url(URL::current());
                        $endofurl2 = substr($r2['path'], strrpos($r2['path'], '/')+1);
                        ?>
                          <h1>Programme de voyage N°:{{$endofurl2}}</h1>
                        @endif
                        <div class="section-header-breadcrumb">
                          @if (Route::is('get.dashboard'))
                            <div class="breadcrumb-item active"><a href="/">Tableau de bord</a></div>
                          @else
                            <div class="breadcrumb-item active"><a href="{{url()->previous()}}"><i class="fas fa-angle-double-left" style="font-size: smaller;"></i><b>  Retour</b></a></div> 
                          @endif
                        </div>
                      </div>
                  </section>
                <div class="section-body">
                  <main>
                    @yield('content')
                  </main>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                    @include('sweetalert::cdn')
                    @include('sweetalert::view')  
                  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                </div>
        </div>
        
    </div>
</body>
 
</html>