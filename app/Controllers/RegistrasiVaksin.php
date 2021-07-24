<?php

namespace App\Controllers;

use \App\Models\RegistrasiVaksinModel;
use Myth\Auth\Models\UserModel;

class RegistrasiVaksin extends BaseController
{
    public function __construct()
    {
        $this->reg_vaksin = new RegistrasiVaksinModel();
        $this->user = new UserModel();
    }

    public function getUser()
    {
        $request = service('request');
        $postData = $request->getVar();
        $response = array();

        if (!isset($postData['searchTerm'])) {
            // Fetch record
            $userlist = $this->user->select('id,username')
                ->orderBy('username')
                ->findAll();
        }
        $data = array();
        foreach ($userlist as $user) {
            $data[] = array(
                "id" => $user['id'],
                "text" => 'Username: ' . $user['username'],
            );
        }

        $response['data'] = 'testing';
        return $this->response->setJSON($response);
    }

    public function index()
    {
        $data = [
            'title' => 'Registrasi Vaksin - Covid 19'
        ];

        return view('reg_vaksin/index', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $users = $this->reg_vaksin->select('*, users.username, registrasi_vaksin.status, registrasi_vaksin.created_at as registrasi_dibuat')
                            ->join('users', 'users.id = registrasi_vaksin.user_id')
                            ->orderBy('registrasi_dibuat')
                            ->get();

            $data = [
                'tampildata'    => $users->getResultArray(),
            ];

            $msg = [
                'data' => view('reg_vaksin/tblRegistrasiVaksin', $data)
            ];

            echo json_encode($msg);
        } else {
            session()->setFlashdata('error', 'Maaf tidak dapat diproses');
            return redirect()->back();
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('reg_vaksin/modalTambah')
            ];

            echo json_encode($msg);
        } else {
            session()->setFlashdata('error', 'Maaf tidak dapat diproses');
            return redirect()->back();
        }
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            // Validasi
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama'  => [
                    'label' => 'Nama',
                    'rules' => 'required|min_length[5]|max_length[50]|is_unique[reg_vaksin.nama]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong',
                        'min_length' => '{field} minimal 5 karakter',
                        'max_length' => '{field} maximal 50 karakter',
                        'is_unique' => '{field} sudah terdaftar',
                    ]
                ],
                'hotline'  => [
                    'label' => 'Hotline',
                    'rules' => 'required|min_length[10]|max_length[13]|numeric',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong',
                        'min_length' => '{field} minimal 10 karakter',
                        'max_length' => '{field} maximal 13 karakter',
                        'numeric' => '{field} hanya boleh angka',
                    
                    ]
                ],
                'alamat'  => [
                    'label' => 'Alamat',
                    'rules' => 'required|min_length[10]|max_length[200]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong',
                        'min_length' => '{field} minimal 10 karakter',
                        'max_length' => '{field} maximal 200 karakter'
                    ]
                ],
            ]);

            // jika tidak valid (Ada yg salah)
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama'  => $validation->getError('nama'),
                        'hotline'  => $validation->getError('hotline'),
                        'alamat'  => $validation->getError('alamat')
                    ]
                ];
            } else {
                // jika validasi sukses (benar)
                $simpandata = [
                    'nama' =>  $this->request->getVar('nama'),
                    'hotline' =>  $this->request->getVar('hotline'),
                    'alamat' =>  $this->request->getVar('alamat')
                ];
                $this->reg_vaksin->insert($simpandata);
                $msg = ['sukses' => 'Registrasi Vaksin baru berhasil ditambahkan'];
            }
            echo json_encode($msg);
        } else {
            session()->setFlashdata('error', 'Maaf tidak dapat diproses');
            return redirect()->back();
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_reg_vaksin = $this->request->getVar('id_reg_vaksin');
            $this->reg_vaksin->delete($id_reg_vaksin);

            $msg = ['sukses' => "User Registrasi Vaksin berhasil dihapus"];
            echo json_encode($msg);
        } else {
            return redirect()->to(base_url(''));
        }
    }
}
