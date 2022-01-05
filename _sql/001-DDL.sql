SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `level`;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `pembayaran`;
DROP TABLE IF EXISTS `pelanggan`;
DROP TABLE IF EXISTS `tarif`;
DROP TABLE IF EXISTS `penggunaan`;
DROP TABLE IF EXISTS `tagihan`;

CREATE TABLE `level`(
  `id_level` int(3) NOT NULL,
  `nama_level` varchar(250) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE `user`(
  `id_user` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nama_admin` varchar(250) NOT NULL,
  `id_level` int(3) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE `pembayaran`(
  `id_pembayaran` int(11) NOT NULL,
  `id_tagihan` int(11) NOT NULL,

  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pembayaran` DATE NOT NULL,
  `bulan_bayar` int(2) NOT NULL,
  `biaya_admin` DOUBLE NOT NULL,
  `total_bayar` DOUBLE NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE `pelanggan`(
  `id_pelanggan` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nomor_kwh` varchar(250) NOT NULL,
  `nama_pelanggan` varchar(250) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `id_tarif` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE `tarif`(
  `id_tarif` int(3) NOT NULL,
  `daya` varchar(250) NOT NULL,
  `tarifperkwh` DOUBLE NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE `penggunaan`(
  `id_penggunaan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `bulan` int(2) NOT NULL,`tahun` int(4) NOT NULL,
  `meter_awal` DOUBLE NOT NULL,
  `meter_akhir` DOUBLE NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE `tagihan`(
  `id_tagihan` int(11) NOT NULL,
  `id_penggunaan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `jumlah_meter` DOUBLE NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

ALTER TABLE  `level`  ADD  PRIMARY KEY (`id_level`);
ALTER TABLE  `level` MODIFY `id_level` int(3) NOT NULL AUTO_INCREMENT;
ALTER TABLE  `user`  ADD  PRIMARY KEY (`id_user`);
ALTER TABLE  `user`  ADD  UNIQUE (`username`);
ALTER TABLE  `user` MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE  `pembayaran`  ADD  PRIMARY KEY (`id_pembayaran`);
ALTER TABLE  `pembayaran` MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE  `pelanggan`  ADD  PRIMARY KEY (`id_pelanggan`);
ALTER TABLE  `pelanggan` MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE  `pelanggan`  ADD  UNIQUE (`username`);
ALTER TABLE  `pelanggan`  ADD  UNIQUE (`nomor_kwh`);
ALTER TABLE  `tarif`  ADD  PRIMARY KEY (`id_tarif`);
ALTER TABLE  `tarif` MODIFY `id_tarif` int(3) NOT NULL AUTO_INCREMENT;
ALTER TABLE  `penggunaan`  ADD  PRIMARY KEY (`id_penggunaan`);
ALTER TABLE  `penggunaan` MODIFY `id_penggunaan` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE  `tagihan`  ADD  PRIMARY KEY (`id_tagihan`);
ALTER TABLE  `tagihan` MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `user` ADD FOREIGN KEY (`id_level`) REFERENCES `level`(`id_level`);
ALTER TABLE `pembayaran` ADD FOREIGN KEY (`id_user`) 
    REFERENCES `user`(`id_user`);
ALTER TABLE `pembayaran` ADD FOREIGN KEY (`id_tagihan`)
    REFERENCES `tagihan`(`id_tagihan`);
ALTER TABLE `pembayaran` ADD FOREIGN KEY (`id_pelanggan`)
    REFERENCES `pelanggan`(`id_pelanggan`);
ALTER TABLE `pelanggan` ADD FOREIGN KEY (`id_tarif`)
    REFERENCES `tarif`(`id_tarif`);
ALTER TABLE `penggunaan` ADD FOREIGN KEY (`id_pelanggan`)
    REFERENCES `pelanggan`(`id_pelanggan`);
ALTER TABLE `tagihan` ADD FOREIGN KEY (`id_penggunaan`)
    REFERENCES `penggunaan`(`id_penggunaan`);

CREATE INDEX `idx_nomor_kwh` ON `pelanggan` (`nomor_kwh`);
CREATE INDEX `idx_daya` ON `tarif` (`daya`);

CREATE OR REPLACE VIEW v_user AS (
  SELECT
    `id_user`,
    `username`,
    `nama_admin`,
    `usr`.`id_level`,
    `nama_level`
  FROM `user` `usr`
  LEFT JOIN `level` `lvl` ON `lvl`.`id_level` = `usr`.`id_level`
);
CREATE OR REPLACE VIEW v_pelanggan AS (
  SELECT
    `id_pelanggan`,
    `username`,
    `nomor_kwh`,
    `nama_pelanggan`,
    `alamat`,
    `plg`.`id_tarif`,
    `daya`,
    `tarifperkwh`
  FROM `pelanggan` `plg`
  LEFT JOIN `tarif` `trf` ON `plg`.`id_tarif` = `trf`.`id_tarif`
);
CREATE OR REPLACE VIEW v_tagihan AS (
  SELECT
    `id_tagihan`,
    `tgh`.`id_pelanggan`,
    `nama_pelanggan`,
    `alamat`,
    `daya`,
    `tarifperkwh`,
    `tgh`.`id_penggunaan`,
    `pgn`.`bulan`,
    `pgn`.`tahun`,
    CONCAT(`pgn`.`tahun`, '-',`pgn`.`bulan`) AS `periode`,
    `meter_awal`,
    `meter_akhir`,
    `jumlah_meter`,
    `jumlah_meter`*`tarifperkwh` AS `biaya`,
    `status`
  FROM `tagihan` `tgh`
  LEFT JOIN `v_pelanggan` `plg` ON `tgh`.`id_pelanggan` = `plg`.`id_pelanggan`
  LEFT JOIN `penggunaan` `pgn` ON `tgh`.`id_penggunaan` = `pgn`.`id_penggunaan`
);
CREATE OR REPLACE VIEW v_pembayaran AS (
  SELECT
    `id_pembayaran`,
    `tanggal_pembayaran`,
    `periode`,
    `bulan_bayar`,
    `biaya_admin`,
    `total_bayar`,
    `biaya_admin`+`total_bayar` AS `biaya_keseluruhan`,
    `pby`.`id_tagihan`,
    `pby`.`id_pelanggan`,
    `nama_pelanggan`,
    `alamat`,
    `daya`,
    `tarifperkwh`,
    `id_penggunaan`,
    `bulan`,
    `tahun`,
    `meter_awal`,
    `meter_akhir`,
    `jumlah_meter`,
    `status`,
    `pby`.`id_user`,
    `username`,
    `nama_admin`,
    `id_level`,
    `nama_level`
  FROM `pembayaran` `pby`
  LEFT JOIN `v_tagihan` `tgh` ON `tgh`.`id_tagihan` = `pby`.`id_tagihan`
  LEFT JOIN `v_user` `usr` ON `usr`.`id_user` = `pby`.`id_user`
);
