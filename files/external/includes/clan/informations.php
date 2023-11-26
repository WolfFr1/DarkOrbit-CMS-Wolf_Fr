<ul class="button-container">
  <li><a class="horizontal-button" href="<?php echo DOMAIN; ?>clan">Informations</a></li>
  <li><a class="horizontal-button" href="<?php echo DOMAIN; ?>clan/members">Members</a></li>
  <li><a class="horizontal-button" href="<?php echo DOMAIN; ?>clan/diplomacy">Diplomacy</a></li>
</ul>
<div class="card white-text grey darken-4 padding-15">
<h4 style="color: orange;">Clan Informations</h4>

  <div class="row">
    <div class="col s12">
      <p>Tag/Clan name: [<?php echo $clan['tag']; ?>] <?php echo $clan['name']; ?></p>
      <p>Founding date: <?php echo date('Y.m.d', strtotime($clan['date'])); ?></p>
      <p>Clan leader: <?php echo $mysqli->query('SELECT pilotName FROM player_accounts where userId = '.$clan['leaderId'].'')->fetch_assoc()['pilotName']; ?></p>
      <p>Number of members: <?php echo count($mysqli->query('SELECT userId FROM player_accounts WHERE clanId = '.$clan['id'].'')->fetch_all(MYSQLI_ASSOC)); ?></p>
      <p>Clan rank: <?php echo $clan['rank']; ?></p>
      <p>Company affiliation: <?php echo ($clan['factionId'] == 0 ? 'All' : ($clan['factionId'] == 1 ? 'MMO' : ($clan['factionId'] == 2 ? 'EIC' : 'VRU'))); ?></p>
      <p>Recruiting Status: <?php echo ($clan['recruiting'] ? 'Recruiting' : 'Closed'); ?></p>
    </div>
  </div>
</div>

<style>
/* Style for the button container */
.button-container {
  display: flex;
  justify-content: flex-start; /* Align buttons to the left */
  margin-top: 20px;
  list-style: none; /* Remove default list bullet points */
  padding-left: 0; /* Remove default padding for list */
}

/* Style for the horizontal buttons */
.button-container li {
  margin-right: 5px; /* Add spacing between buttons */
}

.button-container a.horizontal-button {
  text-decoration: none;
  background-color: #4285f4;
  color: white;
  padding: 10px 20px;
  border-radius: 4px;
}

.button-container a.horizontal-button:hover {
  background-color: #3367d6;
}

</style>