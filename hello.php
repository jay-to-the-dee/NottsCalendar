<html>
    <head><title>Hello World!</title></head>
    <body>
        <?php
        $today = getdate();
        echo "Today is " . $today[weekday];
        ?>
    </body>
</html>
