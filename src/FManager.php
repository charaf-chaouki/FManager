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

    public function downoald($file_to_download)
    {
        $download_rate = 200; // 200Kb/s

        $f = null;

        try {
            if (!file_exists($file_to_download)) {
                throw new Exception('File ' . $file_to_download . ' does not exist');
            }

            if (!is_file($file_to_download)) {
                throw new Exception('File ' . $file_to_download . ' is not valid');
            }

            header('Cache-control: private');
            header('Content-Type: application/octet-stream');
            header('Content-Length: ' . filesize($file_to_download));
            header('Content-Disposition: filename=' . $file_to_download);

            // flush the content to the web browser
            flush();

            $f = fopen($file_to_download, 'r');

            while (!feof($f)) {
                // send the file part to the web browser
                print fread($f, round($download_rate * 1024));

                // flush the content to the web browser
                flush();

                // sleep one second
                sleep(1);
            }
        } catch (\Throwable $e) {
            echo $e->getMessage();
        } finally 
        {
            if ($f) {
                fclose($f);
            }
        }
    }

    public function copyFile($source, $dest, $overwritten = true)
    {
        if(!file_exists($source))
        {
            return false;
        }

        if(!$overwritten && file_exists($dest))
        {
            return false;
        }

        return copy($source, $dest);
    }

    public function deleteFile($source)
    {
        if(!file_exists($source))
        {
            return false;
        }
        else
        {
            return unlink($source);
        }
    }

    public function renameFile($oldName, $newName)
    {
        if(!file_exists($oldName))
        {
            return false;
        }

        return rename($oldName, $newName);
    }

}