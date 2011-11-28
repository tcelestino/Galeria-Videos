<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="flash.js"></script>
<script src="youtube.js" type="text/javascript"></script>
<style type="text/css">
<!--
body {
	margin:20px 0;
	font-family:Arial, Helvetica, sans-serif;
	font-size:13px;
}
h1 {
	font-size:20px;
	background:#f5f5f5;
	text-align:center;
}
#galeria {
	width:510px;
	margin:0 auto;
}
#galeria player {
height480px
}
#galeria ul, #galeria ul li {
	float:left;
	margin:0;
	padding:0;
}
#galeria ul li {
	list-style:none;
	margin:0 10px 10px 0;
}
#galeria ul li:nth-child(4n) {
	margin-right:0
}
-->
</style>

<!--[if IE]>
    <script src="http://www.walterpinheiro.com.br/wp-content/themes/walterpinheiro_v2/js/html5.js"></script>
  <![endif]-->

<!--swf object-->

<title>Galeria de Videos</title>
</head>
<body>
<div id="galeria">
  <h1>Galeria de Vídeos com YouTube</h1>
  <div id="player"></div>

  <ul id="thumbVideos" class="overview">
    <?php
    // URL do Feed
    $feedURL = 'http://gdata.youtube.com/feeds/api/users/tcelestino/uploads?max-results=8';
    
    // leio o xml dentro de um objeto SimpleXML
	$sxml = simplexml_load_file($feedURL);
    ?>
    <?php
    // inicio o loop dos resultados
    foreach ($sxml->entry as $entry) {
      // Pego as informações do vídeo
      $media = $entry->children('http://search.yahoo.com/mrss/');
      
      // pelo a URL do player do vídeo
      $attrs = $media->group->player->attributes();
      $watch = $attrs['url']; 
      
      // pego o thumbnail
      $attrs = $media->group->thumbnail[1]->attributes();
      $thumbnail = $attrs['url']; 
            
      // pego a duração <yt:duration> do vídeo
      $yt = $media->children('http://gdata.youtube.com/schemas/2007');
      $attrs = $yt->duration->attributes();
	  $minutos = $attrs['seconds'] / 60;
      $segundos = $attrs['seconds'] % 60; 
      
      // pego as estatísticas <yt:stats>
      $yt = $entry->children('http://gdata.youtube.com/schemas/2007');
      $attrs = $yt->statistics->attributes();
	      
      // pego a nota <gd:rating>
      $gd = $entry->children('http://schemas.google.com/g/2005'); 
      if ($gd->rating) {
        $attrs = $gd->rating->attributes();
        $rating = $attrs['average']; 
      } else {
        $rating = 0; 
      } 
      ?>
    <li><a href="<?php echo $watch; ?>" target="_blank" rel="<?php echo substr(($watch),31,11); ?>" title="<?php echo $media->group->title; ?>"><img src="<?php echo $thumbnail;?>" alt="" /></a> </li>
    <?php
    }
    ?>
  </ul>
</div>
</body>
</html>