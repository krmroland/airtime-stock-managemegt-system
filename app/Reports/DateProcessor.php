<?php

namespace App\Reports;

use Illuminate\Support\Str;

class DateProcessor implements \IteratorAggregate
{
    /**
     * the date string.
     *
     * @var string
     */
    protected $dateString;

    /**
     * catched dates.
     */
    protected $date = '';

    /**
     * @var array
     */
    protected $range = [];

    /**
     * creates an instance of a processor class.
     *
     * @param string $dateString The date string
     */
    public function __construct($dateString = null)
    {
        $dateString = $dateString ?: request('date');

        $this->dateString = $dateString ?: date('Y-m-d');

        $this->setDates();
    }

    /**
     * Determines if range.
     *
     * @return bool true if range, False otherwise
     */
    public function isRange()
    {
        return Str::contains($this->dateString, 'to');
    }

    /**
     * Determines if daily.
     *
     * @return bool true if daily, False otherwise
     */
    public function isDaily()
    {
        return !$this->isRange();
    }

    /**
     * gets the dates on the instance.
     *
     * @return string|array
     */
    public function dates()
    {
        if ($this->isRange()) {
            return $this->range;
        }

        return $this->date;
    }

    /**
     * @param mixed $dates
     *
     * @return self
     */
    public function setDates()
    {
        if ($this->isRange()) {
            $this->setRange();

            return $this;
        }

        $this->date = trim($this->dateString);

        return $this;
    }

    protected function setRange()
    {
        foreach (explode('to', $this->dateString) as $date) {
            trim($date);
            $this->range[] = $date;
        }

        return $this;
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string string representation of the object
     */
    public function __toString()
    {
        return $this->date;
    }

    /**
     * Gets the iterator.
     *
     * @return \ the iterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->range);
    }

    public function from()
    {
        return $this->range[0];
    }

    public function to()
    {
        return $this->range[1];
    }
}
