<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <script type="text/javascript">
        let progress = document.getElementById('progressbar');
        let totalHeight = document.body.scrollHeight - window.innerHeight;
        window.onscroll = function(){
            let progressHeight = (window.pageYOffset / totalHeight) * 100;
            progress.style.height = progressHeight + "%";
        }
    </script>
</body>
</html>