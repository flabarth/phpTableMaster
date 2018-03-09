<?php

namespace phpTableMaster\Interfaces;

/**
 *
 * @author Flavo
 */
interface CellI {
    
    public function __set(string $name, string $value) : void;
    
    public function setContent(string $content) : CellI;
    
    public function setClass(string $class) : CellI;
    
    public function setID(string $id) : CellI;
    
    public function setStyle(string $style) : CellI;
    
    public function setColspan(int $colspan) : CellI;
    
    public function setRowSpan(int $rowspan) : CellI;
    
    public function setData(array $data) : CellI;
    
    public function addData(string $data, string $value) : CellI;
    
    public function getName() : string;
    
    public function getContent() : string;
    
    public function getClass() : string;
    
    public function getID() : string;
    
    public function getStyle() : string;
    
    public function getColspan() : int;
    
    public function getRowspan() : int;
    
    public function getData() : array;
    
}
