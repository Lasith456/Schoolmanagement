<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Usermodel');
    }

    public function index()
    {
        $this->load->view('excel');
    }

    public function uploadExcel()
    {
        if (isset($_FILES['excelinput']) && is_uploaded_file($_FILES['excelinput']['tmp_name'])) {
            $file_info = pathinfo($_FILES['excelinput']['name']);
            $file_directory = "upload/excel/";
            $new_file_name = date("y-m-d") . "-" . rand(00000, 99999) . "." . $file_info["extension"];

            // Get the temporary file path of the uploaded file
            $temp_file_path = $_FILES['excelinput']['tmp_name'];

            if (move_uploaded_file($temp_file_path, $file_directory . $new_file_name)) {
                $this->load->library('excelLibrary'); // Load the library class correctly

                $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_directory . $new_file_name);
                $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);
                $objPHPExcel = $objReader->load($file_directory . $new_file_name);
                $sheet_Data = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $sheet_Data = array_slice($sheet_Data, 1);
                if ($sheet_Data) {
                    foreach ($sheet_Data as $data) {
                        $colA = $data['A'];
                        $message = array("status" => "success", "message" => "File uploaded successfully. $colA");
                    }
                } else {
                    $message = array("status" => "error", "message" => "Empty data in the Excel file.");
                }
            } else {
                $message = array("status" => "error", "message" => "Error moving uploaded file.");
            }
        } else {
            $message = array("status" => "error", "message" => "No file uploaded or invalid file.");
        }

        // Debugging - Output the message
        var_dump($message);

        echo json_encode($message);
    }
}


