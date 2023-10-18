<x-user.layout>
    <x-user.content class="bg user">
            <div class="title">@lang('titles.avalible') @lang('titles.doctors')</div>
            <div class="wrapper doctors">
                @foreach ($doctors as $doctor)
                <div class="box">
                    <div class="img-box">
                        <img src="{{asset('storage/'.$doctor->image)}}" alt="">
                    </div>
                    <div class="info">
                        <div class="fullname">{{\google_translate($doctor->name, 'ar' , 'em')}}</div>
                        <div class="specialty">{{\google_translate(implode(' ',explode('_',$doctor->specialty)), 'ar' , 'en')}}</div>
                        <div class="book">
                            <Link href="{{route('user.manage.appointments.doctor',['id'=> $doctor->id])}}" class="btn outline-btn">@lang('buttons.book')</Link>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    </x-user.content>
</x-user.layout>
