<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . "/third_party/PhpSpreadsheet/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelLibrary extends Spreadsheet
{
    public function __construct()
    {
        parent::__construct();
    }
}
