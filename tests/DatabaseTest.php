<?php // en cours de construction
use PHPUnit\Framework\TestCase;
use PDO;
use PDOStatement;

class DatabaseTest extends Database
{
    private $mockPdo;
    private $mockStmt;
    private $yourClassInstance;

    protected function setUp(): void
    {
        $this->mockPdo = $this->createMock(PDO::class);
        $this->mockStmt = $this->createMock(PDOStatement::class);

        // Mock de la méthode prepare pour retourner un PDOStatement mocké
        $this->mockPdo->method('prepare')->willReturn($this->mockStmt);

        // Instancier votre classe et injecter PDO mocké
        $this->yourClassInstance = $this->getMockBuilder(YourClass::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getPdo'])
            ->getMock();

        // Mock de getPdo pour retourner notre mock PDO
        $this->yourClassInstance->method('getPdo')->willReturn($this->mockPdo);

        // Définition des clés primaires (vous devez adapter selon votre classe)
        $this->yourClassInstance->tableName = 'users';
        $this->yourClassInstance->primaryKey = 'id'; // Peut être un tableau aussi
    }

    public function testGetOneWithSingleId()
    {
        $id = '123';
        $expectedSql = "SELECT * FROM users WHERE 1=1 AND id = ? LIMIT 1";

        // Vérifier que la requête SQL est bien générée
        $resultSql = $this->yourClassInstance->getOne($id);
        $this->assertEquals($expectedSql, $resultSql);
    }

    public function testGetOneWithArrayId()
    {
        $this->yourClassInstance->primaryKey = ['id', 'email'];
        $id = ['123', 'test@example.com'];
        $expectedSql = "SELECT * FROM users WHERE 1=1 AND id = ? AND email = ? LIMIT 1";

        $resultSql = $this->yourClassInstance->getOne($id);
        $this->assertEquals($expectedSql, $resultSql);
    }
}
?>