@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __(' Edit Product') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{route('products.update',$product->id)}}" enctype="multipart/form-data">
        @csrf
        @method('put')
        
  <div class="form-group row">
      <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Name') }}</label>
        
      <div class="col-md-6">
          <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name',$product->name) }}" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('name') }}</strong>
                 </span>
              @endif
          </div>
      </div>

  <div class="form-group row">
      <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>

          <div class="col-md-6">
              <input id="quantity" required value='{{old('quantity',$product->quantity)}}' type="number" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity">

                @if ($errors->has('quantity'))
                    <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('quantity') }}</strong>
                    </span>
                 @endif
              </div>
        </div>

  <div class="form-group row">
      <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price per unit') }}</label>

          <div class="col-md-6">
              <input id="price" type="number" value='{{ old('price',$product->price) }}' class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price">

                @if ($errors->has('price'))
                    <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('price') }}</strong>
                    </span>
                 @endif
              </div>
        </div>

        <div class="form-group row">
      <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Upload image(optional)') }}</label>

          <div class="col-md-6">
              <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image">

                @if ($errors->has('image'))
                    <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('image') }}</strong>
                    </span>
                 @endif
              </div>
        </div>

        <div class="form-group row">
            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Item Available') }}</label>
            <div class="col-md-6">
                <select id="image"  class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" required>
                    <option value=''>Select Status</option>
                    <option value = '1'>In Stock</option>
                    <option value='0'>Out of Stock</option>
                </select>
              </div>
        </div>

        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success">Edit Product</button>
          </div>
        </div>
      </form>
    </div>  
@endsection
    
    <script type="text/javascript">  
        $('#datepicker').datepicker({ 
            autoclose: true,   
            format: 'dd-mm-yyyy'  
         });  
    </script>
  </body>
</html>

