<?php
// static klasöründeki tüm medya dosyalarını listeleyen PHP dosyası
$mediaFolder = 'static';
$mediaFiles = [];

// static klasöründe bulunan tüm dosyaları oku
foreach (scandir($mediaFolder) as $file) {
    // Resim ve video dosyalarına göre filtrele
    if (preg_match('/\.(jpg|jpeg|png|mp4)$/i', $file)) {
        $type = preg_match('/\.(mp4)$/i', $file) ? 'video' : 'image';
        $mediaFiles[] = ['type' => $type, 'src' => "$mediaFolder/$file"];
    }
}

// JSON olarak medya listesini döndür
header('Content-Type: application/json');
echo json_encode($mediaFiles);
