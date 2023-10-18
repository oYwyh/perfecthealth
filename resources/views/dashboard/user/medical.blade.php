<x-user.layout>
    @php
        $inv = DB::table('users')->where('id', Auth::user()->id)->first();
        $invs = explode(',', $inv->investigations);
        $card = DB::table('users')->where('id', Auth::user()->id)->first();
        $cards = explode(',', $card->insurance_card);
        $id = DB::table('users')->where('id', Auth::user()->id)->first();
        $ids = explode(',', $id->insurance_id);
    @endphp
    <x-user.content class="bg reqver">
        @auth('web')
            @if (Auth::user()->verified == '0')
                <div class="overlay">
                    <div class="note">
                        <div class="group">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
                                <path d="M 25 3 C 18.363281 3 13 8.363281 13 15 L 13 20 L 9 20 C 7.355469 20 6 21.355469 6 23 L 6 47 C 6 48.644531 7.355469 50 9 50 L 41 50 C 42.644531 50 44 48.644531 44 47 L 44 23 C 44 21.355469 42.644531 20 41 20 L 37 20 L 37 15 C 37 8.363281 31.636719 3 25 3 Z M 25 5 C 30.566406 5 35 9.433594 35 15 L 35 20 L 15 20 L 15 15 C 15 9.433594 19.433594 5 25 5 Z M 9 22 L 41 22 C 41.554688 22 42 22.445313 42 23 L 42 47 C 42 47.554688 41.554688 48 41 48 L 9 48 C 8.445313 48 8 47.554688 8 47 L 8 23 C 8 22.445313 8.445313 22 9 22 Z M 25 30 C 23.300781 30 22 31.300781 22 33 C 22 33.898438 22.398438 34.6875 23 35.1875 L 23 38 C 23 39.101563 23.898438 40 25 40 C 26.101563 40 27 39.101563 27 38 L 27 35.1875 C 27.601563 34.6875 28 33.898438 28 33 C 28 31.300781 26.699219 30 25 30 Z"></path>
                            </svg>
                            @lang('messages.verify_access')
                        </div>
                        <Link class="now" id="code" modal href="{{route('code-checker')}}">
                            @lang('buttons.verify')
                        </Link>
                    </div>
                </div>
            @endif
        @endauth
        <div class="medical">
            <div class="title">
                @lang('titles.files')
            </div>
            <x-splade-toggle>
                <div class="toggle mt-4 mb-4">
                    <ul>
                        <li id="investigations" @click.prevent="setToggle(false)">@lang('titles.investigations')</li>
                        <li id="insurance" @click.prevent="setToggle(true)">@lang('titles.insurance')</li>
                    </ul>
                </div>
                <x-splade-transition show="!toggled">
                    <div class="investigations active">
                        <div class="box">
                            <div class="title">
                                @lang('titles.investigations')
                            </div>
                            @if($invs[0] != '')
                            <x-splade-toggle>
                                        <x-splade-transition show="!toggled" style="width:100%">
                                            <div class="img-box">
                                                <div class="row">
                                                    @foreach ($invs as $inv)
                                                        <img id="zoom" src="{{asset('storage/'.$inv)}}" alt="">
                                                    @endforeach
                                                        </div>
                                                            <div class="edit" @click="toggle">@lang('buttons.edit')</div>
                                                    </div>
                                                    <x-splade-script>
                                                        const zoom = document.querySelectorAll('#zoom')
                                                        zoom.forEach(zoom => {
                                                            zoom.addEventListener('click',() => {

                                                                if (document.fullscreenElement) {
                                                                    document.exitFullscreen();
                                                                }else {
                                                                    zoom.requestFullscreen();
                                                                }
                                                            })
                                                        })
                                                    </x-splade-script>
                                        </x-splade-transition>
                                        <x-splade-transition show="toggled" style="width:100%;">
                                            <x-splade-form style="width:100%;" :action="route('user.investigation')" enctype="multipart/form-data">
                                                <div class="group">
                                                    <div class="form-column">
                                                        <label for="investigations">@lang('buttons.add') @lang('labels.investigations')</label>
                                                        <x-splade-file preview filepond class="input" multiple name="investigations[]" />
                                                        <p class="note text-red-500 mt-2">@lang('labels.note') @lang('messages.investigations')</p>
                                                    </div>
                                                </div>
                                                <x-splade-submit class="mt-4" style="width: 100%;" label="Add" />
                                            </x-splade-form>
                                </x-splade-transition>
                            </x-splade-toggle>
                            @else
                                <x-splade-form :action="route('user.investigation')" enctype="multipart/form-data">
                                    <div class="group">
                                        <div class="form-column">
                                            <label for="investigations">@lang('buttons.add') @lang('labels.investigations')</label>

                                            <x-splade-file preview filepond class="input" multiple name="investigations[]" />

                                        </div>
                                    </div>
                                    <x-splade-submit class="mt-4" style="width: 100%;">
                                        @lang('buttons.add')
                                    </x-splade-submit>
                                </x-splade-form>
                            @endif
                        </div>
                    </div>
                </x-splade-transition>
                <x-splade-transition show="toggled">
                    <div class="insurance active">
                        <div class="box">
                            <div class="title">
                                @lang('titles.insurance')
                            </div>
                            @if($ids[0] != '' || $cards[0] != '' || $card->insurance != '')
                                <x-splade-toggle>
                                    <x-splade-transition  style="width: 100%;" show="!toggled">
                                        <div class="txt-box">
                                            <div class="txt">
                                                @if (Session::get('locale') == 'en')
                                                @lang('titles.insurance') @lang('titles.company'): <span>{{$card->insurance}}</span>
                                                @else
                                                @lang('titles.insurance') @lang('titles.company'): <span>{{\google_translate(implode(' ',explode('_',$card->insurance)),'ar','en')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="img-box" id="card">
                                            <div class="txt">
                                                @lang('titles.insurance') @lang('titles.card')
                                            </div>
                                            <div class="row">
                                                @if($cards[0] != '')
                                                    @foreach ($cards as $inv)
                                                        <img id="zoom" src="{{asset('storage/'.$inv)}}" alt="">
                                                    @endforeach
                                                @else
                                                <div class="err text-red-500">@lang('messages.noData')</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="img-box" id="id">
                                            <div class="txt">
                                                @lang('messages.id_or_pass')
                                            </div>
                                            <div class="row">
                                                @if($ids[0] != '')
                                                    @foreach ($ids as $inv)
                                                        <img id="zoom" src="{{asset('storage/'.$inv)}}" alt="">
                                                    @endforeach
                                                @else
                                                <div class="err text-red-500">@lang('messages.noData')</div>
                                                @endif
                                            </div>
                                        </div>
                                        @if($ids[0] == '' && $cards[0] == '')
                                            <div class="edit mt-4"  @click.prevent="toggle">@lang('buttons.add')</div>
                                        @else
                                            <div class="edit mt-4"  @click.prevent="toggle">@lang('buttons.edit')</div>
                                        @endif
                                        <x-splade-script>
                                            const zoom = document.querySelectorAll('#zoom')
                                            zoom.forEach(zoom => {
                                                zoom.addEventListener('click',() => {

                                                    if (document.fullscreenElement) {
                                                        document.exitFullscreen();
                                                    }else {
                                                        zoom.requestFullscreen();
                                                    }
                                                })
                                            })
                                        </x-splade-script>
                                    </x-splade-transition>
                                    <x-splade-transition style="width: 100%" show="toggled">
                                        <x-splade-form style="width:100%;" :action="route('user.insurance')" enctype="multipart/form-data">
                                            <div class="group">
                                                <div class="form-column" style="width: 100%;">
                                                    <label for="insurance">@lang('titles.insurance') @lang('titles.company')</label>
                                                    @if (Session::get('locale') == 'en')
                                                        <x-splade-select class="input" name="insurance" choices>
                                                            <option value="" disabled selected>Select</option>
                                                            @foreach ($insurances as $key => $insurance)
                                                                <option value="{{$insurance->title}}">{{$insurance->title}}</option>
                                                            @endforeach
                                                        </x-splade-select>
                                                        @else
                                                        <x-splade-select class="input" name="insurance" choices>
                                                            <option value="" disabled selected>أختر</option>
                                                            @foreach ($insurances as $key => $insurance)
                                                                <option value="{{ $insurance->title }}">{{ $insurance->title_ar }}</option>
                                                            @endforeach
                                                        </x-splade-select>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="group mt-4">
                                                <div class="form-column" style="width: 100%;">
                                                    <label for="insurance">@lang('titles.insurance') @lang('titles.company')</label>
                                                    <x-splade-file preview multiple filepond class="input" name="insurance_card[]" />
                                                </div>
                                            </div>
                                            <div class="group mt-4">
                                                <div class="form-column" style="width: 100%;">
                                                    <label for="insurance">@lang('messages.id_or_pass') </label>
                                                    <x-splade-file preview multiple filepond class="input" name="insurance_id[]" />
                                                </div>
                                            </div>
                                            <x-splade-submit class="mt-4" style="width: 100%;">
                                                @lang('buttons.add')
                                            </x-splade-submit>
                                        </x-splade-form>
                                    </x-splade-transition>
                                </x-splade-toggle>
                            @else
                                <x-splade-form style="width:100%;" :action="route('user.insurance')" enctype="multipart/form-data">
                                    <div class="group">
                                        <div class="form-column" style="width: 100%;">
                                            <label for="insurance">@lang('titles.insurance') @lang('titles.company')</label>
                                            @if (Session::get('locale') == 'en')
                                                <x-splade-select class="input" name="insurance" choices>
                                                    <option value="" disabled selected>Select</option>
                                                    @foreach ($insurances as $key => $insurance)
                                                        <option value="{{$insurance->title}}">{{$insurance->title}}</option>
                                                    @endforeach
                                                </x-splade-select>
                                                @else
                                                <x-splade-select class="input" name="insurance" choices>
                                                    <option value="" disabled selected>أختر</option>
                                                    @foreach ($insurances as $key => $insurance)
                                                        <option value="{{ $insurance->title }}">{{ $insurance->title_ar }}</option>
                                                    @endforeach
                                                </x-splade-select>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="group mt-4">
                                        <div class="form-column" style="width: 100%;">
                                            <label for="insurance">@lang('titles.insurance') @lang('titles.company')</label>
                                            <x-splade-file preview multiple filepond class="input" name="insurance_card[]" />
                                        </div>
                                    </div>
                                    <div class="group mt-4">
                                        <div class="form-column" style="width: 100%;">
                                            <label for="insurance">@lang('messages.id_or_pass') </label>
                                            <x-splade-file preview multiple filepond class="input" name="insurance_id[]" />
                                        </div>
                                    </div>
                                    <p class="note text-red-500 mt-2">@lang('labels.note'): @lang('messages.insurances') </p>
                                    <x-splade-submit class="mt-4" style="width: 100%;">
                                        @lang('buttons.add')
                                    </x-splade-submit>
                                </x-splade-form>
                            @endif
                        </div>
                    </div>
                </x-splade-transition>
            </x-splade-toggle>

        </div>
    </x-user.content>
    <x-splade-script>
        {{-- const li = document.querySelectorAll('.toggle ul li')
        const investigations = document.querySelector('.investigations')
        const insurance = document.querySelector('.insurance')

        li.forEach(li => {
            li.addEventListener('click',() => {
                switch(li.id) {
                    case 'investigations':
                        investigations.classList.add('active')
                        insurance.classList.remove('active')
                    break;
                    case 'insurance':
                        investigations.classList.remove('active')
                        insurance.classList.add('active')
                    break;
                }
            })
        }) --}}
    </x-splade-script>
</x-user.layout>
