@extends('layouts.login')
@section('content')
    <section class="section">
      <div class="container mt-5">
        <div class="page-error">
          <div class="page-inner">
            <h1>403</h1>
            <div class="page-description">
            	Vous n'avez pas accès à cette page.
            </div>
        <h5><a href="{{url()->previous()}}">retourner</a></h5>
          </div>
        </div>
      </div>
    </section>
  @endsection

