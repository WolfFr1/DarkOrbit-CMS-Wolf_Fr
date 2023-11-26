<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Wolf_Fr</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?php echo DOMAIN; ?>css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="<?php echo DOMAIN; ?>css/style.css"/>
    <?php if (Functions::IsLoggedIn() && ((isset($page[0]) && $page[0] === 'company_select') || (isset($page[0]) && $page[0] === 'clan' && isset($page[1]) && $page[1] === 'company'))) { ?>
    <link type="text/css" rel="stylesheet" href="<?php echo DOMAIN; ?>css/company-select.css"/>
    <?php } ?>
    <?php if (Functions::IsLoggedIn() && (isset($page[0]) && $page[0] === 'skill_tree')) { ?>
    <link type="text/css" rel="stylesheet" href="<?php echo DOMAIN; ?>css/skill-tree.css"/>
    <?php } ?>
    <?php if (Functions::IsLoggedIn() && (isset($page[0]) && $page[0] === 'ships')) { ?>
    <link type="text/css" rel="stylesheet" href="<?php echo DOMAIN; ?>css/ships.css"/>
    <?php } ?>
  </head>
  <?php $player = Functions::GetPlayer();

$factionId = $player["factionId"];

 ?>

  <div id="app">

      <?php if (Functions::IsLoggedIn()) { ?>
      <ul id="dropdown1" class="dropdown-content">
        <li><a href="<?php echo DOMAIN; ?>ships">Ships</a></li>
        <li><a href="<?php echo DOMAIN; ?>equipment">Equipment</a></li>
        <li><a href="<?php echo DOMAIN; ?>skill-tree">Skill Tree</a></li>
      </ul>
      <ul id="dropdown2" class="dropdown-content">

        <?php if ($player['clanId'] <= 0) { ?>
        <li><a href="<?php echo DOMAIN; ?>clan/join">Join</a></li>
        <li><a href="<?php echo DOMAIN; ?>clan/found">Found</a></li>

        <?php } else { ?>
        <li><a href="<?php echo DOMAIN; ?>clan/informations">Informations</a></li>
        <li><a href="<?php echo DOMAIN; ?>clan/members">Members</a></li>
        <li><a href="<?php echo DOMAIN; ?>clan/diplomacy">Diplomacy</a></li>
        <?php }?>

        <li><a href="<?php echo DOMAIN; ?>clan/company">Company</a></li>
      </ul>
      <?php } ?>

      <!DOCTYPE html>
<html>
<head>
<style>
  /* Style the menu container */
  .vertical-menu {
    position: absolute;
    top: 0;
    left: 0;
    width: 150px;
    background-color: #f2f2f2;
  }

  /* Style the menu buttons */
  .vertical-menu a {
    padding: 12px;
    color: white;
    display: block;
    transition: background-color 0.3s;
  }

  /* Change the button background color on hover */
  .vertical-menu a:hover {
    background-color: #ddd;
  }
</style>
</head>
<body>
<?php if (Functions::IsLoggedIn()) { ?>
<div class="vertical-menu">
<li class="green darken-3"><a href="<?php echo DOMAIN; ?>map-revolution" target="_blank">Start</a></li>
<li class="grey darken-4"><a href="<?php echo DOMAIN; ?>home">Home</a></li>
<li class="grey darken-4"><a href="<?php echo DOMAIN; ?>ships">Ship</a></li>
<li class="grey darken-4"><a href="<?php echo DOMAIN; ?>equipment">Equipment</a></li>
<li class="grey darken-4"><a href="<?php echo DOMAIN; ?>shop">Shop</a></li>
<li class="grey darken-4"><a href="<?php echo DOMAIN; ?>clan/join">Clan</a></li>
<li class="grey darken-4"><a href="<?php echo DOMAIN; ?>settings">Settings</a></li>
<?php
$playerRankId = $player['rankId'];
?>
<?php if ($playerRankId == 21): ?>
  <li class="grey darken-4"><a href="<?php echo DOMAIN; ?>adminpanel">Admin</a></li>
    </a>
<?php endif; ?>
<li class="grey darken-4"><a href="/api/logout">Logout</a></li>

</div>
</body>
</html>
<?php } ?>
<style>
.container {
  padding: 50px;
  }
  </style>
<!DOCTYPE html>
<html>
<head>
    <script>
        window.onload = function() {
            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });
        }
    </script>
</head>
<body>
    <!-- Your website content here -->
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Your Website</title>
    <style>
        body {
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
    </style>
</head>
<body>
    <!-- Your website content here -->
</body>
</html>

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
<?php if (Functions::IsLoggedIn()) { ?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .currency {
            position: fixed;
            top: 0;
            right: 0;
            color: white; /* Set the text color to white */
        }
    </style>
</head>
<body>
    <div class="currency">
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
        </div>
    </div>
</body>
</html>
<?php } ?>