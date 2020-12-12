# LINE To-do Bot
Bot ini dibuat dengan bahasa PHP. Anda harus memiliki [Composer](https://getcomposer.org) untuk menginstallnya.

# Persyaratan
1. PHP 7.x serta beberapa extension
2. [Composer](https://getcomposer.org)
3. MySQL 5.7.x

# Cara Instalasi
## Menjalankannya di Heroku
1. Clone repository ini
2. Buat sebuah MySQL di dalam atau luar Heroku. Apabila Anda membuatnya di luar jangan lupa untuk memberikan akses pada semua IP dengan wildcard %.
3. Import file tugas.sql ke dalam database
4. [Atur Config Vars](https://devcenter.heroku.com/articles/config-vars) di Heroku. Penamaan key mengikuti [.env.example](.env.example).
5. Push/deploy project ini ke Heroku
6. Atur webhook di LINE Developers Console.

## Menjalankannya selain di Heroku
1. Clone repository ini
2. Buat sebuah database MySQL dengan nama apapun.
3. Import file tugas.sql yang ada dalam folder database
4. Apabila sudah, kembali ke terminal Anda. Masukkan perintah

> composer install

5. Copy atau rename file [.env.example](.env.example) menjadi .env. Atur value setiap key di dalamnya.
6. Apabila sudah selesai tanpa error, seharusnya Anda tinggal mengatur webhook di LINE Developers Console.

# Ucapan Terima Kasih
Saya sangat berterima kasih kepada LINE Indonesia dan juga Dicoding Indonesia yang telah memberikan beasiswa secara gratis dalam program [LINE Developer Academy](https://line.dicoding.com/).

# Lisensi
Projek ini dilisensikan dengan [GNU General Public License v3.0](LICENSE) dan tersedia secara gratis.