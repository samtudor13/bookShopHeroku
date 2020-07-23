<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Admin;

class BookController extends Controller {

  public function index(){
    return view('admin'); //for admin page
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
      'cover_pic' => 'required'
    ]);
    $book = new Book ([
      'title' => $request->get('title'),
      'author' => $request->get('author'),
      'category' => $request->get('category'),
      'price' => $request->get('price'),
      'cover_pic' => $request->get('cover_pic')
    ]);

    $book->save();
    return redirect()->route('admin')->with('success', 'Book Added'); //display success message if create book action is successful
  }



}
