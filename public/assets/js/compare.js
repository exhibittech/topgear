$(document).ready(function() {
  //console.log("HI");


  $("#attrgrp").change(function() {
    $this = $(this);
    RelodPage($this);
  });
  /**
   * [variant1 code]
   * @return {[type]} [description]
   */
  $("#brand1").change(function() {
    $this = $(this);
    $("#variant1").html('<option value="">Select Car Variant</option>');
    $("#model1").html('<option value="">Select Car Model</option>');
    LoadModel($this, 'model1');
	  resetImg('variantimage1');
	$("#variantimage1_price_label1").hide();
  });
  $("#model1").change(function() {
    $this = $(this);
    $("#variant1").html('<option value="">Select Car Variant</option>');
    LoadVariant($this, 'variant1');
	  resetImg('variantimage1');
	  $("#variantimage1_price_label1").hide();
  });
  $("#variant1").change(function() {
    $this = $(this);
    LoadVariantImage($this, 'variantimage1');
    EnableDisable();
	  $("#variantimage1_price_label1").hide();
  });
  //End
  /**
   * [variant 2 code]
   * @return {[type]} [description]
   */

  $("#brand2").change(function() {
    $this = $(this);
    $("#model2").html('<option value="">Select Car Model</option>');
    $("#variant2").html('<option value="">Select Car Variant</option>');

    LoadModel($this, 'model2');
	  resetImg('variantimage2');
	  $("#variantimage1_price_label2").hide();
  });
  $("#model2").change(function() {
    $this = $(this);
    $("#variant2").html('<option value="">Select Car Variant</option>');

    LoadVariant($this, 'variant2');
	  resetImg('variantimage2');
	  $("#variantimage1_price_label2").hide();
  });
  $("#variant2").change(function() {
    $this = $(this);
    LoadVariantImage($this, 'variantimage2');
    EnableDisable();
	  $("#variantimage1_price_label2").hide();
  });
  //End

  $("#brand3").change(function() {
    $this = $(this);
    $("#model3").html('<option value="">Select Car Model</option>');
    $("#variant3").html('<option value="">Select Car Variant</option>');
    LoadModel($this, 'model3');
	  resetImg('variantimage3');
	  $("#variantimage1_price_label3").hide();
  });
  $("#model3").change(function() {
    $this = $(this);
    $("#variant3").html('<option value="">Select Car Variant</option>');
    LoadVariant($this, 'variant3');
	  resetImg('variantimage3');
	  $("#variantimage1_price_label3").hide();
  });
  $("#variant3").change(function() {
    $this = $(this);
    LoadVariantImage($this, 'variantimage3');
    EnableDisable();
	  $("#variantimage1_price_label3").hide();
  });
  //End
  $("#brand4").change(function() {
    $this = $(this);
    $("#model4").html('<option value="">Select Car Model</option>');
    $("#variant4").html('<option value="">Select Car Variant</option>');
    LoadModel($this, 'model4');
	  resetImg('variantimage4');
	  $("#variantimage1_price_label4").hide();
  });
  $("#model4").change(function() {
    $this = $(this);
    $("#variant4").html('<option value="">Select Car Variant</option>');
    LoadVariant($this, 'variant4');
	  resetImg('variantimage4');
	  $("#variantimage1_price_label4").hide();
  });
  $("#variant4").change(function() {
    $this = $(this);
    LoadVariantImage($this, 'variantimage4');
    EnableDisable();
	  $("#variantimage1_price_label4").hide();
  });
  //End

  $('#compareFrm').submit(function(evt) {
    evt.preventDefault();
    LoadCompare($(this));

  });


  $(".remove").click(function() {
    $this = $(this);
    LoadRemoveImage($this);
  });
});

function RelodPage($this) {
  var uri = $this.attr('data-uri');
  var id = $this.val();
  uri = uri + "/" + id;
  $(location).attr('href', uri);
}

function LoadCompare($this) {
  var uri = $this.attr('action');
  var data = $this.serializeArray();
  //  console.log(data);
  $.post(uri, data).done(function(response) {
    //console.log(response);
    response = JSON.parse(response);
    // if (!response.success) {
    //   return false;
    // }
    $("#vscar").html(response.vsdata);
    if (response.data.length != 0) {
      var html = "";

      $.each(response.data, function(idx, val) {
        var areaExpand = 'false';
        var collapsed = "collapsed";
        var show = "";
        if (!idx) {
          areaExpand = 'true';
          collapsed = "";
          show = 'show';
        }
        html = html.concat('<div class="accordion-item">');
        html = html.concat('<h2 class="accordion-header" id="panelsStayOpen-heading' + idx + '">');
        html = html.concat('<button class="accordion-button ' + collapsed + '" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse' + idx + '" aria-expanded="' + areaExpand + '" aria-controls="panelsStayOpen-collapse' + idx + '">' + val.Name );

		    html = html.concat('</button>');
        html = html.concat('</h2>');
        html = html.concat('<div id="panelsStayOpen-collapse' + idx + '" class="accordion-collapse collapse ' + show + '" aria-labelledby="panelsStayOpen-heading' + idx + '">');
        html = html.concat('<div class="accordion-body">');

        if (val.attrbute.length != 0) {
          html = html.concat('<table>');
          $.each(val.attrbute, function(idx1, val1) {
            html = html.concat('<tr>');
            html = html.concat('<th>' + val1.Name + '</th>');
            if (val1.attrval.length == 0) {
              for(let i=0;i<response.count-val1.attrval.length;i++){
                html = html.concat('<td>NA</td>');
              }
             
            } else {
              $.each(val1.attrval, function(idx2, val2) {
                html = html.concat('<td>' + val2.Value + '</td>');
              });
            }
            html = html.concat('</tr>');
          });
          html = html.concat('</table>');
        }

        html = html.concat('</div>');
        html = html.concat('</div>');
        html = html.concat('</div>');
        //  console.log(val);
      });
      var bhtml = "";
		//Added by supriya
		bhtml = bhtml.concat('<td>&nbsp;</td>');
		//end of the code by supriya
      $.each(response.brand,function(indxb,indxbv){
        //Commented by supriya
		//bhtml = bhtml.concat('<td>'+indxbv.brand+' - '+indxbv.model+'<br/>₹'+indxbv.price+'</td>');
		bhtml = bhtml.concat('<td>'+indxbv.brand+' - '+indxbv.model+'</td>');
      });
      $("#branddata").html(bhtml);
      $("#accordionPanelsStayOpenExample").html(html);
      $('#tg_cars_spec_wrap,.kjsticky-title').show();
    }
  });
  return false;
}

function LoadMake($this) {
  var uri = $this.attr('data-uri');
  var id = $this.val();
  $.post(uri, {
    "id": id
  }).done(function(response) {
    response = JSON.parse(response);
    if (!response.success) {
      return false;
    }
    if (response.data.lenght != 0) {
      $(response.data).each(function(indx, val) {
        //  console.log(indx + "-" + val.Name);
        $("#make").append('<option value="' + val.MakeID + '">' + val.Name + '</option>');
      });
    }

  });
}

function LoadModel($this, attrid = null) {
  var uri = $this.attr('data-uri');
  var id = $this.val();
  $.post(uri, {
    "id": id
  }).done(function(response) {
    response = JSON.parse(response);
    if (!response.success) {
      return false;
    }
    if (response.data.lenght != 0) {
      if (attrid) {
        $("#" + attrid).html('');
        $("#" + attrid).append('<option value="">Select Car Model</option>');
      }
      $(response.data).each(function(indx, val) {
        if (attrid) {
          $("#" + attrid).append('<option value="' + val.ModelID + '">' + val.Name + '</option>');

        }
      });
    }

  });
}

function LoadVariant($this, attrid = null) {
  var uri = $this.attr('data-uri');
  var id = $this.val();
  $.post(uri, {
    "id": id
  }).done(function(response) {
    response = JSON.parse(response);
    if (!response.success) {
      return false;
    }

    if (response.data.lenght != 0) {
      if (attrid) {
        $("#" + attrid).html('');
        $("#" + attrid).append('<option value="default" selected disabled>Select Car Variant</option>');
      }
      $(response.data).each(function(indx, val) {
        if (attrid) {
          $("#" + attrid).append('<option value="' + val.VariantID + '">' + val.Name + '</option>');
        }
      });
    }


  });
}

function LoadVariantImage($this, attrid = null) {
  //console.log("Hi");
  var uri = $this.attr('data-uri');
  var id = $this.val();
  $.post(uri, {
    "id": id
  }).done(function(response) {
    response = JSON.parse(response);
    //console.log(response);
    if (!response.success) {
      return false;
    }
    if (response.data.lenght != 0) {

      //  console.log(response.data);
      $('#' + attrid).attr('src', response.data.ImagePath);
	  $('#' + attrid+'_price').html("₹"+response.price.Value);
	  $('.' + attrid).show();


    }

  });
}
function resetImg(imgID){
	console.log("#" + imgID);
	$("#" + imgID).attr('src', "https://www.topgearmag.in/assets/front/template/top-gear-1.0/imgs/add_car.png");
}
function EnableDisable() {
  var cont = 0;
  if ($("#variant1").val()!= null) {
    cont = cont + 1;
  }
  if ($("#variant2").val() != null) {
    cont = cont + 1;
  }
  if ($("#variant3").val()!= null) {
    cont = cont + 1;
  }
  if ($("#variant4").val()!= null) {
    cont = cont + 1;
  }
  if (cont > 1) {
    $("#tg_compare").removeAttr('disabled');
    //  console.log(cont);
  }


}

function LoadRemoveImage($this) {
  var uri = $this.attr('data-uri');
  var id = $this.attr('data-id');
  $.post(uri, {
    "id": id
  }).done(function(response) {
    response = JSON.parse(response);
    if (!response.success) {
      return false;
    }
    if (response.removeid.lenght != 0) {
      $(response.removeid).remove();
    }

  });
}
