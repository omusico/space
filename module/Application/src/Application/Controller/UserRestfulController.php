<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class UserRestfulController extends AbstractRestfulController
{

    public function __construct()
    {
    }

    public function create($data)
    {
        #code
    }

    public function getList()
    {
        return new JsonModel(array('data' => "Welcome to the Zend Framework Album API example"));
    }

    public function get($id)
    {
        #code
    }

    public function update($id, $data)
    {
        #code
    }

    public function delete($id)
    {
        #code
    }
}
