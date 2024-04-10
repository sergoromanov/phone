<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $contacts = [];
    if (file_exists('contacts.json')) {
        $contactsData = file_get_contents('contacts.json');
        $contacts = json_decode($contactsData, true);
    }
    foreach ($contacts as $key => $contactData) {
        if ($contactData['name'] === $name && $contactData['phone'] === $phone) {
            unset($contacts[$key]);
            break;
        }
    }
    file_put_contents('contacts.json', json_encode(array_values($contacts)));
    header('Location: index.php');
    exit;
}
?>
