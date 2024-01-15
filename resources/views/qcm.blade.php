@extends('layout')
@section('title')
    Mange Quizzes
@endsection

@section('content')
    @if (session('success'))
        <div class="flex items-center p-4 mb-4 text-sm text-green-900 border border-green-900 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="flex flex-col space-y-2 items-center">
        <div class="w-full flex flex-col items-center p-3 border rounded-lg">
            <h2 class="text-2xl font-bold mb-4 text-center">Create QCM Quiz</h2>
            <!-- QCM Quiz Form -->
            <form action="{{ route('store') }}" method="post" class="w-full space-y-3">
                @csrf
                <div class="mb-4">
                    <label for="quiz-name" class="block text-gray-700 font-semibold">Quiz Name:</label>
                    <input type="text" name="quiz_name" id="quiz-name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <div id="questions-container">

                </div>

                <div>
                    <button type="button" onclick="addQuestion()"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add Question</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Create
                        Quiz</button>
                </div>
            </form>
        </div>

        <div class="w-full flex flex-col items-center p-3 border rounded-lg">
            <h2 class="text-2xl font-bold mb-4 text-center">All Quizzes</h2>

            <table class="w-full lg:text-base text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>

                        <th scope="col" class="xs:px-1 lg:px-4 py-3">
                            Quiz Name
                        </th>

                        <th scope="col" class="xs:px-1 lg:px-4 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $q)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">

                            <th scope="row"
                                class="xs:px-1 lg:px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $q->quiz_name }}
                            </th>

                            <td class="xs:px-1 lg:px-4 py-4 space-x-3 flex">
                                <a href="{{ route('edit-qcm', $q->id) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    
                                <form action="{{ route('delete', $q->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                        type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let questionCounter = 0;
        let answerCounter = 0;

        function addQuestion() {
            questionCounter++;
            answerCounter = 0;
            const container = document.getElementById('questions-container');

            const questionDiv = document.createElement('div');
            questionDiv.innerHTML = `
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Question ${questionCounter}:</label>
                    <select name="questions[${questionCounter}][question]" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">----select a question-----</option>
                            @foreach ($questions as $q)
                                <option value="{{ $q->id }}">{{ $q->question }}</option>
                            @endforeach
                        </select>
                </div>

                <div class="mb-4">
                    <label for="answers${questionCounter}" class="block text-gray-700 font-semibold">Answers:</label>
                    <div id="answers${questionCounter}"></div>
                    <button type="button" onclick="addAnswer(${questionCounter})" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add Answer</button>
                </div>
    `;

            container.appendChild(questionDiv);
        }

        function addAnswer(questionNumber) {
            answerCounter++;
            const answersContainer = document.getElementById(`answers${questionNumber}`);
            const answerDiv = document.createElement('div');
            answerDiv.innerHTML = `
        <div class="ml-4">
            <h1>Answer ${answerCounter}</h1>
            
            <div class="mb-4 ml-4 space-x-2 flex w-full">
                <input type="text" name="questions[${questionNumber}][answers][${answerCounter}][answer]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                
                <div class="flex items-center">
                    <input type="checkbox" name="questions[${questionNumber}][answers][${answerCounter}][correct]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <p class="mb-1 pl-1">correct?</p>
                </div>
            </div>
        </div>
    `;

            answersContainer.appendChild(answerDiv);
        }
    </script>
@endsection
