<?php
require_once './functions.php';
$orderId = createOrder();
$cartItem = getCartItem();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="row">
                            <div class="col-xs-6">
                                <h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
                            </div>
                            <div class="col-xs-6">
                                <a href="index.php" class="btn btn-primary btn-sm btn-block">
                                    <span class="glyphicon glyphicon-share-alt"></span> Continue shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <?php foreach ($cartItem as $item) : ?>
                        <div class="row">
                            <div class="col-xs-2"><img class="img-responsive" src="http://placehold.it/100x70">
                            </div>
                            <div class="col-xs-4">
                                <h4 class="product-name"><strong><?php echo $item['title'] ?></strong></h4><h4><small>Product
                                        description</small></h4>
                            </div>
                            <div class="col-xs-6">
                                <div class="col-xs-6 text-right">
                                    <h6><strong><?php echo $item['cost'] ?> <span class="text-muted">x</span></strong>
                                    </h6>
                                </div>
                                <div class="col-xs-4">
                                    <input type="text" class="form-control input-sm"
                                           value="<?php echo $item['count'] ?>">
                                </div>
                                <div class="col-xs-2">
                                    <button type="button" class="btn btn-link btn-xs">
                                        <span class="glyphicon glyphicon-trash"> </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach; ?>

                    <div class="row">
                        <div class="text-center">
                            <div class="col-xs-9">
                                <h6 class="text-right">Added items?</h6>
                            </div>
                            <div class="col-xs-3">
                                <button type="button" class="btn btn-default btn-sm btn-block">
                                    Update cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (!empty($cartItem)) : ?>
                    <div class="panel-footer">
                        <div class="row text-center">
                            <div class="col-xs-9">
                                <h4 class="text-right">Total ₴ <strong><?php echo getOrderTotal() ?></strong></h4>
                            </div>
                            <div class="col-xs-3">
                                <!--                            <form method="post" >-->
                                <!--                                <input type="hidden" name="test">-->
                                <!--                                <button type="submit" class="btn btn-success btn-block">-->
                                <!--                                    Checkout-->
                                <!--                                </button>-->
                                <!--                            </form>-->
                                <form method="POST" accept-charset="utf-8" action="https://www.liqpay.ua/api/3/checkout">
                                    <input type="hidden" name="data" value="<?php echo getData($orderId); ?>" />
                                    <input type="hidden" name="signature" value="<?php echo getSignature($orderId); ?>" />
                                    <button style="border: none !important; display:inline-block !important;text-align: center !important;padding: 7px 20px !important;
		color: #fff !important; font-size:16px !important; font-weight: 600 !important; font-family:OpenSans, sans-serif; cursor: pointer !important; border-radius: 2px !important;
		background: rgb(122,183,43) !important;"onmouseover="this.style.opacity='0.5';" onmouseout="this.style.opacity='1';">
                                        <img src="https://static.liqpay.ua/buttons/logo-small.png" name="btn_text"
                                             style="margin-right: 7px !important; vertical-align: middle !important;"/>
                                        <span style="vertical-align:middle; !important">Оплатить <?php echo getOrderTotal() ?></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>