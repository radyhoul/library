@extends('layouts.header')

@section('content')
    <section>
        <div class="flex mt-24">
            <div class="flex">
                <img src="{{ asset('images/' . $book->image) }}" alt="">

                <div class="ml-10 mt-5 w-[600px]">
                    <a href="" class="font-bold flex items-center hover:opacity-50 duration-300">
                        <ion-icon name="chatbox-ellipses-outline" class="w-6 h-6 text-[#756CBF] mr-2"></ion-icon>
                        {{ $feedbacks->count() }}
                    </a>

                    <p class="text-3xl font-bold mt-5">{{ $book->name }}</p>

                    <a href="{{ route('catalog', ['author' => $book->author]) }}" class="block text-[#756CBF] font-bold hover:opacity-50 duration-300 mt-3 w-full">{{ $book->author }}</a>

                    <div class="mt-10 space-y-5 w-[300px]">
                        <div class="flex items-center justify-between">
                            <p class="opacity-75">ID товара</p>
                            <p>{{ $book->id }}</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <p class="opacity-75">Год издания</p>
                            <p>{{ $book->year }}</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <p class="opacity-75">Жанр</p>
                            <p>{{ $book->genre }}</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <p class="opacity-75">Количество страниц</p>
                            <p>{{ $book->list }}</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <p class="opacity-75">Возрастные ограничения</p>
                            <p>{{ $book->age }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ml-10 w-96 h-60 p-10 border-2 border-[#756CBF] rounded-3xl">
                <p class="text-3xl font-bold">{{ $book->price }} ₽</p>

                <div class="flex items-center space-x-3 mt-8">
                    @if(Auth::check())
                        @if($book->availability == '1')
                            <form action="{{ route('booking-submit') }}" method="post" class="w-full">
                                @csrf
                                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="book_id" id="book_id" value="{{ $book->id }}">
                                <input type="hidden" name="status" id="status" value="Готова к выдаче">

                                <button class="flex items-center justify-center p-3 w-full bg-[#756CBF] rounded-2xl font-bold hover:opacity-75 duration-300">
                                    Забронировать
                                </button>
                            </form>
                            @else
                            <button class="flex items-center justify-center p-3 w-full bg-[#756CBF]/30 rounded-2xl font-bold cursor-not-allowed" disabled>
                                Забронировать
                            </button>
                        @endif

                        @else
                        <form action="{{ route('login') }}" method="get" class="w-full">
                            <button class="flex items-center justify-center p-3 w-full bg-[#756CBF] rounded-2xl font-bold hover:opacity-75 duration-300">
                                Забронировать
                            </button>
                        </form>
                    @endif
                </div>

                @if($book->availability == '1')
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
            <p>{!! nl2br(e(strip_tags($book->description))) !!}</p>
        </div>
    </section>

    <section class="mt-20">
        <div class="space-y-7">
            @if(count($feedbacks) > 0)
            <div class="flex items-center space-x-3">
                <p class="text-4xl font-bold">Отзывы {{ $feedbacks->count() }}</p>


                @if(Auth::check())
                    <a href="" class="p-3 border border-[#756CBF] rounded-xl font-bold hover:bg-[#756CBF] hover:scale-105 duration-300" data-te-toggle="modal" data-te-target="#exampleModalFeedback">Оставить отзыв</a>

                    @else
                        <a href="{{ route('login') }}" class="p-3 border border-[#756CBF] rounded-xl font-bold hover:bg-[#756CBF] hover:scale-105 duration-300">Оставить отзыв</a>
                @endif
            </div>
                @foreach($feedbacks as $feedback)
                    <div class="w-2/3 p-10 bg-[#756CBF]/30 rounded-2xl">
                        <div class="flex items-center justify-between">
                            <p class="font-bold">{{ $feedback->username }}</p>

                            <p class="text-sm opacity-50">{{ $feedback->created_at }}</p>
                        </div>

                        <div class="mt-5">
                            <p class="text-2xl font-bold">{{ $feedback->title }}</p>

                            <p class="font-light mt-3">{!! nl2br(e(strip_tags($feedback->message))) !!}</p>
                        </div>

                        @if(Auth::check())
                            @if(Auth::user()->role == '3')
                                <a href="{{ route('feedback-delete', $feedback->id) }}" class="w-40 flex items-center justify-center p-2 mt-5 border border-red-500 text-red-500 rounded-xl font-bold hover:bg-red-500 hover:text-white hover:scale-[1.03] duration-300">Удалить отзыв</a>
                            @endif
                        @endif
                    </div>
                @endforeach

            @else
                <div class="flex space-x-5">
                    <div class="w-64 h-64 rounded-full overflow-hidden">
                        <img src="{{ asset('image/feedback.svg') }}" alt="" class="w-full ">
                    </div>

                    <div class="">
                        <p class="text-4xl font-bold uppercase">Оставьте отзыв первым</p>

                        <p class="opacity-50 mt-5">Это поможет другим покупателям сделать правильный выбор.</p>

                        @if(Auth::check())
                        <a href="" class="mt-5 flex items-center justify-center w-40 p-3 border border-[#756CBF] rounded-xl font-bold hover:bg-[#756CBF] hover:scale-105 duration-300" data-te-toggle="modal" data-te-target="#exampleModalFeedback">Оставить отзыв</a>

                            @else
                                <a href="{{ route('login') }}" class="mt-5 flex items-center justify-center w-40 p-3 border border-[#756CBF] rounded-xl font-bold hover:bg-[#756CBF] hover:scale-105 duration-300">Оставить отзыв</a>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        @if(Auth::check())
            <div data-te-modal-init class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="exampleModalFeedback" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
                <div data-te-modal-dialog-ref class="pointer-events-none relative flex min-h-[calc(100%-1rem)] translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[576px]">
                    <div class="pointer-events-auto relative flex w-full flex-col rounded-2xl border-none bg-[#59518C]/60 shadow-2xl backdrop-blur-xl">
                        <div class="flex items-center justify-between p-4">
                            <p class="text-2xl font-medium" id="exampleModalCenterTitle">Отзыв к книге «{{ $book->name }}»</p>

                            <button type="button" class="hover:opacity-75 duration-300" data-te-modal-dismiss aria-label="Close">
                                <ion-icon name="close-outline" class="w-7 h-7"></ion-icon>
                            </button>
                        </div>

                        <div class="relative p-4">
                            <form action="{{ route('feedback-create') }}" method="post" class="w-full space-y-4">
                                @csrf

                                <input type="hidden" name="book_id" value="{{ $book->id }}">

                                <input type="text" class="w-full h-12 bg-[#756CBF] pl-3 font-bold rounded-xl outline-none focus:scale-[1.03] duration-300" name="username" value="{{ Auth::user()->name }}" required placeholder="Имя">
                                <input type="text" class="w-full h-12 bg-[#756CBF] pl-3 font-bold rounded-xl outline-none focus:scale-[1.03] duration-300" name="title" required placeholder="Заголовок">
                                <textarea name="message" cols="30" rows="10" class="w-full bg-[#756CBF] p-5 font-bold rounded-xl outline-none focus:scale-[1.03] duration-300" placeholder="Ну как вам? Что понравилось, а что не очень?"></textarea>

                                <button type="submit" class="p-2 text-lg font-bold border-2 border-[#756CBF] text-[#756CBF] rounded-2xl hover:bg-[#756CBF] hover:text-white hover:scale-105 duration-300">
                                    Отправить
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection