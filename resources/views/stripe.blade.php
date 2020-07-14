<!DOCTYPE html>
<html>

<head>
  <title>{{ config('app.name', 'UTECOM') }}</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>




  <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
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


  <script src="https://cdn.jsdelivr.net/npm/places.js@1.18.2"></script> -->








  <style type="text/css">
    .panel-title {
      display: inline;
      font-weight: bold;
    }

    .display-table {
      display: table;
    }

    .display-tr {
      display: table-row;
    }

    .display-td {
      display: table-cell;
      vertical-align: middle;
      width: 61%;
    }
  </style>
</head>

<body>



  <!-- <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Create New App</h4>
                  </div>
                  <div class="card-body">
                    <div class="row mt-4">
                      <div class="col-12 col-lg-8 offset-lg-2">
                        <div class="wizard-steps">
                          <div class="wizard-step wizard-step-active">
                            <div class="wizard-step-icon">
                              <i class="fas fa-info"></i>
                            </div>
                            <div class="wizard-step-label">
                              User Account
                            </div>
                          </div>
                          <div class="wizard-step">
                            <div class="wizard-step-icon">
                              <i class="fas fa-credit-card"></i>
                            </div>
                            <div class="wizard-step-label">
                              Create an App
                            </div>
                          </div>
                          <div class="wizard-step">
                            <div class="wizard-step-icon">
                              <i class="fas fa-server"></i>
                            </div>
                            <div class="wizard-step-label">
                              Server Information
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <form class="wizard-content mt-2">
                      <div class="wizard-pane">
                        <div class="form-group row align-items-center">
                          <label class="col-md-4 text-md-right text-left">Name</label>
                          <div class="col-lg-4 col-md-6">
                            <input type="text" name="name" class="form-control">
                          </div>
                        </div>
                        <div class="form-group row align-items-center">
                          <label class="col-md-4 text-md-right text-left">Email</label>
                          <div class="col-lg-4 col-md-6">
                            <input type="email" name="email" class="form-control">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-4 text-md-right text-left mt-2">Address</label>
                          <div class="col-lg-4 col-md-6">
                            <textarea class="form-control" name="address"></textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-4 text-md-right text-left mt-2">Role</label>
                          <div class="col-lg-4 col-md-6">
                            <div class="selectgroup w-100">
                              <label class="selectgroup-item">
                                <input type="radio" name="value" value="developer" class="selectgroup-input">
                                <span class="selectgroup-button">Developer</span>
                              </label>
                              <label class="selectgroup-item">
                                <input type="radio" name="value" value="ceo" class="selectgroup-input">
                                <span class="selectgroup-button">CEO</span>
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-4"></div>
                          <div class="col-lg-4 col-md-6">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                              <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-4"></div>
                          <div class="col-lg-4 col-md-6 text-right">
                            <a href="#" class="btn btn-icon icon-right btn-primary">Next <i class="fas fa-arrow-right"></i></a>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div> -->




























  <div class="container">

    <h1> <br /> </h1>

    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default credit-card-box">
          <div class="panel-heading display-table">
            <div class="row display-tr">
              <h3 class="panel-title display-td">Détails de paiement</h3>
              <div class="display-td">
                <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
              </div>
            </div>
          </div>
          <div class="panel-body">

            @if (Session::has('success'))
            <div class="alert alert-success text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
              <p>{{ Session::get('success') }}</p>
            </div>
            @endif

            <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
              @csrf

              <div class='form-row row'>
                <div class='col-xs-12 form-group required'>
                  <label class='control-label'>Nom sur la carte</label> <input class='form-control' size='4' type='text'>
                </div>
              </div>

              <div class='form-row row'>
                <div class='col-xs-12 form-group card required'>
                  <label class='control-label'>Numéro de carte</label> <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                </div>
              </div>

              <div class='form-row row'>
                <div class='col-xs-12 col-md-4 form-group cvc required'>
                  <label class='control-label'>CVC</label> <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                </div>
                <div class='col-xs-12 col-md-4 form-group expiration required'>
                  <label class='control-label'>Mois d'expiration</label> <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                </div>
                <div class='col-xs-12 col-md-4 form-group expiration required'>
                  <label class='control-label'>Année d'expiration</label> <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                </div>
              </div>

              <div class='form-row row'>
                <div class='col-md-12 error form-group hide'>
                  <div class='alert-danger alert'>Veuillez corriger les erreurs et essayer
                    encore.</div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-12">
                  <button class="btn btn-primary btn-lg btn-block" type="submit">Payez maintenant (100 $)</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

  </div>

</body>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
  $(function() {
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
      var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
          'input[type=text]', 'input[type=file]',
          'textarea'
        ].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
      $errorMessage.addClass('hide');

      $('.has-error').removeClass('has-error');
      $inputs.each(function(i, el) {
        var $input = $(el);
        if ($input.val() === '') {
          $input.parent().addClass('has-error');
          $errorMessage.removeClass('hide');
          e.preventDefault();
        }
      });

      if (!$form.data('cc-on-file')) {
        e.preventDefault();
        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
        Stripe.createToken({
          number: $('.card-number').val(),
          cvc: $('.card-cvc').val(),
          exp_month: $('.card-expiry-month').val(),
          exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
      }

    });

    function stripeResponseHandler(status, response) {
      if (response.error) {
        $('.error')
          .removeClass('hide')
          .find('.alert')
          .text(response.error.message);
      } else {
        // token contains id, last4, and card type
        var token = response['id'];
        // insert the token into the form so it gets submitted to the server
        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        $form.get(0).submit();
      }
    }

  });
</script>

</html>