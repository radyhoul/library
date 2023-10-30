@extends('layouts.header')

@section('content')
<form action="{{ route('product-edit-submit', $bookEdit->id) }}" method="post" enctype="multipart/form-data">
    @csrf

    <section>
        <div class="flex mt-24">
            <div class="flex">
                <div class="space-y-3">
                    <img src="{{ asset('images/' . $bookEdit->image) }}" alt="">
                    <input type="file" name="image" id="image">
                </div>

                <div class="ml-10 mt-5 w-[600px]">
                    <input type="text" name="name" class="py-3 px-2 w-full text-lg font-bold mt-5 bg-inherit border border-[#756CBF] outline-none rounded-xl focus:scale-105 duration-300" value="{{ $bookEdit->name }}">

                    <input type="text" name="author" class="py-3 px-2 w-64 font-bold mt-5 bg-inherit border border-[#756CBF] outline-none rounded-xl focus:scale-105 duration-300" value="{{ $bookEdit->author }}">

                    <div class="mt-10 space-y-5 w-[300px]">
                        <div class="flex items-center justify-between">
                            <p class="opacity-75">ID товара</p>
                            <p>{{ $bookEdit->id }}</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <p class="opacity-75">Год издания</p>
                            <input type="text" name="year" class="py-3 px-2 text-center bg-inherit border border-[#756CBF] outline-none rounded-xl focus:scale-105 duration-300" value="{{ $bookEdit->year }}">
                        </div>

                        <div class="flex items-center justify-between">
                            <p class="opacity-75">Жанр</p>
                            <input type="text" name="genre" class="py-3 px-2 text-center bg-inherit border border-[#756CBF] outline-none rounded-xl focus:scale-105 duration-300" value="{{ $bookEdit->genre }}">
                        </div>

                        <div class="flex items-center justify-between">
                            <p class="opacity-75">Количество страниц</p>
                            <input type="text" name="list" class="py-3 px-2 text-center bg-inherit border border-[#756CBF] outline-none rounded-xl focus:scale-105 duration-300" value="{{ $bookEdit->list }}">
                        </div>

                        <div class="flex items-center justify-between">
                            <p class="opacity-75">Возрастные ограничения</p>
                            <input type="text" name="age" class="py-3 px-2 text-center bg-inherit border border-[#756CBF] outline-none rounded-xl focus:scale-105 duration-300" value="{{ $bookEdit->age }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="ml-10 w-96 h-44 p-10 border-2 border-[#756CBF] rounded-3xl">
                <div class="flex items-center text-3xl font-bold space-x-2">
                    <input type="text" name="price" class="py-3 px-2 w-28 bg-inherit border border-[#756CBF] outline-none rounded-xl focus:scale-105 duration-300" value="{{ $bookEdit->price }}">
                    <p>₽</p>
                </div>

                @if($bookEdit->availability == '1')
                    <div class="flex items-center space-x-2 mt-5">
                        <ion-icon name="checkmark-outline" class="w-6 h-6 text-[#756CBF]"></ion-icon>
                        <p>В наличии</p>
                    </div>

                    @else
                    <div class="flex items-center space-x-2 mt-5">
                        <ion-icon name="close-outline" class="w-6 h-6 text-[#756CBF]"></ion-icon>
                        <p>Нету в наличии</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section>
        <div class="mt-10 w-[800px]">
            <textarea name="description" id="" cols="30" rows="20" class="p-5 w-full bg-inherit border border-[#756CBF] outline-none rounded-xl focus:scale-105 duration-300">{{ $bookEdit->description }}</textarea>
        </div>
    </section>

    <div class="flex mt-10 space-x-3">
        <button type="submit" class="p-3 border border-[#756CBF] rounded-xl font-bold hover:bg-[#756CBF] hover:scale-[1.03] duration-300">Сохранить изменения</button>

        <a href="{{ route('product-delete', $bookEdit->id) }}" class="block p-3 border border-red-500 text-red-500 rounded-xl font-bold hover:bg-red-500 hover:text-white hover:scale-[1.03] duration-300">Удалить книгу</a>
    </div>
</form>
@endsection