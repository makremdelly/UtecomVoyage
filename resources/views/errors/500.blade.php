@extends('layouts.login')
@section('content')
<section class="section">
    <div class="container mt-5">
      <div class="page-error">
        <div class="page-inner">
          <h1>500</h1>
          <div class="page-description">
            Oups, quelque chose s'est mal passé.
          </div>
          <h5><a href="{{url()->previous()}}">retourner</a></h5>
        </div>
      </div>
    </div>
  </section>
  @endsection

