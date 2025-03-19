<?php
namespace tests;
use app\util\Error;
use modele\Paye;
use PHPUnit\Framework\TestCase;

class PayeTest extends TestCase {
    public function testCreationPaye () {
        $paye = new Paye(1, 3, 58.50);

        $this->assertEquals(1, $paye->getIdFacturation());
        $this->assertEquals(3, $paye->getIdTypePaiement());
        $this->assertEquals(58.50, $paye->getMontant());
    }
}
?>