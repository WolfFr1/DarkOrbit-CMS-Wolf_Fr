      <div id="main">
        <div class="container">
            <div class="col s12">
              <div class="center">
                <div class="ships">
                  <?php
                  $equipment = $mysqli->query('SELECT * FROM player_equipment WHERE userId = '.$player['userId'].'')->fetch_assoc();
                  $ships = json_decode($equipment['items'])->ships;
                  array_push($ships, 8);
                  array_push($ships, 10);

                  foreach ($ships as $shipId) {
                    $ship = $mysqli->query('SELECT * FROM server_ships WHERE shipID = '.$shipId.'')->fetch_assoc();
                    $currentShip = $mysqli->query('SELECT * FROM server_ships WHERE shipID = '.$player['shipId'].'')->fetch_assoc();
                    $lootId = $currentShip['baseShipId'] != $shipId ? $ship['lootID'] : ($player['shipId'] == 153 ? 'ship_goliath_design_razer' : $currentShip['lootID']);
                    $lootId = str_replace('_', '/', $lootId);
                  ?>
                  <div id="<?php echo $ship['lootID']; ?>" class="ship<?php echo $currentShip['baseShipId'] == $shipId ? ' active' : ''; ?>">
                    <img src="<?php echo DOMAIN; ?>do_img/global/items/<?php echo $lootId; ?>_top.png">
                  </div>
                  <?php } ?>
                </div>

              </div>
           </div>
          </div>
        </div>
      </div>

      <style>
  /* Style the menu container */
  .container {
    position: absolute;
    top: 15px; /* Adjust this value as needed */
    left: 34%; /* Adjust this value as needed */
  }
  body {
  overflow: hidden;
}
</style>
