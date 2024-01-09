<?php

namespace controllers;

use core\BaseController;
use core\Validator;
use core\View;
use models\Task;

class TaskController extends BaseController
{
    public Validator $validator;
    public function __construct()
    {
        $this->model = new Task();
        $this->view = new View();
        $this->validator = new Validator();
    }
    
    public function index(): void
    {
        $dateFrom = filter_input(INPUT_POST, 'date_from');
        $this->data['dateFrom'] = $dateFrom;
        $dateTo = filter_input(INPUT_POST, 'date_to');
        $this->data['dateTo'] = $dateTo;
        $errors =[];
        if (empty($dateFrom) && empty($dateTo)) {
            $this->data['tasks'] = $this->model->getTasksWithAgentName();
        }else{
            $criteria = '';
            if (!empty($dateFrom)) {
                $isValidDateFrom = $this->validator->validateDate($this->data['dateFrom']);
                if ($isValidDateFrom){
                    $criteria .= "decision_date >= '$dateFrom'";
                }else{
                    $errors['dateFrom']='Некоректна дата. Введіть, будь ласка, дату в форматі день.місяць.рік';
                }
            }
            if (!empty($dateFrom) && !empty($dateTo)) {
                $criteria .= ' AND ';
            }
            if (!empty($dateTo)) {
                $isValidDateTo = $this->validator->validateDate($this->data['dateTo']);
                if ($isValidDateTo){
                    $criteria .= "decision_date <= '$dateTo'";
                }else{
                    $errors['dateTo']='Некоректна дата. Введіть, будь ласка, дату в форматі день.місяць.рік';
                }
            }
            if(empty($errors)){
                $this->data['tasks'] = $this->model->getSolvedTasksWithAgentNameByCriteria($criteria);
            }else{
                $this->data['tasks'] = [];
            }
        }
        $this->data['errors'] = $errors;
        $this->view->render('index', $this->data);
    }

    

    
}

