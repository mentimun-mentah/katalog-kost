@extends('account.sidenav')
@section('sidenav')
<change-kost :kost="{{$kost}}" :storage="{{json_encode(asset('storage/kosts/'))}}"></change-kost>
@endsection

