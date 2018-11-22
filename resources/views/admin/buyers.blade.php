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
        <th>sttaus</th>
        <th>Price</th>
        <th>Status</th>
        <th>Created On</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
  </div>
@endsection