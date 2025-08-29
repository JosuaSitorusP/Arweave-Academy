<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('INSERT INTO time_entries (task, minutes, entry_date) VALUES (:task, :minutes, :entry_date)');
    $stmt->execute([
        ':task' => $_POST['task'] ?? '',
        ':minutes' => $_POST['minutes'] ?? 0,
        ':entry_date' => $_POST['entry_date'] ?? ''
    ]);
}

$entries = $pdo->query('SELECT * FROM time_entries ORDER BY entry_date DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Timer</title>
</head>
<body>
    <h1>Timer</h1>
    <form method="post">
        <input type="text" name="task" placeholder="Task" required>
        <input type="number" name="minutes" placeholder="Minutes" required>
        <input type="date" name="entry_date" required>
        <button type="submit">Log Time</button>
    </form>
    <ul>
        <?php foreach ($entries as $entry): ?>
            <li><?php echo htmlspecialchars($entry['entry_date']); ?> - <?php echo htmlspecialchars($entry['task']); ?>: <?php echo htmlspecialchars($entry['minutes']); ?> mins</li>
        <?php endforeach; ?>
    </ul>
    <p><a href="index.php">Back to Dashboard</a></p>
</body>
</html>
