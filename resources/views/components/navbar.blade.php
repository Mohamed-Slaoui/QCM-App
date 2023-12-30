        <!-- Navbar -->
        <nav class="bg-gray-800 text-white p-4">
            <div class="flex justify-between items-center">
                <a href="route('home')" class="text-2xl font-bold">Teacher Workspace</a>
                <div class="">
                    <ul class="space-x-3 flex">
                        <li>
                            <a href="{{ route('home') }}" class="text-gray-200 hover:text-white">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('questions') }}" class="text-gray-200 hover:text-white">Questions</a>
                        </li>
                        <li>
                            <a href="{{ route('qcm') }}" class="text-gray-200 hover:text-white">QCM Quizzes</a>
                        </li>
                    </ul>
                </div>
                <div class="space-x-2">
                    <a href="{{ route('registerForm') }}" class="underline text-gray-300">Register</a>
                    <a href="{{ route('loginForm') }}" class="underline text-gray-300">Login</a>
                    <a href="{{ route('logout') }}" class="underline text-gray-300">Logout</a>
                </div>
            </div>
        </nav>