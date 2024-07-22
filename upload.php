<?php
// Handle file upload
$image_path = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $max_size = 5 * 1024 * 1024; // 5 MB

    if (in_array($_FILES['image']['type'], $allowed_types) && $_FILES['image']['size'] <= $max_size) {
        $upload_dir = 'uploads/';
        $upload_file = $upload_dir . basename($_FILES['image']['name']);
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
            $image_path = $upload_file;
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "Invalid file type or file size too large.";
    }
}
?>