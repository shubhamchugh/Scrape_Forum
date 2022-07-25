<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\TagsField\Tags;

class Post extends Resource
{
    /**
     * type_options
     *
     * @return array for post_type like post,article
     */
    public function type_options()
    {
        $post_type = \App\Models\Post::pluck('post_type')->unique();
        $post_type_array = [
            'post' => 'POST',
            'article' => 'ARTICLE',
        ];

        if (! $post_type->isEmpty()) {
            foreach ($post_type as $key) {
                $post_type_array[$key] = Str::upper($key);
            }

            return array_unique($post_type_array);
        }

        return array_unique($post_type_array);
    }

    /**
     * post_status
     *
     * @return array for post status
     */
    public function post_status()
    {
        $post_status = \App\Models\Post::pluck('status')->unique();
        $post_status_array = [
            'publish' => 'PUBLISH',
            'draft' => 'DRAFT',
        ];

        if (! $post_status->isEmpty()) {
            foreach ($post_status as $key) {
                $post_status_array[$key] = Str::upper($key);
            }

            return array_unique($post_status_array);
        }

        return array_unique($post_status_array);
    }

    /**
     * google_index
     *
     * @return array for google index
     */
    public function google_index()
    {
        $google_index_status = \App\Models\Post::pluck('google_index')->unique();
        $google_index_status_array = [
            'pending' => 'PENDING',
        ];

        if (! $google_index_status->isEmpty()) {
            foreach ($google_index_status as $key) {
                $google_index_status_array[$key] = Str::upper($key);
            }

            return array_unique($google_index_status_array);
        }

        return array_unique($google_index_status_array);
    }

    /**
     * bing_index
     *
     * @return array for bing_index
     */
    public function bing_index()
    {
        $bing_index_status = \App\Models\Post::pluck('bing_index')->unique();
        $bing_index_status_array = [
            'pending' => 'PENDING',
        ];

        if (! $bing_index_status->isEmpty()) {
            foreach ($bing_index_status as $key) {
                $bing_index_status_array[$key] = Str::upper($key);
            }

            return array_unique($bing_index_status_array);
        }

        return array_unique($bing_index_status_array);
    }

    /**
     * wordpress_transfer
     *
     * @return array for bing_index
     */
    public function wordpress_transfer()
    {
        $wordpress_transfer_status = \App\Models\Post::pluck('wordpress_transfer')->unique();
        $wordpress_transfer_status_array = [
            'pending' => 'PENDING',
        ];

        if (! $wordpress_transfer_status->isEmpty()) {
            foreach ($wordpress_transfer_status as $key) {
                $wordpress_transfer_status_array[$key] = Str::upper($key);
            }

            return array_unique($wordpress_transfer_status_array);
        }

        return array_unique($wordpress_transfer_status_array);
    }

    /**
     * flarum_transfer
     *
     * @return array for bing_index
     */
    public function flarum_transfer()
    {
        $flarum_transfer_status = \App\Models\Post::pluck('flarum_transfer')->unique();
        $flarum_transfer_status_array = [
            'pending' => 'PENDING',
        ];

        if (! $flarum_transfer_status->isEmpty()) {
            foreach ($flarum_transfer_status as $key) {
                $flarum_transfer_status_array[$key] = Str::upper($key);
            }

            return array_unique($flarum_transfer_status_array);
        }

        return array_unique($flarum_transfer_status_array);
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Post::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'post_title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'post_title',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Post Url', function () {
                $post_url = url($this->slug);

                return "<a target='_blank' href=$post_url>View Post</a>";
            })->asHtml(),
            Slug::make('slug')->from('post_title')->hideFromIndex(),

            Text::make('Post Title', 'post_title'),
            Trix::make('Post Description', 'post_description'),

            Select::make('Post Type', 'post_type')
                ->options($this->type_options())
                ->hideFromIndex(),

            Select::make('Post Status', 'status')
                ->options($this->post_status())
                ->hideFromIndex(),

            Select::make('Google Index Status', 'google_index')
                ->options($this->google_index())
                ->hideFromIndex(),

            Select::make('Bing  Index Status', 'bing_index')
                ->options($this->bing_index())
                ->hideFromIndex(),

            Select::make('Flarum Transfer Status', 'flarum_transfer')
                ->options($this->flarum_transfer())
                ->hideFromIndex(),

            Select::make('wordpress Transfer Status', 'wordpress_transfer')
                ->options($this->wordpress_transfer())
                ->hideFromIndex(),

            BelongsTo::make('User', 'user', User::class)->searchable(),

            Text::make('source_value')
                ->hideFromIndex()
                ->rules('required', 'unique:posts,source_value', 'max:255')->hideWhenUpdating(),

            HasMany::make('Post Content', 'PostContent'),

            Tags::make('Tags')->limit(25)->limitSuggestions(25),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
