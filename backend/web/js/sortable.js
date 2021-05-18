// $( document ).ready(function() {
//     setTimeout(function () {
//         $(".sortableTables >tbody").sortable({
//             stop: function (event, ui) {
//                 var newsArray = [];
//                 $(".sortableTables >tbody >tr").each(function (index, item) {
//                     newsArray[$(item).attr("data-key")] = index;
//                 });
//                 $.ajax({
//                     url: window.location.href,
//                     type: "post",
//                     dataType: "JSON",
//                     data: {orderArray: newsArray},
//                     success: function (data) {
//                         if (data) {
//                             window.location.replace("index");
//                         }
//                     }
//                 });
//             }
//         });
//     },3000);
// });