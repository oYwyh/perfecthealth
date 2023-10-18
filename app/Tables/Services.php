<?php

namespace App\Tables;

use App\Models\Service;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;

class Services extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Service::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
        ->withGlobalSearch(columns: ['id','name','email'])
        ->column('id', sortable: true)
        ->column('title', canBeHidden:false , sortable: false)
        ->column('tags')
        ->column('frontpage')
        ->column('created_at')
        ->column('action',exportAs:false)
        ->bulkAction(
            label: 'Touch timestamp',
            each: fn (Service $service) => $service->touch(),
            before: fn () => info('Touching the selected Users'),
            after: fn () => Toast::info('Timestamps updated!')
        )
        ->bulkAction(
            label: 'Remove Users',
            each: fn (Service $service) => $service->delete(),
            before: fn () => info('Remove the selected Users'),
            after: fn () => Toast::info('Users Removed!')
        )
        ->selectFilter('frontpage', [
            'true' => 'frontpage',
            'false' => 'hidden',
        ])
        ->export()
        ->paginate(5);
    }
}
