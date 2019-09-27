@extends('layouts.app')
@extends('layouts.sidebar')

@section('content')
    <div class="cont">
        <div class="container">
            <property-type :typedata="{{ $type }}"/>
        </div>
    </div>
@endsection
<style>
    .cont
    {
        margin-left: 5%;
    }
</style>