      <div id="main">
        <div class="container">
          <div class="row">
            <?php require_once(INCLUDES . 'data.php'); ?>

            <div class="col s12">
              <div class="card white-text grey darken-4">
              <h4 style="color: orange;">Player Stats</h4>
                <div class="row">
                  <div class="col s6">
                    <div class="padding-10">
                      <img src="/img/avatar.png">
                      <div class="inline-right">
                        <h6><?php echo $player['pilotName']; ?></h6>
                        <p>Clan: <?php echo ($player['clanId'] == 0 ? 'Free Agent' : $mysqli->query('SELECT name FROM server_clans WHERE id = '.$player['clanId'].'')->fetch_assoc()['name']);?></p>
                        <p>Rank: <img src="<?php echo DOMAIN; ?>img/ranks/rank_<?php echo $player['rankId']; ?>.png"> <?php echo Functions::GetRankName($player['rankId']); ?></p>
                        <p>ID: <?php echo $player['userId']; ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col s6">
                    <div class="padding-15">
                      <p>Level: <?php echo Functions::GetLevel($data->experience); ?></p>
                      <p>Company: <img src="/img/companies/logo_<?php echo($player['factionId'] == 1 ? 'mmo' : ($player['factionId'] == 2 ? 'eic' : 'vru')); ?>.png"></p>
                      <div class="ships">
                        <?php
    $currentShipId = $player['shipId'];
    $currentShip = $mysqli->query('SELECT * FROM server_ships WHERE shipID = '.$currentShipId)->fetch_assoc();
    
    if ($currentShip) {
        $lootId = str_replace('_', '/', $currentShip['lootID']);
    ?>
    <div id="<?php echo $currentShip['lootID']; ?>" class="ship active">
    Current ship:     <img src="<?php echo DOMAIN; ?>do_img/global/items/<?php echo $lootId; ?>_63x63.png">
    </div>
    <?php } ?>
</div><!--
            <div class="col s8">
              <div class="card white-text grey darken-4 center">
                <div class="padding-15">
                  <h5 >Player Stats</h5>
                  <div class="align-left" style="text-align: left;">Currency</div>
                  <ul class="tabs grey darken-3">
                  <div class="col s3">
                       E.C <span id="jackpot"><?php echo number_format($data->jackpot, 0, ',', '.'); ?></span>
                     </div>
                     <div class="col s3">
                       Uridium: <span id="uridium"><?php echo number_format($data->uridium, 0, ',', '.'); ?></span>
                     </div>
                     <div class="col s3">
                       Credits: <span id="credits"><?php echo number_format($data->credits, 0, ',', '.'); ?></span>
                     </div>
                     <div class="col s3">
                       Honor: <span><?php echo number_format($data->honor, 0, ',', '.'); ?></span>
                   </ul>
                   <div class="align-left" style="text-align: left;">Equipment</div>
                                 <ul class="tabs grey darken-3">
                                 <div class="col s3">
                       E.C <span id="jackpot"><?php echo number_format($data->jackpot, 0, ',', '.'); ?></span>
                     </div>
                     <div class="col s3">
                       LF4 <span id="lf4Count"><?php echo number_format($items->lf4Count, 0, ',', '.'); ?></span>
                     </div>
                     <div class="col s3">
                       Credits: <span id="credits"><?php echo number_format($data->credits, 0, ',', '.'); ?></span>
                     </div>
                     <div class="col s3">
                       Honor: <span><?php echo number_format($data->honor, 0, ',', '.'); ?></span>
                   </ul> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
