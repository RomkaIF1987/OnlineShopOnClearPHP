<?php require_once 'partials/header.php' ?>

<!-- Begin page content -->

<div id="shopping-cart">
    <div class="txt-heading"><span>Shopping Cart</span></div>
    <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
    <?php
    if (isset($_SESSION["cart_item"])) :
    $total_quantity = 0;
    $total_price = 0;
    ?>
    <table class="tbl-cart" cellpadding="10" cellspacing="1">
        <tbody>
        <tr>
            <th style="text-align:left;" width="10%">Name</th>
            <th style="text-align:left;" width="5%">Unit</th>
            <th style="text-align:right;" width="5%">Quantity</th>
            <th style="text-align:right;" width="10%">Unit Price</th>
            <th style="text-align:right;" width="10%">Price</th>
            <th style="text-align:center;" width="5%">Remove</th>
        </tr>
        <?php
        foreach ($_SESSION["cart_item"] as $item) {
            $item_price = $item["quantity"] * $item["price"];
            ?>
            <tr>
                <td><img src="/images/<?php echo $item["image"]; ?>"
                         class="cart-item-image"/><?php echo $item["name"]; ?>
                </td>
                <td><?php echo $item["unit"]; ?></td>
                <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                <td style="text-align:right;"><?php echo "$ " . $item["price"]; ?></td>
                <td style="text-align:right;"><?php echo "$ " . number_format($item_price, 2); ?></td>
                <td style="text-align:center;"><a href="cartConfirm.php?action=remove&code=<?= $item["code"] ?>"
                                                  class="btnRemoveAction"><img src="images/icon-delete.png"
                                                                               alt="Remove Item"/></a></td>
            </tr>
            <?php
            $total_quantity += $item["quantity"];
            $total_price += ($item["price"] * $item["quantity"]);
        }
        ?>
        <tr class="border-top">
            <td colspan="2" align="right"><strong>Total: </strong></td>
            <td align="right"><strong><?php echo $total_quantity; ?></strong></td>
            <td align="right" colspan="2"><strong><?php echo "$ " . number_format($total_price, 2); ?></strong>
            </td>
            <td></td>
        </tbody>
    </table>
</div>
    <div id="shopping-cart">
        <form method="post" action="/orderConfirm.php">
            <div class="txt-heading"><span>Delivery method</span></div>
            <table class="tbl-cart" cellpadding="10" cellspacing="1">
                <thead>
                <tr class="mt-2">
                    <th style="text-align:left;" width="30%">Choose your delivery</th>
                    <th></th>
                    <th></th>
                    <th style="text-align:left;" width="20%">Account balance</th>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input prc" type="radio" name="delivery" id="Radios1" value="0"
                                   required>
                            <label class="form-check-label" for="exampleRadios1">
                                Pick UP (USD 0)
                            </label>
                        </div>
                    </td>
                    <td class="text-left">Product price: <br> Delivery: <br> <strong>Total price: </strong></td>
                    <td><?= "$ " . number_format($total_price, 2); ?> <br> $ 0 <br>
                        <?= "$ " . number_format($total_price, 2); ?> </td>
                    <td class="text-left">Account: <br> Spent: <br> <strong>Balance: </strong></td>
                    <td> <?= "  $ " . $_SESSION['user_account'] ?> <br> <?= "-$ " . number_format($total_price, 2); ?>
                        <br>
                        <?= "  $ " . (number_format($_SESSION['user_account'], 2) - number_format($total_price, 2)); ?>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input prc" type="radio" name="delivery" id="watch-me" value="5"
                                   required>
                            <label class="form-check-label" for="exampleRadios2">
                                UPS (USD 5)
                            </label>
                        </div>
                    </td>
                    <td class="text-left">Product price: <br> Delivery: <br> <strong>Total price: </strong></td>
                    <td><?= "$ " . number_format($total_price, 2); ?> <br> $ 5 <br>
                        <?= "$ " . (number_format($total_price, 2) + 5); ?> </td>
                    <td class="text-left">Account: <br> Spent: <br> <strong>Balance: </strong></td>
                    <td> <?= "  $ " . $_SESSION['user_account'] ?> <br>
                        <?= "-$ " . (number_format($total_price, 2) + 5); ?> <br>
                        <?= "  $ " . (number_format($_SESSION['user_account'], 2) - number_format($total_price, 2) - 5); ?>
                    </td>
                    <td><input type="hidden" name="sum" value="<?= $total_price ?>"></td>
                </tr>
                </thead>
            </table>
            <button type="submit" id="btnAccept">Accept</button>
            <a id="btnHome" href="index.php">Back to Shop</a>
        </form>
</div>
<?php else : ?>
    <div class="no-records">Your Cart is Empty
        <a id="btnHome" href="index.php">Back to Shop</a>
    </div>
<?php endif; ?>
<?php require_once 'partials/footer.php' ?>
