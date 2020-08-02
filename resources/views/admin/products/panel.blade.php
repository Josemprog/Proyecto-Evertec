@extends('layouts.app')

@section('content')
<div class="row">

  <div class="col-2">
    <div class="container">
      {{-- Administrator menu --}}
      @auth
      @if (Auth::user()->admin or Auth::user()->main_admin)
      {{-- buttons --}}
      <div class="btn-group-vertical">
        <a class="btn btn-primary btn-lg" href="{{ route('products.create') }}">Create a new Product</a>
        <a class="btn btn-primary btn-lg" href="{{ route('products.index') }}">View products as user</a>
        <a class="btn btn-primary btn-lg" href="{{ route('users.index') }}">Manage Users</a>
      </div>
      @endif
      @endauth

      {{-- Filter form --}}
      <form class="form-group mt-3" method="GET" action="{{route('products.panel')}}">
        <h1>Filter</h1>
        <small class="form-text text-muted">Search by Brand</small>
        <input type="text" class="form border" name="brand" placeholder="Brand ...">

        <small class="form-text text-muted">Search by name</small>
        <input type="text" class="form border" name="name" placeholder="Name ...">

        <small class="form-text text-muted">Search by price</small>
        <input type="text" class="form border" name="unit_price" placeholder="Price ...">

        <button type="submit" class="btn btn-primary btn btn-block mt-2">Search</button>
      </form>
    </div>
  </div>

  <div class="col-10">

    <div class="container">
      <div class=" justify-content-center">
        <div class="col-md-10">
          <table class="table table-striped">
            <thead>
              <tr class="text-info">
                <th>Id</th>
                <th>Brand</th>
                <th>Name</th>
                <th>Unit price</th>
                <th>Quantity</th>
                <th>Creation date</th>
                <th>Modification date</th>
                <th>Set up</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
              <tr scope="row">
                <td>{{$product->id}}</td>
                <td>{{$product->brand}}</td>
                <td>{{$product->name}}</td>
                <td class="text-success">${{$product->unit_price}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->created_at}}</td>
                <td class="d-flex justify-content-center">...</td>
                <td>
                  <div class="btn-group">
                    <p><button class="btn btn-outline-primary">
                        <a href="{{ route('products.edit', $product) }}"><i class="fas fa-pencil-alt"></i></a>
                      </button></p>
                    <form method="POST" action="{{ route('products.destroy', $product) }}">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-outline-danger">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{-- Pagination --}}
          <div class=" d-flex justify-content-center">{{ $products->render()}}</div>
        </div>
      </div>
    </div>

    </>
    @endsection