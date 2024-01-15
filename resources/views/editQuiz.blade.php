@extends('layout')

@section('title')
    Edit quiz
@endsection


@section('content')
    <!-- Main Content -->
    <div class="w-full xs:space-y-2 flex-col flex justify-center">
        <form action="{{ route('submit-quiz') }}" method="POST" class="">
            @csrf
            @foreach ($qcm->questions as $index => $question)
                <div class="space-y-2">
                    <div>
                        <label for="question" class="block text-gray-700 font-medium">Question {{ $index + 1 }} :</label>
                        <select name="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            
                            @foreach ($questions as $q)
                                <option value="{{ $q->id }}" {{ $q->id == $question->id ? "selected" : "" }} >{{ $q->question }}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach ($question->answers as $i => $answer)
                    <div class="space-y-2">
                        <div class="mb-4 flex items-center">
                            <label class=" text-gray-700 font-medium mx-1 w-24">Answer {{ $i + 1 }} :</label>
                            <input type="text" name=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ $answer->answer }}"
                                >
                        </div>
                    </div>
                    @endforeach
                </div>
            @endforeach

            <button type="submit" class="bg-orange-400 text-white px-4 py-2 rounded-md hover:bg-orange-500">Update</button>
        </form>
    </div>
@endsection
