-- asdqwe123 -- password

TRUNCATE TABLE `level`;
TRUNCATE TABLE `user`;
TRUNCATE TABLE `tarif`;
TRUNCATE TABLE `pelanggan`;
TRUNCATE TABLE `penggunaan`;
TRUNCATE TABLE `tagihan`;
TRUNCATE TABLE `pembayaran`;

INSERT INTO `level` (`nama_level`) VALUES ('kasir'), ('manajer'), ('administrator');
INSERT INTO `user` (`username`, `password`, `nama_admin`, `id_level`) VALUES 
    ('kasir01', 'YXNkcXdlMTIz', 'user kasir 1', 1),
    ('kasir02', 'YXNkcXdlMTIz', 'user kasir 2', 1),
    ('kasir03', 'YXNkcXdlMTIz', 'user kasir 3', 1),
    ('man1', 'YXNkcXdlMTIz', 'user manajer 1', 2),
    ('man2', 'YXNkcXdlMTIz', 'user manajer 2', 2),
    ('admin', 'YXNkcXdlMTIz', 'administrator', 3);
INSERT INTO `tarif` (`daya`,`tarifperkwh`) VALUES 
    ('900Kwh', 800),
    ('1200Kwh', 1080),
    ('1800Kwh', 1360),
    ('2300Kwh', 1560),
    ('2900Kwh', 1960),
    ('5500Kwh', 2860),
    ('8500Kwh', 6760);
INSERT INTO `pelanggan` ( `username`, `password`, `nomor_kwh`, `nama_pelanggan`, `alamat`, `id_tarif` ) VALUES 
    ('plg001','YXNkcXdlMTIz','0012.0021.001','pelanggan 001','komp.sakti no 001',2),
    ('plg002','YXNkcXdlMTIz','0022.0021.002','pelanggan 002','komp.sakti no 002',2),
    ('plg003','YXNkcXdlMTIz','0032.0021.003','pelanggan 003','komp.sakti no 003',3),
    ('plg004','YXNkcXdlMTIz','0042.0021.004','pelanggan 004','komp.sakti no 004',4),
    ('plg005','YXNkcXdlMTIz','0052.0021.005','pelanggan 005','komp.sakti no 005',4),
    ('plg006','YXNkcXdlMTIz','0062.0021.006','pelanggan 006','komp.sakti no 006',1),
    ('plg007','YXNkcXdlMTIz','0072.0021.007','pelanggan 007','komp.sakti no 007',1),
    ('plg008','YXNkcXdlMTIz','0082.0021.008','pelanggan 008','komp.sakti no 008',1);
INSERT INTO `penggunaan` (`id_pelanggan`, `bulan`, `tahun`, `meter_awal`, `meter_akhir`) VALUES 
    (1, 10, 2021, 100, 121),
    (1, 11, 2021, 121, 148),
    (1, 12, 2021, 148, 197),
    (1, 1, 2022, 197, 222),
    (2, 10, 2021, 100, 118),
    (2, 11, 2021, 118, 136),
    (2, 12, 2021, 136, 152),
    (2, 1, 2022, 152, 188),
    (3, 10, 2021, 100, 145),
    (3, 11, 2021, 145, 198),
    (3, 12, 2021, 198, 249),
    (3, 1, 2022, 249, 301),
    (4, 10, 2021, 100, 180),
    (4, 11, 2021, 180, 273),
    (4, 12, 2021, 273, 344),
    (4, 1, 2022, 344, 391),
    (5, 10, 2021, 100, 202),
    (5, 11, 2021, 202, 318),
    (5, 12, 2021, 318, 422),
    (5, 1, 2022, 422, 520);
INSERT INTO `tagihan` (`id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `jumlah_meter`, `status`) VALUES
    (1, 1, 10, 2021, 21, 'lunas'),
    (2, 1, 11, 2021, 26, 'lunas'),
    (3, 1, 12, 2021, 49, 'lunas'),
    (4, 1, 1, 2022, 25, 'ditagihkan'),
    (5, 2, 10, 2021, 18, 'lunas'),
    (6, 2, 11, 2021, 18, 'lunas'),
    (7, 2, 12, 2021, 16, 'lunas'),
    (8, 2, 1, 2022, 36, 'ditagihkan'),
    (9, 3, 10, 2021, 45, 'lunas'),
    (10, 3, 11, 2021, 53, 'lunas'),
    (11, 3, 12, 2021, 51, 'lunas'),
    (12, 3, 1, 2022, 52, 'ditagihkan'),
    (13, 4, 10, 2021, 80, 'lunas'),
    (14, 4, 11, 2021, 93, 'lunas'),
    (15, 4, 12, 2021, 71, 'lunas'),
    (16, 4, 1, 2022, 47, 'ditagihkan'),
    (17, 5, 10, 2021, 102, 'lunas'),
    (18, 5, 11, 2021, 116, 'lunas'),
    (19, 5, 12, 2021, 104, 'lunas'),
    (20, 5, 1, 2022, 98, 'ditagihkan');
INSERT INTO `pembayaran` (`id_tagihan`, `id_pelanggan`, `tanggal_pembayaran`, `bulan_bayar`, `biaya_admin`, `total_bayar`, `id_user`) VALUES
    (1, 1, '2021-10-28', 10, 2500, 22680, 1),
    (2, 1, '2021-11-27', 11, 2500, 28080, 1),
    (3, 1, '2021-12-28', 12, 2500, 52920, 2),
    (5, 2, '2021-10-27', 10, 2500, 19440, 2),
    (6, 2, '2021-11-27', 11, 2500, 19440, 1),
    (7, 2, '2021-12-28', 12, 2500, 17280, 3),
    (9, 3, '2021-10-29', 10, 2500, 61200, 3),
    (10, 3, '2021-11-29', 11, 2500, 72060, 2),
    (11, 3, '2021-12-26', 12, 2500, 69360, 2),
    (13, 4, '2021-10-27', 10, 2500, 124800, 1),
    (14, 4, '2021-11-27', 11, 2500, 145080, 3),
    (15, 4, '2021-12-26', 12, 2500, 110760, 3),
    (17, 5, '2021-10-28', 10, 2500, 159120, 1),
    (18, 5, '2021-11-29', 11, 2500, 180960, 3),
    (19, 5, '2021-12-29', 12, 2500, 162240, 1);