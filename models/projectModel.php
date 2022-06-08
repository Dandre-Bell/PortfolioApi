<?php
    class Project{
        //properties left public due to the transient nature of the model instances
        public $name;
        public $description;
        public $link;
        public $tech;

        //constructors
        function __construct($n, $d, $l, $t){
            $this->name = $n;
            $this->description = $d;
            $this->link = $l;
            $this->tech = $t;
        }

    }
?>