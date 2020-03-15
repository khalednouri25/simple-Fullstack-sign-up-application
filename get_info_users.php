<?php

	header("Content-Type", "application/json");
	$data=json_decode(file_get_contents("php://input"));
	$con=mysqli_connect("localhost", "root","","MyDataBase");
	if($con->connect_error) // should be mysqli_connect_errno()
		die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
	/*check if email eixsts in the database*/
	$res=mysqli_query($con, "select * from users where email='".$data->email."'");

	$result=array();
	if(mysqli_num_rows($res)>0){
		$result=['id'=>-1];
	}
	else{
		/*insert data in the database */
	$sql="insert into users (firstName, familyName, email,password) values
	 ('$data->first_name','$data->family_name','$data->email','$data->password')";

	 
	 if(mysqli_query($con,$sql)){
		$result=['id'=>1];
	 
	}
	else
	{
		$result=['id'=>-2];
	}


	}
	echo json_encode($result);

	mysqli_close($con);
?>
