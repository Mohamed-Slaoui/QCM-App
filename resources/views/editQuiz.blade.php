@extends('layout')

@section('title')
    Edit quiz
@endsection


@section('content')
    <!-- Main Content -->
    <div class="w-full xs:space-y-2 flex-col flex justify-center">
        <form action="{{ route('update-qcm',$qcm->id) }}" method="POST" class="">
            @method('PUT')
            @csrf
            <div class="mb-5">
                <label for="question" class="block text-gray-700 font-medium w-32">Quiz Name :</label>
                <input type="text" name="quiz_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ $qcm->quiz_name }}"
                                >
            </div>

            @foreach ($qcm->questions as $index => $question)
                <div class="space-y-2">
                    <div>
                        <label for="question" class="block text-gray-700 font-medium">Question {{ $index + 1 }} :</label>
                        <select name="questions[{{ $index }}][question]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            
                            @foreach ($questions as $q)
                                <option value="{{ $q->id }}" {{ $q->id == $question->id ? "selected" : "" }} >{{ $q->question }}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach ($question->answers as $i => $answer)
                    <div class="space-y-2">
                        <div class="mb-4 flex items-center">
                            <label class=" text-gray-700 font-medium mx-1 w-28">Answer {{ $i + 1 }} :</label>
                            <input type="text" name="questions[{{ $index }}][answers][{{ $i }}][answer]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ $answer->answer }}"
                                >
                            <input type="checkbox" name="questions[{{ $index }}][answers][{{ $i }}][correct]" {{ $answer->isCorrect ? "checked" : "" }} class="w-4 h-4 mx-1 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                    </div>
                    @endforeach
                </div>
            @endforeach

            <button type="submit" class="bg-orange-400 text-white px-4 py-2 rounded-md hover:bg-orange-500">Update</button>
        </form>
    </div>
@endsection
