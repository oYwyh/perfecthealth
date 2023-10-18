<x-admin.layout>
    <x-admin.content class="bg">
        <div class="title">@lang('titles.manage') @lang('titles.receptionists')</div>
        <Link class="add" href="{{route('admin.manage.receptionists.add')}}">@lang('buttons.add') @lang('titles.receptionist')</Link>
        <div class="wrapper" style="">
            <x-splade-table :for="$receptionists">
                {{-- @cell('action',$receptionist)
                    <Link href="{{route('admin.manage.receptionists.edit',['id'=>$receptionist->id])}}" class="text-green-500"> Edit </Link>
                    <Link href="{{route('admin.manage.receptionists.delete',['id'=>$receptionist->id])}}" method="POST" class="text-red-500 ms-2"> Delete </Link>
                @endcell --}}
                @cell('work_days',$receptionist)
                <p>{{str_replace('|',',',$receptionist->days)}}</p>
                @endcell
                @cell('work_hours',$receptionist)
                    @php
                        $days = explode('|', $receptionist->hours);
                        $formattedDays = [];

                        foreach ($days as $day) {
                            $dayParts = explode('_', $day);
                            $dayName = substr($dayParts[0], 0, 3);
                            $hours = explode(',', $dayParts[1]);

                            $formattedHours = [];
                            foreach ($hours as $hour) {
                                $hourParts = explode('-', $hour);
                                $startHour = date("ga", strtotime($hourParts[0] . ":00"));
                                $endHour = date("ga", strtotime($hourParts[1] . ":00"));
                                $formattedHours[] = $startHour . ' to ' . $endHour;
                            }

                            $formattedDays[] = $dayName . ' => ' . implode(' , ', $formattedHours);
                        }

                        echo '<p style="text-transform: capitalize;">'. implode(' | ', $formattedDays) .'</p>'
                    @endphp
                @endcell
                @cell('full_control',$receptionist)
                    <Link href="{{route('admin.manage.receptionists.control',['id'=>$receptionist->id])}}" class="text-blue-500">Full Control</Link>
                @endcell

            </x-splade-table>
        </div>
    </x-admin.content>
</x-admin.layout>
