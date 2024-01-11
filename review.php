<!DOCTYPE html>
<html lang="en">
<?php
include 'connection.php';
include 'valid_session.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $approval = $_POST["approval"];
    include 'connection.php';
    $questionText = mysqli_real_escape_string($conn, $questionText);
    $quiz = mysqli_real_escape_string($conn, $quiz);
    $sql = "UPDATE user SET `approval` = '$approval' WHERE `id` = '$id'";

    if ($conn->query($sql) === TRUE) {
        $successMessage = "Updated successfully.";
    } else {
        $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
include 'head.php';
?>

<body>
    <?php include 'header.php' ?>
    <?php include 'sidebar.php' ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Review Board</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Review Board</li>
                </ol>
            </nav>
        </div>
        <div class="review">
            <div class="row">
                <div class="col-md-12">
                    <table class="table blue-table shadow rounded">
                        <thead class="thead-blue">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql1 = "SELECT * FROM user WHERE `1` = 1";
                            $sql2 = "SELECT * FROM user WHERE `2` = 1";
                            $sql3 = "SELECT * FROM user WHERE `3` = 1";
                            $sql4 = "SELECT * FROM user WHERE `4` = 1";
                            $sql5 = "SELECT * FROM user WHERE `5` = 1";
                            $i = 1;
                            $result1 = $conn->query($sql1);
                            $result2 = $conn->query($sql2);
                            $result3 = $conn->query($sql3);
                            $result4 = $conn->query($sql4);
                            $result5 = $conn->query($sql5);
                            if (!$result1 || !$result2 || !$result3 || !$result4 || !$result5) {
                                die("Query failed: " . $conn->error);
                            }
                            displayResults($result1, "approval1");
                            displayResults($result2, "approval2");
                            displayResults($result3, "approval3");
                            displayResults($result4, "approval4");
                            displayResults($result5, "approval5");
                            $conn->close();

                            function displayResults($result, $header)
                            {
                                global $i;
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $i++ . "</td>";
                                        echo "<td>" . $row['user_name'] . "</td>";
                                        echo "<td>" . $row['e_no'] . "</td>";
                                        echo "<td>15</td>";
                                        echo "<td>";
                                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                        echo "<input type='hidden' name='approval' value='" . $header . "'>";
                                        echo "<i class='bi bi-check-lg'></i>";
                                        echo "<i class='bi bi-trash'></i>";
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

    <!-- ======= Footer ======= -->
    <?php include 'footer.php' ?>
</body>

</html>