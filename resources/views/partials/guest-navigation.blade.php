<nav
    x-data="{ open: false }"
    class="esp-navbar">

    <div class="esp-container">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="esp-logo">

            <img
                src="{{ asset('images/logo/production/logo-horizontal.png') }}"
                alt="Epilepsy Support Platform">

        </a>

        <!-- Navigation -->

        <ul class="esp-nav-links">

            <li><a href="{{ route('home') }}">Home</a></li>

            <li><a href="{{ route('about') }}">About</a></li>

            <li><a href="{{ route('features') }}">Features</a></li>

            <li><a href="{{ route('knowledgebase') }}">Knowledge Base</a></li>

            <li><a href="#">Forum</a></li>

            <li><a href="#">Q&amp;A</a></li>

            <li><a href="{{ route('resources') }}">Resources</a></li>

            <li><a href="{{ route('contact') }}">Contact</a></li>

        </ul>

        <!-- Authentication -->

        <div class="esp-auth-buttons">

            @guest

                <a href="{{ route('login') }}"
                   class="esp-btn esp-btn-outline">

                    Login

                </a>

                <a href="{{ route('register') }}"
                   class="esp-btn esp-btn-primary">

                    Register

                </a>

            @else

                <a href="{{ route('dashboard') }}"
                   class="esp-btn esp-btn-primary">

                    Dashboard

                </a>

            @endguest

        </div>









<div class="esp-mobile-toggle">

    <button
        @click="open = !open"
        type="button">

        <svg
            x-show="!open"
            xmlns="http://www.w3.org/2000/svg"
            width="30"
            height="30"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24">

            <path d="M3 6h18M3 12h18M3 18h18"/>

        </svg>

        <svg
            x-show="open"
            xmlns="http://www.w3.org/2000/svg"
            width="30"
            height="30"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24">

            <path d="M18 6L6 18M6 6l12 12"/>

        </svg>

    </button>

</div>




















    </div>







<div
    x-show="open"
    x-transition
    x-cloak
    class="esp-mobile-menu">

    <a href="{{ route('home') }}">Home</a>

    <a href="{{ route('about') }}">About</a>

    <a href="{{ route('features') }}">Features</a>

    <a href="{{ route('knowledgebase') }}">
        Knowledge Base
    </a>

    <a href="{{ route('resources') }}">
        Resources
    </a>

    <a href="{{ route('contact') }}">
        Contact
    </a>

    @guest

        <a href="{{ route('login') }}">
            Login
        </a>

        <a href="{{ route('register') }}">
            Register
        </a>

    @else

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

    @endguest

</div>















</nav>