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
          <div class="card-header">Welcome to AstonBookStore guest</div>
          <div class="card-body">

            <!-- setup table to display all books in datbase-->
            <table class="table tbale-stripped table-bordered">
              <thead>
                <tr>
                  <th scope="col">Title</th>
                  <th scope="col">Author</th>
                  <th scope="col">Category</th>
                  <th scope="col">Price (£)</th>
                  <th scope="col">Cover</th>
                </tr>
              </thead>

              <!--Populates table from database-->
              <tbody>
                @foreach($books as $book)
                <tr>
                  <th> {{ $book->title }} </th>
                  <th> {{ $book->author }} </th>
                  <th> {{ $book->category }} </th>
                  <th> {{ $book->price }} </th>
                  <th>
                    <img src="{{ $book->cover_pic }}" alt="cover" style="width:125px;height:150px;"> <!--use image URL to render image-->
                   </th>


                  </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>

</body>
</html>
@endsection
