<x-receptionist.layout>
    <x-receptionist.content>
        <div class="title">Manage Patients</div>
        <Link class="add" href="{{route('receptionist.manage.patients.add')}}">Add New Patients</Link>
        <div class="wrapper" style="">
            <x-splade-table :for="$patients">
                @cell('action',$patient)
                    <Link href="{{route('receptionist.manage.patients.info',['id'=>$patient->id])}}" class="text-blue-500 ms-2"> More Info </Link>
                    {{-- {{-- <Link href="{{route('receptionist.manage.patients.edit',['id'=>$patient->id])}}" class="text-green-500"> Edit </Link> --}}
                    {{-- <Link href="{{route('receptionist.manage.patients.delete',['id'=>$patient->id])}}" method="POST" class="text-red-500 ms-2"> Delete </Link> --}}
                @endcell
            </x-splade-table>
        </div>
    </x-receptionist.content>
</x-receptionist.layout>
