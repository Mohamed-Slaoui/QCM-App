@extends('layout')

@section('title')
    Questions
@endsection


@section('content')
    <!-- Main Content -->
    <div class="w-full p-8">
        <section>
            <h2 class="text-2xl font-bold mb-4">Question Creation</h2>
            <form>
                <div class="mb-4">
                    <label for="question" class="block text-gray-700">Question</label>
                    <input type="text" id="question" name="question" class="w-full border p-2">
                </div>
                <!-- Add more input fields for answers -->
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create
                    Question</button>
            </form>
        </section>

    </div>
@endsection
