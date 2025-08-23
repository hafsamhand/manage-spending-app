@extends('layouts.app')

@section('content')
    <div id="app" data-props='@json($props ?? ["user" => Auth::user()])'></div>
@endsection
