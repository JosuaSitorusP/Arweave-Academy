<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('INSERT INTO meetings (title, meeting_date, meeting_time, agenda) VALUES (:title, :meeting_date, :meeting_time, :agenda)');
    $stmt->execute([
        ':title' => $_POST['title'] ?? '',
        ':meeting_date' => $_POST['meeting_date'] ?? '',
        ':meeting_time' => $_POST['meeting_time'] ?? '',
        ':agenda' => $_POST['agenda'] ?? ''
    ]);
}

$meetings = $pdo->query('SELECT * FROM meetings ORDER BY meeting_date, meeting_time')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Meetings</title>
</head>
<body>
    <h1>Meetings</h1>
    <form method="post">
        <input type="text" name="title" placeholder="Title" required>
        <input type="date" name="meeting_date" required>
        <input type="time" name="meeting_time" required>
        <input type="text" name="agenda" placeholder="Agenda">
        <button type="submit">Schedule Meeting</button>
    </form>
    <ul>
        <?php foreach ($meetings as $meeting): ?>
            <li><?php echo htmlspecialchars($meeting['meeting_date']); ?> <?php echo htmlspecialchars($meeting['meeting_time']); ?> - <?php echo htmlspecialchars($meeting['title']); ?>: <?php echo htmlspecialchars($meeting['agenda']); ?></li>
        <?php endforeach; ?>
    </ul>
    <p><a href="index.php">Back to Dashboard</a></p>
</body>
</html>
