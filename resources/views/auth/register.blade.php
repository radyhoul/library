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

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="bg-[#191725] text-white">
    <div class="flex flex-col h-[100vh] items-center justify-center">
        <a href="/" class="hover:opacity-50 duration-300">
            <img src="{{ asset('image/logo.svg') }}" alt="" class="w-56">
        </a>

        <div class="p-10 border-2 border-[#756CBF] rounded-2xl shadow-xl shadow-[#756CBF] mt-5">
            <p class="text-4xl font-bold">Регистрация</p>

            <div class="flex items-center mt-3 space-x-5">
                <p class="">Уже есть аккаунта?</p>
                <a href="{{ route('login') }}" class="hover:text-[#756CBF] duration-300">Войти</a>
            </div>

            <form method="POST" action="{{ route('register') }}" class="flex flex-col space-y-5">
                @csrf

                <input id="name" type="text" class="w-56 h-12 bg-[#756CBF] pl-3 font-bold rounded-xl outline-none focus:scale-105 duration-300" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Имя">
                <input id="surname" type="text" class="w-56 h-12 bg-[#756CBF] pl-3 font-bold rounded-xl outline-none focus:scale-105 duration-300" name="surname" required autocomplete="name" autofocus placeholder="Фамилия">
                <input id="email" type="email" class="w-56 h-12 bg-[#756CBF] pl-3 font-bold rounded-xl outline-none focus:scale-105 duration-300" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Почта">
                <input id="date" type="date" class="w-56 h-12 bg-[#756CBF] pl-3 font-bold rounded-xl outline-none focus:scale-105 duration-300" name="date" required autocomplete="name" autofocus placeholder="Дата рождения">
                <input id="password" type="password" class="w-56 h-12 bg-[#756CBF] pl-3 font-bold rounded-xl outline-none focus:scale-105 duration-300" name="password" required autocomplete="new-password" placeholder="Пароль">
                <input id="password-confirm" type="password" class="w-56 h-12 bg-[#756CBF] pl-3 font-bold rounded-xl outline-none focus:scale-105 duration-300" name="password_confirmation" required autocomplete="new-password" placeholder="Повторите пароль">

                <button type="submit" class="p-2 w-56 text-lg font-bold border-2 border-[#756CBF] text-[#756CBF] rounded-2xl hover:bg-[#756CBF] hover:text-white hover:scale-105 duration-300">
                    Зарегестрироваться
                </button>
            </form>
        </div>
    </div>                  
</body>
</html>