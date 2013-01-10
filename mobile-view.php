<LINK href="<?php echo $plugin_url ?>css/mobile-style.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
<?php
  include 'mobile-controller.php';
?>
</script>
<head> 
    <title>Point of Sale | Brain Child Design</title> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 
<body> 

<div data-role="page">
    <div data-role="header" data-position="fixed">
    <button onclick="proc_to_checkout()">Checkout</button>
        <div id="total-view"><span style="font-size:20px;">$<span id="cart-total">0.00</span></span></div>
    </div><!-- /header -->
    
    <div id="main-content-div" data-role="content"> 

    <div id="featured-products"></div>

    <div id="cart-table" class="ui-grid-c">
        <div class="ui-block-a cart-head">Product</div>
        <div class="ui-block-b cart-head">Qty</div>
        <div class="ui-block-c cart-head">Price</div>
        <div class="ui-block-d cart-head">Remove</div>
    </div>

    <div id="customer-select-div">
        <button id="new-customer-btn">Create New Customer </button>
        <form class="ui-listview-filter"> 
            <div id="customers"></div>
        </form>
    </div>

    <div id="customer-review">
        <div id="customer-review-text"></div>
        <a id="back-to-cs" data-role="button">Back to customer select</a>
    </div>

    <div id="new-customer">
        <div>
            <div class="error" style="display:none"></div>
            <h3 style="margin:0 auto;text-align:center;">Create New User</h3><BR/>
            <form name="new_user" id="newuserform">
                <div id="billing">
          
                    <div class="control-group">
                        <label class="control-label" for="email">Email</label>
                        <div class="controls">
                          <input type="text" id="email" name="email" placeholder="Email">
                        </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="fname">First Name</label>
                      <div class="controls">
                        <input type="text" id="fname" name="fname" placeholder="First Name">
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="lname">Last Name</label>
                      <div class="controls">
                        <input type="text" id="lname" name="lname" placeholder="Last Name">
                      </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="phone">Telephone</label>
                        <div class="controls">
                          <input type="text" id="phone" name="phone" placeholder="Telephone Number">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="company">Company</label>
                        <div class="controls">
                             <input type="text" id="company" name="company" placeholder="company">
                        </div>
                    </div>

                  
                    <div class="control-group">
                        <label class="control-label" for="address">Address</label>
                        <div class="controls">
                            <input type="text" id="address" name="address" placeholder="Address">
                        </div>
                    </div>

                      <div class="control-group">
                        <label class="control-label" for="city">City</label>
                        <div class="controls">
                          <input type="text" id="city" name="city" placeholder="City">
                        </div>
                      </div>

                  <div class="control-group">
                    <label class="control-label" for="zip">Zip Code</label>
                    <div class="controls">
                      <input type="text" id="zip" name="zip" placeholder="Zip Code">
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="state">State</label>
                    <div class="controls">
                        <input type="text" id="state" name="state" placeholder="State">
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="state">Country</label>
                    <div class="controls">
                        <input type="text" id="country" name="country" placeholder="country">
                    </div>
                  </div>

                  <div class="control-group">
                      <label class="control-label" for="website">Website</label>
                      <div class="controls">
                        <input type="text" id="website" name="website" placeholder="Customer's Website">
                      </div>
                  </div>
            </div>
            <div style="margin:10px;">
                <button style="float:right; margin:10px;" class="btn btn-primary" id="buttonnu">Submit</button>
            </div>
        </form>
        </div>
    </div>

    </div><!-- /content -->

    <div data-role="footer" class="ui-grid-b" class="ui-bar" data-position="fixed">
        <div class="ui-block-a"><a id="products-link" href="" data-role="button">Products</a></div>
        <div class="ui-block-b"><a id="cart-link" data-role="button" >Cart</a></div>
        <div class="ui-block-c"><a id="customer-link"  href="" data-role="button" >Customers</a></div>
    </div>

</div><!-- /page -->
<form>
    <input type="hidden" id="customer-select" value="1">
</form>
</body>
