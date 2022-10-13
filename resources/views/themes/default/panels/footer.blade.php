<!-- This example requires Tailwind CSS v2.0+
    -->
<footer class="bg-slate-100 mt-10" aria-labelledby="footer-heading">
    
    <div class="px-5 py-12 mx-auto max-w-7xl lg:py-16 md:px-12 lg:px-20">
       @foreach (array_merge(range('A', 'Z'),range(1,9)) as $char)    
        <a href='{{ route("sitemap.show", ["sitemap" => $char]) }}'
            class="p-2 mt-2 inline-block text-white rounded bg-green-700"><strong>{{ $char }}</strong></a>
        @endforeach   
    </div>
    <!-- <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="px-5 py-12 mx-auto max-w-7xl lg:py-16 md:px-12 lg:px-20">
        <div class="md:grid md:grid-cols-5 md:gap-8">
            <div>
                <h3 class="text-xs font-semibold tracking-wider text-green-600 uppercase">Solutions</h3>
                <ul role="list" class="mt-4 space-y-4">
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> Marketing </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> Analytics </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> Commerce </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> Insights </a>
                    </li>
                </ul>
            </div>
            <div class="mt-12 md:mt-0">
                <h3 class="text-xs font-semibold tracking-wider text-green-600 uppercase">Support</h3>
                <ul role="list" class="mt-4 space-y-4">
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> Pricing </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> Documentation </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> Guides </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> API Status </a>
                    </li>
                </ul>
            </div>
            <div class="mt-12 md:mt-0">
                <h3 class="text-xs font-semibold tracking-wider text-green-600 uppercase">Support</h3>
                <ul role="list" class="mt-4 space-y-4">
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> Pricing </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> Documentation </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> Guides </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> API Status </a>
                    </li>
                </ul>
            </div>
            <div class="mt-12 md:mt-0">
                <h3 class="text-xs font-semibold tracking-wider text-green-600 uppercase">Support</h3>
                <ul role="list" class="mt-4 space-y-4">
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> Pricing </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> Documentation </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> Guides </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> API Status </a>
                    </li>
                </ul>
            </div>
            <div class="mt-12 md:mt-0">
                <h3 class="text-xs font-semibold tracking-wider text-green-600 uppercase">Support</h3>
                <ul role="list" class="mt-4 space-y-4">
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> Pricing </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> Documentation </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> Guides </a>
                    </li>
                    <li>
                        <a href="#" class="text-sm font-normal text-gray-500 hover:text-gray-900"> API Status </a>
                    </li>
                </ul>
            </div>
        </div>
    </div> -->
    <div class="px-5 py-12 mx-auto bg-slate-100 max-w-7xl sm:px-6 md:flex md:items-center md:justify-between lg:px-20">
        <div class="mt-8 md:mt-0 md:order-1">
            <span class="mt-2 text-sm font-light text-gray-500">
                Copyright ©
                <a href="{{ route('home.index') }}" class="mx-2 text-wickedgreen hover:text-gray-500"
                    rel="noopener noreferrer">{{ nova_get_setting('site_name') }}</a> Since 2020
            </span>
        </div>
    </div>
</footer>