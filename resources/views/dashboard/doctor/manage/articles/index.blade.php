<x-doctor.layout>
    <x-doctor.content class="bg">
        <div class="title">Manage Articles</div>
        <Link class="add" href="{{route('doctor.manage.articles.add')}}">Add New Article</Link>
        <div class="wrapper" style="">
            <x-splade-table :for="$articles">
                @cell('action',$article)
                    <Link href="{{route('doctor.manage.articles.edit',['id'=>$article->id])}}" class="text-green-500"> Edit </Link>
                    <Link href="{{route('doctor.manage.articles.delete',['id'=>$article->id])}}" method="POST" class="text-red-500 ms-2"> Delete </Link>
                @endcell
                @cell('verified',$article)
                    @if ($article->verified == 0)
                        <Link class="capitalize text-red-500 ms-2">Pending</Link>
                    @else
                        <Link  class="capitalize text-green-500 ms-2">True</Link>
                    @endif
                @endcell
            </x-splade-table>
        </div>
    </x-doctor.content>
</x-doctor.layout>
