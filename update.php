<?php
include 'db_connect.php';

if (isset($_POST['update'])) {
    $id           = $_POST['id'];
    $name         = $_POST['name'];
    $enrollment   = $_POST['enrollment_no'];
    $email        = $_POST['email'];
    $dob          = $_POST['dob'];
    $hobbies      = $_POST['hobbies'];

    // Use prepared statement for security
    $stmt = $conn->prepare("UPDATE form_data SET name = ?, enrollment_no = ?, email = ?, dob = ?, hobbies = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $name, $enrollment, $email, $dob, $hobbies, $id);

    echo "<style>
            body { font-family: Arial; background: #eef2f7; padding: 30px; }
            .alert {
                max-width: 500px; margin: auto; padding: 15px; border-radius: 8px; text-align: center;
                box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            }
            .success { background: #d4edda; color: #155724; }
            .error { background: #f8d7da; color: #721c24; }
          </style>";

    if ($stmt->execute()) {
        echo "<div class='alert success'>✅ Student updated successfully!</div>";
    } else {
        echo "<div class='alert error'>❌ Error updating record: " . $conn->error . "</div>";
    }

    $stmt->close();
}
$conn->close();
?>
