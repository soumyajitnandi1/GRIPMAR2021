<?php
include('header.php')
?>

<div class="col s12">
    <?php
    // connect to the mysql database
    include('dbconfig.php');
    ?>
    <div class="col s12">
        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM `customer` WHERE id= $id";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo '<h6 class="col s6 brown-text text-darken-3 font">id</h6>';
        echo '<h6 class="col s6 brown-text text-darken-3 font">' . $user[0]['id'] . '</h6>';
        echo '<h6 class="col s6 brown-text text-darken-3 font">name</h6>';
        echo '<h6 class="col s6 brown-text text-darken-3 font">' . $user[0]['name'] . '</h6>';
        echo '<h6 class="col s6 brown-text text-darken-3 font">email</h6>';
        echo '<h6 class="col s6 brown-text text-darken-3 font">' . $user[0]['email'] . '</h6>';
        echo '<h6 class="col s6 brown-text text-darken-3 font">current balance</h6>';
        echo '<h6 class="col s6 brown-text text-darken-3 font">' . $user[0]['current balance'] . '</h6>';

        ?>
    </div>
    <h5 class="indigo-text text-darken-2" style="padding-top: 50px;">Do You Want To Transfer Money? select whom to Transfer from the options.</h5>
    <?php
    //get all customer without user own.
    $sql = "SELECT * FROM `customer` WHERE id!= $id";
    $result = mysqli_query($conn, $sql);
    $othercustomer = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($othercustomer as $customer) {
        echo '<a class="col s12" href="transfer.php?to=' . $customer['id'] . '&&from=' . $id . '"><i class="tiny material-icons blue-text icon">arrow_right_alt</i><span class="red-text text-darken-3 font">' . $customer['name'] . '</span></a>';
    }

    ?>

</div>
<?php
include('footer.php')
?>