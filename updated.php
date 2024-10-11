<?php
// Database connection details
$host = 'localhost';
$db = 'coffeeshop';
$user = 'root'; // your database username
$pass = ''; // your database password

// Create a connection
$conn = new mysqli($host, $user, $pass, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch menu items from the database
$sql = "SELECT * FROM menu_items";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop Menu</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            margin: 0;
            padding: 0;
            background: #f0eae4 url("https://tse2.mm.bing.net/th?id=OIP.MfP5MS6LMHD7v9o46SkycgHaHa&pid=Api&P=0&h=220");
            background-size: contain;
            color: #3e2723;
        }

        header {
            background-color: #a1887f;
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 5px solid #3e2723;
            position: relative;
        }

        .order-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #d32f2f;
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .order-button:hover {
            background-color: #100dbe;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #d4cbcb;
            border-radius: 40px;
            box-shadow: 0 4px 20px rgba(209, 12, 12, 0.1);
        }

        h1,
        h2 {
            margin: 0 0 15px;
            font-weight: normal;
            text-align: center;
        }

        .menu {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .menu-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 12px;
            border: 3px #531313;
            margin: 10px;
            border-radius: 10px;
            background-color: #a70e0ead;
            width: 150px;
        }

        .menu-item img {
            width: 100px;
            height: 100px;
            border-radius: 30px;
            margin-bottom: 5px;
        }

        .price-input {
            font-weight: bold;
            color: #0b0c0b;
            width: 40px;
            border: none;
            background: white;
            text-align: left;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #a1887f;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        @media (max-width: 600px) {
            .order-button {
                padding: 8px 12px;
                font-size: 14px;
            }

            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.5em;
            }

            h2 {
                font-size: 1.25em;
            }

            .menu-item img {
                width: 40px;
                height: 40px;
            }

            .menu-item {
                width: 100px;
                /* Adjust for mobile */
            }
        }
    </style>
</head>

<body>

    <header>
        <h1>Welcome to Our Coffee Shop</h1>
    </header>
    <div class="container">
        <h2>Menu</h2>
        <form method="POST" action="update_prices.php">
           <div class="menu">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="menu-item">
                <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>">
                <span><?php echo $row['name']; ?></span>
                <input type="number" name="prices[<?php echo $row['name']; ?>]" value="<?php echo number_format($row['price'], 2); ?>" class="price-input" step="0.01">
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No menu items found.</p>
    <?php endif; ?>
</div>


                <button type="submit" class="order-button">Update Prices</button>
        </form>
    </div>
    <footer>
        <p>Visit us for a cup of joy!</p>
    </footer>
</body>

</html>