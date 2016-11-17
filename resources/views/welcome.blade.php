@extends('app')

@section('content')

    <div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
      <ul class="orbit-container">
        <button class="orbit-previous" aria-label="previous"><span class="show-for-sr">Previous Slide</span>&#9664;</button>
        <button class="orbit-next" aria-label="next"><span class="show-for-sr">Next Slide</span>&#9654;</button>
        <li class="orbit-slide is-active">
          <img src="http://placehold.it/2000x750">
        </li>
        <li class="orbit-slide">
          <img src="http://placehold.it/2000x750">
        </li>
        <li class="orbit-slide">
          <img src="http://placehold.it/2000x750">
        </li>
        <li class="orbit-slide">
          <img src="http://placehold.it/2000x750">
        </li>
      </ul>
    </div>

    <div class="row column text-center">
      <h2>Our Newest Products</h2>
      <hr>
    </div>

    <div class="row small-up-2 large-up-4">
      <div class="column">
        <img class="thumbnail" src="http://placehold.it/300x400">
        <h5>Nulla At Nulla Justo, Eget</h5>
        <p>$400</p>
        <a href="#" class="button expanded">Buy</a>
      </div>
      <div class="column">
        <img class="thumbnail" src="http://placehold.it/300x400">
        <h5>Nulla At Nulla Justo, Eget</h5>
        <p>$400</p>
        <a href="#" class="button expanded">Buy</a>
      </div>
      <div class="column">
        <img class="thumbnail" src="http://placehold.it/300x400">
        <h5>Nulla At Nulla Justo, Eget</h5>
        <p>$400</p>
        <a href="#" class="button expanded">Buy</a>
      </div>
      <div class="column">
        <img class="thumbnail" src="http://placehold.it/300x400">
        <h5>Nulla At Nulla Justo, Eget</h5>
        <p>$400</p>
        <a href="#" class="button expanded">Buy</a>
      </div>
    </div>

    <hr>
@endsection 
 
