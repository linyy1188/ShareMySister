$(document).ready(function(){
  $('#search-button').click(function(){
    window.location.href="/index.php/start/search/"+encodeURIComponent($('#search-text').val())+'/'+encodeURIComponent($.trim($('.search-selected').html()))+'/1/';
  })
}) 
//todo ,'enter' on 查询 button don't work. maybe setting prototype can work.