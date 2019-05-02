<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Extension extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Extension';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'number';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'number', 'name'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Number::make('Number')
                ->sortable()
                ->rules('required','min:3','max:3')
                ->creationRules('unique:extensions,number')
                ->updateRules('unique:extensions,number,{{resourceId}}'),
            Text::make('Name')
                ->sortable()
                ->rules('required','max:255'),
            Textarea::make('Message')
                ->rules('required')
                ->hideFromIndex(),
            Textarea::make('Transfer Prompt')
                ->withMeta(['value' => $this->transfer_prompt ?? 'Would you like additional photos and current pricing for this property? If so, say yes.'])
                ->rules('required')
                ->hideFromIndex(),
            Textarea::make('Voicemail Prompt')
                ->withMeta(['value' => $this->transfer_prompt ?? 'I\'m sorry our listing agent Bob Ross is currently helping another caller. You can expect a return call from him shortly, or would you like to leave a voicemail? If so, say yes.'])
                ->rules('required')
                ->hideFromIndex(),
            BelongsToMany::make('Agents'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
