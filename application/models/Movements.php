<?php

/**
 * The movements model
 */
class Movements extends MY_Model {
    // constructor
    function __construct() {
        parent::__construct('movements','DateTime');
    }
}