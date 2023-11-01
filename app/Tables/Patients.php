<?php

namespace App\Tables;

use App\Models\Patient;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;

class Patients extends AbstractTable
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
        return Patient::query();
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
        ->column('name', canBeHidden:false , sortable: true)
        ->column('phone', sortable: false)
        ->column('gender', sortable: false)
        ->column('age', sortable: false)
        ->column('address', sortable: false)
        ->column('national_id', sortable: false)
        ->column('type')
        ->column('action',exportAs:false)
        ->bulkAction(
            label: 'Touch timestamp',
            each: fn (Patient $patient) => $patient->touch(),
            before: fn () => info('Touching the selected Users'),
            after: fn () => Toast::info('Timestamps updated!')
        )
        ->bulkAction(
            label: 'Remove Users',
            each: fn (Patient $patient) => $patient->delete(),
            before: fn () => info('Remove the selected Users'),
            after: fn () => Toast::info('Users Removed!')
        )
        ->selectFilter('type', [
            'in_patient' => 'in_patient',
            'out_patient' => 'out_patient',
        ])
        ->export()
        ->paginate(20);
    }
}
