@extends('layouts.app')

@section('content')
<div class="row">

  {{-- Administrator menu --}}
  <div class="col-2">
    {{-- botones del admin --}}
    @auth
    @if (Auth::user()->admin or Auth::user()->main_admin)
    <div class="container">
      <div class="btn-group-vertical">
        <a class="btn btn-primary btn-lg" href="{{ route('users.create') }}">Create a new account</a>
        <a class="btn btn-primary btn-lg" href="{{ route('products.index') }}">Manage products</a>
      </div>

      <div class="page-header mt-4">
        <h1>Filter</h1>

        <form class="form-group" method="GET" action="{{route('users.index')}}">
          @csrf
          <small class="form-text text-muted">Search by name</small>
          <input type="text" class="form border" name="name" placeholder="Name ..." value="{{ request('name')}}">

          <small class="form-text text-muted">Search byemail</small>
          <input type="text" class="form border" name="email" placeholder="Email ..." value="{{ request('email')}}">

          {{-- <label class="form-check-label ml-4 mt-2">
            <input type="checkbox" class="form-check-input" name="admin">
            Search admin users
          </label>

          <label class="form-check-label ml-4 mt-2">
            <input type="checkbox" class="form-check-input" name="enabled">
            Search only disabled users
          </label> --}}

          <button type="submit" class="btn btn-primary btn btn-block mt-2">Search</button>
        </form>
      </div>

    </div>
    @endif
    @endauth
  </div>

  <div class="col-10 d-flex flex-column justify-content-center ">

    <div class="container">
      <h1 class="text-primary d-flex justify-content-center">Accounts Users</h1>
      <table class="table table-striped">
        <thead>
          <tr class="text-primary">
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>creation date</th>
            <th>Modification date</th>
            <th>Type</th>
            <th>State</th>
            <th style="display: flex; justify-content: center;">Set up</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <td scope="row">{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            <td> ...</td>
            <td>
              <button
                class=" justify-content-center btn-sm @if($user->admin) btn btn-outline-success @else btn btn-outline-secondary @endif "
                disabled>
                {{ $user->admin ? 'Admin' : 'User' }}
              </button>
            </td>
            <td>
              <button
                class=" justify-content-center btn-sm @if($user->enabled) btn btn-outline-success @else btn btn-outline-secondary @endif "
                disabled>
                {{ $user->enabled ? 'Enabled' : 'Disabled' }}
              </button>
            </td>
            <td>
              <div class="btn-group" style="display: flex; justify-content: center;">
                <form method="POST" action="{{ route('users.destroy', $user) }}">
                  @csrf
                  @method('DELETE')
                  <a href="{{ route('users.edit', $user) }}" type="button" class="btn btn-outline-info btn-sm">Edit</a>
                  <input type="submit" class="btn btn-outline-danger btn-sm" value="Remove">
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $users->render()}}
    </div>

  </div>
  @endsection