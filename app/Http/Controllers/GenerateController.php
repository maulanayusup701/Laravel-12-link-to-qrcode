<?php

namespace App\Http\Controllers;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class GenerateController extends Controller
{
    public function link()
    {
        return view('qrcode.index');
    }

    public function generateQR(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'link' => 'required|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'link.required' => 'URL tidak boleh kosong.',
            'link.url' => 'Format URL tidak valid.',
            'logo.image' => 'File logo harus berupa gambar.',
            'logo.mimes' => 'Logo hanya boleh jpeg, png, jpg.',
            'logo.max' => 'Ukuran maksimum logo adalah 2MB.',
        ]);

        $link = $validated['link'];

        // Generate QR code PNG dari link
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($link)
            ->size(400)
            ->margin(10)
            ->build();

        $qrBinary = $result->getString();

        // Buat stream dari QR PNG
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $qrBinary);
        rewind($stream);

        // Pakai GD driver
        $manager = new ImageManager(new GdDriver());
        $qrImage = $manager->read($stream);

        // Jika logo diupload, tempelkan
        if ($request->hasFile('logo')) {
            $logo = $manager->read($request->file('logo')->getPathname())->resize(80, 80);
            $qrImage->place($logo, 'center');
        }

        // Return sebagai image PNG
        return Response::make($qrImage->toPng())
            ->header('Content-Type', 'image/png');
    }
}
