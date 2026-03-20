<?php 

namespace app\core;

class FolderExtract
{

    public static function extract($uri)
    {

        $folder = '';

        if(isset($uri[0]) && $uri[0] !== '')
        {

            $folder = $uri[0];

            return is_dir(strtolower(ROOT.'\\'.CONTROLLER_PATH.$folder)) ? $folder: '';

        }

        return $folder;

    }

}

?>