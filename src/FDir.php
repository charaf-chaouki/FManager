<?php

class FDir extends FManager{
    
    public function scanDir($path)
    {
        $filesScanned = glob($path . '/*');

        usort($filesScanned, function ($a, $b) {
            $aIsDir = is_dir($a);
            $bIsDir = is_dir($b);
            
            if($aIsDir === $bIsDir)
                return strnatcasecmp($a, $b); // both are dirs or files
            elseif($aIsDir && !$bIsDir)
                return -1; // if $a is dir - it should be before $b
            elseif(!$aIsDir && $bIsDir)
                return 1; // $b is dir, should be before $a
        });
        
        $filesList = $this->filesDetails($filesScanned);

        return $filesList;
    }

    public function getDirectories($path)
    {
        $filesScanned = glob($path . '/*', GLOB_ONLYDIR);

        usort($filesScanned, function ($a, $b) {
            $aIsDir = is_dir($a);
            $bIsDir = is_dir($b);
            
            if($aIsDir === $bIsDir)
                return strnatcasecmp($a, $b); // both are dirs or files
            elseif($aIsDir && !$bIsDir)
                return -1; // if $a is dir - it should be before $b
            elseif(!$aIsDir && $bIsDir)
                return 1; // $b is dir, should be before $a
        });

        $filesList = $this->filesDetails($filesScanned);

        return $filesList;
    }

    public function hasSubDirectories($path)
    {
        if(!is_dir($path))
        {
            return false;
        }
        else
        {
            $subDirs = glob($path . "/*", GLOB_ONLYDIR);

            usort($subDirs, function ($a, $b) {
                return strnatcasecmp($a, $b);
            });

            return $this->filesDetails($subDirs);;
            
        }
    }

    public function filesDetails($paths)
    {
        $filesList = [];

        foreach($paths as $source)
        {
            $filesList[] = (object)array(
                'path' => $source,
                'fileName' => $this->getFileName($source),
                'size' => $this->getSize($source),
                'extension' => $this->getExtension($source),
                'modified' => $this->modified($source),
                'icon' => $this->getIcon($source),
                'subDirs' => $this->hasSubDirectories($source)
            );
        }

        return $filesList;
    }
}