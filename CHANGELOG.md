Changelog eztika 1.15 to 2.0
----------------------------

- upgraded bundled tika.jar to 2.5.0

- added testing of the extension via GitHub Actions

Changelog eztika 1.14 to 1.15
----------------------------

- upgraded bundled tika.jar to 1.28.5

Changelog eztika 1.13 to 1.14
----------------------------

- upgraded bundled tika.jar to 1.28, fixing security issues related to log4j

Changelog eztika 1.12 to 1.13
----------------------------

- upgraded bundled tika.jar to 1.25
- improved the shell scripts used to start Tika and PdfToText: they can now be configured via usage of env vars JAVA,
  TIKA_JAR, TIKA_LOG4J and PDFTOTEXT

Changelog eztika 1.11 to 1.12
----------------------------

- upgraded bundled tika.jar to 1.24.1

Changelog eztika 1.10 to 1.11
----------------------------

- upgraded bundled tika.jar to 1.23

Changelog eztika 1.9 to 1.10
----------------------------

- upgraded bundled tika.jar to 1.22
- fixed warning "mktime(): You should be using the time() function instead"

Changelog eztika 1.8 to 1.9
---------------------------

- upgraded bundled tika.jar to 1.18

Changelog eztika 1.7 to 1.8
---------------------------

- upgraded bundled tika.jar to 1.14

Changelog eztika 1.6 to 1.7
---------------------------

- one improvement to the multiparser

Changelog eztika 1.5 to 1.6
---------------------------

- minor changes

Changelog eztika 1.4 to 1.5
---------------------------

- adding extension.xml file
- update binaryfile.ini.append.php to use eztika executable in eztika extension by default
- new ini eztika.ini with new debug setting

        [DebugSettings]
        # Debug-enabled|disabled
        # if enabled
        # - write Debug Messages to eztika.log
        #
        # Note: an error message to error.log is always written
        # if eztika can not extract any content from binaryfile
        Debug-disabled

        # KeepTempFiles-enabled|disabled
        # if enabled var/cache/ eztika_xxx.txt tmp files are not unlinked
        # to debug metadata which is extracted from the binaryfile
        # The setting is only active if Debug-enabled
        KeepTempFiles-disabled

Changelog eztika 1.3 to 1.4
---------------------------

- updated tika.jar to 1.0-dev (svn rev 1156078); adding support for chm, iWork and many bugfixes

Changelog eztika 1.2 to 1.3
---------------------------
- updated tika.jar to 0.8-dev (svn rev 933934); now supporting correctly CJK pdfs

Changelog eztika 1.1 to 1.2
---------------------------

- updated tika.jar to 0.6-dev (rev 897576) which has better support for ms excel, a reduced footprint and output encoding options
  it now correctly converts OOo and MSxx formats with asian content to UTF-8
- added encoding option --encoding-utf8 to eztika wrapper script
- updated ezinfo.php
- changed structure for building with http://projects.ez.no/ezextensionbuilder

Changelog eztika 1.0 to 1.1
---------------------------

- (added  2010-01-17) let ezpdftotext specify the no pagebreaks option, which potentially break the UTF payload sent to ez find
- updated tika.jar to 0.5-dev (rev  814142), including more support for office xml formats and various bugfixes
- added office xml format mimetypes to binaryfile.ini
- updated ezinfo.php
