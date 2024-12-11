<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        rel="stylesheet">
    <style>
        .product-image {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Quản lý sản phẩm</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-
            target="#navbarNav"

            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle

navigation">

            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/S4_PHP/Product/">Danh sách sản

                        phẩm</a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/S4_PHP/Product/add">Thêm sản

                        phẩm</a>

                </li>
                <li class="nav-item">
                    <?php

                    if (SessionHelper::isLoggedIn()) {

                        echo "<a class='nav-
link'>" . $_SESSION['username'] . "</a>";
                    } else {
                        echo "<a class='nav-link'

href='/S4_PHP/account/login'>Login</a>";
                    }
                    ?>

                </li>
                <li class="nav-item">
                    </a>
                    <?php

                    if (SessionHelper::isLoggedIn()) {
                        echo "<a class='nav-link'

href='/S4_PHP/account/logout'>Logout</a>";
                    }
                    ?>

                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">