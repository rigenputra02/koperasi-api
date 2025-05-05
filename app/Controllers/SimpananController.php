<?php
namespace App\Controllers;

use App\Models\Simpanan;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class SimpananController extends ResourceController
{
    protected $modelName = 'App\Models\Simpanan';
    protected $format    = 'json';
    protected $model;
    public function __construct()
    {
        $model = new Simpanan();
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = $this->model->orderBy('id_simpanan', 'desc')->findAll();
        $ref  = [
            'status'        => 200,
            'message'       => 'success',
            'totalData'     => count($data),
            'data_simpanan' => $data,
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
        $data = $this->model->find($id);
        if (! $data) {
            return $this->failNotFound('Data tidak ditemukan.');
        }
        return $this->respond($data);
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
            'id_user'          => 'required',
            'jenis_simpanan'   => 'required',
            'jumlah'  => 'required',
            'tanggal_simpanan' => 'required',
            'status'           => 'required',
        ];

        if (! $this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }
        $data = [
            'id_user' => esc($this->request->getVar('id_user')),
            'jenis_simpanan' => esc($this->request->getVar('jenis_simpanan')),
            'jumlah' => esc($this->request->getVar('jumlah')),
            'tanggal_simpanan' => esc($this->request->getVar('tanggal_simpanan')),
            'status' => esc($this->request->getVar('status')),
        ];

        $this->model->insert($data);
        $response = [
            'status'  => 200,
            'message' => 'success',
            'data'    => $data,
        ];
        return $this->respondCreated($response, 'Data berhasil disimpan.');
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

        if (! empty($input['jenis_simpanan'])) {
            $data['jenis_simpanan'] = esc($input['jenis_simpanan']);
        }

        if (! empty($input['jumlah'])) {
            $data['jumlah'] = esc($input['jumlah']);
        }

        if (! empty($input['tanggal_simpanan'])) {
            $data['tanggal_simpanan'] = esc($input['tanggal_simpanan']);
        }

        if (! empty($input['status'])) {
            $data['status'] = esc($input['status']);
        }
        if (empty($data)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $this->model->update($id, $data);

        $response = [
            'status'  => 200,
            'error'   => false,
            'message' => 'Data berhasil di update.',
            'data'    => $data,
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
