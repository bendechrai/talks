<?php

ini_set('memory_limit','1G');
$array_size = 1000000;
$max_display = 50;

echo "\nBuilding 2 sets of $array_size items with unique values\n";
$start = microtime(true);
$set1 = $set2 = array(1);
while( count($set1) < $array_size ) $set1[] = end($set1)+rand(1,2);
while( count($set2) < $array_size ) $set2[] = end($set2)+rand(1,2);
echo "completed in " . (microtime(true)-$start) . " seconds\n";

echo "\nBuilding 2 sets of $array_size items with unique values\n";
$start = microtime(true);
$set4 = $set5 = array(1);
$last = 1; while( count($set4) < $array_size ) { $last += rand(1,2); $set4[$last] = true; }
$last = 1; while( count($set5) < $array_size ) { $last += rand(1,2); $set5[$last] = true; }
echo "completed in " . (microtime(true)-$start) . " seconds\n";
/*
if( $array_size <= $max_display ) display($set1);
if( $array_size <= $max_display ) display($set2);

echo "Performing merge          - ";
$start = microtime(true);
$set3 = array_unique( array_merge( $set1, $set2 ) );
echo "completed in " . (microtime(true)-$start) . " seconds\n";

if( $array_size <= $max_display ) display($set3);

echo "Performing intersect      - ";
$start = microtime(true);
$set3 = array_intersect( $set1, $set2 );
echo "completed in " . (microtime(true)-$start) . " seconds\n";

if( $array_size <= $max_display ) display($set3);

echo "Performing diff           - ";
$start = microtime(true);
$set3 = array_diff( $set1, $set2 );
echo "completed in " . (microtime(true)-$start) . " seconds\n";

if( $array_size <= $max_display ) display($set3);

echo "\n";
*/
echo "Flipping both arrays to give $array_size unique keys\n";
$start = microtime(true);
$set1 = array_flip($set1);
$set2 = array_flip($set2);
echo "completed in " . (microtime(true)-$start) . " seconds\n";
die();
if( $array_size <= $max_display ) display(array_keys($set1));
if( $array_size <= $max_display ) display(array_keys($set2));

echo "Performing key merge      - ";
$start = microtime(true);
$set3 = $set1 + $set2;
echo "completed in " . (microtime(true)-$start) . " seconds\n";

if( $array_size <= $max_display ) display(array_keys($set3));

echo "Performing key intersect  - ";
$start = microtime(true);
$set3 = array_intersect_key( $set1, $set2 );
echo "completed in " . (microtime(true)-$start) . " seconds\n";

if( $array_size <= $max_display ) display(array_keys($set3));

echo "Performing key diff       - ";
$start = microtime(true);
$set3 = array_diff_key( $set1, $set2 );
echo "completed in " . (microtime(true)-$start) . " seconds\n";

if( $array_size <= $max_display ) display(array_keys($set3));

echo "\n";

function display( $array ) {
	echo "Contents: ";
	foreach( $array as $key=>$val ) {
		echo "$val ";
	}
	echo "\n";
}
