<?php

namespace App\Controllers;

use App\Models\InfoPupuk;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class InfoPupukController extends ResourceController
{
    protected $modelName = 'App\Models\InfoPupuk';
    protected $format = 'json';
    protected $model;

    public function __construct()    
    {
        $this->model = new InfoPupuk();
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = $this->model->orderBy('id_pupuk', 'desc')->findAll();
        $ref = [
            'status' => 200,
            'message' => 'success',
            'totalData' => count($data),
            'data_info_pupuk' => $data
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
    public function show($param = null)
    {
        if ($param === null) {
            return $this->fail('Parameter tidak boleh kosong.');
        }

        if (is_numeric($param)) {
            $userData  = $this->model->find($param);
            $fieldType = 'id_pupuk';
        } else {
            $userData  = $this->model->where('nama_pupuk', $param)->first();
            $fieldType = 'nama_pupuk';
        }

        if ($userData === null) {
            return $this->failNotFound("Data dengan filedType '$param' tidak ditemukan.");
        }

        $data = [
            'message'  => 'success',
            'data_pupuk' => $userData,
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
            'nama_pupuk' => 'required',
            'jenis_pupuk' => 'required',
            'harga_per_kg' => 'required',
            'satuan' => 'required',
            'tanggal_update' => 'required',
        ];

        if (! $this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $data = [
            'nama_pupuk' => esc($this->request->getVar('nama_pupuk')),
            'jenis_pupuk' => esc($this->request->getVar('jenis_pupuk')),
            'harga_per_kg' => esc($this->request->getVar('harga_per_kg')),
            'satuan' => esc($this->request->getVar('satuan')),
            'tanggal_update' => esc($this->request->getVar('tanggal_update')),
        ];

        $this->model->insert($data);

        $response = [
            'status'   => 200,
            'message'  => 'Data berhasil ditambahkan.',
            'data_pupuk' => $data,
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

        if (! empty($input['id_pupuk'])) {
            $data['id_pupuk'] = esc($input['id_pupuk']);
        }
        if (! empty($input['nama_pupuk'])) {
            $data['nama_pupuk'] = esc($input['nama_pupuk']);
        }
        if (! empty($input['jenis_pupuk'])) {
            $data['jenis_pupuk'] = esc($input['jenis_pupuk']);
        }
        if (! empty($input['harga_per_kg'])) {
            $data['harga_per_kg'] = esc($input['harga_per_kg']);
        }
        if (! empty($input['satuan'])) {
            $data['satuan'] = esc($input['satuan']);
        }
        if (! empty($input['tanggal_update'])) {
            $data['tanggal_update'] = esc($input['tanggal_update']);
        }

        // Cegah update kosong
        if (empty($data)) {
            return $this->fail('Tidak ada data yang diubah', 400);
        }

        $this->model->update($id, $data);

        $response = [
            'status' => 200,
            'message' => 'Data berhasil diupdate.',
            'data_pupuk' => $data,
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
            'message' => 'data berhasil dihapus',
        ];

        return $this->respondDeleted($response);
    }
}
