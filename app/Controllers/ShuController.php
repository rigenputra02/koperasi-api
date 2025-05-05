<?php
namespace App\Controllers;

use App\Models\Shu;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class ShuController extends ResourceController
{
    protected $modelName = 'App\Models\Shu';
    protected $format    = 'json';
    protected $model;

    public function __construct()
    {
        $model = new Shu();
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = $this->model->orderBy('id_shu', 'desc')->findAll();
        $ref  = [
            'status'    => 200,
            'message'   => 'success',
            'totalData' => count($data),
            'data_shu'  => $data,
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
            $fieldType = 'id_shu';
        } else {
            $userData  = $this->model->where('tahun', $param)->first();
            $fieldType = 'tahun';
        }

        if ($userData === null) {
            return $this->failNotFound("Data dengan filedType '$param' tidak ditemukan.");
        }

        $data = [
            'message'  => 'success',
            'data_shu' => $userData,
        ];

        return $this->respond($data, 200);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new ()
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
            'tahun'               => 'required',
            'tanggal_perhitungan' => 'required',
            'total_shu'           => 'required',
        ];

        if (! $this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $data = [
            'tahun'               => esc($this->request->getVar('tahun')),
            'tanggal_perhitungan' => esc($this->request->getVar('tanggal_perhitungan')),
            'total_shu'           => esc($this->request->getVar('total_shu')),
        ];

        $this->model->insert($data);

        $response = [
            'status'   => 200,
            'message'  => 'Data berhasil disimpan.',
            'data_shu' => $data,
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

        if (! empty($input['tahun'])) {
            $data['tahun'] = esc($input['tahun']);
        }
        if (! empty($input['tanggal_perhitungan'])) {
            $data['tanggal_perhitungan'] = esc($input['tanggal_perhitungan']);
        }
        if (! empty($input['total_shu'])) {
            $data['total_shu'] = esc($input['total_shu']);
        }

        // Cegah update kosong
        if (empty($data)) {
            return $this->fail('Tidak ada data yang diubah', 400);
        }

        $this->model->update($id, $data);

        $response = [
            'status'   => 200,
            'message'  => 'Data berhasil diupdate.',
            'data_shu' => $data,
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
