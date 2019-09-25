<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" sintegrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <!-- Styles -->
        <style>
            html, body {
                background: #fff;
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
            .imgcon
            {
                position: relative;
            }
            .btnimg
            {
                background: #333231;
                color: white;
                position: absolute;
                top: 15px;
                right: 16px;
                font-size: 18px;
                border-radius: 5px 5px;
                padding: 0 10px ;
                font-weight: bold;
            }
            .imgcontent
            {
                color: #3e3a36;
                font-size: 20px;
                font-weight: bold;
            }
            .colcolor:hover
            {
                background: #fff6e5;
            }
            .bodyback
            {
                background: #f5f5f5;
            }
            .card-img-top
            {
                width: 100%;
                height: 12vw;
                object-fit: cover;
            }
        </style>
    </head>
    <body class="bodyback">      
        @include('header')  
        <div class="row mt-4 ml-2">
            <div class="col-sm-3 mb-3">
                <div class="card">
                    <div class="card-header category">
                        <h4><strong>Property Type</strong></h4>
                    </div>
                    <div class="card-body">
                        @foreach ($types as $type)
                            <li class="list-group">
                                <a href="{{ action('PropertyController@filterProperty',$type->id ) }}" >
                                    {{$type->name}}
                                </a>
                            </li>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    @foreach ($properties as $property)
                    <div class="col-md-4">
                    <div class="card-deck ">
                        <div class="card colcolor"  style="height: 19rem;">
                            <div class="container mt-2">
                                <img src="{{ URL::asset($property->image) }}"  alt="" class="card-img-top"> 
                            </div>
                            <a href="{{ action('PropertyController@readMore',$property->id)}}" class="btnimg mt-1 mr-2">
                                <strong> For {{ $property->action }}</strong>
                            </a>
                            <div class="card-body">
                                <div class="imgcontent">
                                    {{ $property->title }} <br>
                                    $ {{ $property->price }}
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-5 text-center">
                    {{ $properties->links() }}
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
    </body>
</html>
