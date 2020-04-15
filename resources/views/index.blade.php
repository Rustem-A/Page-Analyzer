@extends('layouts.app')

@section('form')
<form class="form-inline my-2 my-lg-0" action="{{route('domains.store')}}" method="POST">
@csrf
    <input class="form-control mr-sm-2" type="text" name="url" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>
@endsection