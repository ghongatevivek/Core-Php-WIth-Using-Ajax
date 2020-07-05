<?php 
    $cn=mysqli_connect("localhost","root","","db_sem6");

    if(isset($_POST['btn'])){
       if(empty($_POST['id'])){
            $name=$_POST['name'];
            $mno=$_POST['mno'];
            $email=$_POST['email'];
            $address=$_POST['address'];
            $city=$_POST['city'];
            $gender=$_POST['gender'];
            $password=$_POST['password'];

            $hobbies=isset($_POST['hobbies'])?implode(",",$_POST['hobbies']):"";

            $addData=mysqli_query($cn,"INSERT INTO `tbl_stud` (`name`, `mno`, `email`, `address`, `city`, `hobbies`, `gender`, `password`) VALUES ('$name', '$mno', '$email', '$address', '$city', '$hobbies', '$gender', '$password');"); // Insert Query
            if($addData){
            $ar=array("status"=>200,"message"=>"Record Has Been Added...");
            }else{
                $ar=array("status"=>500,"message"=>mysqli_error($cn));
            }
            echo json_encode($ar);

        }else{
            $name=$_POST['name'];
            $mno=$_POST['mno'];
            $email=$_POST['email'];
            $address=$_POST['address'];
            $city=$_POST['city'];
            $student_id=$_POST['id']; 

            $hobbies=isset($_POST['hobbies'])?implode(",",$_POST['hobbies']):"";

            $updateData=mysqli_query($cn,"update `tbl_stud` set name='$name',mno='$mno',email='$email', address='$address',city='$city', hobbies='$hobbies' where student_id='$student_id'");
            if($updateData){
            $ar=array("status"=>200,"message"=>"Record Has Been Updated...");
            }else{
                $ar=array("status"=>500,"message"=>mysqli_error($cn));
            }
            echo json_encode($ar);
        }
    }

    if(isset($_GET['getall'])){
        $row=[];
        $getData=mysqli_query($cn,"select * from tbl_stud"); 
        while($data=mysqli_fetch_assoc($getData)){
            $row[]=$data;
        }
        echo json_encode(array("data"=>$row));
    }
    
    if(isset($_GET['dlt'])){
        $id=$_GET['dlt'];
        $deleteData=mysqli_query($cn,"delete from tbl_stud where student_id='$id'"); // delete Query
        if($deleteData){
            $ar=array("status"=>200);
        }else{
            $ar=array("status"=>500,"message"=>mysqli_error($cn));
        }
        echo json_encode($ar);
    }
    if(isset($_GET['edit'])){
        $id=$_GET['edit'];
        $getSingleData=mysqli_query($cn,"select * from tbl_stud where student_id='$id'"); // getdata Query
        $edit=mysqli_fetch_assoc($getSingleData);
        echo json_encode(array("data"=>$edit));
    }
?>