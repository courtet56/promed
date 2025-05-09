<?php

use PHPUnit\Framework\TestCase;
use modele\DAO\PraticienDAO;
use modele\Praticien;

// Test de la classe Praticien DAO
class PraticienDAOTest extends TestCase {

    private PraticienDAO $dao;

    protected function setUp(): void {
        $this->dao = new PraticienDAO();
    }

    // Test de la méthode de création et de lecture d'un praticien
    public function testCreateAndRead() {
        $praticien = new Praticien(
            'Courtet', 'Gildas', 'gildas.courtet@example.com',
            'Kinésithérapeute', '1234567', 'motdepasse', 1
        );

        $result = $this->dao->create($praticien);
        $this->assertTrue($result);

        $id = $praticien->getId();
        $this->assertIsInt($id);

        $retrieved = $this->dao->read($id);
        $this->assertInstanceOf(Praticien::class, $retrieved);
        $this->assertEquals('Gildas', $retrieved->getPrenom());
    }

    // test de la récupération d'un praticien par son email
    public function testGetPraticienByEmail() {
        $data = $this->dao->getPraticienByEmail('gildas.courtet@example.com');
        $this->assertIsArray($data);
        $this->assertEquals('gildas.courtet@example.com', $data['email']);
    }

    // test de le la suppression d'un praticien (crée puis supprime un praticien)
    public function testDelete() {
        $praticien = new Praticien(
            'Durand', 'Paul', 'paul.durand@example.com',
            'Ostéopathe', '7654321', 'autremdp', 1
        );

        $this->dao->create($praticien);
        $this->assertTrue($this->dao->delete($praticien));
    }

}