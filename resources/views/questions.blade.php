@extends('layout')

@section('title')
    Questions
@endsection


@section('content')
    <!-- Main Content -->
    <div class="w-full p-2 space-y-4">
        <section class="border border-gray-500 p-3 border-dashed rounded-lg">
            <h2 class="text-2xl font-bold mb-4">Question Creation</h2>
            <form action="{{ route('create') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="question" class="block text-gray-700">Question</label>
                    <input type="text" id="question" name="question" class="w-full border p-2"
                        value=""
                    >
                    @error('question')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create
                    Question</button>
            </form>
        </section>

        <section class="p-3">
            <h2 class="text-2xl font-bold mb-4">All Questions</h2>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Questions
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $q)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $q->id }}
                            </th>

                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $q->question }}
                            </th>

                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('edit',$q->id) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                {{-- <form action="{{ route('delete', $q->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                    type="submit"
                                    >Delete</button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </section>

    </div>
@endsection
