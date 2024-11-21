<?php

include "data_connect.php";

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $philsys_card_number = $_POST['philsys_card_number'];
    $date_of_birth = $_POST['date_of_birth'];
    $age = $_POST['age'];
    $place_of_birth = $_POST['place_of_birth'];
    $sex = $_POST['sex'];
    $address = $_POST['address'];
    $civil_status = $_POST['civil_status'];
    $educational_attainment = $_POST['educational_attainment'];
    $occupation = $_POST['occupation'];
    $religion = $_POST['religion'];
    $company_agency = $_POST['company_agency'];
    $monthly_income = $_POST['monthly_income'];
    $employment_status = $_POST['employment_status'];
    $contact_number = $_POST['contact_number'];
    $email_address = $_POST['email_address'];
    $pantawid_beneficiary = $_POST['pantawid_beneficiary'];
    $indigenous_person = $_POST['indigenous_person'];
    $are_you_a_migrant_worker = $_POST['are_you_a_migrant_worker'];
    $lgbtq = $_POST['lgbtq'];

    $sql = "INSERT INTO `solo_parent`(`id`, `fullname`, `philsys_card_number`, `date_of_birth`, `age`, `place_of_birth`, `sex`, `address`, `civil_status`, `educational_attainment`, `occupation`, `religion`, `company_agency`, `monthly_income`, `employment_status`, `contact_number`, `email_address`, `pantawid_beneficiary`, `indigenous_person`, `are_you_a_migrant_worker`, `lgbtq`) 
            VALUES (NULL, '$fullname', '$philsys_card_number', '$date_of_birth', '$age', '$place_of_birth', '$sex', '$address', '$civil_status', '$educational_attainment', '$occupation', '$religion', '$company_agency', '$monthly_income', '$employment_status', '$contact_number', '$email_address', '$pantawid_beneficiary', '$indigenous_person', '$are_you_a_migrant_worker', '$lgbtq')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Get the last inserted ID
        $id = mysqli_insert_id($conn);

        // Redirect to the next page with the ID
        header("Location: app_form2.php?id=" . $id);
        exit(); // Always use exit after a header redirect
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--Bootstrap---->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
     crossorigin="anonymous">

     <!--font awesome--><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
     integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
     crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>App Form</title>
</head>
<style>
    input::placeholder {
            color: black; 
            font-family: arial,bold;
            font-size: large;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        } 
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th, td {
            min-width: 100px;
        }
</style> 
<body> 
     <nav class="navbar navbar-light justify-content-center fs-3 mb-5"></nav>

    <div class="container my-5 p-5 bg-white shadow">
        <div class="text-center mb-4">
            <h3>APPLICATION FORM FOR SOLO PARENT</h3>
        </div class="container d-flex justify-content-center">
        <h5>I. IDENTIFYING INFORMATION</h5>&nbsp;

            <form action="" method="post" stye="width:50vw; min-width:250px;">
                <div class="row">
                    <div class="col-sm-7 my-1 ">&nbsp;
                        <label  style="font-weight: bold;" class="form-label"></label>
                        <input type="text" class="form-control" name="fullname" placeholder="Fullname:" required>
                    </div>

                    <div class="col-sm-5 my-1">
                        <label style="font-weight: bold;" class="form-label"></label>
                        <input type="text" class="form-control" name="philsys_card_number" placeholder="Philsys Card Number:" required>
                    </div>
                    
                    <div class="col-sm-3 my-1">
                        <label  style="font-weight: bold;" class="form-label"></label>
                        <input type="date" class="form-control" name="date_of_birth" placeholder="Date of Birth:" required>
                    </div>
                    

                    <div class="col-sm-2 my-1">
                        <label  style="font-weight: bold;" class="form-label"></label>
                        <input type="text" class="form-control" name="age" placeholder="Age:" required>
                    </div>


                    <div class="col-sm-4 my-1">
                        <label style="font-weight: bold;" class="form-label"></label>
                        <input type="text" class="form-control" name="place_of_birth" placeholder="Place of Birth:" required>
                    </div>

                    <div style="margin-top: 28px;" class="col-sm-3 my-1">
                        <label for="sex" style="font-weight: bold;"></label> &nbsp; &nbsp;
                        <select name="sex" id="sex" class="form-select">
                            <option value="" disabled selected>Sex:</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label  style="font-weight: bold;" class="form-label"></label>
                        <input type="text" class="form-control" name="address" placeholder="Address:" required>
                    </div>

                    <div class="col-sm-7 my-1 ">
                        <label style="font-weight: bold;" class="form-label"></label>
                        <input type="text" class="form-control" name="educational_attainment" placeholder="Educational Attainment:" required>
                    </div>

                    <div class="col-sm-5 my-1 ">
                        <label style="font-weight: bold;" class="form-label"></label>
                        <input type="text" class="form-control" name="civil_status" placeholder="Civil Status:" required>
                    </div>

                    <div class="col-sm-7 my-1">
                        <label style="font-weight: bold;" class="form-label"></label>
                        <input type="text" class="form-control" name="occupation" placeholder="Occupation:" required>
                    </div>

                    <div class="col-sm-5 my-1">
                        <label style="font-weight: bold;" class="form-label"></label>
                        <input type="text" class="form-control" name="religion" placeholder="Religion:" required>
                    </div>

                    <div class="col-sm-7 my-1">
                        <label style="font-weight: bold;" class="form-label"></label>
                        <input type="text" class="form-control" name="company_agency" placeholder="Company/Agency:" required>
                    </div>

                    <div class="col-sm-5 my-1">
                        <label style="font-weight: bold;" class="form-label"></label>
                        <input type="number" class="form-control" name="monthly_income" placeholder="Monthly Income:" required>
                    </div>
                    
                    <div style="margin-top: 28px;" class="mb-4">
                        <label style="font-weight: bold;">Employment Status:</label> &nbsp; &nbsp;
                        <input type="radio" class="form-check-input" name="employment_status"
                        id="employed" value="employed">
                        <label  style="font-weight: bold;" for="employed" class="form-input-label">Employed</label>
                        &nbsp; &nbsp;
                        <input type="radio" class="form-check-input" name="employment_status"
                        id="self_employed" value="self_employed">
                        <label style="font-weight: bold;" for="self_employed" class="form-input-label">Self-Employed</label>
                        &nbsp; &nbsp;
                        <input type="radio" class="form-check-input" name="employment_status"
                        id="not_employed" value="not_employed">
                        <label style="font-weight: bold;" for="not_employed" class="form-input-label">Not-Employed</label>
                    </div>

                    <div class="col-sm-7 my-1">
                        <label  style="font-weight: bold;" class="form-label"></label>
                        <input type="number" class="form-control" name="contact_number" placeholder="Contact Number:" required>
                    </div>

                    <div class="col-sm-5 my-1">
                        <label style="font-weight: bold;" class="form-label"></label>
                        <input type="email" class="form-control" name="email_address" placeholder="Email Address:" required>
                    </div>

                    <div style="margin-top: 15px;" class="mb-4">
                        <label style="font-weight: bold;" class="form-label">LGBTQ +</label>&nbsp;
                        <input type="radio" class="form-check-input" name="lgbtq"
                        id="yes" value="yes">
                        <label style="font-weight: bold;" for="yes" class="form-input-label">Yes</label>
                        &nbsp; &nbsp;
                        <input type="radio" class="form-check-input" name="lgbtq"
                        id="no" value="no">
                        <label style="font-weight: bold;" for="no" class="form-input-label">No</label>
                    </div>

                    <div>
                        <label style="font-weight: bold;" class="form-label">Are You a Migrant Worker ?</label>&nbsp; &nbsp;
                        <input type="radio" class="form-check-input" name="are_you_a_migrant_worker"
                        id="yes" value="yes">
                        <label style="font-weight: bold;" for="yes" class="form-input-label">Yes</label>
                        &nbsp; &nbsp;
                        <input type="radio" class="form-check-input" name="are_you_a_migrant_worker"
                        id="no" value="no">
                        <label style="font-weight: bold;" for="no" class="form-input-label">No</label>
                    </div>

                    <div style="margin-top: 28px;" class="mb-4">
                        <label style="font-weight: bold;" class="form-label">Pantawid Beneficiary ?</label>&nbsp;&nbsp;
                        <input type="radio" class="form-check-input" name="pantawid_beneficiary"
                        id="yes" value="yes">
                        <label style="font-weight: bold;" for="yes" class="form-input-label">Yes</label>
                        &nbsp; &nbsp;
                        <input type="radio" class="form-check-input" name="pantawid_beneficiary"
                        id="no" value="no">
                        <label style="font-weight: bold;" for="no" class="form-input-label">No</label>
                        
                        <div class="col">
                            <label style="font-weight: bold;" class="form-label">If Yes, Household ID #</label>
                            <input type="text" class="form-control" name="pantawid_beneficiary" required>
                        </div>
                    </div>

                    <div style="margin-top: 10px;" class="mb-4">
                        <label style="font-weight: bold;" class="form-label">Indigenous Person ?</label>&nbsp; &nbsp;
                        <input type="radio" class="form-check-input" name="indigenous_person"
                        id="yes" value="yes">
                        <label style="font-weight: bold;" for="yes" class="form-input-label">Yes</label>
                        &nbsp; &nbsp;
                        <input type="radio" class="form-check-input" name="indigenous_person"
                        id="no" value="no">
                        <label style="font-weight: bold;" for="no" class="form-input-label">No</label>
                        
                        <div class="col">
                            <label style="font-weight: bold;" class="form-label">If Yes, Name of Affiliation:</label>
                            <input type="text" class="form-control" name="if_yes_house_hold_id" required>
                        </div>
                    </div>
                    <br>
                    <div style="margin-top: 10px;"class="mb-4">
                        <button type="submit" class="btn btn-success" name="submit">Next</button> 
                      
                    </div>
                    </div>
                </form>
                
        <div>

        </div>
    </div>


<!-- Bootstrap JS and dependencies (jQuery and Popper.js) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            


    <!--bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous"></script>
    
</body> 
</html> 