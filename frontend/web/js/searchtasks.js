$(document).ready(function() {
    poisk();
 });
 
 
 
 
 //      Функции
 //----------------------------------------------------------------//
 
 
 function poisk() {

 $(document).on('click', function(e) {
   if (!$(e.target).closest(".top-search-search").length) {
     $(".search-ajax").remove();
 
    }
   e.stopPropagation();
   });
   
 
       
     
 $(".top-input-text").bind("keyup", function() {
   var text = $(this).val();
  
        $.ajax({
         url:   '/searchtasks', 
         type:     "get", //метод отправки
         dataType: "html", //формат данных
         data: {text:text},
         success: function(response) { //Данные отправлены успешно
          $(".search-ajax").remove();
          $(".top-search-search").append('<div class="search-ajax">'+response+'</div>');
          click_a();
     } 
     });

   });
   
 
 
function click_a() {
    $( ".click-search" ).click(function(){
       $('.task-id').val($(this).attr('data-id'));
       $('.top-input-text').val($(this).text());
       $(".top-search-search").html('');
    });
} 
 
 }