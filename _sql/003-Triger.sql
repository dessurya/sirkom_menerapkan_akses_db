DELIMITER $$

CREATE TRIGGER afterInsertPenggunaan
    AFTER INSERT ON `penggunaan` FOR EACH ROW
  BEGIN
    INSERT INTO `tagihan` (`id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `jumlah_meter`, `status`) VALUES (
        NEW.id_penggunaan,
        NEW.id_pelanggan,
        NEW.bulan,
        NEW.tahun,
        NEW.meter_akhir-NEW.meter_awal,
        'ditagihkan'
    );
  END$$

  DELIMITER ;
