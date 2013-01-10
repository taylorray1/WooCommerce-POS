<?php
  include 'cartjs.php';
?>

//helper function to create the form
function getNewSubmitForm()
{
    var submitForm = document.createElement("FORM");
    document.body.appendChild(submitForm);
    submitForm.method = "POST";
    return submitForm;
}
    
// Creates a form and to send cart information to the process sales page
function proc_to_checkout()
{
    var m_cart = get_neat_cart();
    var str = JSON.stringify(m_cart);
    
    var current_id;
    var submitForm = getNewSubmitForm();
    
    // put cart in json
    newElement = document.createElement('input');
    newElement.name = "jsoncart";
    newElement.type = "hidden";
    submitForm.appendChild(newElement);
    newElement.value = str;

    newElement = document.createElement('input');
    newElement.name = "customer-id";
    newElement.type = "hidden";
    submitForm.appendChild(newElement);

    var user_id =  document.getElementById('customer-select').value;

    if (user_id != 0 && (get_cart_total() > 0))
    {
        newElement.value = user_id;
        submitForm.action= "<?php echo $plugin_url ?>process-sales.php";
        submitForm.submit();
    }
    else if(user_id == 0 )
    {
        $("#customer-select").effect("highlight", {color:"#F14545"}, 1000);
        //$("#customer-select").show();
        $("#customer-select").focus();
    } 
    else
    {   
        $("#empty-cart").focus();
        $("#empty-cart").effect("highlight", {color:"#F14545"}, 1000);
    }
}
 
function print_cart()
{
    var m_cart = get_cart();
    $('#cart').empty();
    var current_id;
    for (current_id in m_cart) {
        if(m_cart[current_id] > 0)
            $('<tr id="product"><td class="product-name">'+get_name(current_id)+'</td><td><input type="text" id="amount" value="'+m_cart[current_id]+'"><div id="plus-buttons"><div class="incbutton"><input type="hidden" id="item-id" value="'+current_id+'"><p class="btn"><i class="icon-plus"></i></p></div><div class="decbutton"><input type="hidden" id="item-id" value="'+current_id+'"><p class="btn"><i class="icon-minus"></i></p></div></div></td><td>$<span id="price">'+get_price(current_id)+'</span></td><td id="removeitem"><input type="hidden" id="item-id" value="'+current_id+'"><a href="#" class="btn btn-danger"><i class="icon-remove-circle icon-white"> </i></a></td></tr>').appendTo('#cart');
    }
    $('#cart-total').empty();
    $('#cart-total').append(get_cart_total());
    if(get_cart_total() > 0)
    {
        $("#empty-cart").hide();
        $("#empty-cart-wrapper").hide();
        $("#cart-table").show();
        $("#cart-table").css("margin-bottom", "20px");
    }
    else{
        $("#empty-cart").show();
        $("#empty-cart-wrapper").show();
        $("#cart-table").css("margin-bottom", "0px");
    }
        

}
    
$(document).ready(function()
{
    $("#cart-table").css("margin-bottom", "0px");
    var total = 0;
    var cartview = $('#cart');
    $("#product-search").searchable();
    document.getElementById('featured-products').innerHTML = '<?php
            $args = array('post_type' => 'product', 'numberposts' => 1000);
            $post_array = get_posts( $args ); 
            $i = 0;
            
            foreach($post_array as $my_post_result) 
            {
                $product = new WC_Product($my_post_result->ID);
                $catagories = $product->get_categories();
                $product_meta = get_post_meta($product->id, 'pos-feature', true);
                if($product_meta == 'true')
                {
                    if($product->price > 0)
                    {
                        echo '<div class="featured-item  btn btn-inverse"><i class="icon-tags icon-white"></i> '. $my_post_result->post_title .'<input class="FID" type="hidden" value="'.$my_post_result->ID.'"></div>';
                        $i++;
                    }
                }
            }
    ?>';
    

$('.featured-item').click(function() 
{
    var current_id = this.childNodes[2].value;
    add_to_cart(current_id);
    print_cart();
});


$('#amount').live('change', function()
{
    var qty = $(this).val();
    var plus_node = $(this).next();
    var item_id = plus_node.find('#item-id').attr('value')
    set_item_qty(item_id, qty);
    print_cart();
});
        
$('#addScnt').live('click', function() {
    var current_id =$('#product-search').attr('value');
    add_to_cart(current_id);
    print_cart();
});
            
$('#removeitem').live('click', function() 
{
    var item_id = $(this).find('#item-id').attr('value');
    remove_from_cart(item_id);
    print_cart();
});

$(".incbutton").live('click', function() 
{
    var item_id = $(this).find('#item-id').attr('value');
    add_to_cart(item_id);
    print_cart();
});

$(".decbutton").live('click', function() 
{
    var item_id = $(this).find('#item-id').attr('value');
    remove_one_from_cart(item_id);
    print_cart();
});

$("#shipping").hide();

$("#shippingunitcheck").change(function(){
    if ($(this).val() == 'no')
    {
        $("#shipping").show();
    }
        if ($(this).val() == 'yes')
    {
        $("#shipping").hide();
    }
});

$("form#newuserform").submit(function(event) 
{
    event.preventDefault();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var username = $("#email").val();
    var address = $("#address").val();
    var city = $("#city").val();
    var zip = $("#zip").val();
    var state = $("#state").val();
    var country = $("#country").val();
    var company = $("#company").val();
    var sameshipping = $('#shippingunitcheck').val();
    var shippingfname = $('#shippingfname').val();
    var shippinglname = $('#shippinglname').val();
    var shippingcompany = $('#shippingcompany').val();
    var shippingaddress = $('#shippingaddress').val();
    var shippingcity = $('#shippingcity').val();
    var shippingzip = $('#shippingzip').val();
    var shippingstate = $('#shippingstate').val();
    var shippingcountry = $('#shippingcountry').val();

    var string = 'fname=' + fname + '&lname=' + lname + '&email=' + email + '&phone=' + phone + '&username=' + username + '&address=' + address + '&city=' + city + '&zip=' +zip + '&state=' + state + '&company=' + company + '&country=' + country + '&dsa=' + sameshipping + '&shippingfname=' + shippingfname + '&shippinglname=' + shippinglname + '&shippingcompany=' + shippingcompany + '&shippingaddress=' + shippingaddress + '&shippingcity=' + shippingcity + '&shippingzip=' + shippingzip + '&shippingstate=' + shippingstate + '&shippingcountry=' + shippingcountry;
    $(".modal-body").append('<div id="loading" style="position:absolute; left:49%; width:100px; background:#333; color:white;">Processing...</div>');    
    $("#newuser").css({"overflow":"hidden"});
    if(email == '')
    {   
        $("#loading").remove();
        $("#newuser").css({"overflow":"auto"});
        $("#email").focus();
        $("#email").css("color", "#B94A48");
        $("#email").css("border-color", "#B94A48");
        $('label[for="email"]').css("color", "#B94A48");
        $('label[for="email"]').css("font-weight", "900");
        $(".alert").show();
        $(".alert").text('You must enter an Email');
    }

    else
    {    
        $.ajax({
            type: "POST",
            url: "<?php echo $plugin_url ?>new_user.php",
            data: string,
            success: function(data){
            var response = jQuery.parseJSON(data);
                if (response.errors) {
                    $("#loading").remove();
                    $("#newuser").css({"overflow":"auto"});
                    var currentId = $('#username').attr('id');
                    $("#email").focus();
                    $("#email").css("color", "#B94A48");
                    $("#email").css("border-color", "#B94A48");
                    $('label[for="email"]').css("color", "#B94A48");
                    $('label[for="email"]').css("font-weight", "900");
                    $(".alert").show();
                    $(".alert").text('Email already exists');
                } else {
                    $("#loading").remove();
                    $(".alert").remove();
                    $("#customer-select").append('<option value="'+data+'" selected="selected">'+email+'</option>');
                    $("#newuserform").hide();
                    $("h3").hide();
                    $(".modal-body").append('<h2 class="newusersuccess" style="text-align:center;">New User added!</h2>');
                    $(".modal").fadeOut(1600, function() {
                    $(".modal").modal("hide");
                    $("#newuserform").show();
                    $("#newuserform input").val('');
                    $(".newusersuccess").remove();
                    $("#username").css("color", "#000");
                    $("#username").css("border-color", "#000");
                    $('label[for="username"]').css("color", "#000");
                    $('label[for="username"]').css("font-weight", "400");
                    $("h3").show();
                    });
                }
            }
        });
    }
}); 

}); 

