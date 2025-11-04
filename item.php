<!doctype html>
<?php $page = 'item'; ?>
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
  if (isset($_POST['createItem'])) {

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
      <h2 style="margin: 20px;">Items Registrary</h2>
    </center>
    <div class="container-fluid" style="margin-top: 40px;">
      <form method="post">
        <div class="row justify-content-center" style="background-color: #435663; padding: 25px; border-radius: 10px;">
          <!-- Item name -->
          <div class="col-12 col-sm-11 col-md-6 col-lg-3 col-xl-3">
            <label for="exampleInputTEXT1">Item name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Samsung TV 24 inc" required>
          </div>
          <!-- quantity -->
          <div class="col-12 col-sm-11 col-md-6 col-lg-1 col-xl-1">
            <label for="exampleInputTEXT1">Quantity</label>
            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="5" required>
          </div>
          <!-- Unit Price -->
          <div class="col-12 col-sm-11 col-md-6 col-lg-1 col-xl-1">
            <label for="exampleInputTEXT1">Unit Price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="1000" required>
          </div>
          <!-- Catagory -->
          <div class="col-12 col-sm-11 col-md-6 col-lg-2 col-xl-2 mt-4">
            <center>
              <label for="exampleInputTEXT1">Catagory</label> 
              <select required name="district" id="district" class="dropdown"
                style="padding: 10px; border-radius: 5px; background-color: #343a40; color: white; border: 1px solid #ced4da;">

                <option value="">Select District</option>
                <option value="Colombo">Colombo</option>
                <option value="Gampaha">Gampaha</option>
                <option value="Kalutara">Kalutara</option>

              </select>

            </center>
          </div>
          <!-- Catagory sub -->
          <div class="col-12 col-sm-11 col-md-6 col-lg-2 col-xl-2 mt-4">
            <center>
              <label for="exampleInputTEXT1">Sub Catagory</label>
              <select required name="district" id="district" class="dropdown"
                style="padding: 10px; border-radius: 5px; background-color: #343a40; color: white; border: 1px solid #ced4da;">

                <option value="">Select District</option>
                <option value="Colombo">Colombo</option>
                <option value="Gampaha">Gampaha</option>
                <option value="Kalutara">Kalutara</option>
                <option value="Kandy">Kandy</option>

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

    <div class="container-fluid table-responsive" style="margin-top: 80px; margin-bottom: 50px;">
      <table class="table table-hover table-dark">
        <thead class="sticky-top bg-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Item Name</th>
            <th scope="col">quantity</th>
            <th scope="col">Last Name</th>
            <th scope="col">unitPrice</th>
            <th scope="col">Catagory</th>
            <th scope="col">Sub-Catagory</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once './config.php';

          $sql = "SELECT * FROM `items` ORDER BY timeStamp DESC;";
          $result = mysqli_query($Connector, $sql);
          $i = 0;

          while ($row = mysqli_fetch_array($result)) {
            $i++;
            $itemCode = $row['itemCode'];
            $itemName = $row['itemName'];
            $idCt = $row['idCt'];
            $quantity = $row['quantity'];
            $unitPrice = $row['unitPrice'];
            $timeStamp = $row['timeStamp'];

            $stat = "selected";

          ?>
            <tr>
              <th scope="row"><?php echo $i; ?></th>
              <td scope="row"><?php echo $i; ?></td>
              <td>
                <select name="title_<?php echo $id; ?>" id="title_<?php echo $id; ?>" class="dropdown" style="padding: 10px; border-radius: 5px; background-color: #343a40; color: white; border: 1px solid #ced4da;">
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