@extends('layouts.app')

@section('content')
    <div class="container">
        @if (isset($photo))
            <div>@getPhoto($photo->img)</div>
            <a href="{{ URL::previous() }}">Back</a>
        @endif
    </div>
@endsection