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
          <!--adds user name and welcome msg to top of container-->
          <div class="card-header">Welcome {{{ Auth::user()->name }}} (ADMIN) <hr /> Add New Book</div>
          <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif
            <!--if errors are encountered, displayed to user above form-->
            @if(count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                <li>
                  {{$error}}
                </li>
                @endforeach
              </ul>
            </div>
            @endif

            <!--display success message if books create is successful-->
            @if(\Session::has('success'))
            <div class="alert alert-success">
              <p>
                {{\Session::get('success')}}
              </p>
            </div>
            @endif
            <!--form to add book to database-->
            <form method="post" action="{{url('admin')}}">
              {{csrf_field()}}
              <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Enter Title"  />
              </div>
              <div class="form-group">
                <input type="text" name="author" class="form-control" placeholder="Enter Author"  />
              </div>
              <div class="form-group">
                <input type="text" name="category" class="form-control" placeholder="Enter Category (Computing, Business or Languages)"  />
              </div>
              <div class="form-group">
                <input type="number" step="any" name="price" class="form-control" placeholder="Price (in £'s')"  />
              </div>
              <div class="form-group">
                <input type="url" name="cover_pic" class="form-control" placeholder="Cover Picture location/URL"  />
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" />
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br />
    <!--new container for further admin functions-->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">View all orders</div>
            <div class="card-body">

            </div>
          </div>
        </div>
      </div>
    </div>

  </body>
  </html>
  @endsection
