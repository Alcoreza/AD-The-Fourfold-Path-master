<?php
$pageName = 'about';
$navbarType = 'default';
$headerType = 'default';

ob_start();
?>

<section class="about-website">
    <h2>About The Fourfold Path</h2>
    <p>
        The Fourfold Path is a martial arts-inspired merchandise platform rooted in the spirit of Avatar: The Last Airbender. It features custom gear based on the four nations—Fire, Water, Earth, and Air—with a focus on immersive user experience, intuitive design, and responsive performance across all devices.
    </p>
</section>

<section class="team-section">
    <h2>Meet Our Team</h2>

    <div class="team-member slide-in">
        <img src="/assets/img/profile/elmer.jpg" alt="QA Tester">
        <div class="member-info">
            <h3>Elmer Daniel Alcoreza – Quality Assurance</h3>
            <p>Tested all features for bugs, UI inconsistencies, and edge cases. Helped ensure a seamless experience across different devices and browsers.</p>
        </div>
    </div>

    <div class="team-member slide-in">
        <img src="/assets/img/profile/clive.JPG" alt="Front-End Dev">
        <div class="member-info">
            <h3>Clive Owen Benito – Front-End Developer</h3>
            <p>Designed and built the UI using PHP, HTML, CSS, and JavaScript. Handled animations, responsiveness, and user interactions across all pages.</p>
        </div>
    </div>

    <div class="team-member slide-in">
        <img src="/assets/img/profile/weinard.jpg" alt="Back-End Dev">
        <div class="member-info">
            <h3>Weinard Manianglung – Back-End Developer</h3>
            <p>Developed authentication, routing, and server logic using PHP. Integrated sessions and handled data flow between components and the database.</p>
        </div>
    </div>

    <div class="team-member slide-in">
        <img src="/assets/img/profile/ozbert.jpg" alt="Database Admin">
        <div class="member-info">
            <h3>Ozbert Ace Maxeme Sales – Database Administrator</h3>
            <p>Designed and maintained PostgreSQL and MongoDB schemas for users, products, orders, and inventory, ensuring data integrity and security.</p>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
include LAYOUT_PATH . '/main.layout.php';
?>