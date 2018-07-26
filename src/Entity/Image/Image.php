<?php

declare(strict_types=1);

namespace Pharaun\ColorBuckets\Entity\Image;

/**
 * This class represents a single image for processing.
 *
 * @package Pharaun\ColorBuckets\Entity\Image
 */
class Image {
    
    /* ------------------------------------ Class Property START --------------------------------------- */

    /**
     * Internal storage for the imagick object. 
     * 
     * @var \Imagick
     */
    private $image = null;
    
    /* ------------------------------------ Class Property END ----------------------------------------- */

    /* ------------------------------------ Magic methods START ---------------------------------------- */

    /**
     * Image constructor.
     *
     * @param string $file
     */
    public function __construct(string $file) {
        $file = realpath($file);
        if (!is_readable($file)) {
            throw new \InvalidArgumentException('Unreadable file specified. '.__METHOD__);
        }
        
        try {
            $this->image = new \Imagick($file);
            $this->image->setImageFormat('jpg');
        } catch (\ImagickException $e) {
            throw new \InvalidArgumentException('Cannot create an imagick handle for the specified file. [ImagicException: '.$e->getMessage().'] '.__METHOD__);
        }
    }

    /* ------------------------------------ Magic methods END ------------------------------------------ */
    
    /* ------------------------------------ Class Methods START ---------------------------------------- */

    /**
     * Resize and crop current image to the size of 250x250 - it's far less costly to do this and analyze the thumbnail instead of
     * analyzing a large image pixel by pixel.
     * 
     * @return \Pharaun\ColorBuckets\Entity\Image\Image
     */
    public function resizeAndCrop(): \Pharaun\ColorBuckets\Entity\Image\Image {
        $this->image->thumbnailImage(250, 250, true, true);
        return $this;
    }
    
    /**
     * Reduce the number of colors in the image to the maximum of $max_color_count. 
     * 
     * @param int $max_color_count
     * @param int $color_space
     * @return \Pharaun\ColorBuckets\Entity\Image\Image
     */
    public function quantizeColors(int $max_color_count = 8, int $color_space = \Imagick::COLORSPACE_CMYK): \Pharaun\ColorBuckets\Entity\Image\Image {
        if ($max_color_count < 1) {
            throw new \InvalidArgumentException('Maximum color count must be a positive value. '.__METHOD__);
        }
        
        $this->image->quantizeImage($max_color_count, $color_space, 0, false, false);
        return $this;
    }

    /**
     * Write current state of the image to the specified file.
     * 
     * @param string $filename
     * @param string $path
     * @return \Pharaun\ColorBuckets\Entity\Image\Image
     */
    public function writeToJPEGFile(string $filename, string $path = './'): \Pharaun\ColorBuckets\Entity\Image\Image {
        if (!mb_strlen($filename)) {
            throw new \InvalidArgumentException('Invalid filename specified. '.__METHOD__);
        }

        $path = realpath($path);
        if (!is_writeable($path)) {
            throw new \InvalidArgumentException('Specified path is not writable. '.__METHOD__);
        }

        // add ext if necessary
        preg_match('/\.jpg$/', $filename) === false or $filename .= '.jpg';
        
        // write the image
        $this->image->writeImage($path.DIRECTORY_SEPARATOR.$filename);
        return $this;
    }
    
    /**
     * Get the color palette for current image. 
     * 
     * @return \Pharaun\ColorBuckets\Entity\Color\Palette
     */
    public function getColorPalette(): \Pharaun\ColorBuckets\Entity\Color\Palette {
        // initialize
        $color_count = [];
        $iterator    = $this->image->getPixelIterator();
        $palette = new \Pharaun\ColorBuckets\Entity\Color\Palette();
        
        // get color distribution
        foreach ($iterator as $rows => $pixels) {
            foreach ($pixels as $cols => $pixel) {
                $colors = $pixel->getColor();

                isset($color_count[$colors['r'] . '::' . $colors['g'] . '::' . $colors['b']]) or $color_count[$colors['r'] . '::' . $colors['g'] . '::' . $colors['b']] = 0;
                $color_count[$colors['r'] . '::' . $colors['g'] . '::' . $colors['b']]++;
            }
        }

        // create the color palette
        foreach ($color_count as $color => $weight) {
            $color = explode("::", $color);
            $palette->addColor(new \Pharaun\ColorBuckets\Entity\Color\Color((int)$color[0], (int)$color[1], (int)$color[2], $weight));
        }
        
        return $palette;
    }
    
    /**
     * Fetch a color palette consisting of detected image background colors.
     * 
     * @return \Pharaun\ColorBuckets\Entity\Color\Palette
     */
    public function getBackgroundPalette(): \Pharaun\ColorBuckets\Entity\Color\Palette {
        $palette = new \Pharaun\ColorBuckets\Entity\Color\Palette();

        // top/left background
        $backgroundTL = $this->image->getImagePixelColor(0, 0)->getColor();
        $backgroundTC = $this->image->getImagePixelColor((int)(($this->image->getImageWidth())/2), 0)->getColor();
        
        $palette->addColor(new \Pharaun\ColorBuckets\Entity\Color\Color($backgroundTL['r'], $backgroundTL['g'], $backgroundTL['b']));
        $backgroundTC === $backgroundTL or $palette->addColor(new \Pharaun\ColorBuckets\Entity\Color\Color($backgroundTC['r'], $backgroundTC['g'], $backgroundTC['b']));
        
        return $palette;
    }
    
    /* ------------------------------------ Class Methods END ------------------------------------------ */
    
}