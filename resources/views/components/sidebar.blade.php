<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-20 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('home') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    
                    <span class="ms-3">Home</span>
                </a>
            </li>

            {{-- ------------------------------------------------------------------------------ --}}


            @auth
                @if (Auth::user()->role_id == 1)
                    <li>
                        <a href=""
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            
                            <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
                        </a>
                    </li>
                @endif
            @endauth

            {{-- ------------------------------------------------------------------------------ --}}

            <li>
                <a href="{{ route('questions') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    
                    <span class="ms-3">Manage Questions</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('create-qcm') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    
                    <span class="ms-3">Create QCM</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
