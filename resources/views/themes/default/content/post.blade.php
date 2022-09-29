@extends('themes.default.layouts.master')


@section('content')

<div class="container mx-auto lg:flex lg:mx-20 my-10 px-10 py-10 rounded-2xl shadow-2xl">
    <div class="lg:w-3/4">
        <h1 class="capitalize text-4xl font-bold text-green-700">
           {{ $post->post_title }}
        </h1>
        <div class="flex space-x-3 mt-6">
            <div class=" text-left text-gray-400">by {{ $post->user->name }} ~ </div>
            <div class=" text-left text-gray-400">Published {{ $post->created_at->diffForHumans() }} ~ </div>
            <div class=" text-left text-gray-400">Updated {{ $post->updated_at->diffForHumans() }}</div>
        </div>

@foreach ($post->postContent as $postContent)
    <div class="mt-10 font-serif text-2xl text-gray-800 ">      
        <h3 class="text-green-500 underline mt-3 mb-3 decoration-wavy font-bold ">Answer: {{ $loop->iteration }}</h3>
        {!!  $postContent->description !!}  
    </div>
@endforeach

</div>

 
  
    @include('themes.default.panels.sidebar')
</div>






@endsection