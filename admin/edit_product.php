<?php include('header.php'); ?>

<?php
        if(isset($_GET['product_id'])){

        $order_id = $_GET['product_id'];
        $stmt = $connection->prepare("SELECT * FROM products WHERE product_id=? ");
        $stmt->bind_param('i',$order_id);
        $stmt->execute();
        $products = $stmt->get_result();

        }else if(isset($_POST['edit_button'])){

            $order_id = $_POST['product_id'];
            $title= $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $color = $_POST['color'];
            $special_offer = $_POST['product_special_offer'];
            $product_image = $_POST['product_image'];


            $stmt = $connection->prepare("UPDATE products SET product_name=?, product_description=?, product_price=?,
                                                product_category=?, product_color=?, product_special_offer=?, product_image=?  WHERE product_id=?");
            $stmt->bind_param('sssssssi',$title,$description,$price,$category,$color,$special_offer,$product_image,$order_id);
            
            if($stmt->execute()){
                header('location: products.php?edit_success_message=Product Updated successfully');
            }else{
                header('location: products.php?edit_failure_message=Product not Updated successfully');
            }
        }
        else{
            header('index.php');
            exit;
        }
?>

<<div class="container-fluid">
        <div class="row" style="min-height: 1000px">
        
        <?php include( 'sidemenu.php'); ?>
    
        <main class="col-md-9 ms-sm-auto col-1g-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md—0">
                    <div class="btn-group me-2">


                    </div>
                </div>
            </div>
            <h2>Edit Product</h2>
            <div class="table-responsive">
               
<div class="mx-auto container">
<form id="edit-form" method="POST" action="edit_product.php">
<?php foreach($products as $product){ ?>

        <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
        <div class="form-group my-3">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>" />
            <label for="product-name">Title</label>
            <input type="text" class="form-control" id="product-name" value="<?php echo $product['product_id'];?>" name="title" placeholder="Title">
        </div>
        <div class="form-group mt-2">
            <label for="product-des">Description</label>
            <textarea class="form-control" id="product-des" name="description" value="<?php echo $product['product_description'];?>" placeholder="Description"></textarea>
        </div>
        <div class="form-group mt-2">
            <label for="product-price">Price</label>
            <input type="text" class="form-control" id="product-price" name="price" value="<?php   echo $product['product_price'];?>" placeholder="Price">
        </div>
        <div class="form-group mt-2">
            <label for="product-category">Category</label>
            <select class="form-select" id="product-category" name="category" required>
                <option selected disabled>Select category</option>
                <option value="bags">Jacket</option>
                <option value="shoes">Hoodies</option>
                <option value="watches">T-shirt</option>
                <option value="clothes">Shirt</option>
            </select>
        </div>
        <div class="form-group mt-2">
            <label for="product-color">Color</label>
            <input type="text" class="form-control" value="<?php echo $product['product_color'];?>" id="product-color" name="color" placeholder="Color">
        </div>
        <div class="form-group mt-2">
            <label for="product-price">Special Offer/Sale</label>
            <input type="number" class="form-control" value="<?php echo $product['product_special_offer'];?>" id="product-special-offer" name="product_special_offer" placeholder="Sale %">
        </div>
        <div class="form-group mt-2">
            <label for="product-image">Product Image</label>
            <input type="file" class="form-control" value="<?php echo $product['product_image'];?>" id="product-image" name="product_image">
        </div>
        <div class="form-group mt-3">
            <input type="submit" class="btn btn-primary" name="edit_button" value="Submit"/>
        </div>
        
        <?php } ?>
    </form>
</div>

</div>