<?php
define("ROOT", realpath(__dir__)); 
require_once(ROOT . "/monapplication/moteur/Kernel.php");

Kernel::run();