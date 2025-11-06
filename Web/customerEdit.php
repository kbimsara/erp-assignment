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
  if (isset($_POST['updateUser'])) {

    $editId = $_GET['edit'];

    $title = $_POST["title"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $contact = $_POST["contact"];
    $district = $_POST["district"];

    //  Check if user already exists
    $query_check = "SELECT * FROM `customers` WHERE `id`='$editId' LIMIT 1;";
    $query_check_run = mysqli_query($Connector, $query_check);

    if (!$query_check_run) {
      die("Database error: " . mysqli_error($Connector));
    }

    if (mysqli_num_rows($query_check_run) > 0) {

      //  Use actual form data instead of placeholders
      // $query_update = "
      //       INSERT INTO `customers` (`id`, `title`, `firstName`, `lastName`, `contact`, `district`) 
      //       VALUES ('$id', '$title', '$fname', '$lname', '$contact', '$district');
      //   ";
      $query_update = "UPDATE `customers` SET `title` = '$title',`firstName` = '$fname', `lastName` = '$lname', `contact` = '$contact', `district` = '$district' WHERE `customers`.`id` = '$editId';";

      $query_run = mysqli_query($Connector, $query_update);

      if ($query_run) {
        echo "
                <script>
                Swal.fire(
                    'Account Updated!',
                    'Customer Update Successfully.',
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
                    text: 'Failed to update account. Please try again.'
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
                text: 'User not exists!'
            });
            </script>
        ";

      header('location: ./index.php'); //redirect to index.php
    }
  }

  ?>



  <div class="container-fluid">
    <center>
      <h2 style="margin: 20px;">Customer Report</h2>
    </center>
    <div class="container-fluid" style="margin-top: 40px;">
      <form method="post">
        <div class="row justify-content-center" style="background-color: #435663; padding: 25px; border-radius: 10px;">
          <?php
          //get customer data
          if (isset($_GET['edit'])) {
            $editId = $_GET['edit'];

            $sql_get = "SELECT * FROM `customers` WHERE `id` = '$editId';";
            $result_get = mysqli_query($Connector, $sql_get);

            $stat = "selected";

            if ($row_get = mysqli_fetch_array($result_get)) {
              $id = $row_get['id'];
              $editTitle = $row_get['title'];
              $editFname = $row_get['firstName'];
              $editLname = $row_get['lastName'];
              $editContact = $row_get['contact'];
              $editDistrict = $row_get['district'];
          ?>

              <!-- ID -->
              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4">
                <center>
                  <h3 for="exampleInputTEXT1">Customer ID : <?php echo $id; ?></h3>
                </center>
              </div>
              <!-- title -->
              <div class="col-12 col-sm-11 col-md-6 col-lg-2 col-xl-2 mt-4">
                <center>
                  <label for="exampleInputTEXT1">Title</label>
                  &nbsp;&nbsp;
                  <select name="title" id="title" class="dropdown" style="padding: 10px; border-radius: 5px; background-color: #343a40; color: white; border: 1px solid #ced4da;">
                    <option value="Mr" <?php if ($editTitle == 'Mr') {
                                          echo $stat;
                                        } ?>>Mr</option>
                    <option value="Mrs" <?php if ($editTitle == 'Mrs') {
                                          echo $stat;
                                        } ?>>Mrs</option>
                    <option value="Miss" <?php if ($editTitle == 'Miss') {
                                            echo $stat;
                                          } ?>>Miss</option>
                    <option value="Dr" <?php if ($editTitle == 'Dr') {
                                          echo $stat;
                                        } ?>>Dr</option>
                  </select>
                </center>
              </div>
              <!-- fname -->
              <div class="col-12 col-sm-11 col-md-6 col-lg-3 col-xl-3">
                <label for="exampleInputTEXT1">First Name</label>
                <input type="text" class="form-control" name="fname" id="fname" placeholder="Jhone" value="<?php echo $editFname; ?>" required>
              </div>
              <!-- lname -->
              <div class="col-12 col-sm-11 col-md-6 col-lg-3 col-xl-3">
                <label for="exampleInputTEXT1">Last Name</label>
                <input type="text" class="form-control" name="lname" id="lname" placeholder="Wick" value="<?php echo $editLname; ?>" required>
              </div>
              <!-- contact -->
              <div class="col-12 col-sm-11 col-md-6 col-lg-2 col-xl-2">
                <label for="exampleInputTEXT1">Contact Number</label>
                <input type="text" class="form-control" name="contact" id="contact" placeholder="0771234567" value="<?php echo $editContact; ?>" required>
              </div>
              <!-- District -->
              <div class="col-12 col-sm-11 col-md-6 col-lg-2 col-xl-2 mt-4">
                <center>
                  <label for="exampleInputTEXT1">District</label>
                  &nbsp;&nbsp;
                  <select required name="district" id="district" class="dropdown"
                    style="padding: 10px; border-radius: 5px; background-color: #343a40; color: white; border: 1px solid #ced4da;">

                    <option value="">Select District</option>
                    <option value="Colombo" <?php if ($editDistrict == 'Colombo') {
                                              echo $stat;
                                            } ?>>Colombo</option>
                    <option value="Gampaha" <?php if ($editDistrict == 'Gampaha') {
                                              echo $stat;
                                            } ?>>Gampaha</option>
                    <option value="Kalutara" <?php if ($editDistrict == 'Kalutara') {
                                                echo $stat;
                                              } ?>>Kalutara</option>
                    <option value="Kandy" <?php if ($editDistrict == 'Kandy') {
                                            echo $stat;
                                          } ?>>Kandy</option>
                    <option value="Matale" <?php if ($editDistrict == 'Matale') {
                                              echo $stat;
                                            } ?>>Matale</option>
                    <option value="Nuwara Eliya" <?php if ($editDistrict == 'Nuwara Eliya') {
                                                    echo $stat;
                                                  } ?>>Nuwara Eliya</option>
                    <option value="Galle" <?php if ($editDistrict == 'Galle') {
                                            echo $stat;
                                          } ?>>Galle</option>
                    <option value="Matara" <?php if ($editDistrict == 'Matara') {
                                              echo $stat;
                                            } ?>>Matara</option>
                    <option value="Hambantota" <?php if ($editDistrict == 'Hambantota') {
                                                  echo $stat;
                                                } ?>>Hambantota</option>
                    <option value="Jaffna" <?php if ($editDistrict == 'Jaffna') {
                                              echo $stat;
                                            } ?>>Jaffna</option>
                    <option value="Kilinochchi" <?php if ($editDistrict == 'Kilinochchi') {
                                                  echo $stat;
                                                } ?>>Kilinochchi</option>
                    <option value="Mannar" <?php if ($editDistrict == 'Mannar') {
                                              echo $stat;
                                            } ?>>Mannar</option>
                    <option value="Vavuniya" <?php if ($editDistrict == 'Vavuniya') {
                                                echo $stat;
                                              } ?>>Vavuniya</option>
                    <option value="Mullaitivu" <?php if ($editDistrict == 'Mullaitivu') {
                                                  echo $stat;
                                                } ?>>Mullaitivu</option>
                    <option value="Batticaloa" <?php if ($editDistrict == 'Batticaloa') {
                                                  echo $stat;
                                                } ?>>Batticaloa</option>
                    <option value="Ampara" <?php if ($editDistrict == 'Ampara') {
                                              echo $stat;
                                            } ?>>Ampara</option>
                    <option value="Trincomalee" <?php if ($editDistrict == 'Trincomalee') {
                                                  echo $stat;
                                                } ?>>Trincomalee</option>
                    <option value="Kurunegala" <?php if ($editDistrict == 'Kurunegala') {
                                                  echo $stat;
                                                } ?>>Kurunegala</option>
                    <option value="Puttalam" <?php if ($editDistrict == 'Puttalam') {
                                                echo $stat;
                                              } ?>>Puttalam</option>
                    <option value="Anuradhapura" <?php if ($editDistrict == 'Anuradhapura') {
                                                    echo $stat;
                                                  } ?>>Anuradhapura</option>
                    <option value="Polonnaruwa" <?php if ($editDistrict == 'Polonnaruwa') {
                                                  echo $stat;
                                                } ?>>Polonnaruwa</option>
                    <option value="Badulla" <?php if ($editDistrict == 'Badulla') {
                                              echo $stat;
                                            } ?>>Badulla</option>
                    <option value="Monaragala" <?php if ($editDistrict == 'Monaragala') {
                                                  echo $stat;
                                                } ?>>Monaragala</option>
                    <option value="Ratnapura" <?php if ($editDistrict == 'Ratnapura') {
                                                echo $stat;
                                              } ?>>Ratnapura</option>
                    <option value="Kegalle" <?php if ($editDistrict == 'Kegalle') {
                                              echo $stat;
                                            } ?>>Kegalle</option>

                  </select>

                </center>
              </div>
              <!-- submit -->
              <div class="col-12 col-sm-10 col-md-10 col-lg-10 col-xl-10 mt-4">
                <center>
                  <button type="submit" class="btn btn-warning" style="width: 100px;" name="updateUser">Update</button>
                </center>
              </div>
          <?php
            } else {
              echo "
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Customer not found!'
            }).then(function() {
                window.location.href = './index.php';
            });
            </script>
        ";
            }
          }

          ?>
        </div>
      </form>
    </div>

    <div class="container-fluid table-responsive" style="margin-top: 80px; margin-bottom: 50px;">

      <table class="table table-hover table-dark">
        <thead class="sticky-top bg-dark">
          <tr>
            <th scope="col">#</th>

            <th scope="col">Bill no</th>
            <th scope="col">Date</th>
            <th scope="col">Customer</th>
            <th scope="col">district</th>
            <th scope="col">Item count</th>
            <th scope="col">Net Amount</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once './config.php';

          $sql = "SELECT b.billNo, b.timeStamp AS date, CONCAT(c.firstName, ' ', c.lastName) AS customer, c.id,c.district, COUNT(b.itemCode) AS itemCount, SUM(b.netPrice) AS netAmount FROM bill b JOIN customers c ON b.id = c.id JOIN items i ON b.itemCode = i.itemCode WHERE c.id='$id' GROUP BY b.billNo, b.timeStamp, c.firstName, c.lastName, c.district ORDER BY b.timeStamp DESC;";
          $result = mysqli_query($Connector, $sql);
          $i = 0;

          while ($row = mysqli_fetch_array($result)) {
            $i++;
            $billNo  = $row['billNo'];
            $timeStamp = $row['date'];

            $customer = $row['customer'];
            $district = $row['district'];

            $unitCount = $row['itemCount'];
            $netPrice = $row['netAmount'];

            $stat = "selected";

          ?>
            <tr>
              <th scope="row"><?php echo $i; ?></th>
              <td scope="row"><?php echo $billNo; ?></td>
              <td scope="row"><?php echo $timeStamp; ?></td>
              <td scope="row"><?php echo $customer; ?></td>
              <td scope="row"><?php echo $district; ?></td>
              <td scope="row"><?php echo $unitCount; ?></td>
              <td scope="row"><?php echo $netPrice; ?></td>
              <td>

                <a href="itemEdit.php?edit=<?php echo $itemCode; ?>">
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
              <th scope="row" colspan="8">
                <center>No Data In database
                </center>
              </th>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  <!-- Footer -->
</body>

</html>