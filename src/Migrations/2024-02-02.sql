SET NAMES utf8mb4;

INSERT INTO `IMAGE` (`ID`, `PRODUCT_ID`, `PATH`, `IS_COVER`)
VALUES (1, 1, '1.jpg', 1),
       (2, 2, '2.webp', 1),
       (3, 3, '3.png', 1),
       (4, 4, '4.png', 1),
       (5, 5, '5.png', 1),
       (6, 6, '6.png', 1),
       (7, 7, '7.webp', 1),
       (8, 8, '8.webp', 1),
       (9, 9, '9.png', 1),
       (10, 10, '10.png', 1);

INSERT INTO `STATUS` (`ID`, `TITLE`)
VALUE (1, 'Новый заказ');

CREATE INDEX index_product_price ON PRODUCT (PRICE);
CREATE INDEX index_product_title ON PRODUCT (TITLE);