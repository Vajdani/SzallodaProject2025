@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/szalloda.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <section>
            <h1>Szálloda neve</h1>
            <img src="https://placehold.co/600x400" alt="szalloda_kep_0" title="Szálloda" class="szallodaMainImg img-fluid">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem nemo consequuntur perferendis ducimus quam
                autem
                suscipit atque sit laudantium, ea harum delectus, cum cupiditate quos nihil. Atque cupiditate odit ullam.
            </p>
        </section>
        <section>
            <h2>Szállodáról</h2>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore a officia perspiciatis rem cumque iusto.
                Dolore expedita at, commodi nam voluptas architecto asperiores. Magnam perspiciatis facere quod
                voluptate molestiae accusantium.
            </p>
            <div class="szallodaImgGrid">
                <img src="https://placehold.co/600x400" alt="szalloda_kep_1" title="Szálloda 1.kép" class="img-fluid">
                <img src="https://placehold.co/600x400" alt="szalloda_kep_2" title="Szálloda 2.kép" class="img-fluid">
                <img src="https://placehold.co/600x400" alt="szalloda_kep_3" title="Szálloda 3.kép" class="img-fluid">
                <img src="https://placehold.co/600x400" alt="szalloda_kep_4" title="Szálloda 4.kép" class="img-fluid">
                <img src="https://placehold.co/600x400" alt="szalloda_kep_5" title="Szálloda 5.kép" class="img-fluid">
                <img src="https://placehold.co/600x400" alt="szalloda_kep_6" title="Szálloda 6.kép" class="img-fluid">
            </div>
        </section>
        <section>
            <h2>Városról</h2>
            <div class="varosGrid">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore a officia perspiciatis rem cumque iusto.
                    Dolore expedita at, commodi nam voluptas architecto asperiores. Magnam perspiciatis facere quod
                    voluptate molestiae accusantium.
                </p>
                <img src="https://placehold.co/600x400" alt="szalloda_kep_0" title="Szálloda" class="img-fluid">
            </div>
        </section>
    </div>
@endsection
