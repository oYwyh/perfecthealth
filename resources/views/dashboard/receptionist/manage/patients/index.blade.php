<x-receptionist.layout>
    <x-receptionist.content class="bg">
        <div class="title">@lang('titles.manage') @lang('titles.patients')</div>
        <Link class="add" href="{{route('receptionist.manage.patients.add')}}">@lang('buttons.add') @lang('titles.patient')</Link>
        <div class="wrapper" style="">
            <x-splade-table :for="$patients">
                @cell('action',$patient)
                    <Link href="{{route('receptionist.manage.patients.info',['id'=>$patient->id])}}" class="text-blue-500 ms-2"> @lang('buttons.fullcontrol')  </Link>
                    {{-- <Link href="{{route('receptionist.manage.patients.edit',['id'=>$patient->id])}}" class="text-green-500"> Edit </Link>
                    <Link href="{{route('receptionist.manage.patients.delete',['id'=>$patient->id])}}" method="POST" class="text-red-500 ms-2"> Delete </Link> --}}
                @endcell
            </x-splade-table>
        </div>
    </x-receptionist.content>
</x-receptionist.layout>
