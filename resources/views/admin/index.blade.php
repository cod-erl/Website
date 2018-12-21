@extends('layouts.admin')

@section('content')
<div class="sidenav">
	<a href="https://mailtrap.io/inboxes/494396/messages/1010305500"><i class="glyphicon glyphicon-envelope">Mails</i></a>
	<a href="{{route('manage.sellers') }}"><i class="fas fa-user">Sellers</i></a>
	<a href="{{route('manage.buyers') }}"><i class="fas fa-user"></i>Buyers</a>
	<a href="{{route('manage.products') }}"><i class=""></i>Products</a>
</div>

@endsection