<?php
//
// Definition of eZMultiParser class
//
// Created on: <08-Dec-2008 20:13 pb>
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: eZ Tika
// SOFTWARE RELEASE: 1.4-0-final
// COPYRIGHT NOTICE: Copyright (C) 2008-2009 Paul Borgermans
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
//
//
// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

/*!
  \class eZMultiParser ezmultiparser.php
  \ingroup eZKernel
  \brief The class eZMultiParser handles parsing of multiple files and returns the metadata

 */

class eZMultiParser
{
    // if true debugmessages will be write to eztika.log
    protected $DebugIsEnabled = false;

    // if true the tmp cache file for extracted text is not unlinked
    protected $DebugKeepTempFiles = false;

    function __construct()
    {
        $eztikaINI = eZINI::instance( 'eztika.ini' );
        $debugEnabled = $eztikaINI->variable( 'DebugSettings', 'Debug' );
        if ( $debugEnabled == 'enabled' )
        {
            $this->DebugIsEnabled = true;
            $keepTempFiles = $eztikaINI->variable( 'DebugSettings', 'KeepTempFiles' );
            if ( $keepTempFiles == 'enabled' )
            {
                $this->DebugKeepTempFiles = true;
            }

        }
    }

    function parseFile( $fileName )
    {
        $originalFileSize = filesize( $fileName );
        $this->writeEzTikaLog( '[START] eZMultiParser for File: '. round( $originalFileSize/1024, 2 ) .' KByte '. $fileName );

        $binaryINI = eZINI::instance( 'binaryfile.ini' );
        $textExtractionTool = $binaryINI->variable( 'MultiHandlerSettings', 'TextExtractionTool' );

        $startTime = mktime();

        $tmpName = eZSys::cacheDirectory() . eZSys::fileSeparator(). 'eztika_'. md5( $startTime ) . '.txt';
        $handle = fopen( $tmpName, "w" );
        fclose( $handle );
        chmod( $tmpName, 0777 );

        $cmd = "$textExtractionTool $fileName > $tmpName";

        $this->writeEzTikaLog( 'exec: ' . $cmd );

        // perform eztika command
        exec( $cmd , $returnArray, $returnCode );

        $this->writeEzTikaLog( "exec returnCode: $returnCode" );

        $metaData = '';
        if ( file_exists( $tmpName ) )
        {
            $fp = fopen( $tmpName, 'r' );
            $fileSize = filesize( $tmpName );
            $metaData = fread( $fp, $fileSize );
            fclose( $fp );

            // keep tempfile in debugmode
            if ( $this->DebugKeepTempFiles === true )
            {
                $this->writeEzTikaLog( 'keep tempfile for debugging extracted metadata: '. $tmpName );
            }
            else
            {
                $this->writeEzTikaLog( 'unlink tempfile: '. $tmpName );
                unlink( $tmpName );
            }

            if ( $fileSize === false || $fileSize === 0 )
            {
                $this->writeEzTikaLog( "[ERROR] no metadata was extracted! Check if eztika is working correctly" );
            }
            else
            {
                $this->writeEzTikaLog( 'metadata read from tempfile '. round( $fileSize / 1024, 2 ) . ' KByte' );
            }
        }
        else
        {
            $this->writeEzTikaLog( "[ERROR] no tempfile '$tmpName' for eztika output exists,
                check if eztika command is working,
                check if eztika is executeable" );
        }

        // write an error message to error.log if no data could be extracted
        if ( $metaData == '' && $originalFileSize > 0 )
        {
            eZDebug::writeError( "eztika can not extract content from binaryfile for searchindex \nexec( $cmd )", 'eztika class eZMultiParser' );
        }

        $endTime = mktime();
        $seconds = $endTime - $startTime;
        $this->writeEzTikaLog( "[END] after $seconds s" );

        return $metaData;
    }

    /**
     *
     * write log message to eztika.log
     * @param unknown_type $message
     */
    private function writeEzTikaLog( $message )
    {
        if ( $this->DebugIsEnabled )
            eZLog::write( $message, 'eztika.log', $this->logDirectory() );
    }

    /**
     * @return the directory used for storing log files.
     */
    private function logDirectory( )
    {
        $ini = eZINI::instance( );
        $logDir = $ini->variable( 'FileSettings', 'LogDir' );

        if ( $logDir[0] == "/" )
        {
            return eZDir::path( array( $logDir ) );
        }
        else
        {
            return eZDir::path( array( eZSys::varDirectory(), $logDir ) );
        }
    }
}

?>
