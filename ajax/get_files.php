<?php

    require('../env.php');

    $dir = $_POST['dir'];

    $fdir = new FDir();

    $files = $fdir->scanDir($dir);
    $dirs = $fdir->getDirectories($dir);

    $response = [
        'data' => '',
        'subDir' => ''
    ];

    //get files
    foreach($files as $file)
    {
        $response["data"] .= '
            <tr>
            <td>
                <a class="open-forder" href="javascript:void(0);" link="' . $file->path . '">
                    <span class="file-icon">
                        <i class="' . $file->icon . '"></i>
                    </span>
                    <span class="file-name">
                        ' . $file->fileName . '
                    </span>
                    <span class="file-extension">
                        ' . $file->extension . '
                    </span>
                </a>
            </td>
            <td>

            </td>
            <td>
                ' . $file->size . '
            </td>
            <td>
                ' . $file->modified . '
            </td>
        </tr>
        ';
    }

    //get subDirs
    
    foreach($dirs as $index => $dir)
    {
        if($index == 0)
        {
            $response['subDir'] .= '<ul class="sub-forders">';
        }
        

        $response['subDir'] .=  '<li>
            <a class="open-forder is-dir" href="javascript:void(0);" link="' . $dir->path . '">';

            if($dir->subDirs)
            {
                $response['subDir'] .= '<i class="arrow dir-close fa-solid fa-caret-right"></i>';
            }
                 
       $response['subDir'] .=  '<i class="fa-regular fa-folder icon"></i>
                ' . $dir->fileName . '
            </a>
        </li>';
        
         
        if($index == count($dirs) - 1)
        {
            $response['subDir'] .= '</ul>';
        }
    }
    

    echo json_encode($response);
