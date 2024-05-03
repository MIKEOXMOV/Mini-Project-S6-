$user_id = $_GET['user_id'];

// Query the database for the user with the given user_id
$query = "SELECT * FROM users WHERE user_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// If the user exists, automatically sign them in
if ($user) {
    // Set the session variables for the user
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    // Redirect to the chat app's main page
    header('Location: chat.php');
    exit;
}
