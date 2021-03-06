<?php

/*
The MIT License (MIT)

Copyright (c) <2016> <Carlos Alberto Garcia Cobo - carlosgc4@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

	Fecha creacion		= 20-02-2015
	Desarrollador		= CAGC
	Fecha modificacion	= 23-05-2017
	Usuario Modifico	= CAGC

*/

class Options{
	var $renderForm;
    var $hideInitValidationError;
	var $form;
	var $type;
	var $items;
    var $fields;
    var $showActionsColumn;
    var $datatables;
        
   function Options(){
      
   }

   	
   function addType($value,$valbol){
   	 $this->type = $value;
     $this->showActionsColumn = $valbol;
   }
    
  function addDatatables($info){
      if (!isset($this->datatables)){
          $this->datatables = array();
       }      
      
      	$this->datatables["paging"] = true;
        $this->datatables["searching"] = true;
        $this->datatables["ordering"] = false;
        $this->datatables["lengthChange"] = true;
        $this->datatables["info"] = true;
        $this->datatables["responsive"] = true;
      
        $this->datatables["language"] =$info;
      
        $this->datatables['dom'] = 'Bfrtip';
        $this->datatables['buttons'] = ['copy', 'csv', 'excel', 'pdf', 'print'];
  }    
    
   function addForm($fieldId,$value){

      if (!isset($this->form)){
         $this->form = array();
      }
      	$this->form[$fieldId] = $value;
	}
    
    function addItems($fieldId,$value){
     
        if (!isset($this->items)){
              $this->items = array();
        }
     
        $this->items[$fieldId] = $value;
    }

    function addFields($fieldId,$value){

         if (!isset($this->fields)){
            $this->fields = array();
         }

         $this->fields[$fieldId] = $value;
   }

   function addField($rows){

		if (!isset($fields)){
			$fields = array();
		}
       
        foreach($rows as $row){
            if ( $row[1] == "boolean" ) {
				if ($row[2] == 'true' )
					$row[2]= true;
				else
					$row[2]= false;
			}
            
            if ($row[0]=='picker'){
                $row[2]=$row[2];
            }
            
            $fields[$row[0]]=$row[2];
        }

		return $fields;

   }

  function addElement($action,$method,$enctype,$target){

	$this->renderForm = true;
    $this->hideInitValidationError= true; 
	
	if (!isset($form)){
        	$form = array();
     	}

 	$form["action"]=$action;
	$form["method"]=$method;
	$form["enctype"]=$enctype;
    $form["target"]=$target;

	return $form;
 }

}

?>
