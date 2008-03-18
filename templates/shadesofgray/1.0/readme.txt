= SHADES OF GRAY =

== ABOUT SHADES OF GRAY==

Shades of Gray is a CSS style theme designed for use with the Sandbox Theme (http://www.sndbx.org)  for Wordpress. It was created by Leslie Franke (http://lesliefranke.com) and is licensed under the GNU General Public License.

== USING THIS DESIGN ==

** Please see howtoinstall.txt for information on installing this design.

== SHADES OF GRAY FILES ==

The Shades of Gray zip file you have downloaded should contain the following files and directories.

sandbox-shadesofgray.zip [CONTAINS:]
	/shadesofgray/ [FOLDER]
		readme.txt
		style.css
		screenshot.png
		/images/ [SUBFOLDER]
			arrow_right.png
			arrow_rightbw.png
			datebw.png
			favicon.png
			feed-icon-14x14.png
			feed-icon-14x14bw.png
			icon_padlock.png
			icon_padlockbw.png
			mast.jpg
			quickly.png
			quoteup.png
			star.png
			starbw.png

== SHADES OF GRAY IMAGES ==

The panaoramic image spreading across the top of the page is a 1911 image of Akron, Ohio available from the American Memory Project, U.S. Library of Congress (http://memory.loc.gov/pnp/pan/6a15000/6a15400/6a15425r.jpg). Some of the icons in Shades of Gray have been adapted from the "Mini" (http://www.famfamfam.com/lab/icons/mini/) icon collection by Mark James. The Feed Icons are from http://www.feedicons.com/.

You should replace the icon in the top left corner of the screen and the panaoramic image spreading across the top of the page with images of your own. 

The image in the top left hand corner of the screen is designed to hold the favicon of your site but any image will do. T. replace this image create a 16x16 PNG image, give it the name of favicon.png, and drop it in the Shades of Gray images subdirectory replacing the image already there.

To replace the panaoramic image across the top of the page create a JPG image, 1200x175 in size, rename it mast.gif, and place it in the Shades of Gray images subdirectory overwriting the image already there.

== SHADES OF GRAY THEME ADJUSTMENTS==

By default the Shades of Gray theme includes numerous print styles to format the page for printing. This will cause the printed page to look different than the page on the screen. If you wish to remove these styles from your site delete the the lines in the last part of the file style.css that begins with the line '/* Printing' to the end of the file.

Shades of Gray is also designed to format a Wordpress category named 'Asides' differntly than other categories. If desired you can use a different category for this treatment by replacing the string '.category-asides' in the Asides portion of the style sheet (near the bottom) with the category name you wish to use. For example if you wanted to use a replacement category of 'elsewhere' you would use the string '.category-elsewhere' (without the single quotes). Alternatively, you could just delete the asides portion of the style sheet if you did not want this formatting to occur with any category.

== LICENSE ==

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but without any warranty; without even the implied warranty of merchantability or fitness for a particular purpose. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc, 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.