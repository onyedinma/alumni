<!-- Sidebar -->
<aside class="w-72 bg-[#111111] border-r border-[#27272a] hidden md:flex flex-col h-full flex-shrink-0">
    <!-- Logo -->
    <div class="h-20 flex items-center px-8 border-b border-[#27272a]">
        <a href="{{ route('index') }}" class="block">
            @if(centralDomain() && isAddonInstalled('ALUSAAS'))
                <img class="h-10 w-auto" src="{{ getSettingImageCentral('app_logo') }}" alt="{{ getOption('app_name') }}" />
            @else
                <img class="h-10 w-auto" src="{{ getSettingImage('app_logo') }}" alt="{{ getOption('app_name') }}" />
            @endif
        </a>
    </div>

    <!-- Menu -->
    <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1 scrollbar-thin scrollbar-thumb-gray-800">
        <ul class="space-y-2">
            @if (auth()->user()->role == USER_ROLE_ADMIN)
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors {{ isset($activeDashboard) ? 'bg-[#27272a] text-white' : '' }}">
                        <i class="fas fa-th-large text-lg w-6"></i>
                        <span class="ml-3 font-medium">{{ __('Dashboard') }}</span>
                    </a>
                </li>
            @endif

            @if(!isCentralDomain() || !isAddonInstalled('ALUSAAS'))
                <li>
                    <a href="{{ route('home') }}"
                        class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors {{ isset($activeHome) ? 'bg-[#27272a] text-white' : '' }}">
                        <i class="fas fa-home text-lg w-6"></i>
                        <span class="ml-3 font-medium">{{ __('Home') }}</span>
                    </a>
                </li>

                <!-- My Event -->
                <li>
                    <a href="#myEventSquare" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ isset($showEvent) ? 'true' : 'false' }}" aria-controls="myEventSquare"
                        class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors justify-between group {{ isset($showEvent) ? 'bg-[#27272a] text-white' : '' }}">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt text-lg w-6"></i>
                            <span class="ml-3 font-medium">{{ __('My Event') }}</span>
                        </div>
                        <i class="fas fa-chevron-right text-xs transition-transform group-aria-expanded:rotate-90"></i>
                    </a>
                    <div class="collapse {{ $showEvent ?? '' }}" id="myEventSquare">
                        <ul class="pl-11 mt-1 space-y-1">
                            @if (auth()->user()->role == USER_ROLE_ADMIN)
                                <li><a href="{{ route('admin.event.category.index') }}"
                                        class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Event Category') }}</a>
                                </li>
                                <li><a href="{{ route('admin.event.pending.index') }}"
                                        class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Pending Event') }}</a>
                                </li>
                            @endif
                            <li><a href="{{ route('event.create') }}"
                                    class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Create Event') }}</a>
                            </li>
                            <li><a href="{{ route('event.my-event') }}"
                                    class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('My Event') }}</a></li>
                            <li><a href="{{ route('event.all') }}"
                                    class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('All Event') }}</a></li>
                            <li><a href="{{ route('event.my-ticket') }}"
                                    class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('My Ticket') }}</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Job Post -->
                <li>
                    <a href="#jobPostSquare" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ isset($showJobPostManagement) ? 'true' : 'false' }}" aria-controls="jobPostSquare"
                        class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors justify-between group {{ isset($showJobPostManagement) ? 'bg-[#27272a] text-white' : '' }}">
                        <div class="flex items-center">
                            <i class="fas fa-briefcase text-lg w-6"></i>
                            <span class="ml-3 font-medium">{{ __('Job Post') }}</span>
                        </div>
                        <i class="fas fa-chevron-right text-xs transition-transform group-aria-expanded:rotate-90"></i>
                    </a>
                    <div class="collapse {{ $showJobPostManagement ?? '' }}" id="jobPostSquare">
                        <ul class="pl-11 mt-1 space-y-1">
                            <li><a href="{{ route('jobPost.create') }}"
                                    class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Create Post') }}</a>
                            </li>
                            @if (auth()->user()->role == USER_ROLE_ADMIN)
                                <li><a href="{{ route('admin.jobPost.pending-job-post') }}"
                                        class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Pending Post') }}</a>
                                </li>
                            @endif
                            <li><a href="{{ route('jobPost.my-job-post') }}"
                                    class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('My Post') }}</a></li>
                            <li><a href="{{ route('jobPost.all-job-post') }}"
                                    class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('All Post') }}</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Stories -->
                <li>
                    <a href="#storyMenuSquare" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ isset($showStoryManagement) ? 'true' : 'false' }}" aria-controls="storyMenuSquare"
                        class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors justify-between group {{ isset($showStoryManagement) ? 'bg-[#27272a] text-white' : '' }}">
                        <div class="flex items-center">
                            <i class="fas fa-book-open text-lg w-6"></i>
                            <span class="ml-3 font-medium">{{ __('Stories') }}</span>
                        </div>
                        <i class="fas fa-chevron-right text-xs transition-transform group-aria-expanded:rotate-90"></i>
                    </a>
                    <div class="collapse {{ $showStoryManagement ?? '' }}" id="storyMenuSquare">
                        <ul class="pl-11 mt-1 space-y-1">
                            <li><a href="{{ route('stories.create') }}"
                                    class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Create Story') }}</a>
                            </li>
                            @if (auth()->user()->role == USER_ROLE_ADMIN)
                                <li><a href="{{ route('admin.stories.pending') }}"
                                        class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Pending Story') }}</a>
                                </li>
                            @endif
                            <li><a href="{{ route('stories.my-story') }}"
                                    class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('My Story') }}</a></li>
                            <li><a href="{{ route('all.stories') }}"
                                    class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('All Story') }}</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Alumni -->
                <li>
                    <a href="{{ route('alumni.list-search-with-filter') }}"
                        class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors {{ isset($activeAlumniList) ? 'bg-[#27272a] text-white' : '' }}">
                        <i class="fas fa-user-graduate text-lg w-6"></i>
                        <span class="ml-3 font-medium">{{ __('Alumni') }}</span>
                    </a>
                </li>

                @if (auth()->user()->role == USER_ROLE_ADMIN)
                    <!-- Donation Campaigns -->
                    <li>
                        <a href="{{ route('admin.donation-campaigns.index') }}"
                            class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors {{ isset($activeDonationCampaign) ? 'bg-[#27272a] text-white' : '' }}">
                            <i class="fas fa-hand-holding-heart text-lg w-6"></i>
                            <span class="ml-3 font-medium">{{ __('Donation Campaigns') }}</span>
                        </a>
                    </li>
                @endif

                <!-- Membership -->
                <li>
                    <a href="{{ route('membership-package') }}"
                        class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors {{ isset($activeMembershipPack) ? 'bg-[#27272a] text-white' : '' }}">
                        <i class="fas fa-id-card text-lg w-6"></i>
                        <span class="ml-3 font-medium">{{ __('Membership') }}</span>
                    </a>
                </li>

                <!-- Messages -->
                <li>
                    <a href="{{ route('chats.index') }}"
                        class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors {{ isset($activeMessage) ? 'bg-[#27272a] text-white' : '' }}">
                        <i class="fas fa-comment-alt text-lg w-6"></i>
                        <span class="ml-3 font-medium">{{ __('Messages') }}</span>
                    </a>
                </li>

                <!-- Transaction List -->
                <li>
                    <a href="{{ route('transaction.list') }}"
                        class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors {{ isset($activeTransactionList) ? 'bg-[#27272a] text-white' : '' }}">
                        <i class="fas fa-list-alt text-lg w-6"></i>
                        <span class="ml-3 font-medium">{{ __('Transaction List') }}</span>
                    </a>
                </li>

                <!-- Profile -->
                <li>
                    <a href="{{ route('profile') }}"
                        class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors {{ isset($activeProfile) ? 'bg-[#27272a] text-white' : '' }}">
                        <i class="fas fa-user text-lg w-6"></i>
                        <span class="ml-3 font-medium">{{ __('Profile') }}</span>
                    </a>
                </li>

                <!-- Settings -->
                <li>
                    <a href="{{ route('settings') }}"
                        class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors {{ isset($activeSettings) ? 'bg-[#27272a] text-white' : '' }}">
                        <i class="fas fa-cog text-lg w-6"></i>
                        <span class="ml-3 font-medium">{{ __('Settings') }}</span>
                    </a>
                </li>

                @if (auth()->user()->role == USER_ROLE_ADMIN)
                    @if(!isCentralDomain() || !isAddonInstalled('ALUSAAS'))
                        <li class="px-4 py-2 mt-4">
                            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('ADMIN MENU') }}</p>
                        </li>

                        <!-- Manage Alumni -->
                        <li>
                            <a href="#alumni-admin-square" data-bs-toggle="collapse" role="button"
                                aria-expanded="{{ isset($showAdminAlumni) ? 'true' : '' }}" aria-controls="alumni-admin-square"
                                class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors justify-between group {{ isset($showAdminAlumni) ? 'bg-[#27272a] text-white' : '' }}">
                                <div class="flex items-center">
                                    <i class="fas fa-users-cog text-lg w-6"></i>
                                    <span class="ml-3 font-medium">{{ __('Manage Alumni') }}</span>
                                </div>
                                <i class="fas fa-chevron-right text-xs transition-transform group-aria-expanded:rotate-90"></i>
                            </a>
                            <div class="collapse {{ $showAdminAlumni ?? '' }}" id="alumni-admin-square">
                                <ul class="pl-11 mt-1 space-y-1">
                                    <li><a href="{{ route('admin.alumni.list-search-with-filter') }}"
                                            class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('All List') }}</a></li>
                                    <li><a href="{{ route('admin.alumni.list-pending-alumni-with-filter') }}"
                                            class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Pending List') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Manage Membership -->
                        <li>
                            <a href="#membership-admin-square" data-bs-toggle="collapse" role="button"
                                aria-expanded="{{ isset($showMembership) ? 'true' : '' }}" aria-controls="membership-admin-square"
                                class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors justify-between group {{ isset($showMembership) ? 'bg-[#27272a] text-white' : '' }}">
                                <div class="flex items-center">
                                    <i class="fas fa-user-tag text-lg w-6"></i>
                                    <span class="ml-3 font-medium">{{ __('Manage Membership') }}</span>
                                </div>
                                <i class="fas fa-chevron-right text-xs transition-transform group-aria-expanded:rotate-90"></i>
                            </a>
                            <div class="collapse {{ $showMembership ?? '' }}" id="membership-admin-square">
                                <ul class="pl-11 mt-1 space-y-1">
                                    <li><a href="{{ route('admin.membership.index') }}"
                                            class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Membership Plan') }}</a>
                                    </li>
                                    <li><a href="{{ route('admin.membership.list') }}"
                                            class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Member List') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Manage Notice -->
                        <li>
                            <a href="#notice-admin-square" data-bs-toggle="collapse" role="button"
                                aria-expanded="{{ isset($showManageNotice) ? 'true' : '' }}" aria-controls="notice-admin-square"
                                class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors justify-between group {{ isset($showManageNotice) ? 'bg-[#27272a] text-white' : '' }}">
                                <div class="flex items-center">
                                    <i class="fas fa-bullhorn text-lg w-6"></i>
                                    <span class="ml-3 font-medium">{{ __('Manage Notice') }}</span>
                                </div>
                                <i class="fas fa-chevron-right text-xs transition-transform group-aria-expanded:rotate-90"></i>
                            </a>
                            <div class="collapse {{ $showManageNotice ?? '' }}" id="notice-admin-square">
                                <ul class="pl-11 mt-1 space-y-1">
                                    <li><a href="{{ route('admin.notices.categories.index') }}"
                                            class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Category') }}</a></li>
                                    <li><a href="{{ route('admin.notices.index') }}"
                                            class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Notice') }}</a></li>
                                </ul>
                            </div>
                        </li>

                        <!-- Manage News -->
                        <li>
                            <a href="#news-admin-square" data-bs-toggle="collapse" role="button"
                                aria-expanded="{{ isset($showManageNews) ? 'true' : '' }}" aria-controls="news-admin-square"
                                class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors justify-between group {{ isset($showManageNews) ? 'bg-[#27272a] text-white' : '' }}">
                                <div class="flex items-center">
                                    <i class="fas fa-newspaper text-lg w-6"></i>
                                    <span class="ml-3 font-medium">{{ __('Manage News') }}</span>
                                </div>
                                <i class="fas fa-chevron-right text-xs transition-transform group-aria-expanded:rotate-90"></i>
                            </a>
                            <div class="collapse {{ $showManageNews ?? '' }}" id="news-admin-square">
                                <ul class="pl-11 mt-1 space-y-1">
                                    <li><a href="{{ route('admin.news.tags.index') }}"
                                            class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Tag') }}</a></li>
                                    <li><a href="{{ route('admin.news.categories.index') }}"
                                            class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Category') }}</a></li>
                                    <li><a href="{{ route('admin.news.index') }}"
                                            class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('News') }}</a></li>
                                </ul>
                            </div>
                        </li>

                        <!-- Manage Transaction -->
                        <li>
                            <a href="#transaction-admin-square" data-bs-toggle="collapse" role="button"
                                aria-expanded="{{ isset($showTransactionNotice) ? 'true' : '' }}"
                                aria-controls="transaction-admin-square"
                                class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors justify-between group {{ isset($showTransactionNotice) ? 'bg-[#27272a] text-white' : '' }}">
                                <div class="flex items-center">
                                    <i class="fas fa-money-check-alt text-lg w-6"></i>
                                    <span class="ml-3 font-medium">{{ __('Manage Transaction') }}</span>
                                </div>
                                <i class="fas fa-chevron-right text-xs transition-transform group-aria-expanded:rotate-90"></i>
                            </a>
                            <div class="collapse {{ $showTransactionNotice ?? '' }}" id="transaction-admin-square">
                                <ul class="pl-11 mt-1 space-y-1">
                                    <li><a href="{{ route('admin.transactions.pending.list') }}"
                                            class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Pending Transaction') }}</a>
                                    </li>
                                    <li><a href="{{ route('admin.transactions.all.list') }}"
                                            class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('All Transaction') }}</a>
                                    </li>
                                    <li><a href="{{ route('admin.transactions.event.list') }}"
                                            class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Event Transaction') }}</a>
                                    </li>
                                    <li><a href="{{ route('admin.transactions.membership.list') }}"
                                            class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Membership Transaction') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Website Settings -->
                        <li>
                            <a href="{{ route('admin.setting.website-settings.index') }}"
                                class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors {{ isset($activeManageWebsiteSetting) ? 'bg-[#27272a] text-white' : '' }}">
                                <i class="fas fa-globe text-lg w-6"></i>
                                <span class="ml-3 font-medium">{{ __('Website Settings') }}</span>
                            </a>
                        </li>

                        <!-- Application Settings -->
                        <li>
                            <a href="#app-setting-square" data-bs-toggle="collapse" role="button"
                                aria-expanded="{{ isset($showManageApplicationSetting) ? 'true' : '' }}"
                                aria-controls="app-setting-square"
                                class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-[#27272a] hover:text-white transition-colors justify-between group {{ isset($showManageApplicationSetting) ? 'bg-[#27272a] text-white' : '' }}">
                                <div class="flex items-center">
                                    <i class="fas fa-cogs text-lg w-6"></i>
                                    <span class="ml-3 font-medium">{{ __('Application Settings') }}</span>
                                </div>
                                <i class="fas fa-chevron-right text-xs transition-transform group-aria-expanded:rotate-90"></i>
                            </a>
                            <div class="collapse {{ $showManageApplicationSetting ?? '' }}" id="app-setting-square">
                                <ul class="pl-11 mt-1 space-y-1">
                                    <li><a href="{{ route('admin.setting.application-settings') }}"
                                            class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('General Settings') }}</a>
                                    </li>
                                    <li><a href="{{ route('admin.setting.configuration-settings') }}"
                                            class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Configuration') }}</a>
                                    </li>
                                    <li><a href="{{ route('admin.setting.currencies.index') }}"
                                            class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Currencies') }}</a>
                                    </li>
                                    <li><a href="{{ route('admin.setting.gateway.index') }}"
                                            class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Gateways') }}</a></li>
                                    @if(!isAddonInstalled('ALUSAAS'))
                                        <li><a href="{{ route('admin.setting.languages.index') }}"
                                                class="block py-2 text-sm text-gray-500 hover:text-white">{{ __('Language') }}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </li>

                    @endif
                @endif

            @endif
        </ul>

        <div class="mt-8 pt-4 border-t border-[#27272a]">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex items-center px-4 py-2 text-gray-400 hover:text-white transition-colors">
                <i class="fas fa-sign-out-alt text-lg w-6"></i>
                <span class="ml-3">{{ __('Logout') }}</span>
            </a>
        </div>
    </div>
</aside>
<!-- Mobile Sidebar Overlay & Canvas could go here -->