<?php
require_once 'admin/connect.php';
if(ISSET($_POST['add_guest'])){
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $contactno = $_POST['contactno'];
    $checkin = $_POST['date'];
	$days = (int)$_POST['days']; // تأكد من تحويل القيمة إلى صحيح
    $extra_beds = (int)$_POST['extra_beds']; // تأكد من تحويل القيمة إلى صحيح


    $conn->query("INSERT INTO `guest` (firstname, middlename, lastname, address, contactno, days, extra_beds) VALUES ('$firstname', '$middlename', '$lastname', '$address', '$contactno', '$days', '$extra_beds')") or die(mysqli_error($conn));

    $query = $conn->query("SELECT * FROM `guest` WHERE `firstname` = '$firstname' && `lastname` = '$lastname' && `contactno` = '$contactno'") or die(mysqli_error($conn));
    $fetch = $query->fetch_array();
    $query2 = $conn->query("SELECT * FROM `transaction` WHERE `checkin` = '$checkin' && `room_id` = '$_REQUEST[room_id]' && `status` = 'Pending'") or die(mysqli_error($conn));
    $row = $query2->num_rows;
    
    if($checkin < date("Y-m-d", strtotime('+8 HOURS'))){   
        echo "<script>alert('Must be present date')</script>";
    }else{
        if($row > 0){
            echo "<div class = 'col-md-4'>
                        <label style = 'color:#ff0000;'>Not Available Date</label><br />";
                    $q_date = $conn->query("SELECT * FROM `transaction` WHERE `status` = 'Pending'") or die(mysqli_error($conn));
                    while($f_date = $q_date->fetch_array()){
                        echo "<ul>
                                <li>   
                                    <label class = 'alert-danger'>".date("M d, Y", strtotime($f_date['checkin']."+8HOURS"))."</label>  
                                </li>
                              </ul>";
                    }
            echo "</div>";
        }else{  
            if($guest_id = $fetch['guest_id']){
                $room_id = $_REQUEST['room_id'];
                // تحديث هذا الاستعلام ليشمل days و extra_beds
                $conn->query("INSERT INTO `transaction`(guest_id, room_id, status, checkin) VALUES('$guest_id', '$room_id', 'Pending', '$checkin')") or die(mysqli_error($conn));
                header("location:reply_reserve.php");
            }else{
                echo "<script>alert('Error Javascript Exception!')</script>";
            }
        }   
    }   
}   
?>
