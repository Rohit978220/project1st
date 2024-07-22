<?php
// submit_post.php
include 'db.php';

$title = $_POST['title'];
$content = $_POST['content'];

$stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
$stmt->bind_param("ss", $title, $content);

if ($stmt->execute()) {
    echo "Blog post added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
