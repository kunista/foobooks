@extends('layouts.master')

@section('title')
    Delete Book
@endsection


@section('content')

    <h1>Delete Book</h1>

    <p>
        Are you sure you want to delete <em>{{$book->title}}</em>?
    </p>

    <p>
        <a href='/book/{{$book->id}}/delete'>Yes...</a>
    </p>

@endsection
