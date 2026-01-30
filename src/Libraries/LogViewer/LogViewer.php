<?php
namespace YourVendor\LogViewer\Libraries\LogViewer;

use YourVendor\LogViewer\Exceptions\LogViewerException;

class LogViewer
{
    protected string $path;
    protected array $allowlist;

    public function __construct()
    {
        $this->path = WRITEPATH . 'logs/';
        $this->allowlist = explode(',', env('LOGVIEWER_ALLOW_IPS', '127.0.0.1'));
    }

    public function authorize(string $ip): void
    {
        if (!in_array($ip, $this->allowlist, true)) {
            throw new LogViewerException('IP not allowed');
        }
    }

    public function files(): array
    {
        return array_map('basename', glob($this->path . '*.log') ?: []);
    }

    public function tail(string $file, int $lines = 200): array
    {
        $file = $this->path . basename($file);
        if (!is_file($file)) return [];

        $data = file($file, FILE_IGNORE_NEW_LINES);
        return array_slice($data, -$lines);
    }

    public function parse(array $lines): array
    {
        $out = [];
        foreach ($lines as $line) {
            $json = json_decode($line, true);
            $out[] = $json ?: ['level' => 'INFO', 'message' => $line];
        }
        return $out;
    }
}