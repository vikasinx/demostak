jQuery(function ($) {
	$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsiveClass:true,
    lazyLoad: true,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});

// $("#skill_one").circliful({
//         animation: 1,
//         animationStep: 5,
//         foregroundBorderWidth: 15,
//         backgroundBorderWidth: 15,
//         percent: 80,
//         textSize: 28,
//         percentages: [10, 20, 30],
//         foregroundColor: '#BDA851',
//     });

var percentage1 = $('#fbs_home_skill_one_percentage').html();
  $('#skill_one').circliful({
     	animation: 1,
        animationStep: 5,
        foregroundBorderWidth: 15,
        backgroundBorderWidth: 15,
        percent: percentage1,
        textSize: 28,
        percentages: [10, 20, 30],
        foregroundColor: '#BDA851',
        fontColor: '#fff',
        backgroundColor: '#fff',

  });

  var percentage2 = $('#fbs_home_skill_two_percentage').html();
  $('#skill_two').circliful({
     	animation: 1,
        animationStep: 5,
        foregroundBorderWidth: 15,
        backgroundBorderWidth: 15,
        percent: percentage2,
        textSize: 28,
        percentages: [10, 20, 30],
        foregroundColor: '#BDA851',
        fontColor: '#fff',
        backgroundColor: '#fff',

  });

  var percentage3 = $('#fbs_home_skill_three_percentage').html();
  $('#skill_three').circliful({
     	animation: 1,
        animationStep: 5,
        foregroundBorderWidth: 15,
        backgroundBorderWidth: 15,
        percent: percentage3,
        textSize: 28,
        percentages: [10, 20, 30],
        foregroundColor: '#BDA851',
        fontColor: '#fff',
        backgroundColor: '#fff',

  });

  var percentage4 = $('#fbs_home_skill_four_percentage').html();
  $('#skill_four').circliful({
     	animation: 1,
        animationStep: 5,
        foregroundBorderWidth: 15,
        backgroundBorderWidth: 15,
        percent: percentage4,
        textSize: 28,
        percentages: [10, 20, 30],
        foregroundColor: '#BDA851',
        fontColor: '#fff',
        backgroundColor: '#fff',

  });

})
/*Skills Cirle Animation*/
function skills(id) {

 }