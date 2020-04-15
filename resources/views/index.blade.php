@extends('layouts.app')
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@section('form')
<form class="form-inline my-2 my-lg-0" action="{{route('domains.store')}}" method="POST">
@csrf
    <input class="form-control mr-sm-2" type="text" name="url" placeholder="http://example.com" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">@lang('navbar.submit')</button>
</form>
@endsection