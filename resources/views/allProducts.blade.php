@extends('layouts.app')

@section('content')

<div class="container">

  @if(session()->has('success'))
      <div class="alert alert-success">
          {{ session()->get('success') }}
      </div>
  @endif

  <div class="row">
      <h1>EAPI Shop</h1>
  </div>

  <div class="row">

    @foreach($products as $product)

    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card h-100">
        <img class="card-img-top" id="image" src="{{$product[1]}}" alt="">
        <div class="card-body">
          <h5 class="card-title">
            {{$product[0]}}
          </h5>
          <br>
          <h5>$ {{$product[2]}}</h5> 
        </div>
        <div class="card-footer">
          <p class="btn-holder"><a href="{{ url('add-to-cart/'.$product[3]) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
        </div>
      </div>
    </div>

    @endforeach

  </div>

</div>

@endsection
