<?php
$talks = array();
if( $dir = opendir( dirname(__FILE__) ) ) {
	while( false !== ( $file = readdir( $dir ) ) ) {
		if( $file{0} == '.' ) continue;
		if( is_dir( $file ) ) {

			// Get date and title
			list( $date, $title, $location ) = explode( '_', $file, 3 );

			// Parse date
			preg_match( '#^([0-9]{4})([0-9]{2})([0-9]{2})?$#', $date, $matches );
			if( is_null( $matches[3] ) ) {
				$date = date( 'F Y', mktime( 0, 0, 0, $matches[2], 1, $matches[1] ) );
			} else {
				$date = date( 'jS F Y', mktime( 0, 0, 0, $matches[2], $matches[3], $matches[1] ) );
				$date = date( 'jS F Y', mktime( 0, 0, 0, 9, $matches[3], $matches[1] ) );
			}

			$talks[] = array(
				'date'     => $date,
				'title'    => str_replace( '-', ' ', $title),
				'location' => str_replace( '-', ' ', $location),
				'dir'      => $file
			);
		}
	}
	closedir( $dir );
}

?><!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=1024" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<title>Talks and Presentations</title>
	<meta name="author" content="Ben Dechrai" />
	<link href=".assets/css/font-awesome.css" rel="stylesheet">
	<!--[if IE 7]>
	<link rel="stylesheet" href="awesome/css/font-awesome-ie7.min.css">
	<![endif]-->
	<link href=".assets/css/bendechrai.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet" />
</head>
<body>
	<h1>Talks and Presentations</h1>
	<h2>by Ben Dechrai</h2>
	<div class="talks">
		<?php foreach( $talks as $talk ) : ?>
		<div class="talk">
			<p class="date"><?php echo $talk['date'] ?></p>
			<h3><a href="<?php echo $talk['dir'] ?>"><?php echo htmlspecialchars( $talk['title'] ) ?></a></h3>
			<p class="location"><?php echo htmlspecialchars( $talk['location'] ) ?></p>
		</div>
		<?php endforeach; ?>
	</div>
</body>
</html>
