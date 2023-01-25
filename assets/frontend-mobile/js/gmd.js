// $(".form-group input").removeAttr("value");
$('.form-group #phone').attr("placeholder", "Phone");
$('.form-group #address').attr("placeholder", "Address");
$('.form-group #fname').attr("placeholder", "First Name");
$('.form-group #lname').attr("placeholder", "Last Name");
$('.form-group #companyname').attr("placeholder", "My Company Name");
$('.form-group #email').attr("placeholder", "Email"); 
$('input[name=firstname]').attr("placeholder", "First Name"); 
$('input[name=lastname]').attr("placeholder", "Last Name"); 
$('#inputCategory').change(function(){
  if($(this).val() == '50'){
    $('.selling_parent').addClass("hide_file");
  }
  else
  {
  	$('.selling_parent').removeClass("hide_file");
  }

});

$('*:contains("Jobs Wanted")').each(function(){
	$( ".selling_parent" ).addClass("forCv");
});

function isiPhone(){
    return (
        (navigator.platform.indexOf("iPhone") != -1) ||
        (navigator.platform.indexOf("iPod") != -1)
    );
}
if(isiPhone()){
   //alert('iPhone detected');
   $('body').addClass('iPhone');
}