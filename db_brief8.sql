CREATE DATABASE brief8;

--@block
CREATE TABLE admins(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(250) NOT NULL,
    passw VARCHAR(250) NOT NULL

);
--@block
INSERT INTO admins ( username , email ,passw) VALUES
('admin1','admin1@email.com','admin1');

--@block
CREATE TABLE client (
    id INT NOT NULL AUTO_INCREMENT,
    full_name varchar(20),
    adresse varchar(30),
    city varchar(10),
    phonenumber varchar(15),
    username varchar(10),
    e_mail varchar(20),
    psw varchar(255),
    activ_account BOOLEAN DEFAULT 0,
    primary key(id)
);

--@block
CREATE TABLE category(
    id INT not NULL AUTO_INCREMENT,
    cat_name varchar(100),
    cat_descr varchar(255),
    img varchar(100),
    bl BOOLEAN,
    primary key(id)
);

--@block
INSERT INTO category(cat_name, cat_descr, img)
VALUES
    ('Carte de Développement', 'des cartes de développement, des cartes programmeurs, Arduino, etc...', 'carte_de_développement.jpg'),
    ('Composant Electronique', 'diodes, bouttons, LED, modules, shields, capteurs, condensateur, buzzers, etc...', 'composants_électroniques.jpg'),
    ('Energie', 'battries, convertisseurs, chargeurs, etc...', 'energy.jpg'),
    ('Moteurs', 'moteurs, régulateurs et controleurs de vitesse, roues, etc...', 'motors.jpg'),
    ('Robot & KIT', 'Raspberry Pi Robot Kit, 3D Printer Kit, Quadcopter Drone Kit, and more...', 'robot&kit.jpg'),
    ('Imprimante 3D ET Machine CNC', 'CNC Router Kit, Ultimaker 3D Printer Kit, 3D Printer, etc...', 'Imprimante_3D&CNC.jpg'),
    ('uncategorized',NULL,NULL);

--@block
CREATE TABLE product(
    ref INT not NULL primary key AUTO_INCREMENT ,
    prod_name varchar(100),
    bar_code INT(9),
    img varchar(100),
    sell_price float(2),
    final_price float(2),
    offer_price float(2),
    prod_desc varchar(255),
    min_quant INT,
    stock_quant INT,
    bl BOOLEAN DEFAULT 1,
    category_fk INT,
    foreign key(category_fk) references category(id)
);

--@block
-- Carte de Développement Category
INSERT INTO product (prod_name, bar_code, img, sell_price, final_price, offer_price, prod_desc, min_quant, stock_quant, category_fk)
VALUES
    ('Arduino Uno R3', 123456789, 'carte_de_développement.jpg', 25.99, 25.99, NULL, 'Microcontroller Development Board', 1, 50, 1),
    ('Raspberry Pi 4 Model B', 234567890, 'carte_de_développement.jpg', 49.99, 49.99, NULL, 'Single Board Computer', 1, 30, 1),
    ('ESP8266 NodeMCU', 345678901, 'carte_de_développement.jpg', 7.99, 7.99, NULL, 'IoT Development Board', 1, 100, 1),
    ('STM32 Discovery Kit', 456789012, 'carte_de_développement.jpg', 19.99, 19.99, NULL, 'ARM Cortex-M Development Board', 1, 20, 1),
    ('Teensy 4.0', 567890123, 'carte_de_développement.jpg', 15.99, 15.99, NULL, 'High-Performance Microcontroller', 1, 40, 1);

--@block
-- Composant Electronique Category
INSERT INTO product (prod_name, bar_code, img, sell_price, final_price, offer_price, prod_desc, min_quant, stock_quant, category_fk)
VALUES
    ('Resistor Kit', 123456790, 'composants_électroniques.jpg', 5.99, 5.99, NULL, 'Assorted Resistors', 1, 100, 2),
    ('Capacitor Assortment Set', 234567891, 'composants_électroniques.jpg', 8.99, 8.99, NULL, 'Various Capacitors', 1, 80, 2),
    ('LED Variety Pack', 345678902, 'composants_électroniques.jpg', 7.49, 7.49, NULL, 'Assorted LEDs', 1, 120, 2),
    ('Transistor Assortment', 456789013, 'composants_électroniques.jpg', 6.99, 6.99, NULL, 'Various Transistors', 1, 90, 2),
    ('Diode Kit', 567890124, 'composants_électroniques.jpg', 4.99, 4.99, NULL, 'Assorted Diodes', 1, 150, 2);

--@block
-- Energie Category
INSERT INTO product (prod_name, bar_code, img, sell_price, final_price, offer_price, prod_desc, min_quant, stock_quant, category_fk)
VALUES
    ('Solar Panel Charger', 123456791, 'energy.jpg', 29.99, 29.99, NULL, 'Portable Solar Charger', 1, 50, 3),
    ('Rechargeable Lithium-ion Battery Pack', 234567902, 'energy.jpg', 14.99, 14.99, NULL, 'Rechargeable Battery Pack', 1, 70, 3),
    ('Power Bank with Quick Charge', 345678913, 'energy.jpg', 19.99, 19.99, NULL, 'Fast Charging Power Bank', 1, 60, 3),
    ('AA and AAA Alkaline Batteries (Pack)', 456789024, 'energy.jpg', 8.99, 8.99, NULL, 'Assorted Alkaline Batteries', 1, 100, 3),
    ('USB Power Delivery Adapter', 567890135, 'energy.jpg', 12.99, 12.99, NULL, 'USB Power Delivery Adapter', 1, 80, 3);

--@block
-- Moteurs Category
INSERT INTO product (prod_name, bar_code, img, sell_price, final_price, offer_price, prod_desc, min_quant, stock_quant, category_fk)
VALUES
    ('DC Gear Motor with Encoder', 123456802, 'motors.jpg', 22.99, 22.99, NULL, 'High Torque DC Motor with Encoder', 1, 40, 4),
    ('Stepper Motor Kit', 234567913, 'motors.jpg', 18.99, 18.99, NULL, 'Complete Stepper Motor Kit', 1, 50, 4),
    ('Servo Motor (Continuous Rotation)', 345678924, 'motors.jpg', 15.99, 15.99, NULL, 'Continuous Rotation Servo Motor', 1, 60, 4),
    ('Brushless DC Motor', 456789035, 'motors.jpg', 28.99, 28.99, NULL, 'High-Speed Brushless DC Motor', 1, 30, 4),
    ('Vibration Motor Module', 567890146, 'motors.jpg', 6.99, 6.99, NULL, 'Vibration Motor with Module', 1, 70, 4);

--@block
-- Robot & KIT Category
INSERT INTO product (prod_name, bar_code, img, sell_price, final_price, offer_price, prod_desc, min_quant, stock_quant, category_fk)
VALUES
    ('Robot Car Kit with Arduino', 123456813, 'robot&kit.jpg', 45.99, 45.99, NULL, 'DIY Robot Car Kit with Arduino', 1, 30, 5),
    ('Hexapod Robot Kit', 234567924, 'robot&kit.jpg', 59.99, 59.99, NULL, 'Six-Legged Hexapod Robot Kit', 1, 20, 5),
    ('Robotic Arm Kit', 345678935, 'robot&kit.jpg', 34.99, 34.99, NULL, 'DIY Robotic Arm Kit', 1, 40, 5),
    ('AI Robot with Camera and Voice Recognition', 456789046, 'robot&kit.jpg', 89.99, 89.99, NULL, 'Smart AI Robot with Camera', 1, 15, 5),
    ('Humanoid Robot DIY Kit', 567890157, 'robot&kit.jpg', 75.99, 75.99, NULL, 'DIY Humanoid Robot Kit', 1, 25, 5);

--@block
-- Imprimante 3D ET Machine CNC Category
INSERT INTO product (prod_name, bar_code, img, sell_price, final_price, offer_price, prod_desc, min_quant, stock_quant, category_fk)
VALUES
    ('Creality Ender 3 - 3D Printer Kit', 123456824, 'Imprimante_3D&CNC.jpg', 199.99, 199.99, NULL, 'DIY 3D Printer Kit', 1, 10, 6),
    ('CNC Router Engraving Machine', 234567935, 'Imprimante_3D&CNC.jpg', 349.99, 349.99, NULL, 'Desktop CNC Engraving Machine', 1, 5, 6),
    ('Resin 3D Printer', 345678946, 'Imprimante_3D&CNC.jpg', 299.99, 299.99, NULL, 'High-Resolution Resin 3D Printer', 1, 8, 6),
    ('Laser Engraver Cutter', 456789057, 'Imprimante_3D&CNC.jpg', 179.99, 179.99, NULL, 'Desktop Laser Engraver and Cutter', 1, 12, 6),
     ('3D Printing Filament Variety Pack', 567890168, 'Imprimante_3D&CNC.jpg', 29.99, 29.99, NULL, 'Assorted 3D Printing Filaments', 1, 15, 6);

--@block
-- Uncategorized Category
INSERT INTO product (prod_name, bar_code, img, sell_price, final_price, offer_price, prod_desc, min_quant, stock_quant, category_fk)
VALUES
    ('Multimeter - Electronic Testing Tool', 123456835, 'testing.png', 19.99, 19.99, NULL, 'Digital Multimeter for Electronic Testing', 1, 25, 7),
    ('Soldering Iron Kit', 234567946, 'testing.png', 24.99, 24.99, NULL, 'Complete Soldering Iron Kit', 1, 20, 7),
    ('Breadboard and Jumper Wire Kit', 345678957, 'testing.png', 12.99, 12.99, NULL, 'Prototyping Breadboard with Wires', 1, 30, 7),
    ('Oscilloscope (entry-level)', 456789068, 'testing.png', 149.99, 149.99, NULL, 'Entry-Level Digital Oscilloscope', 1, 10, 7),
    ('Logic Analyzer', 567890179, 'testing.png', 89.99, 89.99, NULL, '8-Channel Logic Analyzer', 1, 15, 7);

--@block
CREATE TABLE orders(
    id INT PRIMARY KEY AUTO_INCREMENT,
    creation_date DATE,
    shipping_date DATE,
    delivery_date DATE,
    total_price DECIMAL(10, 2),
    bl BOOLEAN DEFAULT 0,
    client_id INT,
    FOREIGN KEY (client_id) REFERENCES client(id)
);

--@block
CREATE TABLE orderproduct(
    order_id INT,
    product_ref INT,
    quantity INT,
    PRIMARY KEY(order_id, product_ref),
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_ref) REFERENCES product(ref)
);