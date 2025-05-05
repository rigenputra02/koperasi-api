<?php
namespace App\Controllers;

use App\Models\Pinjaman;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class PinjamanController extends ResourceController
{
    protected $modelName = 'App\Models\Pinjaman';
    protected $format    = 'json';
    protected $model;
    public function __construct()
    {
        $model = new Pinjaman();
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = $this->model->orderBy('id_pinjaman', 'desc')->findAll();
        $ref  = [
            'status'        => 200,
            'message'       => 'success',
            'totalData'     => count($data),
            'data_pinjaman' => $data,
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
            $fieldType = 'id_pinjaman' || 'id_user';
        } else {
            $userData  = $this->model->where('status', $param)->first();
            $fieldType = 'status';
        }

        if ($userData === null) {
            return $this->failNotFound("Data dengan filedType '$param' tidak ditemukan.");
        }

        $data = [
            'message'   => 'success',
            'data_user' => $userData,
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
            'id_user'     => 'required',
            'status'      => 'required',
            'tanggal_pengajuan' => 'required',
            'tenor'        => 'required',
            'jumlah_pinjaman' => 'required',
            'status'      => 'required',
            'bunga'        => 'required',
        ];

        if (! $this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $this->model->insert(
            [
                'id_user' => esc($this->request->getVar('id_user')),
                'status' => esc($this->request->getVar('status')),
                'tanggal_pengajuan' => esc($this->request->getVar('tanggal_pengajuan')),
                'tenor' => esc($this->request->getVar('tenor')),
                'jumlah_pinjaman' => esc($this->request->getVar('jumlah_pinjaman')),
                'bunga' => esc($this->request->getVar('bunga')),
            ]
        );
        $response = [
            'status' => 200,
            'message' => 'Data berhasil disimpan.',
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

        if (! empty($input['id_user'])) {
            $data['id_user'] = esc($input['id_user']);
        }
        if (! empty($input['status'])) {
            $data['status'] = esc($input['status']);
        }
        if (! empty($input['tanggal_pengajuan'])) {
            $data['tanggal_pengajuan'] = esc($input['tanggal_pengajuan']);
        }
        if (! empty($input['tenor'])) {
            $data['tenor'] = esc($input['tenor']);
        }
        if (! empty($input['jumlah_pinjaman'])) {
            $data['jumlah_pinjaman'] = esc($input['jumlah_pinjaman']);
        }
        if (! empty($input['bunga'])) {
            $data['bunga'] = esc($input['bunga']);
        }

        if (empty($data)) {
            return $this->fail('Tidak ada data yang diubah', 400);
        }

        $this->model->update($id, $data);
        $response = [
            'status' => 200,
            'error' => false,
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
