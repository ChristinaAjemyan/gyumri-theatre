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
                        <a href="/performance/view?id=${item.id}">
                            <img src="${data.basePath}/upload/avatars/performance/200/${item.img_path}" class="mr-5" alt="Photo">
                        </a>
                        </div>
                        <div class="col-md-9 col-12">
                            <div class="media-body">
                            ${item.hall === '1' ? "<aside class=\"aside_text aside-text_bg\">"+ getTranslate(data.lang, 'SMALL THEATRE', 'МАЛЕНЬКИЙ ТЕАТР', 'ՓՈՔՐ ԹԱՏՐՈՆ') +"</aside>" : 
                                    item.hall === '2' ? "<aside class=\"aside_text\">"+ getTranslate(data.lang, 'TOUR', 'ГАСТРОЛИ', 'ՀՅՈՒՐԱԽԱՂ') +"</aside>" : ''}
                                <p class="author">${item.author} </p>
                                <a href="/performance/view?id=${item.id}"><h5 class="mt-0 media-title">${item.title}</h5></a>
                                <small class="movie-type">${item.genre}</small>
                                <p class="media-text">${item.desc.substring(0, 270)}${item.desc.length > 270 ? ' ...': ''}</p>
                                <div class="media-footer">
                                    <div class="media_btn-group">
                                        <a href="/performance/view?id=${item.id}" class="btn more_btn">
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
        }
    });
});
$('#nav-tab .active').click();


});

