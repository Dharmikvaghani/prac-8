<?php 
include 'db_connect.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Portal</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 20px;
      color: #333;
    }
    .container {
      max-width: 900px;
      margin: auto;
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #4f4f4f;
      margin-bottom: 20px;
    }
    input, textarea, button {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }
    button {
      background: #6c757d;
      color: white;
      cursor: pointer;
      font-weight: bold;
      border: none;
      transition: 0.3s;
    }
    button:hover { background: #5a636b; }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
    }
    th {
      background: #6c757d;
      color: white;
    }
    tr:hover {
      background-color: #f8f9fa;
    }
    .alert {
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 10px;
      text-align: center;
    }
    .success { background: #d4edda; color: #155724; }
    .error { background: #f8d7da; color: #721c24; }
  </style>
</head>
<body>
<div class="container">
  <h2>🎓 Student Registration</h2>

  <!-- Insert Form -->
  <form method="POST" action="">
    <input type="text" name="name" placeholder="Student Name" required>
    <input type="text" name="enrollment_no" placeholder="Enrollment No" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="date" name="dob" required>
    <input type="text" name="hobbies" placeholder="Hobbies">
    <button type="submit" name="addStudent">Add Student</button>
  </form>

  <?php
  // Insert new student securely
  if (isset($_POST['addStudent'])) {
      $name = $_POST['name'];
      $enrollment_no = $_POST['enrollment_no'];
      $email = $_POST['email'];
      $dob = $_POST['dob'];
      $hobbies = $_POST['hobbies'];

      $stmt = $conn->prepare("INSERT INTO form_data (name, enrollment_no, email, dob, hobbies) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("sssss", $name, $enrollment_no, $email, $dob, $hobbies);

      if ($stmt->execute()) {
          echo "<div class='alert success'>✅ Student added successfully!</div>";
          echo "<meta http-equiv='refresh' content='1'>";
      } else {
          echo "<div class='alert error'>❌ Error: " . $conn->error . "</div>";
      }
      $stmt->close();
  }
  ?>

  <!-- Show latest 5 students -->
  <h3>📋 Latest 5 Students</h3>
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Enrollment No</th>
      <th>Email</th>
      <th>DOB</th>
      <th>Hobbies</th>
      <th>Date</th>
    </tr>

    <?php
    $result = $conn->query("SELECT * FROM form_data ORDER BY date DESC LIMIT 5");
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['name']."</td>
                    <td>".$row['enrollment_no']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['dob']."</td>
                    <td>".$row['hobbies']."</td>
                    <td>".$row['date']."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No students found</td></tr>";
    }
    $conn->close();
    ?>
  </table>
</div>
</body>
</html>
