<?php
require "common/head.php";
require_once "config/Database.php";



$message = "";
if (count($_POST) > 0) {
    // print_r($_POST);
    if (isset($_POST['insert'])) {
        $sql = "INSERT INTO products (uid, product_name, gst, discount, unit, mrp, rate, purchase_price, hsn, stock) VALUES ('" . $_SESSION["uid"] . "','" . $_POST["productname"] . "','" . $_POST["gst"] . "','" . $_POST["productdis"] . "','" . $_POST["productunit"] . "','" . $_POST["productmrp"] . "','" . $_POST["productrate"] . "','" . $_POST["productpurpri"] . "','" . $_POST["productid"] . "','" . $_POST["productstock"] . "')";
        mysqli_query($conn, $sql);
        $current_id = mysqli_insert_id($conn);
        if (!empty($current_id)) {
            $message = "New Item Added Successfully";
        }
}
}

if (isset($_GET['delete'])) {
    $sqld = "DELETE FROM products WHERE product_name='" . $_GET["delete"] . "'";
    mysqli_query($conn, $sqld);
    $message = "Deleted Successfully";
}
$sqlInventory = "SELECT * FROM products";
$result = mysqli_query($conn, $sqlInventory);
?>


;
<div class="content-wrapper">
    <?php if ($message !== "") { ?>
        <div class="alert alert-success">
            <?php
            echo $message;

            ?>
        </div>
    <?php } ?>
    <section class="content-header">
        <h1>
            Inventory Manager
        </h1>
    </section>
    <section class="content">
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
                                    Add Product to Inventory 
                                </button>
                            </div>
                        </div>
                    </div>
                    <table id="recordListing" class="display">
                        <thead>
                            <tr>
                                <th scope="col">Sr No</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">gst</th>
                                <th scope="col">discount</th>
                                <th scope="col">unit</th>
                                <th scope="col">mrp</th>
                                <th scope="col">rate</th>
                                <th scope="col">purchase price</th>
                                <th scope="col">hsn</th>
                                <th scope="col">stock</th>
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
                                    <td><?= $row['gst']; ?></td>
                                    <td><?= $row['discount']; ?></td>
                                    <td><?= $row['unit']; ?></td>
                                    <td><?= $row['mrp']; ?></td>
                                    <td><?= $row['rate']; ?></td>
                                    <td><?= $row['purchase_price']; ?></td>
                                    <td><?= $row['hsn']; ?></td>
                                    <td><?= $row['stock']; ?></td>
                                    <td><a href="#editModal" data-toggle="modal" data-srno="<?= $row['sr_no']; ?>" 
                                                                                data-pname="<?= $row['product_name']; ?>" 
                                                                                data-pid="<?= $row['hsn']; ?>" 
                                                                                data-pgst="<?= $row['productgst']; ?>" 
                                                                                data-unit="<?= $row['unit']; ?>" 
                                                                                data-rate="<?= $row['rate']; ?>" 
                                                                                data-discount="<?= $row['discount']; ?>" 
                                                                                data-mrp="<?= $row['mrp']; ?>" 
                                                                                data-purpri="<?= $row['purchase_price']; ?>" 
                                                                                data-stock="<?= $row['stock']; ?>" 
                                                                                class="btn btn-primary">Edit</a></td>
                                    <td><a type="button" href="?delete=<?= $row['product_name']; ?>" class="btn btn-danger">Delete</a></td>
                                </tr>
                            <?php
                                $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
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
                                        <input type="text" class="form-control" id="productname" name="productname" placeholder="Product Name"style="width: 100%;" onchange="">
                                        <!-- TODO : add the function to check if the product already exists -->  
                                    </div>

                                    <div class="col-xs-6">
                                        <label for="productid">Product Id/ HSN</label>
                                        <input type="text" class="form-control" id="productid" name="productid" placeholder="Product Id">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <label for="productpurpri">Purchase Price</label>
                                        <input type="text" class="form-control" id="productpurpri" name="productpurpri" placeholder="Purchase Price">
                                    </div>
    
                                    <div class="col-xs-3">
                                        <label for="productmrp">MRP</label>
                                        <input type="text" class="form-control" id="productmrp" name="productmrp" placeholder="MRP">
                                    </div>

                                    <div class="col-xs-3">
                                        <label for="productrate">Rate</label>
                                        <input type="text" class="form-control" id="productrate" name="productrate" placeholder="Rate">
                                    </div>

                                    <div class="col-xs-3">
                                        <label>Unit</label>
                                        <input class="form-control" id="productunit" name="productunit" placeholder="Unit">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <label for="productdis">Discount</label>
                                        <input type="number" class="form-control" id="productdis" name="productdis" placeholder="Discount" >
                                    </div>

                                    <div class="col-xs-4">
                                        <label>Gst</label>
                                        <select class="form-control select2" id="gst" name="gst" style="width: 100%;" >
                                            <option selected="selected">0</option>
                                            <option>0.05</option>
                                            <option>0.12</option>
                                            <option>0.18</option>
                                        </select>
                                    </div>

                                    <div class="col-xs-4">
                                        <label for="productstock">Stock</label>
                                        <input type="number" class="form-control" id="productstock" name="productstock" placeholder="Stock" >
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">

                                <input type="submit" name="save" id="save" class="btn btn-info" value="Add">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>    
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->

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
                                    <input type="text" class="form-control" id="productname1" name="productname1" placeholder="Product Name"style="width: 100%;" onchange="">
                                </div>
                        
                                <div class="col-xs-6">
                                    <label for="productid1">Product Id/HSN</label>
                                    <input type="text" class="form-control" id="productid1" name="productid1" placeholder="Product Id">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <label for="productpurpri1">Purchase Price</label>
                                    <input type="number" class="form-control" id="productpurpri1" name="productpurpri1" placeholder="Quantity" >
                                </div>

                                <div class="col-xs-3">
                                    <label for="productmrp1">MRP</label>
                                    <input type="number" class="form-control" id="productmrp1" name="productmrp1" placeholder="Unit">
                                </div>

                                <div class="col-xs-3">
                                    <label for="productrate1">Rate</label>
                                    <input type="number" class="form-control" id="productrate1" name="productrate1" placeholder="Rate">
                                </div>

                                <div class="col-xs-3">
                                        <label>Unit</label>
                                        <input class="form-control" id="productunit1" name="productunit1" placeholder="Unit">
                                </div>

                                
                            </div>
                            <div class="row">

                                <div class="col-xs-4">
                                    <label for="productdis1">Discount</label>
                                    <input type="number" class="form-control" id="productdis1" name="productdis1" placeholder="Discount">
                                </div>

                                <div class="col-xs-4">
                                    <label>Gst %</label>
                                    <select class="form-control select2" id="gst1" name="gst1" style="width: 100%;">
                                        <option value="0%" selected="selected">0</option>
                                        <option value="5%">0.05</option>
                                        <option value="12%">0.12</option>
                                        <option value="18%">0.18</option>
                                    </select>
                                </div>

                                <div class="col-xs-4">
                                    <label for="productstock1">Stock</label>
                                    <input type="text" class="form-control" id="productstock1" name="productstock1" placeholder="Stock">
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
        </div>
        
    </section>
</div>

<?php
require 'common\foot.php';
?>

<script>

    $('#editModal').on('show.bs.modal', function(e) {

        //get data-id attribute of the clicked element
        var srno = $(e.relatedTarget).data('srno');
        var pname = $(e.relatedTarget).data('pname');
        var pid = $(e.relatedTarget).data('pid');
        var gst = $(e.relatedTarget).data('pgst');
        var unit = $(e.relatedTarget).data('unit');
        var rate = $(e.relatedTarget).data('rate');
        var discount = $(e.relatedTarget).data('discount');
        var mrp = $(e.relatedTarget).data('mrp');
        var purprice = $(e.relatedTarget).data('purpri');
        var stock = $(e.relatedTarget).data('stock');


        // populate the textbox
        $(e.currentTarget).find('input[name="srno"]').val(srno);
        $(e.currentTarget).find('input[name="productname1"]').val(pname);
        $(e.currentTarget).find('input[name="productid1"]').val(pid);
        $(e.currentTarget).find('input[name="stock1"]').val(stock);
        $(e.currentTarget).find('input[name="productunit1"]').val(unit);
        $(e.currentTarget).find('input[name="productrate1"]').val(rate);
        $(e.currentTarget).find('input[name="productdis1"]').val(discount);
        $(e.currentTarget).find('input[name="productmrp1"]').val(mrp);
        $(e.currentTarget).find('#gst1').val(gst);
        $(e.currentTarget).find('input[name="productpurpri1"]').val(purprice);
        // $(e.currentTarget).find('input[name="totalamt1"]').val(tamt);
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