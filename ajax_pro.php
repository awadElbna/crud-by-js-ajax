<?php

include "DB.php";

// insert data into database  

if (isset($_REQUEST['submitform'])){

	$name=filter($_REQUEST['name']);
	$phone=filter($_REQUEST['phone']);
	$email=filter($_REQUEST['email']);
	$address=filter($_REQUEST['address']);

	$sql="INSERT INTO `users`(`name`, `phone`, `email`, `address`) VALUES 
	('$name','$phone','$email','$address')";

     mysqli_query($conn,$sql);
    
}

// edit user data 
if(isset($_REQUEST['editform'])){

	$query="UPDATE `users` SET  name='$_REQUEST[name]',phone='$_REQUEST[phone]',email='$_REQUEST[email]',address='$_REQUEST[address]'  WHERE id='$_REQUEST[ID]'";

	mysqli_query($conn,$query);
}

//delete row from database by id 
if (isset($_GET['DEL'])) {

	$sql = "delete  from users where id='$_GET[id]'";
	mysqli_query($conn,$sql);
		
}


// filltration function
 function   filter($inputtext){

       $text=strip_tags($inputtext);
		$text=trim($text);
		$text=htmlentities($text);


	return $text;
}

	$sql = "select * from users";
	$data= mysqli_query($conn,$sql);
	

	$c=1;
	while($row = mysqli_fetch_assoc($data)) {
		echo "
	  <tr>
		  <td>$c</td>
		  <td>$row[id]</td>
		  <td>$row[name]</td>
		  <td>$row[phone]</td>
		  <td>$row[email]</td>
		  <td>$row[address]</td>
		  <td>
              <button type='button' class='btn btn-danger' onclick=userdel('$row[id]');>delete</button>

               &nbsp;&nbsp;&nbsp;

              <button type='button' class='btn btn-success' data-toggle='modal' data-target='#edit$row[id]'>edit</button> 



              <div class='modal fade' id='edit$row[id]'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal'>
							<span aria-hidden='true'>&times;</span>
							<span class='sr-only'>Close</span>
						</button>
						<h4 class='modal-title'>add new user </h4>
					</div>
					<div class='modal-body'>
					
					<form   onsubmit='return edit_user($row[id]);'>

					<div class='form-group'>
						<label >name</label>
						<input type='text' id='edit_name$row[id]' value='$row[name]' class='form-control' >
						</div>

						<div class='form-group'>
						<label>phone</label>
						<input type='number' id='edit_phone$row[id]' value='$row[phone]' class='form-control' >
						</div>

						<div class='form-group'>
						<label>email</label>
						<input type='email' id='edit_email$row[id]' value='$row[email]' class='form-control' >
						</div> 

						<div class='form-group'>
						<label>address</label>
						<input type='text' id='edit_address$row[id]' value='$row[address]' class='form-control' >
						</div>

                         <div class='form-group'>
                        <input type='submit'  class='btn btn-success btn-block form-control' value='Save changes'>
                        </div>
                     </form>


					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
						
					</div>
				</div>
			</div>
		</div> 
           
		  </td>
	  </tr>
	";
		
		$c++;
	}





?>
