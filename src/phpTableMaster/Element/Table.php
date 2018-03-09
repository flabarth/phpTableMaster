<?php

namespace phpTableMaster\Element;

/**
 * Description of Table
 *
 * @author Flavo
 */
class Table {
    
    /**
     * View CSS documentation for more information about
     * table layouts.
     * @var string
     */
    const LAYOUT_AUTO = "auto";
    
    /**
     * View CSS documentation for more information about
     * table layouts.
     * @var string
     */
    const LAYOUT_FIXED = "fixed";
    
    /**
     * View CSS documentation for more information about
     * table layouts.
     * @var string
     */
    const LAYOUT_INHERIT = "inherit";
    
    /**
     * View CSS documentation for more information about
     * table layouts.
     * @var string
     */
    const LAYOUT_INITIAL = "initial";
    
    /**
     * View CSS documentation for more information about
     * table layouts.
     * @var string
     */
    const LAYOUT_UNSET = "unset";
    
    /** @var \phpTableMaster\Group\ColumnGroup **/
    private $columnGroup;
    
    /** @var \phpTableMaster\Group\RowGroup **/
    private $rowGroup;
    
    /** @var string **/
    private $class = "";
    
    /** @var string **/
    private $style = "";
    
    /** @var string **/
    private $width = "100%";
    
    /** @var string **/
    private $layout = self::LAYOUT_AUTO;
    
    public function __construct() {
        
        $this->columnGroup = new \phpTableMaster\Group\ColumnGroup();
        $this->rowGroup = new \phpTableMaster\Group\RowGroup();
        
    }
    
    /**
     * Sets the CSS class string for the table.
     * @param string $class
     * The format must follow as in the HTML tag, separating
     * the classes by space.
     * E.g.: "class1 class2 class3"
     * @return \phpTableMaster\Element\Table
     */
    public function setClass(string $class) : Table {
        
        $this->class = $class;
        
        return $this;
        
    }
    
    /**
     * Sets the CSS style string for the table.
     * Notice: Although this property exists, it is highly
     * recommendable that you use styles outside the Table object.
     * For instance, you can use the setClass() method to 
     * define classes from a separate CSS file. 
     * @param string $style
     * @return \phpTableMaster\Element\Table
     */
    public function setStyle(string $style) : Table {
        
        $this->style = $style;
        
        return $this;
        
    }
    
    /**
     * CSS table layout of the table. "Auto" by default. You may use
     * one of the "LAYOUT_" constants of this class.
     * @param string $layout
     * @return \phpTableMaster\Builder\TableBuilder
     */
    public function setLayout(string $layout) : Table {
        
        $this->layout = $layout;
        
        return $this;
        
    }
    
    /**
     * Sets the table width. This must be a CSS string.
     * E.g.: "56.8%", "1050px", ...
     * @param string $width
     * @return \phpTableMaster\Element\Table
     */
    public function setWidth(string $width) : Table {
        
        $this->width = $width;
        
        return $this;
        
    }
    
    /**
     * Returns the column group.
     * @return \phpTableMaster\Group\ColumnGroup
     */
    public function getColumnGroup() : \phpTableMaster\Group\ColumnGroup {
        
        return $this->columnGroup;
        
    }
    
    /**
     * Returns an array with all the column objects
     * from the column group.
     * @return array
     */
    public function getColumns() : array {
        
        return $this->columnGroup->getColumnArray();
        
    }
    
    /**
     * Retusn a column given its number in the column group.
     * Begins at 0, being the first column.
     * @param int $columnNumber
     * @return \phpTableMaster\Element\Column
     */
    public function getColumn(int $columnNumber) : Column {
        
        return $this->columnGroup->getColumnArray()[$columnNumber];
        
    }
    
    /**
     * Searches and returns a column given its name.
     * @param string $columName
     * @return \phpTableMaster\Element\Column
     */
    public function getColumnByName(string $columName) : Column {
        
        return $this->columnGroup->searchColumn($columName);
        
    }
    
    /**
     * Returns the number of columns in the table (from
     * the column group).
     * @return int
     */
    public function getNumColumns() : int {
        
        return count($this->getColumns());
        
    }
    
    /**
     * Returns the header from the given column.
     * @param int $columnNumber
     * @return \phpTableMaster\Element\Header
     */
    public function getHeader(int $columnNumber) : Header {
        
        return $this->getColumn($columnNumber)->getHeader();
        
    }
    
    /**
     * Returns row group.
     * @return \phpTableMaster\Group\RowGroup
     */
    public function getRowGroup() : \phpTableMaster\Group\RowGroup {
        
        return $this->rowGroup;
        
    }
    
    /**
     * Returns an array with all the row objects
     * from the row group.
     * @return array
     */
    public function getRows() : array {
        
        return $this->rowGroup->getRowArray();
        
    }
    
    /**
     * Returns a row given its number in the row group.
     * Begins at 0, being the first row.
     * @param int $rowNumber
     * @return \phpTableMaster\Element\Row
     */
    public function getRow(int $rowNumber) : Row {
        
        $row = $this->rowGroup->getRowArray()[$rowNumber];
        
        if(!is_null($row)) {
            
            return $row;
            
        } else {
            
            throw new \Exception("Row #$rowNumber does not exist in the table object");
            
        }
        
    }
    
    /**
     * Searches and returns a row given its name.
     * @param string $rowName
     * @return \phpTableMaster\Element\Row
     */
    public function getRowByName(string $rowName) : Row {
        
        return $this->rowGroup->searchRow($rowName);
        
    }
    
    /**
     * Returns the number of rows in the table (from
     * the row group).
     * @return int
     */
    public function getNumRows() : int {
        
        return count($this->getRows());
        
    }
    
    /**
     * Returns a cell from the given position in the table.
     * @param int $row
     * @param int $col
     * @param bool $truePosition
     * If set to true, the initial coordinates will be 0.
     * @return \phpTableMaster\Element\Cell|null
     */
    public function getCell(int $row, int $col, bool $truePosition = false) : ?Cell {
        
        if(!$truePosition) {
            
            $row--;
            $col--;
            
        }
        
        $thisRow = $this->getRow($row);
        return $thisRow->getCell($col);
        
    }
    
    /**
     * Returns table classes string.
     * @return string
     */
    public function getClass() : string {
        
        return $this->class;
        
    }
    
    /**
     * Returns table CSS style string.
     * @return string
     */
    public function getStyle() : string {
        
        return $this->style;
        
    }
    
    /**
     * Returns table CSS width string.
     * @return string
     */
    public function getWidth() : string {
        
        return $this->width;
        
    }
    
    /**
     * Returns table CSS layout string.
     * @return string
     */
    public function getLayout() : string {
        
        return $this->layout;
        
    }
    
    /**
     * Adds a preexisting column object to the column group.
     * @param \phpTableMaster\Element\Column $column
     * @return \phpTableMaster\Element\Column
     */
    public function addColumn(Column $column) : Column {
        
        return $this->columnGroup->addColumn($column);
        
    }
    
    /**
     * Adds an array of preexisting columns to the column
     * group.
     * @param array $columns
     * @return \phpTableMaster\Group\ColumnGroup
     */
    public function addColumns(array $columns) : \phpTableMaster\Group\ColumnGroup {
        
        foreach($columns as $column) {
            
            $this->addColumn($column);
            
        }
        
        return $this->getColumnGroup();
        
    }
    
    /**
     * Adds a preexisting row object to the row group.
     * @param \phpTableMaster\Element\Row $row
     * @return \phpTableMaster\Element\Row
     */
    public function addRow(Row $row) : Row {
        
        return $this->rowGroup->addRow($row);
        
    }
    
    /**
     * Adds an array of preexisting row objects to the row group.
     * @param array $rows
     * @return \phpTableMaster\Group\RowGroup
     */
    public function addRows(array $rows) : \phpTableMaster\Group\RowGroup {
        
        foreach($rows as $row) {
            
            $this->addRow($row);
            
        }
        
        return $this->getRowGroup();
        
    }
    
    /**
     * Automatically creates the desired number of columns in the
     * table and adds them to the column group.
     * @param int $numberOfColumns
     * @return \phpTableMaster\Element\Table
     */
    public function createColumns(int $numberOfColumns) : Table {
        
        for($x = 0; $x < $numberOfColumns; $x++) {
            
            $column = new Column("col" . ($x + 1));
            
            $this->addColumn($column);
            
        }
        
        return $this;
        
    }
    
    /**
     * Automatically creates the desired number of rows in the
     * table and adds them to the row group.
     * @param int $numberOfRows
     * @return \phpTableMaster\Element\Table
     */
    public function createRows(int $numberOfRows) : Table {
        
        for($x = 0; $x < $numberOfRows; $x++) {
            
            $row = new Row("row" . ($x + 1));
            
            $this->addRow($row);
            
        }
        
        return $this;
        
    }
    
    /**
     * Creates all cells in the table based on the number of
     * columns and rows.
     * @return \phpTableMaster\Element\Table
     */
    public function createAllCells() : Table {
        
        foreach($this->getRows() as $row) {
            
            $cellGroup = $row->createCellGroup($this);
            $row->setCellGroup($cellGroup);
            
        }
        
        return $this;
        
    }
    
    /**
     * Automatically creates a table and all its objects with
     * the given proportions.
     * @param int $numberOfRows
     * Number of row the table will have.
     * @param int $numberOfColumns
     * Number of columns the table will have.
     * @return \phpTableMaster\Element\Table
     */
    public function create(int $numberOfRows, int $numberOfColumns) : Table {
        
        $this->createColumns($numberOfColumns);
        $this->createRows($numberOfRows);
        $this->createAllCells();
        
        return $this;
        
    }
    
}
