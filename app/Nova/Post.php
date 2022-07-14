<?php

namespace App\Nova;

use App\Nova\User;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Post extends Resource
{

    /**
     * type_options
     *
     * @return array for post_type like post,article
     */
    public function type_options()
    {

        $post_type       = \App\Models\Post::pluck('post_type')->unique();
        $post_type_array = [
            'post'    => 'POST',
            'article' => 'ARTICLE',
        ];

        if (!$post_type->isEmpty()) {
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

        $post_status       = \App\Models\Post::pluck('status')->unique();
        $post_status_array = [
            'publish' => 'PUBLISH',
            'draft'   => 'DRAFT',
        ];

        if (!$post_status->isEmpty()) {
            foreach ($post_status as $key) {
                $post_status_array[$key] = Str::upper($key);
            }
            return array_unique($post_status_array);
        }
        return array_unique($post_status_array);
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
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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

            BelongsTo::make('User', 'user', User::class)->searchable(),

            Text::make('source_value')
                ->hideFromIndex()
                ->rules('required', 'unique:posts,source_value', 'max:255')->hideWhenUpdating(),
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
