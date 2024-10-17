<?php

include_once(".//index_Cus.php");
require_once "./Db/connection.php";

// Create a connection
$connection = new connection();
$conn = $connection->getConnection();

// Fetch customer details based on customer_id
$sql = "SELECT * FROM customer_profile WHERE id = :customer_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':customer_id', $customer_id);
$stmt->execute();
$userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

// Initialize messages
$successMessage = "";
$errorMessage = "";

// Initialize profile variables with existing user details
$firstName = $userDetails['first_name'] ?? '';
$lastName = $userDetails['last_name'] ?? '';
$addressLine1 = $userDetails['address_line1'] ?? '';
$addressLine2 = $userDetails['address_line2'] ?? '';
$district = $userDetails['District'] ?? '';
$city = $userDetails['City'] ?? '';
$postalCode = $userDetails['postal_code'] ?? '';
$phoneNumber = $userDetails['phone_number'] ?? '';
$email = $userDetails['Email_address'] ?? ''; // Use the correct column name

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $addressLine1 = $_POST['address_line1'];
    $addressLine2 = $_POST['address_line2'];
    $district = $_POST['District'];
    $city = $_POST['City'];
    $postalCode = $_POST['postal_code'];
    $phoneNumber = $_POST['phone_number'];
    $email = $_POST['Email_address']; // Use the correct name in the form

    // Handle profile image upload
    $uploadDir = './uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Create the directory if it doesn't exist
    }

    if (isset($_FILES['Profile_image']) && $_FILES['Profile_image']['error'] == 0) {
        $imagePath = $uploadDir . basename($_FILES["Profile_image"]["name"]);
        if (!move_uploaded_file($_FILES["Profile_image"]["tmp_name"], $imagePath)) {
            $errorMessage = "Failed to upload image.";
        }
    } else {
        $imagePath = $userDetails['Profile_image'] ?? './IMAGES/user/default.jpg'; // Keep existing image if not updated
    }

    // Update profile details in the database
    $updateSql = "UPDATE customer_profile SET 
        first_name = :first_name, 
        last_name = :last_name,
        address_line1 = :address_line1,
        address_line2 = :address_line2,
        District = :District,
        City = :City,
        postal_code = :postal_code,
        phone_number = :phone_number,
        Profile_image = :Profile_image,
        Email_address = :Email_address  -- Use the correct column name
    WHERE id = :customer_id";

    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bindParam(':first_name', $firstName);
    $updateStmt->bindParam(':last_name', $lastName);
    $updateStmt->bindParam(':address_line1', $addressLine1);
    $updateStmt->bindParam(':address_line2', $addressLine2);
    $updateStmt->bindParam(':District', $district);
    $updateStmt->bindParam(':City', $city);
    $updateStmt->bindParam(':postal_code', $postalCode);
    $updateStmt->bindParam(':phone_number', $phoneNumber);
    $updateStmt->bindParam(':Profile_image', $imagePath);
    $updateStmt->bindParam(':Email_address', $email); // Bind the email correctly
    $updateStmt->bindParam(':customer_id', $customer_id);

    if ($updateStmt->execute()) {
        $successMessage = "Profile updated successfully!";
        // Refresh user details after update
        $stmt->execute();
        $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $errorMessage = "Error updating profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=".//Css//profile.css">
    <title>Customer Profile</title>
</head>
<body>

<!-- Navigation Bar -->
<div class="navbar">
    My Profile
</div>

<div class="profile-container">
    <div class="profile-card">
        <h2>Profile</h2>
        <div class="profile-img-container">
            <img class="profile-img" 
                 src="<?= isset($userDetails['Profile_image']) && !empty($userDetails['Profile_image']) ? htmlspecialchars($userDetails['Profile_image']) : './IMAGES/user/default.jpg' ?>" 
                 alt="Profile Image">
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($firstName); ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($lastName); ?>" required>
            </div>
            <div class="form-group">
                <label for="address_line1">Address Line 1</label>
                <input type="text" id="address_line1" name="address_line1" value="<?= htmlspecialchars($addressLine1); ?>" required>
            </div>
            <div class="form-group">
                <label for="address_line2">Address Line 2</label>
                <input type="text" id="address_line2" name="address_line2" value="<?= htmlspecialchars($addressLine2); ?>">
            </div>
            <div class="form-group">
                <label for="District">District</label>
                <input type="text" id="District" name="District" value="<?= htmlspecialchars($district); ?>" required>
            </div>
            <div class="form-group">
                <label for="City">City</label>
                <input type="text" id="City" name="City" value="<?= htmlspecialchars($city); ?>" required>
            </div>
            <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" id="postal_code" name="postal_code" value="<?= htmlspecialchars($postalCode); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number" value="<?= htmlspecialchars($phoneNumber); ?>" required>
            </div>
            <div class="form-group">
                <label for="Email_address">Email</label>
                <input type="email" id="Email_address" name="Email_address" value="<?= htmlspecialchars($email); ?>" required> <!-- Use the correct name -->
            </div>
            <div class="form-group">
                <label for="Profile_image">Profile Image</label>
                <input type="file" id="Profile_image" name="Profile_image" accept="image/*">
            </div>
            <button type="submit" class="btn-save">Save Changes</button>
        </form>

        <!-- Display Success or Error Message in a box below the form -->
        <div class="message-box" style="margin-top: 20px; display: <?= !empty($successMessage) || !empty($errorMessage) ? 'block' : 'none'; ?>;">
            <?php if (!empty($successMessage)) : ?>
                <div class="success">
                    <?= htmlspecialchars($successMessage); ?>
                </div>
            <?php elseif (!empty($errorMessage)) : ?>
                <div class="error">
                    <?= htmlspecialchars($errorMessage); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<h3>Your Profile Details:</h3>
<p><strong>First Name:</strong> <?= htmlspecialchars($firstName); ?></p>
<p><strong>Last Name:</strong> <?= htmlspecialchars($lastName); ?></p>
<p><strong>Address:</strong> <?= htmlspecialchars($addressLine1); ?>, <?= htmlspecialchars($addressLine2); ?>, <?= htmlspecialchars($district); ?>, <?= htmlspecialchars($city); ?>, <?= htmlspecialchars($postalCode); ?></p>
<p><strong>Phone Number:</strong> <?= htmlspecialchars($phoneNumber); ?></p>
<p><strong>Email:</strong> <?= htmlspecialchars($email); ?></p>

</body>
</html>
