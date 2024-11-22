<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BahanBaku;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Testing\Fakes\MailFake;
use Nette\Utils\Random;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\Province;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('kategori_produk')->truncate();
        DB::table('ukuran')->truncate();
        DB::table('rfq_status')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        DB::table('kategori_produk')->insert([
            ['nama' => 'Kursi', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Meja', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Almari', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('ukuran')->insert([
            ['nama' => '15x2x2', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => '30x5x6', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => '50x8x10', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('rfq_status')->insert([
            ['id' => 'RFQ', 'nama' => 'Request For Quotation', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'PO', 'nama' => 'Purchase Order', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('vendor')->insert([
            [
                'nama' => 'PT Prisma Kayu',
                'jalan' => 'Jl Pemuda No 101',
                'kota' => City::where('name', 'like', '%' . 'surabaya' . '%')->first()->code,
                'provinsi' => Province::where('name', 'like', '%' . 'jawa timur' . '%')->first()->code,
                'nomor_telepon' => '192891249898',
                'kontak_penghubung' => '192891249898',
                'nomor_telepon_mobile' => '628327382',
                'email' => 'prismakayu@gmail.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Cv Bangun Membangun',
                'jalan' => 'Jl Gatot Subroto',
                'kota' => City::where('name', 'like', '%' . 'blitar' . '%')->first()->code,
                'provinsi' => Province::where('name', 'like', '%' . 'jawa timur' . '%')->first()->code,
                'nomor_telepon' => '192891249898',
                'nomor_telepon_mobile' => '628327382',
                'kontak_penghubung' => '192891249898',
                'email' => 'prismakayu@gmail.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'PT Kaca Cemerlang',
                'jalan' => 'Jl Merdeka No 8',
                'kota' => City::where('name', 'like', '%' . 'batu' . '%')->first()->code,
                'provinsi' => Province::where('name', 'like', '%' . 'jawa timur' . '%')->first()->code,
                'kontak_penghubung' => '192891249898',
                'nomor_telepon' => '192891249898',
                'nomor_telepon_mobile' => '628327382',
                'email' => 'prismakayu@gmail.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Jaya Kreatif',
                'jalan' => 'Jl Sultan Agung No 45,',
                'kota' => City::where('name', 'like', '%' . 'malang' . '%')->first()->code,
                'provinsi' => Province::where('name', 'like', '%' . 'jawa timur' . '%')->first()->code,
                'nomor_telepon' => '192891249898',
                'kontak_penghubung' => '192891249898',
                'nomor_telepon_mobile' => '628327382',
                'email' => 'prismakayu@gmail.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'PT Kulit dan Serat Mandiri',
                'jalan' => 'Jl Diponegoro NO 19',
                'kota' => City::where('name', 'like', '%' . 'jember' . '%')->first()->code,
                'provinsi' => Province::where('name', 'like', '%' . 'jawa timur' . '%')->first()->code,
                'kontak_penghubung' => '192891249898',
                'nomor_telepon' => '192891249898',
                'nomor_telepon_mobile' => '628327382',
                'email' => 'prismakayu@gmail.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        $kategoriKursi = DB::table('kategori_produk')->where('nama', 'Kursi')->first()->id;
        $kategoriMeja = DB::table('kategori_produk')->where('nama', 'Meja')->first()->id;
        $kategoriAlmari = DB::table('kategori_produk')->where('nama', 'Almari')->first()->id;

        $ukuran15x2x2 = DB::table('ukuran')->where('nama', '15x2x2')->first()->id;
        $ukuran30x5x6 = DB::table('ukuran')->where('nama', '30x5x6')->first()->id;
        $ukuran50x8x10 = DB::table('ukuran')->where('nama', '50x8x10')->first()->id;


        Produk::create([
            'nama' => 'Kursi Mewah',
            'id_kategori' => $kategoriKursi,
            'id_ukuran' => $ukuran15x2x2,
            'model' => 'Kursi Model A',
            'garansi' => 12,
            'referensi_internal' => 'KUR-001',
            'barcode' => '1234567890123',
            'gambar' => 'kursi_mewah.jpg',
            'deskripsi' => 'Kursi dengan desain mewah dan nyaman.',
            'pajak' => 10,
            'harga_jual' => 1000000,
            'biaya_produk' => 600000,
        ]);

        Produk::create([
            'nama' => 'Meja Makan',
            'id_kategori' => $kategoriMeja,
            'id_ukuran' => $ukuran30x5x6,
            'model' => 'Meja Makan Model B',
            'garansi' => 12,
            'referensi_internal' => 'MEJA-001',
            'barcode' => '2234567890123',
            'gambar' => 'meja_makan.jpg',
            'deskripsi' => 'Meja makan dengan ukuran besar dan kokoh.',
            'pajak' => 10,
            'harga_jual' => 1500000,
            'biaya_produk' => 900000,
        ]);

        Produk::create([
            'nama' => 'Almari Pakaian',
            'id_kategori' => $kategoriAlmari,
            'id_ukuran' => $ukuran50x8x10,
            'model' => 'Almari Model C',
            'garansi' => 12,
            'referensi_internal' => 'ALM-001',
            'barcode' => '3234567890123',
            'gambar' => 'almari_pakaian.jpg',
            'deskripsi' => 'Almari pakaian besar dan sangat fungsional.',
            'pajak' => 10,
            'harga_jual' => 2000000,
            'biaya_produk' => 1200000,
        ]);

        BahanBaku::create([
            'nama' => 'Kayu Jati',
            'id_kategori' => $kategoriKursi,
            'id_ukuran' => $ukuran15x2x2,
            'model' => 'Kayu Jati Model A',
            'referensi_internal' => 'KYJ-001',
            'barcode' => '1234567890987',
            'gambar' => 'kayu_jati.jpg',
            'deskripsi' => 'Bahan baku kayu jati untuk pembuatan kursi.',
            'pajak' => 5,
            'harga_beli' => 500000,
        ]);

        BahanBaku::create([
            'nama' => 'Plywood',
            'id_kategori' => $kategoriMeja,
            'id_ukuran' => $ukuran30x5x6,
            'model' => 'Plywood Model B',
            'referensi_internal' => 'PLY-001',
            'barcode' => '2234567890987',
            'gambar' => 'plywood.jpg',
            'deskripsi' => 'Bahan baku plywood untuk pembuatan meja.',
            'pajak' => 5,
            'harga_beli' => 400000,
        ]);

        BahanBaku::create([
            'nama' => 'Kaca Tempered',
            'id_kategori' => $kategoriAlmari,
            'id_ukuran' => $ukuran50x8x10,
            'model' => 'Kaca Tempered Model C',
            'referensi_internal' => 'KAC-001',
            'barcode' => '3234567890987',
            'gambar' => 'kaca_tempered.jpg',
            'deskripsi' => 'Kaca tempered berkualitas tinggi untuk pembuatan almari.',
            'pajak' => 5,
            'harga_beli' => 800000,
        ]);
    }
}
