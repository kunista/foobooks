@extends('layouts.master')

@section('title')
    Delete Book
@endsection

@section('content')

    <h1>Delete book {{ $book->title }} </h1>

    <form method='POST' action='/book/{{ $book->id }}'>

        {{ method_field('delete') }}

        {{ csrf_field() }}

        <div class="confirmation"> Are you sure you want to delete book {{ $book->title }} ?
        </div>
            <input type='submit' value='Yes' class='btn btn-primary btn-small'>
            <a class="btn btn-default btn-close" href='{{ $previousUrl }}'>Cancel</a>
        </div>
    </form>

@endsection
