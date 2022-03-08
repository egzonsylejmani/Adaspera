DROP DATABASE `adaspera`;
CREATE DATABASE `adaspera`;
USE `adaspera`;

CREATE TABLE `cart` (
  `user_id` varchar(255) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `size` varchar(255) NOT NULL
);


CREATE TABLE `products` (
  `product_id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `sizes_available` varchar(255) DEFAULT NULL,
  `time_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);

INSERT INTO `products` (`product_id`, `name`,`price`,`category`,`image`,`admin_id`, `color`, `sizes_available`,`time_created` ) VALUES 

("1","Organic Cotton Jeans",45.00,"Men","https://adaspera.blob.core.windows.net/images/id1.jpeg",1,"Blue Black","XXS,XXL,M,S",DEFAULT),
("2","Stretch jeans containing organic cotton",45.00,"Men","https://adaspera.blob.core.windows.net/images/id2.jpeg",1,"Grey Medium Washed","XS,L,M,XXL",DEFAULT),
("3","Lace-up boots in faux suede",59.50,"Men","https://adaspera.blob.core.windows.net/images/id3.jpeg",1,"Sand","38,39,40,41,42",DEFAULT),
("4","Sweat cardigan with a zip",29.00,"Men","https://adaspera.blob.core.windows.net/images/id4.jpeg",1,"Black","XL,L,M,S",DEFAULT),
("5","Cashmere Blend: zip cardigan",45.00,"Men","https://adaspera.blob.core.windows.net/images/id5.jpeg",1,"Black","XXL,M,S",DEFAULT),
("6","Outdoor jacket",79.00,"Men","https://adaspera.blob.core.windows.net/images/id6.jpeg",1,"Navy","XXL,M,S,L",DEFAULT),
("7","Jackets outdoor woven",59.00,"Men","https://adaspera.blob.core.windows.net/images/id7.jpeg",1,"Blue","XL,M,S,L",DEFAULT),
("8","Fashion Sweater",29.75,"Men","https://adaspera.blob.core.windows.net/images/id8.jpeg",1,"Light Khaki","XXL,L,S,M",DEFAULT),
("9","Fashion T-Shirt",30.00,"Men","https://adaspera.blob.core.windows.net/images/id9.jpeg",1,"Dark Brown","L,S,M",DEFAULT),
("10","Blazers suit",29.75,"Men","https://adaspera.blob.core.windows.net/images/id10.jpeg",1,"Black","S,M",DEFAULT),
("11","Blazers",159.00,"Men","https://adaspera.blob.core.windows.net/images/id11.jpeg",1,"Black","S,M,L",DEFAULT),
("12","Woven Blazer",129.00,"Men","https://adaspera.blob.core.windows.net/images/id12.jpeg",1,"ANTHRACITE","S,M,L",DEFAULT),

("13","Vests outdoor woven",45.00,"Kids","https://adaspera.blob.core.windows.net/images/id1k.jpeg",2,"Honey yellow","S,M",DEFAULT),
("14","Jacket outdoor woven",62.00,"Kids","https://adaspera.blob.core.windows.net/images/id2k.jpeg",2,"Navy","S,M,L",DEFAULT),
("15","Quilted jacket with a hood",40.00,"Kids","https://adaspera.blob.core.windows.net/images/id3k.jpeg",2,"Black","S,M",DEFAULT),
("16","T-Shirts",18.00,"Kids","https://adaspera.blob.core.windows.net/images/id4k.jpeg",2,"Turquoise","S,M",DEFAULT),
("17","Printed T-shirt",8.00,"Kids","https://adaspera.blob.core.windows.net/images/id5k.jpeg",2,"White","S,M",DEFAULT),
("18","Fashion T-Shirt",20.00,"Kids","https://adaspera.blob.core.windows.net/images/id6k.jpeg",2,"Blue Lavander","S,M",DEFAULT),
("19","Dresses knitted",27.00,"Kids","https://adaspera.blob.core.windows.net/images/id7k.jpeg",2,"Blue Medium Washed","S,M",DEFAULT),
("20","Quilted jacket with a hood",40.00,"Kids","https://adaspera.blob.core.windows.net/images/id8k.jpeg",2,"Pink","S,M",DEFAULT),
("21","Jackets outdoor woven",62.00,"Kids","https://adaspera.blob.core.windows.net/images/id9k.jpeg",2,"Color Fuchsa","S,M",DEFAULT),
("22","Sweaters cardigan",32.00,"Kids","https://adaspera.blob.core.windows.net/images/id10k.jpeg",2,"Pastel Grey","S,M",DEFAULT),
("23","Denim dress with a Carmen neckline",32.00,"Kids","https://adaspera.blob.core.windows.net/images/id11k.jpeg",2,"Blue Light Washed","S,M",DEFAULT),
("24","Dresses knitted",55.00,"Kids","https://adaspera.blob.core.windows.net/images/id12k.jpeg",2,"Aqua Green","S,M",DEFAULT),

("25","Unlined oversized coat",75.00,"Women","https://adaspera.blob.core.windows.net/images/id1w.jpeg",3,"Navy","S,M,L",DEFAULT),
("26","Coat",99.00,"Women","https://adaspera.blob.core.windows.net/images/id2w.jpeg",3,"Coral","S,M,L",DEFAULT),
("27","Outdoor jacket",99.00,"Women","https://adaspera.blob.core.windows.net/images/id3w.jpeg",3,"Khaki Green","S,M,L",DEFAULT),
("28","Hooded raincoat",155.00,"Women","https://adaspera.blob.core.windows.net/images/id4w.jpeg",3,"Black","S,M,L",DEFAULT),
("29","Fashion Sweater",25.00,"Women","https://adaspera.blob.core.windows.net/images/id5w.jpeg",3,"Pastel Yellow","S,M,L",DEFAULT),
("30","Fashion Cardigan",55.00,"Women","https://adaspera.blob.core.windows.net/images/id6w.jpeg",3,"Sand","S,M,L",DEFAULT),
("31","Fashion Cardigan",39.99,"Women","https://adaspera.blob.core.windows.net/images/id7w.jpeg",3,"Coral","S,M,L",DEFAULT),
("32","Norwegian pattern jumper",55.00,"Women","https://adaspera.blob.core.windows.net/images/id8w.jpeg",3,"Coral","S,M,L",DEFAULT),
("33","Blouses woven regular",35.99,"Women","https://adaspera.blob.core.windows.net/images/id9w.jpeg",3,"White","S,M,L",DEFAULT),
("34","Blouse",39.00,"Women","https://adaspera.blob.core.windows.net/images/id10w.jpeg",3,"Pink","S,M,L",DEFAULT),
("35","Blouse with short sleeves",29.00,"Women","https://adaspera.blob.core.windows.net/images/id11w.jpeg",3,"Pink","S,M,L",DEFAULT),
("36","Blouse with frilled edges",29.50,"Women","https://adaspera.blob.core.windows.net/images/id12w.jpeg",3,"Red","S,M,L",DEFAULT),

("37","T-Shirts",18.00,"New","https://adaspera.blob.core.windows.net/images/id4k.jpeg",2,"Turquoise","S,M",DEFAULT),
("38","Fashion Sweater",25.00,"New","https://adaspera.blob.core.windows.net/images/id5w.jpeg",3,"Pastel Yellow","S,M,L",DEFAULT),
("39","Organic Cotton Jeans",45.00,"New","https://adaspera.blob.core.windows.net/images/id1.jpeg",1,"Blue Black","XXS,XXL,M,S",DEFAULT),
("40","Fashion Cardigan",55.00,"New","https://adaspera.blob.core.windows.net/images/id6w.jpeg",3,"Sand","S,M,L",DEFAULT),
("41","Stretch jeans containing organic cotton",45.00,"New","https://adaspera.blob.core.windows.net/images/id2.jpeg",1,"Grey Medium Washed","XS,L,M,XXL",DEFAULT),
("42","Printed T-shirt",8.00,"New","https://adaspera.blob.core.windows.net/images/id5k.jpeg",2,"White","S,M",DEFAULT),
("43","Blouse with short sleeves",29.00,"New","https://adaspera.blob.core.windows.net/images/id11w.jpeg",3,"Pink","S,M,L",DEFAULT),
("44","Sweat cardigan with a zip",29.00,"New","https://adaspera.blob.core.windows.net/images/id4.jpeg",1,"Black","XL,L,M,S",DEFAULT),
("45","Lace-up boots in faux suede",59.50,"New","https://adaspera.blob.core.windows.net/images/id3.jpeg",1,"Sand","38,39,40,41,42",DEFAULT),
("46","Fashion T-Shirt",20.00,"New","https://adaspera.blob.core.windows.net/images/id6k.jpeg",2,"Blue Lavander","S,M",DEFAULT),
("47","Blouse with frilled edges",29.50,"New","https://adaspera.blob.core.windows.net/images/id12w.jpeg",3,"Red","S,M,L",DEFAULT),
("48","Dresses knitted",27.00,"New","https://adaspera.blob.core.windows.net/images/id7k.jpeg",2,"Blue Medium Washed","S,M",DEFAULT);

 


CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `sex` varchar(50) not null,
  `birthday` date,
  `mobile` varchar(15),
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_admin` smallint(1) NOT NULL DEFAULT 0
);


INSERT INTO `users` (`id`, `first_name`, `last_name`,`sex`,`birthday`,`mobile`, `email`, `password`, `time_created`, `is_admin`) VALUES
(1, 'Flamur', 'Xhafa', 'M','2022-02-13','045123123','flamur@adaspera.com', '$2y$10$f0u4YYajdVrzfICXBN.5D.rd9gqAurKKTTD2tinnvfLZTaQoU8QWG',DEFAULT, 1),
(2, 'Egzon', 'Sylejmani',  'M','2022-02-13', '04651231','egzon@adaspera.com','$2y$10$f0u4YYajdVrzfICXBN.5D.rd9gqAurKKTTD2tinnvfLZTaQoU8QWG',DEFAULT, 1),
(3, 'Blendi', 'Shala', 'M' ,'2022-02-13','045124123','blendi@adaspera.com','$2y$10$f0u4YYajdVrzfICXBN.5D.rd9gqAurKKTTD2tinnvfLZTaQoU8QWG',DEFAULT, 1);

ALTER TABLE `users`
ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;



CREATE TABLE `slider_images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
);
INSERT INTO `slider_images` (`id`, `image`) VALUES
(1, 'https://adaspera.blob.core.windows.net/images/home_page.jpeg'),

(2, 'https://adaspera.blob.core.windows.net/images/home_page2.jpeg'),
(3, 'https://adaspera.blob.core.windows.net/images/home_page3.jpeg'),
(4, 'https://adaspera.blob.core.windows.net/images/home_page4.jpeg');