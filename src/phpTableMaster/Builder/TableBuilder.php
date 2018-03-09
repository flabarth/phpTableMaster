<?php

namespace phpTableMaster\Builder;

use phpTableMaster\Element\Table;

/**
 * Description of TableBuilder
 *
 * @author Flavo
 */
class TableBuilder {
    
    /** @var Table **/
    private $table;
    
    /** @var string **/
    private $tableHTML = "";
    
    /** @var bool **/
    private $confColspanOverflow = false;
    
    /** @var bool **/
    private $confAutoTruncateText = false;
    
    public function __construct(Table $table) {
        
        $this->table = $table;
        
    }
    
    /**
     * If set to true, cells with colspan
     * greater than 0 will overflow the cells next
     * to it.
     * @param bool $confColspanOverfllow
     * @return \phpTableMaster\Builder\TableBuilder
     */
    public function setConfColspanOverflow(bool $confColspanOverfllow) : TableBuilder {
        
        $this->confColspanOverflow = $confColspanOverfllow;
        
        return $this;
        
    }
    
    /**
     * If set to true, strings that overflow the size of a cell
     * will be truncated with "...". Usually, this setting will
     * be only valid when the table layout is set to "fixed".
     * @param bool $confAutoTruncateText
     * @return \phpTableMaster\Builder\TableBuilder
     */
    public function setConfAutoTruncateText(bool $confAutoTruncateText) : TableBuilder {
        
        $this->confAutoTruncateText = $confAutoTruncateText;
        
        return $this;
        
    }
    
    /**
     * Builds and returns the HTML table based on a Table
     * object. If the table was previously built by another
     * call of the build() method, it will be reused. In
     * order to rebuild the table from scratch, use the
     * rebuild() method.
     * @return string
     */
    public function build() : string {
        
        if($this->tableHTML === ""){
            
            $tableClass = $this->table->getClass();
            $tableStyle = $this->table->getStyle();
            $tableWidth = $this->table->getWidth();
            $tableLayout = $this->table->getLayout();

            $tableHTML = "<table class='$tableClass' style='table-layout: $tableLayout;width: $tableWidth;$tableStyle'>";
            
            $tableHTML .= $this->buildHeader();
            $tableHTML .= $this->buildBody();
            
            $tableHTML .= "</table>";
            
            $tableHTML .= $this->applyAutoTruncateTextConf();
            
            $this->tableHTML = $tableHTML;
            
        }
        
        return $this->tableHTML;
        
    }
    
    /**
     * 
     * @return string
     */
    public function rebuild() : string {
        
        $this->tableHTML = "";
        
        return $this->build();
        
    }
    
    /**
     * Builds <thead> string.
     * @return string
     */
    private function buildHeader() : string {
        
        $headerHTML = "<thead><tr>";
        
        foreach($this->table->getColumns() as $column) {
            
            $columnWidth = $column->getWidth();
            
            $header = $column->getHeader();
            
            $headerContent = $header->getContent();
            $headerClass = $header->getClass();
            $headerStyle = $header->getStyle();
            $headerID = $header->getID();
            
            $headerHTML .= "<th class='$headerClass' style='width:$columnWidth; $headerStyle' id='$headerID'>$headerContent</th>";
            
        }
        
        $headerHTML .= "</tr></thead>";
        
        return $headerHTML;
        
    }
    
    /**
     * Builds <tbody> string.
     * @return string
     */
    private function buildBody() : string {
        
        $bodyHTML = "<tbody>";
        
        foreach($this->table->getRows() as $rowNumber => $row) {
            
            $rowId = $row->getId();
            
            $bodyHTML .= "<tr id='$rowId'>";
            
            foreach($this->table->getColumns() as $columnNumber => $column) {
                
                $cell = $row->getCell($columnNumber);
                
                if(!is_null($cell)){
                    
                    $cellContent = $cell->getContent();
                    $cellClass = $cell->getClass();
                    $cellStyle = $cell->getStyle();
                    $cellId = $cell->getId();
                    $cellColspan = $cell->getColspan();
                    $cellRowspan = $cell->getRowspan();
                    $dataArray = $cell->getData();
                    $dataString = $this->buildDataString($dataArray);
                    
                    $this->applyColspanOverflowConf($cellColspan, $rowNumber, $columnNumber);

                    $bodyHTML .= "<td id='$cellId' class='$cellClass' style='$cellStyle' colspan='$cellColspan' rowspan='$cellRowspan' $dataString>$cellContent</td>";
                    
                }else{
                    
                    $bodyHTML .= "<td></td>";
                    
                }
                
            }
            
            $bodyHTML .= "</tr>";
            
        }
        
        $bodyHTML .= "</tbody>";
        
        return $bodyHTML;
        
    }
    
    /**
     * Iterate through data array of the cell and builds
     * a data string containg all data properties.
     * @param array $dataArray
     * @return string
     */
    private function buildDataString(array $dataArray) : string {
        
        $dataString = "";
        
        foreach($dataArray as $data => $value) {
            
            $dataString .= "data-$data='$value' ";
            
        }
        
        return $dataString;
        
    }
    
    /**
     * Apply colspan overflow configurations.
     * @param int $cellColspan
     * @param int $rowNumber
     * @param int $columnNumber
     * @return void
     */
    private function applyColspanOverflowConf(int $cellColspan, int $rowNumber, int $columnNumber) : void {
        
        if($cellColspan > 0 && $this->confColspanOverflow) {
            
            for($x = $columnNumber + 1; $x < ($columnNumber + $cellColspan); $x++) {

                $this->table->getCell($rowNumber, $x, true)->setStyle("display: none;");

            }

        }
        
    }
    
    /**
     * Applys string overflow.
     * @return string
     */
    private function applyAutoTruncateTextConf() : string {
        
        $style = "";
        
        if($this->confAutoTruncateText) {
            
            $style = "<style>td, th {overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}</style>";
            
        }
        
        return $style;
        
    }
    
}
