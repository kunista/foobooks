<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Debugbar;
use cebe\markdown\MarkdownExtra;
use App\Rules\AlphaAndSpaces;
use App\Book;

class PracticeController extends Controller
{

    /**
     *
     */

    public function practice16()
    {
        Book::where('author', '=', 'J.K. Rowling')->delete();
    }

    public function practice15()
    {
        Book::where('author', '=', 'Bell Hooks')->update(['author' => 'bell hooks']);
    }

    public function practice14()
    {

        $books = Book::orderBy('published', 'desc')->get();

        dump($books->toArray());
    }

    public function practice13()
    {

        $books = Book::orderBy('title', 'asc')->get();

        dump($books->toArray());
    }

    public function practice12()
    {

        $books = Book::where('published', '>', 1950)->get();

        dump($books->toArray());
    }

    public function practice11()
    {

        $books = Book::orderBy('created_at', 'desc')->limit(2)->get();

        dump($books->toArray());
    }

    public function practice10()
    {

        $book = Book::find(11);

        if ($book) {
            $book->delete();
            dump('Deleted book #11');
        } else {
            dump('Did not delete book 11, did not find it.');
            }
    }


    /**
     *
     */
    public function practice9()
    {
        # First get a book to update
        $book = Book::where('author', 'LIKE', '%Scott%')->first();

        if (!$book) {
            dump("Book not found, can't update.");
        } else {
            # Change some properties
            $book->title = 'The Really Great Gatsby';
            $book->published = '2025';

            # Save the changes
            $book->save();

            dump('Update complete; check the database to confirm the update worked.');
        }
    }

    /**
     * Example of querying for books with constraints using an Eloquent model
     */
    public function practice8()
    {
        #$book = new Book();
        $books = Book::where('title', 'LIKE', '%Harry Potter%')
            ->orWhere('published', '>=', 1880)
            ->orderBy('created_at', 'desc')
            ->get();

        dump($books->toArray());
    }


    /**
     * Example of querying for books using an Eloquent model
     */
    public function practice7()
    {
        $book = new Book();
        $books = $book->all();
        dump($books->toArray());
    }


    /**
     * Example of adding a new book using an Eloquent model
     */
    public function practice6()
    {
        # Instantiate a new Book Model object
        $book = new Book();

        # Set the parameters
        # Note how each parameter corresponds to a field in the table
        $book->title = 'Harry Potter and the Sorcerer\'s Stone';
        $book->author = 'J.K. Rowling';
        $book->published = 1997;
        $book->cover = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
        $book->purchase_link = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $book->save();

        dump($book->toArray());
    }


    /**
     * Demonstration of a custom validation rule
     */
    public function practice5(Request $request)
    {

        $name = $request->input('name', null);

        $this->validate($request, [
            'name' => [new AlphaAndSpaces]
            #'name' => 'regex:/^[\pL\s\-]+$/u'
        ]);

        return view('practice.6')->with([
            'name' => $name,
        ]);
    }


    /**
     * Example using an external package
     */
    public function practice4()
    {
        $parser = new MarkdownExtra();
        echo $parser->parse('# Hello World');
    }


    /**
     * Examples writing to the Debugbar
     */
    public function practice3()
    {
        Debugbar::info($_GET);
        Debugbar::info(['a' => 1, 'b' => 2, 'c' => 3]);
        Debugbar::error('Error!');
        Debugbar::warning('Watch out…');
        Debugbar::addMessage('Another message', 'mylabel');
        return 'Practice 4';
    }


    /**
     * Purposefully create an error to view it in the error logs
     */
    public function practice2()
    {
        return view('abc');
    }


    /**
     * Viewing config info
     */
    public function practice1()
    {
        $email = config('mail');
        dump($email);
    }


    /**
     * ANY (GET/POST/PUT/DELETE)
     * /practice/{n?}
     *
     * This method accepts all requests to /practice/ and
     * invokes the appropriate method.
     *
     * http://foobooks.loc/practice/1 => Invokes practice1
     * http://foobooks.loc/practice/5 => Invokes practice5
     * http://foobooks.loc/practice/999 => Practice route [practice999] not defined
     */
    public function index($n = null)
    {
        # If no specific practice is specified, show index of all available methods
        if (is_null($n)) {
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    # Echo'ing display code from a controller is typically bad; making an
                    # exception here because:
                    # 1. This controller is for debugging/demonstration purposes only
                    # 2. This controller is introduced before we cover views
                    echo "<a href='".str_replace('practice', '/practice/', $method)."'>" . $method . "</a><br>";
                }
            }
            # Otherwise, load the requested method
        } else {
            $method = 'practice'.$n;

            if (method_exists($this, $method)) {
                return $this->$method();
            } else {
                dd("Practice route [{$n}] not defined");
            }
        }
    }
}