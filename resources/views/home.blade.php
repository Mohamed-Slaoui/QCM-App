@extends('layout')

@section('title')
    Home
@endsection


@section('content')
    <!-- Page Content -->
    <div class="flex space-x-1">
        @foreach ($quizzes as $quiz)
            <a href="{{ route('pass-quiz', $quiz->id) }}"
                class="m-1 border flex flex-col space-y-2 justify-center items-center rounded hover:bg-gray-50 p-2 h-32 w-32 text-center">
                <img src="{{ asset('images/quiz.png') }}" class=" m-1" width="55px" alt="">
                <h1 class="text-gray-600">{{ $quiz->quiz_name }}</h1>
            </a>
        @endforeach
    </div>
@endsection
