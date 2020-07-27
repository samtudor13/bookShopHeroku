@extends('layouts.app')

@section('content')

<html lang="en">
<head>
  <meta charset="UFT-8">
  <meta name="viewport" content="width-device-width, initial-scale-1.0">
  <meta http-equiv="X-UA-Compatible" content="ie-edge">
  <title>Book Store</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css')}}">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Edit Book</div>
          <div class="card-body">

            <div class="row">
              <div class="col-md-12">
                <!--displays any errors on submission-->
                @if (count ($errors)>0)
                <ul>
                  @foreach($errors->all() as $errors)
                  <li>
                    {{$error}}
                  </li>
                  @endforeach
                </ul>

                @endif

                <!--form to update datebase info-->
                <form method="post" action="{{action('BookController@update', $book->id)}}">
                  {{csrf_field()}}
                  {{ method_field('POST') }}
                  <input type="hidden" name="id" id="id" value="{{ $book->id }}"/>

                  <div class="form-group">
                    <input type="text" name="title" class="form-control" value="{{$book->title}}" placeholder="Enter title" />
                  </div>
                  <div class="form-group">
                    <input type="text" name="author" class="form-control" value="{{$book->author}}" placeholder="Enter author" />
                  </div>

                  <div class="form-group">
                    <input type="text" name="category" class="form-control" value="{{$book->category}}" placeholder="Enter category" />
                  </div>

                  <div class="form-group">
                    <input type="number" step="any" name="price" class="form-control" value="{{$book->price}}" placeholder="Price (in £'s')" />
                  </div>

                  <div class="form-group">
                    <input type="url" name="cover_pic" class="form-control" value="{{$book->cover_pic}}" placeholder="Cover Picture location/URL" />
                  </div>

                  <div class="form-group">
                    <input type="number" name="qty" class="form-control" value="{{$book->qty}}" placeholder="Quantity" />
                  </div>

                  <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Edit book details" />
                  </div>

                </Form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>













@endsection
