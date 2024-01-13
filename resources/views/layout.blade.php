<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>@yield('title')</title>
</head>

<body>
    @include('components.navbar')
    @include("components.sidebar")

    <div class="px-[3%] py-3 sm:ml-64">
        <div class="p-4 border-2 h-fit border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            @yield('content')
        </div>
    </div>

    @yield('script')
</body>

</html>
