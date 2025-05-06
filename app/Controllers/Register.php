<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Register extends ResourceController
{
    protected $modelName = 'App\Models\User';
    protected $format    = 'json';
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }
    
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        //
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $rules = [
            'email' => [
                'rules' => 'required|is_unique[users.email]',],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[255]',],
            'confirm_password' => [
                'label' => 'Confirm Password', 'rules' => 'required|matches[password]'],
        ];

        if($this->validate($rules)){
            $data = [
                'nama' => $this->request->getVar('nama'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];
            if (!$this->model->save($data)) {

                return $this->fail($this->model->errors());
            }

            return $this->respond(
                [
                    'message' => 'registrasi berhasil'
                ],
                200
            );
        }else{
            $res = [
                'error' => [
                    'message' => $this->validator->getErrors(),
                    'message' => 'kesalahan input'
                ]
                ];
                
            }
        }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }
}
