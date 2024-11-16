<?php
    if (isset($_POST['id'])) {
        include("conn.php");
        $sql = "UPDATE contacts SET
        contact_name='$_POST[contact_name]',
        contact_phone='$_POST[contact_phone]',
        contact_email='$_POST[contact_email]',
        contact_address='$_POST[contact_address]',
        contact_gender='$_POST[contact_gender]',
        contact_relationship='$_POST[contact_relationship]',
        contact_dob='$_POST[contact_dob]'
        WHERE id=$_POST[id];";
        if (mysqli_query($con, $sql)) {
            mysqli_close($con);
            echo "<script>alert('Record updated!');window.location.href='viewContacts.php';</script>";
        }
    } else {
        echo "<script>alert('Please choose record to edit');window.location.href='viewContacts.php';</script>";
}
