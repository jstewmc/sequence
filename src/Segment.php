<?php
/**
 * The file for a sequence segment
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\Sequence;

use InvalidArgumentException;


/**
 * A sequence segment
 *
 * @since  0.1.0
 */
class Segment
{
    /* !Protected properties */
    
    /**
     * @var  int  the sequence's index
     */
    protected $index;
    
    
    /* !Get methods */
    
    /**
     * Returns the segment's index
     *
     * @return  int
     */
    public function getIndex()
    {
        return $this->index;
    } 
    
    
    /* !Magic methods */
    
    /**
     * Called when the segment is constructed
     *
     * @param   int  $index
     * @throws  InvalidArgumentException  if $index neither zero nor positive int
     */
    public function __construct($index)
    {
        if ($index < 0) {
            throw new InvalidArgumentException(
                __METHOD__."() expects parameter one, index, to be zero or a "
                    . "positive integer"
            );
        }
        
        $this->index = $index;
        
        return;
    }
}
