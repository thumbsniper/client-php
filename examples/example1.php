<?php

/*
 * Copyright (C) 2015  Thomas Schulte <thomas@cupracer.de>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

require_once('vendor/autoload.php');

use ThumbSniper\client\ThumbSniperClientSettings;
use ThumbSniper\client\ThumbSniperClient;

// configuration
ThumbSniperClientSettings::setTimezone("Europe/Berlin");
ThumbSniperClientSettings::setApiKey('http://mythumbsniper.example.com/');
ThumbSniperClientSettings::setApiKey(null);

$thumbsniper = new ThumbSniperClient();

?>

<html>
    <head>
        <title>ThumbSniper client example 1</title>
    </head>

    <body>
        <img src="<?php echo $thumbsniper->getThumbnailUrl("https://www.example.com", 240, "plain"); ?>" alt="Example.com" />
    </body>
</html>

