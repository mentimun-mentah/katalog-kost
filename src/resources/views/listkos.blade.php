@extends('layouts.app')
@section('content')
<list-kos :query="{{$query}}" :storage="{{json_encode(asset('storage/'))}}" :listkos="{{json_encode(url('/'))}}" :home="{{json_encode(url('/'))}}"></list-kos>
@endsection
