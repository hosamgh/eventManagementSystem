<template>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">

                </a>
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                        <router-link
                            class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                            to="/">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </router-link>
                    </li>
                    <li class="relative px-6 py-3">
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                        <router-link v-if="user && user.is_admin"
                            class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                            to="/bookingHistory">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="ml-4">Booking History</span>
                        </router-link>
                    </li>

                    <li class="relative px-6 py-3">
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>

                        <a href="#" @click.prevent="logout" v-if="user != null"
                            class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-purple-600 dark:hover:text-gray-200 dark:text-gray-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                            </svg>
                            <span class="ml-4">Logout</span>
                        </a>
                    </li>

                </ul>

                <div class="px-6 my-6">
                    <router-link to="/event" v-if="user && user.is_admin"
                        class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Create Event
                        <span class="ml-2" aria-hidden="true">+</span>
                    </router-link>
                </div>
            </div>
        </aside>
        <!-- Mobile sidebar -->
        <!-- Backdrop -->

        <aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
            x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
            @keydown.escape="closeSideMenu">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                    Windmill
                </a>
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                            href="index.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <ul>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="forms.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                            <span class="ml-4">Forms</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="cards.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            <span class="ml-4">Cards</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="charts.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                            </svg>
                            <span class="ml-4">Charts</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="buttons.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
                                </path>
                            </svg>
                            <span class="ml-4">Buttons</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="modals.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span class="ml-4">Modals</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            href="tables.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                            <span class="ml-4">Tables</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <button
                            class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            @click="togglePagesMenu" aria-haspopup="true">
                            <span class="inline-flex items-center">
                                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                                    </path>
                                </svg>
                                <span class="ml-4">Pages</span>
                            </span>
                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <template x-if="isPagesMenuOpen">
                            <ul x-transition:enter="transition-all ease-in-out duration-300"
                                x-transition:enter-start="opacity-25 max-h-0"
                                x-transition:enter-end="opacity-100 max-h-xl"
                                x-transition:leave="transition-all ease-in-out duration-300"
                                x-transition:leave-start="opacity-100 max-h-xl"
                                x-transition:leave-end="opacity-0 max-h-0"
                                class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                                aria-label="submenu">
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="pages/login.html">Login</a>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="pages/create-account.html">
                                        Create account
                                    </a>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="pages/forgot-password.html">
                                        Forgot password
                                    </a>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="pages/404.html">404</a>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="pages/blank.html">Blank</a>
                                </li>
                            </ul>
                        </template>
                    </li>
                </ul>
                <div class="px-6 my-6">
                    <button
                        class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Create account
                        <span class="ml-2" aria-hidden="true">+</span>
                    </button>
                </div>
            </div>
        </aside>
        <div class="flex flex-col flex-1 w-full">
            <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
                <div
                    class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
                    <!-- Mobile hamburger -->
                    <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                        @click="toggleSideMenu" aria-label="Menu">
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <!-- Search input -->

                    <ul class="flex items-center flex-shrink-0 space-x-6">
                        <!-- Theme toggler -->
                        <li class="flex">
                            <button class="rounded-md focus:outline-none focus:shadow-outline-purple"
                                @click="toggleTheme" aria-label="Toggle color mode">
                                <template x-if="!dark">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z">
                                        </path>
                                    </svg>
                                </template>
                                <template x-if="dark">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </template>
                            </button>
                        </li>
                        <!-- Notifications menu -->

                        <!-- Profile menu -->

                    </ul>
                </div>
            </header>
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        BookMyPet - Event Management System
                    </h2>
                    <!-- CTA -->
                    <a
                        class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                version="1.1" width="50" height="50" viewBox="0 0 256 256" xml:space="preserve">
                                <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                                    transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                    <path
                                        d="M 58.834 8.347 V 2.811 C 58.834 1.259 57.575 0 56.023 0 H 40.438 c -1.552 0 -2.811 1.259 -2.811 2.811 v 3.478 l 3.64 2.05 l 6.385 17.127 l 4.624 0 l 4.986 -14.164 L 58.834 8.347 z"
                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(71,207,193); fill-rule: nonzero; opacity: 1;"
                                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                    <path
                                        d="M 47.653 25.466 L 44.574 9.069 c -0.409 -2.179 -2.507 -3.614 -4.686 -3.204 L 22.915 9.051 c -2.179 0.409 -3.614 2.507 -3.204 4.686 l 2.202 11.728 L 47.653 25.466 z"
                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(252,218,65); fill-rule: nonzero; opacity: 1;"
                                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                    <path
                                        d="M 66.489 25.466 l 2.441 -11.72 c 0.363 -1.745 -0.756 -3.453 -2.501 -3.817 l -7.304 -1.521 c -1.745 -0.363 -3.453 0.756 -3.817 2.501 l -3.032 14.558 L 66.489 25.466 z"
                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(185,207,71); fill-rule: nonzero; opacity: 1;"
                                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                    <path
                                        d="M 13.31 29.893 L 9.334 84.884 C 9.134 87.648 11.322 90 14.093 90 h 61.814 c 2.771 0 4.959 -2.352 4.759 -5.116 L 76.69 29.893 c -0.18 -2.495 -2.257 -4.428 -4.759 -4.428 H 18.07 C 15.568 25.466 13.491 27.398 13.31 29.893 z"
                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(223,55,72); fill-rule: nonzero; opacity: 1;"
                                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                    <path
                                        d="M 59.835 36.823 c -0.828 0 -1.5 -0.671 -1.5 -1.5 V 20.487 c 0 -7.353 -5.982 -13.335 -13.335 -13.335 c -7.353 0 -13.335 5.982 -13.335 13.335 v 14.835 c 0 0.829 -0.671 1.5 -1.5 1.5 s -1.5 -0.671 -1.5 -1.5 V 20.487 c 0 -9.007 7.328 -16.335 16.335 -16.335 c 9.007 0 16.335 7.328 16.335 16.335 v 14.835 C 61.335 36.151 60.663 36.823 59.835 36.823 z"
                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(223,55,72); fill-rule: nonzero; opacity: 1;"
                                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                    <path
                                        d="M 30.056 77.206 c -0.512 0 -1.023 -0.195 -1.414 -0.586 c -0.781 -0.781 -0.781 -2.047 0 -2.828 L 58.53 43.904 c 0.781 -0.781 2.047 -0.781 2.828 0 c 0.781 0.781 0.781 2.047 0 2.829 L 31.47 76.62 C 31.08 77.011 30.567 77.206 30.056 77.206 z"
                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,215,221); fill-rule: nonzero; opacity: 1;"
                                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                    <path
                                        d="M 34.056 57.396 c -4.454 0 -8.078 -3.624 -8.078 -8.078 c 0 -4.455 3.624 -8.079 8.078 -8.079 s 8.078 3.624 8.078 8.079 C 42.134 53.772 38.51 57.396 34.056 57.396 z M 34.056 45.24 c -2.249 0 -4.078 1.83 -4.078 4.079 s 1.83 4.078 4.078 4.078 s 4.078 -1.829 4.078 -4.078 S 36.304 45.24 34.056 45.24 z"
                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,215,221); fill-rule: nonzero; opacity: 1;"
                                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                    <path
                                        d="M 55.944 79.284 c -4.454 0 -8.078 -3.624 -8.078 -8.078 s 3.624 -8.078 8.078 -8.078 s 8.078 3.624 8.078 8.078 S 60.398 79.284 55.944 79.284 z M 55.944 67.128 c -2.249 0 -4.078 1.829 -4.078 4.078 s 1.829 4.078 4.078 4.078 s 4.078 -1.829 4.078 -4.078 S 58.193 67.128 55.944 67.128 z"
                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,215,221); fill-rule: nonzero; opacity: 1;"
                                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                </g>
                            </svg>
                            <span class="text-2xl pl-5">10% discount on first 30% of tickets - 20% discount on last 10%
                            </span>
                        </div>
                    </a>
                    <!-- Cards -->
                    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div
                                class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M8 7V3M16 7V3M4 11h16M5 20h14a1 1 0 001-1V7a1 1 0 00-1-1H5a1 1 0 00-1 1v12a1 1 0 001 1z" />
      </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Total Events
                                </p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ totalEventsCount }}
                                </p>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div
                                class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
       <svg  viewBox="0 0 1792 1792" class="w-5 h-5"  xmlns="http://www.w3.org/2000/svg"><path d="M1024 452l316 316-572 572-316-316zm-211 979l618-618q19-19 19-45t-19-45l-362-362q-18-18-45-18t-45 18l-618 618q-19 19-19 45t19 45l362 362q18 18 45 18t45-18zm889-637l-907 908q-37 37-90.5 37t-90.5-37l-126-126q56-56 56-136t-56-136-136-56-136 56l-125-126q-37-37-37-90.5t37-90.5l907-906q37-37 90.5-37t90.5 37l125 125q-56 56-56 136t56 136 136 56 136-56l126 125q37 37 37 90.5t-37 90.5z"/></svg>

                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Total of Booking
                                </p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ eventBookingSum }}
                                </p>
                            </div>
                        </div>
                     
                    </div>

                    <!-- New Table -->
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <div class="flex justify-start items-center px-6 mt-4 mb-5">
                                <label for="status-filter"
                                    class="mr-2 text-sm font-medium text-gray-700 dark:text-gray-300">Filter by
                                    Status:</label>
                                <select id="status-filter" v-model="filters.status" @change="fetchEvents"
                                    class="px-3 py-2 text-sm border w-50 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 dark:bg-gray-800 dark:text-white">
                                    <option value="">All</option>
                                    <option value="open">Open</option>
                                    <option value="closed">Closed</option>
                                </select>
                            </div>
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">Event Name</th>
                                        <th class="px-4 py-3">Description</th>
                                        <th class="px-4 py-3">Event Date</th>
                                        <th class="px-4 py-3">Ticket Price</th>
                                        <th class="px-4 py-3">Capacity</th>
                                        <th class="px-4 py-3">Remaining Tickets</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">
                                            Action
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                                    <tr :key="event.id" v-for="(event) in events"
                                        class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <!-- Avatar with inset shadow -->
                                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                    <img class="object-cover w-full h-full rounded-full"
                                                        src="../../../public/assets/event.png" alt="" loading="lazy" />
                                                    <div class="absolute inset-0 rounded-full shadow-inner"
                                                        aria-hidden="true">
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="font-semibold">{{ event.name }}</p>

                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-4 py-3 text-sm">
                                            {{ event.description }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ event.event_date }}
                                        </td>

                                        <td class="px-4 py-3 text-sm">
                                            {{ event.price }} JOD
                                        </td>

                                        <td class="px-4 py-3 text-sm">
                                            {{ event.capacity }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <span v-if="(event.capacity - event.bookings_count) > 0">{{ event.capacity
                                                -
                                                event.bookings_count }}</span>
                                            <span v-else class="text-red-600">FULL</span>
                                        </td>
                                        <td class="px-4 py-3 text-xs">
                                            <span v-if="event.status == 'open'"
                                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                Open
                                            </span>
                                            <span v-else
                                                class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                                Closed
                                            </span>
                                        </td>

                                        <td class="px-4 py-3 text-sm">
                                            <button @click="toggleModal(event.id)" type="button"
                                                :disabled="event.status === 'closed'" class="flex items-center justify-between w-30 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-purple
           bg-purple-600 hover:bg-purple-700 active:bg-purple-600 cursor-pointer
           disabled:bg-gray-400 disabled:text-gray-200 disabled:cursor-not-allowed">
                                                Book Now
                                                <span class="ml-2" aria-hidden="true">+</span>
                                            </button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div
                            class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">

                        </div>
                    </div>

                </div>
            </main>
        </div>


        <transition name="fade-slow">

            <div v-if="showModal"
                class="fixed inset-0 z-50 bg-[rgba(0,0,0,0.15)] backdrop-blur-sm flex items-center justify-center px-4"
                @click.self="closeModal">
                <transition name="scale-fade">
                    <div class="relative  bg-white rounded-2xl shadow-xl p-8 w-full max-w-lg transition-all"
                        @click.stop>
                        <div v-if="loading"
                            class="absolute inset-0 bg-black/60 flex items-center justify-center z-50 rounded-2xl">
                            <svg class="animate-spin h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">
                            {{ currentEvent != null ? currentEvent.name : '' }}
                        </h2>

                        <div v-if="currentEventPrice" class="shadow-md flex flex-col mb-5 p-3">
                            <div class="flex justify-between mb-1">
                                <strong>Price:</strong>
                                <span>{{ currentEvent.price }} JOD</span>
                            </div>
                            <div class="flex justify-between mb-1">
                                <strong>Discount:</strong>
                                <span class="text-red-600">{{ currentEventPrice.discount_percentage }}%</span>
                            </div>
                            <div class="flex justify-between mb-1">
                                <strong>Price After Discount:</strong>
                                <span>{{ currentEventPrice.price_after_discount }} JOD</span>
                            </div>
                        </div>

                        <form @submit.prevent="bookEvent">
                            <div class="mb-5">
                                <label class="block mb-1 text-gray-700 font-medium">
                                    Full Name
                                </label>
                                <input v-model="form.fullName" type="text" placeholder="Enter Your Full Name"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:outline-none"
                                    required />
                            </div>

                            <div class="mb-6">
                                <label class="block mb-1 text-gray-700 font-medium">
                                    Email
                                </label>
                                <input v-model="form.email" type="email" placeholder="e.g. you@example.com"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:outline-none"
                                    required />
                            </div>
                            <div class="mb-6">
                                <label class="block mb-1 text-gray-700 font-medium">
                                    Mobile Number
                                </label>
                                <input v-model="form.mobileNumber" type="text" placeholder="e.g. 0799999999"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:outline-none"
                                    required />
                            </div>
                            <div class="flex justify-end gap-3">
                                <button type="button" @click="closeModal"
                                    class="px-4 py-2 bg-gray-100 text-gray-700 cursor-pointer rounded-md hover:bg-gray-200 transition">
                                    Cancel
                                </button>
                                <button type="submit" :disabled="loading"
                                    class="px-4 py-2 bg-purple-600 cursor-pointer text-white rounded-md hover:bg-purple-700 transition">
                                    Confirm
                                </button>
                            </div>
                        </form>
                    </div>
                </transition>
            </div>
        </transition>
    </div>
</template>

<script>
export default {


    data() {
        return {
            loading: false,
            events: [],
            filters: {
                status: ''
            },
            currentEvent: null,
            currentEventPrice: null,

            showModal: false,
            form: {
                fullName: null,
                email: null,
                mobileNumber: null,
            }
        }
    },
    computed: {
        user() {
            const user = localStorage.getItem('user');
            if (user) {
                return JSON.parse(user);
            }

            return null;
        },
        totalEventsCount(){
            return this.events.length;
        },
        eventBookingSum(){
             return this.events.reduce((sum, event) => sum + event.bookings_count, 0);
        }
        
    },
    methods: {
        fetchEvents() {
            let url = `${import.meta.env.VITE_API_URL}/api/events`;
            if (this.filters.status) {
                url += `?status=${this.filters.status}`;
            }
            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
                .then(response => response.json())
                .then(json => {
                    this.events = json.data;

                })
                .catch(error => {
                    console.error("Error fetching events:", error);
                });
        },
        toggleModal(id) {
            //  this.currentEvent = this.events.find((e) => e.id == id)

            fetch(`${import.meta.env.VITE_API_URL}/api/events/${id}`, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json"
                }
            }).then((response) => response.json())
                .then((json) => {
                    this.currentEvent = json.data.event;
                    this.currentEventPrice = json.data.event_price;

                })

            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        },
        logout() {

            localStorage.removeItem('token');
            localStorage.removeItem('user');
            this.$router.push('/login');
        },
        bookEvent() {
            this.loading = true;

            const payload = {
                event_id: this.currentEvent.id,
                full_name: this.form.fullName,
                user_email: this.form.email,
                mobile_number: this.form.mobileNumber,
            }

            fetch(`${import.meta.env.VITE_API_URL}/api/booking`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
                .then(async (response) => {
                    const data = await response.json();
                    this.showModal = false;
                    this.loading = false;
                    if (response.ok && data.success) {
                        this.$toast.open({
                            message: data.message || 'Booking successful!',
                            type: 'success',
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 500);

                    } else {
                        this.$toast.open({
                            message: data.message || 'Booking failed.',
                            type: 'error',
                        });
                    }
                })
                .catch(error => {
                    this.$toast.open({
                        message: error.message || 'Network error occurred.',
                        type: 'error',
                    });
                    this.loading = false;

                });

        }


    },

    mounted() {
        this.fetchEvents();

        var pusher = new Pusher('5fed855ca904de9194c1', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('events');

        channel.bind('ticket-update', (data) => {
          

            this.events = this.events.map(ev => {
                if (ev.id == updated.id) {
                    return {
                        ...ev,
                        bookings_count: data.bookings_count,
                    };
                }
                return ev;
            });
        });
    },
    beforeUnmount() {
        window.Echo.leave('events');
    }


}

</script>

<style scoped>
/* Overlay fade effect */
.fade-slow-enter-active,
.fade-slow-leave-active {
    transition: opacity 0.5s ease;
}

.fade-slow-enter-from,
.fade-slow-leave-to {
    opacity: 0;
}

/* Scale + fade on modal */
.scale-fade-enter-active {
    transition: transform 0.4s ease, opacity 0.4s ease;
}

.scale-fade-leave-active {
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.scale-fade-enter-from,
.scale-fade-leave-to {
    transform: scale(0.95);
    opacity: 0;
}
</style>
