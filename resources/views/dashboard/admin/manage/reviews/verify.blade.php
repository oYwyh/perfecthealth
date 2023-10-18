<x-splade-modal>
    <div class="review-verify">
        <div class="wrapper">
            @switch($review->stars)
                @case(1)
                    <div class="stars">
                        <i class="fa-solid fa-star active"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                @break
                @case(2)
                    <div class="stars">
                        <i class="fa-solid fa-star active"></i>
                        <i class="fa-solid fa-star active"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                @break
                @case(3)
                    <div class="stars">
                        <i class="fa-solid fa-star active"></i>
                        <i class="fa-solid fa-star active"></i>
                        <i class="fa-solid fa-star active"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                @break
                @case(4)
                    <div class="stars">
                        <i class="fa-solid fa-star active"></i>
                        <i class="fa-solid fa-star active"></i>
                        <i class="fa-solid fa-star active"></i>
                        <i class="fa-solid fa-star active"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                @break
                @case(5)
                    <div class="stars">
                        <i class="fa-solid fa-star active"></i>
                        <i class="fa-solid fa-star active"></i>
                        <i class="fa-solid fa-star active"></i>
                        <i class="fa-solid fa-star active"></i>
                        <i class="fa-solid fa-star active"></i>
                    </div>
                @break
                @default
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
            @endswitch
            <div class="content">
                {{$review->content}}
            </div>
            <Link  confirm class="link" href="{{route('admin.manage.reviews.verify',['id'=>$review->id])}}" class="text-green-500" confirm> Verify </Link>
        </div>
    </div>
</x-splade-modal>
