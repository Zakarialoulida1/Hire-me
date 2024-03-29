<div class="bg-gray-100" style="min-height: 192px;">

    <header x-data="{ open: false }" class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:divide-y lg:divide-gray-700 lg:px-8">
            <div class="relative h-16 flex justify-between">
                <div class="relative z-10 px-2 flex lg:px-0">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="block h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg"
                            alt="Workflow">
                    </div>
                </div>
                @if (in_array(request()->route()->getName(), ['show.company', 'offres']))
                    <div class="relative z-0 flex-1 px-2 flex items-center justify-center sm:absolute sm:inset-0">
                        <div class="w-full sm:max-w-xs">
                            <label for="search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                                    <svg class="h-5 w-5 text-gray-400" x-description="Heroicon name: solid/search"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                @if (request()->route()->getName() === 'show.company')
                                    <input id="searchCompanies" name="searchCompanies"
                                        class="block w-full bg-gray-700 border border-transparent rounded-md py-2 pl-10 pr-3 text-sm placeholder-gray-400 focus:outline-none focus:bg-white focus:border-white focus:ring-white focus:text-gray-900 focus:placeholder-gray-500 sm:text-sm"
                                        placeholder="Search Companies" type="search">
                                @elseif (request()->route()->getName() === 'offres')
                                    <input id="searchOffers" name="searchOffers"
                                        class="block w-full bg-gray-700 border border-transparent rounded-md py-2 pl-10 pr-3 text-sm placeholder-gray-400 focus:outline-none focus:bg-white focus:border-white focus:ring-white focus:text-gray-900 focus:placeholder-gray-500 sm:text-sm"
                                        placeholder="Search Offers" type="search">
                                @endif


                            </div>
                        </div>
                    </div>
                @endif





                <div class="relative z-10 flex items-center lg:hidden">
                    <!-- Mobile menu button -->
                    <button id="burger-menu" type="button"
                        class="rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu" @click="open = !open" aria-expanded="false"
                        x-bind:aria-expanded="open.toString()">
                        <span class="sr-only">Open menu</span>
                        <svg x-description="Icon when menu is closed.Heroicon name: outline/menu" x-state:on="Menu open"
                            x-state:off="Menu closed" class="block h-6 w-6"
                            :class="{ 'hidden': open, 'block': !(open) }" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-description="Icon when menu is open.Heroicon name: outline/x" x-state:on="Menu open"
                            x-state:off="Menu closed" class="hidden h-6 w-6"
                            :class="{ 'block': open, 'hidden': !(open) }" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="hidden lg:relative lg:z-10 lg:ml-4 lg:flex lg:items-center">


                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>


                </div>
            </div>
            <nav class="hidden lg:py-2 lg:flex lg:space-x-8" aria-label="Global">
                @if ((Auth()->user()->role === 'Admin'))
                <a href="{{ route('show.company') }}"
                    class="bg-gray-900 text-white rounded-md py-2 px-3 inline-flex items-center text-sm font-medium"
                    aria-current="page" x-state:on="Current" x-state:off="Default"
                    x-state-description="Current: &quot;bg-gray-900 text-white&quot;, Default: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">
                    Entreprise
                </a>
                @endif
                <a href="{{ route('offres') }}"
                    class="bg-gray-900 text-white rounded-md py-2 px-3 inline-flex items-center text-sm font-medium"
                    aria-current="page" x-state:on="Current" x-state:off="Default"
                    x-state-description="Current: &quot;bg-gray-900 text-white&quot;, Default: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">
                    {{ Auth()->user()->role === 'user'|Auth()->user()->role === 'Admin' ? 'Offres' : 'Your offres' }}
                </a>
                @if (Auth()->user()->role === 'user')
                    <a href="{{ route('formCv') }}"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md py-2 px-3 inline-flex items-center text-sm font-medium"
                        x-state-description="undefined: &quot;bg-gray-900 text-white&quot;, undefined: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">
                        Cv
                    </a>
                @endif
                @if (Auth()->user()->role === 'entreprise')
                    <a href="{{ route('formoffre') }}"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md py-2 px-3 inline-flex items-center text-sm font-medium"
                        x-state-description="undefined: &quot;bg-gray-900 text-white&quot;, undefined: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">
                        Post an offre
                    </a>
                @endif
                @if ((Auth()->user()->role === 'user'))
                    <a href="{{ route('formcompany') }}"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md py-2 px-3 inline-flex items-center text-sm font-medium"
                        x-state-description="undefined: &quot;bg-gray-900 text-white&quot;, undefined: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">
                        For Company
                    </a>
                @endif
                @if ((Auth()->user()->role === 'Admin'))
                <a href="{{ route('statistique') }}"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md py-2 px-3 inline-flex items-center text-sm font-medium"
                    x-state-description="undefined: &quot;bg-gray-900 text-white&quot;, undefined: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">
                    Statistique
                </a>
            @endif

            </nav>
        </div>

        <nav x-description="Mobile menu, show/hide based on menu state." class="lg:hidden" aria-label="Global"
            id="mobile-menu" x-show="open">
            <div class="pt-2 pb-3 px-2 space-y-1">
                @if ((Auth()->user()->role === 'Admin'))
                <a href="{{ route('show.company') }}"
                    class="bg-gray-900 text-white block rounded-md py-2 px-3 text-base font-medium"
                    aria-current="page" x-state:on="Current" x-state:off="Default"
                    x-state-description="Current: &quot;bg-gray-900 text-white&quot;, Default: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">Entreprise</a>
               @endif
                    <a href="" class="bg-gray-900 text-white block rounded-md py-2 px-3 text-base font-medium"
                    aria-current="page" x-state:on="Current" x-state:off="Default"
                    x-state-description="Current: &quot;bg-gray-900 text-white&quot;, Default: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">Your
                    offres</a>

                    @if (Auth()->user()->role === 'user')
                <a href="{{ route('formCv') }}"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md py-2 px-3 text-base font-medium"
                    x-state-description="undefined: &quot;bg-gray-900 text-white&quot;, undefined: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">Cv</a>
                    @endif
                    @if (Auth()->user()->role === 'entreprise')
                <a href="{{ route('formoffre') }}"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md py-2 px-3 text-base font-medium"
                    x-state-description="undefined: &quot;bg-gray-900 text-white&quot;, undefined: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">Post
                    an offre</a>
                    @endif
                    @if ((Auth()->user()->role === 'user'))
                    <a href="{{ route('formcompany') }}"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md py-2 px-3 text-base font-medium"
                        x-state-description="undefined: &quot;bg-gray-900 text-white&quot;, undefined: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">For
                        Company</a>
                @endif
                @if ((Auth()->user()->role === 'Admin'))
                <a href="{{ route('statistique') }}"
                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md py-2 px-3 inline-flex items-center text-sm font-medium"
                x-state-description="undefined: &quot;bg-gray-900 text-white&quot;, undefined: &quot;text-gray-300 hover:bg-gray-700 hover:text-white&quot;">
                Statistique
            </a>
        @endif

            </div>
            <div class="border-t border-gray-700 pt-4 pb-3">
                <div class="px-4 flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full"
                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                            alt="">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-white">Tom Cook</div>
                        <div class="text-sm font-medium text-gray-400">tom@example.com</div>
                    </div>
                    <button type="button"
                        class="ml-auto flex-shrink-0 bg-gray-800 rounded-full p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" x-description="Heroicon name: outline/bell"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="mt-3 px-2 space-y-1">

                    <a href="{{ route('profile.edit') }}"
                        class="block rounded-md py-2 px-3 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your
                        Profile</a>

                    <a href="#"
                        class="block rounded-md py-2 px-3 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>

                    <form class="" method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link class="text-white hover:text-black" :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>


                </div>
            </div>
        </nav>
    </header>

</div>

</nav>
