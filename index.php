<?php

// O objetivo desse script é buscar na pasta arquivos htm com formato de referencia bíblica ex: Lev 1:10.htm
// Uma honra aos tres maiores expositores bíblicos! Veja a linha 271. 
// Um sistema de apresentação de comentários bíblicos salvos em html

$dados = $_POST;

$abreviacoes = array("1Cr"=>"1Ch ", "2Cr"=>"2Ch ", "1Co"=>"1Co ", "2Co"=>"2Co ", "1Jo"=>"1Jo ", "2Jo"=>"2Jo ", "3Jo"=>"3Jo ", "1Rs"=>"1Ki ", "2Rs"=>"2Ki ", 
                     "1Pe"=>"1Pe ", "2Pe"=>"2Pe ", "1Sm"=>"1Sa ", "2Sm"=>"2Sa ", "1Ts"=>"1Th ", "2Ts"=>"2Th ", "1Tm"=>"1Ti ", "2Tm"=>"2Ti ", "At"=>"Act ", "Am"=>"Amo ", 
                     "Cl"=>"Col ", "Dn"=>"Dan ", "Dt"=>"Deu ", "Ec"=>"Ecc ", "Ef"=>"Eph ", "Et"=>"Est ", "Ex"=>"Exo ", "Ez"=>"Eze ", "Ed"=>"Ezr ", "Gl"=>"Gal ",
                     "Gn"=>"Gen ", "Hc"=>"Hab ", "Ag"=>"Hag ", "Hb"=>"Heb ", "Os"=>"Hos ", "Is"=>"Isa ", "Tg"=>"Jam ", "Jz"=>"Jdg ", "Jr"=>"Jer ", "Jó"=>"Job ",
                     "Jl"=>"Joe ", "Jo"=>"Joh ", "Js"=>"Jos ", "Lm"=>"Lam ", "Lv"=>"Lev ", "Lc"=>"Luk ", "Ml"=>"Mal ", "Mc"=>"Mar ", "Mt"=>"Mat ", "Jn"=>"Jon ", "Mq"=>"Mic ", "Na"=>"Nah ",
                     "Ne"=>"Neh ", "Nm"=>"Num ", "Ob"=>"Oba ", "Fp"=>"Phi ", "Pv"=>"Pro ", "Sl"=>"Psa ", "Ap"=>"Rev ", "Rm"=>"Rom ", "Rt"=>"Rut ", "Ct"=>"Sol ",
                     "Tt"=>"Tit ", "Zc"=>"Zec ", "Sf"=>"Zep ", "Fm"=>"Phm ", "Jd"=>"Jud ");
$l = count($abreviacoes);
if (isset($dados["abrev"])) {
   foreach ($abreviacoes as $k=>$v) {
      if ($k == $dados["abrev"]) {
         $dados["livrobiblico"] = $v; 
         break; 
      }
   }
}
if (! empty($dados["consultar"])) {
    $livro =  $dados["livrobiblico"] . $dados["capitulo"] . ".";
    $livro_pt = array_search($dados["livrobiblico"], $abreviacoes) . " " . $dados["capitulo"] . ".";
}

function removeCarEspeciais($str)
{
   $str  = str_replace(";", "", $str);
   $str  = str_replace(".", "", $str);   
   $str  = str_replace(":", "", $str);
   $str  = str_replace(",", "", $str);
   $str  = str_replace("/", "", $str);
   $str  = str_replace("(", "", $str);
   $str  = str_replace(")", "", $str);
   return $str;

}

$americanBookToAbrev = array( 
      "Jeremiah" => "Jr",
      "Daniel" => "Dn", 
      "Job" => "Jó",
      "Exodus" => "Ex", 
      "Genesis" => "Gn", 
      "Judges" => "Jz", 
      "Deuteronomy" => "Dt",       
      "Isaiah" => "Is",
      "1Chronicles" => "1Cr", 
      "2Chronicles" => "2Cr", 
      "Hosea" => "Os", 
      "Hebrews" => "Hb", 
      "Psalms" => "Sl", 
      "2Samuel" => "2Sm", 
      "1Samuel" => "1Sm", 
      "Job" => "Jó", 
      "Numbers" => "Nm",
      "Leviticus" => "Lv",
      "1Corinthians" =>"1Co",
      "2Corinthians" =>"2Co", 
      "Revelation" => "Ap", 
      "Lamentations" => "Lm", 
      "Songs" => "Ct", 
      "Micah" => "Mq", 
      "James" => "Tg", 
      "Luke" => "Lc",
      "Galatians" => "Gl",
      "Joshua" => "Js", 
      "Proverbs" => "Pv", 
      "Philippians" => "Fp", 
      "Acts" => "At",
      "1Kings" => "1Rs",
      "2Kings" => "2Rs",
      "Romans" => "Rm",
      "Ecclesiastes" => "Ec",
      "Ezekiel" => "Ez",
      "Amos" => "Am",
      "Nehemiah" => "Ne", 
      "Mark" => "Mc", 
      "Habakkuk" => "Hc", 
      "John"=> "Jo", 
      "Nahum" => "Na", 
      "Ephesians" => "Ef", 
      "Zechariah" => "Zc", 
      "Titus" => "Tt",
      "John" => "Jo", 
      "Matthew" => "Mt", 
      "Esther" => "Et", 
      "2Timothy" => "2Tm", 
      "1Timothy" => "1Tm", 
      "Esther" => "Et", 
      "Ezra" => "Ed",
      "1Thessalonians" => "1Ts", 
      "2Thessalonians" => "2Ts", 
      "Haggai" => "Ag", 
      "2Peter" => "2Pe", 
      "1Peter" => "1Pe", 
      "Malachi" => "Ml", 
      "Esther" => "Et", 
      "1John" => "1Jo", 
      "2John" => "2Jo", 
      "3John" => "3Jo",       
      "Ruth" => "Rt", 
      "Zephaniah" => "Sf", 
      "Obadiah" => "Ob",
      "Ruth" => "Rt", 
      "Philemon" => "Fm", 
   );


$dir = array("./biblia expositor/");
$dh  = opendir($dir[0]);

while (false !== ($filename = readdir($dh))) {
   
   $opath = $dir[0] . $filename . "/";
   $book = $filename;
   if (! is_dir($opath)) {
      continue;
   }
   $dh2  = opendir($opath);
   if ($filename[0] != "." ) {
      while (false !== ($filename2 = readdir($dh2))) {
         if ($filename2[0]==".") {
            continue;
         }
         $path_file = $opath.$filename2;
         
         $indice = explode(" ", $book);         
         if (array_key_exists($indice[0], $americanBookToAbrev)) {            
            $abrev = $americanBookToAbrev[$indice[0]];
            if ($filename2 == "Expositor.rtf" || $filename2 == "expositor.rtf") {
               $renamePara = $opath. $abrev . " " . $indice[1].".expositor.rtf";
               echo "$path_file rename p/ $renamePara<br />";
               rename($path_file, $renamePara);
            }
            if ($filename2 == "Comentário Russel Shedd.rtf") {
               $renamePara = $opath. $abrev . " " . $indice[1].".Shedd.rtf";
               echo "$path_file rename p/ $renamePara<br />";
               rename($path_file, $renamePara);
            }
            // imagens
            if (empty($livro)) continue;
            $pi = pathinfo($path_file);
            if ($pi["extension"]=="jpg" ||$pi["extension"]=="png" ) {               
               $x = $americanBookToAbrev[explode(" ", $book)[0]] . " " . explode(" ",$book)[1]; 
               $comparalivrosel = str_replace(".","", $livro_pt);
               if ($x == $comparalivrosel) {
                  echo "<img src='$path_file'><br />";               
               }  else {
                  
               }
            }
            
            
         }
         
         
      }
   }
      
   $x = false;
   if ($x === false) {
   }
   
}

function diferenciar($book_abrev)
{
   
   $book_abrev  = str_replace(" ", "", $book_abrev);
   $book_abrev  = str_replace(".", "", $book_abrev);   

    $dir = array("./kjv/");
    $dh  = opendir($dir[0]);
    while (false !== ($filename = readdir($dh))) {
        $de = $dir[0] . $filename;
        if ($filename[0] == ".") {
            continue;
        }
   
        if (strpos($de, ".html") == false) {
            $para = $dir[0] . $filename . ".html";
            //rename($de, $para);
            echo "Renomeando $para <br />";
        
        } else {
            // text compare
            $path_parts = pathinfo($de);            
            if ($book_abrev != $path_parts['filename']) continue;
            
            $kjv = file_get_contents($de);
            $para = "./acf/".$path_parts['filename'].".txt";
            if (! file_exists($para)) {
                die("erro ao comparar $para ");
            }
            $acf = file_get_contents($para);
            $arkjv = explode(" ", $kjv);
            foreach ($arkjv as $k=>$v) {
                $compara = removeCarEspeciais($v);
                if (strpos($acf, $compara) == false) {
                    $arkjv[$k] = "<span style=\"color:red\">$compara</span>";
                }
            }
            $titulo = "[KJV vs ACF] >> " . $path_parts['filename'];
            echo $titulo . "<br>";
            echo implode(" ", $arkjv);
        }
    }
}

?>
<form action="index.php" method="POST">
   Procurar por abreviação <input type="text" name="abrev" value="<?=(isset($dados["abrev"]) ? $dados["abrev"] : "")?>" />
   > Cap <input type="text" name="capitulo" value="<?=(isset($dados["capitulo"])?$dados["capitulo"]:1)?>" />
   <br />
<?php 
   foreach ($abreviacoes as $k => $v) { 
      if (isset($dados["livrobiblico"]) && $dados["livrobiblico"] == $v) {
         $checked = " checked";
      } else {
         $checked = "";
      }
?>
   <input type="radio" name="livrobiblico" value="<?=$v?>"<?=$checked?>><?=$v?></input>

<?php 
   }
?>
<br />
<input type="submit" name="consultar" value="consultar">
</form>

<?php 
if (empty($dados["consultar"])) die("sem consulta");


echo '<a href="https://www.bibliaonline.com.br/acf/'. 
      strtolower(array_search( $dados["livrobiblico"], $abreviacoes )) . '/' . 
      $dados["capitulo"] . '">Abrir Online</a>';
echo "<br />";
echo "<b>Diferenças KJV <> ACF</b><br />";
diferenciar($livro_pt);
echo "<br />";

$dir = array("./dake/", "./rshedd/","./jsm/");


foreach ($dir as $k=>$v) {
   $dh  = opendir($v);


   while (false !== ($filename = readdir($dh))) {
      $x = strpos($filename, $livro);
      if ($x === false) {
      } else {
            readfile("$v$filename");
      }
   
      $x = strpos($filename, $livro_pt);
      if ($x === false) {
      } else {
            readfile("$v$filename");
      }
   }
}

echo '<textarea id="ta">
</textarea>';

echo "<h1>$livro_pt</h1>";

echo '<script>
// self executing function here
(function() {
   dados = document.getElementsByTagName(\'html\')[0].innerText.split("\n");
   dados.forEach(textoBrackets);

   function textoBrackets(item) {
      var myString= item;
      var result = myString.match(/\[(.*)\]/);
      if (result != null) {
         document.write(\'<h1>\'+result[0]+\'</h1>\');
      }
   }

   setTimeOut
})();
</script>
';
