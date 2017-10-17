<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;

class BookController extends Controller {

    /**
     * GET /books
     */
    public function index()
    {
        return view('book.index');
    }

    /**
     * GET /book{$title}
     */
    public function show($title)
    {
        return view('book.show')->with(['title' => $title]);
    }

    /**
     * GET /example
     */
    public function example()
    {
        return Hash::make('topsecret');
    }
}