# Introduction #

Existing translations are included with stable releases from 1.3.
To use the translations follow the general Wordpress [instructions for setting another language](http://codex.wordpress.org/Installing_WordPress_in_Your_Language). Once you have set the desired language, the corresponding language should apply on the Sandbox theme as well (if language files were provided in our zip).

The following provides information on how to create your own translations. You might want to check with us or the trunk (next version) before you start translating to make sure that a translation is not forthcoming.

**Translations can be added to this project by starting a new issue (the Issues tab) and attaching your .mo and .po files.**

For the unexperienced: the following rough guide is provided.
If you are experienced use the provided [sandbox.pot ](http://sandbox-theme.googlecode.com/svn/trunk/sandbox-translation/sandbox.pot) from the forthcoming version.

## How to translate to your own language? ##

  1. Read up on and refer to the general Wordpress instructions at: http://codex.wordpress.org/Translating_WordPress
  1. The file you need to translate is called sandbox.pot, it is included in the plugin download or found in http://sandbox-theme.googlecode.com/svn/trunk/sandbox-translation/sandbox.pot if you plan to help out for the next version of Sandbox
  1. Use this file to create you own human readable file (`*`.po) and machine readable file (`*`.mo) with the correct country code in the name (e.g. fr\_FR.mo). (One easy to use tool for this is Poedit - http://www.poedit.net)
  1. Place the translation file (`*`.mo) in the main Sandbox theme directory.

Once you have finalized your translation, open a new issue (the Issues tab) and attach the .po and .mo files. It will then be included in the next Sandbox release!

Please remember to state the version of Sandbox on which you based your localization.

## How to enhance an existing translation? ##

Not happy with the quality of the translation provided or is it of a different country variation than yours? Download the closest .po file in  the /sandbox-translation/ subfolder and edit away like described above.

If you feel that your translation is of significantly better quality, please open a ticket and we'll see if we change and talk to the previous translator about his opinions.

If you have a local variation of your language (e.g. Colombian Spanish) which we don't have, then that will of course be added as a separate file. Just remember to change to the appropriate language code or tell us your country and language and we will try.

## How to update a translation to the latest version of sandbox ##

Translations can easily be updated to be valid for the latest version of Sandbox. First obtain a copy of the translation you want to update and the sandbox.pot file from the Sandbox version you wish to use (preferably trunk if you're updating for a new Sandbox release).
  1. Open the old translated file in PoEdit (eg. fr\_FR.mo)
  1. Go to Catalog > Update from POT file ...
  1. PoEdit will add new items to translate and remove what's no longer in use.
  1. Translate the new items and follow the procedures as for a new translation.

Don't forget to submit your translation to make sure it's included in the distribution and on this site.

---

References: [Danish Sandbox](http://wordpress.dk/2007/06/12/sandbox-tema-pa-dansk/) and [Swedish Sandbox](http://en.dahnielson.com/2006/08/gettext.html)

Thanks to Jan Reister for tip on updating translations.