@extends('layouts.app')

@section('content')

<!--layout of cart page-->
<table id="cart" class="table table-hover table-condensed">
  <thead>
    <tr>
      <th style="width:50%">Books</th>
      <th style="width:10%">Price</th>
      <th style="width:8%">Quantity</th>
      <th style="width:22%" class="text-center">Subtotal</th>
      <th style="width:10%"></th>
    </tr>
  </thead>
  <tbody>

    <?php $total = 0 ?> <!--sets initial basket total to 0-->

    @if(session('cart'))
    @foreach(session('cart') as $id => $details)

    <?php $total += $details['price'] * $details['quantity'] ?> <!--calculates total basket price-->

    <!--displays items in basket-->
    <tr>
      <td data-th="Book">
        <div class="row">
          <div class="col-sm-3 hidden-xs"><img src="{{ $details['cover_pic'] }}" width="100" height="120" class="img-responsive"/></div>
          <div class="col-sm-9">
            <h4 class="nomargin">{{ $details['title'] }}</h4>
          </div>
        </div>
      </td>
      <td data-th="Price">£{{ $details['price'] }}</td>
      <td data-th="Quantity">
        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" />
      </td>
      <td data-th="Subtotal" class="text-center">£{{ $details['price'] * $details['quantity'] }}</td>
      <td class="actions" data-th="">
        <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
      </td>
    </tr>
    @endforeach
    @endif

  </tbody>
  <tfoot>
    <tr>
      <td><a href="{{ url('booksLoggedIn') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td> <!--button to return to books page-->
      <td colspan="2" class="hidden-xs"></td>
      <td class="hidden-xs text-center"><strong>Total £{{ $total }}</strong></td>
    </tr>
  </tfoot>
</table>

@endsection

@section('scripts')

<script type="text/javascript">

//update cart
$(".update-cart").click(function (e) {
  e.preventDefault();

  var ele = $(this);

  $.ajax({
    url: '{{ url('update-cart') }}',
    type: "patch",
    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
    success: function (response) {
      window.location.reload();
    }
  });
});

//remove from cart
$(".remove-from-cart").click(function (e) {
  e.preventDefault();

  var ele = $(this);

    $.ajax({
      url: '{{ url('remove-from-cart') }}',
      type: "DELETE",
      data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
      success: function (response) {
        window.location.reload();
      }
    });
  }
});

</script>

@endsection
