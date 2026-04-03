<?php
header('Content-Type: application/json');

// Načtení dat, která poslal JavaScript
$input = file_get_contents('php://input');
$request = json_decode($input, true);

// Nastav si tu STEJNÉ heslo jako máš v JavaScriptu!
$adminPassword = "UxzPO)P8Q<F"; 

if (isset($request['password']) && $request['password'] === $adminPassword) {
    // Pokud sedí heslo, vezmeme data a uložíme je do souboru data.json
    $dataToSave = json_encode($request['data'], JSON_PRETTY_PRINT);
    
    if (file_put_contents('data.json', $dataToSave) !== false) {
        echo json_encode(["success" => true, "message" => "Data uložena"]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Nelze zapsat do souboru data.json. Zkontroluj oprávnění na serveru."]);
    }
} else {
    // Špatné heslo
    http_response_code(403);
    echo json_encode(["success" => false, "message" => "Neplatné heslo"]);
}
?>