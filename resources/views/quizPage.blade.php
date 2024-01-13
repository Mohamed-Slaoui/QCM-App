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
                @foreach ($quiz_data['questions'] as $index => $q)
                <div class="">

                        <input type="hidden" name="questions[{{ $index }}][question]" value="{{ $q['question'] }}">


                        <span class="font-light"><span class="font-medium">Question {{ $index + 1 }}:</span>
                            {{ $q['question'] }}</span>
                        @foreach ($q['answers'] as $a)
                            <div class="ml-4">
                                <input type="checkbox" name="questions[{{ $index }}][answers][]" value="{{ $a['id'] }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <span>{{ $a['answer'] }}</span>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <button 
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white w-20 mt-5 py-1 px-2 rounded">
                        Submit
                </button>
            </div>
        </div>

    </form>
    @endauth
    @guest
        <h1 class="m-2 text-center">Please <a href="{{ route('login') }}" class="underline text-blue-600" >Login</a> to pass this quiz</h1>
    @endguest
@endsection
