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



$('.weekdays').on('click', function () {
    var myDate = new Date();
    let currentTime = myDate.getFullYear() + '-'
        +('0' + (myDate.getMonth()+1)).slice(-2)+ '-' +
        ('0' + myDate.getDate()).slice(-2) + ' '+myDate.getHours()
        + ':'+('0' + (myDate.getMinutes())).slice(-2)+ ':'+myDate.getSeconds();
    let nowWeek = +$(this).attr('data-id');
    let navHref = $(this).attr('href');
    let weekHref = navHref.slice(1);
    let weekId = $(this).attr('id');
    let days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    $.ajax({
        url: window.location.href,
        type: 'post',
        dataType: 'json',
        data: {day: days[nowWeek]},
        success: function (data) {
            $('#nav-tabContent .tab-pane').removeClass('show active');
            $('#nav-tabContent .remove').remove();
            if (data.error){
                console.log('error');
            }else {
                $('#nav-tabContent').append(`
                    <div class="tab-pane fade show active remove content_row" id="${weekHref}" role="tabpanel" aria-labelledby="${weekId}"></div>
                    `);
            }
            $.each(data.success, function (i, item) {
                $(`#nav-tabContent #${weekHref}`).append(`
                <div class="media result">
                    <div class="row">
                        <div class="col-md-3 col-12">
                        <a href="/performance/view?id=${item.id}">
                            <img src="${data.basePath}/upload/avatars/performance/200/${item.img_path}" class="mr-5" alt="Photo">
                        </a>
                        </div>
                        <div class="col-md-9 col-12">
                            <div class="media-body">
                            ${item.hall === '1' ? "<aside class=\"aside_text aside-text_bg\">ՓՈՔՐ ԹԱՏՐՈՆ</aside>" : 
                                    item.hall === '2' ? "<aside class=\"aside_text\">ՀՅՈՒՐԱԽԱՂ</aside>" : ''}
                                <p class="author">${item.author} </p>
                                <a href="/performance/view?id=${item.id}"><h5 class="mt-0 media-title">${item.title}</h5></a>
                                <small class="movie-type">${item.genre}</small>
                                <p class="media-text">${item.desc.substring(0, 313)}${item.desc.length > 313 ? ' ...': ''}</p>
                                <div class="media-footer">
                                    <div class="media_btn-group">
                                        <a href="/performance/view?id=${item.id}" class="btn more_btn">ԱՎԵԼԻՆ</a>
                                        ${item.show_date > currentTime ? "<button class=\"btn add_cupon\">ՊԱՏՎԻՐԵԼ<i class=\"fas fa-chevron-right\"></i></button>" : ''}
                                    </div>
                                    <p class='view-movie'>${item.func_date}</p>
                                    <p class="movie-lenght">${item.performance_length} ՐՈՊԵ<span>${item.age_restriction}+</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            `);
            });
            $(function () {
                $('.content_row').flexiblePagination({
                    itemsPerPage: 1,
                    itemSelector: 'div.result:visible',
                    pagingControlsContainer: '.pagingControls',
                    showingInfoSelector: '#showingInfo',
                });
            });
        }
    });
});

    /*------------------------pagination------------------------*/
    $(function () {
        $('.content_row').flexiblePagination({
            itemsPerPage: 1,
            itemSelector: 'div.result:visible',
            pagingControlsContainer: '.pagingControls',
            showingInfoSelector: '#showingInfo',
        });
    });

});
