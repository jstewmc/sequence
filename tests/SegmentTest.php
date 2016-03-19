<?php
/**
 * The file for the segment tests
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\Sequence;

use ReflectionObject;
use PHPUnit_Framework_TestCase as Test;

/**
 * Tests for the segment class
 *
 * @since  0.1.0
 */
class SegmentTest extends Test
{
    /* !__construct() */
    
    /**
     * __construct() should throw InvalidArgumentException if index is negative
     */
    public function test___construct_throwsInvalidArgumentException_ifIndexIsNegative()
    {
        $this->setExpectedException('InvalidArgumentException');
        
        new Segment(-1);
        
        return;
    }
    
    /**
     * __construct() should set properties
     */
    public function test___construct()
    {
        $index = 0;
        
        $segment = new Segment($index);
        
        $class = new ReflectionObject($segment);
        
        $property = $class->getProperty('index');
        $property->setAccessible(true);
        
        $this->assertEquals($index, $property->getValue($segment));
        
        return;
    }
    
    
    /* !getIndex() */
    
    /**
     * getIndex() should return int
     */
    public function test_getIndex_returnsInt()
    {
        $index = 0;
        
        $segment = new Segment(0);
        
        $class = new ReflectionObject($segment);
        
        $property = $class->getProperty('index');
        $property->setAccessible(true);
        $property->setValue($segment, $index);
        
        $this->assertEquals($index, $segment->getIndex());
        
        return;
    }
}
