<?php

require('../conexionalumno.php');

class conexionalumnoTest extends PHPUnit_Framework_TestCase
{
    private $testDB = null;
    private $entraAlu = null; 
    private $JSON = null;
    public function testContectaAlumno()
    {
        
        $testDB = conectaBDalumno('alumno');

        if ($testDB != null) {
            $this->assertTrue(true);
        }
        else{
            $this->assertTrue(false);
        }

        return 'uno';
    }

    public function testEntraAlumno()
    {
        $entraAlu = EntraAlumn('10170903', 33);

        if ($entraAlu != null) {
            $this->assertTrue(true);
        }
        else{
            $this->assertTrue(false);
        }
        return 'dos';
    }

    public function testBuscaralumno(){

        $this->assertTrue(buscaralumno('10170903'));
        return 'tres';

        
    }

    public function testCargoResidencia()
    {
        $this->assertTrue(cargoresidencias('1151006'));
        return 'cuatro';
    }

    /**
     * @depends testProducerFirst
     * @depends testProducerSecond
     */
    public function testConsumer()
    {
        $this->assertEquals(
            array('uno', 'dos','tres', 'cuatro'),
            func_get_args()
        );
    }

    public function testMostrarBanco(){
        $JSON = MostrarBanco(10170903);

        if ($JSON != null) {
            $this->assertTrue(true);
        }
        else
        {
            $this->assertTrue(false);
        }
    }
}
?>
