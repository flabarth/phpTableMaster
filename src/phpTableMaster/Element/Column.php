<?php

namespace phpTableMaster\Element;

/**
 * Description of Column
 *
 * @author Flavo
 */
class Column {
    
    /** @var string **/
    private $columName = "";
    
    /** @var string **/
    private $width = "";
    
    /** @var \phpTableMaster\Element\Header **/
    private $header;
    
    public function __construct(string $columnName, string $headerName = null) {
        
        $this->columName = $columnName;
        $this->setHeader($headerName !== null ? $headerName : $columnName);
        
    }
    
    /**
     * Sets the width of this column. It is highly advisible to
     * use values in percentage, but you can use any kind of
     * measure. E.g.: "120px", "10ch", "5.5%"...
     * @param string $width
     * @return \phpTableMaster\Element\Column
     */
    public function setWidth(string $width) : Column {
        
        $this->width = $width;
        
        return $this;
        
    }
    
    /**
     * Sets and returns the header of this column.
     * @param string $headerName
     * @return \phpTableMaster\Element\Header
     */
    public function setHeader(string $headerName) : Header {
        
        $this->header = new Header($headerName);
        
        return $this->header;
        
    }
    
    /**
     * Returns the name of the column.
     * @return string
     */
    public function getColumnName() : string {
        
        return $this->columName;
        
    }
    
    public function getWidth() : string {
        
        return $this->width;
        
    }
    
    /**
     * Returns this column's header.
     * @return \phpTableMaster\Element\Header
     */
    public function getHeader() : Header {
        
        return $this->header;
        
    }
    
}
