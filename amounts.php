<!DOCTYPE html>
<html lang="en">
<?php
include 'connection.php';
include 'valid_session.php';
if (isset($_POST['approve'])) {
    $user_id = $_POST['user_id'];
    $approval = $_POST['approval'];
    $sql = "UPDATE user SET `$approval` = '1' WHERE `id` = '$user_id'";

    if ($conn->query($sql) === TRUE) {
      $successMessage = "Updated successfully.";
    } else {
      $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
    }
  
    // $conn->close();
} elseif (isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];
    $other = $_POST['other'];
    $sql = "UPDATE user SET `$other` = '0' WHERE `id` = '$user_id'";

    if ($conn->query($sql) === TRUE) {
      $successMessage = "Updated successfully.";
    } else {
      $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
    }
  
    // $conn->close();
}

include 'head.php';
?>

<body>
    <?php include 'header.php' ?>
    <?php include 'sidebar.php' ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Approval</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Approval</li>
                </ol>
            </nav>
        </div>
        <div class="review">
            <div class="row">
                <div class="col-md-12">
                <?php
              if (isset($successMessage)) {
                echo '<div class="alert alert-success" style="color: green;">' . $successMessage . '</div>';
              } elseif (isset($errorMessage)) {
                echo '<div class="alert alert-danger" style="color: red;">' . $errorMessage . '</div>';
              }
              ?>
                    <table class="table blue-table shadow rounded">
                        <thead class="thead-blue">
                            <tr>
                                <th scope="col">#</th>
                                <!-- <th scope="col">Name</th> -->
                                <!-- <th scope="col">Easypaisa</th> -->
                                <th scope="col">Quiz</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Transfer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql1 = "SELECT * FROM user WHERE `1` = 1 AND `approval1`=1";
                            $sql2 = "SELECT * FROM user WHERE `2` = 1 AND `approval2`=1";
                            $sql3 = "SELECT * FROM user WHERE `3` = 1 AND `approval3`=1";
                            $sql4 = "SELECT * FROM user WHERE `4` = 1 AND `approval4`=1";
                            $sql5 = "SELECT * FROM user WHERE `5` = 1 AND `approval5`=1";
                            $i = 1;
                            $result1 = $conn->query($sql1);
                            $result2 = $conn->query($sql2);
                            $result3 = $conn->query($sql3);
                            $result4 = $conn->query($sql4);
                            $result5 = $conn->query($sql5);
                            if (!$result1 || !$result2 || !$result3 || !$result4 || !$result5) {
                                die("Query failed: " . $conn->error);
                            }
                            displayResults($result1, "approval1","1");
                            displayResults($result2, "approval2","2");
                            displayResults($result3, "approval3","3");
                            displayResults($result4, "approval4","4");
                            displayResults($result5, "approval5","5");
                            $conn->close();
                            function displayResults($result, $header,$others)
                            {
                                global $i;
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $i++ . "</td>";
                                        echo "<td>quiz " . $others . "</td>";
                                        // echo "<td>" . $row['user_name'] . "</td>";
                                        // echo "<td>" . $row['e_no'] . "</td>";
                                        echo "<td>15</td>";
                                        echo "<td>";
                                        echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
                                        echo "<input type='hidden' name='user_id' value='" . $row['id'] . "'>";
                                        echo "<input type='hidden' name='approval' value='" . $header . "'>";
                                        echo "<input type='hidden' name='other' value='" . $others . "'>";
                                        echo "Sends on ".$row['e_no']."</td>";
                                        // echo "<button style='border:none' type='submit' name='delete' value='1'><i class='bi bi-trash'></i></button>";
                                        echo "</form>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script>
        $('#myElement').on('click', function() {

            $.ajax({
                type: 'POST',
                url: 'myFunction.php',
                data: {
                    callFunction: true
                },
                success: function(response) {

                    console.log(response);
                },
                error: function(error) {

                    console.log('Error:', error);
                }
            });
        });
        $('#myElement1').on('click', function() {

            $.ajax({
                type: 'POST',
                url: 'myFunction1.php',
                data: {
                    callFunction: true
                },
                success: function(response) {

                    console.log(response);
                },
                error: function(error) {

                    console.log('Error:', error);
                }
            });
        });
    </script>
    <!-- ======= Footer ======= -->
    <?php include 'footer.php' ?>
</body>

</html>