<?php
// Include the database connection file
include('dbI.php');

$success_message = "";
$error_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure that user_name and password are set before using them
    $hospital = $_POST['hospital'];
    $equipment_name = $_POST['equipment_name'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $serial_no = $_POST['serial_no'];
    $inventory_no = $_POST['inventory_no'];
    $date_Installation = $_POST['date_Installation'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $agreement = $_POST['agreement'];
    $astart_date = $_POST['astart_date'];
    $aend_date = $_POST['aend_date'];
    $value_equipment = $_POST['value_equipment'];
    $supplier_name = $_POST['supplier_name'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];

     // Insert user data into the database
        $sql = "INSERT INTO form(hospital,equipment_name,make,model,serial_no,inventory_no,date_Installation,start_date,end_date ,agreement,astart_date,aend_date,value_equipment,supplier_name,address,contact_no) 
        VALUES ('$hospital', '$equipment_name ',' $make ',' $model','$serial_no ',' $inventory_no','$date_Installation','$start_date','$end_date ',' $agreement','$astart_date',' $aend_date','$value_equipment',' $supplier_name','$address','$contact_no ')";

        if ($conn->query($sql) === TRUE) {
            $success_message = "Data pass successful!";
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $error_message = "Data not insert.";
    }
    // Close the database connection
    $conn->close();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hospital Details Form</title>
    <link rel="stylesheet" href="style.css" />
<style>
        /* Style the success and error messages */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color:white;
            color: white;
            border-radius: 5px;
            font-size: 18px;
            z-index: 1000;
        }

        .popup-error {
            background-color: #dc3545;
        }

        .popup-button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #ffffff;
            color: #333;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <section class="container">
        <header><u><b>Form</b></u></header>
         <form action="index.php" method="POST" class="form">
            <div class="form-container">
                <!-- Left Section: Hospital & Equipment Details -->
                <div class="left-section">
                    <div class="input-box">
                        <label>Hospital :</label>
                        <select id="hospital" name="hospital" required>
                            <option value="">Select a Hospital</option>
                            <option value="city_hospital">Anuradhapura Hospital</option>
                            <option value="green_health">Thalawa Hospital</option>
                            <option value="sunrise_medical">Thabuttegama Hospital</option>
                            <option value="metro_hospital">Rjangane Hospital</option>
                        </select>
                    </div>

                    <label><u>Equipment Details</u></label>
                    <div class="input-box">
                        <label>Equipment Name :</label>
                        <input type="text" name="equipment_name" placeholder="Enter Equipment Name" required />
                    </div>

                    <div class="column">
                        <div class="input-box">
                            <label>Make :</label>
                            <input type="text" name="make" placeholder="Enter Make" required />
                        </div>
                        <div class="input-box">
                            <label>Model :</label>
                            <input type="text" name="model" placeholder="Enter Model" required />
                        </div>
                    </div>

                    <div class="input-box">
                        <label>Serial No :</label>
                        <input type="text" name="serial_no" placeholder="Enter Serial No" required />
                    </div>

                    <div class="input-box">
                        <label>Inventory No :</label>
                        <input type="text" name="inventory_no" placeholder="Enter Inventory No" required />
                    </div>

                    <div class="column">
                        <div class="input-box">
                            <label>Date of Installation :</label>
                            <input type="date" name="date_Installation" required />
                        </div>
                        <div class="input-box">
                            <label>Warranty Period </label>
                            <label>Start Date :</label>
                            <input type="date" name="start_date" required />
                            <label>End Date :</label>
                            <input type="date" name="end_date" required />
                        </div>

                    </div>
                </div>

                <!-- Right Section: Service Agreement & Supplier Details -->
                <div class="right-section">
                    <label><u>Service Agreement Details</u></label>
                    <div class="column">
                        <div class="input-box">
                            <label>Agreement :</label>
                            <input type="text" name="agreement" placeholder="Enter Agreement" required />
                        </div>
                        <div class="input-box">
                            <label>Period :</label>
                              <label>Start Date :</label>
                            <input type="date" name="astart_date" required />
                            <label>End Date :</label>
                              <input type="date" name="aend_date" required />
                        </div>
                    </div>

                    <div class="input-box">
                        <label>Value of Equipment :</label>
                        <input type="text" name="value_equipment" placeholder="Enter Value of Equipment" required />
                    </div>

                    <label><u>Supplier Details</u></label>
                    <div class="input-box">
                        <label>Supplier Name :</label>
                        <input type="text" name="supplier_name" placeholder="Enter Supplier Name" required />
                    </div>

                    <div class="input-box">
                        <label>Address :</label>
                        <input type="text" name="address" placeholder="Enter Supplier Address" required />
                    </div>

                    <div class="input-box">
                        <label>Contact No :</label>
                        <input type="text" name="contact_no" placeholder="Enter Contact Number" required />

                    </div>
                    <button>Submit</button>
                    
                </div>

            </div>
             <button onclick="history.back()">Go Back</button>


           
        </form>

        <?php if ($success_message): ?>
        <div id="popup-success" class="popup"><?php echo $success_message; ?>
            <button class="popup-button" onclick="index.">Close</button>
        </div>
    <?php endif; ?>

    <?php if ($error_message): ?>
        <div id="popup-error" class="popup popup-error"><?php echo $error_message; ?>
            <button class="popup-button" onclick="closePopup('popup-error')">Close</button>
        </div>
    <?php endif; ?>

    <script>
        // Show popup based on the PHP message
        window.onload = function() {
            <?php if ($success_message): ?>
                document.getElementById('popup-success').style.display = 'block';
            <?php endif; ?>

            <?php if ($error_message): ?>
                document.getElementById('popup-error').style.display = 'block';
            <?php endif; ?>
        };

        // Close the popup
        function closePopup(id) {
            document.getElementById(id).style.display = 'none';
        }
    </script>


</body>
</html>
