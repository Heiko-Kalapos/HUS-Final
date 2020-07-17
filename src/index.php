<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8" />
        <title>Heikos URL-Shortener</title>
    </head>
    <body>
        
        <?php
            
            echo "<h1>Heikos URL-Shortener</h1>";

            #Fehlermeldungen
            if(isset($_GET['fail']) AND $_GET['fail'] == "1"){
                echo "<div style='color: red;'>Wunsch-URL zu lang!</div>";
            }
            elseif(isset($_GET['fail']) AND $_GET['fail'] == "2"){
                echo "<div style='color: red;'>Wunsch-URL existiert bereits!</div>";
			}
            
            echo "<br />";
            echo "<form action='add.php'><input type='submit' value='Neues Anlegen'></form>";
            echo "<br /><br />";

            $db_link = mysqli_connect('db', 'user', 'auto', 'shortener', 3306);
            


            #Abfrage URL und Überprüfung DB
            $akturl = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
            #echo $akturl;



            $sql = "SELECT oUrl FROM urls WHERE sUrl = '$akturl'";
            $db_erg = mysqli_query($db_link, $sql);

            $zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC);

            $zieladresse = $zeile['oUrl'];
            echo $zieladresse;

            if(isset($zeile['oUrl'])){
                $zieladresse = $zeile['oUrl'];
                echo "<script type='text/javascript'>window.top.location='$zieladresse';</script>"; exit;
                #header("location: $zieladresse");     
			}


            $sql = "SELECT * FROM urls";
            $db_erg = mysqli_query($db_link, $sql);
            
            echo "<table style='border:0; border-spacing:20px 10px'>";
                echo "<tr style='border: 1px solid black;'>";
                    echo "<td><b>id</b></td>";
                    echo "<td><b>Original URL</b></td>";
                    echo "<td><b>Short URL</b></td>";
                echo "</tr>";

                
                while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)){
                        echo "<tr style='border: 1px solid black;'>";
                            echo "<td>". $zeile['id'] . "</td>";
                            echo "<td>". $zeile['oUrl'] . "</td>";
                            echo "<td>". $zeile['sUrl'] . "</td>";
                        echo "</tr>";
                }
                  
            echo "</table>";
            
            mysqli_free_result($db_erg);
        ?>

    </body>
</html>