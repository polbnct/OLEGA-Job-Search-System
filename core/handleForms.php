<?php  

require_once 'dbConfig.php';
require_once 'models.php';


if (isset($_POST['insertUserBtn'])) {
	$insertUser = insertNewUser($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['user_name'], $_POST['age'], $_POST['email'], $_POST['specialty']);

	if ($insertUser) {
		$_SESSION['message'] = "Successfully inserted!";
		header("Location: ../index.php");
	}
}


if (isset($_POST['editUserBtn'])) {
	$editUser = editUser($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['user_name'], $_POST['age'], $_POST['email'], $_POST['specialty'], $_GET['user_id']);

	if ($editUser) {
		$_SESSION['message'] = "Successfully edited!";
		header("Location: ../index.php");
	}
}

if (isset($_POST['deleteUserBtn'])) {
	$deleteUser = deleteUser($pdo,$_GET['user_id']);

	if ($deleteUser) {
		$_SESSION['message'] = "Successfully deleted!";
		header("Location: ../index.php");
	}
}

if (isset($_GET['searchBtn'])) {
	$searchForAUser = searchForAUser($pdo, $_GET['searchInput']);
	foreach ($searchForAUser as $row) {
		echo "<tr> 
				<td>{$row['first_name']}</td>
				<td>{$row['last_name']}</td>
				<td>{$row['user_id']}</td>
				<td>{$row['user_name']}</td>
				<td>{$row['age']}</td>
				<td>{$row['email']}</td>
				<td>{$row['specialty']}</td>
			  </tr>";
	}
}

?>