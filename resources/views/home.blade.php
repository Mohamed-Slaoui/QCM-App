@extends('layout')

@section('title')
    Home
@endsection


@section('content')
    <!-- Page Content -->
    <div class="space-y-5">
        @auth
            @if (Auth::user()->role_id == 1)
                <h1 class="font-medium text-3xl ">Created QCMs</h1>
            @endif
        @endauth
        @guest
            <h1 class="font-medium text-3xl ">All QCMs</h1>
        @endguest
        <div class="flex space-x-1">

            @foreach ($quizzes as $quiz)
                <div
                    class="flex border m-1 flex-col space-y-2 justify-center items-center rounded hover:bg-gray-50 p-2 h-32 w-32 text-center">
                    <a href="{{ route('pass-quiz', $quiz->id) }}" class="">
                        <img src="{{ asset('images/quiz.png') }}" class=" m-1" width="55px" alt="">
                        <h1 class="text-gray-600">{{ $quiz->quiz_name }}</h1>

                        @auth
                            @foreach ($quiz->grades as $grade)
                                @if (Auth::user()->id === $grade->user_id)
                                    <span class="text-xs font-medium">Status: <p class="inline font-light">{{ $grade->isDone ? "Done" : "Undone" }}</p></span>
                                @endif
                            @endforeach
                        @endauth
                    </a>
                </div>
            @endforeach


        </div>
    </div>
@endsection
