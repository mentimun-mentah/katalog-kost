@extends('account.sidenav')
@section('sidenav')
<my-kost :home="{{json_encode(url('/'))}}" :storage="{{json_encode(asset('storage/'))}}"></my-kost>
@endsection
