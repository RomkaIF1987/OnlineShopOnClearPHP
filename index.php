<?php require_once 'partials/header.php' ?>
<div id="product-grid">
    <div class="txt-heading">Products</div>
    <?php
    $product_array = $db_handle->runQuery("SELECT * FROM product ORDER BY code ASC");
    if (!empty($product_array)) :
        foreach ($product_array as $key => $value) :
            ?>
            <div class="product-item">
                <form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"] ?>">
                    <div class="product-image"><img height="100%" style="display: block;
  margin-left: auto;
  margin-right: auto;" src="/images/<?php echo $product_array[$key]["image"]; ?>"></div>
                    <div class="product-tile-footer">
                        <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
                        <div class="product-title"><?php echo "$" . $product_array[$key]["price"]; ?>
                            / <?= $product_array[$key]["unit"] ?></div>
                        <?php if (empty($_SESSION["login_user"])) : ?>
                            <div class="cart-action"><input type="text" class="product-quantity" name="quantity"
                                                            value="1"
                                                            size="2"/><a type="submit" href="login.php"
                                                                         class="btnAddAction">Add to Cart</a></div>
                        <?php else : ?>
                            <div class="cart-action"><input type="text" class="product-quantity" name="quantity"
                                                            value="1"
                                                            size="2"/><input type="submit" value="Add to Cart"
                                                                             class="btnAddAction"/></div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        <?php
        endforeach;
    endif;
    ?>
</div>

<?php require_once 'partials/footer.php' ?>
