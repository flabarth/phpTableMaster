<?php

namespace phpTableMaster\Group;

/**
 * Description of RowGroup
 *
 * @author Flavo
 */
class RowGroup {
    
    /** @var array **/
    private $rowArray = [];
    
    public function __construct() {
        
    }
    
    /**
     * Returns array of row objects in this
     * row group.
     * @return array
     */
    public function getRowArray() : array {
        
        return $this->rowArray;
        
    }
    
    /**
     * Adds row to the group.
     * @param \phpTableMaster\Element\Row $row
     * @return \phpTableMaster\Element\Row
     */
    public function addRow(\phpTableMaster\Element\Row $row) : \phpTableMaster\Element\Row {
        
        array_push($this->rowArray, $row);
        
        return $row;
        
    }
    
    /**
     * Searches and returns a row by its name.
     * @param string $rowName
     * @return \phpTableMaster\Element\Row|null
     */
    public function searchRow(string $rowName) : ?\phpTableMaster\Element\Row {
        
        foreach($this->getRowArray() as $row) {
            
            if($row->getRowName() === $rowName) {
                
                return $row;
                
            }
            
        }
        
        return null;
        
    }
    
}
