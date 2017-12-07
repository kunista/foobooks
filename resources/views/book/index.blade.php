@extends('layouts.master')

@push('head')
<link href='/css/book/index.css' rel='stylesheet'>
<link href='/css/book/_book.css' rel='stylesheet'>
@endpush

@section('title')
    Your books
@endsection

@section('content')

    <h1>Your books</h1>

    @if(count($newBooks) > 0)
        <aside id='newBooks'>
            <h2>Recently Added</h2>
            <ul>
                @foreach($newBooks as $book)
                    <li><a href='/book/{{ kebab_case($book['title']) }}'>{{ $book['title'] }}</a></li>
                @endforeach
            </ul>
        </aside>
    @endif

    @if(count($newBooks) > 0)
        @foreach($books as $book)
            <div class='book cf'>
                <img src='{{ $book['cover'] }}' class='cover' alt='Cover image for {{ $book['title'] }}'>
                <h2>{{ $book['title'] }}</h2>
                <p>By {{ $book['author']['first_name'] }} {{ $book['author']['last_name'] }}</p>
                <a href='/book/{{ $book['id'] }}'>View</a> |
                <a href='/book/{{ $book['id'] }}/edit'>Edit</a> |
                <a href='/book/{{ $book['id'] }}/delete'>Delete</a>
            </div>
        @endforeach
    @else
        <p>You don't have any books yet; would you like to <a href='/book/create'>add one?</a>
    @endif

@endsection
