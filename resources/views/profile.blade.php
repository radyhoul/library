@extends('layouts.header')

@section('content')
    @if($user->role == '2')
        <section>
            <div class="flex justify-center space-x-10 mt-20">
                <div class="w-96 h-96 p-5 bg-[#59518C]/50 rounded-3xl text-4xl font-bold hover:scale-105 duration-300 overflow-hidden cursor-pointer" data-te-toggle="modal" data-te-target="#exampleModalBooks">
                    Все книги
                    <img src="{{ asset('image/bookshop.svg') }}" alt="" class="">
                </div>

                <a href="" class="w-96 h-96 p-5 bg-[#59518C]/50 rounded-3xl text-4xl font-bold hover:scale-105 duration-300 overflow-hidden" data-te-toggle="modal" data-te-target="#exampleModalOrders">
                    Заявки
                    <img src="{{ asset('image/order.svg') }}" alt="" class="mt-7">
                </a>
            </div>

            <div data-te-modal-init class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="exampleModalBooks" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
                <div data-te-modal-dialog-ref class="pointer-events-none relative flex min-h-[calc(100%-1rem)] translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[700px]">
                    <div class="pointer-events-auto relative flex w-full flex-col rounded-2xl border-none bg-[#59518C]/60 shadow-2xl backdrop-blur-xl">
                        <div class="flex items-center justify-between p-4 border-b border-[#756CBF]">
                            <p class="text-2xl font-medium" id="exampleModalCenterTitle">Книги</p>

                            <button type="button" class="hover:opacity-75 duration-300" data-te-modal-dismiss aria-label="Close">
                                <ion-icon name="close-outline" class="w-7 h-7"></ion-icon>
                            </button>
                        </div>

                        <div class="relative p-4">
                            <div class="grid grid-cols-4 gap-4">
                                @foreach($book as $books)
                                    <a href="{{ route('product-edit', $books->id) }}" class="p-3 rounded-2xl hover:scale-[1.03] hover:bg-[#756CBF]/40 duration-300">                                        
                                        <div class="w-full flex justify-center mt-5">
                                            <img src="{{ asset('images/' . $books->image) }}" alt="" class="w-28 h-44">
                                        </div>

                                        <p class="font-semibold mt-5 truncate">{{ $books->name }}</p>
                                        <p class="font-light mt-2 truncate">{{ $books->author }}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center border-t border-[#756CBF] p-4">
                            <a href="{{ route('product-create') }}" class="p-3 border border-[#756CBF] rounded-xl font-bold hover:bg-[#756CBF] hover:scale-[1.03] duration-300">Добавить книгу</a>
                        </div>
                    </div>
                </div>
            </div>

            <div data-te-modal-init class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="exampleModalOrders" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
                <div data-te-modal-dialog-ref class="pointer-events-none relative flex min-h-[calc(100%-1rem)] translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[700px]">
                    <div class="pointer-events-auto relative flex w-full flex-col rounded-2xl border-none bg-[#59518C]/60 shadow-2xl backdrop-blur-xl">
                        <div class="flex items-center justify-between p-4 border-b border-[#756CBF]">
                            <p class="text-2xl font-medium" id="exampleModalCenterTitle">Заявки</p>

                            <button type="button" class="hover:opacity-75 duration-300" data-te-modal-dismiss aria-label="Close">
                                <ion-icon name="close-outline" class="w-7 h-7"></ion-icon>
                            </button>
                        </div>

                        <div class="relative p-4 space-y-5">
                            @if($booking->count() > 0)
                                @php $hasUnissuedBookings = false @endphp
                                    @foreach($booking as $bookings)
                                        @if($bookings->status == 'Выдана')
                                            {{-- Handle 'Выдана' status --}}
                                        @else
                                            @php $hasUnissuedBookings = true @endphp
                                            <div class="w-full p-5 flex items-center justify-between bg-[#756CBF]/50 rounded-xl">
                                                <div class="">
                                                    <p class="font-bold">{{ $bookings->book->name }}</p>
                                                    <p class="text-sm mt-3">{{ $bookings->user->surname }} {{ $bookings->user->name }} {{ $bookings->user->patronymic }}</p>
                                                </div>

                                                @if($bookings->status == 'Готова к выдаче')
                                                    <form action="{{ route('booking-issue', $bookings->id) }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="status" value="Выдана">
                                                        <button class="w-36 p-2 border-2 border-[#756CBF] rounded-xl font-bold hover:bg-[#756CBF] hover:scale-105 duration-300">Выдать книгу</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('booking-delete', $bookings->id) }}" method="get">
                                                        <button class="w-36 p-2 border-2 border-[#756CBF] rounded-xl font-bold hover:bg-[#756CBF] hover:scale-105 duration-300">Забрать книгу</button>
                                                    </form>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach

                                @if (!$hasUnissuedBookings)
                                    <p class="text-xl opacity-50">На данный момент заявок нету</p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @elseif($user->role == '3')
        <section class="mt-20 space-y-5">
            <div class="flex items-center justify-between">
                <p class="text-3xl font-bold">Все пользователи</p>

                <a href="" class="p-3 text-sm font-bold text-[#756CBF] rounded-xl hover:bg-[#59518C]/50 hover:text-white hover:scale-[1.02] duration-300" data-te-toggle="modal" data-te-target="#exampleModalUserCreate">Добавить пользователя</a>

                <div data-te-modal-init class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="exampleModalUserCreate" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
                    <div data-te-modal-dialog-ref class="pointer-events-none relative flex min-h-[calc(100%-1rem)] translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[400px]">
                        <div class="pointer-events-auto relative flex w-full flex-col rounded-2xl border-none bg-[#59518C]/60 shadow-2xl backdrop-blur-xl">
                            <div class="flex items-center justify-between p-4 border-b border-[#756CBF]">
                                <p class="text-2xl font-medium" id="exampleModalCenterTitle">Новый пользователь</p>

                                <button type="button" class="hover:opacity-75 duration-300" data-te-modal-dismiss aria-label="Close">
                                    <ion-icon name="close-outline" class="w-7 h-7"></ion-icon>
                                </button>
                            </div>

                            <div class="relative p-4 mt-2">
                                <form action="{{ route('profile-create') }}" method="post" class="flex flex-col items-center w-full space-y-4">
                                    @csrf

                                    <input id="name" type="text" class="w-full h-12 bg-[#756CBF] pl-3 font-bold rounded-xl outline-none focus:scale-105 duration-300" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Имя">
                                    <input id="surname" type="text" class="w-full h-12 bg-[#756CBF] pl-3 font-bold rounded-xl outline-none focus:scale-105 duration-300" name="surname" required autocomplete="name" autofocus placeholder="Фамилия">
                                    <input id="email" type="email" class="w-full h-12 bg-[#756CBF] pl-3 font-bold rounded-xl outline-none focus:scale-105 duration-300" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Почта">
                                    <input id="date" type="date" class="w-full h-12 bg-[#756CBF] pl-3 font-bold rounded-xl outline-none focus:scale-105 duration-300" name="date" required autocomplete="name" autofocus placeholder="Дата рождения">
                                    <input id="password" type="password" class="w-full h-12 bg-[#756CBF] pl-3 font-bold rounded-xl outline-none focus:scale-105 duration-300" name="password" required autocomplete="new-password" placeholder="Пароль">
                                    <input id="password-confirm" type="password" class="w-full h-12 bg-[#756CBF] pl-3 font-bold rounded-xl outline-none focus:scale-105 duration-300" name="password_confirmation" required autocomplete="new-password" placeholder="Повторите пароль">

                                    <button type="submit" class="p-2 w-full text-lg font-bold border-2 border-[#756CBF] text-[#756CBF] rounded-2xl hover:bg-[#756CBF] hover:text-white hover:scale-105 duration-300">
                                        Добавить
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col space-y-5">
                @foreach($allUsers as $allUser)
                    <a href="" class="w-full h-32 p-8 bg-[#59518C]/50 rounded-3xl hover:scale-[1.02] duration-300" data-te-toggle="modal" data-te-target="#exampleModalUser-{{ $allUser->id }}">
                        <div class="flex items-center justify-between">
                            <div class="space-y-3">
                                <p class="text-xl font-bold">{{ $allUser->surname }} {{ $allUser->name }} {{ $allUser->patronymic }}</p>

                                <p>{{ $allUser->email }}</p>
                            </div>

                            <ion-icon name="arrow-forward-outline" class="w-8 h-8"></ion-icon>
                        </div>
                    </a>

                    <div data-te-modal-init class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="exampleModalUser-{{ $allUser->id }}" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
                        <div data-te-modal-dialog-ref class="pointer-events-none relative flex min-h-[calc(100%-1rem)] translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[700px]">
                            <div class="pointer-events-auto relative flex w-full flex-col rounded-2xl border-none bg-[#59518C]/60 shadow-2xl backdrop-blur-xl">
                                <div class="flex items-center justify-between p-4 border-b border-[#756CBF]">
                                    <p class="text-2xl font-medium" id="exampleModalCenterTitle">
                                        @if($allUser->role == '3')
                                            Администратор

                                            @elseif($allUser->role == '2')
                                                Библиотекарь

                                                @else
                                                    Пользователь
                                        @endif
                                    </p>

                                    <button type="button" class="hover:opacity-75 duration-300" data-te-modal-dismiss aria-label="Close">
                                        <ion-icon name="close-outline" class="w-7 h-7"></ion-icon>
                                    </button>
                                </div>

                                <div class="relative p-4 space-y-10 mt-2">
                                    <div class="">
                                        <p class="text-2xl font-bold">Личные данные</p>

                                        <p class="mt-2">{{ $allUser->surname }} {{ $allUser->name }} {{ $allUser->patronymic }}</p>
                                        <p class="mt-1 opacity-50">{{ $allUser->email }}</p>
                                        <p class="mt-1 opacity-50">{{ $allUser->date }}</p>
                                    </div>
                                </div>

                                <div class="p-4">
                                    <a href="{{ route('profile-delete', $allUser->id) }}" class="flex items-center justify-center p-3 w-52 font-bold rounded-lg border border-red-400 text-red-400 hover:bg-red-400 hover:text-white duration-300">Удалить пользователя</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

    @else
        <section>
            <div class="flex space-x-10 mt-24">
                <div class="">
                    <ul class="space-y-3">
                        <li>
                            <a href="#profile" class="flex items-center w-64 p-3 rounded-xl bg-[#59518C]/50 text-white hover:bg-[#59518C]/50 duration-300 transition-all">
                                <ion-icon name="grid-outline" class="w-6 h-6 mr-2"></ion-icon>
                                Профиль
                            </a>
                        </li>

                        <li>
                            <a href="#personal-data" class="flex items-center w-64 p-3 rounded-xl hover:bg-[#59518C]/50 duration-300 transition-all">
                                <ion-icon name="person-outline" class="w-6 h-6 mr-2"></ion-icon>
                                Личные данные
                            </a>
                        </li>

                        <li>
                            <a href="#booking" class="flex items-center w-64 p-3 rounded-xl hover:bg-[#59518C]/50 duration-300 transition-all">
                                <ion-icon name="calendar-number-outline" class="w-6 h-6 mr-2"></ion-icon>
                                Бронирование
                            </a>
                        </li>

                        <li>
                            <a href="" class="flex items-center w-64 p-3 rounded-xl hover:bg-[#59518C]/50 hover:text-red-400 duration-300" 
                                onclick="event.preventDefault(); 
                                    document.getElementById('logout-form').submit();">

                                <ion-icon name="exit-outline" class="w-6 h-6 mr-2"></ion-icon>
                                Выйти
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>

                <div class="w-full">
                    <div class="content hidden" id="profile">
                        <div class="flex items-center space-x-2">
                            <ion-icon name="grid-outline" class="w-12 h-12 text-[#59518C]"></ion-icon>
                            <p class="text-4xl font-bold uppercase">Профиль</p>
                        </div>

                        <div class="mt-14">
                            <a href="#personal-data" class="text-3xl font-semibold uppercase hover:text-[#59518C] duration-300">Личные данные</a>

                            <div class="mt-3 space-y-3">
                                <p class="text-xl">{{ Auth::user()->surname }} {{ Auth::user()->name }} {{ Auth::user()->patronymic }}</p>

                                <p class="text-sm">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <div class="mt-20">
                            <a href="" class="text-3xl font-semibold uppercase hover:text-[#59518C] duration-300">Активные бронирования</a>

                            @if($booking->count() > 0)
                                <div class="grid grid-cols-4 gap-5 mt-3">
                                    @foreach($booking as $bookingItem)
                                        @if($bookingItem->user_id == Auth::user()->id)
                                            @if($bookingItem->status == 'Забрать')

                                            @else
                                                <a href="{{ route('product', $bookingItem->book_id) }}" class="p-3 rounded-2xl hover:scale-[1.03] hover:bg-[#59518C]/50 duration-300">                                        
                                                    <div class="w-full flex justify-center mt-5">
                                                        <img src="{{ asset('images/' . $bookingItem->book->image) }}" alt="" class="w-28 h-44">
                                                    </div>

                                                    <p class="font-semibold mt-5 truncate">{{ $bookingItem->book->name }}</p>
                                                    <p class="font-light mt-2">{{ $bookingItem->book->author }}</p>
                                                    <p class="text-2xl font-bold mt-5">{{ $bookingItem->book->price }} ₽</p>

                                                        @if($bookingItem->status == 'Готова к выдаче')
                                                            <div class="mt-5 flex items-center space-x-2">
                                                                <span class="relative flex h-2 w-2">
                                                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-300 opacity-75"></span>
                                                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-400"></span>
                                                                </span>
                                                                
                                                                <p class="text-green-400">{{ $bookingItem->status }}</p>
                                                            </div>

                                                            @else
                                                                <div class="mt-5 flex items-center space-x-2">
                                                                    <span class="relative flex h-2 w-2">
                                                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-300 opacity-75"></span>
                                                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-sky-400"></span>
                                                                    </span>

                                                                    <p class="text-sky-400">{{ $bookingItem->status }}</p>
                                                                </div>
                                                        @endif
                                                    
                                                    @if($bookingItem->status == 'Готова к выдаче')
                                                        <form action="{{ route('booking-delete', $bookingItem->id) }}" method="get">
                                                            <button class="w-full p-2 border-2 border-[#756CBF] text-[#756CBF] rounded-xl font-bold mt-5 hover:bg-[#756CBF] hover:text-white duration-300">Снять бронь</button>
                                                        </form>
                                                    @elseif($bookingItem->status == 'Выдана')
                                                        <form action="{{ route('booking-take', $bookingItem->id) }}" method="post">
                                                            @csrf

                                                            <input type="hidden" name="status" value="Забрать">
                                                            <button class="w-full p-2 border-2 border-[#756CBF] text-[#756CBF] rounded-xl font-bold mt-5 hover:bg-[#756CBF] hover:text-white duration-300">Сдать книгу</button>
                                                        </form>
                                                    @else
                                                        
                                                    @endif
                                                </a>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div class="mt-3 space-y-3">
                                    <p class="opacity-50">У вас пока нет активных бронирований</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div id="personal-data" class="content hidden">
                        <div class="">
                            <div class="flex items-center space-x-2">
                                <ion-icon name="person-outline" class="w-12 h-12 text-[#59518C]"></ion-icon>
                                <p class="text-4xl font-bold uppercase">Личные данные</p>
                            </div>

                            <form action="{{ route('personal-edit', Auth::user()->id) }}" method="post" class="mt-14 space-y-5">
                                @csrf

                                <div class="flex space-x-5">
                                    <input type="text" name="surname" id="surname" class="w-full h-14 border border-[#756CBF]/50 bg-inherit pl-3 font-bold rounded-xl outline-none focus:scale-[1.02] focus:border-[#756CBF] duration-300" placeholder="Фамилия*" value="{{ Auth::user()->surname }}">
                                    <input type="text" name="name" id="name" class="w-full h-14 border border-[#756CBF]/50 bg-inherit pl-3 font-bold rounded-xl outline-none focus:scale-[1.02] focus:border-[#756CBF] duration-300" placeholder="Имя" value="{{ Auth::user()->name }}">
                                </div>
                                
                                <div class="flex space-x-5">
                                    <input type="text" name="patronymic" id="patronymic" class="w-full h-14 border border-[#756CBF]/50 bg-inherit pl-3 font-bold rounded-xl outline-none focus:scale-[1.02] focus:border-[#756CBF] duration-300" placeholder="Отчество" value="{{ Auth::user()->patronymic }}">
                                    <input type="date" name="date" id="date" class="w-full h-14 border border-[#756CBF]/50 bg-inherit pl-3 font-bold rounded-xl outline-none focus:scale-[1.02] focus:border-[#756CBF] duration-300" placeholder="Дата рождения*" value="{{ Auth::user()->date }}">
                                </div>

                                <input type="email" name="email" id="email" class="w-full h-14 border border-[#756CBF]/50 bg-inherit pl-3 font-bold rounded-xl outline-none focus:scale-[1.02] focus:border-[#756CBF] duration-300" placeholder="E-mail" value="{{ Auth::user()->email }}">

                                <button class="p-3 bg-[#756CBF] rounded-xl font-bold mt-5 hover:scale-105 hover:opacity-90 duration-300">Сохранить изменения</button>
                            </form>

                            <div class="mt-14 space-y-3">
                                <p class="font-bold text-red-400 text-xl">Опасная зона</p>

                                <a href="{{ route('profile-delete', Auth::user()->id) }}" class="flex items-center justify-center w-56 h-9 text-sm font-medium rounded-lg border border-red-400 text-red-400 hover:bg-red-400 hover:text-white duration-300">Да. Удалить этот профиль</a>

                                <p class="text-sm opacity-50">Эта кнопка удалит профиль «{{ Auth::user()->name }}». Пожалуйста, подумайте дважды.</p>
                            </div>
                        </div>
                    </div>

                    <div id="booking" class="content hidden">
                        <div class="flex items-center space-x-2">
                            <ion-icon name="calendar-number-outline" class="w-12 h-12 text-[#59518C]"></ion-icon>
                            <p class="text-4xl font-bold uppercase">Активные бронирования</p>
                        </div>

                        @if($booking->count() > 0)
                                <div class="grid grid-cols-4 gap-5 mt-3">
                                    @foreach($booking as $bookingItem)
                                        @if($bookingItem->user_id == Auth::user()->id)
                                            @if($bookingItem->status == 'Забрать')

                                            @else
                                                <a href="{{ route('product', $bookingItem->book_id) }}" class="p-3 rounded-2xl hover:scale-[1.03] hover:bg-[#59518C]/50 duration-300">                                        
                                                    <div class="w-full flex justify-center mt-5">
                                                        <img src="{{ asset($bookingItem->book->image) }}" alt="" class="w-28 h-44">
                                                    </div>

                                                    <p class="font-semibold mt-5 truncate">{{ $bookingItem->book->name }}</p>
                                                    <p class="font-light mt-2">{{ $bookingItem->book->author }}</p>
                                                    <p class="text-2xl font-bold mt-5">{{ $bookingItem->book->price }} ₽</p>

                                                        @if($bookingItem->status == 'Готова к выдаче')
                                                            <div class="mt-5 flex items-center space-x-2">
                                                                <span class="relative flex h-2 w-2">
                                                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-300 opacity-75"></span>
                                                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-400"></span>
                                                                </span>
                                                                
                                                                <p class="text-green-400">{{ $bookingItem->status }}</p>
                                                            </div>

                                                            @else
                                                                <div class="mt-5 flex items-center space-x-2">
                                                                    <span class="relative flex h-2 w-2">
                                                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-300 opacity-75"></span>
                                                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-sky-400"></span>
                                                                    </span>

                                                                    <p class="text-sky-400">{{ $bookingItem->status }}</p>
                                                                </div>
                                                        @endif
                                                    
                                                    @if($bookingItem->status == 'Готова к выдаче')
                                                        <form action="{{ route('booking-delete', $bookingItem->id) }}" method="get">
                                                            <button class="w-full p-2 border-2 border-[#756CBF] text-[#756CBF] rounded-xl font-bold mt-5 hover:bg-[#756CBF] hover:text-white duration-300">Снять бронь</button>
                                                        </form>
                                                    @elseif($bookingItem->status == 'Выдана')
                                                        <form action="{{ route('booking-take', $bookingItem->id) }}" method="post">
                                                            @csrf

                                                            <input type="hidden" name="status" value="Забрать">
                                                            <button class="w-full p-2 border-2 border-[#756CBF] text-[#756CBF] rounded-xl font-bold mt-5 hover:bg-[#756CBF] hover:text-white duration-300">Сдать книгу</button>
                                                        </form>
                                                    @else
                                                        
                                                    @endif
                                                </a>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div class="mt-3 space-y-3">
                                    <p class="opacity-50">У вас пока нет активных бронирований</p>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </section>
    @endif
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
