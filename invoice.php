<?php

require "common/head.php";
require_once "config/Database.php";

$sqlInvoice = "SELECT * FROM live_records ORDER BY sr_no ASC";
$result = mysqli_query($conn, $sqlInvoice);


?>



<div class="content-wrapper" style="min-height: 901px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Invoice
            <!-- <small>''''custom input''''''</small> -->
        </h1>
        <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Invoice</li>
        </ol> -->
    </section>

    <div class="pad margin no-print">
        <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
        </div>
    </div>

    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> Your store name
                    <small class="pull-right">Date: 2/10/2020</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong>Premji Velji</strong><br>
                    SHOP NO.2,MAZGAON TOWER,<br>
                    MATHARPAKHADI ROAD, MAZGAON <br>
                    022-23739561 <br>
                    Email: info@premjivelji.com
                    
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong>ESIS HOSPITAL</strong><br>
                    
                    LBS Marg,<br>
                    Veena Nagar Mulund (W) Mumbai-400080<br>
                    Phone: 9324423233<br>
                    Email: email@email.com
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice 6</b><br>
                <br>
                <b>Order ID:</b> 4F3S8J<br>
                <b>Payment Due:</b> 2/22/2021<br>
                <b>Account:</b> 968-34567
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sr_No</th>
                            <th>Product</th>
                            <th>HSN</th>
                            <th>Qty</th>
                            <th>Unit</th>
                            <th>Rate</th>
                            <th>Disc</th>
                            <th>Gross Amount</th>
                            <th>Gst per</th>
                            <th>Gst</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        $GST = 0;
                        $sub = 0;
                        $i = 1;
                        while ($row = mysqli_fetch_array($result)) { 
                            $total += $row['total_amount']?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row['product_name'] ?></td>
                                <td><?= $row['product_id'] ?></td>
                                <td><?= $row['quantity'] ?></td>
                                <td><?= $row['unit'] ?></td>
                                <td><?= $row['rate'] ?></td>
                                <td><?= $row['discount'] ?></td>
                                <td><?= $row['gross_amount'] ?></td>
                                <td><?= $row['gstpercent'] ?></td>
                                <td><?= $row['gst_amount'] ?></td>
                                <td><?= $row['total_amount'] ?></td>
                            </tr>
                        <?php
                            $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">Payment Methods:</p>
                <img src="dist/img/credit/visa.png" alt="Visa">
                <img src="dist/img/credit/mastercard.png" alt="Mastercard">
                <img src="dist/img/credit/american-express.png" alt="American Express">
                <img src="dist/img/credit/paypal2.png" alt="Paypal">

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <!-- <p class="lead">Amount Due 2/22/2014</p> -->

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>524532</td>
                            </tr>
                            <tr>
                                <th>Tax </th>
                                <td>23423</td>
                            </tr>
                            <!-- <tr>
                                <th>Shipping:</th>
                                <td>$5.80</td>
                            </tr> -->
                            <tr>
                                <th>Total:</th>
                                <td>632443</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
                </button>
                <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generate PDF
                </button>
            </div>
        </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
</div>








<?php
require 'common\foot.php';
?>