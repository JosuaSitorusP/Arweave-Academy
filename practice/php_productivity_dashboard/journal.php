<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('INSERT INTO journal_entries (entry) VALUES (:entry)');
    $stmt->execute([':entry' => $_POST['entry'] ?? '']);
}

$entries = $pdo->query('SELECT * FROM journal_entries ORDER BY created_at DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Journal</title>
</head>
<body>
    <h1>Journal</h1>
    <form method="post">
        <textarea name="entry" rows="4" cols="50" placeholder="Write something..." required></textarea>
        <br>
        <button type="submit">Save Entry</button>
    </form>
    <?php foreach ($entries as $entry): ?>
        <div>
            <strong><?php echo htmlspecialchars($entry['created_at']); ?></strong>
            <p><?php echo nl2br(htmlspecialchars($entry['entry'])); ?></p>
        </div>
        <hr>
    <?php endforeach; ?>
    <p><a href="index.php">Back to Dashboard</a></p>
</body>
</html>
