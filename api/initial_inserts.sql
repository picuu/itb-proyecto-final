-- Inserts para la tabla `user`
INSERT INTO `user` (`id`, `name`, `surname`, `email`, `phone`, `password`, `balance`, `isAdmin`) VALUES
(1, 'Juan', 'Pérez', 'juan.perez@example.com', '123456789', 'password123', 100, 0),
(2, 'Ana', 'Gómez', 'ana.gomez@example.com', '987654321', 'password123', 200, 0),
(3, 'Admin', 'User', 'admin@example.com', '555555555', 'adminpass', 500, 1);

-- Inserts para la tabla `category`
INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Educación'),
(2, 'Cuidado Personal'),
(3, 'Reparaciones');

-- Inserts para la tabla `tag`
INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'Urgente'),
(2, 'Nuevo'),
(3, 'Popular');

-- Inserts para la tabla `advert`
INSERT INTO `advert` (`id`, `owner_id`, `category_id`, `title`, `image`, `description`, `isRequest`, `price`, `availability`, `loc_name`, `loc_latitude`, `loc_longitude`, `max_subscribers`, `publish_date`) VALUES
(1, 1, 1, 'Clases de Matemáticas', 'image1.jpg', 'Ofrezco clases de matemáticas para estudiantes de secundaria.', 0, 50, '{"lunes": "10:00-12:00", "miércoles": "14:00-16:00"}', 'Madrid', 40.416775, -3.703790, 5, '2024-05-23 09:13:36'),
(2, 2, 2, 'Sesión de Yoga', 'image2.jpg', 'Ofrezco sesiones de yoga para principiantes.', 0, 30, '{"martes": "09:00-10:00", "jueves": "18:00-19:00"}', 'Barcelona', 41.385064, 2.173404, 10, '2024-05-23 09:13:36');

-- Inserts para la tabla `advert_tags`
INSERT INTO `advert_tags` (`advert_id`, `tag_id`) VALUES
(1, 1),
(1, 3),
(2, 2);

-- Inserts para la tabla `booking`
INSERT INTO `booking` (`id`, `advert_id`, `user_id`, `booking_date`, `valoration_score`, `valoration_comment`, `valoration_date`) VALUES
(1, 1, 2, '2024-05-23 09:13:36', 5, 'Excelente clase, muy recomendada!', '2024-05-23 09:13:36'),
(2, 2, 1, '2024-05-23 09:13:36', 4, 'Buena sesión de yoga, muy relajante.', '2024-05-23 09:13:36');

