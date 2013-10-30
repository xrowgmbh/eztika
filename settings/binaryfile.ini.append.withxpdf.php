<?php /*

[HandlerSettings]

ExtensionRepositories[]=eztika/classes/datatypes/ezbinaryfile

#warning: CJK pdf's are not working correctly, use xpdf based conversion instead
MetaDataExtractor[application/pdf]=ezpdf

MetaDataExtractor[application/msword]=ezmulti
MetaDataExtractor[application/vnd.ms-excel]=ezmulti
MetaDataExtractor[application/vnd.ms-powerpoint]=ezmulti
MetaDataExtractor[application/vnd.visio]=ezmulti
MetaDataExtractor[application/vnd.ms-outlook]=ezmulti
MetaDataExtractor[application/xml]=ezmulti
MetaDataExtractor[application/rtf]=ezmulti
MetaDataExtractor[application/vnd.oasis.opendocument.text]=ezmulti
MetaDataExtractor[application/vnd.oasis.opendocument.presentation]=ezmulti
MetaDataExtractor[application/vnd.oasis.opendocument.spreadsheet]=ezmulti
MetaDataExtractor[application/vnd.oasis.opendocument.formula]=ezmulti
MetaDataExtractor[application/zip]=ezmulti
#Office OOXML files, supported since eZP4.0.4, eZP4.1.0
MetaDataExtractor[application/vnd.openxmlformats-officedocument.wordprocessingml.document]=ezmulti
MetaDataExtractor[application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]=ezmulti
MetaDataExtractor[application/vnd.openxmlformats-officedocument.presentationml.presentation]=ezmulti
#octet-stream is the default
#If tika senses a known format like the Office 2007 ooxml types, it will treat them well
MetaDataExtractor[application/octet-stream]=ezmulti
[MultiHandlerSettings]

#Change the path to the eztika shell script, which probably needs editing as well
TextExtractionTool=./extension/eztika/bin/eztika

[PDFHandlerSettings]
TextExtractionTool=./extension/eztika/bin/ezpdftotext
 */
?>