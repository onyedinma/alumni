<nav class="h-20 bg-[#111111] border-b border-[#27272a] flex items-center justify-between px-8 z-30">
    <!-- Left: Mobile Menu Trigger -->
    <div class="flex items-center">
        <button class="md:hidden text-gray-400 hover:text-white p-2">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <a href="{{ route('alumni.list-search-with-filter') }}"
            class="hidden md:flex items-center bg-[#27272a] hover:bg-[#3f3f46] text-gray-300 px-4 py-2 rounded-lg text-sm font-medium transition-colors ml-4 border border-[#3f3f46]">
            <i class="fas fa-search mr-2"></i> {{ __('Find an Alumni') }}
        </a>
    </div>

    <!-- Right Top Bar -->
    <div class="flex items-center space-x-6">

        <!-- Notifications -->
        <div class="dropdown relative">
            <button class="text-gray-400 hover:text-white transition-colors relative" type="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bell text-xl"></i>
                @if(count(userNotification('unseen')) > 0)
                    <span
                        class="absolute -top-2 -right-2 bg-red-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border border-[#111111]">
                        {{ count(userNotification('unseen')) }}
                    </span>
                @endif
            </button>
            <ul
                class="dropdown-menu absolute right-0 mt-2 w-80 bg-[#1a1a1a] border border-[#27272a] rounded-xl shadow-2xl py-2 text-gray-300 z-50 hidden">
                <li class="px-4 py-3 border-b border-[#27272a] flex justify-between items-center">
                    <span class="font-semibold text-white">{{ __('Notifications') }}</span>
                    @if (count(userNotification('unseen')) > 0)
                        <a href="{{ route('notification.notification-mark-all-as-read') }}"
                            class="text-xs text-blue-400 hover:text-blue-300">{{ __('Mark all read') }}</a>
                    @endif
                </li>
                @foreach (userNotification('unseen') as $key => $item)
                    <li>
                        <a href="{{ route('notification.notification-mark-as-read', $item->id) }}"
                            class="block px-4 py-3 hover:bg-[#27272a] transition-colors">
                            <p class="text-sm font-medium text-white">{{ $item->title }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $item->body }}</p>
                        </a>
                    </li>
                @endforeach
                @if(count(userNotification('unseen')) == 0)
                    <li class="px-4 py-6 text-center text-gray-500 text-sm">{{ __('No new notifications') }}</li>
                @endif
            </ul>
        </div>

        <!-- User Profile -->
        <div class="dropdown relative">
            <button class="flex items-center space-x-3 focus:outline-none" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <div class="text-right hidden sm:block">
                    <p class="text-xs text-gray-500">{{ __('Welcome back') }}</p>
                    <p class="text-sm font-bold text-white">{{ auth()->user()->name }}</p>
                </div>
                <img class="h-10 w-10 rounded-full border-2 border-[#27272a] object-cover"
                    src="{{ asset(getFileUrl(auth()->user()->image)) }}" alt="{{ auth()->user()->name }}" />
            </button>
            <ul
                class="dropdown-menu absolute right-0 mt-4 w-48 bg-[#1a1a1a] border border-[#27272a] rounded-xl shadow-xl py-1 text-gray-300 z-50 hidden">
                <li>
                    <a href="{{ route('profile') }}"
                        class="flex items-center px-4 py-2 hover:bg-[#27272a] text-sm text-gray-300 hover:text-white">
                        <i class="fas fa-user-circle mr-3"></i> {{ __('Profile') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('settings') }}"
                        class="flex items-center px-4 py-2 hover:bg-[#27272a] text-sm text-gray-300 hover:text-white">
                        <i class="fas fa-cog mr-3"></i> {{ __('Settings') }}
                    </a>
                </li>
                <li class="border-t border-[#27272a] my-1"></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="flex items-center px-4 py-2 hover:bg-[#27272a] text-sm text-red-500 hover:text-red-400">
                        <i class="fas fa-sign-out-alt mr-3"></i> {{ __('Logout') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>