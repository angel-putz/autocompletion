<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <form action="recherche.php" method="get">
        <input type="text" id="search" name="search" placeholder="Search...">
        <input type="submit" value="Search">
    </form>

    <script>
    $(function() {
        $("#search").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "search.php",
                    type: "GET",
                    data: request,
                    success: function(data) {
                        var parsedData = JSON.parse(data);
                        var exactMatches = [];
                        var partialMatches = [];
                        $.each(parsedData, function(index, item) {
                            if (item.label.startsWith(request.term)) {
                                exactMatches.push(item);
                            } else {
                                partialMatches.push(item);
                            }
                        });
                        response(exactMatches.concat([{ label: "----", value: "" }]).concat(partialMatches));
                    }
                });
            },
            select: function(event, ui) {
                if (ui.item.value !== "") {
                    window.location.href = 'element.php?id=' + ui.item.id;
                }
                return false;
            },
            minLength: 1
        });
    });
    </script>
</body>
</html>