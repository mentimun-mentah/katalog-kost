@extends('admin.app')
@section('content')
<manage-owner :storage="{{json_encode(asset('storage/'))}}"></manage-owner>
@endsection

