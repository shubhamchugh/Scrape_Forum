@extends('themes.default.layouts.master')

@section('content')

<div class="container mx-auto px-4 lg:flex my-10 px-10 py-10 rounded-2xl shadow-2xl">
    <div class="space-y-8 divide-y  divide-gray-300 lg:w-3/4 ">
        <div class="relative mt-10">
            <div class="relative flex justify-start">
                <span class="pr-3 text-lg font-medium text-neutral-600 bg-white"> All Post</span>
            </div>
            @if ($sitemap->isEmpty())
            Right Now we don't Have Post which Start with letter <strong>{{ $sitemap_letter }}</strong>
            @endif
            <div class="pt-8 sm:flex lg:items-end group">
                
                <ul class="list-none">
                    @foreach ($sitemap as $sitemaplist)
                    <li>{{ $loop->iteration }}. <a href="{{ route('post.show',$sitemaplist->slug) }}">
                    {{ $sitemaplist->post_title}}</a></li>
                    @endforeach
                </ul>
                <div class="pt-5">
                    {{ $sitemap->links() }}
                </div>
            
            </div>


            
        </div>
    </div>
</div>
@endsection