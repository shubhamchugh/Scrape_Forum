@extends('themes.default.layouts.master')
@section('content')


<div class="container mx-auto px-4 lg:flex my-10 px-10 py-10 rounded-2xl shadow-2xl">
    <div class="space-y-8 divide-y  divide-gray-300 lg:w-3/4 ">
        <div class="relative mt-10">
            <div class="relative flex justify-start">
                <span class="pr-3 text-lg font-medium text-neutral-600 bg-white"> All Post</span>
            </div>
        </div>

        @foreach ($posts as $post)
        <div class="pt-8 sm:flex lg:items-end group">
            <div>
                <span class="text-sm text-gray-500">{{ $post->updated_at->diffForHumans() }}</span>
                <p class="mt-3 text-lg  font-medium leading-6">
                    <a href="{{ route('post.show',$post->slug) }}" class="text-xl text-green-600 group-hover:text-green-700 lg:text-2xl">{{ $post->post_title }}</a>
                </p>
                <p class="mt-2 text-lg text-gray-500">{{ $post->post_description }}</p>
            </div>
        </div>
        @endforeach
        <div class="pt-5">
            {{ $posts->links() }}
        </div>
    </div>
    @include('themes.default.panels.sidebar')
</div>
@endsection