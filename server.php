<?php
// This PHP block would normally be part of an error handling page
http_response_code(500);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 Internal Server Error</title>
    <style>
        /* Reset some styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            animation: fadeIn 2s ease-in-out;
        }
        .error-container {
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            padding: 50px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(50px);
            animation: slideUp 1s ease-out;
        }
        h1 {
            font-size: 80px;
            font-weight: bold;
            color: #f44336;
            animation: bounce 1s infinite alternate;
        }
        p {
            font-size: 20px;
            color: #555;
            margin-bottom: 30px;
        }
        .retry-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .retry-btn:hover {
            background-color: #d32f2f;
            transform: scale(1.1);
        }

        /* Keyframe animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
            }
            to {
                transform: translateY(0);
            }
        }

        @keyframes bounce {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(1.2);
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>500</h1>
        <p>Oops! Something went wrong on the server. Please try again later.</p>
        <button class="retry-btn" onclick="reloadPage()">Retry</button>
    </div>

    <script>
        // Function to reload the page
        function reloadPage() {
            location.reload();
        }

        // Optional: Add a redirect after a certain time
        setTimeout(function() {
            window.location.href = 'index.php'; // Redirect to the homepage or any other page
        }, 5000); // Redirect after 5 seconds
    </script>
</body>
</html>
