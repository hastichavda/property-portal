<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

@section('content')
    <nav class="navbar navbar-dark  navbar-expand-sm header">
        <a class="navbar-brand" href="#">
            <img src="{{url('/images/2.png')}}" alt="" width="30" height="30">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-2" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse menu" id="navbar-list-2">
            <ul class="navbar-nav">
                <li class="nav-item ">
                <a class=" menu-item" href="/"><i class="fa fa-home icon"></i>Home</a>
            </li>
            <li class="nav-item">
                <a class="menu-item" href="#"><i class="fa fa-user-plus icon"></i>About Us</a>
            </li>
            <li class="nav-item">
                <a class=" menu-item" href="#"><i class="fa fa-phone-square icon"></i>Contact</a>
            </li>
            @if (Route::has('login'))
                @auth
                <li class="nav-item">
                    <a href="{{ url('/home') }}">Home</a>
                </li>
                @else
                <li class="nav-item">
                    <a  class=" menu-item"  href="{{ route('login') }}"><i class="fa fa-sign-in icon"></i>Login</a>
                </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a  class=" menu-item" href="{{ route('register') }}"><i class="fa fa-user icon"></i>Register</a>
                        </li>
                    @endif
                @endauth
            @endif
        </ul>
       </div>
    </nav>
    <div class="row">
       @if(count($properties)> 0)
       @foreach ($properties as $property)
        <div class="col">
            <div class="card mt-2">
                <img src="{{ URL::asset($property->image) }}"  style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $property->title }}
                    </h5>
                    <h4 class="card-title">
                        {{ $property->action }}
                    </h4>
                    <p class="card-text"> 
                        {{ $property->description }}
                    </p>
                    <a href="{{ action('PropertyController@readMore',$property->id)}}" 
                    class="btn btn-primary">
                        <strong>$ {{ $property->price }}</strong>
                    </a>
                </div>
            </div>
        </div>   
        @endforeach
        @else
        <div class="sad mt-3">
            <div class="card mb-3 text-center">
                <img src="{{url('/images/sad.png')}}" alt="">
                <div class="card-footer">
                    <h1>No Property Yet</h1>
                </div>
            </div>
        </div>
        @endif
    </div>
<style>
    html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        .header1{
            background-image: url("{{ asset('/images/4.jpg') }}");
            height: 70vh;
            min-height: 500px;
        }
        .header{
            background: rgba(0,0,0,0.5);
            
        }
        .menu-item
        {
            color: white;
            padding: 0 5px 0 10px;
        }
        .icon
        {
            font-size:20px;
            padding-right:5px;
        }
        .menu{
            justify-content: flex-end;
        }
        .sad 
        {
            margin-left: auto;
            margin-right: auto;
        }
</style>