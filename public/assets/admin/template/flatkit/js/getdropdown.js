$(document).ready(function(){
  console.log("HI");

  $("#attrgrp").change(function(){
    $this=$(this);
    RelodPage($this);
  });
  $("#make").change(function(){
    $this=$(this);
    LoadModel($this);
  });
  $(".remove").click(function(){
    $this=$(this);
    LoadRemoveImage($this);
  });
});
function RelodPage($this){
  var uri=$this.attr('data-uri');
  var id =$this.val();
  uri=uri+"/"+id;
  $(location).attr('href',uri);
}
function LoadMake($this){
  var uri=$this.attr('data-uri');
  var id =$this.val();
  $.post(uri,{"id":id}).done(function(response){
    response=JSON.parse(response);
    if(!response.success){
      return false;
    }
    if(response.data.lenght!=0){
      $(response.data).each(function(indx,val){
        console.log(indx+"-"+val.Name);
        $("#make").append('<option value="'+val.MakeID+'">'+val.Name+'</option>');
      });
    }

  });
}
function LoadModel($this){
  var uri=$this.attr('data-uri');
  var id =$this.val();
  $.post(uri,{"id":id}).done(function(response){
    response=JSON.parse(response);
    if(!response.success){
      return false;
    }
    if(response.data.lenght!=0){
      $(response.data).each(function(indx,val){
        console.log(indx+"-"+val.Name);
        $("#model").append('<option value="'+val.ModelID+'">'+val.Name+'</option>');
      });
    }

  });
}
function LoadRemoveImage($this){
  var uri=$this.attr('data-uri');
  var id =$this.attr('data-id');
  $.post(uri,{"id":id}).done(function(response){
    response=JSON.parse(response);
    if(!response.success){
      return false;
    }
    if(response.removeid.lenght!=0){
      $(response.removeid).remove();
    }

  });
}


