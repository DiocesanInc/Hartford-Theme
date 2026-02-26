jQuery(document).ready(function ($) {
  const tablet = 768;
  const laptop = 992;
  const desktop = 1279;

  // var $slider = $(".page-template-homepage .parishButtons");
  // $slider.slick('unslick');
  // $slider.slick({
  //   autoplay: false,
  //   dots: false,
  //   arrows: true,
  //   cssEase: "linear",
  //   slidesToShow: 2,
  //   slidesToScroll: 1,
  //   centerMode: true,
  //   responsive: [
  //     {
  //       breakpoint: 768,
  //       settings: {
  //         slidesToShow: 1,
  //         slidesToScroll: 1,
  //       }
  //     }
  //   ]
  // });

  var $sliderImage1 = $(".page-template-homepage .mass-times-left .image1");
  $sliderImage1.slick({
    autoplay: false,
    arrows: false,
    cssEase: "linear",
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    asNavFor: '.mass-times-container .image2'
  });

  var $sliderImage2 = $(".page-template-homepage .mass-times-left .image2");
  $sliderImage2.slick({
    autoplay: false,
    dots: true,
    arrows: false,
    cssEase: "linear",
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    asNavFor: '.mass-times-container .image1'
  });

  var $sliderText = $(".page-template-homepage .mass-times-right-slides");
  $sliderText.slick({
    autoplay: true,
    autoplaySpeed: 8000,
    pauseOnFocus: true,
    dots: true,
    arrows: true,
    cssEase: "linear",
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    mobileFirst: true,
    asNavFor: '.mass-times-container .mass-slides'
  });
  
  var $sliderDots = $(".page-template-homepage .mass-times-nav-left");
  $sliderDots.slick({
    dots: true,
    arrows: false,
    cssEase: "linear",
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    mobileFirst: true,
    asNavFor: '.mass-times-container .mass-nav-l'
  });
  
  // var $sliderDots = $(".page-template-homepage .mass-times-nav-right");
  // $sliderDots.slick({
  //   autoplay: true,
  //   autoplaySpeed: 8000,
  //   dots: false,
  //   arrows: true,
  //   cssEase: "linear",
  //   slidesToShow: 1,
  //   slidesToScroll: 1,
  //   infinite: true,
  //   mobileFirst: true,
  //   asNavFor: '.mass-times-container .mass-nav-r'
  // });
});