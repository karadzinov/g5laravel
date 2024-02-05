@extends('layouts.dashboard')
@section('content')


    <a href="{{ route('categories.create') }}" class="btn btn-default">Add Category</a>
    {!! $categories !!}
@endsection

