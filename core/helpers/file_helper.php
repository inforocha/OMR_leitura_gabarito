<?php

if (!function_exists('get_filenames')) {
	/**
	 * By Codeigniter file_helper.php
	 * Get Filenames
	 *
	 * Reads the specified directory and builds an array containing the filenames.
	 * Any sub-folders contained within the specified path are read as well.
	 *
	 * @param	string	path to source
	 * @param	bool	whether to include the path as part of the filename
	 * @param	bool	internal variable to determine recursion status - do not use in calls
	 * @return	array
	 */
	function get_filenames($source_dir, $include_path = FALSE, $_recursion = FALSE) {
		static $_filedata = array();

		if ($fp = @opendir($source_dir)) {
			// reset the array and make sure $source_dir has a trailing slash on the initial call
			if ($_recursion === FALSE) {
				$_filedata = array();
				$source_dir = rtrim(realpath($source_dir), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
			}

			while (FALSE !== ($file = readdir($fp))) {
				if (is_dir($source_dir.$file) && $file[0] !== '.') {
					get_filenames($source_dir.$file.DIRECTORY_SEPARATOR, $include_path, TRUE);
				} elseif ($file[0] !== '.') {
					$_filedata[] = ($include_path === TRUE) ? $source_dir.$file : $file;
				}
			}

			closedir($fp);
			return $_filedata;
		}

		return FALSE;
	}
}

if (!function_exists('delete_files')) {
	/**
	 * Delete Files
	 *
	 * Deletes all files contained in the supplied directory path.
	 * Files must be writable or owned by the system in order to be deleted.
	 * If the second parameter is set to TRUE, any directories contained
	 * within the supplied base directory will be nuked as well.
	 *
	 * @param	string	$path		File path
	 * @param	bool	$del_dir	Whether to delete any directories found in the path
	 * @param	bool	$htdocs		Whether to skip deleting .htaccess and index page files
	 * @param	int	$_level		Current directory depth level (default: 0; internal use only)
	 * @return	bool
	 */
	function delete_files($path, $del_dir = FALSE, $htdocs = FALSE, $_level = 0) {
		// Trim the trailing slash
		$path = rtrim($path, '/\\');

		if ( ! $current_dir = @opendir($path)) {
			return FALSE;
		}

		while (FALSE !== ($filename = @readdir($current_dir))) {
			if ($filename !== '.' && $filename !== '..') {
				$filepath = $path.DIRECTORY_SEPARATOR.$filename;

				if (is_dir($filepath) && $filename[0] !== '.' && ! is_link($filepath)) {
					delete_files($filepath, $del_dir, $htdocs, $_level + 1);
				} elseif ($htdocs !== TRUE OR ! preg_match('/^(\.htaccess|index\.(html|htm|php)|web\.config)$/i', $filename)) {
					@unlink($filepath);
				}
			}
		}

		closedir($current_dir);

		return ($del_dir === TRUE && $_level > 0) ? @rmdir($path) : TRUE;
	}
}

if (!function_exists('convertImage')) {
	function convertImage($pathImage, $newName = 'newImage') {

		$originalImage = imagecreatefromjpeg($pathImage);

		$newWidth = 559;
		$newHeight = 800;
		list( $originalWidth, $originalHeight ) = getimagesize( $pathImage );
		$newImage = imagecreatetruecolor( $newWidth, $newHeight );

		imagecopyresampled(
		    $newImage,
		    $originalImage,
		    0, // Coordenada X da nova imagem
		    0, // Coordenada Y da nova imagem 
		    0, // Coordenada X da imagem 
		    0, // Coordenada Y da imagem  
		    $newWidth,
		    $newHeight, 
		    $originalWidth,
		    $originalHeight
		);
		imagejpeg( $newImage, $newName.'.jpg', 100 );
		//imagepng($originalImage, 'utilizar.png');
		imagedestroy($originalImage);
		imagedestroy($newImage);
	}
}