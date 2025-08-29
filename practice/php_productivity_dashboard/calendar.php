<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('INSERT INTO events (title, event_date, description) VALUES (:title, :event_date, :description)');
    $stmt->execute([
        ':title' => $_POST['title'] ?? '',
        ':event_date' => $_POST['event_date'] ?? '',
        ':description' => $_POST['description'] ?? ''
    ]);
}

$events = $pdo->query('SELECT * FROM events ORDER BY event_date')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Calendar</title>
</head>
<body>
    <h1>Calendar</h1>
    <form method="post">
        <input type="text" name="title" placeholder="Title" required>
        <input type="date" name="event_date" required>
        <input type="text" name="description" placeholder="Description">
        <button type="submit">Add Event</button>
    </form>
    <ul>
        <?php foreach ($events as $event): ?>
            <li><?php echo htmlspecialchars($event['event_date']); ?> - <?php echo htmlspecialchars($event['title']); ?>: <?php echo htmlspecialchars($event['description']); ?></li>
        <?php endforeach; ?>
    </ul>
    <p><a href="index.php">Back to Dashboard</a></p>
</body>
</html>
