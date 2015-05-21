<?php

require('../conexionpersonal.php');
class conexionPersonalTest extends PHPUnit_Framework_TestCase
{
    private $entraAse = null;
    private $entraVin = null;
    public function testContectaPersonal()
    {
        
        $testDB = conectaBDpersonal('asesor');

        if ($testDB != null) {
            $this->assertTrue(true);
        }
        else{
            $this->assertTrue(false);
        }

        return 'uno';
    }

    public function testEntraAseso()
    {
        EntraAsesor('570', 'contra');

        if ($entraAse != null) {
            $this->assertTrue(true);
        }
        else{
            $this->assertTrue(false);
        }
        return 'dos';
    }
    
    public function testEntraVinculacion()
    {
        $entraVin = EntraVinculacion('111', 'contra');

        if ($entraAse != null) {
            $this->assertTrue(true);
        }
        else{
            $this->assertTrue(false);
        }
        return 'tres';
    }
}
?>
