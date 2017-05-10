<?php
require 'bootstrap.php';
use App\Library\FacebookAuth;

if( !isset($_SESSION['facebook_access_token']) ){
	header('location:index.php');
}

$auth = new FacebookAuth;
$user_data = $auth->getUserProfile();
?>

<a href="logout.php">Logout</a>
<hr/>
<table>
	<tr>
		<th>First Name</th>
		<td><?php echo $user_data['first_name']; ?></td>
	</tr>
	<tr>
		<th>Last Name</th>
		<td><?php echo $user_data['last_name']; ?></td>
	</tr>
	<tr>
		<th>Email</th>
		<td><?php echo $user_data['email']; ?></td>
	</tr>
	<tr>
		<th>Image</th>
		<td><img src="<?php echo $user_data['picture']['url']; ?>" /></td>
	</tr>
</table>
