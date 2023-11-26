<div id="main">
        <div class="container">
          <div class="row">
            <div class="col s12">
              <?php
              $page_ = INCLUDES . 'clan/join.php';

              if (isset($page[1])) {
                if (($page[1] == 'join' || $page[1] == 'found') && $player['clanId'] > 0) {
                  $page[1] = 'informations';
                } else if (($page[1] == 'informations' || $page[1] == 'members' || $page[1] == 'diplomacy') && $player['clanId'] <= 0) {
                  $page[1] = 'join';
                }

                $page_ = INCLUDES . 'clan/' . $page[1] . '.php';
              } else if ($player['clanId'] > 0) {
                $page_ = INCLUDES . 'clan/informations.php';
              }

              if (!file_exists($page_)) {
                $page_ = EXTERNALS . 'error.php';
              }

              require_once($page_);
              ?>
           </div>
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