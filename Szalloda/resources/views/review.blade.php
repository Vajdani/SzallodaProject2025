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
                <div style="margin-bottom:10px">
                    @isset($hotel)
                        <input type="text" name="hotel" id="hotel" value="{{$hotel->hotel_id}}" style="display:none">
                        <p class="text-center">{{$hotel->hotelName}} értékelése</p>
                    @else
                        <label for="hotel">Melyik hotelünkhöz szeretne értékelést írni?</label>
                        <br>
                        <select name="hotel" id="hotel">
                            @foreach ($hotels as $hotel)
                                <option value="{{$hotel->hotel_id}}">{{$hotel->hotelName}}</option>
                            @endforeach
                        </select>
                    @endisset
                </div>

                <p class="text-center" style="margin-bottom: 5px">Értékelés - <span id="rating"><span onclick="reviewstar(1)">★</span><span onclick="reviewstar(2)">★</span><span onclick="reviewstar(3)">★</span><span onclick="reviewstar(4)">★</span><span onclick="reviewstar(5)">★</span></span></p>

                @error('star')
                    <p class="error">{{ $message }}</p>
                @enderror
                <input type="number" name="star" id="star" style="display: none">
                <textarea name="comment" id="comment" cols="30" rows="10" maxlength="1000" class="w-100" style="margin-bottom: 10px">@if(old("comment")){{old("comment")}}@elseif(isset($review)){{$review->reviewText}}@endif</textarea>
                @error('comment')
                    <p class="error">{{ $message }}</p>
                @enderror
                <input type="submit" value="Közzététel" style="margin: 0">
            </form>
        </section>
    </div>

    @if($isModifying)
        <script>
            reviewstar(Number("{{ $review->rating }}"))
        </script>
    @endif
@endsection
