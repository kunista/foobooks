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
        return 'Here are all the books...';
    }

    /**
     * GET /book{$title}
     */
    public function show($title)
    {
       return 'You are viewing '.$title;
    }

    /**
     * GET /example
     */
    public function example()
    {
        return Hash::make('topsecret');
    }
}