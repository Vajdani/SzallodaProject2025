@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bejelentkezes.css') }}">
    <script src="{{asset('js/reviewstar.js')}}"></script>
@endsection

@php
    $isModifying = isset($review);
@endphp

@section('content')
    <nav>
        <h1>Értékelés írása</h1>
    </nav>
    <div class="mainContent">
        <section>
            <form action="@if($isModifying){{"/ertekelesmodositas/$review->review_id"}}@else{{"/ertekeles"}}@endif" method="post" class="center">
                @csrf
                <label for="hotel">Melyik hotelünkhöz szeretne értékelést írni?</label>
                <br>
                @isset($hotel)
                    <input type="text" name="hotel" id="hotel" value="{{$hotel->hotel_id}}" style="display:none">
                    <p>{{$hotel->hotelName}}</p>
                @else
                    <select name="hotel" id="hotel">
                        @foreach ($hotels as $hotel)
                            <option value="{{$hotel->hotel_id}}">{{$hotel->hotelName}}</option>
                        @endforeach
                    </select>
                @endisset
                <br>
                <p>Értékelés</p>
                <p id="rating"><span onclick="reviewstar(1)">★</span><span onclick="reviewstar(2)">★</span><span onclick="reviewstar(3)">★</span><span onclick="reviewstar(4)">★</span><span onclick="reviewstar(5)">★</span></p>
                @error('star')
                    <p class="error">{{ $message }}</p>
                @enderror
                <input type="number" name="star" id="star" style="display: none">
                <textarea name="comment" id="comment" cols="30" rows="10" maxlength="1000">@if(old("comment")){{old("comment")}}@elseif(isset($review)){{$review->reviewText}}@endif</textarea>
                @error('comment')
                    <p class="error">{{ $message }}</p>
                @enderror
                <input type="submit" value="Közzététel">
            </form>
        </section>
    </div>

    @if($isModifying)
        <script>
            reviewstar(Number("{{ $review->rating }}"))
        </script>
    @endif
@endsection
