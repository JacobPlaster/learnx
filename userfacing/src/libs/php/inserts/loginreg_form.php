<!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close visible-xs" data-dismiss="modal">&times;</button>
    <button type="button" class="close close2 hidden-xs" data-dismiss="modal">&times;</button>
  </div>
  <div class="modal-header">
    <ul class="modal-nav">
      <li><a class="active" id="loginModalBodyButton">Log in</a></li>
      <li><a id="signUpModalBodyButton">Sign up</a></li>
    </ul>
  </div>


  <div id="loginModalBody" class="modal-body">
    <form role="form" method="POST" action="/login.php">
      <div class="form-group">
        <label for="username">Usename:</label>
        <input type="text" class="form-control" name="username" id="usernameLogIn">
      </div>
      <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" name="password" id="pwdLogIn">
      </div>
      <div class="checkbox pull-left">
        <label><input type="checkbox"> Remember me</label>
      </div>
      <button type="submit" name="submit-login" value="log in" class="btn btn-default btn-block">Log in</button>
    </form>
  </div><!-- END loginModalBody -->


  <div id="signUpModalBody" class="modal-body hidden">
    <form role="form" method="POST" action="/login.php?r=true">
      <div class="form-group">
        <label for="username">Usename:</label>
        <input type="text" class="form-control" name="username">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email">
      </div>
      <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" name="password1">
      </div>
      <div class="form-group">
        <label for="pwd">Re-password:</label>
        <input type="password" class="form-control" name="password2">
      </div>
      <button type="submit" name="submit-register" value="sign up" class="btn btn-default btn-block">Sign up</button>
    </form>
  </div>

</div><!-- END modal-body -->


<?php include($SERVER_PATH['inserts-footer-libs']); ?>
<?php include($SERVER_PATH['inserts-google-analytics']); ?>
<script type="text/javascript">
  $( document ).ready(function() {
    $("#loginModalBodyButton").click(function() {
      // hide/show modal body
      $("#loginModalBody").removeClass("hidden");
      $("#signUpModalBody").addClass( "hidden" );
      // add/remove active class
      $("#loginModalBodyButton").addClass("active");
      $("#signUpModalBodyButton").removeClass("active");
    });
    $("#signUpModalBodyButton").click(function() {
      // hode/show modal body
      $("#loginModalBody").addClass( "hidden" );
      $("#signUpModalBody").removeClass("hidden");
      // add/remove active class
      $("#loginModalBodyButton").removeClass("active");
      $("#signUpModalBodyButton").addClass("active");
    });

    // for the nav bar
    $("#nav-logInButton").click(function() {
      // hide/show modal body
      $("#loginModalBody").removeClass("hidden");
      $("#signUpModalBody").addClass( "hidden" );
      // add/remove active class
      $("#loginModalBodyButton").addClass("active");
      $("#signUpModalBodyButton").removeClass("active");
    });
    $("#nav-signUpButton").click(function() {
      // hode/show modal body
      $("#loginModalBody").addClass( "hidden" );
      $("#signUpModalBody").removeClass("hidden");
      // add/remove active class
      $("#loginModalBodyButton").removeClass("active");
      $("#signUpModalBodyButton").addClass("active");
    });

    <?php
      if(isset($_GET['r']))
      {
        if($_GET['r'] == 'true')
        {
          echo('
          // hode/show modal body
          $("#loginModalBody").addClass( "hidden" );
          $("#signUpModalBody").removeClass("hidden");
          // add/remove active class
          $("#loginModalBodyButton").removeClass("active");
          $("#signUpModalBodyButton").addClass("active");
          ');
        }
      }
    ?>
  });
</script>
