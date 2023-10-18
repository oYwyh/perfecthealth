<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('titles.manage') @lang('titles.articles')</div>
        <Link class="add" href="{{route('admin.manage.articles.add')}}">@lang('buttons.add') @lang('titles.article')</Link>
        <div class="wrapper" style="">
            <x-splade-table :for="$articles">
                @cell('action',$article)
                    <Link href="{{route('admin.manage.articles.edit',['id'=>$article->id,'oldImage' => $article->image])}}" class="text-green-500"> @lang('buttons.edit') </Link>
                    <Link href="{{route('admin.manage.articles.delete',['id'=>$article->id])}}" method="POST" class="text-red-500 ms-2"> @lang('buttons.delete') </Link>

                @endcell
                @cell('verified',$article)
                    @if ($article->verified == 0)
                        <Link href="{{route('admin.manage.articles.verify',['id'=>$article->id])}}" method="POST" class="text-green-500 ms-2"> @lang('buttons.verify') </Link>
                        @else
                        <Link href="{{route('admin.manage.articles.disprove',['id'=>$article->id])}}" method="POST" class="text-orange-500 ms-2"> @lang('buttons.disprove') </Link>
                    @endif
                @endcell
            </x-splade-table>
        </div>
    </x-admin.content>
</x-admin.layout>
