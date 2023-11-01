<?php

namespace App\Tables;

use App\Models\Mail;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;

class Mails extends AbstractTable
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
        return Mail::query();
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
            ->column('title')
            ->column('description')
            ->column('action', exportAs:false)
            ->bulkAction(
                label: 'Touch timestamp',
                each: fn (Mail $mail) => $mail->touch(),
                before: fn () => info('Touching the selected Mail'),
                after: fn () => Toast::info('Timestamps updated!')
            )
            ->bulkAction(
                label: 'Remove Mail',
                each: fn (Mail $mail) => $mail->delete(),
                before: fn () => info('Remove the selected Mail'),
                after: fn () => Toast::info('Mail Removed!')
            )
            ->export()
            ->paginate(20);
    }
}
