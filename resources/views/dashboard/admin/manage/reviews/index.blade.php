<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('titles.manage') @lang('titles.reviews')</div>
        <Link class="add" href="{{route('admin.manage.reviews.add')}}">@lang('buttons.add') @lang('titles.review')</Link>
        <div class="wrapper" style="">
            <x-splade-table :for="$reviews">
                @cell('action',$review)
                @if ($review->verified == 0)
                    <Link modal href="{{route('admin.manage.reviews.verify-form',['id'=>$review->id])}}" class="text-green-500"> @lang('buttons.verify') </Link>
                    @else
                    <Link href="{{route('admin.manage.reviews.disprove',['id'=>$review->id])}}" method="POST" class="text-red-500"> @lang('buttons.disprove') </Link>
                    @endif
                @endcell
                @cell('verified',$review)
                @if ($review->verified == 1)
                    <Link href="{{route('admin.manage.reviews.disprove',['id'=>$review->id])}}" method="POST" class="text-green-500 ms-2"> @lang('buttons.true') </Link>
                    @else
                    <Link href="{{route('admin.manage.reviews.verify-form',['id'=>$review->id])}}" method="GET" modal class="text-orange-500 ms-2"> @lang('buttons.false') </Link>
                @endif
            @endcell
            </x-splade-table>
        </div>
    </x-admin.content>
</x-admin.layout>
