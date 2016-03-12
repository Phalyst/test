<?php
namespace Clickatell;

error_reporting(E_ALL);
ini_set("display_errors", "On");

use \PHPUnit_Framework_TestCase;
use \PDO;

class CompanyServiceTest extends PHPUnit_Framework_TestCase
{
    private $service;

    public function setUp()
    {
        $database = new PDO("sqlite::memory:");
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $database->exec(file_get_contents(__DIR__ . '/fixture.sql'));

        $this->service = new CompanyService($database);
    }

    public function testLocateCompanyUsers()
    {
        $users = $this->service->locateCompanyUsers(1);

        $this->assertSame($users[0]['user_name'], 'John Wick');
        $this->assertSame($users[1]['user_name'], 'Tony Stark');
        $this->assertSame($users[2]['user_name'], 'Oliver Queen');
        $this->assertSame($users[3]['user_name'], 'Ray Palmer');
    }

    public function testDeleteCompanyUsers()
    {
        $affectedRows = $this->service->deleteCompanyUsers(2);

        $this->assertSame($affectedRows, 2);

        $this->setExpectedException('InvalidArgumentException');
        $this->service->deleteCompanyUsers(5);
    }

    public function testLinkCompanyUser()
    {
        $affectedRows = $this->service->linkCompanyUser(10, 2);
        $this->assertSame($affectedRows, 1);

        $this->setExpectedException('InvalidArgumentException');
        $affectedRows = $this->service->linkCompanyUser(11, 2);

        $this->setExpectedException('InvalidArgumentException');
        $affectedRows = $this->service->linkCompanyUser(10, 6);

        $users = $this->service->locateCompanyUsers(2);
        $this->assertSame($users[0]['user_name'], 'Varian Wrynn');
        $this->assertSame($users[1]['user_name'], 'Garrosh Hellscream');
        $this->assertSame($users[2]['user_name'], 'Unlinked User');
    }

    public function testUserWorth()
    {
        $worth = $this->service->userWorth(4);

        $this->assertSame($worth[0], "Bruce Wayne: I am worth billions.");
        $this->assertSame($worth[1], "Alfred Pennyworth: Worth means nothing to me.");
    }
}
