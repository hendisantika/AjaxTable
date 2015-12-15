<?php
include('db.php');

 if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!=''){
$actionfunction = $_REQUEST['actionfunction'];
  
   call_user_func($actionfunction,$_REQUEST,$con);
}
function saveData($data,$con){
  
 
   $fname = $con->real_escape_string($data['fname']);
  $lname = $con->real_escape_string($data['lname']);
  $domain = $con->real_escape_string($data['domain']);
  $email = $con->real_escape_string($data['email']);
  $sql = "insert into ajaxtable(firstname,lastname,domain,email) values('$fname','$lname','$domain','$email')";
  if($con->query($sql)){
    showData($data,$con);
  }
  else{
  echo "error";
  }
  
}
function showData($data,$con){
  $sql = "select * from ajaxtable order by id asc";
  $data = $con->query($sql);
  $str='<tr class="head"><td>Firstname</td><td>Lastname</td><td>Domain</td><td>Email</td><td></td></tr>';
  if($data->num_rows>0){
   while( $row = $data->fetch_array(MYSQLI_ASSOC)){
      $str.="<tr id='".$row['id']."'><td>".$row['firstname']."</td><td>".$row['lastname']."</td><td>".$row['domain']."</td><td>".$row['email']."</td><td><input type='button' class='ajaxedit' value='Edit'/> <input type='button' class='ajaxdelete' value='Delete'></td></tr>";
   }
   }else{
    $str .= "<td colspan='5'>No Data Available</td>";
   }
   
echo $str;   
}
function updateData($data,$con){
  $fname = $con->real_escape_string($data['fname']);
  $lname = $con->real_escape_string($data['lname']);
  $domain = $con->real_escape_string($data['domain']);
  $email = $con->real_escape_string($data['email']);
  $editid = $con->real_escape_string($data['editid']);
  $sql = "update ajaxtable set firstname='$fname',lastname='$lname',domain='$domain',email='$email' where id=$editid";
  if($con->query($sql)){
    showData($data,$con);
  }
  else{
   echo "error";
  }
  }
  function deleteData($data,$con){
    $delid = $con->real_escape_string($data['deleteid']); 
	$sql = "delete from ajaxtable where id=$delid";
	if($con->query($sql)){
	  showData($data,$con);
	}
	else{
	echo "error";
	}
  }
?>