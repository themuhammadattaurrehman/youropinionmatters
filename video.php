<?php
// session_start();
include 'valid_session.php';
$sad=$_GET['quiz'];
// echo $sad;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming the data is sent as POST
    $phoneNumber = $_POST['phoneNumber'];
    $id = $_SESSION['id'];
    $sad=$_POST['quiz'];
    // Validate and process the data as needed

    // Valid phone number, you can proceed with updating the database

    include 'connection.php';
    // Update the table
    $sql = "UPDATE user SET e_no = '$phoneNumber' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // echo json_encode(['status' => 'success', 'message' => 'Phone number updated successfully.']);
        header("Location: quiz.php?quiz=$sad");
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating phone number: ' . $conn->error]);
    }

    $conn->close();
}
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
            <h1>Video</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Video</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div id="player"></div><br>
        <button id="myButton" class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#basicModal" disabled>Next</button>
        <!-- <div id="myModal" style="display: none;">
            <p>This is your modal content.</p>
            <button id="closeModalButton">Close Modal</button>
        </div> -->
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
            Basic Modal
        </button> -->
        <div class="modal fade" id="basicModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Input For Easypaisa Number</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <!-- <div class="form-group">
                            <label for="inputText">Text:</label>
                            <input type="text" class="form-control" id="inputText" placeholder="Enter text">
                        </div> -->
                        <input type="hidden" name="quiz" value="<?php echo $sad; ?>" />
                            <div class="form-group">
                                <label for="inputNumber">Number:</label>
                                <input type="text" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="03xx-xxxxxxx" oninput="checkPhoneNumber()">
                            </div>
                            <p id="result" class="mt-3"></p>
                            <button type="submit" class="btn btn-primary" disabled id="save" onclick="saveChanges()">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- End Basic Modal-->

        <!-- The Overlay Background -->
        <div id="overlay" style="display: none;"></div>

        <script>
            var tag = document.createElement('script');
            tag.src = 'https://www.youtube.com/iframe_api';
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            var player;

            function onYouTubeIframeAPIReady() {
                player = new YT.Player('player', {
                    height: '340',
                    width: '520',
                    videoId: 'jnSjvOKV-NQ',
                    playerVars: {
                        controls: 0, // Disable controls
                        disablekb: 1 // Disable keyboard controls
                    },
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            }

            function onPlayerReady(event) {
                // You can do something here if needed
            }

            function onPlayerStateChange(event) {
                if (event.data == YT.PlayerState.ENDED) {
                    document.getElementById('myButton').disabled = false;
                }
            }

            function checkPhoneNumber() {
                const phoneNumberInput = document.getElementById('phoneNumber').value;
                const phoneNumberRegex = /^03[0-9]{2}-[0-9]{7}$/;
                const saveButton = document.getElementById('save');
                if (phoneNumberRegex.test(phoneNumberInput)) {
                    document.getElementById('result').innerText = 'This is a valid Pakistani phone number.';
                    saveButton.disabled = false; // Enable the button
                } else {
                    document.getElementById('result').innerText = 'This is not a valid Pakistani phone number.';
                    saveButton.disabled = true; // Disable the button
                }
            }
            // document.addEventListener('DOMContentLoaded', function() {
            //     const promptButton = document.getElementById('myButton');

            //     promptButton.addEventListener('click', function() {
            //         const userInput = window.prompt('Enter something:');
            //         if (userInput !== null) {
            //             // User clicked OK and entered something
            //             alert('You entered: ' + userInput);
            //         } else {
            //             // User clicked Cancel or closed the prompt
            //             alert('You canceled or closed the prompt.');
            //         }
            //     });
            // });
            function closeModal() {
                $('#basicModal').modal('hide');
            }
        </script>
    </main><!-- End #main -->
    <!-- ======= Footer ======= -->
    <?php include 'footer.php' ?>
</body>

</html>