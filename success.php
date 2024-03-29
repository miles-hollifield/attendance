<?php
$title = 'Success';
require_once 'includes/header.php';
require_once 'db/conn.php';

if (isset($_POST['submit'])) {
    // extract values from the $_POST array
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $contact = $_POST['phone'];
    $specialty = $_POST['specialty'];

    $orig_file = $_FILES["avatar"]["tmp_name"];
    $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
    $target_dir = 'uploads/';
    $destination = "$target_dir$contact.$ext";
    move_uploaded_file($orig_file, $destination);

    // call function to insert and track if success or not
    $isSuccess = $crud->insertAttendees($fname, $lname, $dob, $email, $contact, $specialty, $destination);
    $specialtyName = $crud->getSpecialtyById($specialty);

    if ($isSuccess) {
        // echo success
        include 'includes/successmessage.php';
    } else {
        // echo error
        include 'includes/errormessage.php';
    }
}
?>
<!-- This prints out values that were passed to the action page using method="post" -->
<img src="<?php echo $destination; ?>" class="rounded-circle" style="width: 20%; height: 20%"><br>
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">
            <?php echo $_POST['firstname'] . ' ' . $_POST['lastname']; ?>
        </h5>
        <h6 class="card-subtitle mb-2 text-muted">
            <?php echo $specialtyName['name'];  ?>
        </h6>
        <p class="card-text">Date of Birth:
            <?php echo $_POST['dob']; ?>
        </p>
        <p class="card-text">Email Address:
            <?php echo $_POST['email']; ?>
        </p>
        <p class="card-text">Contact Number:
            <?php echo $_POST['phone']; ?>
        </p>
    </div>
</div>

<br>
<br>

<?php require_once 'includes/footer.php'; ?>