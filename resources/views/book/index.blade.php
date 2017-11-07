@extends('layouts.master')

@push('head')
<link href='/css/book.css' rel='stylesheet'>
@endpush

@section('title')
    All books
@endsection

@section('content')

    <form method='POST' action='/subscribe'>
    {{ csrf_field() }}
            <input type='text' name='email'>
    <input type='submit' value='Subscribe!'>
    </form>


@endsection