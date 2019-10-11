Installing eZTika
=================

## Requirements:

- eZ Publish 4.0.1 or later.
- Java Runtime Environment 8.0 or later ( https://www.oracle.com/technetwork/java/javase/downloads/index.html )
- Unix-like OS, although the provided Bourne shell script is a good base for creating a windows .bat file

## Installation:

1. Extract the eztika extension and place it in the extensions folder.

2. Check that extension/eztika/bin files are executable by the webserver

   OR

   Copy the eztika shell script and tika.jar from the extension bin folder to a
   location your web server has access to and edit the shell script
   as well to set the path to the tika.jar file (make sure it is executable)

3. Enable the extension in eZ Publish. Do this by opening settings/override/site.ini.append.php,
   and add in the [ExtensionSettings] block:

       ActiveExtensions[]=eztika

4. Update the class autoloads by running the script: php bin/php/ezpgenerateautoloads.php -e

5. If you do not use eztika within extension folder then
   edit extension/eztika/settings/binaryfile.ini.append.php and adapt the PATH to the eztika script:

       [MultiHandlerSettings]

       # Change the path to the eztika shell script
       TextExtractionTool=<path to>/eztika

   By default the settings point to the ./extension/eztika/bin/eztika

6. Optionally (not really needed since ez tika 1.3), install and adapt xpdf and set the path to pdftotext in the
   supplied wrapper script ezpdftotext. This will give you the best
   experience with pdf files with international character sets.
   You will need to use the alternate settings from the example supplied in
   extension/eztika/settings/binaryfile.ini.append.withxpdf.php

       [PDFHandlerSettings]
       TextExtractionTool=/<path to>/ezpdftotext

7. If something is not working you can enable Debugging in eztika.ini.append.php

        [DebugSettings]
        # Debug=enabled|disabled
        # if enabled
        # - write Debug Messages to eztika.log
        #
        # Note: an error message to error.log is always written
        # if eztika can not extract any content from binaryfile
        Debug=disabled

        # KeepTempFiles=enabled|disabled
        # if enabled var/cache/ eztika_xxx.txt tmp files are not unlinked
        # to debug metadata which is extracted from the binaryfile
        # The setting is only active if Debug=enabled
        KeepTempFiles=disabled
