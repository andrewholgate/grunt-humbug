<?php
/**
 * @file
 * A class representing an x, y coordinate location.
 */

/**
 * A coordinate class for defining the x and y coordinate location.
 */
class Coordinate {

  private $x;
  private $y;

  /**
   * Creates a coordinate instance representing the x and y location.
   *
   * @param float $x
   *   X-Coordinate location.
   * @param float $y
   *   Y-Coordinate location.
   */
  public function __construct($x, $y) {
    $this->setX($x);
    $this->setY($y);
  }

  /**
   * A string representation of the x and y coordinate.
   *
   * @return string
   *   Present location and direction of the rover.
   */
  public function __toString() {
    return "{$this->x}, {$this->y}";
  }

  /**
   * Set the X-coordinate value.
   *
   * @param float $coordinate
   *   X-coordinate value to be set.
   */
  public function setX($coordinate) {
    // We're not enforcing doubles, will accept integers as well.
    if (is_numeric($coordinate)) {
      $this->x = $coordinate;
    }
    else {
      throw new InvalidArgumentException('Coordinates must be numeric');
    }
  }

  /**
   * Set the Y-coordinate value.
   *
   * @param float $coordinate
   *   Y-coordinate value to be set.
   */
  public function setY($coordinate) {
    if (is_numeric($coordinate)) {
      $this->y = $coordinate;
    }
    else {
      throw new InvalidArgumentException('Coordinates must be numeric');
    }
  }

  /**
   * Get the X-coordinate value.
   *
   * @return float
   *   X-coordinate value.
   */
  public function getX() {
    return $this->x;
  }

  /**
   * Get the Y-coordinate value.
   *
   * @return float
   *   Y-coordinate value.
   */
  public function getY() {
    return $this->y;
  }
}
