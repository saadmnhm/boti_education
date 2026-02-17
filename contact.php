<?php
// session_start();

header('Content-Type: application/json; charset=utf-8');

error_reporting(0);
ini_set('display_errors', 0);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
    exit;
}

if (($_POST['op'] ?? '') !== 'enjoyia_contact') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid operation'
    ]);
    exit;
}

if (!empty($_POST['website'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Spam detected'
    ]);
    exit;
}

$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$lastSubmit = $_SESSION['last_submit_' . md5($ip)] ?? 0;
if (time() - $lastSubmit < 30) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Veuillez attendre 30 secondes entre chaque soumission'
    ]);
    exit;
}
$_SESSION['last_submit_' . md5($ip)] = time();

$ecole = trim($_POST['etablissement'] ?? '');
$ville = trim($_POST['ville'] ?? '');
$nom = trim($_POST['nom'] ?? '');
$fonction = trim($_POST['fonction'] ?? '');
$email = trim($_POST['email'] ?? '');
$countryCode = trim($_POST['country_code'] ?? '+212');
$tel = trim($_POST['telephone'] ?? '');
$eleve_count = trim($_POST['nombre_eleve'] ?? '');
$comment = trim($_POST['message'] ?? '');

if (empty($ecole) || empty($nom) || empty($tel) || empty($email)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Champs obligatoires manquants'
    ]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Adresse email invalide'
    ]);
    exit;
}

$emailDomain = substr(strrchr($email, "@"), 1);
if (!checkdnsrr($emailDomain, 'MX')) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Domaine email invalide'
    ]);
    exit;
}

$fullPhone = $countryCode . $tel;

$payload = [
    "ecole" => $ecole,
    "ville" => $ville,
    "nom" => $nom,
    "fonction" => $fonction,
    "email" => $email,
    "tel" => $fullPhone,
    "nombre" => $eleve_count,
    "comment" => $comment ?: "Demande d'inscription à Boti Education",
    "type" => "boti_education",
];

$apiUrl = "https://boti.education/ncsm/api/saveQuotationSite";

$ch = curl_init($apiUrl);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($payload),
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Accept: application/json'
    ],
    CURLOPT_TIMEOUT => 15,
    CURLOPT_SSL_VERIFYPEER => true,
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($curlError) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Erreur de connexion au serveur',
        'details' => $curlError
    ]);
    exit;
}

if ($httpCode >= 200 && $httpCode < 300) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Votre demande a été envoyée avec succès'
    ]);
    exit;
}

$apiResponse = json_decode($response, true);
echo json_encode([
    'status' => 'error',
    'message' => 'Erreur lors de l\'envoi de la demande',
    'api_code' => $httpCode,
    'api_response' => $apiResponse ?: $response,
    'payload_sent' => $payload
]);
exit;
