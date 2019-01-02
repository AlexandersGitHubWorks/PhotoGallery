@extends('layouts.app')

@section('content')

    {{--Template for displaying errors--}}
    @include('parts.errors')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Photo</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('photo.update', ['id' => $photo->id]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="img">Image:</label>
                                <br>
                                <input type="file" name="img" id="img">
                                <div class="text-muted">jpeg, jpg</div>
                            </div>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" value="{{ $photo->name }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" name="description"
                                          rows="4">{{ $photo->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop