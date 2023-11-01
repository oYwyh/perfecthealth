<?php

namespace App\Tables;

use App\Models\Review;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;

class Reviews extends AbstractTable
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
        return Review::query();
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
        ->column('content')
        ->column('stars')
        ->column('verified')
        ->column('created_at')
        ->column('action',exportAs:false)
        ->bulkAction(
            label: 'Touch timestamp',
            each: fn (Review $review) => $review->touch(),
            before: fn () => info('Touching the selected reviews'),
            after: fn () => Toast::info('Timestamps updated!')
        )
        ->bulkAction(
            label: 'Remove Users',
            each: fn (Review $review) => $review->delete(),
            before: fn () => info('Remove the selected reviews'),
            after: fn () => Toast::info('Reviews Removed!')
        )
        ->selectFilter('verified', [
            '1' => 'verified',
            '0' => 'not_verified',
        ])
        ->export()
        ->paginate(20);
    }
}
