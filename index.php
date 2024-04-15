<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Mees Catering</title>
</head>
<body>
    <?php include 'menu_functions.php'; ?>
    <div id="hero">
        <div id="hero_content">
            <h1>Mees Catering</h1>
            <h2>De catering van Vista college</h2>
        </div>
    </div>

    <div id="header">
        <nav id="navbar">
            <h1>Mees Catering</h1>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a href="adminpaneel.php">Admin</a></li>
            </ul>
        </nav>
        <div id="mobile_menu">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Menu</a></li>
                <li><a href="adminpaneel.php">Admin</a></li>
            </ul>
        </div>
    </div>

    <div id="menu">
        <h1 id="section">Menu</h1>
        <div id="menu_row">
            <!-- Broodjes -->
            <div id="menu_col">
                <h2>Broodjes</h2>
                <?php
                $broodjes = getMenuItemsByCategory('broodje');
                foreach ($broodjes as $item) {
                    echo '<div class="box">
                            <div id="image"><img src="' . htmlspecialchars($item['image_url']) . '"></div>
                            <div>
                                <h3>' . htmlspecialchars($item['name']) . '</h3>
                                <h4>$' . htmlspecialchars($item['price']) . '</h4>
                            </div>
                          </div>';
                }
                ?>
            </div>
            <!-- Snacks -->
            <div id="menu_col">
                <h2>Snacks</h2>
                <?php
                $snacks = getMenuItemsByCategory('snack');
                foreach ($snacks as $item) {
                    echo '<div class="box">
                            <div id="image"><img src="' . htmlspecialchars($item['image_url']) . '"></div>
                            <div>
                                <h3>' . htmlspecialchars($item['name']) . '</h3>
                                <h4>$' . htmlspecialchars($item['price']) . '</h4>
                            </div>
                          </div>';
                }
                ?>
            </div>
            <!-- Drinken -->
            <div id="menu_col">
                <h2>Drinken</h2>
                <?php
                $drinks = getMenuItemsByCategory('drink');
                foreach ($drinks as $item) {
                    echo '<div class="box">
                            <div id="image"><img src="' . htmlspecialchars($item['image_url']) . '"></div>
                            <div>
                                <h3>' . htmlspecialchars($item['name']) . '</h3>
                                <h4>$' . htmlspecialchars($item['price']) . '</h4>
                            </div>
                          </div>';
                }
                ?>
            </div>
        </div>
    </div>

</body>
</html>