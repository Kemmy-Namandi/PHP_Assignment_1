<?php
    require("database.php");

    $queryContacts = "SELECT * FROM contacts";

    $statement = $db->prepare($queryContacts);
    $statement->execute();
    $contacts = $statement->fetchAll();
    $statement->closeCursor();

?>

<!DOCTYPE html>

<html>

    <head>

        <title>Parent Contact List - Home</title>
        <link rel="stylesheet" type="text/css" href="css/contact.css" />

    </head>

    <body>

        <?php include("header.php"); ?>

        <main>

            <h2>Parent Contact List</h2>

            <table>

                <tr>

                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Student ID</th>

                </tr>

                <?php foreach ($contacts as $contact): ?>

                    <tr>
                        <td><?php echo htmlspecialchars($contact['firstName']); ?></td>
                        <td><?php echo htmlspecialchars($contact['lastName']); ?></td>
                        <td><?php echo htmlspecialchars($contact['emailAddress']); ?></td>
                        <td><?php echo htmlspecialchars($contact['phoneNumber']); ?></td>
                        <td><?php echo htmlspecialchars($contact['studentID']); ?></td>
                    </tr>

                <?php endforeach; ?>
           
            </table>

            <p><a href="add_contact_form.php">Add Contact</a></p>

        </main>

        <?php include("footer.php"); ?>
        
    </body>

</html>