<!-- admin/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bienvenue Admin {{ Auth::user()->name }}</h1>
</div>
@endsection
