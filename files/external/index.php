<div id="main" class="index">
  <div class="container container-center">
    <div class="row form">
      <div class="col l6 s12 offset-l3">
        <div class="home-title">
          <div>
          <h4 style="color: orange;">⚠️ WELCOME ON WOLF_FR ⚠️</h4>
          </div>
        </div>

        <div class="card grey darken-3">

          <ul class="tabs grey darken-4 tabs-fixed-width tab-demo z-depth-1">
            <li class="tab"><a href="#login">LOG IN</a></li>
            <li class="tab"><a href="#register">REGISTER</a></li>
          </ul>

          <form id="login" method="post">
            <div class="card-content grey darken-3">
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">person</i>
                  <input type="text" name="username" id="l-username" maxlength="20" required>
                  <label for="l-username">Username</label>
                </div>
                <div class="input-field col s12">
                  <i class="material-icons prefix">lock</i>
                  <input type="password" name="password" id="l-password" maxlength="45" required>
                  <label for="l-password">Password</label>
                </div>
                <div class="input-field col s12">
                  <button class="btn-large green darken-3 waves-effect waves-light col s12 btn-login">LOG IN</button>
                </div>
              </div>
            </div>
          </form>

          <form id="register" method="post">
            <div class="card-content grey darken-3">
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">person</i>
                  <input type="text" name="username" id="r-username" class="validate" maxlength="20" required>
                  <label for="r-username">Username</label>
                  <span class="helper-text" style="color: white;" data-error="Enter a valid username!">Enter your username.</span>
                </div>
                <div class="input-field col s12">
                  <i class="material-icons prefix">lock</i>
                  <input type="email" name="email" id="r-email" class="validate" maxlength="260" required>
                  <label for="r-email">Email</label>
                  <span class="helper-text" style="color: white;" data-error="Enter a valid e-mail address!">Enter your e-mail address (you'll
                    need this for verification and recovering account).</span>
                </div>
                <div class="input-field col s12">
                  <i class="material-icons prefix">lock</i>
                  <input type="password" name="password" id="r-password" class="validate" maxlength="45" required>
                  <label for="r-password">Password</label>
                  <span class="helper-text" style="color: white;" data-error="Enter a valid password!">Enter your password.</span>
                </div>
                <div class="input-field col s12">
                  <i class="material-icons prefix">lock</i>
                  <input type="password" name="password_confirm" id="r-password-confirm" class="validate" maxlength="45"
                    required>
                  <label for="r-password-confirm">Password Confirm</label>
                  <span class="helper-text" style="color: white;" data-error="Enter a valid password!">Confirm your password.</span>
                </div>
                <div class="input-field col s12">
                  <p>
                    <label>
                      <input type="checkbox" name="agreement" required>
                      <span><a class="modal-trigger" style="color: white;" href="#modal">Terms & Conditions</a> read and accepted</span>
                    </label>
                  </p>
                </div>
                <div class="input-field col s12">
                  <button class="btn-large green waves-effect waves-light col s12">REGISTER</button>
                </div>
              </div>
            </div>
          </form>
          <!--<div class="card-action">
                  <a id="reset-password" href="#" class="grey-text text-darken-2">FORGOT PASSWORD</a>
                </div>
                -->
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  color: white;
}
</style>
<div class="footer white-text grey darken-4">
      <div class="left">
    © <?php echo date('Y'); ?> <?php echo SERVER_NAME; ?> | Online: <?php echo Socket::Get('OnlineCount', array('Return' => 0)); ?>
      </div>
      <div class="right">
      <a class="grey-text text-lighten-4" href="https://discord.gg/RRR3pntjuB" target="_blank">Discord</a>
      |
      <a class="grey-text text-lighten-4" href="ts3server://wolffr.ddns.net" target="_blank">Teamspeak</a>
    </div>
    </div>
</div>

<style>
.banner {
  position: fixed;
  left: 0;
  bottom: 50;
  width: 100%;
  color: white;
}
</style>
<div class="footer white-text grey darken-4">
    </div>
</div>
