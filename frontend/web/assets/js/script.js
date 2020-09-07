$( document ).ready(function() {

$('#datepicker').datepicker({
	uiLibrary: 'bootstrap4'
});

  $(window).scroll(function(){
    $('.navbar').toggleClass('navbar_bg', $(this).scrollTop() > 200);
});


$('.owl-carousel').owlCarousel({
  loop:true,
  margin:10,
  responsiveClass:true,
  nav: true,
       navText: [ `<i class="fas fa-chevron-left"></i>`, `<i class="fas fa-chevron-right"></i>`],
  responsive:{
      0:{
          items:1,
          nav:false,
      },
      700:{
        items:2,
          nav:false,
      },
      1000:{
          items:3,
          nav:true,
      },
      1200:{
        items:4,
        nav:true,
        margin:0, 
      }
  }

});

// $('.presentation-carusel').owlCarousel({
//   loop:true,
//   margin:10,
//   responsiveClass:true,
//   nav: true,
//        navText: [ `<i class="fas fa-chevron-left"></i>`, `<i class="fas fa-chevron-right"></i>`],
//   responsive:{
//       0:{
//           items:1,
//           nav:false,
//       },
//       700:{
//         items:2,
//           nav:false,
//       },
//       1000:{
//           items:3,
//           nav:true,
//       },
//       1200:{
//         items:4,
//         nav:true,
//         margin:0,
//       }
//   }

// });



  });
