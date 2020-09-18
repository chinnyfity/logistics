

//$jq1(function(){
$(document).ready( function () {
  var page_names = $('#txtpage_name').val();
  var site_urls = $('#txtsite_url').val();
  var txtuserID = $('#txtuserID').val();
  var txtparam_transfer = $('#txtparam_transfer').val();
  var txtflutter = $('#txtflutter').val();
  
  
  //var reg_caps = retrieve_cookie('reg_caps');


  $(".uploadPics").on('submit', (function(e) {
    e.preventDefault();
    var site_urls = $('#txtsite_url').val();
    var txtupdates = $('#txtupdates').val();
    
    $(".alert_msg1").hide();
    var txtfile = $("#txtphoto").val();
    var mediaType = $(this).attr('mediaType');
    var self = this;

    if(txtfile == "" || txtfile == 0)
      $(".alert_msg1").show().html('Please upload your '+mediaType);
    else{
  
      $(".cmd_upload_media").attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});

      $.ajax({
        type : "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        url : site_urls+"node/upload_medias",
        success : function(data){
          //alert(data)
          if(data=="inserted"){
            $(".uploadPics")[0].reset();
            $(".upload_details").hide();
            $('.already_taken').show();

            if(txtupdates==1){
              $(".refresh_images").html('<p style="text-align:center; font-size:17px; padding:10px 3px; color:#093"><b>Please reload this page to show updated photo!</b></p>');
              $('.btn_sweet_art').click();
            }
            
          }else{
            $(".alert_msg1").show().html(data);
          }
          $(".cmd_upload_media").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});

        },error : function(data){
          $(".cmd_upload_media").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
          $(".alert_msg1").show().html('Poor Network Connection!');
        }
      });
    }
  }));



  $("#frm_update_profile").on('submit',(function(e) {
    e.preventDefault();
    $(".alert_msg1").hide();
    
    $(".update_profile").attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});

    $.ajax({
        type : "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType: 'json',
        url : site_urls+"node/update_my_profile",
        success : function(data){

            if(data.type == 'success'){
              $(".update_profile").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
              $('#txtf0').val(data.msg);
              $('.btn_sweet_art').click();

              if(data.msg1!=""){
                $.ajax({
                  type : "POST",
                  url : site_urls+"node/remove_session_cID",
                  success : function(data){
                  }
                });

                setTimeout(function(){
                  if(!isNaN(data.msg))
                    window.location = site_urls+data.msg+"/join/"+data.msg1+"/";
                  else{
                    if(data.msg1!==false)
                      window.location = site_urls+"contests/";
                      //window.location = site_urls+data.msg+"/"+data.msg1+"/";
                    else
                      window.location = site_urls+data.msg+"/";
                  }
                },400);
              }

            }else{
                $(".alert_msg1").show().html(data.msg).removeClass('alert-success').addClass('alert-danger');
                $(".update_profile").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
                setTimeout(function(){
                  $(".alert_msg1").fadeOut('fast');
                },5000);
            }
        },error : function(data){
            $(".update_profile").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
            $(".alert_msg1").show().html('Poor Network Connection!').removeClass('alert-success').addClass('alert-danger');

            setTimeout(function(){
              $(".alert_msg1").fadeOut('fast');
            },3000);
        }
    });
  }));



  $("#frm_members").on('submit',(function(e) {
    e.preventDefault();
    $(".alert_msg1").hide();

    $("button").attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
    $.ajax({
        type : "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType: 'json',
        url : site_urls+"node/add_members",
        success : function(data){
            if(data.type == 'success'){
              $("#frm_members")[0].reset();
              $('.btn_sweet_art').click();
              $("button").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});

            }else{
                $(".alert_msg1").show().html(data.msg).removeClass('alert-success').addClass('alert-danger');
                $("button").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
                setTimeout(function(){
                  $(".alert_msg1").fadeOut('fast');
                },5000);
            }
        },error : function(data){
            $("button").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
            $(".alert_msg1").show().html('Poor Network Connection!').removeClass('alert-success').addClass('alert-danger');

            setTimeout(function(){
              $(".alert_msg1").fadeOut('fast');
            },3000);
        }
    });
  }));



  $("#frm_add_mission").on('submit',(function(e) {
    e.preventDefault();
    $(".alert_msg1").hide();

    $("button").attr('disabled', true).css({'opacity': '0.4', 'color': '#ccc'});
    $.ajax({
        type : "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType: 'json',
        url : site_urls+"node/add_members_",
        success : function(data){
            if(data.type == 'success'){
              $("#frm_add_mission")[0].reset();
              $('.btn_sweet_art').click();
              $("button").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});

            }else{
                $(".alert_msg1").show().html(data.msg).removeClass('alert-success').addClass('alert-danger');
                $("button").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
                setTimeout(function(){
                  $(".alert_msg1").fadeOut('fast');
                },5000);
            }
        },error : function(data){
            $("button").removeAttr('disabled').css({'opacity': '1', 'color': '#fff'});
            $(".alert_msg1").show().html('Poor Network Connection!').removeClass('alert-success').addClass('alert-danger');

            setTimeout(function(){
              $(".alert_msg1").fadeOut('fast');
            },3000);
        }
    });
  }));



  $('body').on('click', '.btn_delete', function(e) {
    var for_id = $(this).attr("for_id");
    $('#txtall_id').val(for_id);
  });


  $('body').on('click', function(e) {
    $('#country_list_id').hide();
    $('#country_list_id').html('');
  });



  $('body').on('keyup', '.txtsearch', function(e) {
    if($(this).val() == ""){
      $('.display_info').fadeOut('fast');
      return false;
    }
  });



  $('body').on('click', '.assign_rider', function(e) {
    $('.select_riders_mask').fadeIn('fast');
    $('.select_riders').fadeIn('fast');
  });


  
  $('body').on('click', '.assign_rider_now', function(e) {
    var rider_id = $(this).attr("rider_id");
    if(confirm("Proceed to assign to this rider")){

      var datastring='rider_id='+rider_id
      +'&all_rider='+capn2;

      $(".assign_rider_now").attr('disabled', true).css({'opacity': '0.5'});

      $.ajax({
        type : "POST",
        url : site_urls+"dashboard/assignrider__",
        data: datastring,
        cache : false,
        success : function(data){
        //alert(data);
        if(data == 'success_assigned'){
          $("#err_div2_cats").show().html('<div class="successmsg" style="font-size:16px;"><b>A notification has been sent to the rider!</b></div>');
          
          $(".assign_rider_now").removeAttr('disabled').css({'opacity': '1'});

          setTimeout(function(){
            $("#err_div2_cats").fadeOut('slow');
          },3000);

        }else{
            $("#err_div2_cats").fadeIn('fast').html('<div class="Errormsg">'+data+'</div>');
            $(".assign_rider_now").removeAttr('disabled').css({'opacity': '1'});
            
            setTimeout(function(){
              $("#err_div2_cats").fadeOut('slow');
            },3000);
        }
          $('.cmd_cats').attr("disabled", false);

        },error : function(data){
          $('.cmd_cats').attr("disabled", false);
          $("#err_div2_cats").hide();
          $(".assign_rider_now").removeAttr('disabled').css({'opacity': '1'});
        }
      });
    }
  });



  $('body').on('click', '.close_riders, .select_riders_mask', function(e) {
    $('.select_riders').fadeOut('fast');
    $('.select_riders_mask').fadeOut('fast');
  });



  $('body').on('click', '.cmd_update_pass', function (e) {
    e.preventDefault();
    var self = this;
    $(".alert_msg1").hide();
    
    $(self).attr('disabled', true).css({'opacity': '0.5', 'color': '#ccc'});
    
    $.ajax({
      type : "POST",
      url : site_urls+"node/update_my_pass",
      data: $("#edit_pass").serialize(),
      success : function(data){

        if(data=="pass1_updated"){
          $(self).removeAttr('disabled').css({'opacity': 1, 'color': '#fff'});
          $('.btn_sweet_art').click();
          $("#edit_pass")[0].reset();
        
        }else{
          $(self).removeAttr('disabled').css({'opacity': 1, 'color': '#fff'});
          $(".alert_msg1").show().html(data);
        }

      },error : function(data){
          $(self).removeAttr('disabled').css({'opacity': 1, 'color': '#fff'});
          $(".alert_msg1").show().html('Poor Network Connection!');
      }
    });
  });


  
  $('body').on('click', '.cmd_update_settings1', function(e) {
    e.preventDefault();
    var self = this;
    $(".alert_msg2").hide();
    
    $(self).attr('disabled', true).css({'opacity': '0.5', 'color': '#ccc'});
    
    $.ajax({
      type : "POST",
      url : site_urls+"node/update_my_settings",
      data: $("#edit_settings1").serialize(),
      success : function(data){

        if(data=="setting_updated"){
          $(self).removeAttr('disabled').css({'opacity': 1, 'color': '#fff'});
          $('.btn_sweet_art1').click();
          //$("#edit_settings1")[0].reset();
        
        }else{
          $(self).removeAttr('disabled').css({'opacity': 1, 'color': '#fff'});
          $(".alert_msg2").show().html(data);
        }

      },error : function(data){
          $(self).removeAttr('disabled').css({'opacity': 1, 'color': '#fff'});
          $(".alert_msg2").show().html('Poor Network Connection!');
      }
    });
  });



  $('body').on('click', '.cmd_add_locs', function(e) {
    $(".alert_msg1").hide();
    var self = this;
    
    if($("#txtf_loc").val()=="" && $("#txtt_loc").val()==""){
      alert('Please type in a location!');
      return false;
    }

    $(self).attr('disabled', true).css({'opacity': '0.5'});
    $.ajax({
      type : "POST",
      url : site_urls+"node/add_location",
      data: $(".frm_add_locs").serialize(),
      success : function(data){
        $(".frm_add_locs")[0].reset();
        $('.btn_sweet_art2').click();
        setTimeout(function(){
          $('.close').trigger('click');
        },2000);
        $(self).removeAttr('disabled').css({'opacity': '1'});
        
      },error : function(data){
          $(self).removeAttr('disabled').css({'opacity': '1'});
          $(".alert_msg1").show().html('<p>Poor Network Connection!</p>');
      }
    });
  });



  $('body').on('click', '.cmd_login_admin', function () {
    var self = this;
    $(self).attr('disabled', true).css({'opacity': '0.4'});
    $(".alert_msg1").hide();
    $.ajax({
        type : "POST",
        url : site_urls+"node/logme_adms",
        data: $(".login_form").serialize(),
        success : function(data){
          //alert(data)
          if(data=="successor1"){
              setTimeout(function(){
                $(".alert_msg1").fadeOut('slow');
              },2500);

              window.location = site_urls+"shields/";
              $(self).removeAttr('disabled').css({'opacity': 1});

          }else{
              $(self).removeAttr('disabled').css({'opacity': 1});
              $(".alert_msg1").show().html(data);
          }

        },error : function(data){
            $(self).removeAttr('disabled').css({'opacity': 1});
            $(".alert_msg1").show().html(data);
        }
    });
  });



  $('body').on('click, change', '.pickups', function () {
    var pickup_val2 = $(this).find(':selected').data('value2');
    var datastring='pickups='+pickup_val2;
    $(".txtrider").empty().html("<option> Loading ...</option>");

    $.ajax({
      type : "POST",
      url : site_urls+"node/show_nearby_riders",
      data : datastring,
      cache : false,
      success : function(data){
        if(data == 0){
          $(".txtrider").empty();
        }else{
          $(".txtrider").empty().append(data);
        }
      },error : function(data){
      }
    });
  });



  
  $('body').on('change', '.pickups', function(e) {
    var ids = $(this).attr('ids');
    var deliverys = $("#deliverys"+ids).find(':selected').data('value2');
    var pickup_val2 = $(this).find(':selected').data('value2');

    var datastring='pickups='+pickup_val2
    +'&deliverys='+deliverys;

    $.ajax({
      url : site_urls+"node/getPrice",
      type: 'POST',
      data: datastring,
      success:function(data){
        $('#txtdistance_price'+ids).val(data);
        data = parseInt(data).toLocaleString(); // addcomma
        $('#lbldistance_price'+ids).html(data);

        var sums = 0;
        $('.txtdistance_price').each(function() {
          if($(this).val()!="" || $(this).val()>0){
            sums += parseInt($(this).val());
          }
        });
        sums = parseInt(sums).toLocaleString();
        $('.sum_total').html("&#8358;"+sums);
      }
    });
  });


  $('body').on('change', '.deliverys', function(e) {
    var ids = $(this).attr('ids');
    //var pickups = $(this).find(':selected').data('value');
    var deliverys = $(this).find(':selected').data('value2');
    var pickup_val2 = $('#pickups'+ids).find(':selected').data('value2');

    var datastring='pickups='+pickup_val2
    +'&deliverys='+deliverys;

    $.ajax({
      url : site_urls+"node/getPrice",
      type: 'POST',
      data: datastring,
      success:function(data){
        $('#txtdistance_price'+ids).val(data);
        data = parseInt(data).toLocaleString(); // addcomma
        $('#lbldistance_price'+ids).html("&#8358;"+data);

        var sums = 0;
        $('.txtdistance_price').each(function() { 
          if($(this).val()!="" || $(this).val()>0){
            sums += parseInt($(this).val());
          }
        });

        sums = parseInt(sums).toLocaleString();
        $('.sum_total').html("&#8358;"+sums);
      }
    });
  });


  //alert('ss')
  //function autocomplet() {
  $('body').on('keyup', '.txtsearch', function(e) {
    var min_length = 0;
    var keyword = $('.txtsearch').val();
    var page = $(this).data('val');
    var src_val = $('.txtsearch').val();
    
    var datastring='keyword='+keyword
    +'&src_val='+src_val;

    //alert(datastring)
      if (keyword != "") {
      $.ajax({
        url : site_urls+"node/getSearches",
        type: 'POST',
        data: datastring,
        success:function(data){
          //alert(data);
          if(data != ""){
            $('#country_list_id').show();
            $('#country_list_id').html(data);
          }else{
            $('#country_list_id').hide();
            $('#country_list_id').html('');
          }
        },error : function(data){
          
        }
      });
    } else {
      $('#country_list_id').hide();
    }
  });



  $('body').on('click', '.txtsearch', function(e) {
    var min_length = 0;
    var keyword = $('.txtsearch').val();
    var page = $(this).data('val');
    var src_val = $('.txtsearch').val();
    $('#country_list_id').show().html('Loading customers...');
    
    var datastring='keyword='+keyword
    +'&src_val='+src_val;

    $.ajax({
      url : site_urls+"node/getSearches_click",
      type: 'POST',
      data: datastring,
      success:function(data){
        //alert(data);
        if(data != ""){
          $('#country_list_id').show().html(data);
        }else{
          $('#country_list_id').html('').hide();
        }
      }
    });
  });


  $('body').on('click', '.set_item', function(e) {
    var item = $(this).attr('setItem');

    var phone = $(this).attr('phone');
    var names = $(this).attr('names');
    var emails = $(this).attr('emails');
    var addr = $(this).attr('addr');
    $('.txtsearch').val(item);
    $('#country_list_id').hide();

    $('.display_info').fadeIn('fast');
    $('.myname').html(names);
    $('.myemail').html(emails);
    $('.myphone').html(phone);
    $('.myaddr').html(addr);
  });


  /*function set_item(item) {
    $('.txtsearch').val(item);
    $('#country_list_id').hide();
  }*/



});

//})($jq1);





/*function create_cookie(name, value, days2expire, path) {
  var date = new Date();
  date.setTime(date.getTime() + (days2expire * 24 * 60 * 60 * 1000));
  var expires = date.toUTCString();
  document.cookie = name + '=' + value + ';' +
                   'expires=' + expires + ';' +
                   'path=' + path + ';';
}*/


/*function retrieve_cookie(name) { // i cancelled it bcos the menu on the right side is not working
  var cookie_value = "",
    current_cookie = "",
    name_expr = name + "=",
    all_cookies = document.cookie.split(';'),
    n = all_cookies.length;
 
  for(var i = 0; i < n; i++) {
    current_cookie = all_cookies[i].trim();
    if(current_cookie.indexOf(name_expr) == 0) {
      cookie_value = current_cookie.substring(name_expr.length, current_cookie.length);
      break;
    }
  }
  return cookie_value;
}*/


function readURL(input, idf){
  if(input.files && input.files[0]){
    var reader = new FileReader();
    reader.onload=function(e){
      $(idf).attr('src',e.target.result);
    }
  reader.readAsDataURL(input.files[0]);
  }
}

