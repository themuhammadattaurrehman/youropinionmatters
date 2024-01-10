<?php 
include 'connection.php';
include 'valid_session.php';
$sql = "SELECT referal FROM user WHERE id=".$_SESSION['id'];

// Execute the query
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<?php include 'head.php' ?>

<body>
    <!-- ======= Header ======= -->
    <?php include 'header.php' ?>
    <!-- ======= Sidebar ======= -->
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
                <table class="table">
                    <thead class="thead-blue">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        </tr>
                    </tbody>
                    </table>
                </div>

            </div>
        </div>

         

      
        <script>
            function generateReferralCode() {
                // Generate referral code
                var referralCode = Math.floor(10000000 + Math.random() * 90000000);

                // Send AJAX request to update the referral code in the database
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "updateReferralCode.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log(xhr.responseText); // Output from the server
                        // Display the referral code on the page
                        document.getElementById("referralCodeDisplay").innerHTML = "Referral Code: " + referralCode;
                    }
                };
                xhr.send("referralCode=" + referralCode);
            }
        </script>

    </main>


    <!-- ======= Footer ======= -->
    <?php include 'footer.php' ?>
</body>

</html>
