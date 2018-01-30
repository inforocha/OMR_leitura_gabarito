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