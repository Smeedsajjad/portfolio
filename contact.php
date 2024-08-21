<?php
include_once 'db.php';

class Contact {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function addContact($name, $email, $phone, $message) {
        $query = "INSERT INTO contacts (name, email, phone, message) VALUES (:name, :email, :phone, :message)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':message', $message);

        // Execute query
        return $stmt->execute();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contact = new Contact();
    $name = $_POST['your-name'];
    $email = $_POST['your-email'];
    $phone = $_POST['your-phone'];
    $message = $_POST['your-subject'];

    if ($contact->addContact($name, $email, $phone, $message)) {
        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully!']);
        header('Location: ./index.html');
        exit(); 
    }
}
?>
