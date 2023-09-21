
CREATE DATABASE ClothingStoreDB;
go
-- Sử dụng cơ sở dữ liệu mới tạo
USE ClothingStoreDB;
GO

--Tạo bảng "Category"
CREATE TABLE Category (
    category_id INT  IDENTITY(1,1) PRIMARY KEY,
    category_name NVARCHAR(50),
);
GO
-- Tạo bảng "Products"
CREATE TABLE Products (
    product_id INT  IDENTITY(1,1) PRIMARY KEY,
    name NVARCHAR(100),
    price INT,
    category_id INT REFERENCES Category (category_id),
    image_url NVARCHAR(200)
);
GO
--Tạo bảng 'size'
CREATE TABLE Size_Product (
    size_id INT  IDENTITY(1,1) PRIMARY KEY,
    product_id INT,
    size NVARCHAR(50),
	SoLuongTrongKho INT,
    FOREIGN KEY (product_id) REFERENCES Products (product_id)
);
GO

-- Tạo bảng "Customers"
CREATE TABLE Customers (
    customer_id INT  IDENTITY(1,1) PRIMARY KEY,
    customer_name NVARCHAR(100),
    email NVARCHAR(100),
    address NVARCHAR(200),
    phone NVARCHAR(20)
);
GO

-- Tạo bảng "Orders"
CREATE TABLE Orders (
    order_id INT  IDENTITY(1,1) PRIMARY KEY,
    customer_id INT,
    order_date DATE,
    total_amount INT,
    FOREIGN KEY (customer_id) REFERENCES Customers (customer_id)
);
GO

-- Tạo bảng "OrderItems"
CREATE TABLE OrderItems (
    order_item_id INT  IDENTITY(1,1) PRIMARY KEY,
    order_id INT,
    size_id INT,
    quantity INT,
    FOREIGN KEY (order_id) REFERENCES Orders (order_id),
    FOREIGN KEY (size_id) REFERENCES Size_Product (size_id)
);
GO
INSERT INTO category (category_name)
VALUES
    (N'áo thun nam'),
    (N'áo thun nữ'),
    (N'quần jeans nam'),
    (N'quần jeans nữ'),
    (N'quần tây nam'),
    (N'quần tây nữ'),
    (N'áo khoác nam'),
    (N'áo khoác nữ'),
    (N'quần short nam'),
    (N'quần short nữ'),
	(N'áo sơ mi nam'),
    (N'áo sơ mi nữ'),
    (N'áo len nam'),
    (N'áo len nữ'),
    (N'váy');
	
	INSERT INTO Products ( name, price, category_id, image_url)
VALUES
    (N'Quần jean nữ phong cách', 450000,  4, './img/0JE78.jpg'),
    (N'Áo thun nam trơn', 200000,  1, './img/Rectangle 34.png'),
    (N'Áo thun nữ họa tiết', 180000, 2, './img/Rectangle 35.png'),
    ( N'Áo thun Humanity MS 89E3878', 500000, 1, './img/0WH00.jpg'),
    ( N'QUẦN LỬNG ỐNG ĐỨNG PHỐI ĐAI',450000, 10, './img/quanshortnu.jpg'),
    ( N'Áo thun nam trơn', 200000, 1, './img/0XX99K.jpg'),
    ( N'Áo thun nữ họa tiết', 180000, 2, './img/Rectangle 35.jpg'),
	( N'Áo thun Humanity MS 57E3872',500000, 1, './img/0WH00.jpg'),
	(N'Quần jean nam phong cách', 450000,  3, './img/Rectangle 33.png'),
    (N'Quần jeans Nam', 200000,  1, './img/0JD00.jpg'),
    (N'Quần tây nam đen', 180000, 5, './img/1234.jpg'),
    ( N'Quần tây nữ', 500000, 6, './img/AP123.jpg'),
    ( N'Áo khoác nam',450000, 7, './img/AK123.jpg'),
    ( N'Quần short nam ', 200000, 9, './img/QS123.jpg'),
    ( N'Áo sơ mi nam xanh', 180000, 11, './img/SM123.jpg'),
	 ( N'Áo sơ mi nữ trắng', 180000, 15, './img/SMH45.jpg'),
	  ( N'Áo len nữ', 180000, 14, './img/AL123.jpg'),
	   ( N'Áo khoác nữ', 180000, 8, './img/JE078.jpg'),
	( N'Áo len nam',500000, 13, './img/N173.jpg');

	INSERT INTO Size_Product (product_id, size, SoLuongTrongKho)
VALUES
    (1, 'M', 50),
    (1, 'L', 30),
    (2, 'S', 40),
    (3, 'L', 25),
    (3, 'XL', 20),
    (4, 'M', 35),
    (4, 'XL', 50),
    (5, 'L', 30),
    (6, 'S', 40),
    (6, 'XXL', 100),
    (7, 'M', 67),
    (7, 'XXL', 100),
    (7, 'S', 67),
    (8, 'XXL', 100),
    (8, 'M', 67),
    (9, 'XXL', 100),
    (9, 'M', 12),
	(10, 'M', 50),
    (11, 'L', 30),
    (12, 'S', 40),
    (13, 'L', 25),
    (13, 'XL', 20),
    (14, 'M', 35),
    (14, 'XL', 50),
    (15, 'L', 30),
    (16, 'S', 40),
    (16, 'XXL', 100),
    (17, 'M', 67),
    (17, 'XXL', 100),
    (17, 'S', 67),
    (18, 'XXL', 100),
    (18, 'M', 67),
    (19, 'XXL', 100),
    (19, 'M', 12);


	INSERT INTO Customers (customer_name, email, address, phone)

VALUES ('John Doe', 'johndoe@example.com', '123 Main Street, City, Country', '1234567890'),
('John Doe', 'johndoe@example.com', '123 Main Street, City, Country', '1234567890');
	-- Chèn dữ liệu vào bảng "Orders" (giả sử có 2 đơn hàng)
INSERT INTO Orders (customer_id, order_date, total_amount)
VALUES
    (4, '2023-07-05', 120.00),
    (5, '2023-07-04', 38.00);

-- Chèn dữ liệu vào bảng "OrderItems" (giả sử có 3 sản phẩm trong 2 đơn hàng)
INSERT INTO OrderItems (order_id, size_id, quantity)
VALUES
    (7, 1, 2),
    (8, 3, 3),
    (8, 2, 1);

	CREATE TABLE Admin(
	account varchar(50),
	password varchar(50)
	);
