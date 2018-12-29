@extends('layouts.app')

@section('content')
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br/>
        @endif

        <div class="row">
            <div class="col-md-8">
                <form method="post" action="{{ route('photo.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="img">Image:</label>
                        <br>
                        <input type="file" name="img" id="img">
                        <div class="text-muted">jpeg, jpg</div>
                    </div>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
@stop