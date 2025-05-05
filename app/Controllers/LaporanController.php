<?php

namespace App\Controllers;

use App\Models\Laporan;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class LaporanController extends ResourceController
{
    protected $modelName = 'App\Models\Laporan';
    protected $format = 'json';
    protected $model;

    public function __construct()
    {
        $this->model = new Laporan();
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data= $this->model->orderBy('id_laporan', 'desc')->findAll();
        $ref  = [
            'status'        => 200,
            'message'       => 'success',
            'totalData'     => count($data),
            'data_laporan' => $data,
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

        $userData  = $this->model->find($id);
        if ($userData === null) {
            return $this->failNotFound("Data dengan id '$id' tidak ditemukan.");
        }

        $data = [
            'message' => 'success',
            'data_laporan' => $userData,
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
            'id_petugas' => 'required',
            'isi_laporan' => 'required',
            'jenis_laporan' => 'required',
            'periode' => 'required',
        ];

        if (! $this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $data = [
            'id_petugas' => esc($this->request->getVar('id_petugas')),
            'isi_laporan' => esc($this->request->getVar('isi_laporan')),
            'jenis_laporan' => esc($this->request->getVar('jenis_laporan')),
            'periode' => esc($this->request->getVar('periode')),
        ];

        $this->model->insert($data);

        $response = [
            'status'  => 200,
            'message' => 'success',
            'data_laporan' => $data,
        ];
        return $this->respond($response, 200);
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

        if (! empty($input['id_petugas'])) {
            $data['id_petugas'] = esc($input['id_petugas']);
        }
        if (! empty($input['isi_laporan'])) {
            $data['isi_laporan'] = esc($input['isi_laporan']);
        }
        if (! empty($input['jenis_laporan'])) {
            $data['jenis_laporan'] = esc($input['jenis_laporan']);
        }
        if (! empty($input['periode'])) {
            $data['periode'] = esc($input['periode']);
        }

        // Cegah update kosong
        if (empty($data)) {
            return $this->fail('Tidak ada data yang diubah', 400);
        }

        $this->model->update($id, $data);

        $response = [
            'status'  => 200,
            'message' => 'data berhasil diubah',
            'data_laporan' => $data,
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
