<?php

include '../layout/connect.php';
include '../includes/functions/functions.php';

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

if ($id != 0) {
    // Fetch the order details
    $statements = $conn->prepare("SELECT * FROM orders WHERE id = :id");
    $statements->execute(['id' => $id]);
    $row = $statements->fetch();

    if ($row) { // Check if the order exists
        $userId = $row['userID'];
        $itemId = $row['itemID'];

        $getCategory = $conn->prepare("SELECT * FROM item WHERE id = :itemId");
        $getCategory->execute(['itemId' => $itemId]);
        $catRow = $getCategory->fetch();
        
        if ($catRow) { // Check if the item exists
            $catagoriesId = $catRow['categoryID'];

            // Update the orders table
            $stmt = $conn->prepare("UPDATE orders SET outlet = :outlet WHERE id = :orderId LIMIT 1");
            $stmt->execute(['outlet' => 1, 'orderId' => $id]);
            $count = $stmt->rowCount();

            // Get the current earnings
            $oldEarningStmt = $conn->prepare("SELECT earnings FROM catagories WHERE id = :catagoriesId");
            $oldEarningStmt->execute(['catagoriesId' => $catagoriesId]);
            $oldEarningRow = $oldEarningStmt->fetch();
            $oldEarning = $oldEarningRow ? $oldEarningRow['earnings'] : 0;

            // Get the item price
            $sum = $conn->prepare("SELECT SUM(item.price) AS total_price
                                    FROM orders
                                    JOIN item ON orders.itemID = item.id
                                    WHERE orders.outlet != 0 AND orders.id = :orderId");
            $sum->execute(['orderId' => $id]);
            $itemPriceRow = $sum->fetch();
            $itemPrice = $itemPriceRow['total_price'];

            // Calculate new earnings
            $newEarning = $oldEarning + $itemPrice;

            // Update the categories table
            $stmt2 = $conn->prepare("UPDATE catagories SET earnings = :earnings WHERE id = :catagoriesId LIMIT 1");
            $stmt2->execute(['earnings' => $newEarning, 'catagoriesId' => $catagoriesId]);
            $count1 = $stmt2->rowCount();

            // Update the users table

            // Redirect based on the update results
            if ($count > 0 && $count1 > 0 ) {
                header("Location:../layout/orders.php");
                exit(); 
            } else {
                redirectHome('Error: Cannot complete this order.', '../layout/orders.php', 5);
            }
        } else {
            redirectHome('Error: Item not found.', '../layout/orders.php', 5);
        }
    } else {
        redirectHome('Error: Order not found.', '../layout/orders.php', 5);
    }
}

?>