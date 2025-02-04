<?php
// Include header
include 'header.php';

// API key
$newsApiKey = 'null';

// Fetch latest news about university education in Kenya
$apiUrl = 'https://newsapi.org/v2/everything?q=university+education+kenya&language=en&sortBy=publishedAt&apiKey=' . $newsApiKey;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'User-Agent: MyNewsApp/1.0' // Replace with your application name and version
]);

$response = curl_exec($ch);
if (curl_errno($ch)) {
    $error_message = curl_error($ch);
    curl_close($ch);
    die('Error occurred while fetching news: ' . htmlspecialchars($error_message));
}

curl_close($ch);

// Check the API response
$newsData = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Education in Kenya News</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background: #007BFF;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        header h1.logo {
            margin: 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        .news-section {
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .news-container {
            margin: 20px 0;
        }

        .news-item {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .news-item h3 {
            margin: 0;
            font-size: 1.5em;
            color: #007BFF;
        }

        .news-item p.published-date {
            font-size: 0.9em;
            color: #666;
        }

        .news-image {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            border-radius: 5px;
        }

    </style>
</head>
<body>
    <header>
        <h1 class="logo">University Education News in Kenya</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="news-section">
            <h2>Latest News on University Education in Kenya</h2>
            <div class="news-container">

                <?php
                // Check if the response is valid and contains articles
                if (isset($newsData['status']) && $newsData['status'] === 'ok' && !empty($newsData['articles'])) {
                    foreach ($newsData['articles'] as $article) {
                        // Check if necessary fields exist
                        if (isset($article['title'], $article['url'], $article['publishedAt'])) {
                            echo "<div class='news-item'>";
                            echo "<h3><a href='" . htmlspecialchars($article['url']) . "' target='_blank'>" . htmlspecialchars($article['title']) . "</a></h3>";
                            echo "<p class='published-date'>Published on: " . date("F j, Y", strtotime($article['publishedAt'])) . "</p>";
                            
                            // Display description if it exists
                            if (isset($article['description'])) {
                                echo "<p>" . htmlspecialchars($article['description']) . "</p>";
                            }

                            // Display image if it exists
                            if (isset($article['urlToImage'])) {
                                echo "<img src='" . htmlspecialchars($article['urlToImage']) . "' alt='" . htmlspecialchars($article['title']) . "' class='news-image'>";
                            }

                            echo "</div>"; // Close news-item
                        }
                    }
                } else {
                    echo "<p>No articles found or an error occurred while fetching the articles.</p>";
                }
                ?>

            </div> <!-- Close news-container -->
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> University Education News. All rights reserved.</p>
    </footer>
</body>
</html>