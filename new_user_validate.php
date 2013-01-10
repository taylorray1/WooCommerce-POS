var fname = $("#fname").val();
var lname = $("#lname").val();
var email = $("#email").val();
var phone = $("#phone").val();
var username = $("#username").val();
var address = $("#address").val();
var city = $("#city").val();
var zip = $("#zip").val();
var state = $("#state").val();
var country = $("#country").val();

var sameshipping = $('#shippingunitcheck').val();
var shippingfname = $('#hippingfname').val();
var shippinglname = $('#shippinglname').val();
var shippingcompany = $('#shippingcompany').val();
var shippingaddress = $('#shippingaddress').val();
var shippingcity = $('#shippingcity').val();
var shippingzip = $('#shippingzip').val();
var shippingstate = $('#shippingstate').val();
var shippingcountry = $('#shippingcountry').val();


var string = 'fname=' + fname + '&lname+' + lname + '&email=' + email + '&phone=' + phone + '&username=' + username + '&address=' + address + '&city=' + city + '&zip=' +zip + '&state=' + state + '&country=' + country + '&dsa=' + sameshipping + '&shippingfname=' + shippingfname + '&shippinglname=' + shippinglname + '&shippingcompany=' + shippingcompany + '&shippingaddress=' + shippingaddress + '&shippingcity=' + shippingcity + '&shippingzip=' + shippingzip + '&shippingstate=' + shippingstate + '&shippingcountry=' + shippingcountry;

$(function() {  

$(".buttonnu").click(function() {  

//alert('YOYOYOYOYOY');


$.ajax({  
  type: "POST",  
  url: "<? echo $plugin_url ?>new_user.php",  
  data: string,  
  success: function() {  
    
  }  

    });
    });
    });



