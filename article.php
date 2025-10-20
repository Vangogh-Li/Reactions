<?php
include 'config.php';
$conn = new mysqli($host, $user, $pass, $db);

// --- Get the article ID from the URL ---
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT * FROM articles WHERE id = $id";
$result = $conn->query($sql);
$article = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title><?php echo htmlspecialchars($article['title']); ?> | Bronx Science Reactions</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="frontpage.css" />
  <link rel="stylesheet" href="index.css" />
  <style>
    body {
      background-color: #121212;
      color: #f1f1f1;
      font-family: "Georgia", serif;
      margin: 0;
      padding: 0;
    }

    .article-container {
      max-width: 850px;
      margin: 60px auto;
      padding: 2rem;
      background-color: #1e1e1e;
      border-radius: 16px;
      box-shadow: 0 6px 24px rgba(0,0,0,0.4);
    }

    .article-header img {
      width: 100%;
      height: 400px;
      object-fit: cover;
      border-radius: 12px;
      margin-bottom: 1.5rem;
    }

    .article-title {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
      background: linear-gradient(90deg, #f9b700, #ff6f00);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .meta {
      color: #bbb;
      font-size: 0.95rem;
      margin-bottom: 1.5rem;
    }

    .article-content {
      font-size: 1.15rem;
      line-height: 1.7;
      color: #e6e6e6;
      white-space: pre-wrap;
    }

    .back-link {
      display: inline-block;
      margin-top: 2rem;
      color: #58a6ff;
      text-decoration: none;
      transition: color 0.2s ease;
    }
    .back-link:hover {
      color: #82cfff;
    }
  </style>
</head>

<body>
  <!-- Reuse your header -->
  <header>
    <nav class="navbar">
      <div class="nav-wrapper">
        <div class="nav-left">
          <img src="images/Logo.png" alt="Bronx Science Reactions Logo" class="nav-logo">
          <span class="logo">Bronx Science Reactions</span>
        </div>
        <ul class="nav-menu">
          <li><a href="index.html">Home</a></li>
          <li><a href="About.html">About</a></li>
          <li><a href="#">Staff</a></li>
          <li><a href="#">Multi-Media</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <main class="article-container">
    <div class="article-header">
      <img src="uploads/<?php echo htmlspecialchars($article['image']); ?>" 
           alt="<?php echo htmlspecialchars($article['title']); ?>">
      <h1 class="article-title"><?php echo htmlspecialchars($article['title']); ?></h1>
      <p class="meta">By <?php echo htmlspecialchars($article['author']); ?> — 
         <?php echo substr($article['created_at'], 0, 10); ?></p>
    </div>

    <div class="article-content">
      <?php echo nl2br(htmlspecialchars($article['content'])); ?>
    </div>

    <a href="index.html" class="back-link">← Back to Home</a>
  </main>

  <footer style="text-align:center; margin-top:20px; color:#888;">
    © 2025 @ Bxsci Reactions. All rights reserved.
  </footer>
</body>
</html>
