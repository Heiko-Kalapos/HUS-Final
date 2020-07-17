<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8" />
        <title>Heikos URL-Shortener</title>
    </head>
    <body>
        

        <h1>Heikos URL-Shortener</h1>

        <br />
        <form action='index.php'><input type='submit' value='Abbruch'></form>
        <br /><br />

        <form action="create.php" method="POST">
            <input type="text" name="origURL" placeholder="Original URL" required/>
            <input type="text" name="wunschURL" placeholder="Wunsch URL" />
            <input type="submit" value="Hinzufügen" />
        </form>

    </body>
</html>