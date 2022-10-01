<?php

class FDir extends FManager{
    
    public function scanDir($path)
    {
        $filesScanned = glob($path . '/*');
        $filesList = [];

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
        
        foreach($filesScanned as $source)
        {
            $filesList[] = (object)array(
                'path' => $source,
                'fileName' => $this->getFileName($source),
                'size' => $this->getSize($source),
                'extension' => $this->getExtension($source),
                'modified' => $this->modified($source),
                'icon' => $this->getIcon($source)
            );
        }

        return $filesList;
    }

    public function getDirectories($path)
    {
        $filesScanned = glob($path . '/*', GLOB_ONLYDIR);
        $filesList = [];

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

        foreach($filesScanned as $source)
        {
            $filesList[] = (object)array(
                'path' => $source,
                'fileName' => $this->getFileName($source),
            );
        }

        return $filesList;
    }
}