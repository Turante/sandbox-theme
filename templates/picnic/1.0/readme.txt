/* About the skin */

I have this thing about pink and brown. Well, the brown mutated into a sort of aubergine colour. This feels sort of old-school to me, like it should have a squidfingers background and the little floating dateboxes should be livejournal icons or something. I might release the wild grass as a brush set one of these days, if I ever get my site sorted out.

The existence of ie6.css should tell you that the CSS does not validate. If ie6.css did not exist, then it totally would. Tested in the aforementioned IE6 and the following real browsers: Firefox 2, Opera 9.2, IE7 and Safari beta for Windows. (Yes, the Safari beta is a real browser. Compared to IE6.)


/* Installation Instructions*/

Your unzipped file should look like this:

		picnic/
			ie6.css
			readme.txt
			screenshot.png
			style.css
			images/ 
				background.gif
				datebk.gif
				entrybk.png
				entrybottom.png
				entrytop.png
				gradient.png
				leftarrow.gif
				pinkarrow.gif
				reversegradient.png
				rightarrow.gif
				spider.gif


	
== USING THIS DESIGN ==

** Please see howtoinstall.txt for information on installing this design.


/* Changing the structure */

If you're really not grooving on the idea of having the sidebars at the bottom, find this line near the top of style.css:

@import url('../sandbox/sandbox-layouts/1c-b.css'); 

and replace 1c-b with one of the following:

2c-r: 2 columns, right sidebar
2c-l: 2 columns, left sidebar

Don't use the three-column layouts. Unless you want your theme to break.




/* Licencing blah. Look, all you really need to know is you can do what you like with the thing. */

Picnic for Sandbox, by Carolyn Smith, is licensed under the GNU General Public License:

    This stylesheet is free code; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

    This stylesheet is distributed in the hope that it will be useful, but without any warranty; without even the implied warranty of merchantability or fitness for a particular purpose. See the GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along with WordPress; if not, write to the Free Software Foundation, Inc, 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.