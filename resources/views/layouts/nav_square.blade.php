<nav
    class="h-20 bg-[var(--bg-surface,#12161C)] border-b border-[var(--gold,#D4AF5A)] flex items-center justify-between px-8 z-30 shadow-lg">
    <!-- Left: Mobile Menu Trigger -->
    <div class="flex items-center">
        <button class="md:hidden text-gray-400 hover:text-[var(--gold,#D4AF5A)] p-2 transition-colors">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <a href="{{ route('alumni.list-search-with-filter') }}"
            class="hidden md:flex items-center bg-gradient-to-r from-[var(--gold,#D4AF5A)] to-[#b8934a] hover:from-[#e3c16e] hover:to-[#c4a159] text-black px-6 py-2.5 rounded-lg text-sm font-semibold transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
            <i class="fas fa-search mr-2"></i> {{ __('Find an Alumni') }}
        </a>
    </div>

    <!-- Right Top Bar -->
    <div class="flex items-center space-x-6">

        <!-- Notifications -->
        <div class="dropdown relative">
            <button class="text-gray-400 hover:text-[var(--gold,#D4AF5A)] transition-colors relative" type="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bell text-xl"></i>
                @if(count(userNotification('unseen')) > 0)
                    <span
                        class="absolute -top-2 -right-2 bg-[var(--maroon,#8B2635)] text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border border-[var(--bg-surface,#12161C)]">
                        {{ count(userNotification('unseen')) }}
                    </span>
                @endif
            </button>
            <ul
                class="dropdown-menu absolute right-0 mt-2 w-80 bg-[var(--bg-surface,#12161C)] border border-[var(--gold,#D4AF5A)] rounded-xl shadow-2xl py-2 text-gray-300 z-50 hidden">
                <li class="px-4 py-3 border-b border-[var(--border-dark,#1F2630)] flex justify-between items-center">
                    <span class="font-semibold text-[var(--gold,#D4AF5A)]">{{ __('Notifications') }}</span>
                    @if (count(userNotification('unseen')) > 0)
                        <a href="{{ route('notification.notification-mark-all-as-read') }}"
                            class="text-xs text-[var(--gold,#D4AF5A)] hover:text-[var(--maroon,#8B2635)]">{{ __('Mark all read') }}</a>
                    @endif
                </li>
                @foreach (userNotification('unseen') as $key => $item)
                    <li>
                        <a href="{{ route('notification.notification-mark-as-read', $item->id) }}"
                            class="block px-4 py-3 hover:bg-[var(--bg-elevated,#171C23)] transition-colors">
                            <p class="text-sm font-medium text-[var(--text-primary,#E6EAF0)]">{{ $item->title }}</p>
                            <p class="text-xs text-[var(--text-secondary,#B4BCC8)] mt-1">{{ $item->body }}</p>
                        </a>
                    </li>
                @endforeach
                @if(count(userNotification('unseen')) == 0)
                    <li class="px-4 py-6 text-center text-[var(--text-secondary,#B4BCC8)] text-sm">
                        {{ __('No new notifications') }}</li>
                @endif
            </ul>
        </div>

        <!-- User Profile -->
        <div class="dropdown relative">
            <button class="flex items-center space-x-3 focus:outline-none hover:opacity-90 transition-opacity"
                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="text-right hidden sm:block">
                    <p class="text-xs text-[var(--text-secondary,#B4BCC8)]">{{ __('Welcome back') }}</p>
                    <p class="text-sm font-bold text-[var(--gold,#D4AF5A)]">{{ auth()->user()->name }}</p>
                </div>
                <img class="h-10 w-10 rounded-full border-2 border-[var(--gold,#D4AF5A)] object-cover shadow-lg"
                    src="{{ asset(getFileUrl(auth()->user()->image)) }}" alt="{{ auth()->user()->name }}" />
            </button>
            <ul
                class="dropdown-menu absolute right-0 mt-4 w-48 bg-[var(--bg-surface,#12161C)] border border-[var(--gold,#D4AF5A)] rounded-xl shadow-xl py-1 text-gray-300 z-50 hidden">
                <li>
                    <a href="{{ route('profile') }}"
                        class="flex items-center px-4 py-2 hover:bg-[var(--bg-elevated,#171C23)] text-sm text-[var(--text-primary,#E6EAF0)] hover:text-[var(--gold,#D4AF5A)]">
                        <i class="fas fa-user-circle mr-3"></i> {{ __('Profile') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('settings') }}"
                        class="flex items-center px-4 py-2 hover:bg-[var(--bg-elevated,#171C23)] text-sm text-[var(--text-primary,#E6EAF0)] hover:text-[var(--gold,#D4AF5A)]">
                        <i class="fas fa-cog mr-3"></i> {{ __('Settings') }}
                    </a>
                </li>
                <li class="border-t border-[var(--border-dark,#1F2630)] my-1"></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="flex items-center px-4 py-2 hover:bg-[var(--bg-elevated,#171C23)] text-sm text-[var(--maroon,#8B2635)] hover:text-red-400">
                        <i class="fas fa-sign-out-alt mr-3"></i> {{ __('Logout') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>