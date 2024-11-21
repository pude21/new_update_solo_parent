<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
     integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
     crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>App Form</title>
</head>
<style>
    input::placeholder {
        color: black; 
        font-family: Arial, bold;
        font-size: large;
    }
    table {
        width: 100px;
        border-collapse: collapse;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
    }
    table, th, td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }
    th, td {
        min-width: 100px;
        background-color: #f8f9fa;
    }
    th {
        background-color: #007bff;
        color: white;
        font-weight: bold;
        font-size: 1.1rem;
        text-transform: uppercase;
        padding: 12px;
        position: sticky;
        top: 0; /* Makes header sticky */
        z-index: 2; /* Ensures header is above table content */
    }
    tbody tr:nth-child(even) {
        background-color: #f2f2f2; /* Alternating row color */
    }
    tbody tr:hover {
        background-color: #e9ecef; /* Highlight on hover */
    }
    .add-btn {
        border-radius: 10px; 
        margin-bottom: 18px; 
        border: none;
        color: white;
        background-color: #28a745;
        padding: 8px 16px;
        font-weight: bold;
    }
    .add-btn:hover {
        background-color: #218838;
    }
</style>
<body>
    

<div class="container">
    <div class="text-center mb-4">
        <h3>APPLICATION FORM FOR SOLO PARENT</h3>
    </div>
    
    <div class="text-end mb-3">
        <a href="app_form.php"><button class="add-btn">Add New</button></a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Fullname</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "data_connect.php";
                $sql = "SELECT * FROM `solo_parent`";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td>
                            <a href="javascript:void(0);" onclick="toggleDetails('<?php echo $row['id']; ?>')">
                                <?php echo $row['fullname']; ?>
                            </a>
                            <div id="details-<?php echo $row['id']; ?>" style="display:none;">
                                <p><strong>Philsys Card Number:</strong> <?php echo $row['philsys_card_number']; ?></p>
                                <p><strong>Date of Birth:</strong> <?php echo $row['date_of_birth']; ?></p>
                                <p><strong>Age:</strong> <?php echo $row['age']; ?></p>
                                <p><strong>Place of Birth:</strong> <?php echo $row['place_of_birth']; ?></p>
                                <p><strong>Sex:</strong> <?php echo $row['sex']; ?></p>
                                <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
                                <p><strong>Educational Attainment:</strong> <?php echo $row['educational_attainment']; ?></p>
                                <p><strong>Civil Status:</strong> <?php echo $row['civil_status']; ?></p>
                                <p><strong>Occupation:</strong> <?php echo $row['occupation']; ?></p>
                                <p><strong>Religion:</strong> <?php echo $row['religion']; ?></p>
                                <p><strong>Company/Agency:</strong> <?php echo $row['company_agency']; ?></p>
                                <p><strong>Monthly Income:</strong> <?php echo $row['monthly_income']; ?></p>
                                <p><strong>Employment Status:</strong> <?php echo $row['employment_status']; ?></p>
                                <p><strong>Contact Number:</strong> <?php echo $row['contact_number']; ?></p>
                                <p><strong>Email Address:</strong> <?php echo $row['email_address']; ?></p>
                                <p><strong>LGBTQ+:</strong> <?php echo $row['lgbtq']; ?></p>
                                <p><strong>Migrant Worker:</strong> <?php echo $row['are_you_a_migrant_worker']; ?></p>
                                <p><strong>Pantawid Beneficiary:</strong> <?php echo $row['pantawid_beneficiary']; ?></p>
                                <p><strong>Indigenous Person:</strong> <?php echo $row['indigenous_person']; ?></p>
                            </div>
                        </td>
                        <td>
                            <a href="edit_form.php?id=<?php echo $row['id'] ?>" class="link-dark">
                                <i class="fa-solid fa-pen-to-square fs-5 me-3"></i>
                            </a>
                            <a href="delete_info.php?id=<?php echo $row['id'] ?>" class="link-dark">
                                <i class="fa-solid fa-trash fs-5"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function toggleDetails(id) {
        var details = document.getElementById('details-' + id);
        if (details.style.display === "none") {
            details.style.display = "block";
        } else {
            details.style.display = "none";
        }
    }
</script>

<br><br>

    <br>


            </form>
        </div> 
    </div> 
 
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
