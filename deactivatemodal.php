<?php

if(basename($_SERVER['PHP_SELF']) == 'adminusers.php' || basename($_SERVER['PHP_SELF']) == 'edituser.php'){
  echo "
  <div class='modal fade' id='confirm-delete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
      <div class='modal-dialog'>
          <div class='modal-content'>
              <div class='modal-header'>
                  Confirm Deactivation of User:
              </div>
              <div class='modal-body'>
              <input type='text' name='userid' id='userid' value='' readonly/>
              </div>
              <div class='modal-footer'>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                  <a id='deact' class='btn btn-danger' type='submit' href='/deactivate.php' >Deactivate</a>
              </div>
          </div>
      </div>
  </div>";
}elseif(basename($_SERVER['PHP_SELF']) == 'adminorders.php'){
  echo "
  <div class='modal fade' id='confirm-delete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
      <div class='modal-dialog'>
          <div class='modal-content'>
              <div class='modal-header'>
                  Confirm Deactivation of Order:
              </div>
              <div class='modal-body'>
              <input type='text' name='orderid' id='orderid' value='' readonly/>
              </div>
              <div class='modal-footer'>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                  <a id='deact' class='btn btn-danger' type='submit' href='/deactivate.php' >Deactivate</a>
              </div>
          </div>
      </div>
  </div>";
}


// What follows is an example DEACTIVATE button that will call this modal, be sure custom.js is included on the page
// (custom.js is included by default on any page with footer.php included at the bottom)
//          <td><a class="btn btn-danger open-confirmDialog"href="#confirm-delete" data-toggle="modal" data-id="'.$row["userid"].'" data-target="#confirm-delete">
//              Deactivate</a></td>
//
//

?>
