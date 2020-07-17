<?php

        $domain = $_SERVER['HTTP_HOST']."/index.php/";


        $db_link = mysqli_connect('db', 'user', 'auto', 'shortener', 3306);
        
        $ourl = $_POST["origURL"];
        $wurl = $_POST["wunschURL"];
        

        $sql = "SELECT MAX(id) FROM urls";
        $db_erg = mysqli_query($db_link, $sql);
        $maxId = mysqli_fetch_row($db_erg);
        #echo $maxId[0];

        



        if($wurl != ""){                #Wenn eine Wunsch-URL eingegeben wurde
            if(strlen($wurl) <= 10){                #Wenn eingegebene Wunsch-URL kleiner gleich 10 Zeichen
                #Datenbankabfrage zur �berpr�fung, ob Wunsch-URL bereits vorhanden
                $sql = "SELECT sUrl FROM urls";
                $db_erg = mysqli_query($db_link, $sql);

                $zielurl = $domain.$wurl;

                $exists = false;
                while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)){
                    if($zielurl == $zeile['sUrl']){
                        $exists = true;
                    }
                }
                
                if($exists == false){
                    #echo $zielurl;

                    $sql = "INSERT INTO urls (oUrl, sUrl) VALUES ('$ourl', '$zielurl')";
                    $db_erg = mysqli_query($db_link, $sql);
                    header("location: index.php?fail=0");

                }
                else{
                    header("location: index.php?fail=2");
				}
			}
            else{                #Wenn eingegebene Wunsch-URL länger als 10 Zeichen
                header("location: index.php?fail=1");
			}
		}
        else{                #Wenn keine Wunsch-URL eingegeben
            $end = str_pad(($maxId[0]+1), 7, '0', STR_PAD_LEFT);
            #echo "zahl".$end;

            $zielurl = $domain.$end;
            #echo "".$zielurl;

            $sql = "INSERT INTO urls (oUrl, sUrl) VALUES ('$ourl', '$zielurl')";
            $db_erg = mysqli_query($db_link, $sql);
            header("location: index.php?fail=0");
		}

    ?>