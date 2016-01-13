<!DOCTYPE HTML>
<html>
<head>

    <title>jQuery File Upload Example</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>
<body>
<form id="ajax" action="/ajax" method="POST">
    <input type="text" name="random">
    <button type="submit">테스트</button>
</form>
<p>

</p>
<script src="/lib/bower/jquery/dist/jquery.js"></script>
<script>
    $(function(){
        $("#ajax").submit(function(event){
            event.preventDefault();
            var form = $(this);
            $.ajax({
                url: '/ajax',
                data: form.serialize(),
                type: 'POST',
                success: function(data) {
                    console.log(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });

</script>
</body>
</html>