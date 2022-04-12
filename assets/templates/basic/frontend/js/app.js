(function ($) {
'use strict';

// menu options custom affix
var fixed_top = $(".header");
$(window).on("scroll", function(){
    if( $(window).scrollTop() > 50){
        fixed_top.addClass("animated fadeInDown menu-fixed");
    }
    else{
        fixed_top.removeClass("animated fadeInDown menu-fixed");
    }
});

// mobile menu js
$(".navbar-collapse>ul>li>a, .navbar-collapse ul.sub-menu>li>a").on("click", function() {
  const element = $(this).parent("li");
  if (element.hasClass("open")) {
    element.removeClass("open");
    element.find("li").removeClass("open");
  }
  else {
    element.addClass("open");
    element.siblings("li").removeClass("open");
    element.siblings("li").find("li").removeClass("open");
  }
});

$('li.author-widget-menu-has-child>a, ul.author-widget-submenu>li.author-widget-menu-has-child>a').on('click', function(e) {
  var element = $(this).parent('li');
  if (element.hasClass('open')) {
    element.removeClass('open');
    element.find('li').removeClass('open');
    element.find('ul').slideUp(500,"swing");
  }
  else {
    element.addClass('open');
    element.children('ul').slideDown(800,"swing");
    element.siblings('li').children('ul').slideUp(800,"swing");
    element.siblings('li').removeClass('open');
    element.siblings('li').find('li').removeClass('open');
    element.siblings('li').find('ul').slideUp(1000,"swing");
  }
});

let img=$('.bg_img');
img.css('background-image', function () {
	let bg = ('url(' + $(this).data('background') + ')');
	return bg;
});

	$('.nice-select').niceSelect();

	new WOW().init();

	
$('a[data-rel^=lightcase]').lightcase();


// Show or hide the sticky footer button
$(window).on("scroll", function() {
	if ($(this).scrollTop() > 200) {
			$(".scroll-to-top").fadeIn(200);
	} else {
			$(".scroll-to-top").fadeOut(200);
	}
});

// Animate the scroll to top
$(".scroll-to-top").on("click", function(event) {
	event.preventDefault();
	$("html, body").animate({scrollTop: 0}, 300);
});


//preloader js code
$(".preloader").delay(300).animate({
	"opacity" : "0"
	}, 300, function() {
	$(".preloader").css("display","none");
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})



$(".header-serch-btn").on('click', function(){
  //$(".header-top-search-area").toggleClass("open");
  if ($(this).hasClass('toggle-close')) {
      $(this).removeClass('toggle-close').addClass('toggle-open');
      $('.header-top-search-area').addClass('open');
  }
  else {
      $(this).removeClass('toggle-open').addClass('toggle-close');
      $('.header-top-search-area').removeClass('open');
  }
});

//close when click off of container
$(document).on('click touchstart', function (e){
  if (!$(e.target).is('.header-serch-btn, .header-serch-btn *, .header-top-search-area, .header-top-search-area *')) {
    $('.header-top-search-area').removeClass('open');
    $('.header-serch-btn').addClass('toggle-close');
  }
});


// main wrapper calculator
var bodySelector = document.querySelector('body');
var header = document.querySelector('.header');
var footer = document.querySelector('.footer');
(function(){
  if(bodySelector.contains(header) && bodySelector.contains(footer)){
    // var headerHeight = document.querySelector('.header').clientHeight;
    var footerHeight = document.querySelector('.footer').clientHeight;

    // var totalHeight = parseInt( headerHeight, 10 ) + parseInt( footerHeight, 10 ) + 'px';
     // if header isn't fixed to top
    var totalHeight = parseInt( footerHeight, 10 ) + 'px'; 
    // if header is fixed to top
    var minHeight = '100vh';
    document.querySelector('.main-wrapper').style.minHeight = `calc(${minHeight} - ${totalHeight})`;  
  }
})();

/* ==============================
					slider area
================================= */
$('.testimonial-slider').slick({
  dots: false,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 2,
  arrows: false,
  autoplay: true,
  centerMode: false,
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 2,
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});


$('.client-slider').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 6,
  slidesToScroll: 1,
  arrows: true,
  autoplay: true,
  prevArrow: '<div class="prev active"><i class="las la-angle-left"></i></div>',
  nextArrow: '<div class="next"><i class="las la-angle-right"></i></div>',
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }
  ]
});

function proPicURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var preview = $(input).parents('.thumb').find('.profilePicPreview');
            $(preview).css('background-image', 'url(' + e.target.result + ')');
            $(preview).addClass('has-image');
            $(preview).hide();
            $(preview).fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(".profilePicUpload").on('change', function () {
    proPicURL(this);
});

$(".remove-image").on('click', function () {
    $(this).parents(".profilePicPreview").css('background-image', 'none');
    $(this).parents(".profilePicPreview").removeClass('has-image');
    $(this).parents(".thumb").find('input[type=file]').val('');
});
$('.slick-arrow').on('mouseover', function(){
  $(this).siblings('.slick-arrow').removeClass('active');
  $(this).addClass('active');
})
$('.slick-arrow').on('click', function(){
  $(this).siblings('.slick-arrow').removeClass('active');
  $(this).addClass('active');
})
$('.rate_now').on('click', function(){
  $('.rating_form').show();
  $(this).hide();
})
})(jQuery);