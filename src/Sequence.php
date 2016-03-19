<?php
/**
 * The file for a sequence
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\Sequence;

use InvalidArgumentException;
use OutOfBoundsException;

/**
 * A sequence
 *
 * A sequence is an array of segments where order matters.
 *
 * @since  0.1.0
 */
class Sequence
{
    /* !Protected properties */
    
    /**
     * @var  Segment[]  the sequence's segments
     */
    protected $segments = [];
    
    
    /* !Get methods */
    
    /**
     * Returns the sequence's segments
     *
     * @return  Segment[]
     */
    public function getSegments()
    {
        return $this->segments;
    }
    
    
    /* !Magic methods */ 
    
    /**
     * Called when the sequence is constructed
     *
     * @param  Segment[]  $segments  the sequence's segments (optional)
     */
    public function __construct(array $segments = []) 
    {
        $this->segments = $segments;
        
        return;
    }
    
    
    /* !Public methods */
    
    /**
     * Appends a segment to the end of the sequence
     *
     * @param   Segment   $segment  the segment to append
     * @return  self
     */
    public function append(Segment $segment)
    {
        array_push($this->segments, $segment);
        
        return $this;
    }
    
    /**
     * Returns the segment's length
     *
     * @return  int
     */
    public function length()
    {
        return count($this->segments);
    }
    
    /**
	 * Returns the segment at $offset
	 *
	 * @param  int|string  $offset  if offset is non-negative, the segment that many
	 *     places from the *beginning* of the sequence will be returned; if offset is 
	 *     negative, the segment that many places from the *end* of the sequence will
	 *     be returned; if offset is a non-integer string, it must be one of the 
	 *     following: 'first', for the first segment; 'last', for the last segment;
	 *     or 'rand[om]', for a random segment (case-insensitive)
	 * @return  Segment|false
	 * @throws  InvalidArgumentException  if $offset is not a string or integer
	 * @throws  InvalidArgumentException  if $offset is an unsupported string
	 * @throws  OutOfBoundsException      if $offset results in an invalid index
	 */
	public function get($offset)
	{
		$segment = false;
		
		// if the offset is numeric
		if (is_numeric($offset) && is_int(+$offset)) {
    		// get the index in segments from the offset
			$index = $this->getIndex($offset);
			if ($index >= 0 && array_key_exists($index, $this->segments)) {
				$segment = $this->segments[$index];
			} else {
				throw new OutOfBoundsException(
					__METHOD__."() expects parameter one, offset, when an integer, "
						. "to result in a valid index; $index is not a valid index"
				);
			}
		} elseif (is_string($offset)) {
    		// otherwise, if the offset is a string
			switch (strtolower($offset)) {
				
				case 'first':
					$segment = reset($this->segments);
					break;
				
				case 'last':
					$segment = end($this->segments);
					break;
				
				case 'rand':
				case 'random':
					$segment = $this->segments[array_rand($this->segments)];
					break;
				
				default:
					throw new InvalidArgumentException(
						__METHOD__."() expects parameter one, offset, when a "
							. "string to be one of the following: 'first', 'last', "
							. "'or rand[om]'; '$offset' is not supported"
					);
			}
		} else {
    		throw new InvalidArgumentException(
				__METHOD__."() expects parameter one, offset, to be a string or "
				    . "integer"
			);
		}
		
		return $segment;
	}
    
    /**
     * Pops a segment off the end of the sequence
     *
     * @return  Segment
     */
    public function pop()
    {
        return array_pop($this->segments);
    }
    
    /**
     * Prepends a segment to the beginning of the sequence
     *
     * @param   Segment  $segment  the segment to prepend
     * @return  self
     */
    public function prepend(Segment $segment)
    {
        array_unshift($this->segments, $segment);
        
        return $this;
    }
    
    /**
     * Shifts a segment off the front of the sequence
     *
     * @return  Segment
     */
    public function shift()
    {
        return array_shift($this->segments);
    }
    
    
    /* !Private methods */
    
    /**
	 * Returns an index in $segments based on $offset
	 *
	 * @param   int  $offset  the array's offset
	 * @return  int  the array's index
	 * @throws  InvalidArgumentException  if $offset is not an integer
	 */
	private function getIndex($offset)
	{
		if ( ! is_numeric($offset) && is_int(+$offset)) {
			throw new InvalidArgumentException(
				__METHOD__."() expects parameter one, offset, to be an integer"
			);	
		}
		
		return $offset < 0 ? count($this->segments) + $offset : $offset;
	}
}
