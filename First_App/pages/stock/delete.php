<?php
// Check if ID is set and valid
if (!isset($_GET['id']) || !is_numeric($_GET['id']) || getStockByID($_GET['id']) === null) {
    header('Location: ./?page=stock/home');
    exit;
}

// Delete the stock
if (deleteStock((int)$_GET['id'])) {
    echo '<div class="alert alert-success" role="alert">
        Stock deleted successfully. <a href="./?page=stock/home">Stock page</a>
        </div>';
} else {
    echo '<div class="alert alert-danger" role="alert">
        Cannot delete Stock! <a href="./?page=stock/home">Stock page</a>
        </div>';
}



/*if (!isset($_GET['id']) || getUserByID($_GET['id']) === null) {
    header('Location: ./?page=user/home');
    exit;
}

if (isset($_POST['confirm_delete'])) {
    if (deleteUser($_GET['id'])) {
        echo '<div class="alert alert-success" role="alert">
        User deleted successfully. <a href="./?page=user/home">User page</a>
        </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
        Cannot delete user! <a href="./?page=user/home">User page</a>
        </div>';
    }
} else {
    // Show confirmation dialog
    ?>
    <div class="alert alert-warning" role="alert">
        Are you sure you want to delete this user?
        <form method="POST">
            <button type="submit" name="confirm_delete" class="btn btn-danger">Delete</button>
            <a href="./?page=user/home" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <?php
}*/
?>


