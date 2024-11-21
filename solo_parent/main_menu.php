<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Menu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            display: flex;
            justify-content: center; /* Horizontally centers content */
            align-items: center; /* Vertically centers content */
            height: 100vh; /* Full viewport height */
            margin: 0;
        }
        .custom-button {
            border-radius: 10px;
            font-size: 18px; /* Adjust text size */
            padding: 15px 30px; /* Add padding for a larger button */
            font-weight: bold; /* Make text bold */
            letter-spacing: 1px; /* Add space between letters */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add shadow */
            transition: box-shadow 0.3s ease; /* Smooth shadow transition */
            width: 300px; /* Set the width to be the same for both buttons */
            height: 80px; /* Set the height to be the same for both buttons */
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center; /* Center text inside the button */
        }
        .custom-button .btn-text {
            color: #fff;
            text-transform: uppercase; /* Uppercase text */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* Add shadow to text */
        }
        .btn-primary {
            background-color: #007bff; /* Custom primary color */
            border-color: #007bff; /* Border color */
        }
        .btn-secondary {
            background-color: #6c757d; /* Custom secondary color */
            border-color: #6c757d; /* Border color */
        }
        .btn:hover {
            opacity: 0.9; /* Add hover effect */
        }
        .custom-button:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Darker shadow on hover */
        }
    </style>
</head>
<body>
    <div class="text-center">
        <a href="index.php" class="text-decoration-none">
            <button class="btn btn-primary custom-button mb-3">
                <span class="btn-text">SOLO PARENT FORM</span>
            </button>
        </a>
        <br>
        <a href="./form/registered.php" class="text-decoration-none">
            <button class="btn btn-secondary custom-button">
                <span class="btn-text">Paternal Abilities<br>Registration Form</span>
            </button>
        </a>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
