<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller {

  public function index(){
    return view('book');
  }

  public function store(Request $request){          //add to book table
    $book = new Book();
    $book->title = $request->input('title');
    $book->author = $request->input('author');
    $book->category = $request->input('category');
    $book->price = $request->input('price');

    if($request->hasfile('cover_pic')){     //render image
      $file=$request->file('cover_pic');
      $extension=$file->getClientOriginalExtension();
      $filename=time() . '.' . $extension;
      $file->move('uploads/book/'.$filename);
      $book->image = $filename;
    }
    else{
      return $request;
      $book->image = '';
    }
    $book->save();
    return view('book')->with('book'.$book);
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





}
