<!-- <?php
// use PHPUnit\Framework\TestCase;
// use modele\Paye;
// use modele\Facturation;

// class FacturationTest extends TestCase {
    
//     public function testReadReturnsPayeObject() {
//         // ✅ 1. Créer un mock de la classe Facturation
//         $facturationMock = $this->getMockBuilder(Facturation::class)
//             ->onlyMethods(['getOne']) // On ne mock que getOne()
//             ->getMock();

//         // ✅ 2. Définir le comportement du mock
//         $facturationMock->method('getOne')->willReturn((object) [
//             'montant' => 100.0,
//             'datePaiement' => '2025-03-19',
//         ]);

//         // ✅ 3. Exécuter la méthode
//         $result = $facturationMock->read(1, 2);

//         // ✅ 4. Vérifier que c'est bien une instance de Paye
//         $this->assertInstanceOf(Paye::class, $result);
//         $this->assertEquals(100.0, $result->getMontant());
//         $this->assertEquals('2025-03-19', $result->getDatePaiement());
//     }

//     public function testReadThrowsExceptionForInvalidIds() {
//         // ✅ 1. Créer un mock qui retourne `false`
//         $facturationMock = $this->getMockBuilder(Facturation::class)
//             ->onlyMethods(['getOne'])
//             ->getMock();

//         $facturationMock->method('getOne')->willReturn(false);

//         // ✅ 2. Vérifier que l'exception est bien levée
//         $this->expectException(\InvalidArgumentException::class);

//         // ✅ 3. Exécuter avec des ID invalides
//         $facturationMock->read(0, 0);
//     }
// }
?> -->