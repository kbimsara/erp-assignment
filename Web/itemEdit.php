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

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


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

  $stat = "selected";

  // create new user
  if (isset($_POST['updateUser'])) {

    $itemCode = $_GET['edit'];

    $itemName  = $_POST["item"];
    $idCt  = $_POST["subCatagory"];
    $quantity  = $_POST["quantity"];
    $unitPrice  = $_POST["price"];

    //  Check if user already exists
    $query_check = "SELECT * FROM `items` WHERE `itemCode`='$itemCode' LIMIT 1;";
    $query_check_run = mysqli_query($Connector, $query_check);

    if (!$query_check_run) {
      die("Database error: " . mysqli_error($Connector));
    }

    if (mysqli_num_rows($query_check_run) > 0) {

      $query_update = "UPDATE `items` SET `itemName` = '$itemName', `idCt` = '$idCt', `quantity` = '$quantity', `unitPrice` = '$unitPrice' WHERE `items`.`itemCode` = '$itemCode';";

      $query_run = mysqli_query($Connector, $query_update);

      if ($query_run) {
        echo "
                <script>
                Swal.fire(
                    'Item Updated!',
                    'Item Update Successfully.',
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
                    text: 'Failed to update Item. Please try again.'
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
                text: 'Item not exists!'
            });
            </script>
        ";

      header('location: ./item.php'); //redirect to index.php
    }
  }

  ?>



  <div class="container-fluid">
    <center>
      <h2 style="margin: 20px;">Item Report</h2>
    </center>
    <div class="container-fluid" style="margin-top: 40px;">
      <form method="post">
        <div class="row justify-content-center" style="background-color: #435663; padding: 25px; border-radius: 10px;">
          <?php
          //get customer data
          if (isset($_GET['edit'])) {
            $itemCode = $_GET['edit'];

            $sql_get = "SELECT i.itemCode,i.itemName,i.quantity,i.unitPrice,i.timeStamp,c.idCt ,c.category,c.categorySub FROM items AS i JOIN category AS c ON i.idCt = c.idCt WHERE i.itemCode = '$itemCode';";
            $result_get = mysqli_query($Connector, $sql_get);

            $stat = "selected";

            if ($row_get = mysqli_fetch_array($result_get)) {
              $itemCode = $row_get['itemCode'];
              $itemName = $row_get['itemName'];
              $quantity = $row_get['quantity'];
              $unitPrice = $row_get['unitPrice'];
              $category = $row_get['category'];
              $categorySub = $row_get['categorySub'];
              $idCt = $row_get['idCt'];
          ?>

              <!-- ID -->
              <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4">
                <center>
                  <h3 for="exampleInputTEXT1">Item ID : <?php echo $itemCode; ?></h3>
                </center>
              </div>
              <!-- Item name -->
              <div class="col-12 col-sm-11 col-md-6 col-lg-3 col-xl-3">
                <label for="exampleInputTEXT1">Item name</label>
                <input type="text" class="form-control" name="item" id="item" placeholder="Samsung TV 24 inc" oninvalid="this.setCustomValidity('Please Enter Item')" oninput="setCustomValidity('')" required value="<?php echo $itemName ?>">
              </div>
              <!-- quantity -->
              <div class="col-12 col-sm-11 col-md-6 col-lg-1 col-xl-1">
                <label for="exampleInputTEXT1">Quantity</label>
                <input type="number" class="form-control" name="quantity" id="quantity" placeholder="5" oninvalid="this.setCustomValidity('Please Enter Quantity')" oninput="setCustomValidity('')" required value="<?php echo $quantity ?>">
              </div>
              <!-- Unit Price -->
              <div class="col-12 col-sm-11 col-md-6 col-lg-1 col-xl-1">
                <label for="exampleInputTEXT1">Unit Price</label>
                <input type="text" class="form-control" name="price" id="price" placeholder="1000" oninvalid="this.setCustomValidity('Please Enter Unit Price')" oninput="setCustomValidity('')" required value="<?php echo $unitPrice ?>">
              </div>
              <!-- Catagory -->
              <div class="col-12 col-sm-11 col-md-6 col-lg-2 col-xl-2 mt-4">
                <center>
                  <label for="exampleInputTEXT1">Catagory</label>
                  <select disabled required name="Catagory" id="Catagory" class="dropdown"
                    style="padding: 10px; border-radius: 5px; background-color: #343a40; color: white; border: 1px solid #ced4da;" onchange="FetchStream(this.value)" oninvalid="this.setCustomValidity('Please Select Catagory')" oninput="setCustomValidity('')" required>

                    <option value="">Select Catagory</option>
                    <?php
                    require_once './config.php';
                    $sql_ct = "SELECT DISTINCT(category) FROM `category` ORDER BY timeStamp DESC;";
                    $result_ct = mysqli_query($Connector, $sql_ct);
                    while ($row = mysqli_fetch_array($result_ct)) {
                      $category1 = $row['category'];
                    ?>
                      <option value="<?php echo $category1; ?>" <?php if ($category1 == $category) {
                                                                  echo $stat;
                                                                } ?>><?php echo $category1; ?></option>
                    <?php
                    }
                    ?>
                  </select>

                </center>
              </div>
              <!-- Catagory sub -->
              <div class="col-12 col-sm-11 col-md-6 col-lg-3 col-xl-3 mt-4">
                <center>
                  <label for="exampleInputTEXT1">Sub Catagory</label>
                  <select required name="subCatagory" id="subCatagory" class="dropdown"
                    style="padding: 10px; border-radius: 5px; background-color: #343a40; color: white; border: 1px solid #ced4da;" oninvalid="this.setCustomValidity('Please Sub Catagory')" oninput="setCustomValidity('')" required>

                    <?php
                    require_once './config.php';
                    $sql_subCt = "SELECT * FROM `category` WHERE `category`='$category';";
                    $result_subCt = mysqli_query($Connector, $sql_subCt);
                    while ($row = mysqli_fetch_array($result_subCt)) {
                      $idCt1 = $row['idCt'];
                      $subCategory1 = $row['categorySub'];
                    ?>
                      <option value="<?php echo $idCt1; ?>" <?php if ($idCt1 == $idCt) {
                                                              echo $stat;
                                                            } ?>><?php echo $subCategory1; ?></option>
                    <?php
                    }
                    ?>
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
                text: 'Item not found!'
            }).then(function() {
                window.location.href = './item.php';
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
          </tr>
        </thead>
        <tbody>
          <?php
          require_once './config.php';

          $sql = "SELECT b.billNo, b.timeStamp AS date, CONCAT(c.firstName, ' ', c.lastName) AS customer, c.id,c.district, COUNT(b.itemCode) AS itemCount, SUM(b.netPrice) AS netAmount FROM bill b JOIN customers c ON b.id = c.id JOIN items i ON b.itemCode = i.itemCode WHERE i.itemCode ='$itemCode' GROUP BY b.billNo, b.timeStamp, c.firstName, c.lastName, c.district ORDER BY b.timeStamp DESC;";
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

  <!-- Dynamic drop-down script -->
  <script type="text/javascript">
    function FetchStream(name) {
      $('#subCatagory').html('');
      $.ajax({
        type: 'post',
        url: './lib/ajaxdata.php',
        data: {
          Catagory_name: name
        },
        success: function(data) {
          $('#subCatagory').html(data);
        }

      })
    }
  </script>
</body>

</html>