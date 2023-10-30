<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Библиотека</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="bg-[#191725] text-white">
    <div class="container mx-auto max-w-screen-xl">
        <header class="py-5">
            <div class="w-[1280px] p-6 flex items-center justify-between bg-[#59518C]/90 backdrop-blur-sm rounded-3xl">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('catalog') }}" class="flex hover:scale-105 duration-300">
                        <div class="flex items-center p-3 space-x-2 bg-[#756CBF] rounded-xl">
                            <ion-icon name="grid" class="w-5 h-5"></ion-icon>
                            <p class="font-bold uppercase">Каталог</p>
                        </div>
                    </a>

                    <a href="{{ route('about') }}" class="font-bold uppercase hover:opacity-50 duration-300">О нас</a>

                    <a href="" class="font-bold uppercase hover:opacity-50 duration-300">Контакты</a>
                </div>

                <div class="">
                    <a href="/" class="hover:opacity-75 duration-300">
                        <img src="{{ asset('image/logo.svg') }}" alt="" class="w-52">
                    </a>
                </div>

                <div class="flex items-center space-x-3">
                    <form action="{{ route('search') }}" class="w-full" method="GET">
                        <label for="" class="flex items-center justify-end">
                            <input type="text" name="query" class="h-12 w-52 bg-[#756CBF] text-sm pl-3 font-bold rounded-xl outline-none" placeholder="Поиск">
                            <button type="submit" class="absolute mr-5 flex items-center justify-center">
                                <ion-icon name="search" class="w-6 h-6 rotate-90 hover:scale-110 duration-300"></ion-icon>
                            </button>
                        </label>
                    </form>

                    @guest 
                        <a href="{{ route('login') }}" class="flex hover:scale-105 duration-300">
                            <div class="flex items-center p-3 space-x-2 bg-[#756CBF] rounded-xl">
                                <p class="font-bold uppercase">Войти</p>
                                <ion-icon name="person-outline" class="w-6 h-6"></ion-icon>
                            </div>
                        </a>

                        @else
                            <a href="{{ route('profile', Auth::user()->id) }}" class="hover:scale-105 duration-300">
                                <div class="p-3 flex items-center justify-center bg-[#756CBF] space-x-2 rounded-xl">
                                    <p class="font-bold uppercase">{{ Auth::user()->name }}</p>
                                    <ion-icon name="person-outline" class="w-6 h-6"></ion-icon>
                                </div>
                            </a>
                    @endguest
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            <div class="flex mt-44 mb-10">
                <div class="w-64">
                    <a href="/" class="hover:opacity-75 duration-300">
                        <img src="{{ asset('image/logo.svg') }}" alt="" class="w-52">
                    </a>

                    <p class="text-sm font-bold text-gray-400 mt-5">Исследуй. Читай. Вдохновляйся.</p>
                </div>

                <div class="ml-24 space-y-8">
                    <div class="flex items-center space-x-2">
                        <ion-icon name="grid" class="w-5 h-5 text-[#756CBF]"></ion-icon>

                        <p class="font-bold uppercase">Каталог</p>
                    </div>

                    <ul class="space-y-4">
                        <li><a href="{{ route('catalog', ['genre' => 'Художественная литература']) }}" class="font-medium text-gray-300 hover:text-[#756CBF] duration-300">Художественная литература</a></li>
                        <li><a href="{{ route('catalog', ['genre' => 'Фантастика']) }}" class="font-medium text-gray-300 hover:text-[#756CBF] duration-300">Фантастика</a></li>
                        <li><a href="{{ route('catalog', ['genre' => 'Образование']) }}" class="font-medium text-gray-300 hover:text-[#756CBF] duration-300">Образование</a></li>
                        <li><a href="{{ route('catalog', ['genre' => 'Психология']) }}" class="font-medium text-gray-300 hover:text-[#756CBF] duration-300">Психология</a></li>
                    </ul>
                </div>

                <div class="ml-20 space-y-8">
                    <div class="flex items-center space-x-2">
                        <ion-icon name="heart" class="w-5 h-5 text-[#756CBF]"></ion-icon>

                        <p class="font-bold uppercase">Для клиента</p>
                    </div>

                    <ul class="space-y-4">
                        <li><a href="{{ route('about') }}" class="font-medium text-gray-300 hover:text-[#756CBF] duration-300">О нас</a></li>
                        <li><a href="" class="font-medium text-gray-300 hover:text-[#756CBF] duration-300">Как это работает?</a></li>
                    </ul>
                </div>

                <div class="ml-44">
                    <div class="flex items-center space-x-2">
                        <ion-icon name="person" class="w-5 h-5 text-[#756CBF]"></ion-icon>

                        <p class="font-bold uppercase">Контакты</p>
                    </div>

                    <a href="tel:+7(903)7590430" class="block text-2xl font-bold hover:text-[#756CBF] duration-300 mt-10">+7 (903) 759 04 30</a>

                    <p class="text-sm font-bold text-gray-400 mt-2">Поможем с выбором</p>

                    <a href="mailto:library.books@yandex.ru" class="block text-2xl font-bold hover:text-[#756CBF] duration-300 mt-10">library.books@yandex.ru</a>

                    <div class="flex items-center space-x-5 mt-5">
                        <a href="" class="w-10 h-10 flex items-center justify-center rounded-full bg-[#756CBF] hover:opacity-50 duration-300">
                            <ion-icon name="logo-vk" class="w-5 h-5"></ion-icon>
                        </a>

                        <a href="" class="w-10 h-10 flex items-center justify-center rounded-full bg-[#756CBF] hover:opacity-50 duration-300">
                            <ion-icon name="logo-instagram" class="w-5 h-5"></ion-icon>
                        </a>

                        <a href="" class="w-10 h-10 flex items-center justify-center rounded-full bg-[#756CBF] hover:opacity-50 duration-300">
                            <ion-icon name="logo-whatsapp" class="w-5 h-5"></ion-icon>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
</body>
</html>