<?php
echo "
<div class='container col-md-4 col-md-offset-2'>
<form action='' method='post' name='userForm'>
  <div class='form-group'>
    <label for='fname'>First name</label>
      <input type='text' class='form-control' name='fname'
      id='fname' placeholder='First name' />
  </div>
  <div class='form-group'>
    <label for='lname'>Last name</label>
      <input type='text' class='form-control' name='lname'
      id='lname' placeholder='Last name' />
  </div>
  <div class='form-group'>
    <label for='address1'>Address line 1</label>
      <input type='text' class='form-control' name='address1'
      id='address1' placeholder='line 1' />
  </div>
  <div class='form-group'>
    <label for='address2'>Address line 2</label>
      <input type='text' class='form-control' name='address2'
      id='address2' placeholder='line 2' />
  </div>
  <div class='form-group'>
    <label for='city'>City</label>
      <input type='text' class='form-control' name='city'
      id='city' placeholder='city' />
  </div>
  <div class='form-group'>
    <label for='state'>State</label>
      <input type='text' class='form-control' name='state'
      id='state' placeholder='state' />
  </div>
  <div class='form-group'>
    <label for='zip'>Zip</label>
      <input type='text' class='form-control' name='zip'
      id='zip' placeholder='zip code' />
  </div>
  <div class='form-group'>
    <label for='email'>Email Address</label>
      <input type='text' class='form-control' name='email'
      id='email' placeholder='Email Address' />
  </div>
  <div class='form-group'>
    <label for='password'>Password</label>
      <input type='password' class='form-control' name='password'
      id='password' placeholder='password' />
  </div>
  <div class='form-group'>
    <label for='phone'>Phone</label>
      <input type='text' class='form-control' name='phone'
      id='phone' placeholder='phone number' />
  </div>
  <div class='form-group'>
    <label for='accesslevel'>Account Type</label>
    <select class='form-control' name='accesslevel' id='accesslevel'>
        <option value='3'>Customer</option>
        <option value='2'>Photographer</option>
    </select>
  </div>
  ";
  if($_SESSION['accesslevel']==1){
  echo "
  <div class='form-group'>
    <label for='lastaccess'>Last Access</label>
      <input type='text' class='form-control' name='lastaccess' id='lastaccess' value='' readonly>
  </div>";
}
echo "<div class='btn-group'>
  <a type='button' class='btn btn-md btn-default' href='#' onclick='history.back();' style='margin-right:0;'>Close</a>
  <button type='submit' name='submit' id='submit' class='btn btn-success'><i class='fa fa-check-square-o'></i> Submit</button>
  </div>
</form>
</div>";
?>
