<?php
// Simple SQLite connection and table setup
$pdo = new PDO('sqlite:' . __DIR__ . '/dashboard.db');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Habits table
$pdo->exec("CREATE TABLE IF NOT EXISTS habits (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    frequency TEXT,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP
)");

// Events table for calendar
$pdo->exec("CREATE TABLE IF NOT EXISTS events (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    event_date TEXT,
    description TEXT
)");

// Time entries for timer
$pdo->exec("CREATE TABLE IF NOT EXISTS time_entries (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    task TEXT NOT NULL,
    minutes INTEGER,
    entry_date TEXT
)");

// Goals table
$pdo->exec("CREATE TABLE IF NOT EXISTS goals (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    goal TEXT NOT NULL,
    deadline TEXT
)");

// Journal entries
$pdo->exec("CREATE TABLE IF NOT EXISTS journal_entries (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    entry TEXT NOT NULL,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP
)");

// Meetings
$pdo->exec("CREATE TABLE IF NOT EXISTS meetings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    meeting_date TEXT,
    meeting_time TEXT,
    agenda TEXT
)");
?>
