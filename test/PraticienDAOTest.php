<?php

namespace Tests;

require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . "/../app/const.php";

use PHPUnit\Framework\TestCase;

use modele\DAO\PraticienDAO as PraticienDAO;
use modele\Praticien as Praticien;

class PraticienDAOTest extends TestCase {

    private PraticienDAO $dao;

    protected function setUp(): void { 
        $this->dao = new PraticienDAO();
    }

    public function testCreateReadUpdateDelete() {

        // création faux praticien
        $praticien = new Praticien("CONTE", "Coleen", "coleen@conte.fr", "Psychologue", "1234567", "secret", 1);

        //test de création en bdd
        $resultCreate = $this->dao->create($praticien);
        $this->assertTrue($resultCreate);
        $this->assertNotNull($praticien->getId());

        // récupération de l'identifiant
        $id = $praticien->getId();

        // test de read
        $read = $this->dao->read($id);
        $this->assertEquals("CONTE", $read->getNom());
        $this->assertEquals("coleen@conte.fr", $read->getEmail());

        // test update
        $read->setNom("Test");
        $resultUpdate = $this->dao->update($read);
        $this->assertTrue($resultUpdate);

        $updated = $this->dao->read($id);
        $this->assertEquals("Test", $updated->getNom());

        // test de delete
        $updated = $this->dao->delete($read);
        $this->assertTrue($updated);
    }

    public function testGetPraticienByEmail() {
        $email = "coleen.conte@orange.fr";
        $result = $this->dao->getPraticienByEmail($email);
        $this->assertIsArray($result);
        $this->assertEquals($email, $result['email']);
    }
}

?>

