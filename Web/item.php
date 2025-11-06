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

  <!-- jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <!-- jQuery (use full version, not slim) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
  require_once './lib/idGeneratorItem.php';
  require_once './config.php';


  // create new user
  if (isset($_POST['createItem'])) {

    $newIdGenerator = new IdGenerator();
    $id = $newIdGenerator->generateUniqueItemId(); //  use -> instead of .

    $item = $_POST["item"];
    $idCt = $_POST["subCatagory"];
    $quantity = $_POST["quantity"];
    $unitPrice = $_POST["price"];


    //  Use actual form data instead of placeholders
    $query_insert = "INSERT INTO `items` (`itemCode`, `itemName`, `idCt`, `quantity`, `unitPrice`) VALUES ('$id', '$item', '$idCt', '$quantity', '$unitPrice');";

    $query_run = mysqli_query($Connector, $query_insert);

    if ($query_run) {
      echo "
                <script>
                Swal.fire(
                    'Item Created!',
                    'Item Registored Successfully.',
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
                    text: 'Failed to create Item. Please try again.'
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
            <input type="text" class="form-control" name="item" id="item" placeholder="Samsung TV 24 inc" oninvalid="this.setCustomValidity('Please Enter Item')" oninput="setCustomValidity('')" required>
          </div>
          <!-- quantity -->
          <div class="col-12 col-sm-11 col-md-6 col-lg-1 col-xl-1">
            <label for="exampleInputTEXT1">Quantity</label>
            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="5" oninvalid="this.setCustomValidity('Please Enter Quantity')" oninput="setCustomValidity('')" required>
          </div>
          <!-- Unit Price -->
          <div class="col-12 col-sm-11 col-md-6 col-lg-1 col-xl-1">
            <label for="exampleInputTEXT1">Unit Price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="1000" oninvalid="this.setCustomValidity('Please Enter Unit Price')" oninput="setCustomValidity('')" required>
          </div>
          <!-- Catagory -->
          <div class="col-12 col-sm-11 col-md-6 col-lg-2 col-xl-2 mt-4">
            <center>
              <label for="exampleInputTEXT1">Catagory</label>
              <select required name="Catagory" id="Catagory" class="dropdown"
                style="padding: 10px; border-radius: 5px; background-color: #343a40; color: white; border: 1px solid #ced4da;" onchange="FetchStream(this.value)" oninvalid="this.setCustomValidity('Please Select Catagory')" oninput="setCustomValidity('')" required>

                <option value="">Select Catagory</option>
                <?php
                require_once './config.php';
                $sql_ct = "SELECT DISTINCT(category) FROM `category` ORDER BY timeStamp DESC;";
                $result_ct = mysqli_query($Connector, $sql_ct);
                while ($row = mysqli_fetch_array($result_ct)) {
                  $category = $row['category'];
                ?>
                  <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
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
                <option value="">Select Catagory sub</option>
              </select>

            </center>
          </div>
          <!-- submit -->
          <div class="col-12 col-sm-10 col-md-10 col-lg-10 col-xl-10 mt-4">
            <center>
              <button type="submit" class="btn btn-primary" style="width: 100px;" name="createItem">Save</button>
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
        <input class="form-control mr-sm-2" type="search" placeholder="Search by Name" aria-label="Search" style="width: 50%;" required id="searchInput">
        <button class="btn btn-success my-2 my-sm-0" type="button" name="search" onclick="FetchSearch()">Search</button>
      </div>

    </div>
    <!-- date filter -->
    <div class="form-inline justify-content-center" style="margin-top: 50px;">
      <div class="form-inline">
        <input type="date" class="form-control mr-2" id="from_dateItem" name="from_dateItem">
        <input type="date" class="form-control mr-2" id="to_dateItem" name="to_dateItem">
        <button class="btn btn-success my-2 my-sm-0" type="button" onclick="FetchDate()">Search</button>
      </div>

    </div>

    <div class="container-fluid table-responsive" style="margin-top: 80px; margin-bottom: 50px;">
      <table class="table table-hover table-dark">
        <thead class="sticky-top bg-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Item Name</th>
            <th scope="col">quantity</th>
            <th scope="col">unitPrice</th>
            <th scope="col">Catagory</th>
            <th scope="col">Sub-Catagory</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="customerTableBody">
          <?php
          require_once './config.php';

          $sql = "SELECT i.itemCode,i.itemName,i.quantity,i.unitPrice,i.timeStamp,c.category,c.categorySub FROM items AS i JOIN category AS c ON i.idCt = c.idCt ORDER BY i.timeStamp DESC;";
          $result = mysqli_query($Connector, $sql);
          $i = 0;

          while ($row = mysqli_fetch_array($result)) {
            $i++;
            $itemCode = $row['itemCode'];
            $itemName = $row['itemName'];
            $quantity = $row['quantity'];
            $unitPrice = $row['unitPrice'];
            $category = $row['category'];
            $categorySub = $row['categorySub'];

            $stat = "selected";

          ?>
            <tr>
              <th scope="row"><?php echo $i; ?></th>
              <td scope="row"><?php echo $itemName; ?></td>
              <td scope="row"><?php echo $quantity; ?></td>
              <td scope="row"><?php echo $unitPrice; ?></td>
              <td scope="row"><?php echo $category; ?></td>
              <td scope="row"><?php echo $categorySub; ?></td>
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

    function FetchSearch() {
      var keyword = $('#searchInput').val();
      $.ajax({
        type: 'POST',
        url: './lib/ajaxdata.php',
        data: {
          itemName: keyword
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
      let from_date = $('#from_dateItem').val();
      let to_date = $('#to_dateItem').val();

      if (from_date === "" || to_date === "") {
        alert("Please select both From and To dates.");
        return;
      }

      $.ajax({
        url: "./lib/ajaxdata.php",
        method: "POST",
        data: {
          from_dateItem: from_date,
          to_dateItem: to_date
        },
        success: function(data) {
          $('#itemTableBody').html(data);
        }
      });
    }
  </script>

</body>

</html>