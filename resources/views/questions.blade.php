@extends('layout')

@section('title')
    Questions
@endsection


@section('content')
    <!-- Main Content -->
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
    
    <div class="w-full xs:space-y-2 flex-col flex justify-center">

        <section class="border xs:w-full w-1/3 h-fit p-3 rounded-lg">
            <h2 class="text-2xl font-bold mb-4 text-center">Question Creation</h2>
            <form action="{{ isset($question) ? route('update', $question->id) : route('create') }}" method="POST">
                @csrf
                @if (isset($question))
                    @method('PUT')
                @endif
                <div class="mb-4">
                    <label for="question" class="block text-gray-700">Question</label>
                    <input type="text" id="question" name="question" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ isset($question) ? $question->question : '' }}">
                    @error('question')
                        <p class="text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ isset($question) ? 'Edit' : 'Create' }}</button>
            </form>
        </section>

        <section class="border lg:p-3 rounded-lg">
            <h2 class="text-2xl font-bold mb-4 text-center">All Questions</h2>
            
            <table class="w-full lg:text-base xs:text-xs text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>

                        <th scope="col" class="xs:px-1 lg:px-4 py-3">
                            Questions
                        </th>

                        <th scope="col" class="xs:px-1 lg:px-4 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $q)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">

                            <th scope="row"
                                class="xs:px-1 lg:px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $q->question }}
                            </th>

                            <td class="xs:px-1 lg:px-4 py-4 space-x-3 flex">
                                <a href="{{ route('edit', $q->id) }}"
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

        </section>

    </div>
@endsection
