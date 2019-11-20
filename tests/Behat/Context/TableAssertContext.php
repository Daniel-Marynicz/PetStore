<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;
use Ingenerator\BehatTableAssert\AssertTable;
use Ingenerator\BehatTableAssert\TableParser\HTMLTable;

class TableAssertContext extends RawMinkContext
{
   /**
    * @Then I should see a report containing
    */
    public function assertReport(TableNode $expected) : void
    {
        $assert = $this->getMink()->assertSession();
        $actual = HTMLTable::fromMinkTable(
            $assert->elementExists('css', 'table')
        );
        $assert = new AssertTable();
        $assert->isSame($expected, $actual);
    }
}
