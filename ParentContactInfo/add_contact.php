<?php
    session_start();

    // Retrieve data from form
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name = filter_input(INPUT_POST, 'last_name');
    $email_address = filter_input(INPUT_POST, 'email_address');
    $phone_number = filter_input(INPUT_POST, 'phone_number');
    $student_id = filter_input(INPUT_POST, 'student_id');

    require_once("database.php"); //prevent duplicate connections

    // Validation to be added later to prevent duplicate contacts and ensure no null data

    $queryContacts = "SELECT * FROM contacts";

    $statement = $db->prepare($queryContacts);
    $statement->execute();
    $contacts = $statement->fetchAll();
    $statement->closeCursor();

    foreach ($contacts as $contact) {
        if ($email_address == $contact["emailAddress"]) {
            $_SESSION["add_error"] = "Invalid data. Duplicate Email Address. Try again.";

            $url = "add_error.php";
            header("Location: " . $url);
            die();
        }
    }

    if ($first_name == null || $last_name == null || $email_address == null ||
        $phone_number == null || $student_id == null) {
            $_SESSION["add_error"] = "Invalid contact data. Check all fields and try again.";

            $url = "add_error.php";
            header("Location: " . $url);
            die();
        }



    // Add Contact

    $query = 'INSERT INTO contacts (firstName, lastName, emailAddress, phoneNumber, dob)
        VALUES (:firstName, :lastName, :emailAddress, :phoneNumber, :dob)';

    $statement = $db->prepare($query);

    $statement->bindValue(':firstName', $first_name);
    $statement->bindValue(':lastName', $last_name);
    $statement->bindValue(':emailAddress', $email_address);
    $statement->bindValue(':phoneNumber', $phone_number);
    $statement->bindValue(':studentID', $student_id);

    $statement->execute();    
    $statement->closeCursor();


    // Redirect to the confirmation page

    $_SESSION["fullName"] = $first_name . " " . $last_name;
    $url = "add_contact_confirmation.php";
    header("Location: " . $url);
    die();

?>
