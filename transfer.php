<?php
include('header.php');
// connect to the mysql database
include('dbconfig.php');
$receiver = $_GET['to'];
$sender = $_GET['from'];
// fetching sender details
$sql = "SELECT * FROM `customer` WHERE id= '$sender'";
$result = mysqli_query($conn, $sql);
$sender = mysqli_fetch_all($result, MYSQLI_ASSOC);

// fetching reciever details
$sql = "SELECT * FROM `customer` WHERE id= '$receiver'";
$result = mysqli_query($conn, $sql);
$receiver = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo '<h4 class="red-text text-darken-4">Hey ' . $sender[0]['name'] . ', Do you want to send money to ' . $receiver[0]['name'] . '?<br> If you confirm to send please enter your amount and press confirm.</h4>'

?>
<form action="send.php" method="post">
    <label for="">Enter Amount</label>
    <input type="text" name="money" required>
    <input type="text" name="from" value=<?php echo ($sender[0]['id']); ?> style="visibility: hidden;">
    <input type="text" name="to" value=<?php echo ($receiver[0]['id']); ?> style="visibility: hidden;">
    <button class="waves-effect waves-light btn" type="submit">Continue</button>
</form>

<?php
include('footer.php')
?>