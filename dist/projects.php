<?php
    $file = 'projects';
    $title = 'Webb projects';
    include('header.php')
?>
<main class="whiteborder">
    <ul class="project-grid" id="project-list">
        <li class="whiteborder">
            <h2>Project name</h2>
            <figure>
                <img src="images/uploades/image 1.png" />
            </figure>
            <ul class="links">
                <li class="project">
                    <a href="LINK">Project</a>
                </li>
                <li class="github">
                    <a href="LINK">github</a>
                </li>
            </ul>
            <p>
                description
            </p>
            <ul class="tools">
                <li>
                    <i class="fab fa-2x fa-wordpress"></i>
                </li>
                <li>
                    <i class="fab fa-2x fa-html5"></i>
                </li>
                <li>
                    <i class="fab fa-2x fa-css3-alt"></i>
                </li>
                <li>
                    <i class="fab fa-2x fa-js"></i>
                </li>
                <li>
                    <i class="fab fa-2x fa-php"></i>
                </li>
            </ul>
        </li>
        <!-- ajax request to get projects -->
    </ul>
</main>
<script src="js/projects.js"></script>
<?php
    include('footer.php')
?>
