<?php

use function PHPSTORM_META\elementType;

require_once 'dbConfig.php';

function getAllUsers($pdo) {
	$sql = "SELECT * FROM users 
			ORDER BY user_name ASC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getUserByID($pdo, $user_id) {
	$sql = "SELECT * from users WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);

	if ($executeQuery) {
		echo "Status Code = 200";
		return $stmt->fetch();
	}
	else {
		echo "Status Code = 400";
	}
}

function searchForAUser($pdo, $searchQuery) {
	
	$sql = "SELECT * FROM users WHERE 
			CONCAT(first_name, last_name, user_name,age,email,specialty) 
			LIKE ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$searchQuery."%"]);
	if ($executeQuery) {
		echo "Status Code = 200";
		return $stmt->fetchAll();
	} else {
		echo "Status Code = 400";
	}
}



function insertNewUser($pdo, $first_name, $last_name, $user_name, $age, $email, 
	$specialty) {

	$sql = "INSERT INTO users 
			(
				first_name,
                last_name,
                user_name,
				age,
				email,
				specialty
			)
			VALUES (?,?,?,?,?,?)
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([
        $first_name, $last_name,
		$user_name, $age, $email, 
		$specialty
	]);

	if ($executeQuery) {
		echo "Status Code = 200";
		return true;
	} else {
		echo "Status Code = 400";
	}

}

function editUser($pdo, $first_name, $last_name, $user_name, $age, $email, $specialty, $user_id) {

	$sql = "UPDATE users
				SET user_name = ?,
                    first_name = ?,
                    last_name = ?,
					age = ?,
					email = ?,
					specialty = ?
				WHERE user_id = ? 
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $user_name, $age, $email, $specialty, $user_id]);

	if ($executeQuery) {
		echo "Status Code = 200";
		return true;
	} else {
		echo "Status Code = 400";
	}

}


function deleteUser($pdo, $user_id) {
	$sql = "DELETE FROM users 
			WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);

	if ($executeQuery) {
		echo "Status Code = 200";
		return true;
	} else {
		echo "Status Code = 400";
	}
}




?>