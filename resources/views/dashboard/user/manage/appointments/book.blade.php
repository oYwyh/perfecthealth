<x-user.layout>
    <x-user.content class="bg">
        <div class="title">@lang('buttons.book') @lang('titles.appointment')</div>
            <x-splade-form :action="Route('user.manage.appointments.book',['doctor'=>$doctor->id])" method="POST" autocomplete="off">
                <div class="form-group mt-2">
                    @if(Session::get('locale') == 'en')
                        <div class="form-column">
                            <label for="name">@lang('labels.fullname')</label>
                            <x-splade-input class="input capital" name="name" placeholder="{{$doctor->first_name . ' ' . $doctor->last_name}}" disabled />
                        </div>
                        @else
                        <div class="form-column">
                            <label for="name">@lang('labels.fullname')</label>
                            <x-splade-input class="input capital" name="name" placeholder="{{\google_translate($doctor->name , 'ar' , 'en')}}" disabled />
                        </div>

                    @endif
                    @if(Session::get('locale') == 'en')
                        <div class="form-column">
                            <label for="specialty">@lang('labels.specialty')</label>
                            <x-splade-input class="input capital" name="specialty" placeholder="{{implode(' ',explode('_',$doctor->specialty))}}" disabled />
                        </div>

                        @else
                        <div class="form-column">
                            <label for="specialty">@lang('labels.specialty')</label>
                            <x-splade-input class="input capital" name="specialty" placeholder="{{\google_translate(implode(' ',explode('_',$doctor->specialty)), 'ar' , 'en ' )}}" disabled />
                        </div>

                    @endif
                </div>
                <div class="group mt-2">
                    <div class="form-column">
                        <label for="date">@lang('labels.avalible') @lang('labels.date')</label>
                        <x-splade-group name="date">
                            @foreach($date as $day => $hours)
                            @if(Session::get('locale') == 'en')
                                <p>- {{$carbon->parse($day)->format('l, F jS')}}</p> <!-- Add the day name here -->
                            @else
                                <p>- {{\google_translate($carbon->parse($day)->format('l, F jS'),'ar','en')}}</p> <!-- Add the day name here -->
                            @endif

                                @foreach($hours as $hour)
                                    @php
                                        $lol = explode('-',$hour);
                                    @endphp
                                    @foreach ($lol as $lol)
                                        <x-splade-radio name="date" value="{{$day . 'T' . $lol . ':00:00'}}" label="{{$carbon->parse($day . 'T' . $lol . ':00:00')->format('g:i A')}}" />
                                    @endforeach
                                @endforeach
                            @endforeach
                        </x-splade-group>
                    </div>
                    <p class="note mt-4 text-red-500">@lang('labels.note') : @lang('messages.provide')</p>
                    <x-splade-submit class="mt-4" style="width:100%;">
                        @lang('buttons.book')
                    </x-splade-submit>
                </div>
            </x-splade-form>
    </x-user.content>
</x-user.layout>
