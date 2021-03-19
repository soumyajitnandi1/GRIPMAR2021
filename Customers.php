<?php
include('header.php');
$msg = $_GET['msg'];

echo '<div class="col s12">';
echo '<h4 class="green-text text-darken-1" style="text-align:center;">' . $msg . '</h4>';
echo '</div>';
?>
<div class="col s12">
    <?php
    // connect to the mysql database
    include('dbconfig.php');
    ?>
    <div class="col s12">
        <h1 class="red-text text-darken-1">All Customers</h1>
        <!-- customer table -->
        <table class="highlight">
            <thead>
                <tr class="blue-text text-darken-4 ">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Current Balance</th>
                    <th>View Profile</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = "SELECT * FROM `customer` ORDER BY id ";
                $result = mysqli_query($conn, $sql);
                $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
                foreach ($files as $value) {
                    echo '<tr class="red-text text-darken-1 font">';
                    echo '<td>' . $value['id'] . '</td>';
                    echo '<td><i class="tiny material-icons black-text icon">account_circle</i>' . $value['name'] . '</td>';
                    echo '<td>' . $value['email'] . '</td>';
                    echo '<td>' . $value['current balance'] . '</td>';
                    echo '<td><a href="' . 'user.php?id=' . $value['id'] . '">' . 'View Profile  ' . '<a/><i class="tiny material-icons red-text icon">arrow_right_alt</i></td>';
                }

                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include('footer.php')
?>