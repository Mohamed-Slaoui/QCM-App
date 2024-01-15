@extends('layout')

@section('title')
    Quiz
@endsection

@section('content')
    <h1 class="text-center font-medium text-3xl ">{{ $quiz_data['quiz_name'] }} Quiz</h1>
    @auth
        <form action="{{ route('submit-quiz') }}" method="POST" class="">
            @csrf
            <div class="flex justify-center">
                <div class="mt-6 flex flex-col space-y-5 border rounded border-gray-300 w-3/4 p-2">
                    <div class="flex flex-col gap-1">
                        <div class="p-4 mb-4 text-center text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                            role="alert">
                            @if (Auth::user()->id == 1)
                                <span class="font-medium">As a teacher you cannot pass this quiz</span>
                            @else
                                <span class="font-medium">+1 points for every correct answer</span>
                            @endif
                        </div>

                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="quiz_id" value="{{ $quiz_data['quiz_id'] }}">

                    @foreach ($quiz_data['questions'] as $index => $q)
                        <div class="">

                            <span class="font-light"><span class="font-medium">Question {{ $index + 1 }}:</span>
                                {{ $q['question'] }}
                            </span>

                            @foreach ($q['answers'] as $a)
                                <div class="ml-4">
                                    <input type="checkbox" name="answers[]" value="{{ $a['id'] }}"
                                        {{ Auth::user()->role_id == 1 ? 'disabled' : '' }}
                                        class="w-4 h-4 disabled:cursor-not-allowed text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <span>{{ $a['answer'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                    <div class="flex justify-center">
                        @if (Auth::user()->role_id == 2)
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white w-20 mt-5 py-1 px-2 rounded">
                                Submit
                            </button>
                        @endif
                    </div>

                </div>
            </div>

        </form>
    @endauth
    @guest
        <h1 class="m-2 text-center"></h1>

        <div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300" role="alert">
            <span class="font-medium">Please <a href="{{ route('login') }}" class="underline text-gray-600">Login</a> to pass
                this quiz</span>
        </div>
    @endguest
@endsection
