<?php
    require('env.php');
    //cunset($_SESSION['fm_logged']);

    $dir = $_SERVER['DOCUMENT_ROOT'] . '/deco';

    $fdir = new FDir();

    $files = $fdir->scanDir($dir);
    $dirs = $fdir->getDirectories($dir);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>FM - File Manager</title>

        <!-- Favicon -->
        <link rel="icon" href="assets/img/logo.png">

        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.1/css/bootstrap.min.css" integrity="sha512-siwe/oXMhSjGCwLn+scraPOWrJxHlUgMBMZXdPe2Tnk3I0x3ESCoLz7WZ5NTH6SZrywMY+PB1cjyqJ5jAluCOg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- JQUERY CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.1/js/bootstrap.min.js"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        <!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/main.css">

        <!-- Main js -->
        <script src="assets/js/main.js"></script>
    </head>
    <body>
        <div class="nav-bar">
                <h5>File Manager</h5>
                <button class="btn add-file"><i class="fa-solid fa-plus"></i> Add</button>
        </div>
        <div class="container-fluid" style="margin-top: 54px;">
            <div class="row">
                <div class="col-md-3 forders">
                        <ul class="forders-list">
                            <li>
                            <i class="fa-solid abs-arrow fa-caret-down"></i> <i class="fa-regular fa-folder icon"></i> My Files
                                <ul>
                                    <?php foreach($dirs as $dir): ?>
                                    <li>
                                        <a class="open-forder is-dir" href="javascript:void(0);" link="<?php echo $dir->path ?>">
                                            <?php if($dir->subDirs): ?>
                                            <i class="arrow dir-close fa-solid fa-caret-right"></i> 
                                            <?php endif; ?>
                                            <i class="fa-regular fa-folder icon"></i> 
                                            <?php echo $dir->fileName ?>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        </ul>
                </div>
                <div class="col-md-9 dir-contents">
                    <div class="breadcrumb-container py-2">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">My Files</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="files-list">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" width="40%">Name</th>
                                    <th scope="col">Label</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Modified</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>