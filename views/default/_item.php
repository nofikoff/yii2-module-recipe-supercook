<?php
if (!empty($dishes))
    foreach ($dishes as $name => $ingredients) {
        echo "<h3>$name</h3>";
        echo "<p>$ingredients</p>";
    }
