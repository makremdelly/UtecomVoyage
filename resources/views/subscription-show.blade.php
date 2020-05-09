@extends('layouts.dash')
@section('content')
	<!-- Main Content -->
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
<h1 style="font-family: inherit; font-size: x-large; color: #3586dc; text-align: center; padding-top: 15px;">Liste des factures</h1>
                <?php $size = sizeof($histories); ?>
                @for ($i = 0; $i < $size; $i++)
            <span class="badge badge-pill badge-light" style="border-radius: unset;">Facture N°: {{$histories[$i]['id']}}</span>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                            <th scope="col">Proprietaire</th>
                            <th scope="col">Hotel</th>
                            <th scope="col">Email</th>
                            <th scope="col">Dérnier paiement</th>
                            <th scope="col">Montant payé</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">{{$histories[$i]['user_name']}}</th>
                            <td>{{$histories[$i]['hotel_name']}}</td>
                            <td>{{$histories[$i]['user_email']}}</td>
                            <td>{{$histories[$i]['created_at']}}</td>
                            <td>{{$histories[$i]['amount']}}</td>
                            </tr>
                        </tbody>
                    </table>
                    @endfor
            </div>
        </div>
    </div>
</div>
@endsection













