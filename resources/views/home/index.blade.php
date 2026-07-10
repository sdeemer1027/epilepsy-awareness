@extends('layouts.guest')

@section('title','Home')

@section('content')

<section class="container py-5">

    <div class="text-center">

        <h1 class="display-4">

            Epilepsy Support Platform

        </h1>

        <p class="lead">

            Support. Empower. Together.

        </p>

        <a
            href="{{ route('register') }}"
            class="btn btn-primary btn-lg">

            Join Today

        </a>

    </div>

</section>

@endsection