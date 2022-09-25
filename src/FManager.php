<?php

class FManager{
    
    private $path;

    public function __CONSTRUCT($path = null)
    {
        $this->path = $path;
    }

    public function getFileName($path = null)
    {
        $source = ($path == null)?$this->path:$path;

        return pathinfo($source, PATHINFO_FILENAME);
    }

    public function getSize($path = null)
    {
        $source = ($path == null)?$this->path:$path;

        $bytes = filesize($source);

        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 0)
        {
            $bytes = number_format($bytes, 2) . ' B';
        }
        else
        {
            $bytes = '';
        }

        return $bytes;
    }

    public function getExtension($path = null)
    {
        $source = ($path == null)?$this->path:$path;

        return pathinfo($source, PATHINFO_EXTENSION);
    }

    public function modified($path)
    {
        $source = ($path == null)?$this->path:$path;

        return date("F d Y H:i", filemtime($source));
    }

    public function getIcon($path)
    {
        $source = ($path == null)?$this->path:$path;
        $extension = pathinfo($source, PATHINFO_EXTENSION);
        $iconClass = '';

        //List of extensions
        $imageExtensions = array();
        $zipExtensions = array('zip', 'rar');

        if(is_dir($source))
        {
            $iconClass = 'fa-regular fa-folder icon';
        }
        elseif(in_array($extension, $zipExtensions))
        {
            $iconClass = 'fa-regular fa-file-zipper icon';
        }
        elseif($extension == 'pdf')
        {
            $iconClass = 'fa-regular fa-file-pdf icon';
        }
        else
        {
            $iconClass = 'fa-regular fa-file icon';
        }

        return $iconClass;
    }
}