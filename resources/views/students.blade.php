@extends('layout')

@section('title')
    Students
@endsection

@section('content')
    <h1 class="text-3xl font-medium">Students</h1>


    <div class="w-full">
        <div class="mb-6 mt-3">
            <hr class="mb-1">
            <a href="{{ route('students') }}" class="mr-1">
                
                <kbd class="px-2 py-1.5 hover:bg-gray-200 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">all</kbd>
            </a>
            @foreach ($quizzes as $q)
                <a href="{{ route('filter', $q->id) }}">
                    <kbd
                        class="px-2 py-1.5 hover:bg-gray-200 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">{{ $q->quiz_name }}</kbd>
                </a>
            @endforeach
            <hr class="mt-2.5">
        </div>
        @if (count($students))
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-2 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Quiz
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Grade
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr
                            class="bg-white hover:bg-gray-50 hover:cursor-pointer border-b dark:bg-gray-800 dark:border-gray-700">

                            <td class="px-2 py-4">
                                {{ $student->user->name }}
                            </td>
                            <td class="px-2 py-4">
                                {{ $student->user->email }}
                            </td>
                            <td class="px-2 py-4">
                                {{ $student->quiz->quiz_name }}
                            </td>
                            <td class="px-2 py-4">
                                {{ $student->grade }} pts
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @else
            <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">No one have taken this quiz yet !</span>
                </div>
            </div>
        @endif
    </div>
@endsection
