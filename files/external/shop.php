<div id="main">
  <div class="container" style="justify-content: center; align-items: center; height: 100vh;">
    <div class="row">
      <div class="col s12">
        <div class="card white-text grey darken-4 padding-15 center">
          <h4 style="color: orange;">Shop</h4>
          
<?php $shop = Functions::GetShop(); ?>
                <ul class="tabs grey darken-3 tabs-fixed-width tab-demo z-depth-1">
                <?php foreach ($shop['categories'] as $value) { ?>
                  <li class="tab"><a href="#<?php echo $value; ?>"><?php echo $value; ?></a></li>
                <?php } ?>
                </ul>

                <?php foreach ($shop['categories'] as $value) { ?>
                  <div id="<?php echo $value; ?>">
                    <div class="row">
                      <?php foreach ($shop['items'] as $value2) { if ($value2['category'] == $value && $value2['active']) { ?>
                      <div class="col m3 s2">
                        <div id="item-<?php echo $value2['id']; ?>" class="card grey darken-3">
                          <div class="card-image">
                            <img src="<?php echo DOMAIN; ?><?php echo $value2['image']; ?>">
                            <?php if ($value2['amount']) { ?>
                            <div style="overflow: hidden;font-size: 10px;font-family: Verdana, Arial, sans-serif;position: absolute;margin: auto;left: 0;right: 0;bottom: 5px;"><?php echo number_format($value2['price'], 0, '.', '.'); ?> <?php echo ($value2['priceType'] == 'uridium' ? 'U' : 'C'); ?>.</div>
                            <?php } ?>
                          </div>
                          <div class="card-content">
                            <span class="card-title"><?php echo $value2['name']; ?></span>
                            <p><span class="price"><?php echo number_format($value2['price'], 0, '.', '.'); ?></span> <?php echo ($value2['priceType'] == 'uridium' ? 'U' : 'C'); ?>.</p>
                            <?php if ($value2['amount']) { ?>
                            <div class="input-field">
                              <input type="hidden" name="price" value="<?php echo $value2['price']; ?>">
                              <input class="white-text" type="number" name="amount" id="amount-<?php echo $value2['id']; ?>" min="1" value="1">
                              <label for="amount-<?php echo $value2['id']; ?>">Amount</label>
                            </div>
                            <?php } ?>
                          </div>
                          <div class="card-action">
                            <div class="row">
                              <a href="#modal" data-item-id="<?php echo $value2['id']; ?>" class="buy btn grey darken-1 col s12 modal-trigger">BUY</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } } ?>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>

            </div>
          <div id="modal" class="modal grey darken-4 white-text">
            <div class="modal-content">
            <div class="col 2">
              <p>Do you really want to buy %item_name% for %item_price%?</p>
            </div>
            <div class="modal-footer grey darken-4">
            <a id="cancel-buy" class="btn image-button" style="background-image: url('img/error_icon.png')"></a>
            <a id="confirm-buy" class="btn image-button" style="background-image: url('img/success_icon.png')"></a>
            </div>
          </div>
        </div>
      </div>
      <style>
        .image-button {
  display: inline-block;
  padding: 10px 20px; /* Adjust as needed */
  border: none;
  background-color: transparent;
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center;
  cursor: pointer;
  text-align: center;
  color: transparent; /* Hide text */
  text-shadow: none; /* Hide text shadow */
}
</style>