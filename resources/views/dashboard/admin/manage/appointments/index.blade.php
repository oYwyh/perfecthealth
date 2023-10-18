<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('titles.manage') @lang('titles.appointments')</div>
        <div class="wrapper" style="">
            <x-splade-table :for="$appointments">
                @cell('status',$app)
                    @if ($app->status == 'seen')
                        <p class="text-orange-500">@lang('labels.seen')</p>
                    @else
                        <p class="text-red-500">@lang('labels.pending')</p>
                    @endif
                @endcell
                @cell('action',$app)
                    @if ($app->status == 'seen')
                        <Link href="{{route('admin.manage.appointments.results',['patient_id'=>$app->patient_id,'app_id' => $app->id])}}" class="capitalize text-blue-500 ms-2">@lang('buttons.resaults')</Link>
                    @else
                        <Link href="{{route('admin.manage.appointments.delete',['id' => $app->id])}}" class="capitalize text-red-500 ms-2">@lang('buttons.cancle')</Link>
                    @endif
                @endcell
            </x-splade-table>
        </div>
    </x-admin.content>
</x-admin.layout>
