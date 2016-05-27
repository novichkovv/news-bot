$ = jQuery.noConflict();

$(document).ready(function(){
    $("#main-header-slider").find(".banner-slider").owlCarousel({
        slideSpeed : 300,
        paginationSpeed : 500,
        pagination: false,
        singleItem:true,
        navigation : true,
        navigationText: [
            "<img src='../../../images/frontend/theme/left-arrow.png' />",
            "<img src='../../../images/frontend/theme/right-arrow.png' />"
        ],
        transitionStyle : "fade",
        autoPlay: true
    });

    /* =================================
       COUNTER
    =================================== */
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });

    $('.mobile-menu').meanmenu();


    $(".different_shipping_true").hide();
    $("#cc_different_shipping").on('click', function() {
        if($(this).is(":checked")) {
            $(".different_shipping_true").slideToggle();
        } else {
            $(".different_shipping_true").slideToggle();
        }
    });


});

    $('.share-post-container').on('click', function() {
        var next =  $(this).children('.social-links');
        var state = next.css('opacity');

        if( state == '0' ) {
            next.css({
                display: 'block'
            });
            next.animate({
                    opacity: '1',
                }, 300 );
        } else if ( state == '1' ) {
            next.animate({
                    opacity: '0',
            }, 300, function() {
                next.css({
                    display: 'none' });
                });
        }
    });

