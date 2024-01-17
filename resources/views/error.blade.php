@extends('layouts.dashboard')
@section('content')

    <h1>{{ auth()->user()->name }}, please return back this is Administrator route!</h1>
@endsection
