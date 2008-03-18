/* About the skin */

Diurnal is a 5-in-1 theme which uses Sandbox's dynamic classes to change appearance according to the time of day; there are skins for sunrise, morning, afternoon, sunset and night. It is intended for use in conjunction with the stylesheets in the sandbox-layouts directory, for maximum flexibility (and because I hate positioning). The skyline is not any particular city that I know of. I just used characters 'm' and 'n' from the freeware dingbat 'WM Architect' because I'm working to a deadline here and I ain't going to draw one by hand.

CSS validates (well, apart from those pesky @imports). Tested in Firefox 2, IE6, IE7, Opera 9 and Safari beta for Windows. I find the 3c-b and 1c-b layouts are a bit flaky in IE6, but the default is fine.

The skin is set according to the time you've specified in your WP dashboard, NOT the timezone of the person viewing your blog. You'd need javascript to do the latter.


/* Installation Instructions */

Your unzipped file should look like this:

		diurnal/
			readme.txt
			style.css
			screenshot.png
			clock.gif
			greybk.png
			leftarrow.gif
			rightarrow.gif
			starbk.png
			afternoon/ 
				header.png
				style.css
				sun.png
				tab.gif
			morning/ 
				header.png
				style.css
				sun.png
				tab.gif
			night/ 
				header.png
				moon.png
				style.css
				tab.gif
			sunrise/ 
				header.png
				style.css
				tab.gif
			sunset/ 
				header.png
				style.css
				tab.gif


	
== USING THIS DESIGN ==

** Please see howtoinstall.txt for information on installing this design.


/* Choosing the structure */

The default layout is three columns with the sidebars on the right. To change this, find this line near the top of /diurnal/style.css:

@import url('../sandbox/sandbox-layouts/3c-r.css'); 

and replace 3c-r with one of the following:

1c-b: 1 content column with 2 sidebars at the bottom
2c-r: 2 columns, right sidebar
2c-l: 2 columns, left sidebar
3c-b: 3 columns, sidebars either side
3c-l: 3 columns, sidebars on left




/* Licencing blah. Look, all you really need to know is you can do what you like with the thing. */

Diurnal for Sandbox, by Carolyn Smith, is licensed under the GNU General Public License:

    This stylesheet is free code; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

    This stylesheet is distributed in the hope that it will be useful, but without any warranty; without even the implied warranty of merchantability or fitness for a particular purpose. See the GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along with WordPress; if not, write to the Free Software Foundation, Inc, 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.