@extends('layouts.app')

@section ('urls')
<table class="table">
    <thead class="thead-light">
            <tr>
            <th scope="col">id</th>
            <th scope="col">URL</th>
            <th scope="col">Response Code</th>
            <th scope="col">content-length</th>
            <th scope="col">H1</th>
            <th scope="col">Keywords</th>
            <th scope="col">Description</th
            </tr>
        </thead>
    @foreach ($allUrls as $url)
        <tbody>
            <tr>
            <th scope="row">{{ $url->id }}</th>
            <td><a href="{{route('domains.show', $url->id)}}"> {{ $url->name }} </a></td>
            <td>{{ $url->responseCode }}</td>
            <td>{{ $url->contentLength }}</td>
            <td>{{ $url->h1 }}</td>
            <td>{{ $url->keywords }}</td>
            <td>{{ $url->description }}</td>
            </tr>
        </tbody>
@endforeach
</table>
{{ $allUrls->links() }}
@endsection