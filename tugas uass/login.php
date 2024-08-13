<style>
    .navbar {
        display: none;
    }
    .sidebar {
        display: none;
    }
    .header {
        display: none;
    }
</style>
<?php
// membaca session
if(isset($_SESSION['pesan'])){
  $pesan = $_SESSION['pesan'];
  session_destroy();
?>
<div class="container">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
      </symbol>
    </svg>

    <div class="alert alert-primary d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
      <div>
        <?= $pesan; ?>
      </div>
    </div>

    <?php
    }
    ?>

    <div class="form-bg">
        <div class="container" style="margin-top: 160px;">
            <div class="row">
                <div class="col-md-offset-3 col-md-6 justify-content-md-center m-auto">
                    <div class="form-container">
                        <h3 class="title">Login</h3>
                        <form class="form-horizontal" method="post" action="proseslogin.php">
                          <fieldset>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="User Name">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <span class="signin-link mt-3">
                            <a href="./?module=register"> </a></span>
                            <button class="btn signup mt-3">Sign In</button>
                          </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>