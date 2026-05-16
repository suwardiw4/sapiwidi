cara bikin tabel baru

1. create migrations dulu
   php artisan make:migration create_flights_table
2. ke database, cari migration itu
3. update atau mulai masukin kolom kolom
4. php artisan migrate

cara bikin model baru
php artisan make:model Flight
harus singular.

Bedanya db dan model
db itu dapur
model itu pelayan
dua duanya sama sama bahasa sql dibikin jadi bahasa php oleh laravl
db diapke jarang, karena dia create create saja, (Membangun) dan ngubah BENTUK database
sedahkan model saat aplikasi sudah jalan, the SELECT \* from blabla in sql, (Operasi Data: Membaca, menambah, mengupdate, atau menghapus data sapi.)

cara bikin controllers baru
