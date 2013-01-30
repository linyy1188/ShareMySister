$(document).ready(function(){
  $('form').submit(function(){
    window.location.href="/index.php/start/search/"+encodeURIComponent($('#search-text').val())+'/'+encodeURIComponent($.trim($('.search-selected').html()))+'/1/';
    return false;
  });
}); 