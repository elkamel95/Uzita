<?php

namespace App\Service;
use Symfony\Component\Filesystem\Filesystem;

class RemoveImageService
{
    public function setPath($path)
    {

$filesystem = new Filesystem();

           $filesystem->remove($path);
       
    }
     public function setPaths($paths,$alt)
    {
    	$filesystem = new Filesystem();

foreach ($paths as $key => $path) {
	if($path->getUrl()!=null){
     dump($path->getUrl());
           $filesystem->remove($alt.'/'.$path->getUrl());
}
       
    }

    }
}