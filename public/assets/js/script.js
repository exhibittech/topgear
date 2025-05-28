$(document).ready(function(){
  $("#subscribe").submit(function(evt){
    evt.preventDefault();
    LoadFormSubmit($(this));
  });
});
function LoadFormSubmit($this){
  var uri=$this.attr('action');
  var data=$this.serializeArray();
  $this.find('.btn').html('Please Wait...');
  $this.find('.btn').attr('disabled','true');
  $.post(uri,data).done(function(response){
    response=JSON.parse(response);
    if(!response.success){
      $this.find('.btn').html('SUBSCRIBE');
      $this.find('.btn').removeAttr('disabled');
      $this.trigger('reset');
      alert(response.message);
      return false;

    }
    if(response.attribute.hasOwnProperty('redirect') && response.attribute.redirect){
      $(location).attr('href',response.attribute.redirect_uri);
    }
    alert(response.message);
    $this.find('.btn').html('SUBSCRIBE');
    $this.find('.btn').removeAttr('disabled');
    $this.trigger('reset');

  });
}


function copyURL(event) {
    event.preventDefault(); 
    var url = window.location.href;
    var tempInput = document.createElement("input");
    document.body.appendChild(tempInput); 
    tempInput.setAttribute("value", url); 
    tempInput.select(); 
    document.execCommand("copy"); 
    document.body.removeChild(tempInput); 

    var copiedMessage = event.target.parentElement.querySelector(".copied-message"); 
    copiedMessage.style.display = "inline"; 
    setTimeout(function() {
      copiedMessage.style.display = "none"; 
    }, 2000);
  }
