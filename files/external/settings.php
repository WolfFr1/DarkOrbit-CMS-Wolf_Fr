      <div id="main">
        <div class="container">
          <div class="row">
            <div class="col s12">
            <ul class="button-container">
  <li><a class="horizontal-button" href="<?php echo DOMAIN; ?>clan/company">Change Company</a></li>
  <li><a class="horizontal-button" href="<?php echo DOMAIN; ?>skill_tree">Skill Tree</a></li>
</ul>
              <div class="card white-text grey darken-4 padding-15">
              <h4 style="color: orange;">Settings</h4>
                  <div class="row">
                    <div class="col s12 l6">
                      <form id="change_pilot_name" method="post">
                        <div class="col s12">
                          <div class="row">
                            <div class="input-field col s9">
                              <i class="material-icons prefix">person</i>
                              <input class="white-text" type="text" name="pilotName" id="pilotName" value="<?php echo Functions::s($player['pilotName']); ?>" maxlength="20" autocomplete="off" required>
                              <label for="pilotName">Pilot Name</label>
                              <span class="helper-text white-text" data-error="Enter a valid pilot name!">Enter your new pilot name.</span>
                            </div>
                            <div class="input-field col s3">
                              <button class="btn grey darken-3 waves-effect waves-light col s12">CHANGE</button>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
           </div>
          </div>
        </div>
      </div>
