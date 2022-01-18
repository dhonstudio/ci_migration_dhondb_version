###################
Tentang DhonDB
###################

DhonDB adalah library yang dibangun oleh Dhon Studio (`dhonstudio.com <https://dhonstudio.com>`_) untuk memudahkan dalam melakukan migrasi database dari framework CI 3.

*******************
Informasi Penggunaan
*******************

1. Pastikan Setting database.php sudah benar/terhubung.
2. Buat file migrasi dalam folder migrations diawali format timestamp (tahun bulan tanggal jam menit detik) kemudian beri penghubung '_' dan lanjutkan dengan nama database/lainnya.
3. Pastikan di dalam file pada angka 2 memiliki nama class 'Migration_' diikuti nama terakhir pada file (pada contoh dalam repositori ini adalah users).
4. Buat komposisi tabel pada function 'up' sesuai dengan angka 5 sampai dengan angka 12.
5. Tulis nama tabel pada $this->migration->dhondb->table = ''.
6. Buat nama field menggunakan $this->migration->dhondb->field('nama_field', 'tipe_data');
7. Untuk menambahkan constraint (panjang maksimal) berikan ->constraint('ukuran') sebelum ->field().
8. Untuk menambahkan auto-increment, berikan ->ai() sebelum ->field().
9. Untuk menambahkan unique, berikan ->unique() sebelum ->field().
10. Untuk menambahkan nullable, berikan 'nullable' pada ->field('nama_field', 'tipe_data', 'nullable').
11. Untuk menambahkan primary_key, gunakan $this->migration->dhondb->add_key('nama_field').
12. Gunakan $this->migration->dhondb->create_table() pada akhir fungsi. 