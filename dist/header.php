<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Contact - Max Timje</title>
        <link rel="stylesheet" href="css/null.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link
            rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
            integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
            crossorigin="anonymous"
        />
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="js/main.js"></script>
    </head>
    <body class="<?php echo ($file); ?>">
        <div class="wrapper">
            <header class="whiteborder blockCenter">
                <div>
                    <figure class="logo">
                        <a href="index.php">
                        <img alt="logo" src="images/logo.png" />
                        </a>
                    </figure>
                    <div class="text">
                        <span class="tag">&lt;</span>
                        <h1><?php echo ($title); ?></h1>
                        <span class="tag">&gt;</span>
                        <p class="tag-line">Front-end developer</p>
                    </div>
                </div>
                <nav class="main-menu">
                    <ul>
                        <li class="menu-item">
                            <a href="contact.php">Contact</a>
                        </li>
                        <li class="menu-item">
                            <a href="projects.php">Webb</a>
                        </li>
                        <li class="menu-item"><a href="">Photo</a></li>
                    </ul>
                </nav>
            </header>