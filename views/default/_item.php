<?php
if (!empty($dishes)) {
    echo "<h3>$comment:</h3>";
    foreach ($dishes as $name => $ingredients) {
        echo "<h4>$name</h4>";
        echo "<p>$ingredients</p>";
    }
}
