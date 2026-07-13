@extends('layouts.guest')

@section('title', 'Home')

@section('content')

<x-hero />

<x-esp-at-a-glance :stats="$stats" />

<x-platform-highlights />

<x-platform-modules />

<x-why-esp />

@endsection