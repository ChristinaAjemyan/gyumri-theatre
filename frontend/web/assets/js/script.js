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

$('#current_performance_slide').owlCarousel({
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

$('#season_carousel').owlCarousel({
    loop:true,
    margin:5,
    responsiveClass:true,
    nav: true,
    navText: [ `<i class="fas fa-chevron-left"></i>`, `<i class="fas fa-chevron-right"></i>`],
    responsive:{
        0:{
            items:3,
            nav:false,
        },
        700:{
            items:3,
            nav:false,
        },
        1000:{
            items:4,
            nav:true,
        },
        1200:{
            items:6,
            nav:true,
            margin:0,
        }
    }

});

function getTranslate(data, enText, ruText, amText){
    if (data === 'en'){
        return enText;
    } else if (data === 'ru') {
        return ruText;
    }else {
        return amText;
    }
}

$('.weekdays').on('click', function () {
    var myDate = new Date();
    let currentTime = myDate.getFullYear() + '-'
        +('0' + (myDate.getMonth()+1)).slice(-2)+ '-' +
        ('0' + myDate.getDate()).slice(-2) + ' '+myDate.getHours()
        + ':'+('0' + (myDate.getMinutes())).slice(-2)+ ':'+myDate.getSeconds();
    let nowWeek = +$(this).attr('data-id');
    let allMonth = $(this).attr('data-value');
    let navHref = $(this).attr('href');
    let weekHref = navHref.slice(1);
    let weekId = $(this).attr('id');
    let days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    $.ajax({
        url: window.location.href,
        type: 'post',
        dataType: 'json',
        data: {day: days[nowWeek], monthDays: allMonth},
        beforeSend: function() {
            $('#nav-tabContent').empty();
            $('#nav-tabContent').append('<div class="d-flex justify-content-center loadIcon"><i class="fas fa-spinner fa-pulse fa-4x"></i></div>');
        },
        success: function (data) {
            $('#nav-tabContent .tab-pane').removeClass('show active');
            $('#nav-tabContent .remove').remove();
            if (data.error){
                $(`#nav-tabContent`).append(`<p class='text-center h2 remove'>
                   ${data.lang === 'en' ? 'Performance not found' : data.lang === 'ru' ? 'Спектакль не найден' : 'Ներկայացում չի գտնվել'}
                                </p>`);
            }else {
                $('#nav-tabContent').append(`
                    <div class="tab-pane fade show active remove content_row" id="${weekHref}" role="tabpanel" aria-labelledby="${weekId}"></div>
                    <div class="pagingControls paginator--list remove"></div>`);
            }
            $.each(data.success, function (i, item) {
                $(`#nav-tabContent #${weekHref}`).append(`
                <div class="media result d-block">
                    <div class="row">
                        <div class="col-md-3 col-12">
                        <a href="/performance/view/${item.slug}">
                            <img src="${data.basePath}/upload/avatars/performance/200/${item.img_path}" class="mr-5" alt="Photo">
                        </a>
                        </div>
                        <div class="col-md-9 col-12">
                            <div class="media-body">
                            ${item.hall === '1' ? "<aside class=\"aside_text aside-text_bg\">"+ getTranslate(data.lang, 'SMALL THEATRE', 'МАЛЕНЬКИЙ ТЕАТР', 'ՓՈՔՐ ԹԱՏՐՈՆ') +"</aside>" : 
                                    item.hall === '2' ? "<aside class=\"aside_text\">"+ getTranslate(data.lang, 'TOUR', 'ГАСТРОЛИ', 'ՀՅՈՒՐԱԽԱՂ') +"</aside>" : ''}
                                <p class="author">${item.author} </p>
                                <a href="/performance/view/${item.slug}"><h5 class="mt-0 media-title">${item.title}</h5></a>
                                <small class="movie-type">${item.genre}</small>
                                <p class="media-text">${item.desc.substring(0, 270)}${item.desc.length > 270 ? ' ...': ''}</p>
                                <div class="media-footer">
                                    <div class="media_btn-group">
                                        <a href="/performance/view/${item.slug}" class="btn more_btn">
                                            ${getTranslate(data.lang, 'MORE', 'БОЛЬШЕ', 'ԱՎԵԼԻՆ')}
                                        </a>
                                    ${item.show_date > currentTime ? "<button class=\"btn add_cupon\">" + 
                    getTranslate(data.lang, 'ORDER', 'ПРИКАЗ', 'ՊԱՏՎԻՐԵԼ') + "<i class=\"fas fa-chevron-right\"></i></button>" : ''}
                                    </div>
                                    <p class='view-movie'>${item.func_date}</p>
                                    <p class="movie-lenght">${item.performance_length} ${getTranslate(data.lang, 'MINUTE', 'МИНУТА', 'ՐՈՊԵ')}<span>${item.age_restriction}+</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
            });
            $(function () {
                $('.content_row').flexiblePagination({
                    itemsPerPage: 6,
                    itemSelector: 'div.result:visible',
                    pagingControlsContainer: '.pagingControls',
                    showingInfoSelector: '#showingInfo',
                });
            });
            $('.loadIcon').remove();
        }
    });
});
$('#nav-tab .active').click();

// archive ----

$('.season_time').on('click',function () {
    let archive_id = $(this).attr('data-id');
    $('.theater_season_block').removeClass("active")
    $(this).parent().addClass('active')
    $.ajax({
        url: window.location.href,
        type: 'post',
        dataType: 'json',
        data: {id: archive_id},
        beforeSend: function() {
            $('#main_content_perf_data').empty();
            $('#main_content_perf_data').append('<div class="d-flex justify-content-center load-icon m-5"><i class="fas fa-spinner fa-pulse fa-4x"></i></div>');
        },
        success: function (data) {
            $('#main_content_perf_data').html(`<div class="main_carousel owl-carousel archive_content_carousel" id="current_performance"></div>`)
            if (typeof(data.performances) != "undefined" && data.performances !== null){
                $.each(data.performances,function (i,item) {
                    $(".archive_page_carousel .owl-carousel").append(`
                    <div class="carousel_item">
                        <div class="card" style="width: 16rem;">
                            <img class="card-img-top" src="${data.backend_url+'/upload/avatars/performance/200/'+item.img_path}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">${item.show_date}</h5>
                                <p class="card-text">${item.title}</p>
                            </div>
                        </div>
                    </div>
                `);
                })

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
                if (typeof(data.season) != "undefined" && data.season !== null){
                    $('.archive_main_content').html(`
                    <div class="container">
                        <h2 class="archive_main_title">${data.season.title} 
                        ${data.lang === 'en' ? 'THEATER SEASON' : data.lang === 'ru' ? 'ТЕАТРАЛЬНЫЙ СЕЗОН' : 'ԹԱՏԵՐԱՇՐՋԱՆ'}
                        </h2>
                        <p class="archive_main_text">${data.season.content}</p>
                    </div>
                    `)

                    $('#main_content_season_data').html(`<div class="performances-carusel owl-carousel" id="current_performance_slide"></div>`)
                    $.each(data.season.images,function (i,item) {
                        $(".archive_page_images_carousel .owl-carousel").append(`
                        <div class="block-present">
                            <a href="${data.backend_url+'/upload/galleries/original/'+item}">
                                <img src="${data.backend_url+'/upload/galleries/250/'+item}" alt="Photo">
                            </a>
                        </div>
                        `);
                    })
                    $('.performances-carusel').magnificPopup({
                        type: 'image',
                        delegate:'a'
                    });
                    $('#current_performance_slide').owlCarousel({
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
                }
            }
            $('.load-icon').remove();
        }
    })
})
// archive end ----

$('.performance_tab_cont').on('click',function () {
    let type_id = $(this).attr('data-id')
    $('.performance_tab_cont').css('border-bottom', 'none');
    $(this).addClass('active_type');
    $(this).css('border-bottom', '3px solid #e18848');
    $('.table-content').empty();
    $.ajax({
        url: window.location.href,
        type: 'post',
        dataType: 'json',
        data: {id: type_id},
        beforeSend: function() {
            $('#nav-tabContent').empty();
            $('#nav-tabContent').append('<div class="d-flex justify-content-center load-icon m-5"><i class="fas fa-spinner fa-pulse fa-4x"></i></div>');
        },
        success: function (data) {
            if (typeof(data.performances) != "undefined" && data.performances !== null){
            $('.perf').html(`<div class="tab-content" id="nav-tabContent"></div>`);

                $.each(data.performances,function (i,item) {
                    $(".tab-content").append(`
                <div class="media d-block">
                    <div class="row">
                        <div class="col-md-3  col-12">
                            <a href="/performance/view/${item.slug}">
                                <img src="${data.base_path}/upload/avatars/performance/200/${item.img_path}" class="mr-5" alt="Photo">
                            </a>
                        </div>
                        <div class="col-md-9 col-12">
                            <div class="media-body">
                                <p class="author">${item.author}</p>
                                <a href="/performance/view/${item.slug}">
                                    <h5 class="mt-0 media-title">${item.title}</h5>
                                </a>
                                <small class="movie-type"> ${item.genre}</small>
                                <p class="media-text">${item.desc.substring(0, 270)}${item.desc.length > 270 ? ' ...': ''}</p>
                                <div class="media-footer">
                                    <div class="media_btn-group"><a href="/performance/view/${item.slug}" class="btn more_btn">ԱՎԵԼԻՆ</a></div>
                                    <p class="view-movie">${item.date}</p>
                                    <p class="movie-lenght">${item.performance_length} ${getTranslate(data.lang, 'MINUTE', 'МИНУТА', 'ՐՈՊԵ')}<span>${item.age_restriction}+</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>           
            `);
                })
            }else{
                $(".tab-content").append(`
                <p class="text-center h2 remove">Ներկայացում չի գտնվել</p>
                `);
            }
        }
    })
})

});



