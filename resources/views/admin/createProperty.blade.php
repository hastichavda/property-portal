@extends('layouts.app')
@extends('layouts.sidebar')

@section('content')
<div class="cont">
    <div class="container">
        <create-property :propertydata="{{ $property }}"/> 
    </div>
</div>
    
@endsection
<style>
.cont{
   margin-left: 5%;
}
</style>
