<?php

declare(strict_types=1);

namespace Pharaun\ColorBuckets\Entity\Color;

/**
 * This class represent a set of color objects that can be manipulated upon.
 *
 * @package Pharaun\ColorBuckets\Entity\Color
 */
class Palette implements \Countable, \Iterator {
    
    /* ------------------------------------ Class Property START --------------------------------------- */

    /**
     * Internal container for colors within this palette.
     * @var array 
     */
    private $colorContainer = [];
    
    /* ------------------------------------ Class Property END ----------------------------------------- */

    /* ------------------------------------ Class Methods START ---------------------------------------- */

    /**
     * Add a new color to this palette.
     * 
     * @param Color $color
     * @return \Pharaun\ColorBuckets\Entity\Color\Palette
     */
    public function addColor(\Pharaun\ColorBuckets\Entity\Color\Color $color): \Pharaun\ColorBuckets\Entity\Color\Palette {
        $footprint = $color->getFootprint();
        if (array_key_exists($footprint, $this->colorContainer)) {
            throw new \InvalidArgumentException('Specified color already exists in this palette. ['.$footprint.'] '.__METHOD__);
        }
        
        $this->colorContainer[$footprint] = $color;
        return $this;
    }

    /**
     * Remove specified colors from the current palette.
     * 
     * @param \Pharaun\ColorBuckets\Entity\Color\Palette $to_remove
     * @return \Pharaun\ColorBuckets\Entity\Color\Palette
     */
    public function removeColors(\Pharaun\ColorBuckets\Entity\Color\Palette $to_remove): \Pharaun\ColorBuckets\Entity\Color\Palette {
        foreach ($to_remove as $key => $val) {
            if (array_key_exists($key, $this->colorContainer)) {
                unset($this->colorContainer[$key]);
            }
        }
        
        return $this;
    }
    
    /**
     * Sort current color palette using color weights with a descending order.
     * 
     * @return \Pharaun\ColorBuckets\Entity\Color\Palette
     */
    public function sortByWeightDesc(): \Pharaun\ColorBuckets\Entity\Color\Palette {
        uasort($this->colorContainer, function(\Pharaun\ColorBuckets\Entity\Color\Color $v1, \Pharaun\ColorBuckets\Entity\Color\Color $v2): int {
            return -1*($v1->getWeight() <=> $v2->getWeight());
        });
        
        return $this;
    }


    /**
     * Reduce the current color palette to the first $max_color_count colors.
     * 
     * @param int $max_color_count
     * @return \Pharaun\ColorBuckets\Entity\Color\Palette
     */
    public function limitColorCount(int $max_color_count = 3): \Pharaun\ColorBuckets\Entity\Color\Palette {
        if ($max_color_count < 0) {
            throw new \InvalidArgumentException('Maximum color count must carry a non-negative value'.__METHOD__);
        }
        
        $this->colorContainer = array_slice($this->colorContainer, 0, $max_color_count);
        return $this;
    }
    
    /**
     * Reduce current color set by removing similar colors. Colors weights will be dropped for removed colors unless $append_weight is set to true which will cause the weights
     * of dropped colors to be added to the initial similar color.
     * 
     * $param bool $append_weight
     * @param float $similarity_factor
     * @return \Pharaun\ColorBuckets\Entity\Color\Palette
     */
    public function combineSimilarities(bool $append_weight = true, float $similarity_factor = 0.15): \Pharaun\ColorBuckets\Entity\Color\Palette {
        if ($similarity_factor < 0 || $similarity_factor > 1) {
            throw new \InvalidArgumentException('The similarity factor parameter accepts values between 0 and 1 only. '.__METHOD__);
        }
        
        // initialize 
        $keep = [];
        $copy_matrix = [];
        
        // create a copy to work with
        foreach ($this as $color) {
            $copy_matrix[] = [
                'color' => $color,
                'imagick' => new \ImagickPixel($color->getColorAsImagickString()),
            ];
        }
        
        // iterate over the copy and remove any colors that are similar to any colors that we already decided to keep
        while (count($copy_matrix)) {
            $entry = array_shift($copy_matrix);

            $remove = false;
            foreach ($keep as $kept) {
                if ($entry['imagick']->isPixelSimilar($kept['imagick'], $similarity_factor)) {
                    $remove = true;
                    if ($append_weight) $kept['color']->setWeight($kept['color']->getWeight() + $entry['color']->getWeight());
                    break;
                }
            }

            $remove or $keep[] = $entry;
        }

        // restore main container based on the resulting set
        $this->colorContainer = [];
        foreach ($keep as $entry) {
            $this->addColor($entry['color']);
        }
        
        return $this;
    }

    /**
     * Save this palette as a JPEG image.
     * 
     * @param string $filename
     * @param string $path
     * @return \Pharaun\ColorBuckets\Entity\Color\Palette
     */
    public function writeToJPEGFile(string $filename, string $path = './'): \Pharaun\ColorBuckets\Entity\Color\Palette {
        if (!mb_strlen($filename)) {
            throw new \InvalidArgumentException('Invalid filename specified. '.__METHOD__);
        }
        
        $path = realpath($path);
        if (!is_writeable($path)) {
            throw new \InvalidArgumentException('Specified path is not writable. '.__METHOD__);
        }

        if (!count($this)) {
            throw new \InvalidArgumentException('Empty palette cannot be written to a file. '.__METHOD__);
        }
        
        // add ext if necessary
        preg_match('/\.jpg$/', $filename) === false or $filename .= '.jpg';
        
        // get colors as imagick objects
        $colors = [];
        foreach ($this->colorContainer as $color) {
            /** @var \Pharaun\ColorBuckets\Entity\Color\Color $color */
            $colors[] = new \ImagickPixel($color->getColorAsImagickString());
        }

        // draw the palette
        $draw = new \ImagickDraw();
        $index = 0;
        foreach ($colors as $color) {
            $draw->setFillColor($color);
            $draw->rectangle(0, $index*100, 199, $index*100+99);

            $index++;
        }

        $output = new \Imagick();
        $output->newImage(200, $index*100, new \ImagickPixel('white'));
        $output->setImageFormat("jpg");
        $output->drawImage($draw);

        $output->writeImage($path.DIRECTORY_SEPARATOR.$filename);
        
        return $this;
    }
    
    /* ------------------------------------ Class Methods END ------------------------------------------ */
    
    /* ------------------------------------ Abstract methods START ------------------------------------- */

    /**
     * @see \Countable.count()
     */
    public function count(): int {
        return count($this->colorContainer);
    }

    /**
     * @see \Iterator::current()
     */
    public function current() {
        return current($this->colorContainer);
    }

    /**
     * @see \Iterator::next()
     */
    public function next() {
        next($this->colorContainer);
    }

    /**
     * @see \Iterator::key()
     */
    public function key() {
        return key($this->colorContainer);
    }

    /**
     * @see \Iterator::valid()
     */
    public function valid() : bool {
        return array_key_exists($this->key(), $this->colorContainer);
    }

    /**
     * @see \Iterator::rewind()
     */
    public function rewind() {
        reset($this->colorContainer);
    }
    
    /* ------------------------------------ Abstract methods END --------------------------------------- */
}