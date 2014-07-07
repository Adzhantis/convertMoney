<html>
    <head>
        <title>Конвертер валют</title>
        <meta charset="UTF-8">
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        
    </head>
    <body>
        <form class="form-search" action="index.php" method="post">
            Your money
            <p> <select name="have">
                    <option value="UAH">UKRAINE(UAH) </option>
                    <option value="EURO">Europe(EURO) </option>
                    <option value="$">Usa($) </option> 
                    <option value="RUR">Russian(RUR) </option> 
                </select></p>
            convert into  to
           
            <p> <select  name="need">
                    <option value="UAH">UKRAINE(UAH) </option>
                    <option value="EURO">Europe(EURO) </option>
                    <option value="$">Usa($) </option> 
                    <option value="RUR">Russian(RUR) </option> 
                </select> </p>
            <p>How much money do you want to convert?</p>
            <p>   <input  type="text" class="input-medium search-query" required name="money" placeholder="input">
            </p>  <input class="btn btn-primary" type="submit" value="convert">
        </form>
        <?php
        require_once 'privatBank.php';
        ?>
    </body>
</html>
