@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/ertekelesek.css') }}">
@endsection

@section('content')
    <div class="mainContent">
        <div class="filterBar">
            <ul>
                <li>Szűrés:</li>
                <li>
                    <select name="csillagok" id="csillagok">
                        <option value="1">1 csillag</option>
                        <option value="2">2 csillag</option>
                        <option value="3">3 csillag</option>
                        <option value="4">4 csillag</option>
                        <option value="5">5 csillag</option>
                    </select>
                </li>
                <li>
                    <select name="varos" id="varos">
                        <option value="Budapest">Budapest</option>
                        <option value="Nyíregyháza">Nyíregyháza</option>
                        <option value="Debrecen">Debrecen</option>
                    </select>
                </li>
                <li>
                    <select name="szalloda" id="szalloda">
                        <option value="ABCD">ABCD</option>
                        <option value="EFGH">EFGH</option>
                        <option value="IJKL">IJKL</option>
                    </select>
                </li>
            </ul>
        </div>
        <div class="ratingSection">
            <div class="rating">
                <div class="ratingUser">
                    <div class="profilePicture">
                        <img src="https://placehold.co/400" alt="profilkep" title="Profilkép" class="img-fluid">
                    </div>
                    <div class="data">
                        <div>
                            <p>Felhasználó</p>
                            <p>XY Szálloda</p>
                        </div>
                    </div>
                </div>
                <div>
                    <p><span class="starTicked">★★★★★</span> — Dátum</p>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Porro distinctio quasi pariatur
                        culpa! Tenetur animi omnis explicabo, facere tempore autem error necessitatibus, saepe dolor
                        corporis, quos fuga blanditiis voluptates magnam.
                    </p>
                </div>
            </div>
            <div class="rating">
                <div class="ratingUser">
                    <div class="profilePicture">
                        <img src="https://placehold.co/400" alt="profilkep" title="Profilkép" class="img-fluid">
                    </div>
                    <div class="data">
                        <div>
                            <p>Felhasználó</p>
                            <p>XY Szálloda</p>
                        </div>
                    </div>
                </div>
                <div>
                    <p><span class="starTicked">★</span><span class="starUnTicked">★★★★</span> — Dátum</p>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Porro distinctio quasi pariatur
                        culpa! Tenetur animi omnis explicabo, facere tempore autem error necessitatibus, saepe dolor
                        corporis, quos fuga blanditiis voluptates magnam.
                    </p>
                </div>
            </div>
            <div class="rating">
                <div class="ratingUser">
                    <div class="profilePicture">
                        <img src="https://placehold.co/400" alt="profilkep" title="Profilkép" class="img-fluid">
                    </div>
                    <div class="data">
                        <div>
                            <p>Felhasználó</p>
                            <p>XY Szálloda</p>
                        </div>
                    </div>
                </div>
                <div>
                    <p><span class="starTicked">★★★</span><span class="starUnTicked">★★</span> — Dátum</p>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Porro distinctio quasi pariatur
                        culpa! Tenetur animi omnis explicabo, facere tempore autem error necessitatibus, saepe dolor
                        corporis, quos fuga blanditiis voluptates magnam.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
