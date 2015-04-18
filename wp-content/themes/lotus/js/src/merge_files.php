<?php
/**
 * A Tool for merging several files into one
 * Merging JS files in one file, will speed up page load time
 *
 * @package    Axiom
 * @author     averta
 * @copyright  Copyright (c) averta co
 * @version    Release: 1.0
 * @link       http://www.averta.net
 */
 
  
 exit("No Naughty Business Please !");
 
 $input_files = array( 'init.superfish.js', 'init.averta.js', 'init.retina.js',
                       'resize.js', 'init.isotope.js', 'init.carousel.js', 
                       'init.map.js', 'init.highlightjs.js', 'click.js', 
                       'elements.js', 'pages.js', 'init.chart.js', 
                       'init.prettyphoto.js', 'contact-form7.js' );
                       
 $output_file = "../script.js";
 $combined    = "";
 
 
 
 foreach ($input_files as $file) {
     $combined .= "/* ================== " . $file . " =================== */\n\n" . file_get_contents($file) . "\n\n";
 }
 
 file_put_contents($output_file, $combined);
 
 exit("All Merged");
?>
