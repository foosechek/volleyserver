<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
// get the "message" variable from the post request
// this is the data coming from the Android app
if(empty($_POST['id'])){
    echo "noid";
} else if ($_POST['id'] == "START") {
    $opponent=$_POST['opponent'];
    $game=$_POST['game'];
    if ($game == "1"){
        $today = date("F j, Y, g:i a");
        $file = fopen("match.txt","w");
        fprintf($file,"%s\t%s", $opponent, $today);
        fclose($file);
        
        for($num=1;$num<=3;$num++){
            $filename = "game" . strval($num) . ".txt"; 
            $file = fopen($filename,"w");
            fprintf($file,"%d\t%d","0", "0");
            fclose($file);    
        }
    }
} else if ($_POST['id'] == "ARCHIVE") {
    $file = fopen("match.txt","r");
    $fields = fgetcsv($file, 100, "\t");
    $opponent = $fields[0];
    $time = $fields[1];
    fclose($file);
    $file = fopen("game1.txt","r");
    $fields = fgetcsv($file, 100, "\t");
    $g1h = $fields[0];
    $g1a = $fields[1];
    fclose($file);
    $file = fopen("game2.txt","r");
    $fields = fgetcsv($file, 100, "\t");
    $g2h = $fields[0];
    $g2a = $fields[1];
    fclose($file);
    $file = fopen("game3.txt","r");
    $fields = fgetcsv($file, 100, "\t");
    $g3h = $fields[0];
    $g3a = $fields[1];
    fclose($file);
    $outfile = fopen("archive.html", "a+");
    fwrite($outfile,"Match start:" . $time ."<br>\n");
    fwrite($outfile,"<table style=\"text-align: left; width: 400px; height: 60px;\" border=\"1\" cellpadding=\"2\" cellspacing=\"2\">\n");
    fwrite($outfile,"<tbody>\n");
    fwrite($outfile,"<tr>\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 200px;\">Synergy LV 15s<br> </td>\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 100px;\">" . $g1h . "<br>  </td>\"\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 100px;\">" . $g2h . "<br>  </td>\"\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 100px;\">" . $g3h . "<br>  </td>\n");
    fwrite($outfile,"</tr>\n");
    fwrite($outfile,"<tr>\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 200px;\">" . $opponent . "<br>  </td>\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 100px;\">" . $g1a . "<br> </td>\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 100px;\">" . $g2a . "<br> </td>\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 100px;\">" . $g3a . "<br> </td>\n");
    fwrite($outfile,"</tr>\n");
    fwrite($outfile,"</tbody>\n");
    fwrite($outfile,"</table>\n");
    fwrite($outfile,"<br><br>\n");

    fclose($outfile);
} else if ($_POST['id'] == "SCORE") {
   $home=$_POST['home']; 
   $away=$_POST['away']; 
   $game=$_POST['game'];
   $filename = "game" . $game . ".txt"; 
   $file = fopen($filename,"w");
   fprintf($file,"%d\t%d",$home, $away);
   fclose($file);    
}
?>

