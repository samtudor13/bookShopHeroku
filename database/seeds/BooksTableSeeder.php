<?php

use Illuminate\Database\Seeder;
use App\Book;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $books = [
        [
          'title' => 'Economics for Business',
          'author' => 'Jon Guest',
          'category' => 'Business',
          'price' => '56.99',
          'cover_pic' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTlggtqseRdlP-cNjHCDwfkyZX5dUf7nfFPIg&usqp=CAU'

        ],
        [
          'title' => 'Laptops for Dummies ',
          'author' => 'Dan Gookin',
          'category' => 'Computing',
          'price' => '9.99',
          'cover_pic' => 'https://images-na.ssl-images-amazon.com/images/I/81Cuw2wwmbL.jpg',
        ]

      ];
      foreach ($books as $book) {
    		Book::create($book);
    	}
    }
}
