<?php
include('header.php')
?>
<div class="col s12">
    <?php
    // connect to the mysql database
    include('dbconfig.php');
    function getname($userid)
    {
        include('dbconfig.php');
        $sql = "SELECT * FROM `customer` WHERE `id`=$userid";
        $result = mysqli_query($conn, $sql);
        $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //set icon

        return '<i class="tiny material-icons black-text  icon">account_circle</i>' . $files[0]['name'];
    }
    ?>
    <div class="col s12">
        <h1 class="red-text text-darken-1">All Customers</h1>
        <?php getname(1) ?>
        <!-- customer table -->
        <table class="highlight">
            <thead>
                <tr class="blue-text text-darken-4">
                    <th>Transaction Id</th>
                    <th>Debited From </th>
                    <th>Credited To </th>
                    <th>Transaction Balance</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = "SELECT * FROM `transaction` ORDER BY id ";
                $result = mysqli_query($conn, $sql);
                $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
                foreach ($files as $value) {
                    echo '<tr class="red-text text-darken-1 font">';
                    echo '<td>' . $value['id'] . '</td>';
                    echo '<td>' . getname($value['debited_from']) . '</td>';
                    echo '<td>' . getname($value['credited_to']) . '</td>';
                    echo '<td>' . '<i class="tiny material-icons black-text icon">attach_money</i>' . $value['amount'] . '</td>';
                    echo '<td>' . $value['date'] . '</td>';
                }

                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include('footer.php')
?>