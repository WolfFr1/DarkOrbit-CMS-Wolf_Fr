<?php
$playerRankId = $player['rankId'];
if ($playerRankId != 21) {
    echo '<script>window.location.href = "' . DOMAIN . 'notallowed";</script>';
    exit;
}
?>

<div id="main">
        <div class="container">
          <div class="row">
            <div class="col s12">
              <div class="card white-text grey darken-4 padding-15 center">
              <h4 style="color: orange;">⚠️ WELCOME ON ADMIN PANEL ⚠️</h4>
                <p style="color: white;">ADMIN PERMISSION ACTIVATED</p>
                <!DOCTYPE html>
<html>
<body>
    <h3>Add Uridium</h3>
    <label for="userId">User ID:</label>
    <input type="text" id="userId" name="userId">
    <button id="addUridiumButton">Add 50000 Uridium</button>

    <script>
        const addUridiumButton = document.getElementById("addUridiumButton");

        addUridiumButton.addEventListener("click", () => {
            const userId = document.getElementById("userId").value;

            // Send a request to add 50000 uridium to the user with the specified ID
            // You can replace this with your actual API call or backend endpoint
            fetch(`/add-uridium.php?userId=${userId}`)
                .then(response => response.json())
                .then(data => {
                    alert(`Uridium added: ${data.uridiumAdded}`);
                })
                .catch(error => {
                    console.error("Error:", error);
                });
        });
    </script>
</body>
</html>

              </div>
           </div>
          </div>
        </div>
      </div>
