<?php
/**
 * @file
 * PHPUnit tests for Coordinate class.
 */

require_once dirname(__FILE__) . '/Coordinate.php';

/**
 * Unit tests for Coordinate class.
 */
class CoordinateTest extends PHPUnit_Framework_TestCase {

  protected $coordinate;

  /**
   * Setup for Coordinate class.
   */
  public function setUp() {
    $this->coordinate = new Coordinate(43.54, -74.878);
  }

  /**
   * Test Coordinate __toString().
   */
  public function testCoordinateToStringFunction() {
    $this->assertSame('43.54, -74.878', $this->coordinate->__toString(),
      '__ToString() output did not match Coordinate values.');
  }

  /**
   * Test Coordinate getX().
   */
  public function testCoordinateGetXfunction() {
    $this->assertSame(43.54, $this->coordinate->getX(),
      'Getter method output did not match Coordinate value.');
  }

  /**
   * Test Coordinate getY().
   */
  public function testCoordinateGetYfunction() {
    $this->assertSame(-74.878, $this->coordinate->getY(),
      'Getter method output did not match Coordinate value.');
  }

  /**
   * Test Coordinate getX() with non-integers.
   *
   * @expectedException InvalidArgumentException
   */
  public function testCoordinateGetXfunctionNonInteger() {
    $coordinate = new Coordinate('1.0 2.0', -2);
  }

  /**
   * Test Coordinate getY() with non-integers.
   *
   * @expectedException InvalidArgumentException
   */
  public function testCoordinateGetYfunctionNonInteger() {
    $coordinate = new Coordinate(1.0, array());
  }

}
