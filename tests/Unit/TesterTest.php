<?php

namespace Tests\Unit;

use PHPKitchen\CodeSpecs\Base\Specification;

/**
 * Unit test for {@link \PHPKitchen\CodeSpecs\Specification\Tester}
 *
 * @coversDefaultClass \PHPKitchen\CodeSpecs\Specification\Tester
 *
 * @author Dmitry Kolodko <prowwid@gmail.com>
 */
class TesterTest extends Specification {
    /**
     * @covers ::seeBool
     * @covers ::<protected>
     */
    public function testSeeBool() {
        $I = $this->tester;
        $I->seeBool(true)->isTrue();
        $I->seeBool(false)->isFalse();
    }

    /**
     * @covers ::seeClass
     * @covers ::<protected>
     */
    public function testSeeTheClass() {
        $I = $this->tester;
        $thisClass = get_class($this);
        $I->seeClass($thisClass)->isExist();
    }

    /**
     * @covers ::see
     * @covers ::<protected>
     */
    public function testSee() {
        $I = $this->tester;
        $I->see(1)->isNotEmpty();
    }

    /**
     * @covers ::seeString
     * @covers ::<protected>
     */
    public function testSeeString() {
        $I = $this->tester;
        $I->seeString('')->isEmpty();
    }

    /**
     * @covers ::seeArray
     * @covers ::<protected>
     */
    public function testSeeTheArray() {
        $I = $this->tester;
        $I->seeArray([])->isEmpty();
    }

    /**
     * @covers ::seeObject
     * @covers ::<protected>
     */
    public function testSeeObject() {
        $I = $this->tester;
        $I->seeObject($this)->isNotEmpty();
    }

    /**
     * @covers ::seeFile
     * @covers ::<protected>
     */
    public function testSeeFile() {
        $I = $this->tester;
        $I->seeFile(__FILE__)->isExist()->isEqualTo(__FILE__);
    }

    /**
     * @covers ::seeDirectory
     * @covers ::<protected>
     */
    public function testSeeDirectory() {
        $I = $this->tester;
        $I->seeDirectory(__DIR__)->isExist();
    }

    /**
     * @covers ::seeNumber
     * @covers ::<protected>
     */
    public function testSeeNumber() {
        $I = $this->tester;
        $I->seeNumber(1)->isFinite();
    }

    /**
     * @covers ::getStepsListAsString
     * @covers ::<protected>
     */
    public function testGetStepsListAsString() {
        $I = $this->tester;
        $message = 'nothing cached';
        try {
            $I->expectThat('output contains all of the steps and mark checked expectations as succeeded');
            $I->seeNumber(1)->isNotEmpty()->isNull();
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        $expectedOutput = <<<TEXT
✓ I expect that output contains all of the steps and mark checked expectations as succeeded
✓ I see that number is not empty.
- I see that number is null.

Failed asserting that 1 is null.
TEXT;

        $this->assertEquals($expectedOutput, $message);
    }
}
