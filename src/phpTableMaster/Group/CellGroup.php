<?php

namespace phpTableMaster\Group;

/**
 * Description of CellGroup
 *
 * @author Flavo
 */
class CellGroup {
    
    /** @var array **/
    private $cellArray = [];
    
    public function __construct() {
        
    }
    
    /**
     * Returns an array with all the cell objects
     * from the cell group.
     * @return array
     */
    public function getCellArray() : array {
        
        return $this->cellArray;
        
    }
    
    /**
     * Adds a cell object to the group.
     * @param \phpTableMaster\Element\Cell $cell
     * @param string $column
     * @return \phpTableMaster\Element\Cell
     */
    public function addCell(\phpTableMaster\Element\Cell $cell, string $column) : \phpTableMaster\Element\Cell {
        
        $cell->setColumnOwner($column);
        
        array_push($this->cellArray, $cell);
        
        return $cell;
        
    }
    
    /**
     * Searches and returns a cell by its name.
     * @param string $cellName
     * @return \phpTableMaster\Element\Cell
     */
    public function searchCell(string $cellName) : ?\phpTableMaster\Element\Cell {
        
        foreach($this->cellArray as $cell) {
            
            if($cell->getName() === $cellName) {
                
                return $cell;
                
            }
            
        }
        
        return null;
        
    }
    
}
