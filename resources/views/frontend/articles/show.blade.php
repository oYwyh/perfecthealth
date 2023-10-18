<x-frontend.layout>
    <style>
        .front-main {
            margin: 0 !important;
        }
        <style>
        .social-btn #social-links {
            margin: 0 auto;
            max-width: 40%;
        }

        #social-links ul {
            margin-bottom: 0px;
        }

        .social-btn #social-links ul li {
            display: inline-block;
        }

        .social-btn #social-links ul li a {
            padding: 15px;
            border: 1px solid #8b8484;
            margin: 1px;
            font-size: 20px;
            color: #000;
            margin-right: 10px;
        }

        table #social-links {
            display: inline-table;
        }

        table #social-links ul li {
            display: inline;
        }

        table #social-links ul li a {
            padding: 5px;
            border: 1px solid #8b8484;
            margin: 1px;
            font-size: 14px;
            color: #000;
            margin-right: 10px;
        }
    </style>
    <div class="article">
        <div class="wrapper">
            @if(Session::get('locale') == 'en')
                @php
                    $tags = explode(',',$article->tags);
                @endphp
                <div class="main-article">
                    <div class="img-box">
                        @if (Storage::exists('public/'. $article->image))
                            <img src="{{asset('storage/'.$article->image)}}"alt="">
                        @else
                            <img src="{{asset('storage/'.'images/articles/thumbnails/default.png')}}" alt="">
                        @endif
                    </div>
                    <div class="box">
                        <div class="info">
                            <div class="title">{{$article->title}}</div>
                            <div class="description">{{$article->description}}</div>
                        </div>
                        <div class="author">
                            <div class="main-box">
                                <div class="img-box">
                                    <img src="{{asset('storage/'.$author->image)}}" alt="">
                                </div>
                                <div class="column">
                                    <div class="row">
                                        <div class="name">{{$author->first_name}} {{$author->last_name}}</div>
                                        <div class="username">&#64;{{$author->name}}</div>
                                    </div>
                                    <div class="date">
                                            {{$carbon->parse($article->created_at)->format('l, F jS')}}
                                    </div>
                                </div>
                            </div>
                            <div class="social-box">
                                <ul>
                                    @if (isset($author->facebook))
                                        <li><a class="link" href="{{$author->facebook}}" target="_blanck"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    @endif
                                    @if (isset($author->twitter))
                                        <li><a class="link" href="{{$author->twitter}}" target="_blanck"><i class="fa-brands fa-twitter"></i></a></li>
                                    @endif
                                    @if (isset($author->instagram))
                                        <li><a class="link" href="{{$author->instagram}}" target="_blanck"><i class="fa-brands fa-instagram"></i></a></li>
                                    @endif
                                    @if (isset($author->linkedin))
                                        <li><a class="link" href="{{$author->linkedin}}" target="_blanck"><i class="fa-brands fa-linkedin"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="content">
                            {!! $article->content !!}
                        </div>
                        <div class="tags">
                            <div class="title">@lang('articlespage.tags')</div>
                            <ul>
                                @foreach($tags as $tag)
                                    <li>
                                        <Link class="link" class="outline-btn" href="/articles?tag={{$tag}}">{{$tag}}</Link>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="social-share">
                            <div class="title">@lang('articlespage.share')</div>
                            <ul>
                                @foreach($shareLinks as $platform => $link)
                                    <li><a class="link" href="{{ $link }}"><i class="fa-brands fa-{{ $platform }}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
                @else
                @php
                    $tags_ar = explode(',',$article->tags_ar);
                @endphp
                <div class="main-article">
                    <div class="img-box">
                        @if (Storage::exists('public/'. $article->image_ar))
                            <img src="{{asset('storage/'.$article->image_ar)}}"alt="">
                        @else
                            <img src="{{asset('storage/'.'images/articles/thumbnails/default.png')}}" alt="">
                        @endif
                    </div>
                    <div class="box">
                        <div class="info">
                            <div class="title">{{$article->title_ar}}</div>
                            <div class="description">{{$article->description_ar}}</div>
                        </div>
                        <div class="author">
                            <div class="main-box">
                                <div class="img-box">
                                    <img src="{{asset('storage/'.$author->image)}}" alt="">
                                </div>
                                <div class="column">
                                    <div class="row">
                                        <div class="name">{{$author->first_name}} {{$author->last_name}}</div>
                                        <div class="username">&#64;{{$author->name}}</div>
                                    </div>
                                    <div class="date">
                                            {{Stichoza\GoogleTranslate\GoogleTranslate::trans($carbon->parse($article->created_at)->format('l, F jS'), 'ar', 'en')}}
                                            @php
                                            $date = Carbon\Carbon::parse($article->created_at)->format('l, F jS');
                                            @endphp
                                            {{ Cache::remember('translation.'.$date, 60, function () use($date) {
                                                return Stichoza\GoogleTranslate\GoogleTranslate::trans($date, 'ar', 'en');
                                            }) }}
                                    </div>
                                </div>
                            </div>
                            <div class="social-box">
                                <ul>
                                    @if (isset($author->facebook))
                                        <li><Link away class="link" href="{{$author->facebook}}"><i class="fa-brands fa-facebook-f"></i></Link></li>
                                    @endif
                                    @if (isset($author->twitter))
                                        <li><Link away class="link" href="{{$author->twitter}}"><i class="fa-brands fa-twitter"></i></Link></li>
                                    @endif
                                    @if (isset($author->instagram))
                                        <li><Link away class="link" href="{{$author->instagram}}"><i class="fa-brands fa-instagram"></i></Link></li>
                                    @endif
                                    @if (isset($author->linkedin))
                                        <li><Link away class="link" href="{{$author->linkedin}}"><i class="fa-brands fa-linkedin"></i></Link></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="content">
                            {!! $article->content_ar !!}
                        </div>
                        <div class="tags">
                            <div class="title">@lang('articlespage.tags')</div>
                            <ul>
                                @foreach($tags_ar as $tag)
                                    <li>
                                        <Link class="link" class="outline-btn" href="/articles?tag={{$tag}}">{{$tag}}</Link>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="social-share">
                            <div class="title">@lang('articlespage.share')</div>
                            <ul>
                                @foreach($shareLinks as $platform => $link)
                                    <li><a class="link" href="{{ $link }}"><i class="fa-brands fa-{{ $platform }}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </div>
</x-frontend.layout>
