<?php
/**
 * Array Folder
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
$array_folder = [
    'app'
];

/**
 * Function Get Sub Directories
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
function get_sub_directories($dir)
{
    $subDir = [];
    // Get and add directories of $dir
    $directories = array_filter(glob($dir), 'is_dir');
    $subDir = array_merge($subDir, $directories);
    // Foreach directory, recursively get and add sub directories
    foreach ($directories as $directory) $subDir = array_merge($subDir, get_sub_directories($directory . '/*'));
    // Return list of sub directories
    return $subDir;
}

/**
 * Require Once
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
foreach ($array_folder as $folder) :
    $dir =   dirname(__FILE__) . '/' . $folder;
    foreach (get_sub_directories($dir) as $folder):
        $files = glob($folder . "/*.php"); // return array files
        foreach ($files as $phpFile) :
            require_once("$phpFile");
        endforeach;
    endforeach;
endforeach;
