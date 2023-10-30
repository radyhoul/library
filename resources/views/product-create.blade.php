@extends('layouts.header')

@section('content')
    <section>
        <div class="mt-14">
            <p class="text-5xl font-bold">Добавление новой книги</p>

            <form action="{{ route('product-create') }}" method="post" class="flex flex-col w-full mt-5 space-y-5" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="availability" value="1">

                <input type="text" name="name" class="py-3 px-5 w-full bg-inherit border border-[#756CBF] outline-none rounded-xl focus:scale-[1.02] duration-300" placeholder="Название">

                <div class="flex items-center space-x-5">
                    <input type="text" name="author" class="py-3 px-5 w-1/2 bg-inherit border border-[#756CBF] outline-none rounded-xl focus:scale-[1.02] duration-300" placeholder="Автор">

                    <input type="text" name="year" class="py-3 px-5 w-1/2 bg-inherit border border-[#756CBF] outline-none rounded-xl focus:scale-[1.02] duration-300" placeholder="Год">

                    <input type="text" name="genre" class="py-3 px-5 w-1/2 bg-inherit border border-[#756CBF] outline-none rounded-xl focus:scale-[1.02] duration-300" placeholder="Жанр">
                </div>

                <div class="flex items-center space-x-5">
                    <input type="text" name="list" class="py-3 px-5 w-1/2 bg-inherit border border-[#756CBF] outline-none rounded-xl focus:scale-[1.02] duration-300" placeholder="Количество страниц">

                    <input type="text" name="age" class="py-3 px-5 w-1/2 bg-inherit border border-[#756CBF] outline-none rounded-xl focus:scale-[1.02] duration-300" placeholder="Возрастное ограничение">

                    <input type="text" name="price" class="py-3 px-5 w-1/2 bg-inherit border border-[#756CBF] outline-none rounded-xl focus:scale-[1.02] duration-300" placeholder="Цена">
                </div>

                <textarea name="description" id="" cols="30" rows="10" class="p-5 w-full bg-inherit border border-[#756CBF] outline-none rounded-xl focus:scale-[1.02] duration-300" placeholder="Описание"></textarea>

                <input type="file" name="image">

                <button class="p-3 border border-[#756CBF] rounded-xl font-bold hover:bg-[#756CBF] hover:scale-[1.03] duration-300 w-44">Добавить книгу</button>
            </form>
        </div>
    </section>
@endsection