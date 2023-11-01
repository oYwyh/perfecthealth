<x-splade-modal>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <meta http-equiv="X-pUA-Compatible" content="ie=edge" />
        </head>
        <body>
            <div class="rating-box">
                <div class="wrapper">
                    <x-splade-form class="form-review active" id="form" :action="route('reviews.post')" method="POST">
                        <div class="box">
                            <header>@lang('titles.reviewTitle')</header>
                            <div class="stars" id="review-stars">
                                <x-splade-group name="stars" class="group" >
                                    <div class="form-column">
                                        <label for="stars"><i class="fa-solid fa-star" id="star1"></i></label>
                                        <x-splade-radio name="stars" value="1" id="radio1"/>
                                    </div>
                                    <div class="form-column">
                                        <label for="stars"><i class="fa-solid fa-star" id="star2"></i></label>
                                        <x-splade-radio name="stars" value="2" id="radio2"/>
                                    </div>
                                    <div class="form-column">
                                        <label for="stars"><i class="fa-solid fa-star" id="star3"></i></label>
                                        <x-splade-radio name="stars" value="3" id="radio3"/>
                                    </div>
                                    <div class="form-column">
                                        <label for="stars"><i class="fa-solid fa-star" id="star4"></i></label>
                                        <x-splade-radio name="stars" value="4" id="radio4"/>
                                    </div>
                                    <div class="form-column">
                                        <label for="stars"><i class="fa-solid fa-star" id="star5"></i></label>
                                        <x-splade-radio name="stars" value="5" id="radio5"/>
                                    </div>
                                </x-splade-group>
                            </div>
                        </div>
                        <div class="review-content">
                            <div class="feel"  style="display: none !important"></div>
                            @if (Session::get('locale') == 'en')
                            <x-splade-textarea autosize placeholder="Enter your review..." class="block input w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50" name="content" />
                            @else
                            <x-splade-textarea autosize placeholder="أترك تقييما" class="block input w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 disabled:opacity-50" name="content" />
                            @endif
                            <x-splade-submit class="submit" id="submit">
                                @lang('buttons.send')
                            </x-splade-submit>
                        </div>
                    </x-splade-form>
                </div>
            </div>
            <x-splade-script>
                const stars = document.querySelectorAll("#review-stars i");
                const feel = document.querySelector('.feel')
                const starInp = document.querySelector('#stars')
                let starVal;
                // Call resetStars function when modal is opened
                stars.forEach((star, index) => {
                    star.addEventListener("click", () => {
                        let number = (star.id).slice(-1);
                        console.log(number)
                        const radio = document.querySelector(`#radio${number}`)
                        radio.click()
                        document.querySelector('.review-content').classList.add('active')
                        stars.forEach(star => {
                            star.classList.remove("active");
                        });
                        for (let i = 0; i <= index; i++) {
                            stars[i].classList.add("active");
                        }
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
                        starVal = index + 1
                        {{-- starInp.value = index + 1 --}}
                    });
                });
            </x-splade-script>
        </body>
    </html>
</x-splade-modal>
