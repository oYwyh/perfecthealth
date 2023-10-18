<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('titles.manage') @lang('titles.insurance')</div>
        <Link class="add" href="{{route('admin.manage.insurances.add')}}">@lang('buttons.add') @lang('titles.insurance')</Link>
        <div class="wrapper" style="">
            <x-splade-table :for="$insurances">
                @cell('action',$insurance)
                    <Link href="{{route('admin.manage.insurances.edit',['id'=>$insurance->id])}}" class="text-green-500"> @lang('buttons.edit') </Link>
                    <Link href="{{route('admin.manage.insurances.delete',['id'=>$insurance->id])}}" method="POST" class="text-red-500 ms-2"> @lang('buttons.delete') </Link>
                @endcell
                @cell('frontpage',$insurance)
                @if ($insurance->frontpage == 0)
                    <Link href="{{route('admin.manage.insurances.verify',['id'=>$insurance->id])}}"  method="POST" class="capitalize text-red-500 ms-2">@lang('buttons.false')</Link>
                @else
                    <Link href="{{route('admin.manage.insurances.disprove',['id'=>$insurance->id])}}"   method="POST" class="capitalize text-green-500 ms-2">@lang('buttons.true')</Link>
                @endif
            @endcell
            </x-splade-table>
        </div>
    </x-admin.content>
</x-admin.layout>
