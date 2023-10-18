<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('titles.manage') @lang('titles.patients')</div>

        <Link class="add" href="{{route('admin.manage.patients.add')}}">@lang('buttons.add') @lang('titles.patient')</Link>
        <div class="wrapper" style="">
            <x-splade-table :for="$patients">
                @cell('action',$patient)
                    <Link href="{{route('admin.manage.patients.info',['id'=>$patient->id])}}" class="text-blue-500 ms-2"> More Info </Link>
                @endcell
            </x-splade-table>
        </div>
    </x-admin.content>
</x-admin.layout>
