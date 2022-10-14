<?php

namespace App\Http\Controllers\Backend\Indexing;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class BingIndexingController extends Controller
{
    public function bing_indexing(Request $request)
    {
        try {
            if (empty(config('value.Bing_API_Key'))) {
                dd("Please Add Bing Index Api to Send Request to Bing");
            }
            $batch_count = (!empty($request->batch)) ? $request->batch : 10;

            $bing_posts = Post::where('bing_index', '0')->orderBy('id', 'asc')->limit($batch_count)->get();
            if (!empty($bing_posts->count())) {
                $slug = (!empty(nova_get_setting('permalink_prefix'))) ? '/' . nova_get_setting('permalink_prefix') : nova_get_setting('permalink_prefix');

                foreach ($bing_posts as $bing_post) {
                    $bing         = 'https://www.bing.com/indexnow?url=' . url($slug . '/' . $bing_post->slug) . '&key=' . config('value.Bing_API_Key');
                    $bing_request = Http::timeout(200)->get($bing);

                    Post::where('id', $bing_post->id)->update(['bing_index' => 1]);

                    IndexResult::create([
                        'search_engine' => 'Bing',
                        'notifyTime'    => Carbon::now(),
                        'type'          => 'URL_UPDATED',
                        'url'           => url($slug . '/' . $bing_post->slug),
                        'status_code'   => $bing_request->getStatusCode(),
                    ]);
                }
            } else {
                echo "No url found in Bing list send Indexing request<br>";
            }

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
