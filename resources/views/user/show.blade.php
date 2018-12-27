@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (isset($user))

            <h3>{{ Auth::user()->id == $user->id ? 'Your Gallery' : $user->name . ' Gallery' }}</h3>

            @if ($user->photos->isEmpty())
                <div class="alert alert-warning" role="alert">
                    No uploaded images.
                </div>
            @else
                @foreach($user->photos as $photo)
                    <div>{{ $photo->img }}</div>
                    <div>{{ $photo->name }}</div>
                    <div>{{ $photo->description }}</div>
                    <div><a href="{{ route('photo.show', ['id'=> $photo->id]) }}">View Original</a></div>
                    @if (Auth::user()->id == $user->id)
                        <div><a class="btn btn-primary" href="{{ route('photo.edit', ['id'=> $photo->id]) }}">Update</a></div>
                        <div>
                            <form action="{{ route('photo.destroy', ['id'=> $photo->id]) }}" method="post">
                                @csrf
                                <input name="_method" type="hidden" value="delete">
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    @endif
                    <br>
                @endforeach
            @endif
        @endif
    </div>
@endsection