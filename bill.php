<?php

require "common/head.php";
require_once("config/database.php");

$message = "";

if (count($_POST) > 0) {
    // print_r($_POST);
    if (isset($_POST['insert'])) {
        $sql = "INSERT INTO live_records (uid ,product_name, product_id , quantity, unit, rate, discount, gross_amount, gstpercent, gst_amount, total_amount) VALUES ('" . $_SESSION["uid"] . "','" . $_POST["productname"] . "','" . $_POST["productid"] . "','" . $_POST["productqty"] . "','" . $_POST["productunit"] . "','" . $_POST["productrate"] . "','" . $_POST["productdis"] . "','" . $_POST["productgamt"] . "','" . $_POST["gst"] . "','" . $_POST["gstamt"] . "','" . $_POST["totalamt"] . "')";
        mysqli_query($conn, $sql);
        $current_id = mysqli_insert_id($conn);
        if (!empty($current_id)) {
            $message = "New Item Added Successfully";
        }
    } else if (isset($_POST['update'])) {

        $sql = "UPDATE live_records SET uid='" . $_SESSION["uid"] . "',product_name='" . $_POST["productname1"] . "',product_id='" . $_POST["productid1"] . "', quantity ='" . $_POST["productqty1"] . "',unit='" . $_POST["productunit1"] . "',rate='" . $_POST["productrate1"] . "', discount ='" . $_POST["productdis1"] . "', gross_amount ='" . $_POST["productgamt1"] . "', gstpercent ='" . $_POST["gst1"] . "', gst_amount ='" . $_POST["gstamt1"] . "', total_amount ='" . $_POST["totalamt1"] . "' WHERE sr_no = '" . $_POST["srno"] . "'";

        if (mysqli_query($conn, $sql)) {
            $message = "Item Updated Successfully";
        }
    }
}

if (isset($_GET['delete'])) {
    $sqld = "DELETE FROM live_records WHERE sr_no='" . $_GET["delete"] . "'";
    mysqli_query($conn, $sqld);
    $message = "Deleted Successfully";

    // if (isset($_GET['update'])) {
    //     $sqlu = 'UPDATE  live_records  SET  product_name =[value-2], product_id =[value-3], quantity =[value-4], unit =[value-5], rate =[value-6], discount =[value-7], gross_amount =[value-8], gstpercent =[value-9], gst_amount =[value-10], total_amount =[value-11] WHERE  sr_no  = [value-1]'
    // }
}

$sqlr = "SELECT * FROM live_records ORDER BY sr_no ASC";
$result = mysqli_query($conn, $sqlr);

// print_r($_SESSION);
?>

<div class="content-wrapper">
    <?php if ($message !== "") { ?>
        <div class="alert alert-success">
            <?php
            echo $message;

            ?>
        </div>
    <?php } ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bill
        </h1>
        <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Create bills</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                Start creating your amazing bills!
            </div>
            <!-- /.box-body -->
            <!-- <div class="box-footer">
                Footer
            </div> -->
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Enter Bill Details</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button> -->
                </div>
            </div>
            <div class="box-body">
                <div class="col-xs-6">
                    <label for="InputInvoiceNo">Invoice No</label>
                    <input type="number" class="form-control" id="InputInvoiceNumber" placeholder="Invoice No">
                </div>
                <div class="col-xs-6">
                    <label>Date:</label>

                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker">
                    </div>
                    <!-- /.input group -->
                </div>
                <div class="col-xs-12">
                    <label>Customer</label>
                    <select class="form-control select2" style="width: 100%;">
                        <?php
                        $sqlcustomer = "SELECT * from party where uid='" . $_SESSION['uid'] . "'";
                        $cust_result = mysqli_query($conn, $sqlcustomer);
                        while ($row = mysqli_fetch_assoc($cust_result)) {
                        ?>
                            <option value="<?= $row['id']; ?>" add="<?= $row['p_address']; ?>" gstin="<?= $row['p_gstin']; ?>"><?= $row['p_name']; ?></option>
                        <?php

                        }

                        ?>

                    </select>
                </div>
                <div class="col-xs-6">
                    <label for="InputInvoiceNo">Order No</label>
                    <input type="number" class="form-control" id="InputInvoiceNumber" placeholder="Order No">
                </div>
                <div class="col-xs-6">
                    <label>Order Date:</label>

                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker1">
                    </div>
                    <!-- /.input group -->
                </div>
                <div class="col-xs-12">
                    <label>Customer Address</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
            </div>
            <!-- /.box-body -->
            <!-- <div class="box-footer">
                Footer
            </div> -->
            <!-- /.box-footer-->
        </div>
        <div class="modal fade" id="recordModal">
            <div class="modal-dialog">

                <form method="post" id="recordForm" action="#">

                    <input type="hidden" value="1" name="insert">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Give Item Description</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Product Name</label>

                                    <select class="form-control select2" id="productname" name="productname" style="width: 100%;" onchange="productDetailsInput(event)">
                                        <?php
                                        $sqlproducts = "SELECT * from products where uid = '" . $_SESSION['uid'] . "'";
                                        $prod_result = mysqli_query($conn, $sqlproducts);
                                        while ($row = mysqli_fetch_assoc($prod_result)) {
                                        ?>
                                            <option value="<?= $row['product_name']; ?>" id="<?= $row['id']; ?>" gst="<?= $row['gst']; ?>" disc="<?= $row['discount']; ?>" unit="<?= $row['unit']; ?>" mrp="<?= $row['mrp']; ?>" rate="<?= $row['rate']; ?>" pur_price="<?= $row['purchase_price']; ?>" hsn="<?= $row['hsn']; ?>" stock="<?= $row['stock']; ?>"><?= $row['product_name']; ?></option>
                                        <?php

                                        }

                                        ?>

                                    </select>
                                </div>

                                <div class="col-xs-6">
                                    <label for="productid">Product Id</label>
                                    <input type="text" class="form-control" id="productid" name="productid" placeholder="Product Id">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <label for="productqty">Quantity</label>
                                    <input type="number" class="form-control" id="productqty" name="productqty" placeholder="Quantity" onchange="calculateEachAmount()">
                                </div>

                                <div class="col-xs-3">
                                    <label>Unit</label>
                                    <input class="form-control" id="productunit" name="productunit" placeholder="Unit">

                                </div>

                                <div class="col-xs-3">
                                    <label for="productrate">Rate</label>
                                    <input type="text" class="form-control" id="productrate" name="productrate" placeholder="Rate" onchange="calculateEachAmount()">
                                </div>

                                <div class="col-xs-3">
                                    <label for="productdis">Discount</label>
                                    <input type="text" class="form-control" id="productdis" name="productdis" placeholder="Discount" onchange="calculateEachAmount()">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label for="productgamt">Gross Amount</label>
                                    <input type="text" class="form-control" id="productgamt" name="productgamt" placeholder="Gross Amount" readonly>
                                </div>

                                <div class="col-xs-4">
                                    <label>Gst %</label>
                                    <select class="form-control select2" id="gst" name="gst" style="width: 100%;" onchange="calculateEachAmount()">
                                        <option selected="selected">0%</option>
                                        <option>5%</option>
                                        <option>12%</option>
                                        <option>18%</option>
                                    </select>
                                </div>

                                <div class="col-xs-4">
                                    <label for="gstamt">Gst Amount</label>
                                    <input type="text" class="form-control" id="gstamt" name="gstamt" placeholder="GST Amount" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <label for="totalamt">Total Amount</label>
                                    <input type="text" class="form-control" id="totalamt" name="totalamt" placeholder="Total Amount" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <input type="submit" name="save" id="save" class="btn btn-info" value="Add">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="editModal">
            <div class="modal-dialog">

                <form method="post" id="recordForm" action="#">
                    <input type="hidden" value="1" name="update">
                    <input type="hidden" value="" name="srno">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Give Item Description</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Product Name</label>
                                    <select class="form-control select2" id="productname1" name="productname1" style="width: 100%;" onchange="productDetailsInputUpdate(event)">
                                        <?php
                                        $sqlproducts1 = "SELECT * from products where uid='" . $_SESSION['uid'] . "'";
                                        $prod1_result = mysqli_query($conn, $sqlproducts1);
                                        while ($row = mysqli_fetch_assoc($prod1_result)) {
                                        ?>
                                            <option value="<?= $row['product_name']; ?>" id="<?= $row['id']; ?>" gst="<?= $row['gst']; ?>" disc="<?= $row['discount']; ?>" unit="<?= $row['unit']; ?>" mrp="<?= $row['mrp']; ?>" rate="<?= $row['rate']; ?>" pur_price="<?= $row['purchase_price']; ?>" hsn="<?= $row['hsn']; ?>" stock="<?= $row['stock']; ?>"><?= $row['product_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-xs-6">
                                    <label for="productid">Product Id</label>
                                    <input type="text" class="form-control" id="productid1" name="productid1" placeholder="Product Id">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <label for="productqty">Quantity</label>
                                    <input type="number" class="form-control" id="productqty1" name="productqty1" placeholder="Quantity" onchange="calculateEachAmountupdate()">
                                </div>

                                <div class="col-xs-3">
                                    <label>Unit</label>
                                    <input class="form-control" id="productunit1" name="productunit1" placeholder="Unit">
                                </div>

                                <div class="col-xs-3">
                                    <label for="productrate">Rate</label>
                                    <input type="text" class="form-control" id="productrate1" name="productrate1" placeholder="Rate" onchange="calculateEachAmountupdate()">
                                </div>

                                <div class="col-xs-3">
                                    <label for="productdis">Discount</label>
                                    <input type="text" class="form-control" id="productdis1" name="productdis1" placeholder="Discount" onchange="calculateEachAmountupdate()">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label for="productgamt">Gross Amount</label>
                                    <input type="text" class="form-control" id="productgamt1" name="productgamt1" placeholder="Gross Amount" readonly>
                                </div>

                                <div class="col-xs-4">
                                    <label>Gst %</label>
                                    <select class="form-control select2" id="gst1" name="gst1" style="width: 100%;" onchange="calculateEachAmountupdate()">
                                        <option value="0%" selected="selected">0%</option>
                                        <option value="5%">5%</option>
                                        <option value="12%">12%</option>
                                        <option value="18%">18%</option>
                                    </select>
                                </div>

                                <div class="col-xs-4">
                                    <label for="gstamt">Gst Amount</label>
                                    <input type="text" class="form-control" id="gstamt1" name="gstamt1" placeholder="GST Amount" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <label for="totalamt">Total Amount</label>
                                    <input type="text" class="form-control" id="totalamt1" name="totalamt1" placeholder="Total Amount" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <input type="submit" name="save" id="save" class="btn btn-info" value="Update">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Enter Bill Items</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button> -->
                </div>
            </div>
            <div class="box-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10">
                                <h3 class="panel-title"></h3>
                            </div>
                            <div class="col-md-2" align="right">
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#recordModal">
                                    Add Product to Invoice
                                </button>
                            </div>
                        </div>
                    </div>
                    <table id="recordListing" class="display">
                        <thead>
                            <tr>
                                <th scope="col">Sr No</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Rate</th>
                                <th scope="col">GST %</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($row = mysqli_fetch_array($result)) {  ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row['product_name']; ?></td>
                                    <td><?= $row['quantity']; ?></td>
                                    <td><?= $row['rate']; ?></td>
                                    <td><?= $row['gstpercent']; ?></td>
                                    <td><?= $row['total_amount']; ?></td>
                                    <td><a href="#editModal" data-toggle="modal" data-srno="<?= $row['sr_no']; ?>" data-pname="<?= $row['product_name']; ?>" data-pid="<?= $row['product_id']; ?>" data-quantity="<?= $row['quantity']; ?>" data-unit="<?= $row['unit']; ?>" data-rate="<?= $row['rate']; ?>" data-discount="<?= $row['discount']; ?>" data-gamt="<?= $row['gross_amount']; ?>" data-gstper="<?= $row['gstpercent']; ?>" data-gst="<?= $row['gst_amount']; ?>" data-tamt="<?= $row['total_amount']; ?>" class="btn btn-primary">Edit</a></td>
                                    <td><a type="button" href="?delete=<?= $row['sr_no']; ?>" class="btn btn-danger">Delete</a></td>
                                </tr>
                            <?php
                                $i++;
                            } ?>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-box-tool" title="Collapse">
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<?php

require "common/foot.php";
?>
<script>
    //Date picker

    $(document).ready(function() {
        $('#datepicker').datepicker({
            autoclose: true
        });
        $('#datepicker1').datepicker({
            autoclose: true
        });





    })

    function productDetailsInput(event) {

        var productHSN = event.target.selectedOptions[0].getAttribute('hsn');
        var discount = event.target.selectedOptions[0].getAttribute('disc');
        var rate = event.target.selectedOptions[0].getAttribute('rate');
        var unit = event.target.selectedOptions[0].getAttribute('unit');
        document.getElementById('productid').value = productHSN;
        document.getElementById('productdis').value = discount;
        document.getElementById('productrate').value = rate;
        document.getElementById('productunit').value = unit;

    }

    function productDetailsInputUpdate(event) {

        var productHSN = event.target.selectedOptions[0].getAttribute('hsn');
        var discount = event.target.selectedOptions[0].getAttribute('disc');
        var rate = event.target.selectedOptions[0].getAttribute('rate');
        var unit = event.target.selectedOptions[0].getAttribute('unit');
        var gst = event.target.selectedOptions[0].getAttribute('gstpercent');
        document.getElementById('productid1').value = productHSN;
        document.getElementById('productdis1').value = discount;
        document.getElementById('productrate1').value = rate;
        document.getElementById('productunit1').value = unit;

    }

    function calculateEachAmount() {
        var productQuantity = document.getElementById('productqty').value;
        var productRate = document.getElementById('productrate').value;
        var prouctDiscount = document.getElementById('productdis').value == null ? 0 : document.getElementById('productdis').value;
        if (productQuantity != '' && productRate != '') {
            var grossAmount = (productQuantity * productRate) - (productQuantity * productRate) * (prouctDiscount / 100);
            document.getElementById('productgamt').value = grossAmount;
        }
        var productGstPercernt = document.getElementById('gst').value;
        if (grossAmount != '') {
            var gstAmount = grossAmount * (productGstPercernt.slice(0, -1) / 100);
            var totalAmount = parseInt(grossAmount) + parseInt(gstAmount);
            document.getElementById('gstamt').value = gstAmount;
            document.getElementById('totalamt').value = totalAmount;
        }
    }

    function calculateEachAmountupdate() {
        var productQuantity = document.getElementById('productqty1').value;
        var productRate = document.getElementById('productrate1').value;
        var prouctDiscount = document.getElementById('productdis1').value == null ? 0 : document.getElementById('productdis1').value;
        if (productQuantity != '' && productRate != '') {
            var grossAmount = (productQuantity * productRate) - (productQuantity * productRate) * (prouctDiscount / 100);
            document.getElementById('productgamt1').value = grossAmount;
        }
        var productGstPercernt = document.getElementById('gst1').value;
        if (grossAmount != '') {
            var gstAmount = grossAmount * (productGstPercernt.slice(0, -1) / 100);
            var totalAmount = parseInt(grossAmount) + parseInt(gstAmount);
            document.getElementById('gstamt1').value = gstAmount;
            document.getElementById('totalamt1').value = totalAmount;
        }
    }

    $('#editModal').on('show.bs.modal', function(e) {

        //get data-id attribute of the clicked element
        var srno = $(e.relatedTarget).data('srno');

        var pname = $(e.relatedTarget).data('pname');
        console.log(pname)
        console.log(e.relatedTarget)
        var pid = $(e.relatedTarget).data('pid');
        var quantity = $(e.relatedTarget).data('quantity');
        var unit = $(e.relatedTarget).data('unit');
        var rate = $(e.relatedTarget).data('rate');
        var discount = $(e.relatedTarget).data('discount');
        var gamt = $(e.relatedTarget).data('gamt');
        var gstper = $(e.relatedTarget).data('gstper');
        var gst = $(e.relatedTarget).data('gst');
        var tamt = $(e.relatedTarget).data('tamt');


        // populate the textbox
        $(e.currentTarget).find('input[name="srno"]').val(srno);
        $(e.currentTarget).find('#productname1').val(pname);
        $(e.currentTarget).find('input[name="productid1"]').val(pid);
        $(e.currentTarget).find('input[name="productqty1"]').val(quantity);
        $(e.currentTarget).find('input[name="productunit1"]').val(unit);
        $(e.currentTarget).find('input[name="productrate1"]').val(rate);
        $(e.currentTarget).find('input[name="productdis1"]').val(discount);
        $(e.currentTarget).find('input[name="productgamt1"]').val(gamt);
        $(e.currentTarget).find('#gst1').val(gstper);
        $(e.currentTarget).find('input[name="gstamt1"]').val(gst);
        $(e.currentTarget).find('input[name="totalamt1"]').val(tamt);
    });





    $(document).ready(function() {
        $('#recordListing').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>