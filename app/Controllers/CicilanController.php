<?php

namespace App\Controllers;

use App\Models\Cicilan;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class CicilanController extends ResourceController
{
    protected $modelName = 'App\Models\Cicilan';
    protected $format = 'json';
    protected $model;

    public function __construct()
    {
        $model = new Cicilan();
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = $this->model->orderBy('id_cicilan', 'desc')->findAll();
        $ref  = [
            'status'        => 200,
            'message'       => 'success',
            'totalData'     => count($data),
            'data_cicilan' => $data,
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
            $fieldType = 'id_cicilan';
        } else {
            $userData  = $this->model->where('id_cicilan', $id)->first();
            $fieldType = 'id_cicilan';
        }

        if ($userData === null) {
            return $this->failNotFound("Data dengan $fieldType '$id' tidak ditemukan.");
        }

        $data = [
            'message' => 'success',
            'data_cicilan' => $userData,
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
            'id_pinjaman' => 'required',
            'jumlah_cicilan' => 'required',
            'tanggal_cicilan' => 'required',
        ];

        if (! $this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $this->model->insert(
            [
                'id_pinjaman' => esc($this->request->getVar('id_pinjaman')),
                'jumlah_cicilan' => esc($this->request->getVar('jumlah_cicilan')),
                'tanggal_cicilan' => esc($this->request->getVar('tanggal_cicilan')),
            ]
        );

        $response = [
            'message' => 'data berhasil disimpan',
        ];

        return $this->respondCreated($response);
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

        if (! empty($input['id_pinjaman'])) {
            $data['id_pinjaman'] = esc($input['id_pinjaman']);
        }
        if (! empty($input['jumlah_cicilan'])) {
            $data['jumlah_cicilan'] = esc($input['jumlah_cicilan']);
        }
        if (! empty($input['tanggal_cicilan'])) {
            $data['tanggal_cicilan'] = esc($input['tanggal_cicilan']);
        }

        if (empty($data)) {
            return $this->fail('Tidak ada data yang diupdate.');
        }

        $this->model->update($id, $data);

        $response = [
            'message' => 'data berhasil diupdate',
        ];

        return $this->respondUpdated($response);
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
            'message' => 'data berhasil dihapus',
        ];

        return $this->respondDeleted($response);
    }
}
