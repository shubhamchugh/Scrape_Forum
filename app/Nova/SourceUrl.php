<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SourceUrl extends Resource
{
    /**
     * is_scraped
     *
     * @return array for is_scraped
     */
    public function is_scraped()
    {
        $is_scraped_status = \App\Models\SourceUrl::pluck('is_scraped')->unique();
        $is_scraped_status_array = [
            'pending' => 'PENDING',
        ];

        if (! $is_scraped_status->isEmpty()) {
            foreach ($is_scraped_status as $key) {
                $is_scraped_status_array[$key] = Str::upper($key);
            }

            return array_unique($is_scraped_status_array);
        }

        return array_unique($is_scraped_status_array);
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\SourceUrl::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'value';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'value',
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

            Select::make('is_scraped Status', 'is_scraped')
                ->options($this->is_scraped())
                ->hideFromIndex(),

            Text::make('Value', 'value'),
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
