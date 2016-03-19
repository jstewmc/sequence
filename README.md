# Sequence
An ordered PHP array.

```php
$segment1 = new Segment(0);
$segment2 = new Segment(1);

$sequence = new Sequence();

$sequence->append($segment1);
$sequence->append($segment2);

echo $sequence->length() ."\n\n";

foreach ($sequence->getSegments() as $segment) {
    echo $segment->getIndex(); . "\n";
}
```

The example above would produce the following output:

```
2

0
1
```

## Usage

You can instantiate a sequence _with_ or _without_ segments:

```php
namespace Jstewmc\Sequence;

$a = new Sequence();
$b = new Sequence([new Segment(0), new Segment(1));
```

You can append a segment with `append()`:

```php
namespace Jstewmc\Sequence;

$segment1 = new Segment(0);
$segment2 = new Segment(1);

$sequence = new Sequence();

echo $sequence->length();  // prints 0

$sequence->append($segment1);

echo $sequence->length();  // prints 1

$sequence->append($segment2);

echo $sequence->length();  // prints 2

$sequence->getSegments() === [$segment1, $segment2];  // returns true
```

You can prepend a segment with `prepend()`:

```php
namespace Jstewmc\Sequence;

$segment1 = new Segment(0);
$segment2 = new Segment(1);

$sequence = new Sequence();

echo $sequence->length();  // prints 0

$sequence->prepend($segment1);

echo $sequence->length();  // prints 1

$sequence->prepend($segment2);

echo $sequence->length();  // prints 2

$sequence->getSegments() === [$segment2, $segment1];  // returns true
```

You can get a segment with `get()`:

```php
namespace Jstewmc\Sequence;

$segment1 = new Segment(0);
$segment2 = new Segment(1);
$segment3 = new Segment(2);

$sequence = new Sequence([$segment1, $segment2, $segment3]);

$sequence->get('first');  // returns $segment1
$sequence->get(0);        // returns $segment1

$sequence->get('last');   // returns $segment3
$sequence->get(-1);       // returns $segment3

$sequence->get(1);        // returns $segment2

$sequence->get('foo');    // throws InvalidArgumentException
$sequence->get(999);      // throws OutOfBOundsException

```

You can pop a segment with `pop()`:

```php
namespace Jstewmc\Sequence;

$segment1 = new Segment(0);
$segment2 = new Segment(1);

$sequence = new Sequence([$segment1, $segment2]);

$sequence->pop($segment2);  // returns $segment2
$sequence->length();        // returns 1
```

You can shift a segment with `shift()`:

```php
namespace Jstewmc\Sequence;

$segment1 = new Segment(0);
$segment2 = new Segment(1);

$sequence = new Sequence([$segment1, $segment2]);

$sequence->shift($segment1);  // returns $segment1
$sequence->length();          // returns 1
```

## License

[MIT](https://github.com/jstewmc/sequence/blob/master/LICENSE)


## Version 

### 0.1.0, March 19, 2016

* Initial release


## Author

[Jack Clayton](mailto:clayjs0@gmail.com)
