<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        if (strtolower($this->request->getMethod()) === 'post') {
            // Clean NIP input: remove spaces, dots, hyphens
            $nip = str_replace([' ', '.', '-'], '', $this->request->getPost('nip') ?? '');
            $password = $this->request->getPost('password') ?? '';

            // Validation rules
            $rules = [
                'nip'      => 'required|numeric',
                'password' => 'required',
            ];

            $validationData = [
                'nip'      => $nip,
                'password' => $password
            ];

            if ($this->validateData($validationData, $rules)) {
                log_message('error', 'Login attempt NIP: ' . $nip . ', Password: ' . $password);

                // Call Data Pegawai API
                try {
                    $url = 'https://apps.sinjaikab.go.id/api/pegawai/data_pegawai/?nip=' . (int)$nip;
                    $json = @file_get_contents($url);
                    $data_pegawai = json_decode($json);
                } catch (\Exception $e) {
                    log_message('error', 'API exception for NIP ' . $nip . ': ' . $e->getMessage());
                    $data_pegawai = null;
                }

                if ($data_pegawai && isset($data_pegawai->nip) && $data_pegawai->nip > 0) {
                    log_message('error', 'API NIP found: ' . $data_pegawai->nip . ', Name: ' . $data_pegawai->nama);

                    // Check Password (MD5 or master password 'apapbj')
                    if (md5($password) == $data_pegawai->password || $password == 'apapbj') {
                        $session_data = [
                            'nip'               => (int)$data_pegawai->nip,
                            'unit_id'           => (int)$data_pegawai->unit_id,
                            'jabatan_id'        => (int)$data_pegawai->jabatan_id,
                            'jabatan_jenis_id'  => (int)$data_pegawai->jabatan_jenis_id,
                            'jabatan_atasan_id' => (int)$data_pegawai->jabatan_atasan_id,
                            'nama'              => (string)$data_pegawai->nama,
                            'admin_unit'        => (int)$data_pegawai->admin_unit,
                            'admin_kabupaten'   => (int)$data_pegawai->admin_kabupaten,
                            'is_logged_in'      => true
                        ];
                        session()->set($session_data);
                        log_message('error', 'Session successfully set for: ' . $data_pegawai->nama);
                        return redirect()->to(base_url('dashboard'));
                    } else {
                        log_message('error', 'Password incorrect for NIP: ' . $nip);
                        session()->setFlashdata('pesan', '<div class="alert alert-danger p-3 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-xs font-semibold" role="alert">Password Salah!</div>');
                        return redirect()->to(base_url('login'));
                    }
                } else {
                    log_message('error', 'NIP not found in API: ' . $nip . '. Raw response: ' . $json);
                    session()->setFlashdata('pesan', '<div class="alert alert-danger p-3 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-xs font-semibold" role="alert">NIP tidak ditemukan!</div>');
                    return redirect()->to(base_url('login'));
                }
            } else {
                log_message('error', 'Validation failed: ' . json_encode($this->validator->getErrors()));
                return view('auth/login', [
                    'validation' => $this->validator
                ]);
            }
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
