<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta\Tests;

use Bekrafta\DenmarkStrict;
use PHPUnit\Framework\TestCase;

class DenmarkStrictTest extends TestCase {
    public function testValidateChecksum() {
        $this->assertTrue((new DenmarkStrict('130600-5738'))->validate());
        $this->assertTrue((new DenmarkStrict('070777-1119'))->validate());
        $this->assertFalse((new DenmarkStrict('260783-1234'))->validate());
        $this->assertTrue((new DenmarkStrict('120494-3806'))->validate());
        $this->assertTrue((new DenmarkStrict('220890-4895'))->validate());
        $this->assertTrue((new DenmarkStrict('310586-4948'))->validate());
        $this->assertTrue((new DenmarkStrict('171263-1615'))->validate());
        $this->assertTrue((new DenmarkStrict('150517-3712'))->validate());
        $this->assertTrue((new DenmarkStrict('120917-3804'))->validate());
        $this->assertTrue((new DenmarkStrict('211062-5629'))->validate());
    }
}
