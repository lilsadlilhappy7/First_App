<?php
if (!isset($_GET['id']) || getStockByID($_GET['id']) === null) {
    header('Location: ./?page=stock/home');
    exit;
}

$manage_product = getStockByID($_GET['id']);
$qty_err = $date_err = '';
if (isset($_POST['id_product']) && isset($_POST['qty'])&& isset($_POST['date'])) {
    $id_product = $_POST['id_product'];
    $qty = $_POST['qty'];
    $date = $_POST['date'];

    if (empty($qty)) {
        $qty_err = "Quantity is required!";
    } else {
        if ($qty < 0) {
            $qty_err = "Quantity must not be lower than zero!";
        }
    }    
    if (empty($date)) {
        $date_err = "Date is required!";
    } 

    if (empty($qty_err) && empty($date_err)) {
        if (updateStock($id, $id_product, $qty, $date)) {
            echo '<div class="alert alert-success" role="alert">
                  Stock update successfully. <a href="./?page=stock/home">Stock Page</a>
                 </div>';

            $qty_err = $date_err = '';
            unset($_POST['id_product']);
            unset($_POST['qty']);
            unset($_POST['date']);
        } else {
            echo  '<div class="alert alert-danger" role="alert">
            Stock  update Failed.
           </div>';
        }
    }
}
?>


<form action="./?page=stock/create" method="post" class="w-50 mx-auto">
    <h1>Update Stock</h1>

    <div class="mb-3">
        <label for="id_product " class="form-label">Product</label>
        <select name="id_product" class="form-select">
            <?php
            $products = getProduct();
            if ($products !== null) {
                while ($row = $products->fetch_object()) {
            ?>
                    <option value="<?php echo $row->id_product ?>"><?php echo $row->name?></option>
            <?php
                }
            }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="qty" class="form-label">Qty</label>
        <input type="number" name="qty" class="form-control <?php echo $qty_err !== '' ? 'is-invalid' : '' ?>" value="<?php echo isset($_POST['qty']) ? $_POST['qty'] : '' ?>">
        <div class="invalid-feedback">
            <?php echo $qty_err ?>
        </div>
    </div> 
    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" name="date" class="form-control <?php echo $date_err !== '' ? 'is-invalid' : '' ?>" value="<?php echo isset($_POST['date']) ? $_POST['date'] : '' ?>">
        <div class="invalid-feedback">
            <?php echo $date_err ?>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <a href="./?page=stock/home" role="button" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-success">Create</button>
    </div>
</form>