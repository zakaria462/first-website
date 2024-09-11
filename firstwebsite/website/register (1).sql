
-- Base de données : `register`
--

-- --------------------------------------------------------

--
-- Structure de la table `accessoires`
--

CREATE TABLE `accessoires` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `description` varchar(50) NOT NULL,
  `prix` int(10) NOT NULL,
  `quantité` int(10) NOT NULL,
  `image` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `accessoires`
--

INSERT INTO `accessoires` (`id`, `nom`, `description`, `prix`, `quantité`, `image`) VALUES
(1, 'Logitech G213 Prodigy', '', 549, 42, 'https://pcgamercasa.ma/5805-large_default/logitech-clavier-gaming-g213-prodigy-pcgamercasa-maroc.jpg'),
(2, 'Logitech G502 Lightspeed Wirel', '', 1190, 34, 'https://www.ultrapc.ma/11515-large_default/logitech-g502-lightspeed-wireless-gaming-mouse-souris.jpg'),
(3, 'Stream Webcam Logitech C922 Pr', '', 990, 22, 'https://pcstore.ma/wp-content/uploads/2022/03/Stream-Webcam-Logitech-C922-Pro-2.webp'),
(4, 'Elgato Cam Link Pro', '', 4990, 21, 'https://atlasgaming.ma/wp-content/uploads/2022/09/Atlas-Gaming-Elgato-Cam-Link-Pro-A.jpg.webp'),
(5, 'Microphone Mars Gaming MMICPRO', '', 599, 21, 'https://m.media-amazon.com/images/I/71JPH-dcJDL._AC_SY355_.jpg'),
(6, 'Razer Kraken v3 X (Noir)', '', 849, 21, 'https://pcstore.ma/wp-content/uploads/2022/05/Casque-Gamer-Razer-Kraken-v3-X-Noir-1-e1652975188266.webp'),
(7, 'ASUS 34 LED ROG Strix XG349C', '', 13499, 15, 'https://www.asus-store.ma/cdn/shop/files/ROG-Strix-XG349C-Setup-Game_jpg_720x.webp?v=1683895320'),
(8, 'Hybrok Fighter Rouge/Noi', '', 1399, 14, 'https://pcstore.ma/wp-content/uploads/2023/09/CHAISE-GAMER-Hybrok-Fighter-Noir.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `camera`
--

CREATE TABLE `camera` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `description` varchar(50) NOT NULL,
  `prix` int(10) NOT NULL,
  `quantité` int(10) NOT NULL,
  `image` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `camera`
--

INSERT INTO `camera` (`id`, `nom`, `description`, `prix`, `quantité`, `image`) VALUES
(1, 'Canon EOS 700D + Objectif EF-S', '', 3800, 8, 'https://kamerty.ma/wp-content/uploads/2023/09/Canon-EOS-700D-Objectif-EF-S-18-55mm-Occasion-prix-maroc-kamerty-1-300x300.jpg'),
(2, 'Sony Alpha 6700 Boîtier', '', 16500, 23, 'https://kamerty.ma/wp-content/uploads/2023/09/Sony-A6700-Boitier-prix-maroc-kamerty-300x300.jpeg'),
(3, 'SONY FE 35mm f/1.4 GM', '', 13800, 23, 'https://kamerty.ma/wp-content/uploads/2023/08/Sony-FE-35mm-f1.4-GM-Lens-kamerty.ma-prix-maroc-300x300.jpeg'),
(4, 'Canon EOS 250D + Objectif EF-S', '', 5500, 24, 'https://kamerty.ma/wp-content/uploads/2023/09/Canon-EOS-250D-Objectif-EF-S-18-55mm-Occasion-Prix-Maroc-Kamerty-4-300x300.webp'),
(5, 'Canon EOS R7 Boitier - Neuf', '', 14000, 12, 'https://kamerty.ma/wp-content/uploads/2023/12/Canon-EOS-R7-x-300x300.jpeg'),
(6, 'CANON EOS M50 + 15-45mm IS STM', '', 5500, 35, 'https://kamerty.ma/wp-content/uploads/2024/03/Canon-EOS-M50-15-45mm-300x300.jpeg'),
(7, 'Canon EOS R7 Boitier + Adaptat', '', 16500, 32, 'https://kamerty.ma/wp-content/uploads/2023/12/Canon-EOS-R7-adaptateur-EF-RF-300x300.jpeg'),
(8, 'Sony Alpha ZV-E10 Mirrorless V', '', 10300, 33, 'https://kamerty.ma/wp-content/uploads/2023/10/Sony-Alpha-ZV-E10-kamerty-maroc-1-300x300.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `delivery_address` text NOT NULL,
  `date_commande` datetime NOT NULL,
  `etat_commande` varchar(255) NOT NULL,
  `total_commande` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `full_name`, `email_address`, `phone_number`, `delivery_address`, `date_commande`, `etat_commande`, `total_commande`) VALUES
(58, 'saber', 'saber@gmail.com', '49684', 'fbedbfd', '2024-04-30 22:29:08', 'nouvelle', 13980.00),
(65, 'ZAKARIA ABOULKACEM', 'aboulkasimzakaria@gmail.com', '0624261247', 'BLOC 144 NR 10 SIDI BERNOUSSI CASA', '2024-04-30 22:30:38', 'nouvelle', 13800.00),
(66, 'saber', 'saber@gmail.com', '1261', 'sxcqcd', '2024-04-30 22:31:57', 'nouvelle', 4990.00),
(67, 'zak', 'zak@gmail.com', '268486', 'asa', '2024-04-30 22:43:08', 'nouvelle', 13980.00);

-- --------------------------------------------------------

--
-- Structure de la table `form`
--

CREATE TABLE `form` (
  `id` int(23) NOT NULL,
  `flname` varchar(22) NOT NULL,
  `num` varchar(20) NOT NULL,
  `adress` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mdpass` varchar(30) NOT NULL,
  `type` varchar(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `form`
--

INSERT INTO `form` (`id`, `flname`, `num`, `adress`, `email`, `mdpass`, `type`) VALUES
(17, 'admin', 'admin', 'admin', 'admin', 'admin', 'admin'),
(18, 'zak', 'zak', 'zscqsx', 'zak@gmail.com', '123456', 'admin'),
(24, 'zak', '155645', 'dazq', 'zak@gmail.com', '123456', ''),
(25, 'zak', '4814', 'ninbi', 'zak@gmail.com', '123456', ''),
(26, 'zakaria', '001', 'ezcze', 'zakaria@gmail.com', '123456', '');

-- --------------------------------------------------------

--
-- Structure de la table `iphone`
--

CREATE TABLE `iphone` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `description` varchar(50) NOT NULL,
  `prix` int(10) NOT NULL,
  `quantité` int(10) NOT NULL,
  `image` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `iphone`
--

INSERT INTO `iphone` (`id`, `nom`, `description`, `prix`, `quantité`, `image`) VALUES
(1, 'IPHONE 15 PLUS 128GB', '', 15990, 44, 'https://prod2-media.electroplanet.ma/media/catalog/product/cache/14e469c4a70431355c88f88fd8855f6e/2/9/2994194_1.jpg'),
(2, 'IPHONE 15 128GB', '', 13790, 34, 'https://prod2-media.electroplanet.ma/media/catalog/product/cache/14e469c4a70431355c88f88fd8855f6e/2/9/2994191_1.jpg'),
(3, 'IPHONE 15 128GB', '', 13790, 22, 'https://prod2-media.electroplanet.ma/media/catalog/product/cache/14e469c4a70431355c88f88fd8855f6e/3/0/3010371_1.jpeg'),
(4, 'IPHONE 14 PRO MAX 1TB', '', 16449, 21, 'https://prod2-media.electroplanet.ma/media/catalog/product/cache/14e469c4a70431355c88f88fd8855f6e/2/9/2966244_1_1.jpg'),
(5, 'IPHONE 14 PRO MAX 1TB', '', 16449, 21, 'https://prod2-media.electroplanet.ma/media/catalog/product/cache/14e469c4a70431355c88f88fd8855f6e/2/9/2966169_1.jpg'),
(6, 'IPHONE 14 PRO MAX 1TB', '', 16449, 21, 'https://prod2-media.electroplanet.ma/media/catalog/product/cache/14e469c4a70431355c88f88fd8855f6e/2/9/2966265_1.jpg'),
(7, 'IPHONE 15 PRO 128 GO', 'haute quality', 17490, 15, 'https://prod2-media.electroplanet.ma/media/catalog/product/cache/14e469c4a70431355c88f88fd8855f6e/2/9/2993118.jpg'),
(8, 'IPHONE 15 PRO MAX 256GO', '', 20990, 14, 'https://prod2-media.electroplanet.ma/media/catalog/product/cache/14e469c4a70431355c88f88fd8855f6e/i/p/iphone_15_pro_max_natural_titanium_pure_back_iphone_15_pro_max_natural_titanium_pure_front_2up_screen__usen.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `pc`
--

CREATE TABLE `pc` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prix` int(11) NOT NULL,
  `quantité` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pc`
--

INSERT INTO `pc` (`id`, `nom`, `prix`, `quantité`, `description`, `image`) VALUES
(1, 'MSI GeForce RTX 4070 TI SUPER ', 11999, 43, '', 'https://www.pcgamer.ma/261502-home_default/msi-geforce-rtx-4070-ti-super-16g-ventus-2x-oc.jpg'),
(2, 'PC Ryzen 7 5700X GTX 1650', 7800, 33, '', 'https://www.pcgamer.ma/261088-home_default/pc-ryzen-7-5700x-gtx-1650.jpg'),
(3, 'Asrock Radeon RX 6500 XT 4GB G', 1990, 13, '', 'https://www.pcgamer.ma/260487-home_default/asrock-radeon-rx-6500-xt-4gb-gddr6.jpg'),
(4, 'Dell G15 5510 - Core™ i7 10th,', 11990, 19, '', 'https://setupgame.ma/wp-content/uploads/2023/02/Dell-G15-5510-Core-i7-10th-RTX-3060-16GB-Setup-Game-ma-300x300.jpg'),
(5, 'MSI MAG FORGE 112R', 899, 21, '', 'https://www.pcgamer.ma/260824-home_default/msii-mag-forge-112r-.jpg'),
(6, 'Pc Portable Gamer MSI GF66 Kat', 17499, 15, '', 'https://setupgame.ma/wp-content/uploads/2023/02/MSI-GF76-Katana-11UE-Setup-Game-300x300.webp'),
(7, 'AMD Ryzen™ 5 PRO 5650G', 1690, 16, '', 'https://www.pcgamer.ma/260967-home_default/amd-ryzen-5-pro-5650g.jpg'),
(8, 'PC i7 14700 RTX 4060 Ti', 14990, 11, '', 'https://www.pcgamer.ma/261489-home_default/pc-i7-14700-rtx-4060-ti.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accessoires`
--
ALTER TABLE `accessoires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `camera`
--
ALTER TABLE `camera`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `iphone`
--
ALTER TABLE `iphone`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pc`
--
ALTER TABLE `pc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `accessoires`
--
ALTER TABLE `accessoires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `camera`
--
ALTER TABLE `camera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=511;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT pour la table `form`
--
ALTER TABLE `form`
  MODIFY `id` int(23) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `iphone`
--
ALTER TABLE `iphone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `pc`
--
ALTER TABLE `pc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
