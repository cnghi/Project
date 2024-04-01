create database CNWeb;
-- drop database cnweb;
use CNWeb;
create table nguoidung(
id int(10) Not null primary key auto_increment,
taikhoan varchar(16) not null,
matkhau varchar(32) not null,
hoten varchar(50) not null,
email varchar(50) not null,
sdt varchar(10) not null,
diachi varchar(255) not null,
user_type varchar(10) not null
);
create table giohang(
id int(10) Not null primary key auto_increment,
idnd int(10),
foreign key (idnd) references nguoidung(id)
);
create table danhmuc(
id char(10) not null primary key,
tenDM varchar(255) not null
);
create table sanpham(
id int(10) Not null primary key auto_increment,
tenSP varchar(255) not null,
img varchar(50) not null,
giatien int not null,
mota varchar(255) not null,
soluongSP int not null,
iddm char(10) not null,
foreign key (iddm) references danhmuc(id)
); 
create table sanphamTronggio(
idgh int(10) not null,
maSP int(10) not null,
soluong int not null,
foreign key (idgh) references giohang(id),
foreign key (maSP) references sanpham(id)
);

insert into nguoidung values(1,'Admin','Admin','Admin','admin@gmail.com','0353879719','Sóc Trăng','Admin');
insert into nguoidung values(2,'Toan2707','Toan2707','Võ Phúc Toàn','vophuctoan365@gmail.com','0353879719','Sóc Trăng','Admin');
insert into giohang values(1,2);

insert into danhmuc values('NT','Nến Thơm');
insert into danhmuc values('TT','Trang Trí');
insert into danhmuc values('DL','Đồ dùng bằng len');
insert into danhmuc values('OL','Ốp Lưng');
insert into danhmuc values('MH','Mô Hình');
insert into danhmuc values('VP','Văn Phòng Phẩm');
insert into danhmuc values('PK','Phụ Kiện');

insert into sanpham values(1,'Thú bông bằng len','image/animal2.jpg',300000,'Thú bông được làm bằng len',20,'DL');
insert into sanpham values(2,'Nến Thơm','image/candle.webp',250000,'Nến thơm tạo không gian thoải mái',30,'NT');
insert into sanpham values(3,'Hoa làm từ len','image/Hoalen.jpg',450000,'Hoa được làm từ len dùng trang trí nhà hoặc góc làm việc',40,'DL');
insert into sanpham values(4,'Kit làm apaca','image/kitApaca.webp',200000,'Bộ kit làm Alpaca bằng len',50,'DL');
insert into sanpham values(5,'Kẹp Tóc phụ kiện nữ','image/keptoc.jpg',30000,'Kẹp tóc phụ kiện cho nữ',10,'PK');
insert into sanpham values(6,'Kit làm gấu bằng len','image/kitlen.jpg',320000,'Bộ kit làm gấu len chuyên dụng',40,'DL');
insert into sanpham values(7,'Bộ kit làm nến thơm','image/kitnenthom.jpg',380000,'Bộ kit làm nến thơm cho người mới bắt đầu',20,'NT');
insert into sanpham values(8,'Tranh đá','image/RockPicture.jpg',300000,'Tranh được làm từ đá cuội nhiều màu',30,'TT');
insert into sanpham values(9,'Gấu bông màu hồng','image/teddy.jpg',390000,'Gấu bông handmade màu hồng cute',30,'DL');
insert into sanpham values(10,'Túi đeo chéo tự làm','image/tuideocheo.jpg',330000,'Túi đeo chéo tự làm dành cho các bạn nữ',30,'PK');
insert into sanpham values(11,'Tranh sơn dầu','image/tranhsondau.jpg',320000,'Tranh Sơn Dầu dành trang trí nhà',30,'TT');
insert into sanpham values(12,'Vòng tay dành cho nữ','image/vongtay.jpg',3000,'Vòng tay phụ kiện đơn giản dành cho nữ',30,'PK');


Delimiter $$
drop procedure if exists xuatSP $$
create procedure xuatSP(iddm char(10), batdau int,ketthuc int)
begin
SELECT * FROM sanpham where sanpham.iddm = iddm LIMIT batdau, ketthuc;
end;$$
call xuatSP('VP',0,9);
Delimiter $$
drop procedure if exists xuatAllSP $$
create procedure xuatAllSP(batdau int,ketthuc int)
begin
SELECT * FROM sanpham LIMIT batdau, ketthuc;
end;$$
