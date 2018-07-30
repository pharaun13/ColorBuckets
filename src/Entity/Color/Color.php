<?php

declare(strict_types=1);

namespace Pharaun\ColorBuckets\Entity\Color;

/** 
 * Objects built based on this class represent a single color entity defined in the RGB space along with it's weight in an unspecified context.
 *
 * @package Pharaun\ColorBuckets
 */
class Color {
    
    /* ------------------------------------ Class Property START --------------------------------------- */

    /**
     * Red channel value.
     * @var int
     */
    private $red = null;

    /**
     * Green channel value.
     * @var int
     */
    private $green = null;

    /**
     * Blue channel value.
     * @var int
     */
    private $blue = null;

    /**
     * Color weight.
     * @var int 
     */
    private $weight = null;
    
    /* ------------------------------------ Class Property END ----------------------------------------- */

    /* ------------------------------------ Magic methods START ---------------------------------------- */

    /**
     * Color constructor.
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     * @param int $weight
     */
    public function __construct(int $red, int $green, int $blue, int $weight = 0) {
        $this
            ->setRed($red)
            ->setGreen($green)
            ->setBlue($blue)
            ->setWeight($weight);
    }
    
    /* ------------------------------------ Magic methods END ------------------------------------------ */

    /* ------------------------------------ Class Methods START ---------------------------------------- */

    /**
     * Fetch a string footprint that represents the color stored in this object.
     * 
     * @return string
     */
    public function getFootprint(): string {
        return $this->getRed().'::'.$this->getGreen().'::'.$this->getBlue();
    }


    /**
     * Fetch this color as an imagick color string.
     * 
     * @return string
     */
    public function getColorAsImagickString(): string {
        return 'rgb('.$this->getRed().','.$this->getGreen().','.$this->getBlue().')';
    }
    
    /**
     * Fetch this color as a corresponding integer value.
     * 
     * @return int
     */
    public function getColorAsInteger(): int {
        return hexdec($this->getColorAsHex());
    }
    
    /**
     * Fetch this color definitions as an RGB hex value.
     * 
     * @return string
     */
    public function getColorAsHex(): string {
        $hexR = dechex($this->getRed());
        mb_strlen($hexR) === 1 and $hexR = '0'.$hexR;

        $hexG = dechex($this->getGreen());
        mb_strlen($hexG) === 1 and $hexG = '0'.$hexG;

        $hexB = dechex($this->getBlue());
        mb_strlen($hexB) === 1 and $hexB = '0'.$hexB;
        
        return $hexR.$hexG.$hexB;
    }
    
    /* ------------------------------------ Class Methods END ------------------------------------------ */
    
    /* ------------------------------------ Setters & Getters START ------------------------------------ */

    /**
     * @return int
     */
    public function getRed(): int {
        return $this->red;
    }

    /**
     * @param int $red
     * @return \Pharaun\ColorBuckets\Entity\Color\Color
     */
    public function setRed(int $red): \Pharaun\ColorBuckets\Entity\Color\Color {
        if ($red < 0 || $red > 255) {
            throw new \InvalidArgumentException('Channel values allow only for integet values between 0 and 255. '.__METHOD__);
        }
        
        $this->red = $red;
        return $this;
    }

    /**
     * @return int
     */
    public function getGreen(): int {
        return $this->green;
    }

    /**
     * @param int $green
     * @return \Pharaun\ColorBuckets\Entity\Color\Color
     */
    public function setGreen(int $green): \Pharaun\ColorBuckets\Entity\Color\Color {
        if ($green < 0 || $green > 255) {
            throw new \InvalidArgumentException('Channel values allow only for integet values between 0 and 255. '.__METHOD__);
        }
        
        $this->green = $green;
        return $this;
    }

    /**
     * @return int
     */
    public function getBlue(): int {
        return $this->blue;
    }

    /**
     * @param int $blue
     * @return \Pharaun\ColorBuckets\Entity\Color\Color
     */
    public function setBlue(int $blue): \Pharaun\ColorBuckets\Entity\Color\Color {
        if ($blue < 0 || $blue > 255) {
            throw new \InvalidArgumentException('Channel values allow only for integet values between 0 and 255. '.__METHOD__);
        }
        
        $this->blue = $blue;
        return $this;
    }
    
    /**
     * @return int
     */
    public function getWeight(): int {
        return $this->weight;
    }

    /**
     * @param int $weight
     * @return \Pharaun\ColorBuckets\Entity\Color\Color
     */
    public function setWeight(int $weight): \Pharaun\ColorBuckets\Entity\Color\Color {
        if ($weight < 0) {
            throw new \InvalidArgumentException('Weight value must be non-negative. '.__METHOD__);
        }
        
        $this->weight = $weight;
        return $this;
    }
    
    /* ------------------------------------ Setters & Getters END -------------------------------------- */
    
}