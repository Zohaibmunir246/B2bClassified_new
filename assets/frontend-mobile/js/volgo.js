
function akmalMenu() {

  

// =================================================================================


    /* adding span with arrow and .has-sub class */
    var menuID = $(".main-menu-nav");
    var downArrows = "<span class='down-arrow'></span>";
    var catchSubs = menuID.find('li ul');
    //$(".main-menu-nav li").has("ul").addClass('has-sub');
    catchSubs.parent().addClass('has-sub');
    catchSubs.parent().append(downArrows);

    /* submenu accordian */


    menuID.find('.down-arrow').on('click', function() {
        if ($(this).siblings('ul').hasClass('open')) {
            /*$(this).siblings('ul').removeClass('open');*/
            $(this).siblings('ul').slideUp(500, function() {
                jQuery(this).removeClass("open");
            });
            $(this).removeClass('submenu-opened');
        } else {
            /*$(".down-arrow").siblings('ul').removeClass('open');*/
            /*$(".down-arrow").removeClass('submenu-opened');*/
            // $(this).siblings('ul').addClass('open');
            $(this).siblings('ul').slideDown(500, function() {
                jQuery(this).addClass("open");
            });;
            $(this).addClass('submenu-opened');
        }
    });
    $(".main-menu-nav ul").unbind('mouseenter mouseleave');

    resizeFix = function() {
        var mediasize = 991;
        if ($(window).width() > mediasize) {
            //menuID.find('ul').show();
            /* Adding class on hover */
            menuID.on("mouseenter", ".has-sub", function() {
                /*$(".has-sub").removeClass("hovered");*/
                $(this).addClass("hovered");
            }).on("mouseleave", ".has-sub", function() {
                $(this).removeClass("hovered");
            })
        }
        if ($(window).width() <= mediasize) {
            //menuID.find('ul').hide().removeClass('open');

            $(".main-menu-nav").on("mouseenter", ".has-sub", function() {
                $(".has-sub").removeClass("hovered");

            }).on("mouseleave", ".has-sub", function() {
                $(this).removeClass("hovered");
            })
        }
    };
    resizeFix();
    return $(window).on('resize', resizeFix);
}

//sticky header
var header = jQuery(".top-bar");
var hheight = header.outerHeight();
// console.log(hheight);
var coverUp = jQuery(".banner");
jQuery(window).scroll(function() {
    var scroll = jQuery(window).scrollTop();
    var device = jQuery(window).width();
    if (scroll > 200) {
        header.removeClass('positioning').addClass("fixedUp");

    } else {
        header.removeClass("fixedUp").addClass('positioning');

    }
    if (scroll > 300) {
        header.removeClass('clearHeader').addClass("darkHeader");
        coverUp.removeClass('noCoverUp').addClass("coverUp").css({ "margin-top": hheight + "px" });

        if (device > 991) {
            coverUp.css({ "margin-top": hheight + "px" });
        }


    } else {
        header.removeClass("darkHeader").addClass('clearHeader');
        coverUp.removeClass('coverUp').addClass("noCoverUp").css({ "margin-top": 0 });
        if (device > 991) {
            coverUp.css({ "margin-top": 0 });
        }
    }
    if (scroll > 950) {
        header.removeClass('oldColor').addClass("diffColor");
    } else {
        header.removeClass("diffColor").addClass('oldColor');
    }

    var resizeFixed = function() {
        var mediasize = 991;
        if ($(window).width() > mediasize) {
            header.removeClass("yes-mobile");
            header.addClass("not-mobile");
            coverUp.removeClass("yes-mobile");
            coverUp.addClass("not-mobile");
        }
        if ($(window).width() <= mediasize) {
            header.removeClass("not-mobile")
            header.addClass("yes-mobile");
            coverUp.removeClass("not-mobile");
            coverUp.addClass("yes-mobile").css({ "margin-top": 0 });
        }
    };
    resizeFixed();
    return $(window).on('resize', resizeFixed);

});
// ===========

 jQuery(document).ready(function() {
     akmalMenu();

     


// =====================
     jQuery(".collapse ").on('show.bs.collapse', function() {
            jQuery(".collapse.show ").removeClass("show");
            jQuery(".arrow.arrow-down ").removeClass("arrow-down ").addClass("arrow-left ");
            jQuery(this).parent().find(".arrow ").removeClass("arrow-left ").addClass("arrow-down ");
        }).on('hide.bs.collapse', function() {
            jQuery(this).parent().find(".arrow ").removeClass("arrow-down ").addClass("arrow-left ");
        });

  // Custom Range Jquery
  if (jQuery('.slider-range').length > 0) {

    jQuery('.slider-range').slider({
      range: true,
      animate: "fast",
      min: 0,
      max: 50000,
      values: [10000, 40000],
      create: function () {
        var val = "$ 10,000";
        var val2 = "$ 50,000";
        // console.log(val);
        jQuery(".amount1").text(val);
        jQuery(".amount2").text(val2);
        jQuery( ".price_amount1" ).val(10000);
        jQuery( ".price_amount2" ).val(50000);
      },
      slide: function (event, ui) {
        var val = "$ " + ui.values[0].toLocaleString('us-US');
        var val2 = "$ " + ui.values[1].toLocaleString('us-US');
        var priceval = ui.values[0].toLocaleString('us-US').replace(/,/g, '');
        var priceval2 =  ui.values[1].toLocaleString('us-US').replace(/,/g, '');
        // console.log(val);


        jQuery(".amount1").text(val);
        jQuery(".amount2").text(val2);
        jQuery( ".price_amount1" ).val(priceval);
        jQuery( ".price_amount2" ).val(priceval2);
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
      animate: "fast",
      min: 0,
      max: 50000,
      values: [10000, 40000],
      create: function () {
        var val3 = "1000 KM";
        var val4 = "10,000 KM";
        // console.log(val);
        jQuery(".amount5").text(val3);
        jQuery(".amount6").text(val4);
        jQuery( ".kmamount1" ).val(1000);
        jQuery( ".kmamount2" ).val(10000);
      },
      slide: function (event, ui) {
        var val3 = ui.values[0].toLocaleString('us-US')+ ' KM';
        var val4 = ui.values[1].toLocaleString('us-US')+ ' KM';
        var kmamount1 = ui.values[0].toLocaleString('us-US').replace(/,/g, '');
        var kmamount2 = ui.values[1].toLocaleString('us-US').replace(/,/g, '');
        // console.log(val);


        jQuery(".amount5").text(val3);
        jQuery(".amount6").text(val4);
        jQuery( ".kmamount1" ).val(kmamount1);
        jQuery( ".kmamount2" ).val(kmamount2);
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


// ====================
 // Custom Range Jquery
     if (jQuery('.slider-range-date').length > 0) {
  $( ".slider-range-date" ).slider({
    range: true,
    animate: "fast",
    min: 1990,
    max: 2019,
    values: [ 2000, 2018 ],
    slide: function( event, ui ) {
      // $( ".amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      $( ".amount3" ).val( ui.values[ 0 ] );
      $( ".amount4" ).val( ui.values[ 1 ] );
    }
  });
//  $(".amount" ).val( "$" + $( ".slider-range" ).slider( "values", 0 ) + " - $" + $( ".slider-range" ).slider( "values", 1 ) );
 $(".amount3" ).val( $( ".slider-range-date" ).slider( "values", 0 ) );
 $(".amount4" ).val( $( ".slider-range-date" ).slider( "values", 1 ) );
};


// ==========
     if (jQuery('.pSlidr').length > 0) {
         jQuery('.pSlidr').slick({
             dots: false,
             arrows: false,
             infinite: true,
             autoplay: false,
             slidesToShow: 8,
             slidesToScroll: 1,

             responsive: [
                 {
                     breakpoint: 1199,
                     settings: {
                         slidesToShow: 12
                     }
                 },
                 {
                     breakpoint: 991,
                     settings: {
                         slidesToShow: 10
                     }
                 },
                 {
                     breakpoint: 767,
                     settings: {
                         slidesToShow: 10
                     }
                 },
                 {
                     breakpoint: 575,
                     settings: {
                         slidesToShow: 8
                     }
                 },
                 {
                     breakpoint: 480,
                     settings: {
                         slidesToShow: 5
                     }
                 }
                 // You can unslick at a given breakpoint now by adding:
                 // settings: "unslick"
                 // instead of a settings object
             ]
         });
     };
   });