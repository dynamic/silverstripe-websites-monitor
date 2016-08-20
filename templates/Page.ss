<html>
<head></head>
<body style="margin: 0; padding: 0;">
<div id="flexslider">
    <ul class="slides">
        <% loop $Websites %>
            <li>
                <div class="slide">
                    <div id="description">
                        <h1>$Title</h1>
                        $Description
                    </div>
                    <iframe id="$ID" class="slide" src="$URL" width="100%" height="100%" style="border: none;"></iframe>
                </div>
            </li>
        <% end_loop %>
    </ul>
</div>
</body>
</html>