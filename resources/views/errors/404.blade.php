@extends('layouts.login')
@section('content')
<section class="section">
    <div class="container mt-5">
      <div class="page-error">
        <div class="page-inner">
          <h1>404</h1>
          <div class="page-description">
            La page que vous cherchiez est introuvable.
          </div>
          <h5><a href="{{url()->previous()}}">retourner</a></h5>
        </div>
      </div>
    </div>
  </section>
  @endsection

