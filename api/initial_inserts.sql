-- Inserts para la tabla `user`
INSERT INTO `user` (`id`, `name`, `surname`, `image`, `email`, `phone`, `password`, `balance`, `isAdmin`) VALUES
(1, 'Juan', 'Pérez', DEFAULT, 'juan.perez@example.com', '123456789', 'a94652aa97c7211ba8954dd15a3cf838', 100, 0),
(2, 'Ana', 'Gómez', DEFAULT, 'ana.gomez@example.com', '987654321', '276b6c4692e78d4799c12ada515bc3e4', 200, 0),
(3, 'Admin', 'User', DEFAULT, 'admin@example.com', '555555555', '21232f297a57a5a743894a0e4a801fc3', 500, 1);

-- Inserts para la tabla `category`
INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Lessons'),
(2, 'Beauty / Grooming'),
(3, 'Repairs'),
(4, 'Help at home'),
(5, 'Administrative tasks'),
(6, 'Companionship'),
(7, 'Consulting'),
(8, 'Health & Wellbeing'),
(9, 'Leisure'),
(10, 'Loan of tools, material, books...'),
(11, 'Other');

-- Inserts para la tabla `tag`
INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'Urgent'),
(2, 'Review classes'),
(3, 'Computing'),
(4, 'Drawing'),
(5, 'Writing and narrative'),
(6, 'Math'),
(7, 'Kids'),
(8, 'Old people'),
(9, 'Kitchen'),
(10, 'Pets'),
(11, 'Handicrafts'),
(12, 'Hairdressing');

-- Inserts para la tabla `advert`
INSERT INTO `advert` (`id`, `owner_id`, `category_id`, `title`, `image`, `description`, `isRequest`, `price`, `availability`, `loc_name`, `loc_latitude`, `loc_longitude`, `max_subscribers`, `publish_date`) VALUES
(1, 1, 1, 'Clases de Matemáticas', DEFAULT, 'Ofrezco clases de matemáticas para estudiantes de secundaria.', 0, 50, '1714633200000,1715238000000,1716300000000,1716472800000,1716904800000,1717077600000', 'Madrid', 40.416775, -3.703790, 5, 1716449760),
(2, 2, 8, 'Sesión de Yoga', DEFAULT, 'Ofrezco sesiones de yoga para principiantes.', 0, 30, '1715065200000,1715670000000,1716274800000,1716879600000,1714665600000,1715270400000,1715875200000,1716480000000,1717084800000,1717493400000,1718098200000,1718703000000,1719307800000,1717666200000,1718271000000,1718875800000,1719480600000', 'Barcelona', 41.385064, 2.173404, 10, 1716538380),
(3, 2, 4, 'Busco alguien para pasear mis perros', DEFAULT, 'Busco alguien a que le gusten los animales para que pueda pasear mis perros las mañanas de los viernes, ya que trabajo y no puedo.', 1, 30, '1714717800000,1715322600000,1715927400000,1716532200000,1717137000000', 'Barcelona', 41.385064, 2.173404, 1, 1716753900);

-- Inserts para la tabla `advert_tags`
INSERT INTO `advert_tags` (`advert_id`, `tag_id`) VALUES
(1, 2),
(1, 6),
(2, 7),
(3, 1),
(3, 9);

-- Inserts para la tabla `booking`
INSERT INTO `booking` (`id`, `advert_id`, `user_id`, `booking_date`, `valoration_score`, `valoration_comment`, `valoration_date`) VALUES
(1, 1, 2, 1716455580, 5, 'Excelente clase, muy recomendada!', 1716918600),
(2, 2, 1, 1716464880, 4, 'Buena sesión de yoga, muy relajante.', 1716905400);

