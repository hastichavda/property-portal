@extends('layouts.app')
@extends('layouts.sidebar')

@section('content')
    <div class="cont">
        <div class="container">
            <display-property :display-data="{{ $properties }}"></display-property>
        </div>
    </div>
@endsection

<style>
.cont
{
    margin-left: 5%;
}
</style>