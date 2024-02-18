<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'E-Library') }}</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- CSS -->
        <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
        <!-- JavaScript -->
        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .mask-star-2:checked {
                background-color: #ffce00;
        }
        </style>
    </head>
    <body class="font-sans text-gray-900 bg-gray-50 antialiased">

            <!-- Navbar -->
            <div class="bg-white shadow p-6 mb-6">
                <div class="flex justify-between items-baseline">
                    <div class="font-extrabold text-blue-400 uppercase">
                        <span>E-Library</span>
                    </div>
                    
                    <div class="flex space-x-5 items-center">
                        <a href="{{ route('beranda') }}" class="hover:text-blue-400 active:text-blue-400">Beranda</a>
                        <a href="{{ route('koleksi.index') }}" class="hover:text-blue-400 active:text-blue-400">Koleksi</a>
                    </div>
                    

                    @if (Route::has('login'))
                        @auth
                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            <div>{{ Auth::user()->name }}</div>

                                            <div class="ms-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                    @else
                        <div class="hidden sm:flex sm:items-center sm:ms-6 gap-2">
                            <button type="button" onclick="window.location.href='{{ route('login') }}'" class="w-24 text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-4 py-2">Login</button>
                            <button type="button" onclick="window.location.href='{{ route('register') }}'" class="w-24 text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-4 py-2">Register</button>
                        </div>
                        @endauth
                    @endif
                </div>
            </div>

        <div class="ml-3 mr-3 p-6">
            @yield('content')
        </div>
        <style>
        * { box-sizing: border-box; }

            
            .carousel {
            }
            
            .carousel-cell {
              border-radius: 5px;
              counter-increment: gallery-cell;
            }
            
            /* cell number */
            .carousel-cell:before {
              display: block;
              text-align: center;
              content: counter(gallery-cell);
              color: white;
            }</style>
    </body>
</html>