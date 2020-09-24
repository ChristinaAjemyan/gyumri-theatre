$( document ).ready(function() {

$('#datepicker').datepicker({
	uiLibrary: 'bootstrap4'
});

  $(window).scroll(function(){
    $('.navbar').toggleClass('navbar_bg', $(this).scrollTop() > 200);
});


$('#current_performance').owlCarousel({
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

$('#performances-carusel').owlCarousel({
  loop:true,
  margin:0,
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
        items:5,
        nav:true,
        margin:0, 
      }
  }

});


$('#searchBtn').click(function() {
  $('.search_input').toggleClass('d-block');
});


$('#headerCarousel').owlCarousel({
  items:1,
  nav:true,
  lazyLoad:true,
  loop:true,
  margin:0,
  
});

$('.actros_imges').magnificPopup({
  type: 'image',
  delegate:'a'
});

$('.popup_youtube').magnificPopup({
  disableOn: 700,
  type: 'iframe',
  preloader: false,

});



$('.performances-carusel').magnificPopup({
    type: 'image',
    delegate:'a'
  });


    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        if(value === "all")
        {
            $('.filter').show(2000);
        }
        else
        {
            $(".filter").not('.'+value).hide(2000);
            $('.filter').filter('.'+value).show(2000);
        }

        if (!$(this).hasClass('active')) {
            $(".filter-button").removeClass('active');
            $(this).addClass('active');
        }

    });



});
