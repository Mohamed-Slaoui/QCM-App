@extends('layout')

@section('title')
    Students
@endsection

@section('content')
    <h1 class="text-3xl font-medium mb-7">Students</h1>


    <div class="w-full">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-2 py-3">
                        #
                    </th>
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
                    <tr class="bg-white hover:bg-gray-50 hover:cursor-pointer border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $student->user->id }}
                            
                        </th>
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
    </div>
@endsection
