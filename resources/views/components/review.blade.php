<x-splade-modal>
    <!DOCTYPE html>
    <!-- Coding By CodingNepal - codingnepalweb.com -->
    <html lang="en">
      <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-pUA-Compatible" content="ie=edge" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
      </head>
      <body>
        <div class="rating-box">
            <div class="wrapper">
                <div class="box">
                    <header>@lang('titles.reviewTitle')</header>
                    <div class="stars" id="review-stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
                @error('content')
                    <p class="note text-red-500 mt-4">{{$message}}</p>
                @enderror
                <form class="form-review" action="{{route('reviews.post')}}" method="POST">
                    @csrf
                    <div class="feel"></div>
                    <input type="hidden" name="stars" id="stars">
                    @if (Session::get('locale') == 'en')
                    <textarea placeholder="Enter your review..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50" name="content"></textarea>
                    @else
                    <textarea placeholder="أترك تقييما" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50" name="content"></textarea>
                    @endif
                    @if (Session::get('locale') == 'en')
                    <input class="submit" type="submit">
                    @else
                    <input class="submit" type="submit" value="أرسال">
                    @endif
                </form>
            </div>
        </div>
        <x-splade-script>
            const stars = document.querySelectorAll("#review-stars i");
            const feel = document.querySelector('.feel')

            // Function to reset stars
            function resetStars() {
                stars.forEach(star => {
                    star.classList.remove("active");
                });
                document.querySelector('#stars').value = 0;
            }

            // Call resetStars function when modal is opened
            {{-- document.querySelector('#review-btn').addEventListener('click', resetStars); --}}
            stars.forEach((star, index) => {
                star.addEventListener("click", () => {
                    document.querySelector('.form-review').classList.add('active')
                    stars.forEach(star => {
                    star.classList.remove("active");
                    });
                    for (let i = 0; i <= index; i++) {
                    stars[i].classList.add("active");
                    }
                    console.log(`User clicked on star ${index + 1}, which has ${index + 1} stars active.`);
                    switch (index + 1) {
                        case 1:
                            feel.innerHTML = 'We are sorry to hear that:('
                        break;
                        case 2:
                            feel.innerHTML = 'We are sorry to hear that:('
                        break;
                        case 3:
                            feel.innerHTML = 'We are sorry to hear that:('
                        break;
                        case 4:
                            feel.innerHTML = 'Brilliant!'
                        break;
                        case 5:
                            feel.innerHTML = 'Brilliant!'
                        break;
                    }
                    document.querySelector('#stars').value = index + 1
                });
            });
        </x-splade-script>
        </body>
    </html>
</x-splade-modal>
