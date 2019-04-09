$(document).ready(function(){
  
});
function confirmURL(text,url){
  var c = confirm(text);
  console.log(text);
  console.log(url);
  if(c){
    $(location).attr('href',url);
  }
}