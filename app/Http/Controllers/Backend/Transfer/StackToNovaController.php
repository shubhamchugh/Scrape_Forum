<?php

namespace App\Http\Controllers\Backend\Transfer;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostContent;
use App\Models\SourceUrl;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class StackToNovaController extends Controller
{
    public function __invoke()
    {
        $source = SourceUrl::where('is_scraped', 'pending')->first();

        if (! $source) {
            return 'No Record Found in database to get from old Platform';
        }
        $source->update([
            'is_scraped' => 'transferred',
        ]);

        $url = config('value.OLD_SITE_URL').$source->value;

        $response = Http::get($url);
        $api_data = $response->json();

        if (! $api_data) {
            return "Api Don't have proper data please check";
        }

        // dd($api_data);
        $post = Post::create([
            'post_title' => $api_data['post_title'],
            'slug' => $api_data['slug'],
            'source_value' => $api_data['source_value'],
            'post_ref' => config('value.POST_REF'),
            'user_id' => User::inRandomOrder()->first()->id,
        ]);

        foreach ($api_data['content'] as $api_data_content) {
            PostContent::create([
                'post_id' => $post->id,
                'user_id' => User::inRandomOrder()->first()->id,
                'description' => $api_data_content['content_dec'],
            ]);
        }

        foreach ($api_data['tags'] as $api_data_tags) {
            $api_data_tags_array[] = $api_data_tags['name'];
        }
        $post->attachTags($api_data_tags_array, 'post');
    }
}
