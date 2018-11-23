@extends('layouts.admin')

@section('content')
      <div class="container-fluid">
        <br />

       @include('partials._message')
    
     <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>County</th>
        <th>Location</th>
        <th>Joined On</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{$user['id']}}</td>
        <td>{{$user['name']}}</td>
        <td>{{$user['county']}}</td>
        <td>{{$user['location']}}</td>
        <td> {{\Carbon\Carbon::parse($user->created_at)->format('M j, Y')}}
        <td>
          <div class='col-md-6'>
            <form action="{{route('user.destroy', $user['id'])}}" method="post">
              @csrf
              @method('delete')
              <button class="btn btn-danger btn-sm " type="submit">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
@endsection