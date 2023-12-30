@extends('layout')

@section('title')
    Questions
@endsection


@section('content')
    <!-- Main Content -->
    <div class="w-full p-8">

        <section>
            <h2 class="text-2xl font-bold mb-4">QCM Quiz Creation</h2>
            <form>
                <div class="mb-4">
                    <label for="quizName" class="block text-gray-700">Quiz Name</label>
                    <input type="text" id="quizName" name="quizName" class="w-full border p-2">
                </div>
                <div class="mb-4">
                    <label for="selectedQuestions" class="block text-gray-700">Select Questions</label>
                    <select id="selectedQuestions" name="selectedQuestions" multiple class="w-full border p-2">
                        <option value="1">Question 1</option>
                        <option value="2">Question 2</option>
                        <option value="3">Question 3</option>
                        <!-- Add more options dynamically -->
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 rounded text-white font-bold py-2 px-4">Create QCM
                    Quiz</button>
            </form>
        </section>
    </div>
@endsection
