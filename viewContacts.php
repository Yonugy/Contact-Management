<?php
// Initialize the input value from the URL if available
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['search'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>

    <style>
        main{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            padding: 10px;
            gap: 20px;
        }

        div{
            background-color: #efd3a9;
            width: 300px;
            height: 450px;
            padding: 10px;
            border-radius: 10px;
        }

        div button{
            border-radius: 10%;
        }

        img{
            height:80px;
        }

    </style>
</head>
<body>
    <a href="addNewContact.php">Add New Contact</a><br><br>
    <form method="POST" action="">
        Search:
        <input type="text" name="search">
        <button type="submit" name="searchBtn">Search</button>
    </form>

    <main>
    <?php
        include("conn.php");
        if (!empty($name)) {
            $sql = "SELECT * FROM contacts WHERE contact_name = '$name'";
        }else{
            $sql = "SELECT * FROM contacts";
        }
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
            if ($row['contact_gender']=="male"){
                $img="malepfp.png";
            }else{
                $img="femalepfp.png";
            }
            echo '<div>';
            echo "<img src=$img>";
            echo '<h3>' . $row['contact_name'] . '</h3>';
            echo '<p>Phone Number:<br>' . $row['contact_phone'] . '</p>';
            echo '<p>Email:<br>' . $row['contact_email'] . '</p>';
            echo '<p>Home Address:<br>' . $row['contact_address'] . '</p>';
            echo '<p>Relationship:<br>' . $row['contact_relationship'] . '</p>';
            echo '<p>Date of Birth:<br>' . $row['contact_dob'] . '</p>';
            echo '<form method="POST" action="">';
            echo '<button type="submit" name="deleteBtn" value="'. $row['id'] .'">Delete</button>';
            echo '<button type="button"  onclick="window.location.href=\'edit.php?id='.$row['id'] .'\'">Edit</button>';
            echo '</form>';
            echo '</div>';
        }

        if (isset($_POST['deleteBtn'])) {
            include("conn.php");
            $id = $_POST['deleteBtn'];
            $sql="DELETE FROM contacts WHERE id = $id";
            if (!mysqli_query($con,$sql)) {
            die('Error: ' . mysqli_error($con));
            }
            else {
                echo '<script>alert("Record Deleted!");
                window.location.href = "viewContacts.php";
                </script>';
            }
             mysqli_close($con);
        }
    ?>
    </main>
</body>
</html>