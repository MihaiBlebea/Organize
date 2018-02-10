<?php

namespace SerbanBlebea\Organize;

class Column
{
    // TODO Turn all params to private

    public $name           = null;

    public $type           = null;

    public $length         = null;

    public $default        = null;

    public $key            = null;

    public $check          = null;

    public $unique         = false;

    public $auto_increment = false;

    public $on_update      = null;

    public $column = [];

    public static function with() {
        $class = __CLASS__;
        $instance = new $class();
        return $instance;
    }

    public function name(String $name)
    {
        $this->name = $name;
        return $this;
    }

    public function string(Int $length)
    {
        $this->type = "VARCHAR";
        $this->length = $length;
        return $this;
    }

    public function integer(Int $length)
    {
        $this->type = "INT";
        $this->length = $length;
        return $this;
    }

    public function timestamp()
    {
        $this->type = "TIMESTAMP";
        return $this;
    }

    public function default(String $default)
    {
        $this->default = $default;
        return $this;
    }

    // public function isIndex(Bool $isIndex = false, String $name = null, String $type = null)
    // {
    //     if($isIndex == true && $name !== null && $type !== null)
    //     {
    //         // Add index schema or just hold values
    //     }
    // }

    public function isKey(Bool $isKey = false, String $key = null)
    {
        if($isKey == true && $key !== null)
        {
            $this->key = strtoupper($key . ((strpos($key, "KEY") == false) ? " KEY" : ""));
        }
        return $this;
    }

    public function isUnique(Bool $isUnique = null)
    {
        if($isUnique == null)
        {
            $this->unique = true;
        } else {
            $this->unique = $isUnique;
        }
        return $this;
    }

    public function autoIncrement(Bool $auto_increment = null)
    {
        if($auto_increment == null)
        {
            $this->auto_increment = true;
        } else {
            $this->auto_increment = $auto_increment;
        }
        return $this;
    }

    public function timestampOnUpdate()
    {
        $this->on_update = "on update CURRENT_TIMESTAMP";
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function getDefault()
    {
        return $this->default;
    }

    public function getKey()
    {
        if($this->key !== null)
        {
            return $this->key;
        } else {
            return null;
        }
    }

    public function getUnique()
    {
        if($this->unique == true)
        {
            return "UNIQUE";
        } else {
            return null;
        }
    }

    public function getAutoIncrement()
    {
        if($this->auto_increment == true)
        {
            return "AUTO_INCREMENT";
        } else {
            return null;
        }
    }

    public function getOnUpdate()
    {
        return $this->on_update;
    }
}
