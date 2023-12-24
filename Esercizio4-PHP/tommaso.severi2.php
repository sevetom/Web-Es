<?php

class DatabaseHelper {
    private $db;
    
    /**
     * Creates a new DatabaseHelper and connects to the database
     * @param $servername the server name
     * @param $username the username
     * @param $password the password
     * @param $dbname the database name
     */
    public function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if ($this->db->connect_error) {
            die("Connection failed: ". $this->db->connect_error);
        }
    }

    /**
     * Checks if the group is present in the database
     * @param $num the group index
     */
    public function isPresent($num) {
        $stmt = $this->db->prepare("SELECT insieme FROM insiemi WHERE insieme = ?");
        $stmt->bind_param("i", $num);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    /**
     * Gets the values of the group
     * @param $num the group index
     * @return array the values of the group
     */
    public function getValues($num) {
        $stmt = $this->db->prepare("SELECT valore FROM insiemi WHERE insieme = ?");
        $stmt->bind_param("i", $num);
        $stmt->execute();
        $result = $stmt->get_result();
        return array_column($result->fetch_all(MYSQLI_ASSOC), "valore");
    }

    /**
     * Inserts the values into the database
     * @param $values the values to insert
     */
    public function insertValues($values) {
        $query1 = "SELECT insieme FROM insiemi ORDER BY insieme DESC LIMIT 1";
        $stmt1 = $this->db->prepare($query1);
        $stmt1->execute();
        $groupIndex = $stmt1->get_result()->fetch_all(MYSQLI_ASSOC)[0]["insieme"] + 1;

        $query2 = "INSERT INTO insiemi (valore, insieme) VALUES (?, ?)";
        foreach ($values as $value) {
            $stmt2 = $this->db->prepare($query2);
            $stmt2->bind_param("ii", $value, $groupIndex);
            $stmt2->execute();
        }
    }
}

// connects to the database
$dbh = new DatabaseHelper("localhost", "root", "", "giugno");

// reads all the values from the URL
$A = $_GET['A'];
$B = $_GET['B'];
$O = $_GET['O'];
echo "A = $A <br>";
echo "B = $B <br>";
echo "O = $O <br>";

// checks if the values are valid
if (!is_null($A) && $A > 0 && $dbh->isPresent($A)) {
    echo "A è un insieme valido";
} else {
    echo "A non è un insieme valido";
}
echo "<br>";
if (!is_null($B) && $B > 0 && $dbh->isPresent($B)) {
    echo "B è un insieme valido";
} else {
    echo "B non è un insieme valido";
}
echo "<br>";
if (!is_null($O) && $O == "i" || $O == "u") {
    echo "O è un insieme valido";
} else {
    echo "O non è un insieme valido";
}
echo "<br>";

// gets the values from the database paired with the group index
$A_values = $dbh->getValues($A);
$B_values = $dbh->getValues($B);
echo "A = ";
print_r($A_values);
echo "<br>";
echo "B = ";
print_r($B_values);
echo "<br>";

// merges or intersects the values
$result = array();
if ($O == "i") {
    $result = array_intersect($A_values, $B_values);
} else if ($O == "u") {
    $result = array_unique(array_merge($A_values, $B_values));
}
echo "Risultato = ";
print_r($result);
echo "<br>";
// inserts the values into the database
$dbh->insertValues($result);

?>