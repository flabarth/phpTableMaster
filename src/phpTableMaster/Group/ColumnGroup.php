<?php

namespace phpTableMaster\Group;

/**
 * Description of ColumnGroup
 *
 * @author Flavo
 */
class ColumnGroup {
    
    /** @var array **/
    private $columnArray = [];
    
    public function __construct() {
        
        
    }
    
    /**
     * Returns an array with all the column objects
     * from the column group.
     * @return array
     */
    public function getColumnArray() : array {
        
        return $this->columnArray;
        
    }
    
    /**
     * Adds column to the group.
     * @param \phpTableMaster\Element\Column $column
     * @return \phpTableMaster\Element\Column
     */
    public function addColumn(\phpTableMaster\Element\Column $column) : \phpTableMaster\Element\Column {
        
        array_push($this->columnArray, $column);
        
        return $column;
        
    }
    
    /**
     * Searches and returns a column by its name.
     * @param string $columnName
     * @return \phpTableMaster\Element\Column|null
     */
    public function searchColumn(string $columnName) : ?\phpTableMaster\Element\Column {
        
        foreach($this->getColumnArray() as $column) {
            
            if($column->getColumnName() === $columnName) {
                
                return $column;
                
            }
            
        }
        
        return null;
        
    }
    
}
