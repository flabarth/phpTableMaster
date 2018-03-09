<?php

namespace phpTableMaster\Util;

use phpTableMaster\Util\DateMaster;

/**
 * Description of TableUtils
 *
 * @author Flavo
 */
class TableUtils {
    
    /**
     * Extracts contents from a string based on a start and
     * end delimiter.
     * Disclaimer: This function was found on the web a long
     * time ago. I can no longer find it to properly credit it.
     * @param string $str
     * @param string $startDelimiter
     * @param string $endDelimiter
     * @return array
     */
    public static function extractFromString(string $str, string $startDelimiter, string $endDelimiter) : array {
        
        $contents = [];
        $startDelimiterLength = strlen($startDelimiter);
        $endDelimiterLength = strlen($endDelimiter);
        $startFrom = $contentStart = $contentEnd = 0;
        
        while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) {
            
            $contentStart += $startDelimiterLength;
            $contentEnd = strpos($str, $endDelimiter, $contentStart);
            
        if (false === $contentEnd) {
            
          break;
          
        }
        
            $contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
            $startFrom = $contentEnd + $endDelimiterLength;
        
        }

        return $contents;
        
    }
    
    /**
     * Extracts a whole chunk/block from a string. For instance, if the
     * delimiters are "{" and "}", and the string is "{hi{bye}adios} test",
     * the return value for this string will be "{hi{bye}adios}". This 
     * method returns an array with all the blocks of the given string.
     * @param string $str
     * @param string $startDelimiter
     * @param string $endDelimiter
     * @return array
     */
    public static function extractChunkFromString(string $str, string $startDelimiter, string $endDelimiter) : array {
        
        $chunks = [];
        $chunksString = "";
        
        $stringPieces = explode($startDelimiter, $str);
        array_shift($stringPieces);
        
        foreach($stringPieces as $piece) {
            
            if(strpos($piece, $endDelimiter) !== false) {
                
                $chunksString .= $startDelimiter . $piece . "(-;-)";
                
            } else {
                
                $chunksString .= $startDelimiter . $piece;
                
            }
            
        }
        
        $chunks = explode("(-;-)", $chunksString);
        array_pop($chunks);
        
        return $chunks;
        
    }
    
    /**
     * Extracts blocks from a string, in an inner sequence. For instance,
     * if the string is "{hello{bye}}" the return array will be [{bye}, 
     * {hello{bye}}].
     * @param string $str
     * @param string $starDelimiter
     * @param string $endDelimiter
     * @return array
     */
    public static function extractInnerSequenceFromString(string $str, string $starDelimiter, string $endDelimiter) : array {
        
        $contents = [];
        
        while(strpos($str, $starDelimiter) !== false) {
        
            $starDelimiterLen = strlen($starDelimiter);
            $endDelimiterLen = strlen($endDelimiter);
            $begin = strpos($str, $starDelimiter) + $starDelimiterLen;
            $end = strrpos($str, $endDelimiter);
            
            $str = substr($str, $begin, $end - $begin);
            
            $contents[] = $str;
        
        }
        
        return array_reverse($contents);
        
    }
    
    /**
     * Transforms all DateTime objects into string of the according
     * $format, in an indexed associative array.
     * @param array $array
     * @param string $format
     * @return array
     */
    public static function rasterizeAssocArrayDateTime(array $array, string $format = DateMaster::FORMAT_US_TIME_MILLISECOND) : array {
        
        foreach($array as $key => &$subArray) {
            
            foreach($subArray as &$value) {
                
                if($value instanceof \DateTime) {
                    
                    $value = DateMaster::rasterizeDateTime($value, $format);
                    
                }
                
            }
            
        }
        
        return $array;
        
    }
    
    /**
     * Converts all date strings in an indexed associative array,
     * into the desired format.
     * @param array $array
     * @param string $format
     * @return array
     */
    public static function convertAssocArrayDate(array $array, string $format) : array {
        
        foreach($array as $key => &$subArray) {
            
            foreach($subArray as &$value) {
                
                if(DateMaster::isDate($value)) {
                    
                    $value = DateMaster::convertFormat($value, $format);
                    
                }
                
            }
            
        }
        
        return $array;
        
    }
    
}
