<?php
namespace App\View\Helper;

use Cake\View\Helper;

class GraphicHelper extends Helper {
    /**
     * thumbnail builder
     *
     * @param string $imageFilename of file
     * @return string
     */
	public function thumbnail($imageFilename) {
		$filenameSplit = explode('.', $imageFilename);
		$thumbnailFilename = array_slice($filenameSplit, 0, count($filenameSplit) - 1);
		$thumbnailFilename[] = 'thumb';
		$thumbnailFilename[] = end($filenameSplit);

		return implode('.', $thumbnailFilename);	
	}
}