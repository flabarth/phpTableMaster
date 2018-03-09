<?php

namespace phpTableMaster\Element;

/**
 * Description of Row
 *
 * @author Flavo
 */
class Row {
    
    /** @var string **/
    private $rowName;
    
    /** @var float **/
    private $height;
    
    /** @var string **/
    private $id = "";
    
    /** @var \phpTableMaster\Group\CellGroup **/
    private $cellGroup;
    
    public function __construct(string $rowName) {
        
        $this->rowName = $rowName;
        $this->cellGroup = new \phpTableMaster\Group\CellGroup();
        
    }
    
    /**
     * Sets the ID of the row.
     * @param string $id
     * @return \phpTableMaster\Element\Row
     */
    public function setId(string $id) : Row {
        
        $this->id = $id;
        
        return $this;
        
    }
    
    /**
     * Sets the cell group object.
     * @param \phpTableMaster\Group\CellGroup $cellGroup
     * @return \phpTableMaster\Element\Row
     */
    public function setCellGroup(\phpTableMaster\Group\CellGroup $cellGroup) : Row {
        
        $this->cellGroup = $cellGroup;
        
        return $this;
        
    }
    
    /**
     * Returns cell group from this row.
     * @return \phpTableMaster\Group\CellGroup
     */
    public function getCellGroup() : \phpTableMaster\Group\CellGroup {
        
        return $this->cellGroup;
        
    }
    
    /**
     * Returns cell array from cell group.
     * @return array
     */
    public function getCells() : array {
        
        return $this->cellGroup->getCellArray();
        
    }
    
    /**
     * Returns a cell given its number in the cell group.
     * Begins at 0, being the first cell.
     * @param int $cellNumber
     * @return \phpTableMaster\Element\Cell
     */
    public function getCell(int $cellNumber) : Cell {
        
        $cell = $this->cellGroup->getCellArray()[$cellNumber];
        
        if(!is_null($cell)) {
            
            return $this->cellGroup->getCellArray()[$cellNumber];
            
        } else {
            
            throw new \Exception("Cell #$cellNumber does not exist in row \"" . $this->getRowName() . "\"");
            
        }
        
    }
    
    /**
     * Searches and returns a cell given its name.
     * @param string $cellName
     * @return \phpTableMaster\Element\Cell
     */
    public function getCellByName(string $cellName) : Cell {
        
        return $this->cellGroup->searchCell($cellName);
        
    }
    
    /**
     * Returns the cell that belongs to $columnName.
     * @param string $columnName
     * @return \phpTableMaster\Element\Cell|null
     */
    public function getCellFromColumn(string $columnName) : ?Cell {
        
        foreach($this->getCells() as $cell){
            
            if($cell->getColumnOwner() === $columnName){
                
                return $cell;
                
            }
            
        }
        
        return null;
        
    }
    
    /**
     * Returns row name.
     * @return string
     */
    public function getRowName() : string {
        
        return $this->rowName;
        
    }
    
    /**
     * Returns row id.
     * @return string
     */
    public function getId() : string {
        
        return $this->id;
        
    }
    
    /**
     * Adds a preexisting cell object to the cell group
     * of this row.
     * @param \phpTableMaster\Element\Cell $cell
     * @param string $column
     * @return \phpTableMaster\Element\Cell
     */
    public function addCell(Cell $cell, string $column) : Cell {
        
        return $this->cellGroup->addCell($cell, $column);
        
    }
    
    /**
     * Adds multiple preexisting cells from array
     * to cell group.
     * @param array $cellArray
     * @return \phpTableMaster\Group\CellGroup
     */
    public function addCells(array $cellArray) : \phpTableMaster\Group\CellGroup {
        
        foreach($cellArray as $cell) {
            
            $this->addCell($this->cell);
            
        }
        
        return $this->getCellGroup();
        
    }
        
    /**
     * Creates new cell to the cell group of this row.
     * @param string $cellName
     * @param string $column
     * @return \phpTableMaster\Element\Cell
     */
    public function newCell(string $cellName, string $column) : Cell {
        
        $cell = new Cell($cellName);
        
        return $this->cellGroup->addCell($cell, $column);
        
    }
    
    /**
     * Creates multiple cells from an array in the following format:
     * ["column owner" => "cell name"]
     * @param array $cells
     * @return \phpTableMaster\Group\CellGroup
     */
    public function newCells(array $cells) : \phpTableMaster\Group\CellGroup {
        
        foreach($cells as $columnName => $cellName) {
            
            $cell = new Cell($cellName);
            
            $this->cellGroup->addCell($cell, $columnName);
            
        }
        
        return $this->cellGroup;
        
    }
    
    /**
     * Automatically creates a cell group for this row containg a single cell 
     * for each column of the given table.
     * @param \phpTableMaster\Element\Table $table
     * @return \phpTableMaster\Group\CellGroup
     */
    public function createCellGroup(Table $table) : \phpTableMaster\Group\CellGroup {
        
        $cellGroup = new \phpTableMaster\Group\CellGroup();
        $maxCells = $table->getNumColumns();
        
        for($x = 0; $x < $maxCells; $x++) {
            
            $thisColumn = $table->getColumn($x);
            $colName = $thisColumn->getColumnName();
            
            $cellName = "cell" . ($x + 1) . $colName;
            
            $cell = new Cell($cellName);
            
            $cellGroup->addCell($cell, $colName);
            
        }
        
        return $cellGroup;
        
    }
    
}
