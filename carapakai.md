1. npm install
2. composer instal

3. cp .env.example .env
4. php artisan key:generate

5. php artisan migrate:fresh --seed

6. composer require alexpechkarev/google-maps

7. Tambahkan API key pada file .env
GOOGLE_MAPS_API_KEY=AIzaSyAAU78BLbTw6TC62KNSzix8YgJrg38kalY

8. lalu tambahkan di config/services.php
'google_maps' => [
    'key' => env('GOOGLE_MAPS_API_KEY'),
],

9. siap pakai