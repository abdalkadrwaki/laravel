<nav x-data="{ open: false }" class="bg-white   shadow-sm border border-gray-200 "dir="rtl">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center flex-shrink-0">
                <a href="{{ route('dashboard') }}">
                    <x-jet-application-mark class="block w-auto h-9" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:flex space-x-8 space-x-reverse">


                <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="no-underline">
                    <button
                        class="inline-flex items-center px-4 py-2 mt-1.5 text-sm font-medium text-gray-800 bg-white hover:bg-gray-50 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-0.5 focus:ring-indigo-500 transition duration-150 ease-in-out">

                        <svg class="w-6 h-6 ml-2 text-blue-700 fill-current" width="256px" height="256px"
                            viewBox="0 0 24.00 24.00" fill="none" xmlns="http://www.w3.org/2000/svg"
                            stroke="#2027d9">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M14 21.0001V15.0001H10V21.0001M19 9.77818V16.2001C19 17.8802 19 18.7203 18.673 19.362C18.3854 19.9265 17.9265 20.3855 17.362 20.6731C16.7202 21.0001 15.8802 21.0001 14.2 21.0001H9.8C8.11984 21.0001 7.27976 21.0001 6.63803 20.6731C6.07354 20.3855 5.6146 19.9265 5.32698 19.362C5 18.7203 5 17.8802 5 16.2001V9.77753M21 12.0001L15.5668 5.96405C14.3311 4.59129 13.7133 3.9049 12.9856 3.65151C12.3466 3.42894 11.651 3.42899 11.0119 3.65165C10.2843 3.90516 9.66661 4.59163 8.43114 5.96458L3 12.0001"
                                    stroke="#215dd4" stroke-width="0.576" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </g>
                        </svg>
                        <span>{{ __('الرئيسية') }}</span>
                    </button>
                </x-jet-nav-link>

                @can('manage-Lessons')
                    <div x-data="{ dropdownOpen: false }">
                        <x-jet-dropdown align="left" width="40">
                            <!-- Trigger: عنوان القائمة المنسدلة -->
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-4 py-2 mt-3 text-sm font-medium text-gray-800 bg-white hover:bg-gray-50 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-0.5 focus:ring-indigo-500 transition duration-150 ease-in-out">

                                    <svg class="text-indigo-500 transition-transform duration-300 group-hover:text-indigo-600"
                                        xmlns="http://www.w3.org/2000/svg" height="14" width="14"
                                        viewBox="0 0 512 512">
                                        <path fill="#075ef2"
                                            d="M208 32c0-17.7 14.3-32 32-32l32 0c17.7 0 32 14.3 32 32l0 140.9 122-70.4c15.3-8.8 34.9-3.6 43.7 11.7l16 27.7c8.8 15.3 3.6 34.9-11.7 43.7L352 256l122 70.4c15.3 8.8 20.6 28.4 11.7 43.7l-16 27.7c-8.8 15.3-28.4 20.6-43.7 11.7L304 339.1 304 480c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-140.9L86 409.6c-15.3 8.8-34.9 3.6-43.7-11.7l-16-27.7c-8.8-15.3-3.6-34.9 11.7-43.7L160 256 38 185.6c-15.3-8.8-20.5-28.4-11.7-43.7l16-27.7C51.1 98.8 70.7 93.6 86 102.4l122 70.4L208 32z" />
                                    </svg>
                                    <span>{{ __(' حركات صادرة') }}</span>
                                </button>
                            </x-slot>

                            <!-- محتوى القائمة المنسدلة -->
                            <x-slot name="content">
                                <div class="w-40 py-1">
                                    <x-jet-dropdown-link href="{{ route('transfers.sent.index') }}" :active="request()->routeIs('transfers.sent.index')"
                                        class="px-4 py-2 text-sm text-gray-700 rounded-md hover:bg-blue-700 hover:text-gray-100">
                                        {{ __('الحوالات الصادرة') }}
                                    </x-jet-dropdown-link>

                                    <x-jet-dropdown-link href="{{ route('transfers.sentapproval') }}" :active="request()->routeIs('transfers.sentapproval')"
                                        class="px-4 py-2 text-sm text-gray-700 rounded-md hover:bg-blue-700 hover:text-gray-100">
                                        {{ __('اعتمادات صادرة') }} <!-- تصحيح خطأ إملائي -->
                                    </x-jet-dropdown-link>
                                    <x-jet-dropdown-link href="{{ route('transfers.sentrxchange') }}" :active="request()->routeIs('transfers.sentrxchange')"
                                        class="px-4 py-2 text-sm text-gray-700 rounded-md hover:bg-blue-700 hover:text-gray-100">
                                        {{ __('قص صادر ') }} <!-- تأكد من النص المعروض إذا لزم الأمر -->
                                    </x-jet-dropdown-link>

                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>


                    <x-jet-dropdown align="left" width="40">
                        <!-- Trigger: عنوان القائمة المنسدلة -->
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-4 py-2 mt-3 text-sm font-medium text-gray-800 bg-white hover:bg-gray-50 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-0.5 focus:ring-indigo-500 transition duration-150 ease-in-out">
                                <!-- العداد داخل البوردر -->
                                @livewire('transfer-counter') <!-- تضمين مكون Livewire هنا -->
                                <svg class="text-indigo-500 transition-transform duration-300 group-hover:text-indigo-600"
                                    xmlns="http://www.w3.org/2000/svg" height="14" width="14" viewBox="0 0 512 512">
                                    <path fill="#075ef2"
                                        d="M208 32c0-17.7 14.3-32 32-32l32 0c17.7 0 32 14.3 32 32l0 140.9 122-70.4c15.3-8.8 34.9-3.6 43.7 11.7l16 27.7c8.8 15.3 3.6 34.9-11.7 43.7L352 256l122 70.4c15.3 8.8 20.6 28.4 11.7 43.7l-16 27.7c-8.8 15.3-28.4 20.6-43.7 11.7L304 339.1 304 480c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-140.9L86 409.6c-15.3 8.8-34.9 3.6-43.7-11.7l-16-27.7c-8.8-15.3-3.6-34.9 11.7-43.7L160 256 38 185.6c-15.3-8.8-20.5-28.4-11.7-43.7l16-27.7C51.1 98.8 70.7 93.6 86 102.4l122 70.4L208 32z" />
                                </svg>
                                <span
                                    class="text-base font-medium text-gray-700 transition-colors group-hover:text-indigo-900">
                                    {{ __('حركات واردة') }}
                                </span>

                            </button>
                        </x-slot>

                        <style>
                            @keyframes pulse {
                                0% {
                                    box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4);
                                }

                                70% {
                                    box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
                                }

                                100% {
                                    box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
                                }
                            }

                            .pulse-animation {
                                animation: pulse 2s infinite;
                            }

                            .pulse-animation:hover {
                                animation: none;
                                box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
                            }
                        </style>

                        <!-- محتوى القائمة المنسدلة -->
                        <x-slot name="content">
                            <div class="py-1 w-44 ">
                                <x-jet-dropdown-link href="{{ route('transfers.received') }}" :active="request()->routeIs('transfers.received')"
                                    class="relative px-4 py-2 text-sm text-gray-700 transition-colors duration-300 rounded-md group hover:bg-blue-700 hover:text-gray-100">

                                    <div class="flex items-center justify-between w-full">
                                        <!-- النص مع تحديد عرض ثابت -->
                                        <span class="truncate max-w-[160px]">{{ __('الحوالات الواردة') }}</span>

                                        <!-- العداد في أقصى اليمين -->
                                        <div class="flex items-center gap-4">
                                            <span id="transfers-counter1"
                                                class="px-2 py- min-w-[28px] text-center
                                                       text-xs font-bold text-white
                                                       bg-gradient-to-br from-red-500 to-red-700
                                                       rounded-full border-2 border-white
                                                       shadow-lg transform transition-all
                                                       duration-300 hover:scale-110
                                                       pulse-animation">
                                                0</span>
                                        </div>
                                    </div>

                                    <!-- تأثير إضافي عند الـ Hover -->
                                    <div
                                        class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-r from-transparent to-blue-200 group-hover:opacity-10">
                                    </div>
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="{{ route('transfers.receivedapproval') }}" :active="request()->routeIs('transfers.receivedapproval')"
                                    class="px-4 py-2 text-sm text-gray-700 rounded-md hover:bg-blue-700 hover:text-gray-100">
                                    <div class="flex items-center justify-between w-full">
                                        <!-- النص مع تحديد عرض ثابت -->
                                        <span class="truncate max-w-[160px]">{{ __('اعتمادات الواردة') }}</span>

                                        <!-- العداد في أقصى اليمين -->
                                        <div class="flex items-center gap-4">
                                            <span id="transfers-counter2"
                                                class="px-2 py-1 min-w-[28px] text-center
                                                           text-xs font-bold text-white
                                                           bg-gradient-to-br from-red-500 to-red-700
                                                           rounded-full border-2 border-white
                                                           shadow-lg transform transition-all
                                                           duration-300 hover:scale-110
                                                           pulse-animation">
                                                0</span>
                                        </div>
                                    </div>
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="{{ route('transfers.rxchangeReceivedTransfer') }}"
                                    :active="request()->routeIs('transfers.rxchangeReceivedTransfer')"
                                    class="px-4 py-2 text-sm text-gray-700 rounded-md hover:bg-blue-700 hover:text-gray-100">
                                    <div class="flex items-center justify-between w-full">
                                        <!-- النص مع تحديد عرض ثابت -->
                                        <span class="truncate max-w-[160px]">{{ __('قص وارد') }}</span>

                                        <!-- العداد في أقصى اليمين -->
                                        <div class="flex items-center gap-4">
                                            <span id="transfers-counter3"
                                                class="px-2 py-1 min-w-[28px] text-center
                                                           text-xs font-bold text-white
                                                           bg-gradient-to-br from-red-500 to-red-700
                                                           rounded-full border-2 border-white
                                                           shadow-lg transform transition-all
                                                           duration-300 hover:scale-110
                                                           pulse-animation">
                                                0</span>
                                        </div>
                                    </div>
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('transfers.rxchangeReceivedTransfer') }}"
                                :active="request()->routeIs('transfers.rxchangeReceivedTransfer')"
                                class="px-4 py-2 text-sm text-gray-700 rounded-md hover:bg-blue-700 hover:text-gray-100">
                                <div class="flex items-center justify-between w-full">
                                    <!-- النص مع تحديد عرض ثابت -->
                                    <span class="truncate max-w-[160px]">{{ __(' الحركات المسلمة') }}</span>

                                    <!-- العداد في أقصى اليمين -->
                                    <div class="flex items-center gap-4">
                                       
                                    </div>
                                </div>
                            </x-jet-dropdown-link>


                            </div>
                        </x-slot>
                    </x-jet-dropdown>


                    <x-jet-nav-link href="{{ route('student.friend-request') }}" :active="request()->routeIs('student.friend-request')" class="no-underline">
                        <button
                            class="inline-flex items-center px-4 py-2 mt-2 text-sm font-medium text-gray-800 bg-white hover:bg-gray-50 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-0.5 focus:ring-indigo-500 transition duration-150 ease-in-out">
                            <div>
                                <span id="transfers-counter"
                                    class="absolute top-4 left-0 translate-x-[-40%] translate-y-[40%] flex items-center justify-center min-w-[34px] max-h-7 px-2 text-xs font-bold  text-white bg-gradient-to-br from-red-500 to-red-800 rounded-full border-[2px] border-gray-300 shadow-sm transition-all duration-300 group-hover:scale-110 group-hover:from-indigo-700 group-hover:to-indigo-600 group-hover:shadow-indigo-200">

                                </span>
                            </div>


                            <svg class="text-indigo-500 transition-transform duration-300 group-hover:text-indigo-600"
                                xmlns="http://www.w3.org/2000/svg" height="14" width="14" viewBox="0 0 512 512">
                                <path fill="#075ef2"
                                    d="M208 32c0-17.7 14.3-32 32-32l32 0c17.7 0 32 14.3 32 32l0 140.9 122-70.4c15.3-8.8 34.9-3.6 43.7 11.7l16 27.7c8.8 15.3 3.6 34.9-11.7 43.7L352 256l122 70.4c15.3 8.8 20.6 28.4 11.7 43.7l-16 27.7c-8.8 15.3-28.4 20.6-43.7 11.7L304 339.1 304 480c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-140.9L86 409.6c-15.3 8.8-34.9 3.6-43.7-11.7l-16-27.7c-8.8-15.3-3.6-34.9 11.7-43.7L160 256 38 185.6c-15.3-8.8-20.5-28.4-11.7-43.7l16-27.7C51.1 98.8 70.7 93.6 86 102.4l122 70.4L208 32z" />
                            </svg>
                            <span class="text-base font-medium text-gray-700 transition-colors group-hover:text-indigo-900">
                                {{ __(' الربط') }}
                            </span>
                        </button>
                    </x-jet-nav-link>

                    <div x-data="{ dropdownOpen: false }">
                        <x-jet-dropdown align="left" width="40">
                            <!-- Trigger: عنوان القائمة المنسدلة -->
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-4 py-2 mt-3 text-sm font-medium text-gray-800 bg-white hover:bg-gray-50 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-0.5 focus:ring-indigo-500 transition duration-150 ease-in-out">

                                    <svg class="text-indigo-500 transition-transform duration-300 group-hover:text-indigo-600"
                                        xmlns="http://www.w3.org/2000/svg" height="14" width="14"
                                        viewBox="0 0 512 512">
                                        <path fill="#075ef2"
                                            d="M208 32c0-17.7 14.3-32 32-32l32 0c17.7 0 32 14.3 32 32l0 140.9 122-70.4c15.3-8.8 34.9-3.6 43.7 11.7l16 27.7c8.8 15.3 3.6 34.9-11.7 43.7L352 256l122 70.4c15.3 8.8 20.6 28.4 11.7 43.7l-16 27.7c-8.8 15.3-28.4 20.6-43.7 11.7L304 339.1 304 480c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-140.9L86 409.6c-15.3 8.8-34.9 3.6-43.7-11.7l-16-27.7c-8.8-15.3-3.6-34.9 11.7-43.7L160 256 38 185.6c-15.3-8.8-20.5-28.4-11.7-43.7l16-27.7C51.1 98.8 70.7 93.6 86 102.4l122 70.4L208 32z" />
                                    </svg>
                                    <span>{{ __(' إدارة حسابات ') }}</span>
                                </button>
                            </x-slot>

                            <!-- محتوى القائمة المنسدلة -->
                            <x-slot name="content">
                                <div class="w-40 py-1">
                                    <x-jet-dropdown-link href="{{ route('destinations.index') }}" :active="request()->routeIs('destinations.index')"
                                        class="px-4 py-2 text-sm text-gray-700 rounded-md hover:bg-blue-700 hover:text-gray-100">
                                        {{ __('مكاتب ') }}
                                    </x-jet-dropdown-link>

                                    <x-jet-dropdown-link href="{{ route('sub-users.create') }}" :active="request()->routeIs('sub-users.create')"
                                        class="px-4 py-2 text-sm text-gray-700 rounded-md hover:bg-blue-700 hover:text-gray-100">
                                        {{ __('زبائن  ') }} <!-- تصحيح خطأ إملائي -->
                                    </x-jet-dropdown-link>
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>


                    <x-jet-dropdown align="left" width="40">
                        <!-- Trigger: عنوان القائمة المنسدلة -->
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-4 py-2 mt-3 text-sm font-medium text-gray-800 bg-white hover:bg-gray-50 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-0.5 focus:ring-indigo-500 transition duration-150 ease-in-out">


                                <svg class="text-indigo-500 transition-transform duration-300 group-hover:text-indigo-600"
                                    xmlns="http://www.w3.org/2000/svg" height="14" width="14"
                                    viewBox="0 0 512 512">
                                    <path fill="#075ef2"
                                        d="M208 32c0-17.7 14.3-32 32-32l32 0c17.7 0 32 14.3 32 32l0 140.9 122-70.4c15.3-8.8 34.9-3.6 43.7 11.7l16 27.7c8.8 15.3 3.6 34.9-11.7 43.7L352 256l122 70.4c15.3 8.8 20.6 28.4 11.7 43.7l-16 27.7c-8.8 15.3-28.4 20.6-43.7 11.7L304 339.1 304 480c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-140.9L86 409.6c-15.3 8.8-34.9 3.6-43.7-11.7l-16-27.7c-8.8-15.3-3.6-34.9 11.7-43.7L160 256 38 185.6c-15.3-8.8-20.5-28.4-11.7-43.7l16-27.7C51.1 98.8 70.7 93.6 86 102.4l122 70.4L208 32z" />
                                </svg>
                                <span>{{ __('المحاسبة') }}</span>

                            </button>
                        </x-slot>

                        <!-- محتوى القائمة المنسدلة -->
                        <x-slot name="content">
                            <div class="w-40 py-1">
                                <x-jet-dropdown-link href="{{ route('transfers.index') }}" :active="request()->routeIs('transfers.index')"
                                    class="px-4 py-2 text-sm text-gray-700 rounded-md hover:bg-blue-700 hover:text-gray-100">
                                    {{ __(' كشف حساب ') }}
                                </x-jet-dropdown-link>


                            </div>
                        </x-slot>
                    </x-jet-dropdown>
                @endcan

                @can('Administrator')
                    <x-jet-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.index')" class="no-underline">
                        {{ __('Users') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('admin.currencies.index') }}" :active="request()->routeIs('admin.currencies.index')" class="no-underline">
                        {{ __('Currency') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('admin.broadcast.index') }}" :active="request()->routeIs('admin.broadcast.index')" class="no-underline">
                        {{ __('Broadcast') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('admin.wages.index') }}" :active="request()->routeIs('admin.wages.index')" class="no-underline">
                        {{ __('wages') }}
                    </x-jet-nav-link>

                @endcan


            </div>
            <!--     </div>-->

            <!-- User and Team Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="relative ml-3">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                                    {{ Auth::user()->currentTeam->name }}
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <div class="block px-4 py-2 text-xs text-gray-400">{{ __('Manage Team') }}</div>
                                    <x-jet-dropdown-link
                                        href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-jet-dropdown-link>
                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan
                                    <div class="border-t border-gray-100"></div>
                                    <div class="block px-4 py-2 text-xs text-gray-400">{{ __('Switch Teams') }}</div>
                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @endif

                <!-- User Settings Dropdown -->
                <div class="relative ml-4">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex items-center text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                    <img class="object-cover w-8 h-8 rounded-full"
                                        src="{{ Auth::user()->profile_photo_url }}"
                                        alt="{{ Auth::user()->Office_name }}" />
                                    <span class="ml-2">{{ Auth::user()->Office_name }}</span>
                                </button>
                            @else
                            <button type="button"
                            class="flex items-center justify-between gap-4 mt-2 px-4 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                            <span>{{ Auth::user()->Office_name }}</span>
                            <svg class="h-5 w-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">{{ __('إدارة الحساب') }}</div>
                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('الاعدادات') }}
                            </x-jet-dropdown-link>
                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif
                            <div class="border-t border-gray-100"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('تسجيل الخروج') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('الرئيسية') }}
            </x-jet-responsive-nav-link>

            @can('manage-Lessons')
                <x-jet-nav-link href="{{ route('student.friend-request') }}" :active="request()->routeIs('student.friend-request')" class="no-underline">
                    {{ __('الربط') }}
                </x-jet-nav-link>

                <x-jet-nav-link href="{{ route('destinations.index') }}" :active="request()->routeIs('destinations.index')" class="no-underline">
                    {{ __('ادارة مكاتب ') }}
                </x-jet-nav-link>


                <x-jet-nav-link href="{{ route('transfers.received') }}" :active="request()->routeIs('transfers.received')" class="no-underline">
                    {{ __('حولاات الواردة') }}
                </x-jet-nav-link>
            @endcan

            @can('Administrator')
                <x-jet-responsive-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.index')">
                    {{ __('Users') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('admin.currencies.index') }}" :active="request()->routeIs('admin.currencies.index')">
                    {{ __('Currency') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('admin.broadcast.index') }}" :active="request()->routeIs('admin.broadcast.index')">
                    {{ __('Broadcast') }}
                </x-jet-responsive-nav-link>
            @endcan

            @can('manage-courses')
                <x-jet-responsive-nav-link href="{{ route('teacher.courses.index') }}" :active="request()->routeIs('teacher.courses.index')">
                    {{ __('Courses') }}
                </x-jet-responsive-nav-link>
            @endcan
        </div>
    </div>
</nav>
