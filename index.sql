CREATE TRIGGER `after_insert_laporan` AFTER INSERT ON `laporan` FOR EACH ROW INSERT INTO logs VALUES (CONCAT("INSERT laporan #", NEW.id), NOW()) 

CREATE FUNCTION `jumlahLaporanDi`(`bulan` INT(11), `tahun` INT(11)) RETURNS VARCHAR(100) 
BEGIN DECLARE jumlah INT; 

IF(bulan > 0 AND bulan < 13) 
    THEN 
    IF(bulan < 10) 
        THEN 
        SELECT count(id) INTO jumlah FROM laporan WHERE laporan.created_at BETWEEN CONCAT(tahun, "-0", bulan, "-01") AND LAST_DAY(CONCAT(tahun, "-0", bulan, "-01")) AND laporan.deleted_at IS NULL; 
    ELSE 
        SELECT count(id) INTO jumlah FROM laporan WHERE laporan.created_at BETWEEN CONCAT(tahun, "-", bulan, "-01") AND LAST_DAY(CONCAT(tahun, "-", bulan, "-01")) AND laporan.deleted_at IS NULL; 
    END IF; 
    RETURN CONCAT(jumlah); 
    ELSE 
        RETURN "Invalid month"; 
END IF; 
END;