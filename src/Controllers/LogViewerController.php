<?php
namespace YourVendor\LogViewer\Controllers;

use CodeIgniter\Controller;
use YourVendor\LogViewer\Libraries\LogViewer\LogViewer;

class LogViewerController extends Controller
{
    public function index()
    {
        $viewer = new LogViewer();
        $viewer->authorize($this->request->getIPAddress());

        $file = $this->request->getGet('file');
        $files = $viewer->files();
        $logs  = $file ? $viewer->parse($viewer->tail($file)) : [];

        return view('YourVendor\\LogViewer\\Views\\log_viewer\\index', compact('files','logs','file'));
    }

    public function export()
    {
        $viewer = new LogViewer();
        $viewer->authorize($this->request->getIPAddress());

        $file = $this->request->getGet('file');
        return $this->response->setJSON(
            $viewer->parse($viewer->tail($file, 500))
        );
    }
}