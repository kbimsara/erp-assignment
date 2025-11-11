<!doctype html>
<?php $page = 'customer'; ?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ERP SYSTEM</title>
  <!-- Page Title bar -->
  <link rel="icon" type="image/png" href="./src/icon/icn.png" />

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  <!-- jQuery (use full version, not slim) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Sweet Alert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- StyleSheet File -->
  <link rel="stylesheet" href="./style.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body class="bg-dark text-white">
  <!-- Navbar -->
  <?php include './component/nav/navBar.php'; ?>
  <!-- <style>
    div {
      border: 1px red solid;
    }
  </style> -->

  <?php
  require_once './lib/idGeneratorUser.php';
  require_once './config.php';


  // create new user
  if (isset($_POST['createUser'])) {

    $newIdGenerator = new IdGenerator();
    $id = $newIdGenerator->generateUniqueUserId(); //  use -> instead of .

    $title = $_POST["title"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $contact = $_POST["contact"];
    $district = $_POST["district"];

    //  Check if user already exists
    $query_check = "SELECT * FROM `customers` WHERE `firstName`='$fname' AND `lastName`='$lname' AND `contact`='$contact' LIMIT 1;";
    $query_check_run = mysqli_query($Connector, $query_check);

    if (!$query_check_run) {
      die("Database error: " . mysqli_error($Connector));
    }

    if (mysqli_num_rows($query_check_run) < 1) {

      //  Use actual form data instead of placeholders
      $query_insert = "
            INSERT INTO `customers` (`id`, `title`, `firstName`, `lastName`, `contact`, `district`) 
            VALUES ('$id', '$title', '$fname', '$lname', '$contact', '$district');
        ";

      $query_run = mysqli_query($Connector, $query_insert);

      if ($query_run) {
        echo "
                <script>
                Swal.fire(
                    'Account Created!',
                    'Customer Registored Successfully.',
                    'success'
                );
                </script>
            ";
      } else {
        echo "
                <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Database Error',
                    text: 'Failed to create account. Please try again.'
                });
                </script>
            ";
      }
    } else {
      echo "
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'User already exists!'
            });
            </script>
        ";
    }
  }


  ?>



  <div class="container-fluid">
    <center>
      <h2 style="margin: 20px;">Customer Registrary</h2>
    </center>
    <div class="container-fluid" style="margin-top: 40px;">
      <form method="post">
        <div class="row justify-content-center" style="background-color: #435663; padding: 25px; border-radius: 10px;">
          <!-- title -->
          <div class="col-12 col-sm-11 col-md-6 col-lg-2 col-xl-2 mt-4">
            <center>
              <label for="exampleInputTEXT1">Title</label>
              &nbsp;&nbsp;
              <select name="title" id="title" class="dropdown" style="padding: 10px; border-radius: 5px; background-color: #343a40; color: white; border: 1px solid #ced4da;">
                <option value="Mr">Mr</option>
                <option value="Mrs">Mrs</option>
                <option value="Miss">Miss</option>
                <option value="Dr">Dr</option>
              </select>
            </center>
          </div>
          <!-- fname -->
          <div class="col-12 col-sm-11 col-md-6 col-lg-3 col-xl-3">
            <label for="exampleInputTEXT1">First Name</label>
            <input type="text" class="form-control" name="fname" id="fname" placeholder="Jhone" required>
          </div>
          <!-- lname -->
          <div class="col-12 col-sm-11 col-md-6 col-lg-3 col-xl-3">
            <label for="exampleInputTEXT1">Last Name</label>
            <input type="text" class="form-control" name="lname" id="lname" placeholder="Wick" required>
          </div>
          <!-- contact -->
          <div class="col-12 col-sm-11 col-md-6 col-lg-2 col-xl-2">
            <label for="exampleInputTEXT1">Contact Number</label>
            <input type="text" class="form-control" name="contact" id="contact" placeholder="0771234567" required>
          </div>
          <!-- District -->
          <div class="col-12 col-sm-11 col-md-6 col-lg-2 col-xl-2 mt-4">
            <center>
              <label for="exampleInputTEXT1">District</label>
              &nbsp;&nbsp;
              <select required name="district" id="district" class="dropdown"
                style="padding: 10px; border-radius: 5px; background-color: #343a40; color: white; border: 1px solid #ced4da;">

                <option value="">Select District</option>
                <option value="Colombo">Colombo</option>
                <option value="Gampaha">Gampaha</option>
                <option value="Kalutara">Kalutara</option>
                <option value="Kandy">Kandy</option>
                <option value="Matale">Matale</option>
                <option value="Nuwara Eliya">Nuwara Eliya</option>
                <option value="Galle">Galle</option>
                <option value="Matara">Matara</option>
                <option value="Hambantota">Hambantota</option>
                <option value="Jaffna">Jaffna</option>
                <option value="Kilinochchi">Kilinochchi</option>
                <option value="Mannar">Mannar</option>
                <option value="Vavuniya">Vavuniya</option>
                <option value="Mullaitivu">Mullaitivu</option>
                <option value="Batticaloa">Batticaloa</option>
                <option value="Ampara">Ampara</option>
                <option value="Trincomalee">Trincomalee</option>
                <option value="Kurunegala">Kurunegala</option>
                <option value="Puttalam">Puttalam</option>
                <option value="Anuradhapura">Anuradhapura</option>
                <option value="Polonnaruwa">Polonnaruwa</option>
                <option value="Badulla">Badulla</option>
                <option value="Monaragala">Monaragala</option>
                <option value="Ratnapura">Ratnapura</option>
                <option value="Kegalle">Kegalle</option>

              </select>

            </center>
          </div>
          <!-- submit -->
          <div class="col-12 col-sm-10 col-md-10 col-lg-10 col-xl-10 mt-4">
            <center>
              <button type="submit" class="btn btn-primary" style="width: 100px;" name="createUser">Save</button>
            </center>
          </div>
        </div>
      </form>
    </div>

    <!-- find section -->
    <div class="container-fluid justify-content-center" style="background-color: #435663; padding: 25px; border-radius: 10px; margin-top: 60px;">
      <center>
        <h4>find</h4>
      </center>
      <!-- Search form (functionality not implemented) -->
      <div class="form-inline justify-content-center mt-3 mb-3">
        <input class="form-control mr-sm-2" type="search" placeholder="Search by Name, Contact or District" aria-label="Search" style="width: 50%;" required id="searchInput">
        <button class="btn btn-success my-2 my-sm-0" type="button" name="search" onclick="FetchSearch()">Search</button>
      </div>

    </div>
    <!-- date filter -->
    <div class="form-inline justify-content-center" style="margin-top: 50px;">
      <div class="form-group col-md-2">
        <label for="inputPassword4">Form :</label> &nbsp;
        <input type="date" name="fromDate" id="fromDate" class="form-control" placeholder="No data" required>
      </div>
      <div class="form-group col-md-2">
        <label for="inputPassword4">To :</label> &nbsp;
        <input type="date" name="toDate" id="toDate" class="form-control" placeholder="No data" required>
      </div>
      <div class="form-group col-md-2">
        <button class="btn btn-success my-2 my-sm-0" type="button" name="search" onclick="FetchDate()">Search</button>
      </div>
    </div>

    <div class="container-fluid table-responsive" style="margin-top: 80px; margin-bottom: 50px;">
      <table class="table table-hover table-dark">
        <thead class="sticky-top bg-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Contact Number</th>
            <th scope="col">District</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="customerTableBody">
          <?php
          require_once './config.php';

          $sql = "SELECT * FROM `customers` ORDER BY timeStamp DESC;";
          $result = mysqli_query($Connector, $sql);
          $i = 0;

          while ($row = mysqli_fetch_array($result)) {
            $i++;
            $id = $row['id'];
            $title = $row['title'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $contact = $row['contact'];
            $district = $row['district'];

            $stat = "selected";

          ?>
            <tr>
              <th scope="row"><?php echo $i; ?></th>
              <td>
                <select name="title_<?php echo $id; ?>" id="title_<?php echo $id; ?>" class="dropdown" style="padding: 10px; border-radius: 5px; background-color: #343a40; color: white; border: 1px solid #ced4da;" disabled>
                  <option value="Mr" <?php if ($title == 'Mr') {
                                        echo $stat;
                                      } ?>>Mr</option>
                  <option value="Mrs" <?php if ($title == 'Mrs') {
                                        echo $stat;
                                      } ?>>Mrs</option>
                  <option value="Miss" <?php if ($title == 'Miss') {
                                          echo $stat;
                                        } ?>>Miss</option>
                  <option value="Dr" <?php if ($title == 'Dr') {
                                        echo $stat;
                                      } ?>>Dr</option>
                </select>
              </td>
              <td>
                <input type="text" class="form-control bg-dark text-light" style="max-width: fit-content;" id="fname_<?php echo $id; ?>" name="fname_<?php echo $id; ?>" placeholder="Enter First Name" value="<?php echo $firstName; ?>" disabled>
              </td>
              <td>
                <input type="text" class="form-control bg-dark text-light" style="max-width: fit-content;" id="lname_<?php echo $id; ?>" name="lname_<?php echo $id; ?>" placeholder="Enter First Name" value="<?php echo $lastName; ?>" disabled>
              </td>
              <td>
                <input type="text" class="form-control bg-dark text-light" style="max-width: 120px;" id="contact_<?php echo $id; ?>" name="contact_<?php echo $id; ?>" placeholder="Enter First Name" value="<?php echo $contact; ?>" disabled>
              </td>
              <td>
                <select name="district_<?php echo $id; ?>" id="district_<?php echo $id; ?>" class="dropdown" disabled
                  style="padding: 10px; border-radius: 5px; background-color: #343a40; color: white; border: 1px solid #ced4da;">
                  <option value="">Select District</option>
                  <option value="Colombo" <?php if ($district == 'Colombo') {
                                            echo $stat;
                                          } ?>>Colombo</option>
                  <option value="Gampaha" <?php if ($district == 'Gampaha') {
                                            echo $stat;
                                          } ?>>Gampaha</option>
                  <option value="Kalutara" <?php if ($district == 'Kalutara') {
                                              echo $stat;
                                            } ?>>Kalutara</option>
                  <option value="Kandy" <?php if ($district == 'Kandy') {
                                          echo $stat;
                                        } ?>>Kandy</option>
                  <option value="Matale" <?php if ($district == 'Matale') {
                                            echo $stat;
                                          } ?>>Matale</option>
                  <option value="Nuwara Eliya" <?php if ($district == 'Nuwara Eliya') {
                                                  echo $stat;
                                                } ?>>Nuwara Eliya</option>
                  <option value="Galle" <?php if ($district == 'Galle') {
                                          echo $stat;
                                        } ?>>Galle</option>
                  <option value="Matara" <?php if ($district == 'Matara') {
                                            echo $stat;
                                          } ?>>Matara</option>
                  <option value="Hambantota" <?php if ($district == 'Hambantota') {
                                                echo $stat;
                                              } ?>>Hambantota</option>
                  <option value="Jaffna" <?php if ($district == 'Jaffna') {
                                            echo $stat;
                                          } ?>>Jaffna</option>
                  <option value="Kilinochchi" <?php if ($district == 'Kilinochchi') {
                                                echo $stat;
                                              } ?>>Kilinochchi</option>
                  <option value="Mannar" <?php if ($district == 'Mannar') {
                                            echo $stat;
                                          } ?>>Mannar</option>
                  <option value="Vavuniya" <?php if ($district == 'Vavuniya') {
                                              echo $stat;
                                            } ?>>Vavuniya</option>
                  <option value="Mullaitivu" <?php if ($district == 'Mullaitivu') {
                                                echo $stat;
                                              } ?>>Mullaitivu</option>
                  <option value="Batticaloa" <?php if ($district == 'Batticaloa') {
                                                echo $stat;
                                              } ?>>Batticaloa</option>
                  <option value="Ampara" <?php if ($district == 'Ampara') {
                                            echo $stat;
                                          } ?>>Ampara</option>
                  <option value="Trincomalee" <?php if ($district == 'Trincomalee') {
                                                echo $stat;
                                              } ?>>Trincomalee</option>
                  <option value="Kurunegala" <?php if ($district == 'Kurunegala') {
                                                echo $stat;
                                              } ?>>Kurunegala</option>
                  <option value="Puttalam" <?php if ($district == 'Puttalam') {
                                              echo $stat;
                                            } ?>>Puttalam</option>
                  <option value="Anuradhapura" <?php if ($district == 'Anuradhapura') {
                                                  echo $stat;
                                                } ?>>Anuradhapura</option>
                  <option value="Polonnaruwa" <?php if ($district == 'Polonnaruwa') {
                                                echo $stat;
                                              } ?>>Polonnaruwa</option>
                  <option value="Badulla" <?php if ($district == 'Badulla') {
                                            echo $stat;
                                          } ?>>Badulla</option>
                  <option value="Monaragala" <?php if ($district == 'Monaragala') {
                                                echo $stat;
                                              } ?>>Monaragala</option>
                  <option value="Ratnapura" <?php if ($district == 'Ratnapura') {
                                              echo $stat;
                                            } ?>>Ratnapura</option>
                  <option value="Kegalle" <?php if ($district == 'Kegalle') {
                                            echo $stat;
                                          } ?>>Kegalle</option>

                </select>
              </td>
              <td>
                <a href="customerEdit.php?edit=<?php echo $id; ?>">
                  <button type="submit" class="btn btn-info" name="update" style="margin-right: 5px; width: 100px;">More</button>
                </a>
                <a href="./lib/Action.php?del=<?php echo $id; ?>">
                  <button type="button" class="btn btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                      <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                    </svg>
                  </button></a>
              </td>
            </tr>
          <?php
          }
          if ($i < 1) {
          ?>
            <tr>
              <th scope="row" colspan="6">No Users In database</th>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- AJAX -->
  <script>
    function FetchSearch() {
      var keyword = $('#searchInput').val();
      $.ajax({
        type: 'POST',
        url: './lib/ajaxdata.php',
        data: {
          find_cst: keyword
        },
        success: function(data) {
          $('#customerTableBody').html(data);
        },
        error: function(xhr, status, error) {
          console.error('AJAX Error:', status, error);
        }
      });
    }

    function FetchDate() {
      var from = $('#fromDate').val();
      var to = $('#toDate').val();

      if (!from || !to) {
        alert('Please select both From and To dates.');
        return;
      }

      $.ajax({
        url: './lib/ajaxdata.php',
        type: 'POST',
        data: {
          from_date: from,
          to_date: to
        },
        success: function(data) {
          $('#customerTableBody').html(data);
        },
        error: function(xhr, status, error) {
          console.error('AJAX Error:', status, error);
        }
      });

    }
  </script>
</body>

</html>