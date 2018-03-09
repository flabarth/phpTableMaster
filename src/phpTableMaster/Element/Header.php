<?php

namespace phpTableMaster\Element;

use phpTableMaster\Interfaces\CellI;

/**
 * Description of Header
 *
 * @author Flavo
 */
class Header implements CellI {
    
    /** @var string **/
    private $name = "";
    
    /** @var string **/
    private $content = "";
    
    /** @var string **/
    private $class = "";
    
    /** @var string **/
    private $id = "";
    
    /** @var string **/
    private $style = "";
    
    /** @var int **/
    private $colspan = 0;
    
    /** @var int **/
    private $rowspan = 0;
    
    public function __construct(string $headerName) {
        
        $this->name = $headerName;
        
    }
    
    /**
     * Magic set for properties.
     * @param string $name
     * @param type $value
     * @return void
     */
    public function __set(string $name, $value) : void {
        
        $this->$name = $value;
        
    }

    public function setContent(string $content): CellI {
        
        $this->content = $content;
        
        return $this;
        
    }
    
    public function setClass(string $class): CellI {
        
        $this->class = $class;
        
        return $this;
        
    }

    public function setID(string $id): CellI {
        
        $this->id = $id;
        
        return $this;
        
    }

    public function setStyle(string $style): CellI {
        
        $this->style = $style;
        
        return $this;
        
    }
    
    public function setColspan(int $colspan): CellI {
        
        $this->colspan = $colspan;
        
    }
    
    public function setRowspan(int $rowspan) : CellI {
        
        $this->rowspan = $rowspan;
        
        return $this;
        
    }
    
    public function setData(array $data) : CellI {
        
        $this->data = $data;
        
        return $this;
        
    }
    
    public function addData(string $data, string $value) : CellI {
        
        array_push($this->data, [$data => $value]);
        
        return $this;
        
    }
    
    /**
     * Returns the header name.
     * @return string
     */
    public function getName() : string {
        
        return $this->name;
        
    }

    public function getContent(): string {
        
        return $this->content;
        
    }

    public function getClass(): string {
        
        return $this->class;
        
    }

    public function getID(): string {
        
        return $this->id;
        
    }

    public function getStyle(): string {
        
        return $this->style;
        
    }
    
    public function getColspan(): int {
        
        return $this->colspan;
        
    }
    
    public function getRowspan(): int {
        
        return $this->rowspan;
        
    }
    
    public function getData() : array {
        
        return $this->data;
        
    }

}
