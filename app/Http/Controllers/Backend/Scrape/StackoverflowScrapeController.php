<?php

namespace App\Http\Controllers\Backend\scrape;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\PostContent;
use App\Models\SourceUrl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StackoverflowScrapeController extends Controller
{
    public function stackScrape(Request $request)
    {
        $count = (! empty($request->count)) ? $request->count : 20;
        $start = (! empty($request->start)) ? $request->start : 1;
        $end = (! empty($request->end)) ? $request->end : 999999999999999999;
        $domain = (! empty($request->domain)) ? $request->domain : 'https://stackoverflow.com';
        $scrapingStatus = (! empty($request->ScrapingStatus)) ? $request->ScrapingStatus : false;
        $is_scraped = (!empty($request->where)) ? $request->where : 'pending';


        if (! empty($scrapingStatus)) {
            $unique = SourceUrl::select('is_scraped')->distinct()->get();
            foreach ($unique as $key => $value) {
                $count = SourceUrl::where('is_scraped', $value->is_scraped)->count();
                echo "$value->is_scraped : $count<br>";
            }
            dd();
        }

        $totalUser = User::count();

        $slug = SourceUrl::where('is_scraped', $is_scraped)->whereBetween('id', [$start, $end])->orderBy('id', 'ASC')->first();
       
        if (! empty($slug)) {
            $slug->update([
                'is_scraped' => 'scraping_start',
            ]);

            $url_to_scrape = $slug->value;
            echo $url_to_scrape;

            $duplicate_check = Post::where('source_value', $url_to_scrape)->first();

            if (! empty($duplicate_check)) {
                $slug->update([
                    'is_scraped' => 'duplicate_found',
                ]);
            } else {
                $response = Http::get($url_to_scrape);
                $response = $response->body();

                $dom_document = new \DOMDocument();
                libxml_use_internal_errors(true); //disable libxml errors

                $dom_document->loadHTML($response);
                libxml_clear_errors(); //remove errors for yucky html

                $dom_document->preserveWhiteSpace = false;
                $dom_document->saveHTML();

                $document_xpath = new \DOMXPath($dom_document);

                //News Xpath to get Data
                $questions = $document_xpath->query(nova_get_setting('question_xpath'));
                $answers = $document_xpath->query(nova_get_setting('answers_xpath'));
                $tags = $document_xpath->query(nova_get_setting('tags_xpath'));

                foreach ($questions as $question) {
                    $stack_q[] = $question->nodeValue;
                }
                echo '<pre>';
                print_r($stack_q);

                foreach ($answers as $answer) {
                    $stack_a[] = $answer->c14n();
                }
                print_r($stack_a);

                if (! empty($tags)) {
                    foreach ($tags as $tag) {
                        $tag_list[] = $tag->nodeValue;
                    }
                    $tag_list = (! empty($tag_list)) ? $tag_list : 'noTag';
                } else {
                    $tag_list = (! empty($tag_list)) ? $tag_list : 'noTag';
                }

                $stack_q = (! empty($stack_q)) ? $stack_q[0] : null;

                if (empty($stack_q)) {
                    echo '404 Found or Site Block the ip';
                    $slug->update([
                        'is_scraped' => 'blocked_or_404_Found',
                    ]);
                    dd();
                }

                $startdate = strtotime('2021-3-01 00:00:00');

                $randomDate = date('Y-m-d H:i:s', mt_rand($startdate, strtotime(Carbon::now())));
                    
                $post_description = (!empty($stack_a[0])) ? substr(strip_tags($stack_a[0]),0,125) : NUll;
                
                $postStore = Post::create([
                    'post_title' => $stack_q,
                    'source_value' => $url_to_scrape,
                    'user_id' => mt_rand(1, $totalUser),
                    'published_at' => $randomDate,
                    'post_description' => $post_description,
                ]);

                $postStore->attachTags($tag_list,'QA');

                $slug->update([
                    'is_scraped' => 'title_scraped',
                ]);
                $stack_a = (! empty($stack_a)) ? $stack_a : null;

                if (! empty($stack_a)) {
                    for ($i = 0; $i < count($stack_a); $i++) {
                        PostContent::create([
                            'post_id' => $postStore->id,
                            'user_id' => mt_rand(1, $totalUser),
                            'description' => $stack_a[$i],
                        ]);
                    }
                    $slug->update([
                        'is_scraped' => 'success',
                    ]);
                } else {
                    echo 'Answers Not Found';
                    $slug->update([
                        'is_scraped' => 'answers_not_found',
                    ]);
                    dd();
                }
            }
        } else {
            echo 'No Record Found In DataBase to Scrape';
        }
    }
}
