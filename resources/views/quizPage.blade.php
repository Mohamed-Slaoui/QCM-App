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
                <div class="mt-6 flex flex-col space-y-5 border rounded border-gray-300 w-2/3 p-2">
                    <div class="flex flex-col gap-1">
                        <span class="text-sm text-center text-red-500">
                            {{ $quiz_data['isDone'] == null ? 'You have already taken this quiz' : '+1 points for every correct answer'}}
                        </span>
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
                                    <input type="checkbox" name="answers[]" value="{{ $a['id'] }}"  {{ $quiz_data['isDone'] == null ? 'disabled' : '' }} {{ Auth::user()->role_id == 1 ? "disabled" : ""}}
                                        class="w-4 h-4 disabled:cursor-not-allowed text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <span>{{ $a['answer'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                    @if (Auth::user()->role_id == 2 && !$quiz_data['isDone'] == null )
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white w-20 mt-5 py-1 px-2 rounded">
                            Submit
                        </button>
                    @endif

                </div>
            </div>

        </form>
    @endauth
    @guest
        <h1 class="m-2 text-center">Please <a href="{{ route('login') }}" class="underline text-blue-600">Login</a> to pass this
            quiz</h1>
    @endguest
@endsection
