-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 27, 2024 lúc 04:19 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bookflixdb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book_info`
--

CREATE TABLE `book_info` (
  `bid` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `author` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `audio` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `book_info`
--

INSERT INTO `book_info` (`bid`, `name`, `author`, `price`, `id_category`, `description`, `image`, `audio`, `date`) VALUES
(98, 'The Girl Who Drank ', 'Laura', 30000, 2, 'Once upon a time, in a mystical forest, there lived a curious girl named Luna. One night, as the moon shone brightly, Luna wandered deep into the woods. She stumbled upon a crystal-clear lake that mirrored the full moon perfectly. Feeling an unexplainable thirst, she scooped up the shimmering water and drank deeply.\r\n\r\nAs she drank, the moon\'s light seemed to flow into her, filling her with a warm, magical glow. Luna suddenly felt lighter and more powerful. She could hear the whispers of the trees and understand the songs of the birds. The moon had given her the gift of nature\'s magic.\r\n\r\nWith her newfound abilities, Luna became the guardian of the forest. She helped animals in need, healed sick plants, and brought harmony to the woods. The forest thrived under her care, and she was loved by all its creatures.\r\n\r\nEvery night, Luna would return to the lake to drink the moonlit water, renewing her powers. And so, Luna and the moon\'s magic became one, forever protecting the enchanted forest. The legend of the girl who drank the moon was told for generations, reminding all of the magic that kindness and curiosity can bring.', 'b1.jpg', '1 (1).mp3', '2024-05-24 00:47:50'),
(99, 'Dragons in a Bag', 'Mini', 50000, 2, 'Once upon a time in a bustling city, there lived a curious boy named Jamal. One day, while exploring his grandmother\'s attic, he discovered an old, dusty bag. To his surprise, the bag began to wriggle and squirm. Carefully, Jamal opened it and gasped in amazement. Inside were three tiny dragons, their scales shimmering like precious gems.\r\n\r\nThe dragons introduced themselves as Ember, Spark, and Blaze. They explained that they had been trapped in the bag by an evil sorcerer who feared their power. Jamal, filled with wonder and compassion, decided to help the dragons return to their magical realm.\r\n\r\nWith the dragons\' guidance, Jamal embarked on a thrilling adventure through the city. They faced numerous challenges, from dodging the sorcerer\'s minions to solving ancient riddles. Along the way, Jamal and the dragons formed a deep bond, learning to trust and support each other.\r\n\r\nFinally, they reached a hidden portal in the heart of the city park. With a final farewell, Jamal watched as Ember, Spark, and Blaze flew through the portal, their freedom restored. The dragons left behind a single, glistening scale as a token of their gratitude.\r\n\r\nFrom that day on, Jamal carried the scale as a reminder of his magical friends and the incredible adventure they shared. And though the dragons had returned to their realm, Jamal knew that magic was never far away, as long as one believed in the extraordinary.', 'b2.jpg', '1 (2).mp3', '2024-05-24 00:50:37'),
(100, 'The Land of Stories:', 'Lemie', 40000, 3, 'Once upon a time, in a quaint village, there lived twins named Alex and Conner. They loved reading fairy tales, especially from their grandmother\'s old book called \"The Land of Stories.\" One day, on their birthday, their grandmother gifted them the book. As they read it that night, a strange thing happened: the book began to glow, and suddenly, Alex and Conner were pulled into its pages.\r\n\r\nThey found themselves in a magical land where all the fairy tale characters they had read about were real. Excited but nervous, they learned about the legendary Wishing Spell, a powerful magic that could grant any wish. Determined to find their way back home, they decided to embark on a quest to gather the spell\'s ingredients.\r\n\r\nTheir journey was filled with wonder and danger. They met Cinderella, who gave them a glass slipper, and Little Red Riding Hood, who shared a basket of goodies. They outsmarted the Evil Queen and befriended a talking frog prince. Each encounter brought them closer to their goal.\r\n\r\nAfter many adventures, they finally collected all the items needed for the Wishing Spell. With hearts full of hope, they made their wish to return home. In a flash of light, they found themselves back in their bedroom, the magical book resting on their lap.\r\n\r\nThe twins were grateful for their incredible journey and the friends they had made along the way. From that day on, they knew that magic was real and that their lives would never be the same. And so, Alex and Conner kept the book close, ready for their next adventure in the Land of Stories.', 'b3.jpg', '1 (3).mp3', '2024-05-24 00:51:37'),
(101, 'Pip Bartlett\'s Guide', 'Cloud', 60000, 2, 'Once upon a time, in a world where magical creatures roamed freely, there was a spirited young girl named Pip Bartlett. Pip had an extraordinary gift: she could talk to magical creatures. This talent made her the perfect guide for anyone curious about these wondrous beings.\r\n\r\nOne summer, Pip visited her Aunt Emma, a veterinarian for magical creatures. Aunt Emma\'s clinic was a haven for all sorts of fantastic animals, from fire-breathing dragons to shy unicorns. Pip was thrilled to help out, and she decided to create a guide to magical creatures, documenting their habits, likes, and dislikes.\r\n\r\nOne day, a frantic unicorn named Sparkles burst into the clinic. She was being chased by a group of Fuzzles—tiny, mischievous creatures that stuck to anything with their sticky fur. Pip calmed Sparkles down and promised to find a solution. \r\n\r\nPip\'s research led her to discover that Fuzzles were terrified of loud noises. She quickly devised a plan. With the help of her friend Tomas and his loud drum set, they created a cacophony that sent the Fuzzles scurrying away. Sparkles was safe, and Pip added this new knowledge to her guide.\r\n\r\nWord of Pip\'s guide spread, and soon creatures from all over came to seek her help. She helped a phoenix find a safe place to rebirth and taught a shy griffin to be more confident. Each new adventure was documented in her ever-growing guide.\r\n\r\nPip\'s Guide to Magical Creatures became an invaluable resource, filled with wisdom and compassion. Pip knew that understanding and kindness were the keys to coexisting with magical beings. And so, with her guide in hand, she continued her journey, always ready to help a creature in need and add another chapter to her extraordinary book.', 'b5.jpg', '1 (5).mp3', '2024-05-24 00:54:13'),
(102, 'Lark and the Wild ', 'Hemers', 100000, 2, 'Once upon a time, in a small village nestled at the edge of an ancient forest, lived a brave young girl named Lark. Lark had always been fascinated by the legends of the Wild Hunt, a spectral group of riders that thundered through the night sky, led by the mysterious Huntsman. The villagers spoke of them in hushed tones, warning of their perilous power.\r\n\r\nOne fateful night, during a full moon, the Wild Hunt swept through the village, their ghostly steeds leaving trails of silver light. Lark, unable to contain her curiosity, followed them into the forest. She was determined to uncover the truth behind the legends.\r\n\r\nAs she ventured deeper into the woods, she stumbled upon an injured stag with shimmering antlers. The stag, sensing Lark\'s kind heart, spoke to her. He revealed that he was the Huntsman\'s steed, cursed to remain in the mortal realm unless someone with a pure heart could break the spell.\r\n\r\nLark, filled with compassion, agreed to help. The stag told her she needed to find the Enchanted Harp hidden in the heart of the forest. With its music, she could summon the Huntsman and plead for his mercy.\r\n\r\nHer journey was fraught with challenges. She navigated through dark, tangled woods, solved riddles posed by enchanted trees, and outwitted mischievous forest spirits. Finally, she reached a hidden grove where the Enchanted Harp rested atop a stone pedestal.\r\n\r\nWith trembling hands, Lark played the harp. Its melodious notes echoed through the forest, summoning the Wild Hunt. The Huntsman appeared, towering and formidable. Lark bravely stepped forward and pleaded for the stag\'s freedom.\r\n\r\nMoved by her courage and purity, the Huntsman lifted the curse, transforming the stag back into his loyal steed. As a gesture of gratitude, he granted Lark a boon. She wished for protection for her village and harmony with the forest.\r\n\r\nFrom that day on, the village thrived, safeguarded by the magic of the Wild Hunt. Lark\'s bravery became legend, and she was known as the girl who tamed the Wild Hunt, bringing peace between her village and the enchanted forest.', 'b6.jpg', '1 (6).mp3', '2024-05-24 00:55:50'),
(103, 'The Misadventures', 'Nim', 55000, 2, 'Once upon a time, in a quaint town filled with charming streets and curious characters, lived a spirited young witch named Salem Hyde. Salem was not your typical witch; she was known for her mischievous nature and tendency to get into trouble. Despite her best intentions, her spells often went hilariously awry.\r\n\r\nOne sunny morning, Salem decided to practice a new spell to make her cat, Whammy, talk. She thought it would be fun to have a chatty companion. With her spellbook open and her wand in hand, she chanted the incantation. But instead of making Whammy talk, the spell turned every animal in the town into a talking creature!\r\n\r\nChaos ensued as dogs debated philosophy, birds sang opera, and squirrels argued over acorns. The townspeople were bewildered and overwhelmed by the sudden chorus of animal voices. Realizing her mistake, Salem knew she had to fix it before the town descended into complete madness.\r\n\r\nSalem sought advice from her wise and somewhat grumpy mentor, Professor Batwing. He told her that to reverse the spell, she needed to find the rare Moonflower, which only bloomed at midnight in the deepest part of the Whispering Woods.\r\n\r\nDetermined to set things right, Salem and Whammy, who was quite enjoying his newfound voice, ventured into the Whispering Woods. Along the way, they encountered various magical creatures, including a grumpy troll who guarded a bridge and a mischievous sprite who loved playing tricks. Using her quick thinking and a bit of magic, Salem managed to befriend these creatures and gain their help.\r\n\r\nAs the clock struck midnight, they found the Moonflower glowing under the moonlight. Carefully, Salem plucked the flower and hurried back to town. She brewed a potion with the Moonflower and sprinkled it over the town. Slowly, the animals\' chatter faded, and they returned to their natural, silent state.\r\n\r\nThe townspeople cheered and thanked Salem, who had learned an important lesson about the responsibility that comes with magic. Despite her misadventures, she was loved for her big heart and unyielding spirit. From that day on, Salem continued to practice her magic, but with a bit more caution and a lot more wisdom. And though her spells still sometimes went awry, they always led to new adventures and lessons learned.', 'b8.jpg', '1 (8).mp3', '2024-05-24 00:58:33'),
(104, 'Nightmares!', 'Nemo', 40000, 3, 'Once upon a time, in the small town of Moonlight Hollow, there was a girl named Lily who suffered from terrible nightmares. Every night, she would toss and turn, plagued by visions of dark creatures and looming shadows. No matter how hard she tried, she couldn\'t escape the grip of her terrifying dreams.\r\n\r\nDetermined to find a solution, Lily embarked on a quest to confront her nightmares head-on. With the help of her loyal cat, Midnight, who seemed to understand her troubles, she ventured into the realm of dreams.\r\n\r\nIn this mysterious world, Lily encountered all sorts of strange and frightening creatures that seemed to be born from her deepest fears. But instead of running away, she faced them bravely, armed with courage and determination.\r\n\r\nAs she journeyed deeper into the dream realm, she discovered that her nightmares were not just random terrors, but manifestations of her own insecurities and worries. With each confrontation, Lily learned to confront and overcome her fears, gaining strength and confidence along the way.\r\n\r\nFinally, at the heart of the dream realm, Lily confronted the source of her nightmares: a shadowy figure that whispered doubts and anxieties into her ear. With a deep breath and steady resolve, Lily banished the figure with a burst of light from within herself.\r\n\r\nWaking up with a sense of peace she hadn\'t felt in years, Lily realized that she had conquered her nightmares once and for all. From that night on, she slept soundly, knowing that she had the power to overcome any darkness that tried to haunt her dreams.\r\n\r\nAnd as she drifted off to sleep each night, she whispered a quiet thank you to Midnight, her faithful companion who had guided her through the darkness and into the light.', 'b9.jpg', '1 (9).mp3', '2024-05-24 01:06:54'),
(105, 'Wonders of Wizardry ', 'Zim', 40000, 3, 'In the bustling city of Arcane Alley, nestled between towering spires and hidden behind veils of magic, lay the entrance to the Wonders of Wizardry World. It was a place where enchantment danced in every corner and mysteries awaited behind every door.\r\n\r\nAt the heart of this magical marketplace stood a young wizard named Finn. With a twinkle in his eye and a wand at his side, Finn was the keeper of wonders, the curator of curiosities, and the guide to all who sought the marvels of the wizarding world.\r\n\r\nEvery day, visitors from far and wide wandered through the winding streets of Arcane Alley, drawn by whispers of wonders and tales of enchantment. They marveled at the shimmering potions in the Apothecary, where vials of liquid dreams and bottles of starlight lined the shelves.\r\n\r\nThey gasped in awe at the flying broomsticks in the Quidditch Emporium, where the latest models soared gracefully through the air. They laughed at the antics of the mischievous magical creatures in the Menagerie, where unicorns pranced and phoenixes sang.\r\n\r\nBut the true heart of Wonders of Wizardry World lay in the Library of Spells, a vast repository of ancient tomes and forbidden grimoires. Here, aspiring witches and wizards delved into the secrets of magic, seeking knowledge and enlightenment.\r\n\r\nFinn was their guide, their mentor, and their friend, always ready with a word of wisdom or a flick of his wand to aid those in need. And though the path to mastery was long and winding, Finn knew that with determination and a dash of magic, anything was possible.\r\n\r\nAs the sun set over Arcane Alley, casting long shadows across the cobblestone streets, Finn closed the doors of the Wonders of Wizardry World with a satisfied smile. For in this magical realm of endless possibility, every day was a new adventure, and every visitor left with a spark of wonder in their eyes.', 'b10.jpg', '1 (10).mp3', '2024-05-24 01:10:55'),
(106, 'Magical Journeys ', 'Helen', 50000, 3, 'In the quaint town of Everbright, nestled amid rolling hills and whispering forests, there lived a young girl named Elara who possessed a special gift: a boundless imagination that could turn the ordinary into the extraordinary.\r\n\r\nElara\'s days were filled with wonder as she embarked on magical journeys within the realm of her own imagination. With a flick of her wand (or perhaps just a twig she found on the ground), she would transform her backyard into a mystical forest where fairies danced among the flowers and talking animals whispered secrets in her ear.\r\n\r\nOne day, as she wandered through the enchanted woods of her mind, Elara stumbled upon a hidden pathway. Intrigued, she followed it deeper and deeper into the heart of her imagination, where wonders beyond her wildest dreams awaited.\r\n\r\nShe sailed across oceans of stars in a ship made of moonlight, accompanied by a crew of friendly constellations. She soared through the sky on the back of a magnificent phoenix, feeling the wind in her hair and the thrill of freedom in her heart.\r\n\r\nShe journeyed to far-off lands where dragons guarded ancient treasures and wizards dueled beneath the light of a thousand moons. She danced with faeries in a glittering ballroom where time stood still and dreams came to life.\r\n\r\nBut amidst all the wonders and adventures, Elara discovered that the true magic lay not in the places she visited or the creatures she met, but in the power of her own imagination to create beauty and wonder wherever she went.\r\n\r\nAnd so, as the sun set on another day in Everbright, Elara returned home, her heart full of memories and her mind teeming with new stories to tell. For in the world of her imagination, the possibilities were endless, and the adventures were only just beginning.', 'b11.jpg', '1 (11).mp3', '2024-05-24 01:13:18'),
(107, 'My Magical Fairyland', 'gelena', 50000, 3, 'In the heart of a lush, verdant forest, there existed a magical realm known as Fairyland, where shimmering streams flowed with liquid silver and the air was filled with the sweet scent of blossoms. In this enchanted land, there lived a young girl named Lily, whose heart was as pure as the morning dew.\r\n\r\nLily\'s days were filled with joy and wonder as she frolicked among the flowers and danced with the butterflies. But what made her days truly magical were her friends—the creatures of Fairyland who welcomed her with open arms.\r\n\r\nFirst, there was Twinkle, a mischievous sprite with a laugh like tinkling bells. Twinkle loved to play pranks on the other forest dwellers, but beneath his playful exterior lay a heart of gold.\r\n\r\nThen there was Blossom, a gentle faerie whose wings shimmered with every color of the rainbow. Blossom had a talent for healing and would often soothe the wounds of the forest creatures with her gentle touch.\r\n\r\nNext was Spark, a fiery phoenix whose feathers glowed with the light of a thousand suns. Spark was fiercely loyal to his friends and would protect them with his fiery breath whenever danger lurked nearby.\r\n\r\nAnd finally, there was Luna, a wise old owl whose golden eyes held the secrets of the universe. Luna would often regale Lily with tales of distant lands and ancient legends, filling her young mind with knowledge and wisdom.\r\n\r\nTogether, Lily and her friends would embark on grand adventures, exploring every corner of Fairyland and uncovering its many mysteries. They would climb to the highest peaks and dive to the deepest depths, always guided by the light of friendship and the power of love.\r\n\r\nAnd as the sun set on another magical day in Fairyland, Lily would bid her friends farewell, knowing that they would always be there for her whenever she needed them. For in the land of dreams and imagination, true friendship was the greatest magic of all.', 'b12.jpg', '1 (12).mp3', '2024-05-24 01:14:49'),
(110, 'The Honest Woodcutte', 'Anna', 50000, 1, 'In a quaint village nestled among the trees, there lived a woodcutter named Jack. Known for his honesty and hard work, Jack spent his days chopping wood in the forest to provide for his family. One sunny morning, while chopping wood by the riverbank, Jack\'s axe slipped from his hand and fell into the water with a splash.\r\n\r\nHeartbroken, Jack watched as his only means of livelihood disappeared beneath the surface. Just as he was about to give up hope, a shimmering figure emerged from the water – a fairy adorned in ethereal robes.\r\n\r\nMoved by Jack\'s sincerity, the fairy offered to retrieve his lost axe. With a wave of her hand, she dived into the river and reemerged, holding not just Jack\'s axe but a golden one as well.\r\n\r\nOverwhelmed with gratitude, Jack thanked the fairy profusely. But the fairy, impressed by his honesty, insisted that he keep both axes as a reward. Touched by her generosity, Jack promised to use his newfound wealth to help those in need.\r\n\r\nFrom that day on, Jack\'s honesty and kindness spread far and wide. He used the golden axe wisely, improving his family\'s life and supporting the villagers in times of need. And as for the fairy, she continued to watch over Jack, blessing him with good fortune and happiness for the rest of his days.', 'b18.jpg', '1.mp3', '2024-05-24 01:28:18'),
(112, '36 The Power of Beli', 'Gin', 50000, 1, 'In a peaceful village at the edge of an ancient forest, there lived a young girl named Emily. Emily was small and shy, but she had a heart full of dreams. She often spent her days wandering the village, watching others achieve great things and wishing she could do the same.\r\n\r\nOne day, Emily heard about a magical well hidden deep within the forest. Legend said that anyone who truly believed in themselves and made a wish at the well would see their dreams come true. Determined to prove the legend true, Emily set out on a journey to find the well.\r\n\r\nThe forest was dense and filled with challenges. Emily faced thorny bushes, crossed bubbling streams, and climbed steep hills. Each obstacle tested her resolve, but she kept going, driven by her belief in the magic of the well and her own dreams.\r\n\r\nAfter a long, arduous journey, Emily finally found the well, shimmering in a small clearing. With a hopeful heart, she closed her eyes, made a wish, and whispered, \"I wish to be brave and accomplish great things.\"\r\n\r\nAs she opened her eyes, Emily didn\'t see any immediate change, but she felt a new sense of confidence blossoming within her. She returned to the village, feeling different. Emily began to approach challenges with a newfound courage. She helped rebuild a neighbor\'s home, taught younger children to read, and even stood up to speak at the village meetings.\r\n\r\nThe villagers noticed the remarkable change in Emily. They admired her bravery and determination. One day, an elderly villager approached her and said, \"Emily, what changed? How did you become so brave?\"\r\n\r\nEmily smiled and replied, \"I believed in myself. I found the power of belief within me.\"\r\n\r\nFrom that day on, Emily\'s story spread throughout the village, inspiring others to believe in themselves and their dreams. The legend of the magical well became a reminder that true magic lies in the power of belief and the courage to pursue one\'s dreams. And Emily, once a shy and small girl, became a symbol of the light.', 'b19.jpg', '1(19).mp3', '2024-05-24 19:49:08'),
(113, 'Father and son ', 'Ama', 55000, 1, 'In a small, charming village surrounded by rolling hills, there lived a father named Thomas and his young son, Leo. Thomas was a skilled carpenter, known for his beautiful handcrafted furniture. He loved teaching Leo the art of woodworking, sharing not just skills but also life lessons.\r\n\r\nOne day, Thomas decided it was time for Leo to create something of his own. He handed Leo a block of wood and said, \"Son, make something special, something that shows who you are.\" Excited but nervous, Leo began working. He measured, cut, sanded, and carved, often seeking his father\'s guidance.\r\n\r\nAs days turned into weeks, Leo\'s project took shape. He faced challenges – pieces didn\'t fit, cuts were uneven, and there were moments of frustration. Each time, Thomas was there to encourage him, saying, \"Remember, patience and persistence are the keys to mastery.\"\r\n\r\nFinally, after much effort, Leo completed his project. It was a beautiful, intricately carved box. Proudly, he presented it to his father. Thomas examined it closely, smiling warmly. \"This is wonderful, Leo. You\'ve done a great job.\"\r\n\r\nLeo beamed with pride. \"I couldn\'t have done it without you, Dad. You taught me everything.\"\r\n\r\nThomas hugged his son and said, \"Remember, it\'s not just about the finished piece, but the journey and what you learn along the way. You have shown patience, determination, and creativity – qualities that will guide you through life.\"\r\n\r\nFrom that day on, the bond between Thomas and Leo grew even stronger. They continued to work side by side, creating not just beautiful furniture, but lasting memories and invaluable life skills. And Leo learned that with his father\'s support and his own perseverance, he could achieve anything he set his mind to.', 'b21.jpg', '1(18).mp3', '2024-05-24 19:55:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `book_id` int(20) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(20) NOT NULL,
  `image` varchar(25) NOT NULL,
  `quantity` int(25) NOT NULL,
  `total` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `book_id`, `user_id`, `name`, `price`, `image`, `quantity`, `total`, `date`) VALUES
(173, 105, 51, 'Wonders of Wizardry ', 40000, 'b10.jpg', 1, 40, '2024-05-24 20:05:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id_category`, `name`, `id_parent`) VALUES
(1, 'Knowledge', 0),
(2, 'Magic', 0),
(3, 'Adventure', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `confirm_order`
--

CREATE TABLE `confirm_order` (
  `order_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(12) NOT NULL,
  `address` varchar(500) NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `total_books` varchar(500) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL DEFAULT 'pending',
  `date` varchar(20) NOT NULL,
  `total_price` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `confirm_order`
--

INSERT INTO `confirm_order` (`order_id`, `user_id`, `name`, `email`, `number`, `address`, `payment_method`, `total_books`, `order_date`, `payment_status`, `date`, `total_price`) VALUES
(40, 66, 'Kiều Đặng Bảo Sơn', 'baooson3005@gmail.com', '0391123112', 'Phố Vũ Tông Phan, Phường Khương Trung, Quận Thanh Xuân, Hà Nội, Việt Nam', 'Cash on delivery', ' 36 The Power of Beli #112,(2)  The Honest Woodcutte #110,(1)  Wonders of Wizardry  #105,(1)  The Misadventures #103,(1)  Magical Journeys  #106,(1) ', '27-05-2024', 'cancel', '', 295000),
(43, 66, 'Kiều Đặng Bảo Sơn', 'chinchin@gmail.com', '0391123112', '3/235 Ngõ 235 Yên Hòa, Phường Yên Hòa, Quận Cầu Giấy, Hà Nội, Việt Nam', 'Cash on delivery', ' Dragons in a Bag #99,(1) ', '27-05-2024', 'pending', '', 50000),
(44, 66, 'Son', 'admin@gmail.com', '0391123112', 'Đường 325 Vũ Tông Phan, Phường Khương Đình, Quận Thanh Xuân, Hà Nội, Việt Nam', 'Cash on delivery', ' Father and son  #113,(1) ', '27-05-2024', 'pending', '', 55000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `msg`
--

CREATE TABLE `msg` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(55) NOT NULL,
  `number` varchar(20) NOT NULL,
  `msg` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `msg`
--

INSERT INTO `msg` (`id`, `user_id`, `name`, `email`, `number`, `msg`, `date`) VALUES
(10, 51, 'Chin', 'pawan@gmail.com1', '12345', 'nope nope', '2024-05-24 00:23:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `book` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` int(10) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `id_order`, `user_id`, `book`, `quantity`, `subtotal`, `total`) VALUES
(1, 40, 66, '36 The Power of Beli', 2, 50000, 100000),
(2, 40, 66, 'The Honest Woodcutte', 1, 50000, 50000),
(3, 40, 66, 'Wonders of Wizardry ', 1, 40000, 40000),
(4, 40, 66, 'The Misadventures', 1, 55000, 55000),
(5, 40, 66, 'Magical Journeys ', 1, 50000, 50000),
(6, 43, 66, 'Dragons in a Bag', 1, 50000, 50000),
(7, 44, 66, 'Father and son ', 1, 55000, 55000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users_info`
--

CREATE TABLE `users_info` (
  `Id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users_info`
--

INSERT INTO `users_info` (`Id`, `name`, `surname`, `email`, `password`, `user_type`) VALUES
(52, 'admin', 'admin', 'admin@gmail.com', '12345678', 'Admin'),
(62, 'miu', 'mi', 'mimi@gmail.com', '12345', 'Admin'),
(65, 'admin3', 'adminn', 'admin3@gmail.com', '1234', 'User'),
(66, 'Sơn', 'son', 'son@gmail.com', '123', 'User'),
(67, 'son', 'son', 'son@gmail.com', '123', 'Admin');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `book_info`
--
ALTER TABLE `book_info`
  ADD PRIMARY KEY (`bid`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Chỉ mục cho bảng `confirm_order`
--
ALTER TABLE `confirm_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `book_info`
--
ALTER TABLE `book_info`
  MODIFY `bid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT cho bảng `confirm_order`
--
ALTER TABLE `confirm_order`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `msg`
--
ALTER TABLE `msg`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `users_info`
--
ALTER TABLE `users_info`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
