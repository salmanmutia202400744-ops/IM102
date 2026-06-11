# Week 1 — Thursday Lab: Edit & Delete Students

**IM102 – Advanced Database Systems | 3 Hours | Computer Lab**

---

## Objectives

- Create an edit form that loads existing data
- Update records in the database
- Build delete with confirmation
- Add Edit/Delete links to the table

---

## Task 1: Add Edit & Delete Links (20 min)

Update `index.php` table to include an Actions column. Add a new `<th>Actions</th>` and in the data row:

```php
<td>
    <a href="edit.php?id=<?= $row['id'] ?>" 
       style="color: #2196F3; text-decoration: none; margin-right: 10px;">Edit</a>
    <a href="delete.php?id=<?= $row['id'] ?>" 
       style="color: #f44336; text-decoration: none;"
       onclick="return confirm('Delete this student?')">Delete</a>
</td>
```

---

## Task 2: Create the Edit Page (60 min)

Create `edit.php`:

```php
<?php
require_once 'config.php';

$id = (int)($_GET['id'] ?? 0);
$result = $conn->query("SELECT * FROM students WHERE id = $id");
$student = $result->fetch_assoc();

if (!$student) {
    die("Student not found.");
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $course = $conn->real_escape_string($_POST['course']);
    $year = (int)$_POST['year'];
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $phone = $conn->real_escape_string($_POST['phone'] ?? '');
    $address = $conn->real_escape_string($_POST['address'] ?? '');
    
    if (empty($name) || empty($course)) {
        $message = '<p style="color:red;">Name and course are required.</p>';
    } else {
        $sql = "UPDATE students SET 
                name='$name', course='$course', year=$year,
                email='$email', phone='$phone', address='$address'
                WHERE id=$id";
        
        if ($conn->query($sql)) {
            header('Location: index.php');
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
    <title>Edit Student</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 25px; border-radius: 8px; }
        label { display: block; margin: 10px 0 5px; font-weight: bold; }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea { resize: vertical; }
        button {
            margin-top: 15px;
            padding: 12px 30px;
            background: #2196F3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }
        button:hover { background: #1976D2; }
        .cancel { margin-left: 10px; color: #666; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Student #<?= $student['id'] ?></h1>
        
        <?= $message ?>
        
        <form method="POST">
            <label>Full Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>" required>
            
            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($student['email'] ?? '') ?>">
            
            <label>Course</label>
            <select name="course" required>
                <option value="BSIT" <?= $student['course'] == 'BSIT' ? 'selected' : '' ?>>BSIT</option>
                <option value="BSCS" <?= $student['course'] == 'BSCS' ? 'selected' : '' ?>>BSCS</option>
            </select>
            
            <label>Year Level</label>
            <input type="number" name="year" value="<?= $student['year'] ?>" min="1" max="5" required>
            
            <label>Phone</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($student['phone'] ?? '') ?>">
            
            <label>Address</label>
            <textarea name="address" rows="3"><?= htmlspecialchars($student['address'] ?? '') ?></textarea>
            
            <button type="submit">Update Student</button>
            <a href="index.php" class="cancel">Cancel</a>
        </form>
    </div>
</body>
</html>
```

**Key concept:** The form loads existing data using `$student['column']` in the `value` attributes. The `<select>` uses `selected` attribute to pre-select the current course.

---

## Task 3: Test Edit (15 min)

1. Click **Edit** on any student in index.php
2. Change the name → click **Update Student**
3. Verify the change appears in index.php
4. Click Edit again → verify the form shows the updated data
5. Try editing student ID 999 → should show "Student not found."

---

## Task 4: Create Delete Page (45 min)

Create `delete.php`:

```php
<?php
require_once 'config.php';

$id = (int)($_GET['id'] ?? 0);

// Handle the actual delete (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn->query("DELETE FROM students WHERE id = $id");
    header('Location: index.php');
    exit;
}

// Show confirmation (GET)
$result = $conn->query("SELECT name, course, year FROM students WHERE id = $id");
$student = $result->fetch_assoc();

if (!$student) {
    die("Student not found.");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Student</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .container { max-width: 450px; margin: 50px auto; background: white; padding: 30px; border-radius: 8px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .warning { color: #f44336; font-size: 1.1em; margin: 20px 0; }
        .name { font-size: 1.3em; font-weight: bold; color: #333; }
        .details { color: #666; margin: 10px 0; }
        .btn-delete { padding: 12px 30px; background: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1em; }
        .btn-delete:hover { background: #d32f2f; }
        .btn-cancel { display: inline-block; padding: 12px 30px; background: #9e9e9e; color: white; text-decoration: none; border-radius: 4px; margin-left: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete Student</h1>
        
        <p>Are you sure you want to delete:</p>
        <p class="name"><?= htmlspecialchars($student['name']) ?></p>
        <p class="details"><?= $student['course'] ?> — Year <?= $student['year'] ?></p>
        <p class="warning">This action cannot be undone.</p>
        
        <form method="POST" style="display: inline;">
            <button type="submit" class="btn-delete">Yes, Delete</button>
        </form>
        <a href="index.php" class="btn-cancel">Cancel</a>
    </div>
</body>
</html>
```

---

## Task 5: Test Delete (15 min)

1. Click **Delete** on any student
2. Should see confirmation page with student details
3. Click **Yes, Delete** → redirects to index.php
4. Verify student is gone
5. Click **Cancel** → returns to index.php without deleting

---

## Task 6: Add Confirmation to the Delete Link (10 min)

Update the delete link in `index.php` to double-confirm:

```php
<a href="delete.php?id=<?= $row['id'] ?>" 
   style="color: #f44336; text-decoration: none;"
   onclick="return confirm('Delete <?= htmlspecialchars(addslashes($row['name'])) ?>?')">Delete</a>
```

Now the browser will ask for confirmation BEFORE going to delete.php.

---

## Before You Leave

- [ ] Edit page loads student data and saves changes
- [ ] Delete page shows student info and asks for confirmation
- [ ] Edit/Delete links in index.php work
- [ ] All 4 CRUD operations are working: Create, Read, Update, Delete
