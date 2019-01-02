@extends('layouts.app')

@section('content')
    <div class="container">
        @if (isset($photo))
            <div class="col-12">
                <div class="mb-3">@getPhoto($photo->img)</div>
                <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
            </div>
        @endif
    </div>
@endsection