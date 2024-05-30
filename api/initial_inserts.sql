-- Inserts para la tabla `user`
INSERT INTO `user` (`id`, `name`, `surname`, `image`, `email`, `phone`, `password`, `balance`, `isAdmin`) VALUES
(1, 'Juan', 'Pérez', 'default-profile.webp', 'juan.perez@example.com', '123456789', 'a94652aa97c7211ba8954dd15a3cf838', 50, 0),
(2, 'Ana', 'Gómez', 'default-profile.webp', 'ana.gomez@example.com', '987654321', '276b6c4692e78d4799c12ada515bc3e4', 200, 0),
(3, 'Admin', 'User', 'default-profile.webp', 'admin@example.com', '555555555', '21232f297a57a5a743894a0e4a801fc3', 500, 1),
(4, 'Carlos', 'Capó Forcada', 'avatar38.svg?t=1716983144252', 'carlos.capo@itb.cat', '600141414', 'dc599a9972fde3045dab59dbd1ae170b', 360, 0),
(5, 'Jacomar', 'Gonzalez', 'avatar44.svg?t=1716983144394', 'jacomar.gonzalez@itb.cat', '600123456', '57cc7b7ba980c987f258a924f358e5b2', 360, 0),
(6, 'Thalia', 'Soler', 'avatar46.svg?t=1716983144427', 'thalia.soler@itb.cat', '600123456', '36901c4c04d8dc5e9ba18789c12fce85', 360, 0),
(7, 'Ulises', 'Castell Escolano', 'default-profile.webp', 'ulises.castell@itb.cat', '677829106', '7c94976f5d4567f3eab3a1475134fc5a', 360, 0);

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
(1, 1, 1, 'Clases de Matemáticas', 'https://media.snl.no/media/191647/article_topimage_matematikk.jpg', 'Ofrezco clases de matemáticas para estudiantes de secundaria.', 0, 50, '1714633200000,1715238000000,1716300000000,1716472800000,1716904800000,1717077600000', 'Madrid', 40.4168, -3.70379, 5, 1716449760),
(2, 2, 8, 'Sesión de Yoga', 'default.webp', 'Ofrezco sesiones de yoga para principiantes. Muy relajante', 0, 30, '1715065200000,1715670000000,1716274800000,1716879600000,1714665600000,1715270400000,1715875200000,1716480000000,1717084800000,1717493400000,1718098200000,1718703000000,1719307800000,1717666200000,1718271000000,1718875800000,1719480600000,1717956000000,1719165600000', 'Barcelona', 41.3851, 2.1734, 10, 1716538380),
(3, 2, 4, 'Busco alguien para pasear mis perros', 'default.webp', 'Busco alguien a que le gusten los animales para que pueda pasear mis perros las mañanas de los viernes, ya que trabajo y no puedo.', 1, 30, '1714717800000,1715322600000,1715927400000,1716532200000,1717137000000', 'Barcelona', 41.3851, 2.1734, 1, 1716753900),
(4, 2, 4, 'Ofrezco hacer la compra al supermercado', 'https://estaticos-cdn.prensaiberica.es/clip/ff704f3f-7840-4287-8233-a9ee8825969a_16-9-discover-aspect-ratio_default_0.jpg', 'Me ofrezco para hacer la compra que se me diga y llevarla al domicilio. Pago por adelantado. Solo gente seria.', 0, 90, '[1714984200000,1715070600000,1715157000000,1715243400000,1715589000000,1715675400000,1715761800000,1715848200000,1716453000000,1717057800000,1716366600000,1716280200000,1716193800000,1716798600000,1716885000000,1716971400000]', 'Plaça Catalunya, Barcelona', 41.3869, 2.17014, 1, 1716968635370),
(5, 6, 2, 'Corto el pelo', 'https://titulae.es/wp-content/uploads/2021/11/grado-superior-peluqueria.jpg', 'Tengo el grado medio de peluquería. Estoy aprendiendo aún así que no quiero cobrar a la gente por si no lo hago del todo bien :). Ya tengo algo de experiencia por las prácticas que realicé y solamente estoy buscando practicar mientras busco trabajo.', 0, 45, '1716994800000,1717599600000,1718809200000,1718204400000,1719414000000,1717425000000,1718029800000,1718634600000,1719239400000', '', 41.3835, 2.15559, 1, 1716988241090),
(8, 6, 10, 'Necesito una llave fija de 13mm', 'https://bricovel.com/38906-big_default/llave-fija-plana-12-13mm-hr.jpg', 'Estoy arreglando la caldera y me he dado cuenta de que me ha desaparecido la llave fija de 13mm que necesito para ajustar unos tornillos. Agradecería difusión', 1, 30, '', '137, Carrer de Sepúlveda, Sant Antoni, Eixample, Barcelona, Barcelonès, Barcelona, Catalonia, 08001, Spain', 41.3817, 2.16038, 1, 1716989788117);

-- Inserts para la tabla `advert_tags`
INSERT INTO `advert_tags` (`advert_id`, `tag_id`) VALUES
(3, 1),
(8, 1),
(1, 2),
(4, 3),
(1, 6),
(2, 7),
(5, 7),
(3, 9),
(5, 12);

-- Inserts para la tabla `booking`
INSERT INTO `booking` (`id`, `advert_id`, `user_id`, `booking_date`, `valoration_score`, `valoration_comment`, `valoration_date`) VALUES
(1, 1, 2, 1716455580, 5, 'Excelente clase, muy recomendada!', 1716918600),
(2, 2, 1, 1716464880, 4, 'Buena sesión de yoga, muy relajante.', 1716905400),
(3, 1, 6, 1717011925790, NULL, NULL, NULL),
(4, 3, 4, 1717015680, NULL, NULL, NULL);

