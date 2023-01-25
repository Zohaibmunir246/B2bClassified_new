$('.form-group #phone').attr("placeholder", "Phone");
$('.form-group #address').attr("placeholder", "Address");
$('.form-group #fname').attr("placeholder", "First Name");
$('.form-group #lname').attr("placeholder", "Last Name");
$('.form-group #companyname').attr("placeholder", "My Company Name");
$('.form-group #email').attr("placeholder", "Email"); 
$('input[name=firstname]').attr("placeholder", "First Name"); 
$('input[name=lastname]').attr("placeholder", "Last Name");

$('.sidebarTitle').each(function() {
    var text = $(this).text();
    $(this).text(text.replace('( AED )', '')); 
});
$('.postad-img img').css('display', 'block !important');
$('.postad-img img').css('display', 'block !important');
