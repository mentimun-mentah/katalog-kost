@extends('layouts.app')
@section('content')
<detailkost :home="{{json_encode(url('/'))}}" :kost="{{$kost}}" :storage="{{json_encode(asset('storage/'))}}"></detailkost>
@endsection
