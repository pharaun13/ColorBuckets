<?php

declare(strict_types=1);

namespace Pharaun\ColorBuckets\Normalization\Color;

/**
 * This class contains the normalized color set.
 *
 * @package Pharaun\ColorBuckets\Normalization\Color
 */
class Set {
    
    /* ------------------------------------ Class Property START --------------------------------------- */
    
    /**
     * Normalized color set definition.
     */
    public const COLOR_SET = [
        // bugn
        '1-bugn-1' => 'F6FBFC',
        '1-bugn-2' => 'E1F4F8',
        '1-bugn-3' => 'C5E9E2',
        '1-bugn-4' => '8ED3C2',
        '1-bugn-5' => '5BBB9A',
        '1-bugn-6' => '39A46B',
        '1-bugn-7' => '20803C',
        '1-bugn-8' => '014E20',
        
        // gnbu
        '2-gnbu-1' => 'F6FCED',
        '2-gnbu-2' => 'DBF1D6',
        '2-gnbu-3' => 'C5E8BE',
        '2-gnbu-4' => '9ED8AC',
        '2-gnbu-5' => '70C5BC',
        '2-gnbu-6' => '45AACD',
        '2-gnbu-7' => '2681B6',
        '2-gnbu-8' => '064E93',

        // greens
        '3-greens-1' => 'F6FCF3',
        '3-greens-2' => 'E1F4DC',
        '3-greens-3' => 'C0E6B8',
        '3-greens-4' => '97D390',
        '3-greens-5' => '69BC6B',
        '3-greens-6' => '39A153',
        '3-greens-7' => '20803C',
        '3-greens-8' => '014F2C',

        // ylgn
        '4-ylgn-1' => 'FFFEE1',
        '4-ylgn-2' => 'F5FCB0',
        '4-ylgn-3' => 'D4ED99',
        '4-ylgn-4' => 'A4D883',
        '4-ylgn-5' => '6DBE6E',
        '4-ylgn-6' => '39A153',
        '4-ylgn-7' => '20793A',
        '4-ylgn-8' => '014F2C',

        // ylgnbu
        '5-ylgnbu-1' => 'FFFED3',
        '5-ylgnbu-2' => 'EAF7A8',
        '5-ylgnbu-3' => 'C0E5AB',
        '5-ylgnbu-4' => '74C6B3',
        '5-ylgnbu-5' => '39ADBC',
        '5-ylgnbu-6' => '1A86B8',
        '5-ylgnbu-7' => '1F549E',
        '5-ylgnbu-8' => '0E2779',
        
        // bupu
        '6-bupu-1' => 'F6FBFC',
        '6-bupu-2' => 'DCE9F2',
        '6-bupu-3' => 'B7CDE2',
        '6-bupu-4' => '93B3D5',
        '6-bupu-5' => '808BBE',
        '6-bupu-6' => '8060A7',
        '6-bupu-7' => '7C3992',
        '6-bupu-8' => '621560',

        // pubu
        '7-pubu-1' => 'FFF6FA',
        '7-pubu-2' => 'E9E4F0',
        '7-pubu-3' => 'C9CBE2',
        '7-pubu-4' => '9CB4D5',
        '7-pubu-5' => '689FC8',
        '7-pubu-6' => '2F85B8',
        '7-pubu-7' => '0565A6',
        '7-pubu-8' => '04456F',

        // pubugn
        '8-pubugn-1' => 'FFF6FA',
        '8-pubugn-2' => 'E9DEEE',
        '8-pubugn-3' => 'C9CBE2',
        '8-pubugn-4' => '9CB4D5',
        '8-pubugn-5' => '689FC8',
        '8-pubugn-6' => '2F85B8',
        '8-pubugn-7' => '00767F',
        '8-pubugn-8' => '015947',

        // purples
        '9-purples-1' => 'FBFAFC',
        '9-purples-2' => 'EDEAF3',
        '9-purples-3' => 'D4D5E8',
        '9-purples-4' => 'B4B5D7',
        '9-purples-5' => '938FC1',
        '9-purples-6' => '7472B2',
        '9-purples-7' => '5F4799',
        '9-purples-8' => '40177B',

        // purd
        '10-purd-1' => 'F6F2F8',
        '10-purd-2' => 'E4DDED',
        '10-purd-3' => 'CEB1D4',
        '10-purd-4' => 'C289C0',
        '10-purd-5' => 'DB5AA6',
        '10-purd-6' => 'E3267E',
        '10-purd-7' => 'C71E4B',
        '10-purd-8' => '861437',

        // rdpu
        '11-rdpu-1' => 'FFF6F1',
        '11-rdpu-2' => 'FDDCD8',
        '11-rdpu-3' => 'FCBDB8',
        '11-rdpu-4' => 'F995AC',
        '11-rdpu-5' => 'F65D97',
        '11-rdpu-6' => 'D82E8C',
        '11-rdpu-7' => 'A51E73',
        '11-rdpu-8' => '6E186C',

        // reds
        '12-reds-1' => 'FFF3ED',
        '12-reds-2' => 'FEDBCC',
        '12-reds-3' => 'FCB297',
        '12-reds-4' => 'FC8766',
        '12-reds-5' => 'FA5F41',
        '12-reds-6' => 'ED3327',
        '12-reds-7' => 'C41A1B',
        '12-reds-8' => '8E1310',

        // oranges
        '13-oranges-1' => 'FFF4E8',
        '13-oranges-2' => 'FEE2C7',
        '13-oranges-3' => 'FCCA98',
        '13-oranges-4' => 'FDA560',
        '13-oranges-5' => 'FD8135',
        '13-oranges-6' => 'EF5E14',
        '13-oranges-7' => 'D43F01',
        '13-oranges-8' => '812805',

        // orred
        '14-orred-1' => 'FFF6E9',
        '14-orred-2' => 'FEE5C1',
        '14-orred-3' => 'FCCE94',
        '14-orred-4' => 'FDB378',
        '14-orred-5' => 'FC824F',
        '14-orred-6' => 'EC5940',
        '14-orred-7' => 'D12A1D',
        '14-orred-8' => '8E1300',

        // ylorbr
        '15-ylorbr-1' => 'FFFEE1',
        '15-ylorbr-2' => 'FFF6B3',
        '15-ylorbr-3' => 'FEDF86',
        '15-ylorbr-4' => 'FEBC46',
        '15-ylorbr-5' => 'FE8E24',
        '15-ylorbr-6' => 'E96514',
        '15-ylorbr-7' => 'C54202',
        '15-ylorbr-8' => '812805',

        // greys
        '16-greys-1' => 'FFFFFF',
        '16-greys-2' => 'F3F3F3',
        '16-greys-3' => 'ECECEC',
        '16-greys-4' => 'D0D0D0',
        '16-greys-5' => '848484',
        '16-greys-6' => '5F5F5F',
        '16-greys-7' => '414141',
        '16-greys-8' => '000000',
    ];

    /**
     * Internal storage for the calculator object.
     * 
     * @var \Pharaun\ColorBuckets\Calculation\Color\Distance
     */
    private $distanceCalculator = null;
    
    /* ------------------------------------ Class Property END ----------------------------------------- */

    /* ------------------------------------ Magic methods START ---------------------------------------- */

    /**
     * Set constructor.
     */
    public function __construct() {
        $this->distanceCalculator = new \Pharaun\ColorBuckets\Calculation\Color\Distance();
    }

    /* ------------------------------------ Magic methods END ------------------------------------------ */
    
    /* ------------------------------------ Class Methods START ---------------------------------------- */

    /**
     * Fetch the normalized version of the specified color. 
     * 
     * @param \Pharaun\ColorBuckets\Entity\Color\Color $color
     * @param bool $include_weight
     * @return \Pharaun\ColorBuckets\Entity\Color\Color
     */
    public function mapColor(\Pharaun\ColorBuckets\Entity\Color\Color $color, bool $include_weight = false): \Pharaun\ColorBuckets\Entity\Color\Color {
        $distance = null;
        $chosen = null;
        
        foreach (self::COLOR_SET as $reference_key => $reference_color) {
            $reference_color = \Pharaun\ColorBuckets\Entity\Color\Color::fromHex($reference_color);
            $local_distance = $this->distanceCalculator->deltaECIE2000($color->getColorAsRGBArray(), $reference_color->getColorAsRGBArray());
            
            if (is_null($distance) || $distance > $local_distance) {
                $distance = $local_distance;
                $chosen = $reference_key;
            }
        }
        
        $result = \Pharaun\ColorBuckets\Entity\Color\Color::fromHex(self::COLOR_SET[$chosen]);
        if ($include_weight) {
            $chosen = explode('-', $chosen);
            $result->setWeight((int)($chosen[0].$chosen[2]));
        }
        
        return $result;
    }
    
    /* ------------------------------------ Class Methods END ------------------------------------------ */
}