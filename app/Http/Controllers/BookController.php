<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Admin;

class BookController extends Controller {

  public function index(){
    $books = Book::all();
    return view('admin', compact('books')); //for admin page
  }

  public function display()
  {
    $books = Book::all();
    return view('landing', compact('books')); //for Landing page
  }

  public function displayBooksLoggedIn()
  {
    $books = Book::all();
    return view('booksLoggedIn', compact('books')); //for booksLoggedIn page
  }

  public function displayBooksPublic()
  {
    $books = Book::all();
    return view('booksPublic', compact('books'));   //for booksPublic page
  }

  public function create()
  {
    return view('/admin');
  }

  public function store(Request $request)   //add to book table
  {
    $this->validate($request, [
      'title' => 'required',
      'author' => 'required',
      'category' => 'required',
      'price' => 'required',
      'cover_pic' => 'required',
      'qty' => 'required'
    ]);
    $book = new Book ([
      'title' => $request->get('title'),
      'author' => $request->get('author'),
      'category' => $request->get('category'),
      'price' => $request->get('price'),
      'cover_pic' => $request->get('cover_pic'),
      'qty' => $request->get('qty')
    ]);

    $book->save();
    return redirect()->route('admin')->with('success', 'Book Added'); //display success message if create book action is successful
  }

  public function cart()
  {
    return view('cart');
  }
  public function addToCart($id)
  {
    $book = Book::find($id);

    if(!$book) {

      abort(404);

    }

    $cart = session()->get('cart');

    // if cart is empty then this the first book
    if(!$cart) {

      $cart = [
        $id => [
          "title" => $book->title,
          "quantity" => 1,
          "price" => $book->price,
          "cover_pic" => $book->cover_pic
        ]
      ];

      session()->put('cart', $cart);

      return redirect()->back()->with('success', 'Book added to cart successfully!');
    }

    // if cart not empty then check if this book exist then increment quantity
    if(isset($cart[$id])) {

      $cart[$id]['quantity']++;

      session()->put('cart', $cart);

      return redirect()->back()->with('success', 'Book added to cart successfully!');

    }

    // if item not exist in cart then add to cart with quantity = 1
    $cart[$id] = [
      "title" => $book->title,
      "quantity" => 1,
      "price" => $book->price,
      "cover_pic" => $book->cover_pic
    ];

    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'Book added to cart successfully!');
  }

  public function cartUpdate(Request $request)
  {
    if($request->id and $request->quantity)
    {
      $cart = session()->get('cart');
      $cart[$request->id]["quantity"] = $request->quantity;
      session()->put('cart', $cart);
      session()->flash('success', 'Cart updated successfully');
    }
  }

  public function cartRemove(Request $request)
  {
    if($request->id) {
      $cart = session()->get('cart');
      if(isset($cart[$request->id])) {
        unset($cart[$request->id]);
        session()->put('cart', $cart);
      }
      session()->flash('success', 'Book removed successfully');
    }
  }

//to edit data of book of given ID
  public function edit ($id)
  {
    $book = Book::find($id);
    //  return view ('editBook', compact('book', 'id'));
    return view('editBook')->with('book', $book);

  }

//to update database data
  public function update (Request $request, $id)
  {
    $this->validate($request, [
      'title' => 'required',
      'author' => 'required',
      'category' => 'required',
      'price' => 'required',
      'cover_pic' => 'required',
      'qty' => 'required'
    ]);

    $book = Book::find($id);
    $book->title = $request->get('title');
    $book->author = $request->get('author');
    $book->category = $request->get('category');
    $book->price = $request->get('price');
    $book->cover_pic = $request->get('cover_pic');
    $book->qty = $request->get('qty');
    $book->save();
    return redirect()->route('admin')->with('success', 'Data Updated');
  }

//to delete data
  public function destroy ($id)
  {
    $book = Book::find($id);
    $book->delete();
    return redirect()->route('admin')->with('success', 'Data Deleted');
  }


}
