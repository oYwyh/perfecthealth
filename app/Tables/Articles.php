<?php

namespace App\Tables;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;

class Articles extends AbstractTable
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
        if(Route::currentRouteName() == 'admin.manage.articles.index') {
            return Article::query();
        }else {
            return Article::query()->where('author' , 'doctor-'.Auth::user()->id);
        }
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
        ->withGlobalSearch(columns: ['id'])
        ->column('id', sortable: true)
        ->column('title', canBeHidden:false , sortable: false)
        ->column('tags')
        ->column('verified')
        ->column('created_at')
        ->column('action',exportAs:false)
        ->bulkAction(
            label: 'Touch timestamp',
            each: fn (Article $art) => $art->touch(),
            before: fn () => info('Touching the selected Users'),
            after: fn () => Toast::info('Timestamps updated!')
        )
        ->bulkAction(
            label: 'Remove Users',
            each: fn (Article $art) => $art->delete(),
            before: fn () => info('Remove the selected Users'),
            after: fn () => Toast::info('Users Removed!')
        )
        ->selectFilter('verified', [
            '1' => 'true',
            '0' => 'false',
        ])
        ->export()
        ->paginate(20);
    }
}
