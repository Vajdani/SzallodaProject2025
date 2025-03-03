@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bejelentkezes.css') }}">
    <script src="{{asset('js/script.js')}}"></script>
@endsection

@section('content')
    <div class="mainContent">
        <section>
            <h1>Értékelés írása</h1>
            <form action="/ertekeles" method="post" class="center">
                @csrf
                <label for="hotel">Melyik hotelünkhöz szeretne értékelést írni?</label>
                <br>
                <select name="hotel" id="hotel">
                    @foreach ($hotels as $hotel)
                        <option value="{{$hotel->hotel_id}}">{{$hotel->hotelName}}</option>
                    @endforeach
                </select>
                <br>
                <p>Értékelés</p>
                <p id="rating"><span onclick="reviewstar(1)">★</span><span onclick="reviewstar(2)">★</span><span onclick="reviewstar(3)">★</span><span onclick="reviewstar(4)">★</span><span onclick="reviewstar(5)">★</span></p>
                @error('star')
                    <p class="error">{{ $message }}</p>
                @enderror
                <input type="number" name="star" id="star" style="display: none">
                <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
                <input type="submit" value="Közzététel">
            </form>
        </section>
    </div>
@endsection
