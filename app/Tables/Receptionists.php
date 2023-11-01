<?php

namespace App\Tables;

use App\Models\Receptionist;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;

class Receptionists extends AbstractTable
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
        return Receptionist::query();
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
        ->withGlobalSearch(columns: ['id','name','email','phone','first_name','last_name'])
        ->column('id', sortable: true)
        ->column('first_name', canBeHidden:false , sortable: true)
        ->column('last_name', canBeHidden:false , sortable: true)
        ->column('email', sortable: false)
        ->column('phone', sortable: false)
        ->column('work_days')
        ->column('work_hours')
        ->column('full_control',exportAs:false)
        ->bulkAction(
            label: 'Touch timestamp',
            each: fn (Receptionist $receptionist) => $receptionist->touch(),
            before: fn () => info('Touching the selected Users'),
            after: fn () => Toast::info('Timestamps updated!')
        )
        ->bulkAction(
            label: 'Remove Users',
            each: fn (Receptionist $receptionist) => $receptionist->delete(),
            before: fn () => info('Remove the selected Users'),
            after: fn () => Toast::info('Users Removed!')
        )
        ->export()
        ->paginate(20);
    }
}
