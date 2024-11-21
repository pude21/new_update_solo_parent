<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantawid Beneficiary Form</title>
    <style>
        .hidden {
            display: none;
        }
    </style>
    <script>
        function toggleHouseholdIDField() {
            const isBeneficiary = document.querySelector('input[name="pantawid"]:checked').value;
            const householdField = document.getElementById('householdIDContainer');
            householdField.style.display = isBeneficiary === 'Yes' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <h2>Pantawid Beneficiary Form</h2>
    <form action="process_pantawid.php" method="POST">
        <!-- Pantawid Beneficiary Selection -->
        <div>
            <label><strong>Are you a Pantawid Beneficiary?</strong></label><br>
            <input type="radio" name="pantawid" value="Yes" onclick="toggleHouseholdIDField()" required> Yes<br>
            <input type="radio" name="pantawid" value="No" onclick="toggleHouseholdIDField()"> No
        </div>

        <!-- Household ID Field -->
        <div id="householdIDContainer" class="hidden" style="margin-top: 10px;">
            <label for="householdID"><strong>Household ID #:</strong></label><br>
            <input type="text" id="householdID" name="household_id" placeholder="Enter Household ID">
        </div>

        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>