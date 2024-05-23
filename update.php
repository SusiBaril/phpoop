<?php

    require_once('classes/database.php');
    $con = new database();
    session_start();

    $id=$_POST['id'];
    if(empty($id)){
        $_SESSION['user'] = $result['user'];
        header('location:index.php');
    } else {
        $id = $_POST['id'];
        $row=$con->viewdata($id);
    }
    
    if(isset($_POST['Update'])){
      //Personal Information
      $user_id = $_POST['id'];
      $profile = $_POST['profile_picture'];
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $birthday = $_POST['birthday'];
      $gender = $_POST['gender'];
      $username = $_POST['user'];
      $password = $_POST['password'];
      $confirm = $_POST['c_pass'];

      //Address Information
      $street = $_POST['street'];
      $barangay = $_POST['barangay'];
      $city = $_POST['city'];
      $province = $_POST['province'];

    if($password == $confirm){
      if($con->updateUser($user_id,$firstname, $lastname, $birthday, $gender, $username, $password, $profile)){
      if($con->updateAddress($user_id,$street,$barangay,$city,$province)){
        header('location:index.php');
        exit();
      } else {
        $error = "Error Occurred while updating user address, PLease Try again.";
        echo $error;
      } 
      } else {
        $error = "Error Occurred while updating user information, Please Try again";
        echo $error;
      }
    }

    // Handle file upload
    $target_dir = "uploads/";
    $original_file_name = basename($_FILES["profile_picture"]["name"]);
    
    // NEW CODE: Initialize $new_file_name with $original_file_name
     $new_file_name = $original_file_name; 
    
    
     $target_file = $target_dir . $original_file_name;
     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
     $uploadOk = 1;
    
    // Check if file already exists and rename if necessary
    if (file_exists($target_file)) {
        // Generate a unique file name by appending a timestamp
        $new_file_name = pathinfo($original_file_name, PATHINFO_FILENAME) . '_' . time() . '.' . $imageFileType;
        $target_file = $target_dir . $new_file_name;
    } else {
        // Update $target_file with the original file name
        $target_file = $target_dir . $original_file_name;
    }

    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["profile_picture"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars($new_file_name) . " has been uploaded.";

            // Save the user data and the path to the profile picture in the database
            $profile_picture_path = 'uploads/'.$new_file_name; // Save the new file name (without directory)

            $userID = $con->updateUser($firstname, $lastname, $birthday, $sex, $email, $username, $password, $profile_picture_path);

        } else {
          // File upload failed, display error message
          echo "Sorry, there was an error uploading your file.";
      }
    }

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Page</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    .custom-container{
        width: 800px;
    }
    body{
    font-family: 'Roboto', sans-serif;
    }
  </style>

</head>
<body>

<?php include('includes/navbar.php');?>

<div class="container custom-container rounded-3 shadow my-5 p-3 px-5">
  <h3 class="text-center mt-4"> Update Form</h3>
  <form method="post">
    <!-- Personal Information -->
    <div class="card mt-4">
      <div class="card-header bg-info text-white">Personal Information</div>
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-6 col-sm-12">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" class="form-control" name="profile_picture" id="profilepicture" accept="image/*" required>
          </div>
          <div class="form-group col-md-6 col-sm-12">
            <label for="firstName">First Name:</label>
            <input type="text" class="form-control" name="firstname" id="firstName" placeholder="Firstname" value="<?php echo $row['firstname']; ?>">
          </div>
          <div class="form-group col-md-6 col-sm-12">
            <label for="lastName">Last Name:</label>
            <input type="text" class="form-control" name="lastname" id="lastName" placeholder="Lastname" value="<?php echo $row['lastname']; ?>" >
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="birthday">Birthday:</label>
            <input type="date" class="form-control" name="birthday" id="birthday" placeholder="Birthday" value="<?php echo $row['birthday']; ?>" >
          </div>
          <div class="form-group col-md-6">
            <label for="sex">Sex:</label>
            <select class="form-control" name="gender" id="gender" placeholder="Gender" >
              <option selected>Select Sex</option>
              <option value="Male"<?php if($row ['gender'] === 'Male') echo 'selected' ?>>Male</option>
              <option value="Female"<?php if($row['gender'] === 'Female') echo 'selected' ?>>Female</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" name="user" id="username" placeholder="Username" value="<?php echo $row['user']; ?>" >
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" value="<?php echo $row['password']; ?>">
        </div>
        <div class="form-group">
          <label for="password">Confirm Password:</label>
          <input type="password" class="form-control" name="c_pass" id="c_pass" placeholder="Enter password" value="<?php echo $row['password']; ?>">
        </div>
      </div>
    </div>
    
    <!-- Address Information -->
    <div class="card mt-4">
      <div class="card-header bg-info text-white">Address Information</div>
      <div class="card-body">
        <div class="form-group">
          <label for="street">Street:</label>
          <input type="text" class="form-control" name="street" id="street" placeholder="Street" value="<?php echo $row['street']; ?>" >
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="barangay">Barangay:</label>
            <input type="text" class="form-control" name="barangay" id="barangay" placeholder="Barangay" value="<?php echo $row['barangay']; ?>" >
          </div>
          <div class="form-group col-md-6">
            <label for="city">City:</label>
            <input type="text" class="form-control" name="city" id="city" placeholder="City" value="<?php echo $row['city']; ?>" >
          </div>
        </div>
        <div class="form-group">
          <label for="province">Province:</label>
          <input type="text" class="form-control" name="province" id="province" placeholder="Province" value="<?php echo $row['province']; ?>" >
        </div>
      </div>
    </div>
    
    <!-- Submit Button -->
    
    <div class="container">
    <div class="row justify-content-center gx-0">
        <div class="col-lg-3 col-md-4"> 
            <input type="hidden" name="id" value="<?php echo  $row['user_id']; ?>">
            <input type="submit" name="Update" class="btn btn-outline-primary btn-block mt-4" value="Update">
        </div>
        <div class="col-lg-3 col-md-4"> 
            <a class="btn btn-outline-danger btn-block mt-4" href="index.php">Go Back</a>
        </div>
    </div>
</div>


  </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<!-- Bootsrap JS na nagpapagana ng danger alert natin -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
