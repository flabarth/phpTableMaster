<?php

/*
 * Copyright 2018 Flavo.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace phpTableMaster\Util;

use DateTime;

/**
 * Description of DateMaster
 *
 * @author Flavo
 */
class DateMaster {
    
    const FORMAT_LIT_ENDIAN = "d/m/Y";
    const FORMAT_LIT_ENDIAN_TIME = "d/m/Y H:i:s";
    const FORMAT_LIT_ENDIAN_TIME_MILLISECOND = "d/m/Y H:i:s.u";
    const FORMAT_US = "Y-m-d";
    const FORMAT_US_TIME = "Y-m-d H:i:s";
    const FORMAT_US_TIME_MILLISECOND = "Y-m-d H:i:s.u";
    const FORMAT_UNKNOW = "unknown_format";
    
    /** @var DateTime */
    private $dateTime;
    
    /** @var string */
    public $dateString;
    
    /** @var string */
    public $format;
    
    /**
     * Construct method.
     * @param string $date
     * @throws Exception
     * Throws an exception in case the date format is invalid.
     */
    public function __construct(string $date) {
        
        $this->dateString = $date;
        $this->format = self::checkDateFormat($this->dateString);
        $this->dateTime = DateTime::createFromFormat($this->format, $this->dateString);
        
        if($this->format === self::FORMAT_UNKNOW || $this->dateTime === FALSE){

            throw new Exception("Invalid date!");
            
        }
        
    }
    
    /**
     * 
     * === Output methods ===
     * 
     */
    
    /**
     * Returns a date string with the desired format.
     * @param string $format
     * You may use one the classs's constants.
     * @return string
     */
    public function output(string $format) : string {
        
        return $this->dateTime->format($format);
        
    }
    
    /**
     * Returns the day.
     * @return string
     */
    public function getDay() : string {
        
        return $this->output("d");
        
    }
    
    /**
     * Returns the month.
     * @return string
     */
    public function getMonth() : string {
        
        return $this->output("m");
        
    }
    
    /**
     * Returns the year.
     * @return string
     */
    public function getYear() : string {
        
        return $this->output("Y");
        
    }
    
    /**
     * Returns the hour.
     * @return string
     */
    public function getHour() : string {
        
        return $this->output("H");
        
    }
    
    /**
     * Returns the minute.
     * @return string
     */
    public function getMinute() : string {
        
        return $this->output("i");
        
    }
    
    /**
     * Returns the second.
     * @return string
     */
    public function getSecond() : string {
        
        return $this->output("s");
        
    }
    
    /**
     * Returns the millisecond.
     * @return string
     */
    public function getMillisecond() : string {
        
        return $this->output("u");
        
    }
    
    /**
     * 
     * === Date features methods ===
     * 
     */
    
    /**
     * Returns either TRUE or FALSE if the date
     * is a weekend.
     * @return bool
     */
    public function isWeekend() : bool {
        
        return (date('N', strtotime($this->output("Y-m-d"))) >= 6);
        
    }
    
    /**
     * Returns either TRUE or FALSE if the
     * date is the last day of the month.
     * @return bool
     */
    public function isMonthLastDay() : bool {
        
        $next = new DateMaster($this->dateString);
        $next->addDays(1);
        
        return $this->getMonth() !== $next->getMonth() ? true : false;
        
    }
    
    /**
     * Returns either TRUE or FALE if the date
     * is the first day of the month.
     * @return bool
     */
    public function isMonthFirstDay() : bool {
        
        $prev = new DateMaster($this->dateString);
        $prev->subtractDays(1);
        
        return $this->getMonth() !== $prev->getMonth() ? true : false;
        
    }
    
    /**
     * 
     * === Date operations methods ===
     * 
     */
    
    /**
     * Adds the desired number of days to the object. This
     * method will take months and years into account, changing
     * them as well if needed.
     * @param int $daysToAdd
     * @return \DateMaster
     */
    public function addDays(int $daysToAdd) : DateMaster {
        
        $this->dateTime->modify("+$daysToAdd days");
        
        $this->updateAttributesFromDateTime();
        
        return $this;
        
    }
    
    /**
     * Subtract the desired number of days to the object. This
     * method will take months and years into account, changing
     * them as well if needed.     
     * @param int $daysToSubtract
     * @return \DateMaster
     */
    public function subtractDays(int $daysToSubtract) : DateMaster {
        
        $this->dateTime->modify("-$daysToSubtract days");
        
        $this->updateAttributesFromDateTime();
        
        return $this;
        
    }
    
    /**
     * Adds the desired number of months to the object. This
     * method will take months and years into account, changing
     * them as well if needed.     
     * @param int $monthsToAdd
     * @return \DateMaster
     */
    public function addMonths(int $monthsToAdd) : DateMaster {
        
        $this->dateTime->modify("+$monthsToAdd months");
        
        $this->updateAttributesFromDateTime();
        
        return $this;
        
    }
    
    /**
     * Subtracts the desired number of months to the object. This
     * method will take months and years into account, changing
     * them as well if needed.     
     * @param int $monthsToSubtract
     * @return \DateMaster
     */
    public function subtractMonths(int $monthsToSubtract) : DateMaster {
        
        $this->dateTime->modify("-$monthsToSubtract months");
        
        $this->updateAttributesFromDateTime();
        
        return $this;
        
    }
    
    /**
     * Adds the desired number of years to the object. This
     * method will take months and years into account, changing
     * them as well if needed.     
     * @param int $yearsToAdd
     * @return \DateMaster
     */
    public function addYears(int $yearsToAdd) : DateMaster {
        
        $this->dateTime->modify("+$yearsToAdd years");
        
        $this->updateAttributesFromDateTime();
        
        return $this;
        
    }
    
    /**
     * Subtracts the desired number of years to the object. This
     * method will take months and years into account, changing
     * them as well if needed.     
     * @param int $yearsToSubtract
     * @return \DateMaster
     */
    public function subtractYears(int $yearsToSubtract) : DateMaster {
        
        $this->dateTime->modify("-$yearsToSubtract years");
        
        $this->updateAttributesFromDateTime();
        
        return $this;
        
    }
    
    /**
     * Returns the difference in days, months or years
     * between this date and another.
     * @param string $to
     * @param string $type
     * Accepts d, m and y.
     * @return int
     */
    public function difference(string $to, string $type) : int {
        
        $to = new DateMaster($to);
        
        $type = strtolower($type);
        $interval = $this->dateTime->diff($to->dateTime);
        
        switch($type){
            
            case "d":
                
                return $interval->format("%a");
                
            case "m":
                
                return $interval->m + ($interval->y * 12);
                
            case "y":
                
                return $interval->y;
                
            default:
                
                return $interval->format("%a");
                
        }
        
    }
    
    /**
     * Updates all atrributes according to $dateTime.
     */
    private function updateAttributesFromDateTime() : void {
        
        $this->dateString = $this->output($this->format);
        
    }
    
    /**
     * 
     * === Useful static methods ===
     * 
     */
    
    /**
     * Returns the date format.
     * @param string $date
     * @return string
     */
    public static function checkDateFormat(?string $date) : string {
        
        $dateLength = strlen($date);
        
        if($dateLength === 10){
            
            return self::checkDateOnlyFormat($date);
            
        }else if($dateLength === 19){
            
            return self::checkDateTimeFormat($date);
            
        }else if($dateLength >= 23 && $dateLength <= 26){
            
            return self::checkDateTimeMillisecondsFormat($date);
            
        }else{
            
            return self::FORMAT_UNKNOW;
            
        }
            
        
    }
    
    /**
     * Returns the format from the date only substring (first 10 digits).
     * @param string $date
     * @return string
     */
    private static function checkDateOnlyFormat(string $date) : string {
        
        if($date[2] === "/" && $date[5] === "/"){

            return self::FORMAT_LIT_ENDIAN;

        }else if($date[4] === "-" && $date[7] === "-"){

            return self::FORMAT_US;

        }else{

            return self::FORMAT_UNKNOW;

        }
        
    }
    
    /**
     * Return the format from the date with time substring (first 19 digits).
     * @param string $date
     * @return string
     */
    private static function checkDateTimeFormat(string $date) : string {
        
        $dateOnlyFormat = self::checkDateOnlyFormat($date);

        switch($dateOnlyFormat){

            case self::FORMAT_LIT_ENDIAN:

                return self::FORMAT_LIT_ENDIAN_TIME;

            case self::FORMAT_US:

                return self::FORMAT_US_TIME;
                
            default:
                
                return self::FORMAT_US_TIME;

        }
        
    }
    
    /**
     * Return the format from the date with time and milliseconds substring (23 or 26 digits).
     * @param string $date
     * @return string
     */
    private static function checkDateTimeMillisecondsFormat(string $date) : string {
        
        $dateOnlyFormat = self::checkDateOnlyFormat($date);

        switch($dateOnlyFormat){

            case self::FORMAT_LIT_ENDIAN:

                return self::FORMAT_LIT_ENDIAN_TIME_MILLISECOND;

            case self::FORMAT_US:

                return self::FORMAT_US_TIME_MILLISECOND;
                
            default:
                
                return self::FORMAT_US_TIME_MILLISECOND;

        }
        
    }
    
    /**
     * Returns whether the string is a date or not.
     * @param string $date
     * @return bool
     */
    public static function isDate(?string $date) : bool {
        
        $format = self::checkDateFormat($date);
        
        if($format !== self::FORMAT_UNKNOW && DateTime::createFromFormat($format, $date) !== FALSE){
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    /**
     * Makes a date string shorter by slicing the first two
     * digits of the year.
     * @param string $date
     */
    public static function shortenDate(string $date) : string {
        
        $shortenedDate = new DateMaster($date);
        
        $shortenedDate->format = str_replace("Y", "y", $shortenedDate->format);

        return $shortenedDate->output($shortenedDate->format);
        
    }
    
    /**
     * Converts a date string to the desired format and
     * returns it.
     * @param string $date
     * @param string $outputFormat
     * @return string
     */
    public static function convertFormat(string $date, string $outputFormat) : string {
        
        $newFormat = new DateMaster($date);
        
        return $newFormat->output($outputFormat);
        
    }
    
    /**
     * Returns raw string value from a DateTime object.
     * @param DateTime $dateTime
     * @param string $format
     * Format of the output string. Returns "Y-m-d H:i:s.u" by
     * default.
     * @return string
     */
    public static function rasterizeDateTime(DateTime $dateTime, string $format = self::FORMAT_US_TIME_MILLISECOND) : string {
        
        $rasterized = new DateMaster($dateTime->format("Y-m-d H:i:s.u"));
        
        return $rasterized->output($format);
        
    }
    
}
