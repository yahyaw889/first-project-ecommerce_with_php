$(document).ready(function() {
    // banner owl carousel
    $("#banner-area .owl-carousel").owlCarousel({
        loop: true,
        nav: true,
        autoplay: true, // Enable autoplay
        autoplayTimeout: 4000, // Set autoplay interval to 4 seconds
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    $("#bigImg .owl-carousel").owlCarousel({
        loop: true,
        nav: true,
        autoplay: true, // Enable autoplay
        autoplayTimeout: 4000, // Set autoplay interval to 4 seconds
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    $(document).ready(function() {
        let currentIndex = 0;
        const $carouselImages = $('.carousel-images');
        const $carouselItems = $('.carousel-item');
        const itemCount = $carouselItems.length;

        function showSlide(index) {
            const offset = -index * 100; // Move to the correct slide
            $carouselImages.css('transform', `translateX(${offset}%)`);
        }

        $('.prev').click(function() {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : itemCount - 1;
            showSlide(currentIndex);
        });

        $('.next').click(function() {
            currentIndex = (currentIndex < itemCount - 1) ? currentIndex + 1 : 0;
            showSlide(currentIndex);
        });

        // Optional: Autoplay
        setInterval(function() {
            $('.next').click();
        }, 3000); // Change slide every 3 seconds
    });

    // top sale owl carousel
    $("#top-sale .owl-carousel").owlCarousel({
        loop: true,
        nav: true,
        autoplay: true, // Enable autoplay
        autoplayTimeout: 4000, // Set autoplay interval to 4 seconds
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

    // product one owl carousel
    $("#product-one .owl-carousel").owlCarousel({
        items: 1,
        loop: true, // جعل العرض يتكرر بشكل مستمر
        margin: 10, // المسافة بين العناصر
        nav: true, // إظهار أزرار التنقل
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true
    });

    // new phones owl carousel
    $("#new-phones .owl-carousel").owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

    // blogs owl carousel
    $("#blogs .owl-carousel").owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            }
        }
    });

    // isotope filter
    var $grid = $(".grid").isotope({
        itemSelector: '.grid-item',
        layoutMode: 'fitRows'
    });

    // filter items on button click
    $(".button-group").on("click", "button", function() {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue });
    });

    // product qty section
    let $qty_up = $(".qty .qty-up");
    let $qty_down = $(".qty .qty-down");

    // click on qty up button
    $qty_up.click(function(e) {
        let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
        if ($input.val() >= 1 && $input.val() <= 9) {
            $input.val(function(i, oldval) {
                return ++oldval;
            });
        }
    });

    // click on qty down button
    $qty_down.click(function(e) {
        let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
        if ($input.val() > 1 && $input.val() <= 10) {
            $input.val(function(i, oldval) {
                return --oldval;
            });
        }
    });
});

$(document).ready(function() {
    $('.add-to-cart').on('click', function() {
        var productId = $(this).closest('.product-add').data('id');
        $.ajax({
            url: 'add_to_cart.php',
            method: 'POST',
            data: { product_id: productId },
            success: function(response) {
                console.log('success')
                updateCart(response);
            }
        });
    });


    function updateCart(cartData) {
        var cartItems = parseInt($('#count').html(), 10);

        cartItems += 1;
        $('#count').html(cartItems);
    }
});