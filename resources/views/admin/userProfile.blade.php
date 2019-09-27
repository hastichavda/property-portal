@extends('layouts.app')
@extends('layouts.sidebar')

@section('content')
    <table class="container table table-striped col-sm-4">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>       
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
