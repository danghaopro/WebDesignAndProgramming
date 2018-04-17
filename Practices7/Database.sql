CREATE TABLE IF NOT EXISTS sanpham (
    idsp VARCHAR(6) PRIMARY KEY NOT NULL,
    tensanpham VARCHAR(50) NOT NULL,
    dongia DOUBLE NOT NULL
);

CREATE TABLE IF NOT EXISTS khachhang (
    idkh VARCHAR(6) PRIMARY KEY NOT NULL,
    tenkh VARCHAR(50) NOT NULL,
    dienthoai VARCHAR(12) NOT NULL,
    diachi VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS nhanvien (
    idnv VARCHAR(6) PRIMARY KEY NOT NULL,
    password VARCHAR(10) NOT NULL,
    tennv VARCHAR(50) NOT NULL,
    dienthoai VARCHAR(12) NOT NULL,
    diachi VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS hoadon (
    idhd VARCHAR(6) PRIMARY KEY NOT NULL,
    ngaylaphd VARCHAR(30) NOT NULL,
    idkh VARCHAR(6) NOT NULL,
    idnv VARCHAR(6) NOT NULL,
    ngaygiaohang VARCHAR(30) NOT NULL,
    tongtien DOUBLE NOT NULL
);

ALTER TABLE hoadon
    ADD CONSTRAINT fk_hd_kh
    FOREIGN KEY (idkh)
    REFERENCES khachhang (idkh)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE hoadon
    ADD CONSTRAINT fk_hd_nv
    FOREIGN KEY (idnv)
    REFERENCES nhanvien (idnv)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

INSERT INTO sanpham (idsp, tensanpham, dongia) VALUES
    ('SP0001', 'Bánh gạo one one', 26000),
    ('SP0002', 'Bánh tràng an vị sau rieng', 34000),
    ('SP0003', 'Ca phe hoa tan loai 1', 97000),
    ('SP0004', 'Ca phe hoa tan loai 2', 76000);

INSERT INTO khachhang (idkh, tenkh, dienthoai, diachi) VALUES
    ('KH0001', 'Hoang Kim Oanh', '0912123456', 'Minh Khai - Hà Nội'),
    ('KH0002', 'Hoàng Hải Yến', '0912121234', 'Hoàng Mai - Hà Nội');

INSERT INTO nhanvien (idnv, password, tennv, dienthoai, diachi) VALUES
    ('NV0001', '123', 'Nguyễn Thu Trang', '0195220206', 'Cầu Giấy - Hà Nội'),
    ('NV0002', '123', 'Phạm Thanh Loan', '0904343456', 'Đỗng Đa - Hà Nội');


INSERT INTO hoadon (idhd, ngaylaphd, idkh, idnv, ngaygiaohang, tongtien) VALUES
    ('HD0001', '2016-03-01', 'KH0001', 'NV0002', '2016-03-03', 0),
    ('HD0002', '2016-03-01', 'KH0002', 'NV0002', '2016-03-04', 0);
