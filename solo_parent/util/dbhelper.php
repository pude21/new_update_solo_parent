<?php

class DbHelper
{
    private $hostname = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $database = "solo_parent";
    private $conn;

    // Constructor to initialize the database connection
    public function __construct()
    {
        // Create the connection
        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->database);

        // Check connection and throw error if failed
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Destructor to close the connection
    public function __destruct()
    {
        $this->conn->close();
    }

    //insert_Id

    public function getInsertId() {
        return $this->conn->insert_id;
    }

    // Method to prepare a statement with error handling
    public function prepare($query)
    {
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            // Detailed error message if preparation fails
            die('MySQL prepare error: ' . $this->conn->error);
        }
        return $stmt;
    }

    // Method to execute a query
    public function executeQuery($query)
    {
        if ($this->conn->query($query) === false) {
            // Handle query execution failure
            die('MySQL query execution error: ' . $this->conn->error);
        }
        return true;
    }

    // Method to get all records
    public function getAllRecords($table)
    {
        $sql = "SELECT * FROM `$table`";
        $result = $this->conn->query($sql);
        if ($result === false) {
            die('MySQL query error: ' . $this->conn->error);
        }

        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    // Method to get a single record
    public function getRecord($table, $args)
    {
        $keys = array_keys($args);
        $values = array_values($args);
        $condition = [];
        for ($i = 0; $i < count($keys); $i++) {
            $condition[] = "`" . $keys[$i] . "` = '" . $values[$i] . "'";
        }
        $cond = implode(" AND ", $condition);
        $sql = "SELECT * FROM `$table` WHERE $cond";
        $query = $this->conn->query($sql);
        if ($query === false) {
            die('MySQL query error: ' . $this->conn->error);
        }
        return $query->fetch_assoc();
    }

    // Method to delete a record
    public function deleteRecord($table, $args)
    {
        $keys = array_keys($args);
        $values = array_values($args);
        $condition = [];
        for ($i = 0; $i < count($keys); $i++) {
            $condition[] = "`" . $keys[$i] . "` = '" . $values[$i] . "'";
        }
        $cond = implode(" AND ", $condition);
        $sql = "DELETE FROM `$table` WHERE $cond";
        $this->conn->query($sql);
        if ($this->conn->affected_rows === -1) {
            die('MySQL delete error: ' . $this->conn->error);
        }
        return $this->conn->affected_rows;
    }

    // Method to add a record
    public function addRecord($table, $args)
    {
        $keys = array_keys($args);
        $values = array_values($args);
        $key = implode("`, `", $keys);
        $value = implode("', '", $values);
        $sql = "INSERT INTO `$table` (`$key`) VALUES ('$value')";
        if ($this->conn->query($sql) === false) {
            die('MySQL insert error: ' . $this->conn->error);
        }
        return $this->conn->affected_rows;
    }

    // Method to update a record
    public function updateRecord($table, $args)
    {
        $keys = array_keys($args);
        $values = array_values($args);
        $condition = [];
        for ($i = 1; $i < count($keys); $i++) {
            $condition[] = "`" . $keys[$i] . "` = '" . $values[$i] . "'";
        }
        $sets = implode(", ", $condition);
        $sql = "UPDATE `$table` SET $sets WHERE `$keys[0]` = '$values[0]'";
        if ($this->conn->query($sql) === false) {
            die('MySQL update error: ' . $this->conn->error);
        }
        return $this->conn->affected_rows;
    }

    // Joining tables

    public function Joiningtables($id)
{
    $sql = "
        SELECT 
            solo_parent.id, 
            solo_parent.fullname,
            solo_parent.philsys_card_number,
            solo_parent.date_of_birth,
            solo_parent.age,
            solo_parent.place_of_birth,
            solo_parent.sex,
            solo_parent.address,
            solo_parent.civil_status,
            solo_parent.educational_attainment,
            solo_parent.occupation,
            solo_parent.religion,
            solo_parent.company_agency,
            solo_parent.monthly_income,
            solo_parent.employment_status,
            solo_parent.contact_number,
            solo_parent.email_address,
            solo_parent.pantawid_beneficiary,
            solo_parent.indigenous_person,
            solo_parent.are_you_a_migrant_worker,
            solo_parent.lgbtq,
            GROUP_CONCAT(
                CONCAT(
                    familymembers.id, '|',
                    familymembers.name, '|',
                    familymembers.sex, '|',
                    familymembers.relationship, '|',
                    familymembers.age, '|',
                    familymembers.birthdate, '|',
                    familymembers.civil_status, '|',
                    familymembers.educational_attainment, '|',
                    familymembers.occupation, '|',
                    familymembers.monthly_income
                ) 
                SEPARATOR ';'
            ) AS familymembers_data
        FROM 
            solo_parent
        LEFT JOIN 
            familymembers ON familymembers.user_id = solo_parent.id
        WHERE solo_parent.id = ?
        GROUP BY solo_parent.id;
    ";

    $stmt = $this->conn->prepare($sql);
    if ($stmt === false) {
        die('MySQL prepare error: ' . $this->conn->error);
    }

    $stmt->bind_param("i", $id);
    
    if (!$stmt->execute()) {
        die('Execute error: ' . $stmt->error);
    }
    
    $result = $stmt->get_result();
    $p_order = array();
    while ($row = $result->fetch_assoc()) {
        // Process the familymembers_data field
        if (!empty($row['familymembers_data'])) {
            // Split the semicolon-separated family members data
            $family_members = explode(';', $row['familymembers_data']);
            $family_members_details = array();

            // Loop through each family member and split by '|'
            foreach ($family_members as $member) {
                $member_details = explode('|', $member);
                // Map the details to an associative array for easier access
                $family_members_details[] = array(
                    'id' => $member_details[0],
                    'name' => $member_details[1],
                    'sex' => $member_details[2],
                    'relationship' => $member_details[3],
                    'age' => $member_details[4],
                    'birthdate' => $member_details[5],
                    'civil_status' => $member_details[6],
                    'educational_attainment' => $member_details[7],
                    'occupation' => $member_details[8],
                    'monthly_income' => $member_details[9]
                );
            }

            // Add the parsed family members to the row data
            $row['family_members'] = $family_members_details;
        }
        
        // Convert the row to an object and store it in the array
        $p_order[] = (object) $row;
    }

    $stmt->close();

    return $p_order;
}



}
?>
