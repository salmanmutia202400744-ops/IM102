<?php
require_once 'config.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $course = $conn->real_escape_string($_POST['course']);
    $year = (int)$_POST['year'];
    

    if (empty($name) || empty($course) || empty($year) || empty($email) || empty($phone)|| empty($address)) {
        $message = '<p style="color:red;">All fields are required.</p>';
    } else {
        $sql = "INSERT INTO students (name, course, year, email, phone, address) 
        VALUES ('$name', '$course', '$year', '$email','$phone', '$address')";
        
        if ($conn->query($sql)) {
            echo '<p style="color:green; font-size:1.2em;">Student added! 
Redirecting...</p>';
 header('Refresh: 2; URL=index.php');
            exit;
            
        } else {
            $message = '<p style="color:red;">Error: ' . $conn->error . '</p>';
        }
    }
}

?>
 <!DOCTYPE html>
 <html>
 <head>
 <title>Add Student</title>
 <style>
 body { font-family: Arial; margin: 20px; }
 .container { max-width: 500px; margin: 0 auto; background: white; 
padding: 25px; border-radius: 8px; }
 label { display: block; margin: 10px 0 5px; font-weight: bold; }
 input, select {
 width: 100%;
 padding: 10px;
 border: 1px solid #ddd;
 border-radius: 4px;
 box-sizing: border-box;
 }
 button {
 margin-top: 15px;
 padding: 12px 30px;
 background: #4CAF50;
 color: white;
 border: none;
 border-radius: 4px;
 cursor: pointer;
 font-size: 1em;
 }
 button:hover { background: #45a049; }
 .cancel {
 display: inline-block;
 margin-left: 10px;
 color: #666;
 text-decoration: none;
 }
 </style>
 </head>
 <body>
 <div class="container">
 <h1>Add New Student</h1>
 <?= $message ?>
 <form method="POST">
    
 <label>Full Name</label>
<input type="text" name="name" required placeholder="e.g. Juan 
Dela Cruz">
 <label>Email</label>
<input type="text" name="email" required placeholder="e.g. sal@.gmail.com">
 <label>Phone</label>
<input type="text" name="phone" required placeholder="e.g.09123456789">
 <label>Address</label>
 <input type="text" name="address" required placeholder="e.g.Brgy. Suyop">
 <label>Course</label>
 <select name="course" required>
 <option value="">-- Select Course --</option>
 <option value="BSIT">BSIT</option>
 <option value="BSCS">BSCS</option>
 </select>
 <label>Year Level</label>
 <input type="number" name="year" min="1" max="5" required 
placeholder="1-5">

 <button type="submit">Add Student</button>
 <a href="index.php" class="cancel">Cancel</a>
 </form>
 </div>
 </body>
 </html>