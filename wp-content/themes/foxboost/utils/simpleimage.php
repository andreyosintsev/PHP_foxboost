<?php 
class SimpleImage {
    var $image;
    var $image_type;
    function load($filename) {
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if( $this->image_type == IMAGETYPE_JPEG ) {
            $this->image = imagecreatefromjpeg($filename);
        } elseif( $this->image_type == IMAGETYPE_GIF ) {
            $this->image = imagecreatefromgif($filename);
        } elseif( $this->image_type == IMAGETYPE_PNG ) {
            $this->image = imagecreatefrompng($filename);
        }
    }
    function save($filename, $image_type=IMAGETYPE_JPEG, $compression=80, $permissions=null) {
        // do this or they'll all go to jpeg
        $image_type=$this->image_type;
        if( $image_type == IMAGETYPE_JPEG ) {
            imagejpeg($this->image,$filename,$compression);
        } elseif( $image_type == IMAGETYPE_GIF ) {
            imagegif($this->image,$filename);
        } elseif( $image_type == IMAGETYPE_PNG ) {
            // need this for transparent png to work
            imagealphablending($this->image, false);
            imagesavealpha($this->image,true);
            imagepng($this->image,$filename);
        }
        if( $permissions != null) {
            chmod($filename,$permissions);}
    }
    function output($image_type=IMAGETYPE_JPEG) {
        if( $image_type == IMAGETYPE_JPEG ) {
            imagejpeg($this->image);
        } elseif( $image_type == IMAGETYPE_GIF ) {
            imagegif($this->image);
        } elseif( $image_type == IMAGETYPE_PNG ) {
            imagepng($this->image);
        }
    }
    function getWidth() {
        return imagesx($this->image);
    }
    function getHeight() {
        return imagesy($this->image);
    }
    function resizeToHeight($height) {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width,$height);
    }
    function resizeToWidth($width) {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width,$height);
    }
    function scale($scale) {
        $width = $this->getWidth() * $scale/100;
        $height = $this->getheight() * $scale/100;
        $this->resize($width,$height);
    }
    function resize($width,$height,$forcesize='n') {
        /* optional. if file is smaller, do not resize. */
        if ($forcesize == 'n') {
            if ($width > $this->getWidth() && $height > $this->getHeight()){
                $width = $this->getWidth();
                $height = $this->getHeight();
            }
        }
        $new_image = imagecreatetruecolor($width, $height);
        /* Check if this image is PNG or GIF, then set if Transparent*/
        if(($this->image_type == IMAGETYPE_GIF) || ($this->image_type==IMAGETYPE_PNG)){
            imagealphablending($new_image, false);
            imagesavealpha($new_image,true);
            $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
            imagefilledrectangle($new_image, 0, 0, $width, $height, $transparent);
        }
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }
    function crop($x_o, $y_o, $w_o, $h_o) {
        if (($x_o < 0) || ($y_o < 0) || ($w_o < 0) || ($h_o < 0)) {
            echo "Некорректные входные параметры";
            return false;
        }
        $w_i = $this->getWidth();
        $h_i = $this->getHeight();

        if ($x_o + $w_o > $w_i) $w_o = $w_i - $x_o; // Если ширина выходного изображения больше исходного (с учётом x_o), то уменьшаем её
        if ($y_o + $h_o > $h_i) $h_o = $h_i - $y_o; // Если высота выходного изображения больше исходного (с учётом y_o), то уменьшаем её
        
        $new_image = imagecreatetruecolor($w_o, $h_o); // Создаём дескриптор для выходного изображения
    
        imagecopy($new_image, $this->image, 0, 0, $x_o, $y_o, $w_o, $h_o); // Переносим часть изображения из исходного в выходное
        $this->image = $new_image;    
    }
}