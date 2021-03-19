<?php
include('dbconfig.php');
$amount = $_POST['money'];
$from = $_POST['from'];
$to = $_POST['to'];

//debit from sender ac

// get previous balance of sender account
$sql = "SELECT * FROM `customer` WHERE id= '$from'";
$result = mysqli_query($conn, $sql);
$sender = mysqli_fetch_all($result, MYSQLI_ASSOC);
$previous_balance_sender = $sender[0]['current balance'];
$new_balance_sender = (int)$previous_balance_sender - (int)$amount;
// cheaking if sender send amount is not greater than his balance
if ($new_balance_sender > 0) {
    //update sender current balance
    $sql = "UPDATE `customer` SET `current balance`=$new_balance_sender WHERE `id`='$from'";
    if ($conn->query($sql) === TRUE) {
        // echo "sender Record updated successfully";
    } else {
        echo "Error updating sender's record: " . $conn->error;
        die();
    }

    // get previous balance of receiver account
    $sql = "SELECT * FROM `customer` WHERE id= '$to'";
    $result = mysqli_query($conn, $sql);
    $receiver = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $previous_balance_receiver = $receiver[0]['current balance'];
    $new_balance_receiver = (int)$previous_balance_receiver + (int)$amount;

    //update receiver current balance
    $sql = "UPDATE `customer` SET `current balance`=$new_balance_receiver WHERE `id`='$to'";
    if ($conn->query($sql) === TRUE) {
        // echo "reciver Record updated successfully";
    } else {
        echo "Error updating receiver's record: " . $conn->error;
        die();
    }
    //updating data to transaction table
    $sql = "INSERT INTO `transaction`(`debited_from`, `credited_to`, `amount`) VALUES ('$from','$to','$amount')";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error updating record at transaction table" . $conn->error;
        die();
    }
    // redirect to Customers page
    header("Location: http://localhost/bank/Customers.php?msg='Successfully Transfared'");
} else {
    header("Location: http://localhost/bank/Customers.php?msg='You Have Not Enough Money to Send'");
}
