<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('titles.manage') @lang('titles.services')</div>
        <Link class="add" href="{{route('admin.manage.services.add')}}">@lang('buttons.add') @lang('titles.service')</Link>
        <div class="wrapper" style="">
            <x-splade-table :for="$services">
                @cell('action',$service)
                    <Link href="{{route('admin.manage.services.edit',['id'=>$service->id,'oldImage' => $service->image])}}" class="text-green-500"> @lang('buttons.edit') </Link>
                    <Link href="{{route('admin.manage.services.delete',['id'=>$service->id])}}" method="POST" class="text-red-500 ms-2">  @lang('buttons.delete') </Link>
                @endcell
                @cell('frontpage',$service)
                    @if ($service->frontpage == 0)
                        <Link href="{{route('admin.manage.services.verify',['id'=>$service->id])}}"  method="POST" class="capitalize text-red-500 ms-2">@lang('buttons.false')</Link>
                    @else
                        <Link href="{{route('admin.manage.services.disprove',['id'=>$service->id])}}"   method="POST" class="capitalize text-green-500 ms-2">@lang('buttons.true')</Link>
                    @endif
                @endcell
            </x-splade-table>
        </div>
    </x-admin.content>
</x-admin.layout>
