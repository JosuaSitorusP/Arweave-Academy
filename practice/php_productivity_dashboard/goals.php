<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('INSERT INTO goals (goal, deadline) VALUES (:goal, :deadline)');
    $stmt->execute([
        ':goal' => $_POST['goal'] ?? '',
        ':deadline' => $_POST['deadline'] ?? ''
    ]);
}

$goals = $pdo->query('SELECT * FROM goals ORDER BY deadline')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Goals</title>
</head>
<body>
    <h1>Goals</h1>
    <form method="post">
        <input type="text" name="goal" placeholder="Goal" required>
        <input type="date" name="deadline">
        <button type="submit">Add Goal</button>
    </form>
    <ul>
        <?php foreach ($goals as $goal): ?>
            <li><?php echo htmlspecialchars($goal['goal']); ?> <?php if($goal['deadline']) echo '- ' . htmlspecialchars($goal['deadline']); ?></li>
        <?php endforeach; ?>
    </ul>
    <p><a href="index.php">Back to Dashboard</a></p>
</body>
</html>
