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

	Fecha creacion		= 05-04-2015
	Desarrollador		= GASAKAWA
	Fecha modificacion	= 13-01-2016
	Usuario Modifico	= CAGC

*/
    include_once "Wizard.php";

    class View{
        
        var $parent;
        var $wizard;
        
        function setView($db,$par, $type, $idPage){
            if($type == "wizard"){
                $this->parent = $par;
                $this->wizard = new Wizard($db,$idPage);
                $this->wizard->buildBindings($db,$idPage);
                $this->wizard->buildSteps($db,$idPage);
                $this->wizard->buildButtons($db,$idPage);
            }else{
                $this->parent = $par;
                unset($this->wizard);
            }
        }
    }
?>