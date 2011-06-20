<?php

$dir = '/var/www/wizme/new/web/images';
$pngoutDir = './pngout-20110415-linux/i386/pngout';

function optimizePng($currentDir, $pngoutDir, $dirs) {
  $files = scandir($currentDir);
  foreach($files as $file) {
    if (is_dir($currentDir.'/'.$file) && $file != '..' && $file != '.') {
      $dirs[] = $currentDir.'/'.$file;
    } else if (is_file($currentDir.'/'.$file) && strrchr($file, '.') == '.png') {
      echo "optimize ".$file."\r\n";
      exec($pngoutDir.' '.$currentDir.'/'.str_replace(' ', '\ ', $file)); 
    }
  }
  echo 'Folder left:'."\r\n";
  if (count($dirs) > 0) {
    print_r($dirs);
    $directory = $dirs[0];
    array_shift($dirs);
    optimizePng($directory, $pngoutDir, $dirs);
  } else {
    echo "Optimization done !\r\n";
  }
}

optimizePng($dir, $pngoutDir, array());

?>
