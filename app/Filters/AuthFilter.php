<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // If user is not logged in, redirect to login page
        log_message('error', 'AuthFilter checking: is_logged_in=' . (session()->get('is_logged_in') ? 'true' : 'false') . ', session data: ' . json_encode(session()->get()));
        if (!session()->get('is_logged_in')) {
            return redirect()->to(base_url('login'))->with('pesan', '<div class="alert alert-warning p-3 bg-amber-50 border border-amber-200 text-amber-800 rounded-xl text-xs font-semibold" role="alert">Silakan login terlebih dahulu!</div>');
        }

        // Restrict Kontrak and Penilaian controllers to NIP 198202272005021004 only
        $router = service('router');
        $controller = ltrim($router->controllerName(), '\\');

        if ($controller === 'App\Controllers\Kontrak' || $controller === 'App\Controllers\Penilaian') {
            $nip = session()->get('nip');
            if ((string)$nip !== '198202272005021004') {
                return redirect()->to(base_url('dashboard'))->with('error', 'Anda tidak memiliki hak akses untuk membuka halaman Kontrak atau Penilaian!');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
