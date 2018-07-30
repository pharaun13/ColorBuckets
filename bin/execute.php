<?php
    // init
    require_once '../vendor/autoload.php';

    // definitions
    $DIR_input = '../input';
    $DIR_output = '../output';
    $CON_line = 50;

    // establish files for processing
    $directory = new \DirectoryIterator($DIR_input);
    $files = [];
    
    foreach ($directory as $file ) {
        $name = $file->getFilename();
    
        // skip special files
        if ($name[0] === '.') continue;
    
        // generate the output filename
        $output_name = explode('.', $name)[0];
    
        $files[] = [
            'input' => $name,
            'output' => $output_name
        ];
    }

    echo "Files to process: [".count($files)."]".\PHP_EOL;
    $index = 0;

    $normalizer = new \Pharaun\ColorBuckets\Normalization\Color\Set();
    foreach ($files as $file ) {
        $image = new \Pharaun\ColorBuckets\Entity\Image\Image($DIR_input.DIRECTORY_SEPARATOR.$file['input']);
        $image
            ->writeToJPEGFile($file['output'].'-1-original', $DIR_output)
            ->quantizeColors(12)
            ->writeToJPEGFile($file['output'].'-2-quantized', $DIR_output);
        
        $palette = $image
            ->getColorPalette()
            ->removeColors($image->getBackgroundPalette())
            ->sortByWeightDesc()
            ->combineSimilarities(true, 0.15)
            ->sortByWeightDesc()
            ->limitColorCount()
            ->writeToJPEGFile($file['output'].'-3-palette', $DIR_output);

        $mapped_palette = new \Pharaun\ColorBuckets\Entity\Color\Palette();
        foreach ($palette as $pal_col) {
            try {
                $mapped_palette->addColor($normalizer->mapColor($pal_col, true));
            } catch (\InvalidArgumentException $e) {}
        }

        $mapped_palette->writeToJPEGFile($file['output'].'-4-mapped-palette', $DIR_output);
        
        echo ".";
        $index++;
        if ($index % $CON_line === 0) echo '['.$index.'/'.count($files).']'.\PHP_EOL;
    }

    // output completion
    while ($index % $CON_line !== 0) {
        $index++;
        echo " ";
    }

    echo '['.count($files).'/'.count($files).']'.\PHP_EOL;