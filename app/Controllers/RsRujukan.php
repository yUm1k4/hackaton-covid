<?php

namespace App\Controllers;

use \App\Models\RsRujukanModel;

class RsRujukan extends BaseController
{
    public function __construct()
    {
        $this->rs_rujukan = new RsRujukanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'RS Rujukan - Covid 19'
        ];

        return view('rs_rujukan/index', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'tampildata'    => $this->rs_rujukan->findAll()
            ];

            $msg = [
                'data' => view('rs_rujukan/tblRsRujukan', $data)
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
                'data' => view('rs_rujukan/modalTambah')
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
                    'rules' => 'required|min_length[5]|max_length[50]|is_unique[rs_rujukan.nama]',
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
                $this->rs_rujukan->insert($simpandata);
                $msg = ['sukses' => 'RS Rujukan baru berhasil ditambahkan'];
            }
            echo json_encode($msg);
        } else {
            session()->setFlashdata('error', 'Maaf tidak dapat diproses');
            return redirect()->back();
        }
    }

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id_rs_rujukan = $this->request->getVar('id_rs_rujukan');
            $row = $this->rs_rujukan->find($id_rs_rujukan);
            // d($data);

            $data = [
                'id_rs_rujukan' => $row['id_rs_rujukan'],
                'nama' => $row['nama'],
                'hotline' => $row['hotline'],
                'alamat' => $row['alamat'],
            ];

            $msg = [
                'sukses' => view('rs_rujukan/modalEdit', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $id_rs_rujukan = $this->request->getVar('id_rs_rujukan');
            $row = $this->rs_rujukan->find($id_rs_rujukan);
            
            // validasi utk field yg unique
            if ($row['nama'] == $this->request->getVar('nama')) {
                $rule_nama_rs = 'required|min_length[5]|max_length[50]';
            } else {
                $rule_nama_rs = 'required|min_length[5]|max_length[50]|is_unique[rs_rujukan.nama]';
            }
            // Validasi
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama'  => [
                    'label' => 'Nama',
                    'rules' => $rule_nama_rs,
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong',
                        'min_Length' => '{field} terlalu singkat',
                        'max_Length' => '{field} terlalu panjang, maximal 50 karakter',
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
                $data = [
                    'id_rs_rujukan' =>  $id_rs_rujukan,
                    'nama' =>  ucfirst($this->request->getVar('nama')),
                    'hotline' =>  $this->request->getVar('hotline'),
                    'alaamt' =>  $this->request->getVar('nama'),
                ];
            
                $this->rs_rujukan->update($id_rs_rujukan, $data);
                $msg = ['sukses' => 'RS Rujukan berhasil diupdate'];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_rs_rujukan = $this->request->getVar('id_rs_rujukan');
            $this->rs_rujukan->delete($id_rs_rujukan);

            $msg = ['sukses' => "RS Rujukan berhasil dihapus"];
            echo json_encode($msg);
        } else {
            return redirect()->to(base_url(''));
        }
    }
}
