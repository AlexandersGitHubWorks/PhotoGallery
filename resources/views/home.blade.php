@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All Customers</div>
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (isset($users))
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Customer</th>
                                        <th>Link to the Gallery</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="align-middle">{{ $user->name }}</td>
                                        <td><a href="{{ route('user', ['id' => $user->id]) }}" class="btn btn-primary">View</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
