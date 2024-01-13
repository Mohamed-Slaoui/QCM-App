@extends('layout')
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

    <main class="ml-1/5 p-4">
        <div class="container mx-auto">

            <h1 class="text-3xl font-semibold mb-4">Create QCM Quiz</h1>

            <!-- QCM Quiz Form -->
            <form action="{{ route('store') }}" method="post" class="w-2/3 space-y-3">
                @csrf
                <div class="mb-4">
                    <label for="quiz-name" class="block text-gray-700 font-semibold">Quiz Name:</label>
                    <input type="text" name="quiz_name" id="quiz-name" class="w-full px-4 py-2 border rounded-md">
                </div>

                <div id="questions-container">

                </div>

                <button type="button" onclick="addQuestion()"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add Question</button>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Create
                    Quiz</button>
            </form>

        </div>
    </main>
@endsection

@section('script')
    <script>
        let questionCounter = 0;
        let answerCounter = 0;

        function addQuestion() {
            questionCounter++;

            const container = document.getElementById('questions-container');

            const questionDiv = document.createElement('div');
            questionDiv.innerHTML = `
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Question ${questionCounter}:</label>
                    <select name="questions[${questionCounter}][question]" id="" class="w-full px-4 py-2 border rounded-md">
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
            
            <div class="mb-4 ml-10 flex">
                <input type="text" name="questions[${questionNumber}][answers][${answerCounter}][answer]" class="w-full px-4 py-2 inline border rounded-md">
                
                <div class="flex items-center">
                    <input type="checkbox" name="questions[${questionNumber}][answers][${answerCounter}][correct]" class="inline px-2 mx-1">
                    <p>correct?</p>
                </div>
            </div>
        </div>
    `;

            answersContainer.appendChild(answerDiv);
        }
    </script>
@endsection
