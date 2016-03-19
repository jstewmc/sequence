<?php
/**
 * The file for the sequence tests
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton 
 * @license    MIT
 */

namespace Jstewmc\Sequence;

use ReflectionObject;
use PHPUnit_Framework_TestCase as Test;

/**
 * Tests for the Sequence class
 *
 * @since  0.1.0
 */
class SequenceTest extends Test
{
    /* !__construct() */
    
    /**
     * __construct() should set the class properties if segments do not exist
     */
    public function test___construct_ifSegmentsDoNotExist()
    {
        $sequence = new Sequence();
        
        $class = new ReflectionObject($sequence);
        
        $property = $class->getProperty('segments');
        $property->setAccessible(true);
        
        $this->assertTrue($sequence instanceof Sequence);
        $this->assertEquals([], $property->getValue($sequence));
        
        return;
    }
    
    /**
     * __construct() should set the class properties if segments do exist
     */
    public function test___construct_ifSegmentsDoExist()
    {
        $segments = [new Segment(0), new Segment(1)];
        
        $sequence = new Sequence($segments);
        
        $class = new ReflectionObject($sequence);
        
        $property = $class->getProperty('segments');
        $property->setAccessible(true);
        
        $this->assertTrue($sequence instanceof Sequence);
        $this->assertSame($segments, $property->getValue($sequence));
        
        return;
    }
    
    
	/* !append() */

	/**
	 * append() should return self if segments do not exist
	 */
	public function test_append_returnsSelf_ifSegmentsDoNotExist()
	{
		$segment = new Segment(0);
		
		$sequence = new Sequence();
		
		$class = new ReflectionObject($sequence);
		
		$property = $class->getProperty('segments');
		$property->setAccessible(true);

		$this->assertSame($sequence, $sequence->append($segment));
		$this->assertSame([$segment], $property->getValue($sequence));
		
		return;
	}
	
	/**
	 * append() should append segment if segments do exist
	 */
	public function test_append_appendsSegment_ifSegmentsDoExist()
	{
		$segment1 = new Segment(0);
		$segment2 = new Segment(1);
		
		$sequence = new Sequence();
		
		$class = new ReflectionObject($sequence);
		
		$property = $class->getProperty('segments');
		$property->setAccessible(true);
		$property->setValue($sequence, [$segment1]);
				
		$this->assertSame($sequence, $sequence->append($segment2));
		$this->assertSame([$segment1, $segment2], $property->getValue($sequence));
		
		
		return;
	}
	
	
	/* !get() */
	
	/**
	 * get() should throw InvalidArgumentException if $offset is neither a valid 
	 *     string nor a valid integer
	 */
	public function test_get_throwsInvalidArgumentException_ifOffsetIsInvalid()
	{
		$this->setExpectedException('InvalidArgumentException');
		
		(new Sequence())->get([]);
		
		return;
	}
	
	/**
	 * get() should throw OutOfBoundsException if $offset is invalid key
	 */
	public function test_get_throwsOutOfBoundsException_ifOffsetIsInvalidIndex()
	{
		$this->setExpectedException('OutOfBoundsException');
		
		(new Sequence())->get(999);
		
		return;
	}
	
	/**
	 * get() should throw InvalidArgumentException if $offset is invalid string
	 */
	public function test_get_throwsInvalidArgumentException_ifOffsetIsInvalidString()
	{
		$this->setExpectedException('InvalidArgumentException');
		
		(new Sequence())->get('foo');
		
		return;
	}
	
	/**
	 * get() should return segment if $offset is valid index
	 */
	public function test_get_returnsSegment_ifOffsetIsValidIndex()
	{
		$segment1 = new Segment(0);
		$segment2 = new Segment(1);
		$segment3 = new Segment(2);
		
		$sequence = new Sequence();
		
        $class = new ReflectionObject($sequence);
        
        $property = $class->getProperty('segments');
        $property->setAccessible(true);
        $property->setValue($sequence, [$segment1, $segment2, $segment3]);
		
		$this->assertSame($segment2, $sequence->get(1));
		
		return;
	}
	
	/**
	 * get() should return segment if $offset is valid string
	 */
	public function test_get_returnsSegment_ifOffsetIsValidString()
	{
		$segment1 = new Segment(0);
		$segment2 = new Segment(1);
		$segment3 = new Segment(2);
		
		$sequence = new Sequence();
		
        $class = new ReflectionObject($sequence);
        
        $property = $class->getProperty('segments');
        $property->setAccessible(true);
        $property->setValue($sequence, [$segment1, $segment2, $segment3]);
		
		$this->assertSame($segment1, $sequence->get('first'));
		
		return;
	}
	
	
	/* !length() */
	
	/**
	 * length() should return int if segments do not exist
	 */
	public function test_length_returnsInt_ifSegmentsDoNotExist()
	{
		return $this->assertEquals(0, (new Sequence())->length());
	}
	
	/**
	 * getLength() should return int if segments do exist
	 */
	public function test_length_returnsInt_ifSegmentsDoExist()
	{
		return $this->assertEquals(
			1, 
			(new Sequence([new Segment(0)]))->length()
		);
	}
	
	
	/* !pop() */
	
	/**
	 * pop() should return null if segments do not exist
	 */
	public function test_pop_returnsNull_ifSegmentsDoNotExist()
	{
		return $this->assertNull((new Sequence())->pop());
	}
	
	/**
	 * pop() should return segment if segments do exist
	 */
	public function test_pop_returnsSegment_ifSegmentsDoExist()
	{
		$segment1 = new Segment(0);
		$segment2 = new Segment(1);
		
		$sequence = new Sequence();
		
		$class = new ReflectionObject($sequence);
		
		$property = $class->getProperty('segments');
		$property->setAccessible(true);
		$property->setValue($sequence, [$segment1, $segment2]);
		
		$this->assertSame($segment2, $sequence->pop());
		$this->assertSame([$segment1], $property->getValue($sequence));
		
		return;
	}
	
	
	/* !prepend() */
	
	/**
	 * prepend() should return self if segments do not exist
	 */
	public function test_prepend_returnsSelf_ifSegmentsDoNotExist()
	{
		$segment = new Segment(0);
		
		$sequence = new Sequence();
		
		$class = new ReflectionObject($sequence);
		
		$property = $class->getProperty('segments');
		$property->setAccessible(true);
	
		$this->assertSame($sequence, $sequence->prepend($segment));
		$this->assertSame([$segment], $property->getValue($sequence));
		
		return;
	}
	
	/**
	 * prepend() should return self if segments do exist
	 */
	public function test_prepend_returnsSelf_ifSegmentsDoExist()
	{
		$segment1 = new Segment(0);
		$segment2 = new Segment(1);
		
		$sequence = new Sequence();;
		
		$class = new ReflectionObject($sequence);
		
		$property = $class->getProperty('segments');
		$property->setAccessible(true);
		$property->setValue($sequence, [$segment1]);
		
		$this->assertSame($sequence, $sequence->prepend($segment2));
		$this->assertSame([$segment2, $segment1], $property->getValue($sequence));
		
		return;
	}
	 
	
	/* !shift() */
	
	/**
	 * shift() should return null if segments do not exist
	 */
	public function test_shift_returnsNull_ifSegmentsDoNotExist()
	{
		return $this->assertNull((new Sequence())->shift());
	}
	
	/**
	 * shift() should return segment if segments do exist
	 */
	public function test_shift_returnsSegment_ifSegmentsDoExist()
	{
		$segment1 = new Segment(0);
		$segment2 = new Segment(1);
		
		$sequence = new Sequence();
		
		$class = new ReflectionObject($sequence);
		
		$property = $class->getProperty('segments');
		$property->setAccessible(true);
		$property->setValue($sequence, [$segment1, $segment2]);
		
		$this->assertSame($segment1, $sequence->shift());
		$this->assertSame([$segment2], $property->getValue($sequence));
		
		return;
	}
}
