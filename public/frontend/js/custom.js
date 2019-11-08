$(function(){
    $('.youtube-video').css({ width: $(window).innerWidth() + 'px', height: $(window).innerHeight() + 'px' });

    // If you want to keep full screen on window resize
    $(window).resize(function(){
        $('.youtube-video').css({ width: $(window).innerWidth() + 'px', height: $(window).innerHeight() + 'px' });
    });

    $("#headerRegister").submit(function(e){
    	e.preventDefault();
    	var url = $(this).attr('action');
    	$.ajax({
           type: "POST",
           url: url,
           data: $("#headerRegister").serialize(),
           success: function(data)
           {
           		if(data.success == true)
           		{
           			swal({
	                  title:'Thank you!',
	                  text:data.message,
	                  type:'success'
	                }).then(function() {
	                    $('#register-modal').modal('hide');
	                    window.location.replace(data.redirectPath);
	                });
           		}
           		else
           		{

       				swal({
                      title:'Errors',
                      html:data.error,
                      type:'error'
                    });
           		}           		
           }
         });
    });
    $("#write_review_form").submit(function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        $.ajax({
           type: "POST",
           url: url,
           data: $("#write_review_form").serialize(),
           success: function(data)
           {
              if(data.success == true)
              {
                swal({
                    title:'Thank you!',
                    text:data.message,
                    type:'success'
                  }).then(function() {
                    $("#reviewInput").val('2');
                    $("#reviewDiv").rateYo("rating", '2');
                    $("#write_review_form").find("input[type=text], textarea").val(""); 
                  });
              }
              else
              {
                var auth = data.auth;
                swal({
                  title:'Errors',
                  text:data.message,
                  type:'error'
                }).then(function() {
                  if(auth == false)
                  {
                    $('#login-modal').modal('show');
                  }    
                });
              }               
           }
         });
    });

    if($(".page-slider-setup").length)
    {
      $(".page-slider-setup").slick({
          dots: false,
          infinite: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 2000
      });
    }

    $("#mailingSubmitForm").submit(function(e){
      e.preventDefault();
      var url = $(this).attr('action');
      $.ajax({
           type: "POST",
           url: url,
           data: $("#mailingSubmitForm").serialize(),
           success: function(data)
           {
              if(data.success == true)
              {
                swal({
                    title:'Thank you!',
                    text:data.message,
                    type:'success'
                  }).then(function() {
                      $('#mailing-modal').modal('hide');
                      $("#mailingSubmitForm").find("input[type=text], input[type=email]").val("");
                  });
              }
              else
              {

              swal({
                      title:'Errors',
                      text:data.message,
                      type:'error'
                    });
              }               
           }
         });
    });

    $("#joinusSubmitForm").submit(function(e){
      e.preventDefault();
      var url = $(this).attr('action');
      $.ajax({
           type: "POST",
           url: url,
           data: $("#joinusSubmitForm").serialize(),
           success: function(data)
           {
              if(data.success == true)
              {
                swal({
                    title:'Thank you!',
                    text:data.message,
                    type:'success'
                  }).then(function() {
                      $('#joinus-modal').modal('hide');
                      $("#joinusSubmitForm").find("input[type=text], input[type=email]").val("");
                  });
              }
              else
              {

              swal({
                      title:'Errors',
                      text:data.message,
                      type:'error'
                    });
              }               
           }
         });
    });
});