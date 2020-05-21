<?php 
// connect to database again

include('./config/db_connection.php');

// whenever it's loaded it shows empty value
$name = $email = $subject = $message = '';
// if submit button pressed all array variable updated
$errors = array('name'=>'', 'email'=> '', 'subject'=>'', 'message'=>'');

// global array variable
// ehenever the submit button is pressed, condition check
if(isset($_POST['submit']))
// echo htmlspecialchars($_POST['email']);
// echo htmlspecialchars($_POST['title']);
// echo htmlspecialchars($_POST['content']);

// check email
if(empty($_POST['email'])){
   
    $errors['email']='An email is required <br>';
}else{
    $email = $_POST['email'];
    // builtin email validation
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        // echo 'email must be a vaild email address';
        $errors['email']='An email must be a valid address'; 
    }
}
// check name
if(empty($_POST['name'])){
    // echo 'An name is required <br>';
    $errors['name']='A name is required <br>';
}else{
    $name = $_POST['name'];
//    Regular Expression:Regex
    if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
        // echo 'name must be letters and space only ';
        $errors['name']='Name must be letters and spaces only';
    }
}
// check subject
if(empty($_POST['subject'])){
    $errors['subject']='A subject is required <br>';
} else {
    $subject = $_POST['subject'];
    if(!preg_match('/^[a-zA-Z\s]+$/', $subject)) {
        $errors['subject']='Subject must be letters and spaces only';
    }
}

// check message
if(empty($_POST['message'])){
    // echo 'An content is required <br>';
    $errors['content']='A message is required <br>';
}else{
    $message = $_POST['message'];
//    Regular Expression:Regex
    if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $message)){
        // echo 'Content must be comma separated ';
        $errors['message']='Message must be comma separated';
    }
}
if(array_filter($errors)){
    // echo 'error is the form';
}else{
// import ino ou database
$email = mysqli_real_escape_string($conn, $_POST['email']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

// create sql
$sql = "INSERT INTO contact(name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";


// save to db and check
if(mysqli_query($conn, $sql)){
    // successful
    header('Location:contact.html');
}else{
    // error
    echo 'Query error' . mysqli_error($conn);
}
}
// XSS(Cross Site Scripting)
?>