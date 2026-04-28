<?php

function makeDirectory(string $folder, array $subfolders = [])
{
    $directory = ROOT . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "stocks" . DIRECTORY_SEPARATOR;

    $formatFolder = preg_replace('/\s+/', '_', trim($folder));
    $fullPath = $directory . $formatFolder;

    if (is_dir($fullPath)) {
        return false;
    }

    mkdir($fullPath, 0755, true);

    if (!empty($subfolders)) {
        foreach ($subfolders as $subfolder) {
            $formatSubfolder = preg_replace('/\s+/', '_', trim($subfolder));
            mkdir($fullPath . DIRECTORY_SEPARATOR . $formatSubfolder, 0755, true);
        }
    }

    return true;
}

?>