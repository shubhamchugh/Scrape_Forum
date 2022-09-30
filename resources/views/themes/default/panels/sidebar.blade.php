<div class="lg:block lg:w-1/4  mx-auto p-5 bg-white ">
    <div class="flex items-center justify-between">
        <div class="w-2/3">
            <h2 class="section-heading text-1xl font-bold">
               Related Questions
            </h2>
        </div>
    </div>
@if (!empty($related_posts))
@foreach ($related_posts as $related_post)
<div class="mt-8 space-y-8">
    <div>
        <div class="flex items-start">
            <div>
                <span
                    class="inline-flex justify-center items-center w-6 h-6 rounded bg-green-600 text-white font-medium text-sm">
                    Q
                </span>
            </div>
            <p class="ml-4 md:ml-6">
                <a href="{{ route('post.show',$related_post->slug) }}">{{  $related_post->post_title }}</a>
            </p>
        </div>
    </div>
</div>
@endforeach
@endif
  
   

</div>