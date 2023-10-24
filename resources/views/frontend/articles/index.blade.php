
<x-frontend.layout>
    <style>
        .front-main {
            margin: 0 !important;
            padding: 0
        }
    </style>
    <div class="articles">
        <div class="main-title">
            <div class="group">
                <div class="title">@lang('articlespage.title')</div>
                <x-partials.search />

            </div>
        </div>
        <div class="wrapper">
            <div class="big-box">
                @if (count($articles) != '0')
                <div class="article-box">
                    @foreach ($articles as $article)
                        <div class="box">
                            <div class="overlay">
                                <Link class="btn outline-btn" href="/articles/{{$article->id}}">
                                    @lang('buttons.read')
                                </Link>
                            </div>
                            <div class="img-box">
                                @if(Session::get('locale') == 'en')
                                        @if (Storage::exists('public/'. $article->image))
                                            <img src="{{asset('storage/'.$article->image)}}" alt="image" class="img">
                                        @else
                                            <img src="{{asset('storage/'.'images/articles/thumbnails/default.png')}}" alt="">
                                        @endif
                                    @else
                                        @if (Storage::exists('public/'. $article->image_ar))
                                            <img src="{{asset('storage/'.$article->image_ar)}}" alt="image" class="img">
                                        @else
                                            <img src="{{asset('storage/'.'images/articles/thumbnails/default.png')}}" alt="">
                                        @endif
                                @endif
                            </div>
                            <div class="column">
                                <div class="title">
                                    @if(Session::get('locale') == 'en')
                                        {{$article->title}}
                                    @else
                                        {{$article->title_ar}}
                                    @endif
                                </div>
                                <div class="description">
                                    @if(Session::get('locale') == 'en')
                                        {{ \Illuminate\Support\Str::limit($article->description, 60) }}
                                    @else
                                        {{ \Illuminate\Support\Str::limit($article->description_ar, 60) }}
                                    @endif
                                </div>
                                <div class="date">
                                    @php
                                        $date = Carbon\Carbon::parse($article->created_at)->format('l, F jS');
                                    @endphp
                                    @if(Session::get('locale') == 'en')
                                        {{$date}}
                                        @else
                                        {{\google_translate($date,'ar','en')}}
                                    @endif
                                </div>
                                <ul class="tags">
                                    @if(Session::get('locale') == 'en')
                                        @foreach(explode(',',$article->tags) as $tag)
                                            <li>
                                                <Link class="link outline-btn" href="/articles?tag={{$tag}}">{{$tag}}</Link>
                                            </li>
                                        @endforeach
                                    @else
                                        @foreach(explode(',',$article->tags_ar) as $tag)
                                            <li>
                                                <Link class="link outline-btn" href="/articles?tag={{$tag}}">{{$tag}}</Link>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <Link href="/articles/{{$article->id}}" class="btn primary-btn">
                                    @lang('buttons.read')
                                </Link>
                            </div>
                        </div>
                    @endforeach
                </div>
                    {{ $articles->links('vendor.pagination.bootstrap-5') }}
                    {{-- {{ $articles->links() }} --}}
                @else
                    <p class="note text-red-500" style="font-size: 30px;">@lang('messages.noArticles')</p>
                @endif
            </div>
        </div>
    </div>
</x-frontend.layout>
