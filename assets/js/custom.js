

$(document).ready(function () {

    'use strict';


//	var j = jQuery.noConflict();
    $("input[type=checkbox]").parent().closest(".col-sm-6").removeClass("col-sm-12");

    //Bootstrap Select JS Plugin
    $('.selectpicker').selectpicker();

    //

    // gm code here
    $("#nav-tab a").click(function () {
        $(".main-Box").addClass("hideForce");

        $(".tabsHolder .tab-content").addClass("setB");
    });
    // end gm here

    //Tabs remove Jquery
    $(".closeTab").click(function () {
        $(".tabsHolder .tab-content .tab-pane").removeClass("active show");
        $(".tabsHolder .nav .nav-link").removeClass("show active");
        $(".main-Box").removeClass("hideForce");
        $(".tabsHolder .tab-content").removeClass("setB");
    });


    // Save Search Added
    $(".saveSearch > li > a").click(function () {
        $(".saveSearch").toggleClass("searchAdded");
    });

    // Close Tag Jquery
    $(".faClose-icon").click(function (event) {
        event.preventDefault();
        window.location.href = $(this).parents('a').attr('href');
    });

    // Show More Category
    ////$(".showMore").click(function () {
    //	$(this).parent().parent().parent(".categoryHolderMain").addClass("showMoreCat");
    //});

    // Show Less Category
    //$(".showLess").click(function () {
    //	$(this).parent().parent().parent(".categoryHolderMain").removeClass("showMoreCat");
    //});


    //$("#dynamic-header-form input[type=checkbox]").parent().closest( ".col-sm-6" ).addClass("col-sm-12")
    if ($('.holder ul.categoryHolder.list-unstyled').length > 0) {
    // manage show more btn by gmd  
        var text = $('.holder ul.categoryHolder.list-unstyled'),
            btn = $('.showMore');
        // var h = document.getElementById('categoryHoldermlist');
        //alert(h.offsetHeight);
        var h = text[0].scrollHeight;
        //var h= text[0].height();
        //var h= $(".holder ul.categoryHolder.list-unstyled").$( document ).height();
        if (h > 62) {
            btn.addClass('less');
            btn.css('display', 'inline-block');
        }

        btn.click(function (e) {
            e.stopPropagation();

            if (btn.hasClass('less')) {
                btn.removeClass('less');
                btn.addClass('more');
                //btn.html('Show Less <i class="fa categoryArrowUp" aria-hidden="true"></i>');
                $('.showMore .categoryArrowDown').css("transform", "scaleY(-1)");


                text.animate({'height': '62px'});
            } else {
                btn.addClass('less');
                btn.removeClass('more');
                btn.html('Show More <i class="fa categoryArrowDown" aria-hidden="true"></i>');
                text.animate({'height': '62px'});
            }
        });
    // end showmore
    }


    // Show More Filters in Search
    $(".showMoreLink").click(function () {
        $(this).parent().parent(".checkboxHolder").addClass("showMoreCat");
    });

    // Show More Filters in Search
    $(".showLessLink").click(function () {
        $(this).parent().parent(".checkboxHolder").removeClass("showMoreCat");
    });


    // Advance Search Filters add more
    $(".advSearchMore").click(function () {
        $(this).parent(".searchTitle").addClass("advSearchMoreHolder");
        $(".advanceSearchdData").addClass("show");


    });

    // Advance Search Filters minus
    $(".advSearchLess").click(function () {
        $(this).parent(".searchTitle").removeClass("advSearchMoreHolder");
        $(".advanceSearchdData").removeClass("show");
    });


    // waqas

    // Show More Category
    $(".sh").click(function () {
        $(this).parent().parent(".abcMain").addClass("showMoreCat").removeClass("grey");
    });
    // Show Less Category
    $(".sho").click(function () {
        //$(".abcMain").removeClass("showMoreCat");

        $(this).parent().parent(".abcMain").removeClass("showMoreCat").addClass("grey");
    });


    // Custom Range Jquery
    if (jQuery('.slider-range').length > 0) {


        jQuery('.slider-range').slider({
            range: true,
            min: 0,
            max: 50000,
            values: [10000, 40000],
            create: function () {
                var val = "$10,000";
                var val2 = "$40,000";
                // console.log(val);
                jQuery(".amount1").text(val);
                jQuery(".amount2").text(val2);
            },
            slide: function (event, ui) {
                var val = "$" + ui.values[0].toLocaleString('us-US');
                var val2 = "$" + ui.values[1].toLocaleString('us-US');
                // console.log(val);


                jQuery(".amount1").text(val);
                jQuery(".amount2").text(val2);
                var mi = ui.values[0];
                var mx = ui.values[1];
                filterSystem(mi, mx);
            }
        });
    }


    function filterSystem(minPrice, maxPrice) {
        jQuery("li.column").hide().filter(function () {
            var price = parseInt(jQuery(this).data("price"), 10);
            return price >= minPrice && price <= maxPrice;
        }).show();
    }

    // Custom Range Jquery
    if (jQuery('.slider-range2').length > 0) {
        jQuery('.slider-range2').slider({
            range: true,
            min: 0,
            max: 50000,
            values: [10000, 40000],
            create: function () {
                var val3 = "11,00";
                var val4 = "40,000";
                // console.log(val);
                jQuery(".amount5").text(val3);
                jQuery(".amount6").text(val4);
            },
            slide: function (event, ui) {
                var val3 = "" + ui.values[0].toLocaleString('us-US');
                var val4 = "" + ui.values[1].toLocaleString('us-US');
                // console.log(val);


                jQuery(".amount5").text(val3);
                jQuery(".amount6").text(val4);
                var mi = ui.values[0];
                var mx = ui.values[1];
                filterSystem(mi, mx);
            }
        })

    }

    function filterSystem(minPrice, maxPrice) {
        jQuery("li.column").hide().filter(function () {
            var price = parseInt(jQuery(this).data("price"), 10);
            return price >= minPrice && price <= maxPrice;
        }).show();
    }


    // Custom Range Jquery
    $(function () {

        if (jQuery('.slider-range-date').length > 0) {
            $(".slider-range-date").slider({
                range: true,
                min: 1990,
                max: 2019,
                values: [2000, 2015],
                slide: function (event, ui) {
                    // $( ".amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                    $(".amount3").val(ui.values[0]);
                    $(".amount4").val(ui.values[1]);
                }
            });
            //  $(".amount" ).val( "$" + $( ".slider-range" ).slider( "values", 0 ) + " - $" + $( ".slider-range" ).slider( "values", 1 ) );
            $(".amount3").val($(".slider-range-date").slider("values", 0));
            $(".amount4").val($(".slider-range-date").slider("values", 1));
        }
    });


    //********************** gmd start from here ************************************************

    // $('.count').prop('disabled', true);
    $(document).on('click', '.plus', function () {
        $('.count').val(parseInt($('.count').val()) + 1);
    });
    $(document).on('click', '.minus', function () {
        if ($('.count').val() != 0) {
            $('.count').val(parseInt($('.count').val()) - 1);
        }
    });

    // $('.count2').prop('disabled', true);
    $(document).on('click', '.plus2', function () {
        $('.count2').val(parseInt($('.count2').val()) + 1);
    });
    $(document).on('click', '.minus2', function () {
        if ($('.count2').val() != 0) {
            $('.count2').val(parseInt($('.count2').val()) - 1);
        }
    });


    $('#advnce-ser').click(function () {

        // $('#togle').toggleClass('hide-section', 777);
        //$('#togle').addClass( "hide-section" ).slideToggle('slow');

        var icon = $(this).find("i");
        icon.toggleClass("fa-plus-circle fa-minus-circle");
    })


    // ************************ end here ***************************
    var window_w = $(window).innerWidth();


    $(window).on('load', function () {
        /*------------------
          Preloder
        --------------------*/
        if (jQuery('.loader').length > 0) {
            $(".loader").fadeOut();
            $("#preloder").delay(500).fadeOut("slow");
        }
        //__portfolio(); // call portfolio function

    });


    // ****** privacy policy page js function end *******


    $('.prv-points li a').on('click', function (e) {
        e.preventDefault();

        $('html, body').animate({
            scrollTop: $($(this).attr('href')).offset().top
        }, 500, 'linear');
    });

    // ****** privacy policy js function end *******


    //removes the "active" class to .popup and .popup-content when the "Close" button is clicked
    $(".btn_close").on("click", function () {
        $(".popup-overlay, .popup-content").removeClass("active");


    });


    

    $('select#show_child_cat').on('change', function () {
        $('.sidebarSearch #advser').css({'display': 'block'});


    });

    //Pagination arrow remove
    $('.paginationHolder .page-link.page-link-next .page-link, .paginationHolder .page-link a[rel="prev"], .paginationHolder .pagination > a.page-link').empty();


    $("#tab1").tabs();

    //msdropdown
    try {
        $(".topheader_user_country").msDropDown();
    } catch (e) {
        alert(e.message);
    }


    //share icons animation
    if (jQuery('.cube').length > 0) {
        var quadrantItems = document.querySelectorAll('.quadrant__item');
        var svgs = document.querySelectorAll('svg');
        var cube = document.querySelector('.cube');
        var closeButton = document.querySelector('.quadrant__item__content--close');
        var isInside = false;

        var tl = new TimelineLite({paused: true});
        tl.timeScale(1.6);

        tl.to('.cube', 0.4, {rotation: 45, width: '60px', height: '60px', ease: Expo.easeOut}, 'first');
        tl.to('.plus .plus-vertical', 0.3, {height: '0', backgroundColor: '#f45c41', ease: Power1.easeIn}, 'first');
        tl.to('.plus .plus-horizontal', 0.3, {width: '0', backgroundColor: '#f45c41', ease: Power1.easeIn}, 'first');
        tl.to('.cube', 0, {backgroundColor: 'transparent'});
        tl.to(quadrantItems[0], 0.15, {opacity: 1, x: -3, y: -3}, 'seperate');
        tl.to('.arrow-up', 0.2, {opacity: 1, y: 0}, 'seperate+=0.2');
        tl.to(quadrantItems[1], 0.15, {opacity: 1, x: 3, y: -3}, 'seperate');
        tl.to('.arrow-right', 0.2, {opacity: 1, x: 0}, 'seperate+=0.2');
        tl.to('.arrow-down', 0.2, {opacity: 1, y: 0}, 'seperate+=0.2');
        tl.to(quadrantItems[2], 0.15, {opacity: 1, x: -3, y: 3}, 'seperate');
        tl.to('.arrow-left', 0.2, {opacity: 1, x: 0}, 'seperate+=0.2');

        cube.addEventListener('mouseenter', playTimeline);
        cube.addEventListener('mouseleave', reverseTimeline);
    }

    function playTimeline(e) {
        e.stopPropagation();
        tl.play();
    }

    function reverseTimeline(e) {
        e.stopPropagation();
        tl.timeScale(1.8);
        tl.reverse();
    }

});

$(".volgo_home .col-sm-6").removeClass("col-sm-12");


function checkforblank(){
    if (document.getElementById('spam').vlaue == "" ) {
        alert('please enter your first name');
        document.getElementById('spam').style.borderColor = red;
        return false;
    }
}

$(document).load(function(){
  document.getElementById("phone").placeholder = "phone";
});


