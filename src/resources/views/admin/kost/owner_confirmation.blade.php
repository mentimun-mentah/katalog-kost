@extends('admin.app')
@section('content')
<owner-confirmation :storage="{{json_encode(asset('storage/'))}}"></owner-confirmation>
@endsection
