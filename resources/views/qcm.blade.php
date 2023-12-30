@extends('layout')

@section('title')
    Questions
@endsection


@section('content')
    <main class="ml-1/5 p-4">
        <div class="container mx-auto">

            <h1 class="text-3xl font-semibold mb-4">Create QCM Quiz</h1>

            <!-- QCM Quiz Form -->
            <form action="" method="post">
                @csrf
                <div class="mb-4">
                    <label for="quiz-name" class="block text-gray-700 font-semibold">Quiz Name:</label>
                    <input type="text" name="quiz_name" id="quiz-name" class="w-full px-4 py-2 border rounded-md">
                </div>

                <div id="questions-container">
                    {{--  --}}

                    {{--  --}}
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

        function addQuestion() {
            questionCounter++;

            const container = document.getElementById('questions-container');

            const questionDiv = document.createElement('div');
            questionDiv.innerHTML = `
            <div class="mb-4">
                <label for="question${questionCounter}" class="block text-gray-700 font-semibold">Question ${questionCounter}:</label>
                <select name="questions[${questionCounter}][question]" class="w-full px-4 py-2 border rounded-md">
                    <option value="">-----Select Question-----</option>
                    @foreach ($questions as $q)
                        <option value="{{ $q->id }}">{{ $q->question }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4 flex flex-col">
                <label for="answers${questionCounter}" class="block text-gray-700 font-semibold">Answers:</label>
                <div id="answers${questionCounter}"></div>
                <button type="button" onclick="addAnswer(${questionCounter})" class="bg-blue-500 text-white px-4 py-2 w-40 rounded-md hover:bg-blue-600">Add Answer</button>
            </div>
        `;

            container.appendChild(questionDiv);
        }

        function addAnswer(questionNumber) {
            const answersContainer = document.getElementById(`answers${questionNumber}`);

            const answerDiv = document.createElement('div');
            answerDiv.innerHTML = `
            <div class="pl-6 m-2">
                <label for="answer${questionNumber}_1" class="block text-gray-700 font-semibold">Answer:</label>
                <div class="flex space-x-1 flex-1 items-center">
                    <input type="checkbox" name="questions[${questionNumber}][answers][]" id="answer${questionNumber}_1" class=" py-3 px-3">
                    <input type="text" name="questions[${questionNumber}][options][]" class="w-full px-4 py-1 border rounded-sm">
                </div>
            </div>
        `;

            answersContainer.appendChild(answerDiv);
        }
    </script>
@endsection
