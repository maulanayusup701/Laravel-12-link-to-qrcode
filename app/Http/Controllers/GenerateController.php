<?php

namespace App\Http\Controllers;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Response;

class GenerateController extends Controller
{
    public function link()
    {
        $link = 'https://contoh.com';

        // Buat QR code PNG
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($link)
            ->size(400)
            ->margin(10)
            ->build();

        $qrBinary = $result->getString();

        // Buka stream dari PNG binary
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $qrBinary);
        rewind($stream);

        // Gunakan GD driver
        $manager = new ImageManager(new GdDriver());

        // Buat image dari stream
        $qrImage = $manager->read($stream);

        // Path ke logo
        $logoPath = public_path('logo.png');

        // Cek file logo tersedia
        if (file_exists($logoPath)) {
            $logo = $manager->read($logoPath)->resize(80, 80);
            $qrImage->place($logo, 'center');
        }

        // Tampilkan QR image
        return Response::make($qrImage->toPng())
            ->header('Content-Type', 'image/png');
    }
}
