<?php
date_default_timezone_set('America/New_York');
ini_set('display_errors', 'On');
error_reporting(E_ALL);
// get the "message" variable from the post request
// this is the data coming from the Android app
if(empty($_POST['id'])){
    echo "noid try again";
} else if ($_POST['id'] == "START") {
    $opponent=$_POST['opponent'];
    $game=$_POST['game'];
    $gameid = time();
    if ($game == "1"){
        $today = date("F j, Y, g:i a");
        $file = fopen("match.txt","w");
        fprintf($file,"%s\t%s", $opponent, $today);
        fclose($file);
        
        for($num=1;$num<=5;$num++){
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
    $file = fopen("game4.txt","r");
    $fields = fgetcsv($file, 100, "\t");
    $g4h = $fields[0];
    $g4a = $fields[1];
    fclose($file);
    $file = fopen("game5.txt","r");
    $fields = fgetcsv($file, 100, "\t");
    $g5h = $fields[0];
    $g5a = $fields[1];
    fclose($file);
    $outfile = fopen("archive_temp.html", "w+");
    fwrite($outfile,"<p1>Match start:" . $time ."</p1>\n");
    fwrite($outfile,"<table style=\"text-align: left; width: 600px; height: 60px;\" border=\"1\" cellpadding=\"2\" cellspacing=\"2\">\n");
    fwrite($outfile,"<tbody>\n");
    fwrite($outfile,"<tr>\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 402px;\">PARKLAND<br> </td>\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 66px;\">" . $g1h . "<br>  </td>\"\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 66px;\">" . $g2h . "<br>  </td>\"\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 66px;\">" . $g3h . "<br>  </td>\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 66px;\">" . $g4h . "<br>  </td>\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 66px;\">" . $g5h . "<br>  </td>\n");
    fwrite($outfile,"</tr>\n");
    fwrite($outfile,"<tr>\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 402px;\">" . $opponent . "<br>  </td>\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 66px;\">" . $g1a . "<br> </td>\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 66px;\">" . $g2a . "<br> </td>\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 66px;\">" . $g3a . "<br> </td>\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 66px;\">" . $g4h . "<br>  </td>\n");
    fwrite($outfile,"<td style=\"vertical-align: top; width: 66px;\">" . $g5h . "<br>  </td>\n");
    fwrite($outfile,"</tr>\n");
    fwrite($outfile,"</tbody>\n");
    fwrite($outfile,"</table>\n");
    fwrite($outfile,"<br><br>\n");

    fclose($outfile); 
    shell_exec('cat archive_temp.html > temp.html && cat archive_scores.html >> temp.html && mv temp.html archive_scores.html');
    shell_exec('cat archive_header.html > archive.html && cat archive_scores.html >> archive.html');
} else if ($_POST['id'] == "SCORE") {
   $home=$_POST['home']; 
   $away=$_POST['away']; 
   $game=$_POST['game'];
   $filename = "game" . $game . ".txt"; 
   $gamefile = "game" . $gameid . ".txt";
   $file = fopen($filename,"w");
   $file2 = fopen($gamefile,"w+");
   fprintf($file,"%d\t%d",$home, $away);
   fprintf($file2,"%d\t\%d",$home, $away);
   fclose($file);    
   fclose($file2);
} else if ($_POST['id'] == "MESSAGE") {
   $message=$_POST['message'];
   $outfile = fopen("message.txt", "w+");
   fprintf($outfile,">%s",$message);
   fclose($outfile);
}
?>

