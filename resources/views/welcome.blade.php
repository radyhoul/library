@extends('layouts.header')

@section('content')
    <section>
        <div class="mt-24 flex items-center justify-between">
            <div class="">
                <p class="text-6xl font-bold">Открой мир <span class="text-[#756CBF]">знаний</span> <br> с нашей библиотекой</p>
                <p class="text-lg text-gray-300 mt-3">Исследуй. Читай. Вдохновляйся.</p>
                <a href="" class="p-3 w-44 flex items-center justify-center text-lg font-bold border-2 border-[#756CBF] text-[#756CBF] rounded-2xl mt-8 hover:bg-[#756CBF] hover:text-white hover:scale-105 duration-300">Начни чтение</a>
            </div>

            <div class="">
                <img src="{{ asset('image/intro.svg') }}" alt="" class="w-[600px]">
            </div>
        </div>
    </section>

    <section>
        <div class="flex space-x-5 mt-64">
            <a href="{{ route('catalog', ['genre' => 'Художественная литература']) }}" class="w-full hover:scale-[1.03] duration-300">
                <div class="w-full h-[520px] p-10 bg-[#756CBF]/70 rounded-2xl overflow-hidden">
                    <p class="text-4xl font-bold">Художественная литература</p>

                    <img src="{{ asset('image/cart-one.svg') }}" alt="" class="w-[500px] mt-5">
                </div>
            </a>

            <div class="w-full space-y-5">
                <div class="flex w-full space-x-5">
                    <a href="{{ route('catalog', ['genre' => 'Фантастика']) }}" class="w-full hover:scale-105 duration-300">
                        <div class="w-full h-[250px] p-10 bg-[#756CBF]/70 rounded-2xl overflow-hidden">
                            <p class="text-2xl font-bold">Фантастика</p>

                            <img src="{{ asset('image/cart-two.svg') }}" alt="" class="mt-5">
                        </div>
                    </a>

                    <a href="{{ route('catalog', ['genre' => 'Образование']) }}" class="w-full hover:scale-105 duration-300">
                        <div class="w-full h-[250px] p-10 bg-[#756CBF]/70 rounded-2xl overflow-hidden">
                            <p class="text-2xl font-bold">Образование</p>

                            <img src="{{ asset('image/cart-three.svg') }}" alt="" class="mt-5">
                        </div>
                    </a>
                </div>

                <div class="flex w-full">
                    <a href="{{ route('catalog', ['genre' => 'Психология']) }}" class="w-full hover:scale-[1.03] duration-300">
                        <div class="w-full h-[250px] p-10 bg-[#756CBF]/70 rounded-2xl overflow-hidden">
                            <p class="text-2xl font-bold">Психология</p>

                            <img src="{{ asset('image/cart-four.svg') }}" alt="" class="mt-5">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="mt-44">
            <div class="flex items-center justify-between">
                <p class="text-4xl font-bold">Каталог</p>

                <a href="{{ route('catalog') }}" class="p-2 w-32 flex items-center justify-center font-bold border-2 border-[#756CBF] text-[#756CBF] rounded-xl hover:bg-[#756CBF] hover:text-white duration-300">Показать всё</a>
            </div>

            <div class="grid grid-cols-4 gap-5 mt-14">
                @foreach($bookAll as $book)
                    <a href="{{ route('product', $book->id) }}" class="p-5 border-2 border-[#756CBF]/40 rounded-2xl hover:scale-[1.03] hover:border-[#756CBF] duration-300">                        
                        <div class="w-full flex justify-center mt-5">
                            <img src="{{ asset('images/' . $book->image) }}" alt="" class="w-44 h-64">
                        </div>

                        <p class="text-lg font-semibold mt-5 truncate">{{ $book->name }}</p>
                        <p class="font-light mt-2">{{ $book->author }}</p>
                        <p class="text-2xl font-bold mt-5 text-[#756CBF]">{{ $book->price }} ₽</p>

                        @if(Auth::check())
                            @if($book->availability == '1')
                                <form action="{{ route('booking-submit') }}" method="post">
                                    @csrf

                                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="book_id" id="book_id" value="{{ $book->id }}">
                                    <input type="hidden" name="status" id="status" value="Готова к выдаче">

                                    <button class="w-full p-3 bg-[#756CBF] rounded-xl font-bold text-lg mt-5 hover:opacity-75 duration-300">
                                        Забронировать
                                    </button>
                                </form>

                                @else
                                    <button class="w-full p-3 bg-[#756CBF]/30 rounded-xl font-bold text-lg mt-5 cursor-not-allowed" disabled>
                                        Забронировать
                                    </button>
                            @endif

                            @else
                                <form action="{{ route('login') }}" method="get">
                                    <button class="w-full p-3 bg-[#756CBF] rounded-xl font-bold text-lg mt-5 hover:opacity-75 duration-300">
                                        Забронировать
                                    </button>
                                </form>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection