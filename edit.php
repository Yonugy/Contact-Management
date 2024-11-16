<?php
    if (isset($_GET['id'])) {
        include("conn.php");
        $id = intval($_GET['id']);
        $result = mysqli_query($con, "SELECT * FROM contacts WHERE id=$id");
        $row = mysqli_fetch_array($result);
    } else {
        echo "<script>alert('Please choose record to edit.');window.location.href='viewContacts.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Address Book</title>
    <style>
        body{
            background-image: url("wallpaper.jpg");
            background-position: center center;
            background-size: cover;
        }

        .container{
            background-color: white;
            opacity: 0.8;
            width: 500px;
            border: 1px solid #000;
            padding: 20px;
            margin: 0 auto;
            font-size: 12pt;
        }

        input[type=text],input[type=tel],input[type=email],input[type=date],textarea,select{
            width: 90%;
            padding: 15px;
            margin-top: 5px;
            margin-bottom: 22px;
            display: inline-block;
            font-size: 15pt;
        }

        input[type=text]:valid,input[type=tel]:valid,input[type=email]:valid,input[type=date]:valid,textarea:valid,select:valid{
            background-color: #7EB77F;
        }

        input[type=text]:invalid,input[type=tel]:invalid,input[type=email]:invalid,input[type=date]:invalid,textarea:invalid,select:invalid{
            background-color: #ED7B84;
        }

        .button-container{
            display: flex;
            gap: 10px;
        }

        button{
            background-color: #959595;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            display: inline-block;
            font-size: 16px;
            transition: background-color 0.3s ease;
            border-radius: 5px;
        }

        button:hover{
            background-color: #b3b3b3;
        }
    </style>

    
</head>
<body>
    <div class="container">
        <h1>My Address Book</h1>
        <h2>Add New Contact</h2>

        <form method="post" action="update.php">
            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
            Name<br>
            <input id="contact_name" type="text" name="contact_name" value=<?php echo $row['contact_name']?> required><br>

            Phone Number<br>
            <input id="contact_phone" type="tel" name="contact_phone" value=<?php echo $row['contact_phone']?> required><br>

            Email Address<br>
            <input id="contact_email" type="email" name="contact_email" value=<?php echo $row['contact_email']?> required><br>

            Home Address<br>
            <textarea id="contact_address" name="contact_address" required><?php echo $row['contact_address']?></textarea><br>

            Gender<br>
            <input type="radio" name="contact_gender" value="male" required
            <?php if ($row['contact_gender'] == "male") {echo 'checked';} ?>>Male
            <input type="radio" name="contact_gender" value="female" required
            <?php if ($row['contact_gender'] == "female") {echo 'checked';} ?>>Female<br><br>

            Relationship<br>
            <select name="contact_relationship">
                <option value="">Please select</option>
                <option value="Family" <?php if ($row['contact_relationship']=="Family") {echo 'selected';}?>>Family</option>
                <option value="Friend" <?php if ($row['contact_relationship']=='Friend'){echo 'selected';}?>>Friend</option>
                <option value="Colleague" <?php if ($row['contact_relationship']=='Colleague'){echo 'selected';}?>>Colleague</option>
                <option value="Other" <?php if ($row['contact_relationship']=='Other'){echo 'selected';}?>>Other</option>
            </select><br>

            Date of Birth<br>
            <input type="date" name="contact_dob" value=<?php echo $row['contact_dob']?> required>

            <div class="button-container">
                <button type="submit" name="submitBtn">Submit</button>
                <button type="reset">Reset</button>
            </div>
        </form>

        
        
    </div>
    
</body>
</html>