<?php

include('server/connection.php');


if(isset($_POST['submit_review'])) {
    
    $order_id = $_POST['product_id'];
    $user_id = $_POST['user_id']; 
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    
   
    $stmt = $connection->prepare("INSERT INTO reviews (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $order_id, $user_id, $rating, $comment);
    $stmt->execute();
    $stmt->close();
    
   
   
}


if(isset($_GET['product_id'])) {
    $order_id = $_GET['product_id'];
    
    $stmt = $connection->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    
    
    $stmt = $connection->prepare("SELECT * FROM reviews WHERE product_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $reviews = $stmt->get_result();
} else {
    header('Location: index.php');
    exit();
}
?>


<form action="" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $order_id; ?>" />
    
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
    
    <div class="form-group">
        <label for="rating">Rating:</label>
        <select name="rating" id="rating" class="form-control" required>
            <option value="">Select Rating</option>
            <option value="1">1 Star</option>
            <option value="2">2 Stars</option>
            <option value="3">3 Stars</option>
            <option value="4">4 Stars</option>
            <option value="5">5 Stars</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
    </div>
    <br>
    
    <button type="submit" name="submit_review" class="btn btn-primary">Submit Review</button>
</form>

<br>

<?php if($reviews->num_rows > 0): ?>
    <h2>Reviews</h2>
    <ul>
        <?php while($row = $reviews->fetch_assoc()): ?>
            <li>
               
                <strong>Rating:</strong> <?php echo $row['rating']; ?>
                <br>
                <strong>Comment:</strong> <?php echo $row['comment']; ?>
                <br>
                <strong>Time:</strong> <?php echo $row['timestamp']; ?>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <p>No reviews yet. Be the first to leave a review!</p>
<?php endif; ?>