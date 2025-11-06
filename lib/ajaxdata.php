<?php
require_once '../config.php';

if (isset($_POST['Catagory_name'])) {
    $ct = $_POST['Catagory_name'];
    $query = "SELECT * FROM `category` WHERE `category`='$ct';";
    $query_run_search = mysqli_query($Connector, $query);

    if (mysqli_num_rows($query_run_search) > 0) {

        echo '<option value="">Choose...</option>';
        while ($row = mysqli_fetch_array($query_run_search)) {
            echo '<option value=' . $row['idCt'] . '>' . $row['categorySub'] . '</option>';
        }
    } else {
        echo '<option value="">No Data</option>';
    }
} elseif (isset($_POST['itemName'])) {
    $ct = $_POST['itemName'];
    $sql = "SELECT i.itemCode,i.itemName,i.quantity,i.unitPrice,i.timeStamp,c.category,c.categorySub FROM items AS i JOIN category AS c ON i.idCt = c.idCt WHERE i.itemName LIKE '%$ct%' ORDER BY i.timeStamp DESC;";
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
} elseif (isset($_POST['find_cst'])) {
    $keyword = $_POST['find_cst'];
    $query1 = "SELECT * FROM `customers` WHERE firstName LIKE '%$keyword%' OR lastName LIKE '%$keyword%' OR contact LIKE '%$keyword%';";
    $query_run_search1 = mysqli_query($Connector, $query1);

    if (mysqli_num_rows($query_run_search1) > 0) {
        $i = 0;
        while ($row = mysqli_fetch_array($query_run_search1)) {
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
    } else {
        ?>

        <tr>
            <th scope="row" colspan="6">No Users In database</th>
        </tr>
        <?php
    }
}elseif (!empty($_POST['from_date']) && !empty($_POST['to_date'])) {
    $from = mysqli_real_escape_string($Connector, $_POST['from_date']);
    $to = mysqli_real_escape_string($Connector, $_POST['to_date']);

    // Make sure both dates include full days
    $from_date = date('Y-m-d 00:00:00', strtotime($from));
    $to_date   = date('Y-m-d 23:59:59', strtotime($to));

    $sql = "
        SELECT * 
        FROM customers 
        WHERE timeStamp BETWEEN '$from_date' AND '$to_date' 
        ORDER BY timeStamp DESC;
    ";

    $result = mysqli_query($Connector, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $i++;
            $id = $row['id'];
            $title = $row['title'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $contact = $row['contact'];
            $district = $row['district'];
?>
            <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td>
                    <select name="title_<?php echo $id; ?>" id="title_<?php echo $id; ?>" class="dropdown"
                        style="padding: 10px; border-radius: 5px; background-color: #343a40; color: white; border: 1px solid #ced4da;" disabled>
                        <option value="Mr" <?php echo ($title == 'Mr') ? 'selected' : ''; ?>>Mr</option>
                        <option value="Mrs" <?php echo ($title == 'Mrs') ? 'selected' : ''; ?>>Mrs</option>
                        <option value="Miss" <?php echo ($title == 'Miss') ? 'selected' : ''; ?>>Miss</option>
                        <option value="Dr" <?php echo ($title == 'Dr') ? 'selected' : ''; ?>>Dr</option>
                    </select>
                </td>
                <td><input type="text" class="form-control bg-dark text-light" value="<?php echo $firstName; ?>" disabled></td>
                <td><input type="text" class="form-control bg-dark text-light" value="<?php echo $lastName; ?>" disabled></td>
                <td><input type="text" class="form-control bg-dark text-light" value="<?php echo $contact; ?>" disabled></td>
                <td>
                    <select name="district_<?php echo $id; ?>" id="district_<?php echo $id; ?>" class="dropdown" disabled
                        style="padding: 10px; border-radius: 5px; background-color: #343a40; color: white; border: 1px solid #ced4da;">
                        <option value="">Select District</option>
                        <?php
                        $districts = [
                            "Colombo", "Gampaha", "Kalutara", "Kandy", "Matale", "Nuwara Eliya",
                            "Galle", "Matara", "Hambantota", "Jaffna", "Kilinochchi", "Mannar", "Vavuniya",
                            "Mullaitivu", "Batticaloa", "Ampara", "Trincomalee", "Kurunegala", "Puttalam",
                            "Anuradhapura", "Polonnaruwa", "Badulla", "Monaragala", "Ratnapura", "Kegalle"
                        ];
                        foreach ($districts as $d) {
                            $selected = ($district == $d) ? 'selected' : '';
                            echo "<option value='$d' $selected>$d</option>";
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <a href="customerEdit.php?edit=<?php echo $id; ?>">
                        <button type="submit" class="btn btn-info" style="margin-right: 5px; width: 100px;">More</button>
                    </a>
                    <a href="./lib/Action.php?del=<?php echo $id; ?>">
                        <button type="button" class="btn btn-danger">Delete</button>
                    </a>
                </td>
            </tr>
<?php
        }
    } else {
        echo '<tr><th scope="row" colspan="7">No records found in this date range</th></tr>';
    }
}
 elseif (isset($_POST['from_dateItem']) && isset($_POST['to_dateItem'])) {
    $from = $_POST['from_dateItem'];
    $to = $_POST['to_dateItem'];

    $sql = "SELECT i.itemCode, i.itemName, i.quantity, i.unitPrice, i.timeStamp, 
                   c.category, c.categorySub 
            FROM items AS i 
            JOIN category AS c ON i.idCt = c.idCt  
            WHERE i.timeStamp BETWEEN '$from' AND '$to' 
            ORDER BY i.timeStamp DESC;";

    $result = mysqli_query($Connector, $sql);
    $i = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $i++;
        echo '<tr>
            <th scope="row">' . $i . '</th>
            <td>' . htmlspecialchars($row['itemName']) . '</td>
            <td>' . htmlspecialchars($row['quantity']) . '</td>
            <td>' . htmlspecialchars($row['unitPrice']) . '</td>
            <td>' . htmlspecialchars($row['category']) . '</td>
            <td>' . htmlspecialchars($row['categorySub']) . '</td>
            <td>
                <a href="itemEdit.php?edit=' . urlencode($row['itemCode']) . '">
                    <button type="button" class="btn btn-info" style="margin-right: 5px; width: 100px;">More</button>
                </a>
                <a href="./lib/Action.php?del=' . urlencode($row['itemCode']) . '">
                    <button type="button" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                            class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 
                            9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 
                            10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 
                            1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1z" />
                        </svg>
                    </button>
                </a>
            </td>
        </tr>';
    }

    if ($i < 1) {
        echo '<tr><td colspan="7" class="text-center">No items found in this date range.</td></tr>';
    }
}
