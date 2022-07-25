<div class="bg-yellow-400  w-full ">
    <div x-data="{ open: false }"
        class="flex flex-col max-w-screen-xl p-5 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
        <div class="flex flex-row items-center justify-between lg:justify-start">
            <a href="./index.html"
                class="text-lg font-bold tracking-tighter text-green-700 transition duration-500 ease-in-out transform tracking-relaxed lg:pr-8">
                wickedblocks </a>
            <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-8 h-8">
                    <path x-show="!open" fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                    <path x-show="open" fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" style="display: none"></path>
                </svg>
            </button>
        </div>
        <nav :class="{'flex': open, 'hidden': !open}"
            class="flex-col items-center flex-grow hidden pb-4 border-green-700 md:pb-0 md:flex md:justify-end md:flex-row lg:border-l-2 lg:pl-2">
            <a class="px-4 py-2 mt-2 text-sm text-gray-900 md:mt-0 hover:text-green-700 focus:outline-none focus:shadow-outline"
                href="#">About</a>
            <a class="px-4 py-2 mt-2 text-sm text-gray-900 md:mt-0 hover:text-green-700 focus:outline-none focus:shadow-outline"
                href="#">Contact</a>
            <div class="inline-flex items-center gap-2 list-none lg:ml-auto">
                <form action="" method="post" id="revue-form" name="revue-form" target="_blank"
                    class="p-1 transition duration-500 ease-in-out transform border2 bg-gray-50 rounded-xl sm:max-w-lg sm:flex">
                    <div class="flex-1 min-w-0 revue-form-group">
                        <label for="member_email" class="sr-only">Search Your Query</label>
                        <input id="cta-email" type="email"
                            class="block w-full px-5 py-3 bg-gray-200 text-base text-neutral-600 placeholder-gray-600 transition duration-500 ease-in-out transform bg-transparent border border-transparent rounded-md focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-600"
                            placeholder="Search Your Query">
                    </div>
                    <div class="mt-4 sm:mt-0 sm:ml-3 revue-form-actions">
                        <button type="submit" value="Subscribe" name="member[subscribe]" id="member_submit"
                            class="block w-full px-5 py-3 text-base font-medium text-white bg-green-700 border border-transparent rounded-lg shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-300 sm:px-10">Search</button>
                    </div>
                </form>
            </div>
        </nav>
    </div>
</div>
<div>
    <div class="hidden lg:block p-5 overflow-y-auto whitespace-nowrap scroll-hidden bg-gray-200">
        <ul class="inline-flex items-center list-none">
            <li>
                <a href="#"
                    class="px-4 py-1 mr-1 text-base text-gray-900 transition duration-500 ease-in-out transform rounded-md focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2 hover:text-green-700">Pricing</a>
            </li>
        </ul>
    </div>
</div>