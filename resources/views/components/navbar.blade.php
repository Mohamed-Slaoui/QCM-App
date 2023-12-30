        <!-- Navbar -->
        <nav class="bg-gray-800 text-white p-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold">Teacher Workspace</a>
                <div class="">
                    <ul class="space-x-3 flex">
                        @auth
                            @if (Auth::user()->role_id == 1)
                                <li>
                                    <a href="{{ route('questions') }}" class="text-gray-200 hover:text-white">Questions</a>
                                </li>
                                <li>
                                    <a href="{{ route('create-qcm') }}" class="text-gray-200 hover:text-white">Quizzes</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>
                
                <div class="space-x-2">
                    @guest
                        <a href="{{ route('register') }}" class="underline text-gray-300">Register</a>
                        <a href="{{ route('login') }}" class="underline text-gray-300">Login</a>
                    @endguest
                    @auth
                        <a href="{{ route('logout') }}" class="underline text-gray-300">Logout</a>
                    @endauth
                </div>
            </div>
        </nav>
