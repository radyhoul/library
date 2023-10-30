@extends('layouts.header')

@section('content')
    <section>
        <div class="mt-24">
            <a href="{{ route('catalog') }}" class="text-5xl font-bold hover:opacity-50 duration-300">Каталог</a>

            <div class="mt-10 flex space-x-5">
                <div class="space-y-5">
                    <div class="p-5 rounded-2xl">
                        <p class="font-bold text-lg">Жанр</p>

                        <ul class="mt-3 space-y-3">
                            <li>
                                <a href="{{ route('catalog', ['genre' => 'Художественная литература']) }}" class="flex items-center w-64 p-3 rounded-xl hover:bg-[#59518C]/50 duration-300">
                                    Художественная литература
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('catalog', ['genre' => 'Фантастика']) }}" class="flex items-center w-64 p-3 rounded-xl hover:bg-[#59518C]/50 duration-300">
                                    Фантастика
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('catalog', ['genre' => 'Образование']) }}" class="flex items-center w-64 p-3 rounded-xl hover:bg-[#59518C]/50 duration-300">
                                    Образование
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('catalog', ['genre' => 'Психология']) }}" class="flex items-center w-64 p-3 rounded-xl hover:bg-[#59518C]/50 duration-300">
                                    Психология
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="p-5 rounded-2xl">
                        <p class="font-bold text-lg">Авторы</p>

                        <ul class="mt-3 space-y-3">
                            @foreach($bookCatalog as $authors)
                                <li>
                                    <a href="{{ route('catalog', ['author' => $authors->author]) }}" class="flex items-center w-64 p-3 rounded-xl hover:bg-[#59518C]/50 duration-300">
                                        {{ $authors->author }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="w-full p-5 rounded-2xl">
                    <div class="grid grid-cols-4 gap-5">
                        @foreach($bookCatalog as $book)
                            <a href="{{ route('product', $book->id) }}" class="p-3 rounded-2xl hover:scale-[1.03] hover:bg-[#59518C]/50 duration-300">                                
                                <div class="w-full flex justify-center mt-5">
                                    <img src="{{ asset('images/' . $book->image) }}" alt="" class="w-28 h-44">
                                </div>

                                <p class="font-semibold mt-5 truncate">{{ $book->name }}</p>
                                <p class="font-light mt-2 truncate">{{ $book->author }}</p>
                                <p class="text-2xl font-bold mt-5">{{ $book->price }} ₽</p>

                                <button class="w-full p-2 bg-[#756CBF] rounded-xl font-bold mt-5 hover:opacity-75 duration-300">Подробнее</button>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection