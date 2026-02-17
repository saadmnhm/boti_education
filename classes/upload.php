<?php
class Upload {

	public static function checkUpload($file, $maxsize=null, $exts=null, $index = null) {
		if (!$maxsize) $maxsize = Config::get('upload-file-max-size');
		if (!$exts) $exts = Config::get('upload-file-exts');
		
		if($index !== null) {
			
			if (!isset($_FILES[$file]))
				return 'Fichier non-envoyé !';
			
			
			if ($_FILES[$file]['error'][$index] > 0)
				return 'Une Erreur est survenue lors du chargement du fichier ! (error: '.$_FILES[$file]['error'][$index].')';
			if (($_FILES[$file]['size'][$index] /1024/1024) > $maxsize)
				return 'La taille du fichier doit être inferieure à '.$maxsize.' Mo !';

			$ext = strtolower(substr(strrchr($_FILES[$file]['name'][$index],'.'),1));
			
		}else {
				
			if (!isset($_FILES[$file]))
				return 'Fichier non-envoyé !';
			if ($_FILES[$file]['error'] > 0) {
				print_r($_FILES[$file]['error']);
				return 'Une Erreur est survenue lors du chargement du fichier ! (error: '.$_FILES[$file]['error'].')';
			}
			if (($_FILES[$file]['size'] /1024/1024) > $maxsize)
				return 'La taille du fichier doit être inferieure à '.$maxsize.' Mo !';

			$ext = strtolower(substr(strrchr($_FILES[$file]['name'],'.'),1));
		}
		 if (!in_array($ext,$exts)) {
		 	$listexts = implode(', ', $exts);
		 	return 'La format du fichier envoyé n\'est pas valide, seuls les fichiers avec extension '.$listexts.' sont valides';
		}

		return '';
	}

	public static function store($file, $path=null, $fileName=null, $fileExt=null, $index = null) {
		if (!$path) $path = Config::get('path-uploads');
		$fullFileName = null;
		if ($fileExt===null) {
			if ($index !== null)
				$fileExt = strtolower(substr(strrchr($_FILES[$file]['name'][$index],'.'), 1));
			else
				$fileExt = strtolower(substr(strrchr($_FILES[$file]['name'],'.'), 1));
		}
		if ($fileExt && !$fileExt[0] != '.') $fileExt = '.'.$fileExt;

		if (!file_exists($path) && !is_dir($path))
			mkdir($path, 0755, true);

		if ($fileName)
			$fullFileName = $fileName . $fileExt;
		else
			do {
				$fullFileName = Tools::randChars() . $fileExt;
			} while (file_exists($path . $fullFileName));
			
		if ($index !== null)
			move_uploaded_file($_FILES[$file]['tmp_name'][$index], $path . $fullFileName);
		else
			move_uploaded_file($_FILES[$file]['tmp_name'], $path . $fullFileName);
		return $fullFileName;
	}

	public static function checkUploadImage($file, $maxsize=null, $exts=null) {
		if (!$maxsize) $maxsize = Config::get('upload-file-image-max-size');
		if (!$exts) $exts = Config::get('upload-file-image-exts');
		return self::checkUpload($file, $maxsize, $exts);
	}

	public static function storeImage($file, $path=null, $name=null, $fileExt=null) {
		if (!$path) $path = Config::get('path-images');
		return self::store($file, $path, $name, $fileExt);
	}

	public static function delete($filepath) {
		try {
			if (file_exists($filepath))
				return unlink($filepath);
		}
		catch (Exception $e) { return false; }
	}
	public static function deleteDir($folderpath) {
		try {
			if (file_exists($folderpath) && is_dir($folderpath))
				return rmdir($folderpath);
		}
		catch (Exception $e) { return false; }
	}
}
