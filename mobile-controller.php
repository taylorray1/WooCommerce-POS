<?php
  include 'cartjs.php';
?>
var customerSelected = false;
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

    if (get_cart_total() > 0)
    {   
        newElement.value = user_id;
        submitForm.action= "<?php echo $plugin_url ?>mobile-process-sales.php";
        submitForm.submit();
    }
}
 
function print_cart()
{
    var m_cart = get_cart();
    $('#cart-table').empty();
    $('<div class="ui-block-a cart-head">Product</div><div class="ui-block-b cart-head">Qty</div><div class="ui-block-c cart-head">Price</div><div class="ui-block-d cart-head">Remove</div>').appendTo("#cart-table");
    var current_id;
    for (current_id in m_cart) {
        if(m_cart[current_id] > 0)
            $('<div class="product-name ui-block-a">'+get_name(current_id)+'</div><div class="ui-block-b"><input type="text" id="amount" value="'+m_cart[current_id]+'"><input type="hidden" id="item-id" value="'+current_id+'"></div><div class="ui-block-c">$<span id="price">'+get_price(current_id)+'</span></div><div class="ui-block-d" id="removeitem"><input type="hidden" id="item-id" value="'+current_id+'"><button id="remove-btn">x</button></div>').appendTo('#cart-table');
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
    else
    {
        $("#empty-cart").show();
        $("#empty-cart-wrapper").show();
        $("#cart-table").css("margin-bottom", "0px");
        $("#cart-table").append('<div style="padding-top:60px; margin: 0 auto; font-size:16px; font-weight:bold;">Empty...</div>');
    }
}
    

$(document).ready(function()
{
    $("label").addClass("ui-hidden-accessible");
    $("#cart-table").hide();
    $("#customer-select-div").hide();
    $("#customer-review").hide();
    $("#new-customer").hide();
    $("#customer").hide();
    $("#country").val("United States");
    $("#cart-table").css("margin-bottom", "0px");
    var total = 0;
    var cartview = $('#cart');
    document.getElementById('featured-products').innerHTML = '<?php
            $args = array('post_type' => 'product', 'numberposts' => 1000);
            $post_array = get_posts( $args );
            $i = 0;
            foreach($post_array as $my_post_result) 
            {
                $product = new WC_Product($my_post_result->ID);
                $catagories = $product->get_categories();
                $product_meta = get_post_meta($product->id, 'pos-feature', true);
                if($product->price > 0)
                    echo '<button class="featured-item"><input class="FID" type="hidden" value="'.$my_post_result->ID.'"><span style="float:left; max-width: 60%; white-space:normal;">'. $my_post_result->post_title .'</span><span style="float:right;">$'.$product->price.'</span></button>';
            }
    ?>';

    document.getElementById('customers').innerHTML = '<?php
        echo '<ul data-role="listview" id="customer-list" class="ui-listview" data-filter="true">';
        // prepare arguments
        $args  = array('orderby' => 'display_name');
        // Create the WP_User_Query object
        $wp_user_query = new WP_User_Query($args);
        // Get the results
        $users = $wp_user_query->get_results();
        // loop trough each user
        foreach ($users as $current_user)
        {
            // get all the user's data
            if(user_can($current_user->ID, "customer"))
            {
                $current_user_info = get_userdata($current_user->ID);
                if($current_user_info->user_email != '')
                {
                    echo '<li id="customer-list-item"><a id='.$current_user_info->ID.'">'.$current_user_info->user_email.' <br /><p style="padding-top:10px;"><strong>('.get_user_meta( $current_user->ID, "billing_first_name", true).' '.get_user_meta( $current_user->ID, "billing_last_name", true).') </strong></p></a></li>';
                }
                else
                {
                    echo '<li id="customer-list-item"><a id='.$current_user_info->ID.'">'.$current_user_info->display_name.'<br /><p style="padding-top:10px;"><strong>'.get_user_meta( $current_user->ID, "billing_first_name", true).' '.get_user_meta( $current_user->ID, "billing_last_name", true).' </strong></p></a></li>';
                }
            }
        }
        echo '</ul>';
    ?>';

    $('.featured-item').click(function() 
    {
        var current_id = this.childNodes[0].value;
        add_to_cart(current_id);
        $('#cart-total').empty();
        $('#cart-total').append(get_cart_total());
    });

    $("#customer-list-item").live('click', function(){
        $(".li-selected").removeClass("li-selected");
        $(".ui-link-inherit").removeClass("li-text-selected");
        $(this).addClass("li-selected");
        $(this).find(".ui-link-inherit").addClass("li-text-selected");
        var user_id = $(this).find("a").attr("id");
        var selectedEmail = $(this).text();
        $("#customer-select").val(user_id);
        $("#customer-select").attr("value", user_id);
        customerSelected = true;
        $("#customer-select-div").hide();
        $("#customer-review").show();
        $("#customer-review-text").text("You are selling to  " + selectedEmail);
    });

    $("#back-to-cs").live('click', function(){
        $("#customer-select-div").show();
        $("#customer-review").hide();
        customerSelected = false;
        $("#customer-select").val("1");
        $("#customer-select").attr("value", "1");
        $(".li-selected").removeClass("li-selected");
        $(".ui-link-inherit").removeClass("li-text-selected");
    });

    $('#amount').live('change', function(){
        var qty = $(this).val();
        var plus_node = $(this).next();
        var item_id = plus_node.attr('value');
        set_item_qty(item_id, qty);
        print_cart();
    });
                
    $('#removeitem').live('click', function() 
    {
        var item_id = $(this).find('#item-id').attr('value');
        remove_from_cart(item_id);
        print_cart();
    });

    $(".incbutton").live('click', function() {

        var item_id = $(this).find('#item-id').attr('value');
        add_to_cart(item_id);
        print_cart();

    });

    $(".decbutton").live('click', function() {

        var item_id = $(this).find('#item-id').attr('value');
        remove_one_from_cart(item_id);
        print_cart();
    });

    $("#cart-link").live('click', function() {
        print_cart();
        $("#cart-table").show();
        $("#featured-products").hide();
        $("#customer-select-div").hide();
        $("#customer-review").hide();
        $("#new-customer").hide();
    });

     $("#products-link").live('click', function() {
        $("#cart-table").hide();
        $("#customer-select-div").hide();
        $("#customer-review").hide();
        $("#featured-products").show();
        $("#new-customer").hide();
    });

    $("#customer-link").live('click', function()
    {
        $("#cart-table").hide();
        $("#featured-products").hide();
        if(customerSelected)
            $("#customer-review").show();
        else
        {
            $("#customer-review").hide();
            $("#customer-select-div").show();
            $("#new-customer").hide();
        }
    });

    $("#new-customer-btn").live('click', function(){
        $("#customer").hide();
        $("#customer-select-div").hide();
        $("#new-customer").show();
    });

    $("#existing-customer-btn").live('click', function(){
        $("#customer").hide();
        $("#new-customer").hide();
        $("#customer-select-div").show();
    });

    $("#buttonnu").live('click', function() 
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

        var string = 'fname=' + fname + '&lname=' + lname + '&email=' + email + '&phone=' + phone + '&username=' + username + '&address=' + address + '&city=' + city + '&zip=' +zip + '&state=' + state + '&company=' + company + '&country=' + country + '&dsa=yes';
        $("body").append('<div id="loading">Processing...</div>');
        if(email == '')
        {   
            $("#loading").remove();
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
                        $("#newuserform").hide();
                        $("h3").hide();
                        $("#new-customer").fadeOut(1600, function() {
                            $("#newuserform").show();
                            $("#newuserform input").val('');
                            $("#username").css("color", "#000");
                            $("#username").css("border-color", "#000");
                            $('label[for="username"]').css("color", "#000");
                            $('label[for="username"]').css("font-weight", "400");
                            $("h3").show();
                            $("#loading").fadeOut();
                        });
                        customerSelected = true;
                        $("#customer-select").attr("value", response);
                        $("#newuserform").hide();
                        $("#customer-review").show();
                        $("#customer-review-text").text("Created and Selling to " + email + " (" + fname + " "+ lname+ ")");
                        $("#customer-list").append('<li id="customer-list-item" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="arrow-r" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-li-last ui-btn-up-c"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a id="'+response+'" class="ui-link-inherit">'+email+'<br><p style="padding-top:10px;" class="ui-li-desc"><strong>('+fname+' '+lname+')</strong></p></a></div><span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span></div></li>');
                    }
                }
            });
        }
    }); 


//end of DOM
});