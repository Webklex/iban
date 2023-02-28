<?php
/*
* File: IbanTest.php
* Category: -
* Author: M.Goldenbaum
* Created: 28.02.23 18:51
* Updated: -
*
* Description:
*  -
*/

namespace Tests;

use PHPUnit\Framework\TestCase;
use Webklex\IBAN\IBAN;

class IbanTest extends TestCase {

    public function test(): void {
        $iban = IBAN::make("123456789", "10000000", "de");
        self::assertSame("10100033100000000123456789", $iban->calculate());
        self::assertSame("0123456789", $iban->getAccountNumber());
        self::assertSame("10000000", $iban->getSortCode());
    }

}