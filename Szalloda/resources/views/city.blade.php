@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/telepules.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <section>
            <h1>{{ $city->cityName }}</h1>
            <img src="{{ asset('img/cities/' . $city->city_id . '.jpg') }}" alt="szalloda_kep_0" title="Szálloda" class="szallodaMainImg img-fluid" width="600px" height="400px">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vehicula varius magna. Praesent
                consequat, eros vel iaculis efficitur, ante odio rutrum ex, eget finibus elit justo nec orci.
                Maecenas ultricies auctor lorem quis elementum. Aenean porttitor erat enim, vitae porta nunc
                pretium vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pretium diam
                quis felis mollis luctus. Nam rutrum tincidunt placerat. Orci varius natoque penatibus et magnis
                dis parturient montes, nascetur ridiculus mus.

                Cras in ex id tortor scelerisque finibus in et leo. Proin sit amet ligula fermentum, dapibus
                massa non, elementum felis. Curabitur sed efficitur felis. Integer laoreet et ex in placerat.
                Pellentesque ultrices bibendum efficitur. Aenean dolor erat, porta quis urna cursus, efficitur
                rutrum libero. Nullam imperdiet nulla in egestas gravida. Sed sagittis vitae lectus sed maximus.

                Aliquam erat volutpat. Nulla finibus, tortor id laoreet viverra, elit ante sollicitudin turpis,
                in imperdiet arcu tellus sit amet risus. Orci varius natoque penatibus et magnis dis parturient
                montes, nascetur ridiculus mus. Cras nisl ipsum, dapibus nec mauris non, egestas congue justo.
                Mauris dolor massa, condimentum eget sollicitudin ut, tincidunt vel nulla. Ut sit amet auctor
                nulla. Nullam posuere purus quam, ac dictum nunc semper at. Etiam et rhoncus nunc. Morbi sed
                purus in augue porta ultricies. Quisque ut viverra odio. Integer felis turpis, placerat in
                convallis eget, luctus placerat metus. Interdum et malesuada fames ac ante ipsum primis in
                faucibus. Vestibulum orci tortor, blandit nec pharetra a, bibendum id mi.
            </p>
        </section>
        <div class="citySection">
            @foreach ($hotels as $hotel)
                <div class="city">
                    <a href="/szalloda/{{ $hotel->hotel_id }}">
                        <h2>{{ $hotel->hotelName }}</h2>
                    </a>
                    <div class="cityImgContainer">
                        <a href="/szalloda/{{ $hotel->hotel_id }}">
                            <img src="https://placehold.co/400" alt="telepules" title="{{ $hotel->hotelName }}" class="img-fluid">
                        </a>
                        <p>
                            @if ($hotel->rating == '')
                                <p>Nincsenek értékelések.</p>
                            @else
                                <span class="starTicked">{{ str_repeat('★', $hotel->rating) }}</span><span class="starTicked">{{ str_repeat('⯪', ceil($hotel->rating - floor($hotel->rating))) }}</span><span class="starUnTicked">{{ str_repeat('★', 5 - ceil($hotel->rating)) }} - {{ $hotel->rating }}</span>
                            @endif
                        </p>
                    </div>
                    <table>
                        <tr>
                            <th>Cím:</th>
                            <td>{{ $hotel->address }}</td>
                        </tr>
                        <tr>
                            <th>Telefonszám:</th>
                            <td>{{ $hotel->phoneNumber }}</td>
                        </tr>
                        <tr>
                            <th>E-mail cím:</th>
                            <td>{{ $hotel->email }}</td>
                        </tr>
                    </table>
                    <hr>
                    <p style="float: none;">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vehicula varius magna. Praesent
                        consequat, eros vel iaculis efficitur, ante odio rutrum ex, eget finibus elit justo nec orci.
                        Maecenas ultricies auctor lorem quis elementum. Aenean porttitor erat enim, vitae porta nunc
                        pretium vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pretium diam
                        quis felis mollis luctus. Nam rutrum tincidunt placerat. Orci varius natoque penatibus et magnis
                        dis parturient montes, nascetur ridiculus mus.

                        Cras in ex id tortor scelerisque finibus in et leo. Proin sit amet ligula fermentum, dapibus
                        massa non, elementum felis. Curabitur sed efficitur felis. Integer laoreet et ex in placerat.
                        Pellentesque ultrices bibendum efficitur. Aenean dolor erat, porta quis urna cursus, efficitur
                        rutrum libero. Nullam imperdiet nulla in egestas gravida. Sed sagittis vitae lectus sed maximus.

                        Aliquam erat volutpat. Nulla finibus, tortor id laoreet viverra, elit ante sollicitudin turpis,
                        in imperdiet arcu tellus sit amet risus. Orci varius natoque penatibus et magnis dis parturient
                        montes, nascetur ridiculus mus. Cras nisl ipsum, dapibus nec mauris non, egestas congue justo.
                        Mauris dolor massa, condimentum eget sollicitudin ut, tincidunt vel nulla. Ut sit amet auctor
                        nulla. Nullam posuere purus quam, ac dictum nunc semper at. Etiam et rhoncus nunc. Morbi sed
                        purus in augue porta ultricies. Quisque ut viverra odio. Integer felis turpis, placerat in
                        convallis eget, luctus placerat metus. Interdum et malesuada fames ac ante ipsum primis in
                        faucibus. Vestibulum orci tortor, blandit nec pharetra a, bibendum id mi.
                    </p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
