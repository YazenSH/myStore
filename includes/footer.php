</div>
<div class="footer">
    <p>&copy; 2024 Photography Store. All rights reserved.</p>
    <p>Photography Store, Alsulamanyah, Jeddah City, Saudi Arabia</p>
    <div>
        <?php
        // Get current page URL
        $current_url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $encoded_url = urlencode($current_url);
        ?>
        <a href="https://validator.w3.org/check?uri=<?php echo $encoded_url; ?>">
            <img src="https://www.w3.org/Icons/valid-xhtml10" 
                 alt="Valid XHTML 1.0 Strict" 
                 height="31" 
                 width="88" />
        </a>
        <a href="https://jigsaw.w3.org/css-validator/validator?uri=<?php echo $encoded_url; ?>">
            <img src="https://jigsaw.w3.org/css-validator/images/vcss" 
                 alt="Valid CSS" 
                 height="31" 
                 width="88"/>
        </a>
    </div>
</div>
</body>
</html>