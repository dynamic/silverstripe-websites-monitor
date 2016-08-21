<html>
<head></head>
<body>
<div class="flexslider">
    <ul class="slides">
        <% loop $Websites %>
            <li>
                <div class="slide">
                    <div class="site-info">
                        <h1>$Title</h1>
                        $Description
                    </div>
                    <iframe id="$ID" class="slide-frame" src="$URL" width="100%" height="100%" scrolling="no"></iframe>
                </div>
            </li>
        <% end_loop %>
    </ul>
</div>
$Form
</body>
</html>