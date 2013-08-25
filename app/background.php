<?php

/* Snicky little thing. Is needed for the browser to
 * read as css
 */
header('Content-Type: text/css');

/* Loads the configuration.
 * $config is an array() holding the configuration.
 */
require('../config.php');

/* scandir() returns an array() of all the files, and directories,
 * in that folder. 
 */
$wallpapers = scandir("../".$config['wallpapers_folder']);

/* Removes the "." and ".." in *nix enviroments */
$wallpapers = array_diff($wallpapers, array('..', '.'));

/* Placeholder array() for the processed information the foreach() loop */
$nWallpapers = array();

/* Filters out all the files which starts with "." - as in hidden */

	/* 
	 * Derailment notes
	 *
	 * The reason for eliminating the "." files instead of filtering out
	 * .jpgs is so that it will support multiple image formats, without the need
	 * of mentioning every other format. But this do mean that every file in the
	 * folder have to be a web friendly picture format.
	 *
	 * Hypotesis: Is it faster? Is it computationally more heavy
	 * if the if() statement is more true than false?
	 *
	 * Probably not.
	 */

foreach($wallpapers as $wallpaper)
{
	if(preg_match("/^\./", $wallpaper))
	{
		/* Ignore that file */
	}
	else
	{
		/* Keep that file, probably a picture */
		$nWallpapers[] = $wallpaper;
	}
}

$wallpapers = $nWallpapers;

/*
 * array_rand() takes a random object out of the array
 */
$wallpaper = $wallpapers[array_rand($wallpapers, 1)];

echo '
	html {
		background: url("../'.$config['wallpapers_folder'].'/'.$wallpaper.'") no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	};
';

?>