<?php
// display_questions.php
include 'connection.php';

// Retrieve questions from the database
$sql = "SELECT *  FROM question where quiz=1";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'head.php' ?>
<?php include 'valid_session.php' ?>
<style>
  .quiz-card {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
        }

        .quiz-card h1 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .quiz-card .pole {
            margin-bottom: 10px;
        }

        .quiz-card label {
            display: block;
            border: 1px solid #c5c5c5;
            padding: 3px 6px;
            cursor: pointer;
            position: relative;
            min-height: 40px;
            margin-right: 10px;
        }

        .quiz-card label input {
            display: none;
        }

        .quiz-card label span {
            width: 89%;
            font-weight: normal;
            color: #000;
            z-index: 10;
        }

        .quiz-card label input + span::before {

            position: absolute;
            content: "";
            right: 5px;
            top: 4px;
            width: 60px;
            height: 30px;
            border-radius: 20px;
            background-color: #ccc;
            transition: all 0.3s ease-in-out;

        }

        .quiz-card label input + span::after {

            position: absolute;
            content: "";
            right: 7px;
            top: 6px;
            width: 26px;
            height: 25px;
            border-radius: 50%;
            background-color: #fff;
            transform: translateX(-30px);
            transition: all 0.3s ease-in-out;

        }

        .quiz-card label input:checked + span::before {
            background-color: #72A0C1;
        }

        .quiz-card label input:checked + span::after {
            transform: translateX(0px)
        }

        .quiz-card label span p {
          position: relative;
          z-index: 10;
        }
        

        .quiz-card .pole {
            font-weight: bold;
            flex: 1;
        }

        .quiz-card .pole-count {
            display: none;
        }

        .quiz-card .result {
            content:"";
            position: absolute;
            background-color: #34cd34;
            width: 0%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            transition: all 1s ease-in;
        }
</style>

<body>

  <!-- ======= Header ======= -->
  <?php include 'header.php' ?>
  <!-- ======= Sidebar ======= -->
  <?php include 'sidebar.php' ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->




    


     <section class="section">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Questions</h5>
              <?php
             if ($result->num_rows > 0) {
              echo '<form method="post" action="vote_handler.php">';
              while ($row = $result->fetch_assoc()) {
                  echo '<div class="card mb-3">';
                  echo '<div class="card-body quiz-card">';
                  echo '<h5 class="card-title">Question: ' . $row["question"] . '</h5>';
                  echo '<input type="hidden" name="question_id[]" value="' . $row["id"] . '">';
          
                  // Calculate the sum of op1, op2, op3, and op4
                  $sum = $row['op1_votes'] + $row['op2_votes'];
          
                  // Display the sum
                  // echo '<p>Sum of Options: ' . $sum . '</p>';
          
                  // Loop through options and create radio buttons
                  for ($j = 1; $j <= 2; $j++) {
                      $optionKey = 'op' . $j;
                      $optionsKey = 'op' . $j . '_votes';
                      if($sum!==0){
                      $percentage = ($row[$optionsKey] /$sum) * 100;
                    }

                    echo '<div class="pole d-flex align-items-center">';
                    echo   '<label class="pole-back flex-fill">';
                    echo    '<div class="result"></div>';
                    echo    '<input type="radio" name="option[' . $row["id"] . ']" value="' . $optionKey . '">';
                    echo    '<span> <p style="margin: 0;"> '. $row[$optionKey] .' </p> </span>';
                    echo '</label>';
                    echo '<div class="pole-count">';
                    echo    round($percentage) . '%' ;
                    echo '</div>';
                    echo '</div>';
                  
                  }
          
                  echo '</div>';
                  echo '</div>';
              }
              echo '<input class="btn btn-primary" type="submit" value="Vote" style="margin-top: 10px;">';
              echo '</form>';
          } else {
              echo '<p>No questions available.</p>';
          }
          
              ?>

            </div>
          </div>

        </div>
      </div>
    </section> 
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'footer.php' ?>


  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <script>
        $(document).ready(function () {
            $('input').change(function() {
                if ($(this).is(':checked')) {
                    // Your jQuery code to run when the radio button is checked
                    $('.pole').each(function(){
                        $('.pole-count').css('display', 'block');
                        var result = $(this).find('.result');
                        var width = $(this).find('.pole-count').html();

                        result.width(width);

                    });
                }
            });
        });
    </script>

</body>

</html>