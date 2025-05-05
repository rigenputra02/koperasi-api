<?php

namespace App\Controllers;

use App\Models\Distribusi;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class DistribusiController extends ResourceController
{
    protected $modelName = 'App\Models\Distribusi';
    protected $format = 'json';
    protected $model;

    public function __construct()
    {
        $this->model = new Distribusi();
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = $this->model->orderBy('id_distribusi', 'desc')->findAll();
        $ref  = [
            'status'    => 200,
            'message'   => 'success',
            'totalData' => count($data),
            'data_user' => $data,
        ];
        return $this->respond($ref, 200);
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
        if ($id === null) {
            return $this->fail('Parameter tidak boleh kosong.');
        }

        if (is_numeric($id)) {
            $userData  = $this->model->find($id);
            $fieldType = 'id_distribusi';
        } else {
            $userData  = $this->model->where('id_user', $id)->first();
            $fieldType = 'id_user';
        }

        if ($userData === null) {
            return $this->failNotFound("Data dengan $fieldType '$id' tidak ditemukan.");
        }

        $data = [
            'status' => 200,
            'message' => 'success',
            'totalData' => count($userData),
            'data_user' => $userData,
        ];

        return $this->respond($data, 200);
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
            'id_user' => 'required',
            'id_shu' => 'required',
            'jumlah_diterima' => 'required',
        ];

        if (! $this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $this->model->insert([
            'id_user' => esc($this->request->getVar('id_user')),
            'id_shu' => esc($this->request->getVar('id_shu')),
            'jumlah_diterima' => esc($this->request->getVar('jumlah_diterima')),
        ]);

        return $this->respondCreated('Data berhasil ditambahkan.');
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
        $input = $this->request->getRawInput();

        $data = [];

        if (! empty($input['id_user'])) {
            $data['id_user'] = esc($input['id_user']);
        }
        if (! empty($input['id_shu'])) {
            $data['id_shu'] = esc($input['id_shu']);
        }
        if (! empty($input['jumlah_diterima'])) {
            $data['jumlah_diterima'] = esc($input['jumlah_diterima']);
        }

        if (empty($data)) {
            return $this->fail('Data tidak ada data yang diubah.');
        }

        $this->model->update($id, $data);

        $response = [
            'status' => 200,
            'error' => false,
            'message' => 'data berhasil diubah.',
            'totalData' => count($data),
            'data_user' => $data,
        ];

        return $this->respond($response, 200);
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
        $this->model->delete($id);
        $response = [
            'message' => 'data dengan id ' . $id . ' berhasil dihapus',
        ];

        return $this->respondDeleted($response);
    }
}
