<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<div class="dmc_delorean">
    <h1>Welcome to PHP Motors!</h1>
    <p>DMC Delorean</p>
    <p>3 Cup holders</p>
    <p>Superman doors</p>
    <p>Fuzzy dice!</p>

</div>

<div class="own_button">
    <button type="button">Own Today</button>
</div>

<div class="delorean_image">
    <img src="/phpmotors/images/vehicles/delorean.jpg" alt="Delorean Car">
</div>
<div class="reviews">
    <h2>DMC Delorean Reviews</h2>
    <ul class="reviews_list">
        <li>"So fast its almost like traveling in time." (4/5)</li>
        <li>"Coolest ride on the road." (4/5)</li>
        <li>"I'm feeling Marty McFly!" (5/5)</li>
        <li>"The most futuristic ride of our day." (4.5/5)</li>
        <li>"80's livin and I love it!" (5/5)</li>
    </ul>
</div>
<div class="upgrades">
    <h2>Delorean Upgrades</h2>
    <table>
        <tr>
            <td class="cell_image">
                <img class="flux_capacitor" src="/phpmotors/images/upgrades/flux-cap.png" alt="Flux Capacitor">
            </td>
            <td class="cell_image">
                <img class="flame_decals" src="/phpmotors/images/upgrades/flame.jpg" alt="Flame Decals">
            </td>
        </tr>
        <tr>
            <td class="cell_text">
                <a href="phpmotors/flux_capacitor.php" title="Flux capacitor">Flux Capacitor</a>
            </td>
            <td class="cell_text">
                <a href="phpmotors/flame_decals.php" title="Flame Decals">Flame Decals</a>
            </td>
        </tr>

        <tr>
            <td class="cell_image">
                <img class="bumper_stickers" src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper Stickers">
            </td>
            <td class="cell_image">
                <img class="hub_caps" src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Wheel Covers">
            </td>
        </tr>
        <tr>
            <td class="cell_text">
                <a href="phpmotors/bumper_stickers.php" title="Bumper Stickers">Bumper Stickers</a>
            </td>
            <td class="cell_text">
                <a href="phpmotors/hub_caps.php" title="Hub Caps">Hub Caps</a>
            </td>
        </tr>
    </table>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>