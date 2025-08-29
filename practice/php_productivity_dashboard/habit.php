<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('INSERT INTO habits (name, frequency) VALUES (:name, :frequency)');
    $stmt->execute([
        ':name' => $_POST['name'] ?? '',
        ':frequency' => $_POST['frequency'] ?? ''
    ]);
}

$habits = $pdo->query('SELECT * FROM habits ORDER BY id DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Habit Tracker</title>
</head>
<body>
    <h1>Habit Tracker</h1>
    <form method="post">
        <input type="text" name="name" placeholder="Habit" required>
        <input type="text" name="frequency" placeholder="Frequency">
        <button type="submit">Add Habit</button>
    </form>
    <ul>
        <?php foreach ($habits as $habit): ?>
            <li><?php echo htmlspecialchars($habit['name']); ?> - <?php echo htmlspecialchars($habit['frequency']); ?></li>
        <?php endforeach; ?>
    </ul>
    <p><a href="index.php">Back to Dashboard</a></p>
</body>
</html>
