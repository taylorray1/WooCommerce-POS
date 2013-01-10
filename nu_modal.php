<!-- new user -->
<div class="modal hide" id="newuser" tabindex="-1" role="dialog" aria-labelledby="newuserLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="newuserLabel">New User</h3>
</div>

<div class="modal-body">
  <div class="alert alert-error" style="display:none"></div>
    <h3 style="margin:0 auto;text-align:center;">Billing Information</h3><BR/>
<form class="form-horizontal" name="new_user" id="newuserform">
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
 
 <!-- SHIPPING CHANGE -->
 <div class="control-group">
    <label class="control-label" for="dsa">Same Billing Address?</label>
    <div class="controls">
      <select id="shippingunitcheck" name="dsa">
        <option value="yes">Yes</option>
        <option value="no">No</option>
    </select>
    </div>
  </div> 
 <!-- SHIPPING CHANGE -->

<div id="shipping">
<h3 style="margin:0 auto;text-align:center;">Shipping Information</h3><BR/>
<div class="control-group">
  <label class="control-label" for="shippingfname">First Name</label>
  <div class="controls">
    <input type="text" id="shippingfname" name="shippingfname" placeholder="First Name">
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="shippinglname">Last Name</label>
  <div class="controls">
    <input type="text" id="shippinglname" name="shippinglname" placeholder="Last Name">
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="shippingaddress">Address</label>
  <div class="controls">
    <input type="text" id="shippingaddress" name="shippingaddress" placeholder="Address">
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="shippingcity">City</label>
  <div class="controls">
    <input type="text" id="shippingcity" name="shippingcity" placeholder="City">
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="shippingcompany">Company</label>
  <div class="controls">
    <input type="text" id="shippingcompany" name="shippingcompany" placeholder="company">
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="shippingzip">Zipcode</label>
  <div class="controls">
    <input type="text" id="shippingzip" name="shippingzip" placeholder="Zip Code">
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="shippingstate">State</label>
  <div class="controls">
    <input type="text" id="shippingstate" name="shippingstate" placeholder="State">
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="shippingcountry">Country</label>
  <div class="controls">
    <input type="text" id="shippingcountry" name="shippingcountry" placeholder="Country">
  </div>
</div>
</div>
</div>
<div style="margin:10px;">
<button class="btn btn-danger pull-left" style="float:left; margin:10px;" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button style="float:right; margin:10px;" class="btn btn-primary" id="buttonnu">Create New User</button>
</div>
</form>
</div>
<!-- new user -->