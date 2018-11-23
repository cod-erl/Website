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
        <th>Quantity</th>
        <th>Price</th>
        <th>Status</th>
        <th>Created On</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      
      @foreach($products as $product)
    
      <tr>
        <td>{{$product['id']}}</td>
        <td>{{$product['name']}}</td>
        <td>{{$product['quantity']}}</td>
        <td>{{$product['price']}}</td>
        <td><span class='label {{$product->status == true ? 'label-success' : 'label-danger'}}'>{{$product->status == true ? 'In Stock' : 'Out of Stock'}}</span></td>
        <td> {{\Carbon\Carbon::parse($product->created_at)->format('M j, Y')}}
        <td>
          <div class='col-md-6'>
            <form action="{{route('adminproducts.destroy', $product['id'])}}" method="post">
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