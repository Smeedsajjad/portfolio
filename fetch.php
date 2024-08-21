<?php
include_once 'db.php';

class FetchContacts {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllContacts() {
        $query = "SELECT * FROM contacts ORDER BY created_at DESC"; // Fetch all details with latest timestamps first
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $contacts;
    }
}

$fetchContacts = new FetchContacts();
$data = $fetchContacts->getAllContacts();
header('Content-Type: application/json');
echo json_encode($data);
?>
