<?php
include 'Contact.php';
$contacts = [];
if (file_exists('contacts.json')) {
    $contactsData = file_get_contents('contacts.json');
    $contacts = json_decode($contactsData, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['phone'])) {
        $newContact = new Contact($_POST['name'], $_POST['phone']);
        $contacts[] = $newContact->toArray();
        file_put_contents('contacts.json', json_encode($contacts));
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Телефонный справочник</title>
</head>
<body>
    <h1>Телефонный справочник</h1>
    <form action="" method="post">
        <label for="name">Имя:</label>
        <input type="text" name="name" id="name" required>
        <label for="phone">Телефон:</label>
        <input type="text" name="phone" id="phone" required>
        <button type="submit">Добавить</button>
    </form>
    
    <h2>Список контактов:</h2>
    <ul>
        <?php foreach ($contacts as $contactData): ?>
            <?php $contact = new Contact($contactData['name'], $contactData['phone']); ?>
            <li>
                <?php echo $contact->getName(); ?>: <?php echo $contact->getPhone(); ?>
                <form action="delete.php" method="post" style="display:inline;">
                    <input type="hidden" name="name" value="<?php echo $contact->getName(); ?>">
                    <input type="hidden" name="phone" value="<?php echo $contact->getPhone(); ?>">
                    <button type="submit">Удалить</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

 
</body>
</html>
