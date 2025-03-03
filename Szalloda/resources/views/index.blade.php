@extends('layout')

@section("css")
    <link rel="stylesheet" href="{{ asset("css/index.css") }}">
@endsection

@section('content')
    <div class="mainContent">
        <section>
            <h1>Szálloda oldal</h1>
            <div id="myCarousel" class="carousel slide center" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @foreach ($varos as $v)
                        @if ($v->city_id == 1)
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>           
                        @else
                            <li data-target="#myCarousel" data-slide-to={{$v->city_id-1}}></li>
                        @endif
                    @endforeach
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    @foreach ($varos as $v)
                        @if ($v->city_id == 1)
                        <div class="item active">
                        @else
                        <div class="item">
                        @endif
                        <a href="/telepules/{{$v->city_id}}">
                            <img src="https://placehold.co/600x400" alt="{{$v->cityName}}" title="{{$v->cityName}}">
                            <div class="carousel-caption">
                                <h3>{{$v->cityName}}</h3>
                                <p>{{$v->country}}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach
     

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>
        <section>
            <h2>Oldalról</h2>
            <hr>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget porta tellus. Vestibulum
                semper purus et vulputate sagittis. Fusce id malesuada ante. Nunc a libero nec urna tincidunt
                condimentum eget eu arcu. Cras lacinia sapien sit amet arcu placerat interdum. Praesent sed
                fringilla augue. Pellentesque et ex ut justo interdum commodo. Integer condimentum, magna et
                volutpat fermentum, justo orci interdum ante, et luctus nisl nisi vel justo. Quisque nunc diam,
                mollis at tincidunt id, faucibus et mauris. Etiam venenatis congue neque, sodales vestibulum augue
                tincidunt vel.

                Pellentesque mattis, tortor id aliquam semper, dui ex euismod dolor, in aliquet massa nunc ut neque.
                Nulla non est sed mauris mollis lobortis non dapibus tortor. Mauris nulla sem, fringilla in vehicula
                ut, dignissim quis nibh. Etiam a commodo lectus. In egestas nisl eget augue lacinia tempus. Proin eu
                diam finibus, vehicula leo non, facilisis dolor. Phasellus in eros ac velit suscipit pretium ut quis
                leo. Donec gravida, ante non molestie blandit, risus leo dictum massa, eget rutrum ligula ante et
                metus. Curabitur quis ullamcorper leo. Pellentesque id placerat tellus. Aenean porta mi nisl, vel
                pellentesque leo pulvinar vitae. Etiam ultrices risus vitae dapibus dignissim. Aenean vitae sapien
                convallis, pharetra enim at, cursus eros.

                Etiam lobortis ex et velit suscipit, eu ultricies erat bibendum. Integer varius massa et interdum
                fringilla. Etiam rutrum euismod risus, id tempor nisl rutrum sed. Quisque a sem auctor, egestas urna
                sed, faucibus nisi. Etiam pulvinar diam vel mauris volutpat facilisis. Phasellus luctus consequat
                sapien, a consequat augue tristique id. Aenean in euismod purus. Duis gravida dui a elit maximus
                aliquet. Ut placerat congue mi ut gravida. Maecenas euismod ut dui at condimentum. Nam laoreet erat
                et risus laoreet, vitae consequat est dignissim. Nunc feugiat gravida nulla in tincidunt.
            </p>
        </section>
        <section>
            <h2>Miért válasszon minket?</h2>
            <hr>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget porta tellus. Vestibulum
                semper purus et vulputate sagittis. Fusce id malesuada ante. Nunc a libero nec urna tincidunt
                condimentum eget eu arcu. Cras lacinia sapien sit amet arcu placerat interdum. Praesent sed
                fringilla augue. Pellentesque et ex ut justo interdum commodo. Integer condimentum, magna et
                volutpat fermentum, justo orci interdum ante, et luctus nisl nisi vel justo. Quisque nunc diam,
                mollis at tincidunt id, faucibus et mauris. Etiam venenatis congue neque, sodales vestibulum augue
                tincidunt vel.

                Pellentesque mattis, tortor id aliquam semper, dui ex euismod dolor, in aliquet massa nunc ut neque.
                Nulla non est sed mauris mollis lobortis non dapibus tortor. Mauris nulla sem, fringilla in vehicula
                ut, dignissim quis nibh. Etiam a commodo lectus. In egestas nisl eget augue lacinia tempus. Proin eu
                diam finibus, vehicula leo non, facilisis dolor. Phasellus in eros ac velit suscipit pretium ut quis
                leo. Donec gravida, ante non molestie blandit, risus leo dictum massa, eget rutrum ligula ante et
                metus. Curabitur quis ullamcorper leo. Pellentesque id placerat tellus. Aenean porta mi nisl, vel
                pellentesque leo pulvinar vitae. Etiam ultrices risus vitae dapibus dignissim. Aenean vitae sapien
                convallis, pharetra enim at, cursus eros.

                Etiam lobortis ex et velit suscipit, eu ultricies erat bibendum. Integer varius massa et interdum
                fringilla. Etiam rutrum euismod risus, id tempor nisl rutrum sed. Quisque a sem auctor, egestas urna
                sed, faucibus nisi. Etiam pulvinar diam vel mauris volutpat facilisis. Phasellus luctus consequat
                sapien, a consequat augue tristique id. Aenean in euismod purus. Duis gravida dui a elit maximus
                aliquet. Ut placerat congue mi ut gravida. Maecenas euismod ut dui at condimentum. Nam laoreet erat
                et risus laoreet, vitae consequat est dignissim. Nunc feugiat gravida nulla in tincidunt.
            </p>
        </section>
        <section>
            <h2>Miért válasszon minket?</h2>
            <hr>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget porta tellus. Vestibulum
                semper purus et vulputate sagittis. Fusce id malesuada ante. Nunc a libero nec urna tincidunt
                condimentum eget eu arcu. Cras lacinia sapien sit amet arcu placerat interdum. Praesent sed
                fringilla augue. Pellentesque et ex ut justo interdum commodo. Integer condimentum, magna et
                volutpat fermentum, justo orci interdum ante, et luctus nisl nisi vel justo. Quisque nunc diam,
                mollis at tincidunt id, faucibus et mauris. Etiam venenatis congue neque, sodales vestibulum augue
                tincidunt vel.

                Pellentesque mattis, tortor id aliquam semper, dui ex euismod dolor, in aliquet massa nunc ut neque.
                Nulla non est sed mauris mollis lobortis non dapibus tortor. Mauris nulla sem, fringilla in vehicula
                ut, dignissim quis nibh. Etiam a commodo lectus. In egestas nisl eget augue lacinia tempus. Proin eu
                diam finibus, vehicula leo non, facilisis dolor. Phasellus in eros ac velit suscipit pretium ut quis
                leo. Donec gravida, ante non molestie blandit, risus leo dictum massa, eget rutrum ligula ante et
                metus. Curabitur quis ullamcorper leo. Pellentesque id placerat tellus. Aenean porta mi nisl, vel
                pellentesque leo pulvinar vitae. Etiam ultrices risus vitae dapibus dignissim. Aenean vitae sapien
                convallis, pharetra enim at, cursus eros.

                Etiam lobortis ex et velit suscipit, eu ultricies erat bibendum. Integer varius massa et interdum
                fringilla. Etiam rutrum euismod risus, id tempor nisl rutrum sed. Quisque a sem auctor, egestas urna
                sed, faucibus nisi. Etiam pulvinar diam vel mauris volutpat facilisis. Phasellus luctus consequat
                sapien, a consequat augue tristique id. Aenean in euismod purus. Duis gravida dui a elit maximus
                aliquet. Ut placerat congue mi ut gravida. Maecenas euismod ut dui at condimentum. Nam laoreet erat
                et risus laoreet, vitae consequat est dignissim. Nunc feugiat gravida nulla in tincidunt.
            </p>
        </section>
    </div>
@endsection
