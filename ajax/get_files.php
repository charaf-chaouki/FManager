<?php

    require('../env.php');

    $dir = $_POST['dir'];

    $fdir = new FDir();

    $files = $fdir->scanDir($dir);
    $dirs = $fdir->getDirectories($dir);

?>

<?php foreach($files as $file): ?>
    <tr>
        <td>
            <a class="open-forder" href="javascript:void(0);" link="<?php echo $file->path ?>">
                <span class="file-icon">
                    <i class="<?php echo $file->icon ?>"></i>
                </span>
                <span class="file-name">
                    <?php echo $file->fileName ?>
                </span>
                <span class="file-extension">
                    <?php echo $file->extension ?>
                </span>
            </a>
        </td>
        <td>

        </td>
        <td>
            <?php echo $file->size ?>
        </td>
        <td>
            <?php echo $file->modified ?>
        </td>
    </tr>
<?php endforeach; ?>