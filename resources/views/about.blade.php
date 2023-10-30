@extends('layouts.header')

@section('content')
    <section>
        <div class="mt-24">
            <p class="text-5xl font-bold">О нас</p>

            <div class="flex mt-10 space-x-10">
                <div class="p-5 bg-[#59518C] rounded-2xl w-[640px]">
                    <img src="{{ asset('image/about.svg') }}" alt="" class="w-full">
                </div>

                <div class="w-[640px]">
                    <p class="text-lg"><span class="text-[#756CBF] text-2xl">Library</span> - команда энтузиастов, преданная распространению знаний и вдохновению через 
                    мир слов. Наша библиотека - это не просто сборник книг, это место, где вы можете 
                    открывать миры, путешествовать во времени, учиться и расти.</p>

                    <p class="mt-5 text-2xl font-bold text-[#756CBF]">Что нас отличает</p>

                    <div class="mt-5 w-full space-y-3">
                        <div class="flex space-x-3">
                            <div class="p-4 bg-[#59518C] rounded-xl w-full space-y-2 hover:scale-[1.03] duration-300">
                                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-[#756CBF]">
                                    <p class="font-bold text-2xl">1</p>
                                </div>

                                <p class="font-bold">Богатый выбор литературы</p>

                                <p class="font-light">Широкий спектр книг в различных жанрах</p>
                            </div>

                            <div class="p-4 bg-[#59518C] rounded-xl w-full space-y-2 hover:scale-[1.03] duration-300">
                                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-[#756CBF]">
                                    <p class="font-bold text-2xl">2</p>
                                </div>

                                <p class="font-bold">Удобство и доступность</p>

                                <p class="font-light">Вы можете легко найти и оформить книги</p>
                            </div>
                        </div>

                        <div class="flex space-x-3">
                            <div class="p-4 bg-[#59518C] rounded-xl w-full space-y-2 hover:scale-[1.03] duration-300">
                                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-[#756CBF]">
                                    <p class="font-bold text-2xl">3</p>
                                </div>

                                <p class="font-bold">Современный подход к чтению</p>

                                <p class="font-light">Мы предлагаем электронные книги в различных форматах</p>
                            </div>

                            <div class="p-4 bg-[#59518C] rounded-xl w-full space-y-2 hover:scale-[1.03] duration-300">
                                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-[#756CBF]">
                                    <p class="font-bold text-2xl">4</p>
                                </div>

                                <p class="font-bold">Сообщество и рекомендации</p>

                                <p class="font-light">У нас вы найдете интересные книги и сможете обсудить</p>
                            </div>
                        </div>
                    </div>

                    <p class="text-lg mt-5"><span class="text-[#756CBF] text-2xl">Наша миссия</span> - сделать знание доступным для каждого. Мы надеемся, что наши книги 
                    станут для вас не только окном в другие миры, но и источником вдохновения и 
                    обогащения вашего духа. Добро пожаловать в нашу библиотеку, где приключения 
                    начинаются с каждой страницы!</p>
                </div>
            </div>
        </div>
    </section>
@endsection