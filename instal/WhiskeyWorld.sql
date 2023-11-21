-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 22, 2023 at 01:18 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WhiskeyWorld`
--

-- --------------------------------------------------------

--
-- Table structure for table `Brands`
--

CREATE TABLE `Brands` (
  `BrandId` int NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Country` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Brands`
--

INSERT INTO `Brands` (`BrandId`, `Name`, `Country`) VALUES
(1, 'Jameson', 'Ірландія'),
(2, 'Jim Beam', 'США'),
(3, 'VDOMA', 'Україна'),
(4, 'Alazani Valley', 'Грузія'),
(5, 'Casa Clara', 'Португалія'),
(6, 'Capela DOC', 'Португалія');

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE `Categories` (
  `CategoryId` int NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`CategoryId`, `Name`, `Image`) VALUES
(1, 'Віскі', '655672c668722.jpg'),
(2, 'Тихе вино', '65567377628e6.jpg'),
(3, 'Шампанське та ігристе вино', '6556738a9729d.jpg'),
(4, 'Вермут', '655673a1cabf6.jpg'),
(5, 'Ром', '655673ab63908.jpg'),
(6, 'Лікери та аперитиви', '655673b51fa05.jpg'),
(7, 'Горілка', '655673bdc64da.jpg'),
(8, 'Джин', '655673c8490d7.jpg'),
(9, 'Текіла та мескаль', '655673d433412.jpg'),
(10, 'Коньяк та бренді', '655673ddf3cac.jpg'),
(11, 'Абсент', '655673e875440.jpg'),
(12, 'Пиво', '655673f139629.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `GrapeVarieties`
--

CREATE TABLE `GrapeVarieties` (
  `GrapeVarietyId` int NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `GrapeVarieties`
--

INSERT INTO `GrapeVarieties` (`GrapeVarietyId`, `Name`) VALUES
(1, 'Глера'),
(2, 'Ркацителі'),
(3, 'Шардоне'),
(4, 'Ропейро'),
(5, 'Каберне Совіньон');

-- --------------------------------------------------------

--
-- Table structure for table `OrderItems`
--

CREATE TABLE `OrderItems` (
  `OrderItemId` int NOT NULL,
  `OrderId` int NOT NULL,
  `ProductId` int NOT NULL,
  `Count` int NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `OrderId` int NOT NULL,
  `UserId` int NOT NULL,
  `Date` date NOT NULL,
  `TotalPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `ProductId` int NOT NULL,
  `CategoryId` int DEFAULT NULL,
  `Name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Type` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `SugarContentId` int DEFAULT NULL,
  `BrandId` int DEFAULT NULL,
  `Volume` float NOT NULL,
  `Strength` float NOT NULL,
  `Taste` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `GrapeVarietyId` int DEFAULT NULL,
  `Aging` tinyint DEFAULT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `Count` int DEFAULT NULL,
  `Price` float NOT NULL,
  `Image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Visibility` tinyint DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`ProductId`, `CategoryId`, `Name`, `Type`, `Color`, `SugarContentId`, `BrandId`, `Volume`, `Strength`, `Taste`, `GrapeVarietyId`, `Aging`, `Description`, `Count`, `Price`, `Image`, `Visibility`) VALUES
(1, 1, 'Jameson Irish Whiskey', 'Бленд', 'Золотисто-бурштиновий', NULL, 1, 0.7, 40, 'Пряний, фруктовий', NULL, 6, '<p>Кожна пляшка ірландського віскі — <strong>Jameson</strong> це понад 220 років традицій і майстерності. Джон Джемесон, талановитий підприємець і тонкий знавець віскі, започаткував свою віскікурню в 1780 році в самому серці Дубліна. Родовий девіз Sine Metu («Без страху») допомагає пояснити унікальний новаторський підхід Джона Джемесона, завдяки якому він створив найм\'якіше віскі у світі. Незабаром після заснування віскікурня <i>John Jameson&amp;Son</i> стала одним із найбільших підприємств Ірландії. Джон Джемесон не шкодував сил і коштів для того, щоб забезпечити безперебійне постачання чудової сировини та гарантувати бездоганну якість свого віскі. Слава про чудовий смак віскі <strong>Jameson</strong> поширилася всією планетою, завдяки чому до кінця XIX століття <strong>Jameson</strong> став ірландським віскі номер один у всьому світі. Першість <strong>Jameson</strong> у цій категорії й тепер не піддається сумніву. Серед шанувальників <strong>Jameson</strong> — знаменитості минулого та сьогодення: королева Єлизавета I та Джеймс Джойс, Софія Форд Коппола, Пірс Броснан і багато інших.</p><p>Основними компонентами ірландського віскі <strong>Jameson</strong> є ячмінь, ячмінний солод і найчистіша джерельна вода. В Ірландії солод висушують у закритих печах, тому тутешнє віскі не має запаху диму, — його відрізняє легкий квітковий аромат. Крім цього, ірландське віскі — єдине віскі у світі, яке піддається потрійній дистиляції й тому має м\'якший смак, ніж його «побратими» із Шотландії та Америки. Отримане віскі розливається в дубові бочки, де до цього неодмінно витримували херес. У цих бочках у повній темряві та тиші віскі визріває, набираючись танінів, «дорослішає» впродовж мінімум шести років. За цей час остаточно формується букет і смак продукту, напій набуває золотистого кольору. Як кажуть ірландці, Святий Патрік пускає сльозу подяки в кожну бочку.</p><p>Характер кожного сорту ірландського віскі визначає майстер купажу — він з\'єднує в одній бочці до сорока різних сортів. Саме це складне поєднання різних віскі, кожне з яких унікальне, створює воістину магічний смак <strong>Jameson</strong>.</p><p>На етикетці віскі <strong>Jameson</strong> значиться герб Джона Джемесона та незмінний девіз його сім\'ї: «Sine metu» («Без страху»). Бурштиновий <strong>Jameson</strong> надає впевненості, комфорту й вміння отримувати задоволення від життя.</p>', 35, 599, '6558cb0bdb0f7.jpg', 1),
(2, 1, 'Jim Beam White', 'Бурбон', 'Золотисто-бурштиновий', NULL, 2, 1, 40, 'Солодкий', NULL, 4, '<p>Історія компанії <strong>Jim Beam</strong>, популярної в усьому світі, пов\'язана з ім\'ям Джейкоба Біма, який наприкінці 18 століття почав виробляти віскі з розмелених кукурудзяних зерен, жита та солоду. Цей міцний спиртний напій бурштинового кольору отримав назву бурбон за назвою округу Бурбон у штаті Кентуккі, де його вперше виготовили. Джейкоб Бім продав першу бочку свого бурбону 1795 року. У наш час історія компанії Jim Beam налічує вже понад 200 років, але її власники й далі дотримуються багатих традицій своїх предків, передаючи рецепт чудового віскі з покоління в покоління.</p><p>\"<strong>Jim Beam</strong>\" — бурбон №1 у світі! Щорічно в усьому світі випивають понад 40 мільйонів літрів цього дивовижного напою. Це справжній віскі, повсюдно визнаний завдяки своїй чудовій якості та веселій вдачі. Не менш як 51% сусла, за прийнятими стандартами, створюють з кукурудзи. \"Джим Бім\" витримують 4 роки у нових обвуглених бочках, зроблених з деревини американського дуба.</p>', 15, 729, '6558cabdba0fd.jpg', 1),
(3, 2, 'Mount of Georgia Alazani Valley червоне напівсолодке', NULL, 'Червоне', NULL, 4, 0.75, 12, 'М’який фруктовий з чіткими акцентами темних фруктів', 2, NULL, '<p><strong>Alazani Valley, Medium Sweet Red</strong> ― червоне напівсолодке вино зі спокійним смако-ароматичним букетом темних ягід і фруктів. Виготовлене із незвичайного винограду Сапераві ― справжньої гордості грузинського виноробства. Соковиті грона достигають під лагідним сонцем Алазанської долини з ідеальними умовами для смачного вина. Ягоди збирають лише вручну і дбайливо пресують, щоб не пошкодити кісточку. У смаку присутній приємний баланс м’якості та фруктових ноток з легкою кислотністю. Аромат розкривається відтінками стиглої сливи, вишні і лісової ожини. Таке десертне вино бездоганно смакує з тістечками, шоколадом та літніми фруктами.</p>', 25, 139, '655d0e4fc233c.jpg', 1),
(4, 2, 'VDOMA ординарне столове сухе біле сортове Шардоне Шабо', 'Натуральні вина', 'Світло-жовтий', NULL, 3, 0.75, 12.2, 'Свіжий, збалансований, округлий з тривалим посмаком', 3, NULL, '<p>Вино, виготовлене з європейського сорту винограду Шардоне, який ми збираємо вручну. Лози були спеціально підібрані для нашого теруару з найкращих розплідників Італії. На певних етапах виробництва контроль якості забезпечують міжнародні експерти. З гордістю презентуємо вам Шардоне світло-солом\'яного кольору, яке зачаровує ароматом з нотками білого персика, обліпихи та квітковими тонами і має свіжий, збалансований, округлий смак з тривалим післясмаком.</p>', 35, 129, '655d11c23b293.jpg', 1),
(5, 2, 'Casa Clara da Malta біле сухе', 'Натуральні вина', 'Біле', NULL, NULL, 0.75, 12.5, 'Блискучий колір з відтінками соломи. Легка кислотність, збалансоване тіло', 4, NULL, '<p>Після легкого подрібнення та пресування винограду, попередньо очищеного, чисте сусло бродить під контрольованою температурою бродіння.Вино яскравого солом\'яного кольору з нотками цитрусових і молодим фруктовим ароматом. Має м\'який смак, помірну кислотність з гармонійним тілом і багатим характером.</p>', 34, 129, '655d1388ade49.jpg', 1),
(6, 2, 'VDOMA ординарне столове сухе червоне сортове ', 'Натуральні вина', 'Темно-вишневий', NULL, 3, 0.75, 12.3, 'Округлий, збалансований з м’якими танінами', 5, NULL, '<p>Вино, виготовлене з французького сорту винограду Каберне Совіньйон, який ми збираємо вручну. Лози були спеціально підібрані для нашого теруару з найкращих розплідників Італії. На певних етапах виробництва контроль якості забезпечують міжнародні експерти. З гордістю презентуємо вам Каберне темно-рубінового кольору, яке зачаровує ароматом з нотками чорної смородини та стиглих слив і має округлий, збалансований смак з м’якими танінами.</p>', 45, 143, '655d150f977a7.jpg', 1),
(7, 2, 'Capela DOC рожеве сухе', 'Натуральні вина', 'Рожеве', NULL, 6, 0.75, 12, 'Ніжний лососевий колір. Смак червоних фруктів, м\'якість та свіжість', 5, NULL, '<p>Виноград ретельно відбирають як під час збору, так і на виноробні. Помірна холодна мацерація протягом 2 годин і бродіння при контрольованій температурі 16ºC-18ºC. Витримується на дрібному осаді 1 місяць.Колір лососевий. Аромат червоних фруктів (вишні, полуниці) з квітковими нотами. На смак вино м\'яке з нотками червоних фруктів. Легкий післясмак.</p>', 30, 169, '655d16a1b40a2.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `SugarContents`
--

CREATE TABLE `SugarContents` (
  `SugarContentId` int NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `SugarContents`
--

INSERT INTO `SugarContents` (`SugarContentId`, `Name`) VALUES
(1, 'Сухе'),
(2, 'Напівсухе'),
(3, 'Напівсолодке'),
(4, 'Солодке'),
(5, 'Брют');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserId` int NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Login` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Firstname` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Lastname` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `Gender` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `AccessLevel` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserId`, `Email`, `Login`, `Password`, `Firstname`, `Lastname`, `BirthDate`, `Gender`, `AccessLevel`) VALUES
(1, 'Admin', 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 'Admin', 'Admin', '1990-01-01', 'Admin', 10),
(2, 'nikonprofiz@gmail.com', 'Chipernes', '81dc9bdb52d04dc20036dbd8313ed055', 'Нікіта', 'Мотицький', '2004-09-29', 'Чоловічий', 10),
(3, 'temper123@gmail.com', 'Horny', '81dc9bdb52d04dc20036dbd8313ed055', 'James', 'Hornigold', NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Brands`
--
ALTER TABLE `Brands`
  ADD PRIMARY KEY (`BrandId`);

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `GrapeVarieties`
--
ALTER TABLE `GrapeVarieties`
  ADD PRIMARY KEY (`GrapeVarietyId`);

--
-- Indexes for table `OrderItems`
--
ALTER TABLE `OrderItems`
  ADD PRIMARY KEY (`OrderItemId`),
  ADD KEY `FK_1` (`OrderId`),
  ADD KEY `FK_2` (`ProductId`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`OrderId`),
  ADD KEY `FK_1` (`UserId`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`ProductId`),
  ADD KEY `FK_1` (`CategoryId`),
  ADD KEY `FK_2` (`BrandId`),
  ADD KEY `FK_3` (`GrapeVarietyId`),
  ADD KEY `FK_11` (`SugarContentId`);

--
-- Indexes for table `SugarContents`
--
ALTER TABLE `SugarContents`
  ADD PRIMARY KEY (`SugarContentId`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Brands`
--
ALTER TABLE `Brands`
  MODIFY `BrandId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `CategoryId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `GrapeVarieties`
--
ALTER TABLE `GrapeVarieties`
  MODIFY `GrapeVarietyId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `OrderItems`
--
ALTER TABLE `OrderItems`
  MODIFY `OrderItemId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `OrderId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `ProductId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `SugarContents`
--
ALTER TABLE `SugarContents`
  MODIFY `SugarContentId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `OrderItems`
--
ALTER TABLE `OrderItems`
  ADD CONSTRAINT `FK_10` FOREIGN KEY (`ProductId`) REFERENCES `Products` (`ProductId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_9` FOREIGN KEY (`OrderId`) REFERENCES `Orders` (`OrderId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `FK_8` FOREIGN KEY (`UserId`) REFERENCES `Users` (`UserId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `Products`
--
ALTER TABLE `Products`
  ADD CONSTRAINT `FK_11` FOREIGN KEY (`SugarContentId`) REFERENCES `SugarContents` (`SugarContentId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_5` FOREIGN KEY (`CategoryId`) REFERENCES `Categories` (`CategoryId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_6` FOREIGN KEY (`BrandId`) REFERENCES `Brands` (`BrandId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_7` FOREIGN KEY (`GrapeVarietyId`) REFERENCES `GrapeVarieties` (`GrapeVarietyId`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
