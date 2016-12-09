<?php
/**
 * Объект "Отдел"
 */
class Department extends Model
{
    public $name;
    public $room;

    public function __construct($name,$room)
    {
        $this->name=$name;
        $this->room=$room;
    }
}