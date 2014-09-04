-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 04-Set-2014 às 12:14
-- Versão do servidor: 5.5.38-35.2-log
-- versão do PHP: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de Dados: `anamaria_amm_sandbox`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `author_collection_editions`
--

DROP TABLE IF EXISTS `author_collection_editions`;
CREATE TABLE IF NOT EXISTS `author_collection_editions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `work` int(10) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `prefix` varchar(10) DEFAULT NULL,
  `uri` varchar(200) NOT NULL,
  `editor` int(10) unsigned NOT NULL,
  `country` varchar(2) NOT NULL,
  `serie` int(10) unsigned DEFAULT NULL,
  `pages` int(3) unsigned DEFAULT NULL,
  `cover` varchar(250) DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `illustrator` varchar(200) DEFAULT NULL,
  `cover_designer` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uri` (`illustrator`),
  KEY `story` (`work`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=182 ;

--
-- Extraindo dados da tabela `author_collection_editions`
--

INSERT INTO `author_collection_editions` (`id`, `work`, `title`, `prefix`, `uri`, `editor`, `country`, `serie`, `pages`, `cover`, `isbn`, `illustrator`, `cover_designer`) VALUES
(1, 2, 'Recado do Nome', '', 'recado-do-nome', 21, 'BR', NULL, 208, 'recado_do_nome_1252309458.jpg', '8520915981', NULL, NULL),
(2, 3, 'Alice e Ulisses', '', 'alice-e-ulisses', 22, 'BR', NULL, 96, 'alice_e_ulisses002_1340656842.jpg', '9788579621260', NULL, NULL),
(3, 4, 'Tropical Sol da Liberdade', '', 'tropical-sol-da-liberdade', 22, 'BR', NULL, 371, 'tropical001_1340660196.jpg', '9788579621291', NULL, NULL),
(4, 5, 'Canteiros de Saturno', '', 'canteiros-de-saturno', 12, 'BR', NULL, 304, 'canteiros.jpg', ' 9788579621642', NULL, NULL),
(5, 6, 'Aos Quatro Ventos', '', 'aos-quatro-ventos', 21, 'BR', NULL, 159, 'aos_quatro_ventos_1256119545.jpg', '9788520921326', NULL, NULL),
(6, 7, 'Mar Nunca Transborda', 'O', 'o-mar-nunca-transborda', 22, 'BR', NULL, 240, 'o mar nunca transborda2.jpg', '9788579622113', NULL, NULL),
(7, 8, 'Audácia Dessa Mulher', 'A', 'a-audacia-dessa-mulher', 12, 'BR', NULL, 201, 'audacia.jpg', '9788579620843', NULL, NULL),
(8, 9, 'Para sempre', '', 'para-sempre', 22, 'BR', NULL, NULL, 'para_sempre001_1340658250.jpg', NULL, NULL, NULL),
(9, 10, 'Banho Sem Chuva', '', 'banho-sem-chuva', 25, 'BR', 1, 24, 'banhosemchuva_1253232569.gif', '8528101843', 'Claudius Ceccon', NULL),
(11, 13, 'Palavra de Honra', '', 'palavra-de-honra', 12, 'BR', NULL, 168, 'palavra_de_honra.jpg', ' 9788579622120', NULL, NULL),
(12, 15, 'Infâmia', '', 'infamia', 12, 'BR', NULL, 280, 'infamia001.jpg', '9788579620645', NULL, NULL),
(13, 19, 'Silenciosa Algazarra', '', 'silenciosa-algazarra', 7, 'BR', NULL, 290, 'silenciosa_algazarra.jpg', '9788535918823', NULL, NULL),
(15, 21, 'Boladas e Amigos', '', 'boladas-e-amigos', 25, 'BR', 1, 24, 'boladas.jpg', '9788516082512', 'Claudius Ceccon', NULL),
(16, 22, 'Brincadeira de Sombra', '', 'brincadeira-de-sombra', 15, 'BR', NULL, 16, 'brincadeiradesombra.jpg', '852600736X', 'Marilda Castanha', NULL),
(17, 23, 'Cabe na Mala', '', 'cabe-na-mala', 25, 'BR', 1, 24, 'cabe na mala001.jpg', '9788516072964', 'Claudius Ceccon', NULL),
(18, 24, 'Com Prazer e Alegria', '', 'com-prazer-e-alegria', 25, 'BR', 1, 24, 'comprazerealegria.gif', '8528101959', 'Claudius Ceccon', NULL),
(19, 25, 'Dia de Chuva', '', 'dia-de-chuva', 25, 'BR', NULL, 32, 'diadechuva.jpg', '8516031209', 'Nelson Cruz', NULL),
(20, 26, 'Eu era um Dragão', '', 'eu-era-um-dragao', 15, 'BR', NULL, 13, 'eu_era_um_dragao.jpg', '8526007378', 'Marilda Castanha', NULL),
(21, 27, 'Fim de semana', '', 'fim-de-semana', 20, 'BR', 2, 32, 'fim_de_semana.jpg', '9788516085476', 'Maria José Arce', NULL),
(22, 28, 'Fome Danada', '', 'fome-danada', 25, 'BR', 1, 24, 'fome_danada001.jpg', '9788516084653', 'Claudius Ceccon', NULL),
(23, 29, 'Maré Baixa, Maré Alta', '', 'mare-baixa-mare-alta', 15, 'BR', NULL, 16, 'marebaixamarealta.jpg', '8526007386', 'Marilda Castanha', NULL),
(24, 30, 'Menino Poti', '', 'menino-poti', 25, 'BR', 1, 24, 'menino poti001.jpg', '9788516072957', 'Claudius Ceccon', NULL),
(25, 31, 'Mico Maneco', '', 'mico-maneco', 25, 'BR', 1, 24, 'mico maneco001.jpg', '9788516072940', 'Claudius Ceccon', NULL),
(26, 32, 'No Barraco do Carrapato', '', 'no-barraco-do-carrapato', 25, 'BR', 1, 24, 'nobarracodocarrapato.gif', '8528101584', 'Claudius Ceccon', NULL),
(27, 33, 'No Imenso Mar Azul', '', 'no-imenso-mar-azul', 25, 'BR', 1, 24, 'noimensomarazul.jpg', '8528101800', 'Claudius Ceccon', NULL),
(28, 34, 'Palhaço Espalhafato', 'O', 'o-palhaco-espalhafato', 25, 'BR', 1, 24, 'opalhacoespalhafato.jpg', '8528101835', 'Claudius Ceccon', NULL),
(29, 35, 'Pena de Pato e de Tico-tico', '', 'pena-de-pato-e-de-tico-tico', 25, 'BR', 1, 24, 'penadepatoedeticotico.gif', '8528101371', 'Claudius Ceccon', NULL),
(31, 37, 'Quando eu crescer...', '', 'quando-eu-crescer', 20, 'BR', 2, 32, 'quando_eu_crescer001.jpg', '9788516085483', 'Maria José Arce', NULL),
(32, 38, 'Quem sou eu?', '', 'quem-sou-eu', 20, 'BR', 2, 24, 'quem_sou_eu001.jpg', '9788516085490', 'Maria José Arce', NULL),
(33, 39, 'Rato Roeu a Roupa', 'O', 'o-rato-roeu-a-roupa', 25, 'BR', 1, 24, 'oratoroeuaroupa.jpg', '8528101592', 'Claudius Ceccon', NULL),
(34, 40, 'Surpresa na Sombra', '', 'surpresa-na-sombra', 25, 'BR', 1, 24, 'surpresanasombra.jpg', '8528101967', 'Claudius Ceccon', NULL),
(35, 41, 'Tatu Bobo', '', 'tatu-bobo', 25, 'BR', 1, 24, 'tatu bobo001.jpg', '9788516072933', 'Claudius Ceccon', NULL),
(36, 42, 'Tesouro da Raposa', 'O', 'o-tesouro-da-raposa', 25, 'BR', 1, 24, 'otesourodaraposa.gif', '8528101576', 'Claudius Ceccon', NULL),
(37, 43, 'Troca-Troca', '', 'troca-troca', 25, 'BR', 1, 24, 'troca-troca.jpg', '8528101975', 'Claudius Ceccon', NULL),
(38, 44, 'Dragão no Piquenique', 'Um', 'um-dragao-no-piquenique', 25, 'BR', 1, 24, 'umdragaonopiquenique.gif', ' 8528101991', 'Claudius Ceccon', NULL),
(39, 45, 'Um, dois, três, agora é sua vez!', '', 'um-dois-tres-agora-e-sua-vez', 20, 'BR', 2, 24, 'um_dois_tres001.jpg', ' 9788516085469', 'Maria José Arce', NULL),
(40, 46, 'Arara e Sete Papagaios', 'Uma', 'uma-arara-e-sete-papagaios', 25, 'BR', 1, 24, 'Uma arara e sete papagaios.jpg', '8528101606', 'Claudius Ceccon', NULL),
(41, 47, 'Gota de Mágica', 'Uma', 'uma-gota-de-magica', 25, 'BR', 1, 24, 'uma_gota_magica001.jpg', '9788516084677', 'Claudius Ceccon', NULL),
(44, 48, 'Zabumba do Quati', 'A', 'a-zabumba-do-quati', 25, 'BR', NULL, 24, 'azabumbadoquati.gif', '8528101819', NULL, NULL),
(45, 49, 'Alguns Medos e Seus Segredos', '', 'alguns-medos-e-seus-segredos', 15, 'BR', NULL, 40, 'alguns_medos_e_seus_segredos.jpg', '9788526013773', NULL, 'Alcy Linares'),
(46, 50, 'Arara e o Guaraná', 'A', 'a-arara-e-o-guarana', 3, 'BR', 3, 24, 'araraguarana.jpg', '8508055218', 'Mariângela Haddad', NULL),
(47, 51, 'Avental Que o Vento Leva', '', 'avental-que-o-vento-leva', 3, 'BR', 3, 32, 'avental_vento_leva.jpg', '9788508047130', 'Helena Alexandrino', NULL),
(48, 52, 'Balas, Bombons, Caramelos', '', 'balas-bombons-caramelos', 20, 'BR', 4, 22, 'balas_bombons_e_caramelos.jpg', '9788516061715', 'Elisabeth Teixeira', NULL),
(49, 53, 'Besouro e Prata', '', 'besouro-e-prata', 3, 'BR', 3, 22, 'besouro_prata.jpg', '8508047150', ' Clara Gavilan', NULL),
(50, 54, 'Beto, o Carneiro', '', 'beto-o-carneiro', 25, 'BR', 5, 32, 'beto_ocarneiro.jpg', '9788516069117', 'Jean-Claude R. Alphen', NULL),
(51, 55, 'Camilão, o Comilão', '', 'camilao-o-comilao', 25, 'BR', 5, 30, 'camilao.jpg', '9788516069452', 'Cláudio Martins', NULL),
(52, 56, 'Currupaco Papaco', '', 'currupaco-papaco', 25, 'BR', 5, 32, 'currupaco.jpg', '9788516069469', 'Alcy', NULL),
(53, 57, 'Curvo ou reto: olhar secreto', '', 'curvo-ou-reto-olhar-secreto', 15, 'BR', 6, 32, 'curvo_reto.jpg', '9788526014923', NULL, 'Luísa Baeta'),
(54, 58, 'Dedo Mindinho', '', 'dedo-mindinho', 20, 'BR', NULL, 34, 'dedomindinho.jpg', '8516022234', 'Rogério Borges', NULL),
(55, 59, 'Dia Desses', 'Um', 'um-dia-desses', 3, 'BR', 3, 34, 'um_dia_desses.jpg', '8508062117', 'Lula', NULL),
(56, 60, 'Distraído Sabido', 'O', 'o-distraido-sabido', 25, 'BR', 5, 30, 'distraidosabido.jpg', '9788516069391', 'Cris Eich', NULL),
(57, 61, 'Dorotéia, a Centopéia', '', 'doroteia-a-centopeia', 25, 'BR', 5, 22, 'doroteia_acentopeia.jpg', '8528100367', 'Eva Furnari', NULL),
(58, 62, 'Elefantinho Malcriado', 'O', 'o-elefantinho-malcriado', 20, 'BR', NULL, 36, 'elefantinho.jpg', '9788516061708', 'Elisabeth Teixeira', NULL),
(59, 63, 'Elfo e a Sereia', 'O', 'o-elfo-e-a-sereia', 15, 'BR', NULL, 32, 'elfo_sereia.jpg', '9788526014640', 'Elma', NULL),
(60, 64, 'Era Uma Vez Três', '', 'era-uma-vez-tres', 5, 'BR', NULL, 41, 'era_uma_vez_tres.jpg', '9788586387128', 'Volpi', NULL),
(61, 65, 'Esta Casa é Minha', '', 'esta-casa-e-minha', 20, 'BR', NULL, 33, 'esta_casa_e_minha.jpg', '9788516061746', 'Elisabeth Teixeira', NULL),
(62, 66, 'Galinha Que Criava Um Ratinho', 'A', 'a-galinha-que-criava-um-ratinho', 3, 'BR', 3, 24, 'galinharatinho.jpg', '9788508055616', 'Mariana Massarani', NULL),
(64, 70, 'Gato do Mato e o Cachorro do Morro', 'O', 'o-gato-do-mato-e-o-cachorro-do-morro', 3, 'BR', 3, 24, 'gatodomato.jpg', '9788508127658', 'Fê', NULL),
(65, 71, 'Gato Massamê e Aquilo Que Ele Vê', 'O', 'o-gato-massame-e-aquilo-que-ele-ve', 3, 'BR', 3, 24, 'gato_massame.jpg', '9788508047147', 'Jean-Claude R. Alphen', NULL),
(66, 72, 'Gente, Bicho, Planta: o Mundo me Encanta', '', 'gente-bicho-planta-o-mundo-me-encanta', 15, 'BR', NULL, 37, 'gente_bicho_planta.jpg', '9788526013704', 'Maurício Negro', NULL),
(67, 73, 'Grande Aventura de Maria Fumaça', 'A', 'a-grande-aventura-de-maria-fumaca', 15, 'BR', NULL, 20, 'a_grande_aventura_de_maria_fumaca.jpg', '8526008773', 'Suppa', NULL),
(68, 74, 'Jabuti Sabido e Macaco Metido', '', 'jabuti-sabido-e-macaco-metido', 21, 'BR', NULL, 40, 'jabutisabidomacacometido.jpg', '9788579620751', 'Raul Gastão', NULL),
(69, 75, 'Jararaca, a Perereca e a Tiririca', 'A', 'a-jararaca-a-perereca-e-a-tiririca', 22, 'BR', NULL, 32, 'ajararaca.jpeg', '9788579621093', 'Cecília Esteves', NULL),
(70, 76, 'Jeca, o Tatu', '', 'jeca-o-tatu', 3, 'BR', NULL, 24, 'jeca_o_tatu.jpg', '8508089805', 'Maria Eugênia', NULL),
(71, 77, 'Maravilhosa Ponte do Meu Irmão', 'A', 'a-maravilhosa-ponte-do-meu-irmao', 22, 'BR', NULL, 40, 'amaravilhosaponte.jpg', '9788579620768', 'Bruna Assis Brasil', NULL),
(72, 78, 'Maria Sapeba', '', 'maria-sapeba', 3, 'BR', 3, 24, 'maria_sapeba.jpg', '8508060661', 'Marilda Castanha', NULL),
(73, 79, 'Mas Que Festa!', '', 'mas-que-festa', 12, 'BR', NULL, 32, 'masquefesta.jpg', '9788579622168', 'Cláudio Martins', NULL),
(74, 80, 'Menina Bonita do Laço de Fita', '', 'menina-bonita-do-laco-de-fita', 3, 'BR', 3, 24, 'menina_bonita.jpg', '8508066392', 'Claudius', NULL),
(75, 81, 'Meu Reino por um Cavalo', '', 'meu-reino-por-um-cavalo', 15, 'BR', NULL, 23, 'meu_reino_por_um_cavalo.jpg', '8526008935', 'Dave Santana e Maurício Paraguassu', NULL),
(76, 82, 'Minhoca da Sorte', 'A', 'a-minhoca-da-sorte', 20, 'BR', 4, 36, 'a_minhoca_da_sorte.jpg', '9788516061722', 'Elisabeth Teixeira', NULL),
(77, 83, 'Natal de Manuel', 'O', 'o-natal-de-manuel', 15, 'BR', NULL, 32, 'o_natal_de_manuel.jpg', '9788526013254', 'Cecilia Esteves', NULL),
(78, 84, 'Pavão do Abre-e-Fecha', 'O', 'o-pavao-do-abre-e-fecha', 3, 'BR', 3, 24, 'o_pavao_do_abre_e_fecha.jpg', '8508069324', 'Bruno Nunes', NULL),
(79, 85, 'Quem foi que fez?', '', 'quem-foi-que-fez', 15, 'BR', 6, 32, 'quemfoiquefez001.jpg', '9788526016545', NULL, 'Luísa Baeta'),
(81, 87, 'Quem Perde Ganha', '', 'quem-perde-ganha', 15, 'BR', NULL, 40, 'quem_perde_ganha.jpg', '9788526013049', 'Cris Eich', NULL),
(82, 88, 'Quenco, o Pato', '', 'quenco-o-pato', 3, 'BR', 3, 22, 'quenco_o_pato.jpg', '8509089783', 'Alcy ', NULL),
(83, 89, 'Quem me Dera', '', 'quem-me-dera', 3, 'BR', 3, 32, 'quemmedera.jpg', '9788508128587', 'Mariângela Haddad', NULL),
(84, 90, 'Segredo da Oncinha', 'O', 'o-segredo-da-oncinha', 20, 'BR', NULL, 33, 'o_segredo_da_oncinha.jpg', '8516019217', 'Rogério Borges', NULL),
(85, 91, 'Severino Faz Chover', '', 'severino-faz-chover', 25, 'BR', 5, 30, 'severinofazchover.jpg', '9788516069384', 'Ellen Pestili', NULL),
(86, 92, 'Gato no Telhado', 'Um', 'um-gato-no-telhado', 25, 'BR', 5, 30, 'umgatonotelhado.jpg', '9788516069483', 'Simone Matias', NULL),
(87, 93, 'pra lá, Outro pra cá', 'Um', 'um-pra-la-outro-pra-ca', 20, 'BR', NULL, 36, 'um_pra_la_outro_pra_ca.jpg', '9788516061692', 'Elisabeth Teixeira', NULL),
(88, 95, 'História de Páscoa', 'Uma', 'uma-historia-de-pascoa', 25, 'BR', 5, 22, 'umahistoriadepascoa.jpg', '9788516069100', 'Adilson Farias', NULL),
(89, 96, 'Noite Sem Igual', 'Uma', 'uma-noite-sem-igual', 9, 'BR', NULL, 20, 'umanoite.jpg', '8500428619', 'Fernando Nunes', NULL),
(90, 97, 'Velha Misteriosa', 'A', 'a-velha-misteriosa', 25, 'BR', 5, 30, 'velhamisteriosa.jpg', '9788516069407', 'Ionit Zilberman', NULL),
(91, 98, 'Velhinha Maluquete', 'A', 'a-velhinha-maluquete', 20, 'BR', 7, 36, 'avelhinhamaluquete.jpg', '9788516061739', 'Elisabeth Teixeira', NULL),
(92, 99, 'Abrindo Caminho', '', 'abrindo-caminho', 3, 'BR', NULL, 40, 'abrindocaminho.jpg', '8508086725', 'Elisabeth Teixeira', NULL),
(93, 100, 'Beijos Mágicos', '', 'beijos-magicos', 14, 'BR', 8, 32, 'beijos_magicos.jpg', '9788532261991', 'Rogério Coelho', NULL),
(94, 101, 'Bento que Bento é o Frade', '', 'bento-que-bento-e-o-frade', 25, 'BR', NULL, 48, 'bentoquebentoeofrade.jpg', '8516035727', 'Cláudio Martins', NULL),
(95, 102, 'Cadê meu travesseiro?', '', 'cade-meu-travesseiro', 25, 'BR', 9, 24, 'cade_me_travesseiro.jpg', '9788516043452', 'Denise Fraifeld', NULL),
(96, 103, 'Cidade: arte para as crianças', 'A', 'a-cidade-arte-para-as-criancas', 28, 'BR', NULL, 20, 'cidade_arte_para_criancas.jpg', '9879853067', 'Alejandro Xul Solar', NULL),
(97, 104, 'De Carta em Carta', '', 'de-carta-em-carta', 25, 'BR', NULL, 32, 'decartaemcarta.jpg', '8516031225', 'Nelson Cruz', NULL),
(98, 105, 'De Fora da Arca', '', 'de-fora-da-arca', 3, 'BR', 10, 40, 'de_fora_da_arca.jpg', '9788508087327', 'Laurent Cardon', NULL),
(99, 106, 'Delícias e Gostosuras', '', 'delicias-e-gostosuras', 25, 'BR', 9, 24, 'delicias_e_gostosuras.jpg', '8516048241', 'Denise Fraifeld', NULL),
(100, 107, 'Gente Bem Diferente', '', 'gente-bem-diferente', 23, 'BR', NULL, 32, 'gente_bem_diferente.jpg', '8530503538', 'Fabiana Egrejas', NULL),
(101, 108, 'História Meio ao Contrário', '', 'historia-meio-ao-contrario', 3, 'BR', 11, 48, 'historia_meio_ao_contrario.jpg', '850809468X', 'Renato Alancão', NULL),
(102, 109, 'Menino Pedro e seu Boi Voador', 'O', 'o-menino-pedro-e-seu-boi-voador', 3, 'BR', NULL, 32, 'meninopedro.jpg', '8508044747', 'Alexandre Rampazo', NULL),
(103, 110, 'Nas asas do mar', '', 'nas-asas-do-mar', 3, 'BR', 12, 120, 'nas_asas_do_mar.jpg', '9788508146307', 'Florence Breton', NULL),
(104, 111, 'Palavras, Palavrinhas, Palavrões', '', 'palavras-palavrinhas-palavroes', 23, 'BR', 13, 45, 'palavras_palavrinhas_e_palavroes.jpg', '9788532214850', 'Jótah', NULL),
(105, 112, 'Palmas para João Cristiano', '', 'palmas-para-joao-cristiano', 19, 'BR', NULL, 47, 'palmas_para_joao_cristiano.jpg', '8572722076', 'Maria Inês Martins', NULL),
(106, 113, 'Passarinho me Contou', '', 'passarinho-me-contou', 15, 'BR', NULL, 32, 'pasarinho_me_contou.jpg', '9788526013384', 'Lúcia Brandão', NULL),
(107, 114, 'Ponto de Vista', '', 'ponto-de-vista', 18, 'BR', NULL, 40, 'ponto_de_vista.jpg', '8506045851', 'Ziraldo', NULL),
(108, 115, 'Portinholas', '', 'portinholas', 19, 'BR', NULL, 48, 'portinholas.jpg', '8572721789', 'Luísa Baeta e Desenhos de Portinari', NULL),
(109, 116, 'Princesa que Escolhia', 'A', 'a-princesa-que-escolhia', 22, 'BR', NULL, 40, 'a_princesa_que_escolhia.jpg', '9788579621345', 'Mariana Massarani', NULL),
(110, 117, 'Príncipe que Bocejava', 'O', 'o-principe-que-bocejava', 22, 'BR', NULL, 40, 'o_principe.jpg', '9788579621482', 'Taline Schuback', NULL),
(111, 118, 'Procura-se Lobo', '', 'procura-se-lobo', 3, 'BR', NULL, 40, 'procurase_lobo.jpg', '8508095104', 'Laurent Cardon', NULL),
(112, 119, 'Que Lambança!', '', 'que-lambanca', 25, 'BR', 9, 22, 'que_lambanca.jpg', '8516043444', 'Denise Fraifeld', NULL),
(113, 120, 'Senhora dos Mares', '', 'senhora-dos-mares', 11, 'BR', NULL, 24, 'senhora_dos_mares.jpg', '9788575552872', 'Rafael Polon', NULL),
(114, 121, 'Montão de Unicórnios', 'Um', 'um-montao-de-unicornios', 15, 'BR', NULL, 32, 'um_montao_de_unicornios.jpg', '9788526012837', 'Márcia Széliga', NULL),
(115, 122, 'Natal Que não Termina', 'Um', 'um-natal-que-nao-termina', 25, 'BR', NULL, 32, 'um_natal_que_nao_termina.jpg', '8516039382', 'Miadaira', NULL),
(116, 123, 'Vamos Brincar de Escola ?', '', 'vamos-brincar-de-escola', 25, 'BR', 9, 22, 'vamos_brincar_de_escola.jpg', '8516045757', 'Denise Fraifeld', NULL),
(117, 124, 'Amigo é Comigo', '', 'amigo-e-comigo', 15, 'BR', 0, 136, 'amigo_e_comigo.jpg', '9788526013858', 'Dave Santana e Maurício Paraguassu', NULL),
(118, 125, 'Amigos Secretos', '', 'amigos-secretos', 3, 'BR', 14, 140, 'amigos_secretos.jpg', '9788508090709', 'Laurent Cardon', NULL),
(119, 126, 'Bem do Seu Tamanho', '', 'bem-do-seu-tamanho', 25, 'BR', 0, 64, 'bem_do_seu_tamanho.jpg', '8516035743', 'Mariana Massarani', NULL),
(120, 127, 'Bisa Bia, Bisa Bel', '', 'bisa-bia-bisa-bel', 25, 'BR', 0, 80, 'bisa_bia_bisa_bel.jpg', '9788516055622', 'Mariana Newlands', NULL),
(121, 128, 'Canto da Praça', 'O', 'o-canto-da-praca', 3, 'BR', 14, 112, 'ocantodapraca.jpg', '8508081642', 'Alexandre Coelho', NULL),
(122, 129, 'De Olho nas Penas', '', 'de-olho-nas-penas', 25, 'BR', 0, 64, 'de_olho_nas_penas.jpg', '8516035719', 'Gonzálo Cárcamo', NULL),
(123, 130, 'Do Outro Lado Tem Segredos', '', 'do-outro-lado-tem-segredos', 21, 'BR', 0, 80, 'do_outro_lado.jpg', '9788520917596', 'Guto Lins', NULL),
(124, 131, 'Do Outro Mundo', '', 'do-outro-mundo', 3, 'BR', 14, 125, 'dooutromundo.jpg', '8508081650', 'Lúcia Brandão', NULL),
(125, 132, 'Era Uma Vez Um Tirano', '', 'era-uma-vez-um-tirano', 25, 'BR', 0, 40, 'eraumaveztirano.jpg', '8516035735', 'José Carlos Lollo', NULL),
(126, 133, 'Isso Ninguém Me Tira', '', 'isso-ninguem-me-tira', 3, 'BR', 14, 119, 'issoninguem.jpg', '8508086717', 'Maria Eugênia', NULL),
(127, 134, 'Mensagem para você', '', 'mensagem-para-voce', 3, 'BR', 14, 161, 'mensagem_para_voce.jpg', '9788508113316', 'Cris Eich', NULL),
(128, 135, 'Mistério da Ilha', 'O', 'o-misterio-da-ilha', 3, 'BR', 14, 60, 'o_misterio_da_ilha.jpg', '8508083734', 'Zeflávio Teixeira', NULL),
(129, 136, 'Mistérios do Mar Oceano', '', 'misterios-do-mar-oceano', 15, 'BR', 0, 112, 'misterios_do_mar_oceano.jpg', '9788526014183', 'Rogério Soud', NULL),
(130, 137, 'Raul da Ferrugem Azul', '', 'raul-da-ferrugem-azul', 25, 'BR', 0, 64, 'rauldaferrugemazul.jpg', '851603481X', 'Rosana Faría', NULL),
(131, 138, 'Tudo Ao Mesmo Tempo Agora', '', 'tudo-ao-mesmo-tempo-agora', 3, 'BR', 14, 154, 'tudo_ao_mesmo_tempo_agora.jpg', '9788508089581', NULL, NULL),
(132, 139, 'Vontade Louca', 'Uma', 'uma-vontade-louca', 3, 'BR', 14, 126, 'uma_vontade_louca.jpg', '9788508110568', 'Ana Maria Moura', NULL),
(133, 140, 'Fiz Voar o meu Chapéu', '', 'fiz-voar-o-meu-chapeu', 13, '', 0, 23, 'fizvoaromeuchapeu.jpg', '8572082395', 'Zeflávio Teixeira', NULL),
(134, 141, 'Hoje Tem Espetáculo', '', 'hoje-tem-espetaculo', 22, '', 0, 128, 'hojetemespetaculo.jpg', '9788579622311', 'Simone Matias', NULL),
(135, 142, 'Peleja', 'A', 'a-peleja', 5, '', 15, 48, 'a_peleja.jpg', '9788586387951', NULL, NULL),
(136, 143, 'Três Mosqueteiros', 'Os', 'os-tres-mosqueteiros', 15, '', 16, 90, 'tresmosqueteiros.jpg', '9788526015555', 'Alan Rabelo', NULL),
(137, 144, 'Avião e uma Viola', 'Um', 'um-aviao-e-uma-viola', 13, '', 0, 36, 'um_aviao.jpg', '9788572081603', 'Mariângela Haddad', NULL),
(138, 148, 'ABC do Brasil', '', 'abc-do-brasil', 26, 'BR', 0, 48, 'abc_dobrasil.jpg', '9788576752295', 'Gonzálo Cárcamo', NULL),
(139, 149, 'Anjos Pintores', 'Os', 'os-anjos-pintores', 5, 'BR', 0, 48, 'osanjospintores.gif', ' 9788586387166', ' Ana Rita Bueno', NULL),
(140, 150, 'Explorando a América Latina', '', 'explorando-a-america-latina', 3, 'BR', 0, 48, 'explorando_a_americalatina.jpg', '9788508063437', NULL, NULL),
(141, 151, 'Manos Malucos I', '', 'manos-malucos-i', 25, 'BR', 17, 24, 'manos_1.jpg', '8528103900', 'Claudius', NULL),
(142, 152, 'Menino que Virou Escritor', 'O', 'o-menino-que-virou-escritor', 16, 'BR', 0, 27, 'meninovirouescritor.jpg', '8503007037', 'Ciro Fernandes', NULL),
(144, 154, 'Manos Malucos II', '', 'manos-malucos-ii', 25, 'BR', 17, 24, 'manos_2.jpg', '8528103919', 'Claudius', NULL),
(145, 155, 'Na Praia e No Luar, Tartaruga Quer o Mar', '', 'na-praia-e-no-luar-tartaruga-quer-o-mar', 3, 'BR', 18, 40, 'napraia_e_noluar.jpg', '9788508128440', 'Biry Sarkis', NULL),
(146, 156, 'Não se mata na Mata: lembranças de Rondon', '', 'nao-se-mata-na-mata-lembrancas-de-rondon', 19, 'BR', 0, 32, 'nao_se_mata_na_mata.gif', '9788572722384', 'Maria Inês Martins', NULL),
(147, 157, 'Piadinhas Infames', '', 'piadinhas-infames', 25, 'BR', 0, 24, 'piadinhasinfames.jpg', '8528103927', 'Claudius', NULL),
(148, 158, 'Que É?', 'O', 'o-que-e', 25, 'BR', 0, 24, 'oquee.gif', '8528103897', 'Claudius', NULL),
(149, 159, 'Ah, Cambaxirra, Se Eu Pudesse...', '', 'ah-cambaxirra-se-eu-pudesse', 14, 'BR', 19, 32, 'ahcambaxirra.jpg', '8532250688', ' Graça Lima', NULL),
(150, 160, 'Argonautas', 'Os', 'os-argonautas', 20, 'BR', 20, 64, 'argonautas.jpg', '9788516085407', ' Igor Machado', NULL),
(151, 161, 'Barbeiro e o Coronel', 'O', 'o-barbeiro-e-o-coronel', 14, 'BR', 19, 32, 'obarbeiroeocoronel.jpg', '853225067X', 'Michele Iacocca', NULL),
(152, 162, 'Cachinhos de Ouro', '', 'cachinhos-de-ouro', 14, 'BR', 21, 32, 'cachinhos_de_ouro.jpg', '9788532252043', 'Ellen Pestili', NULL),
(153, 163, 'Cavaleiro do Sonho: As aventuras e desventuras de Dom Quixote de la Mancha', 'O', 'o-cavaleiro-do-sonho-as-aventuras-e-desventuras-de-dom-quixote-de-la-mancha', 19, 'BR', 0, 56, 'cavaleiro_do_sonho.jpg', '8572722106', 'Cândido Portinari', NULL),
(154, 164, 'Clássicos de Verdade: Mitos e Lendas greco-romanos', '', 'classicos-de-verdade-mitos-e-lendas-greco-romanos', 21, 'BR', 0, 62, 'classicos_de_verdade.jpg', '9788520919002', 'Thais Quintella de Linhares', NULL),
(155, 165, 'Domador de Monstros', 'O', 'o-domador-de-monstros', 14, 'BR', 19, 32, 'domador_de_monstros.jpg', '8532250696', 'Suppa', NULL),
(156, 166, 'Dona Baratinha', '', 'dona-baratinha', 14, 'BR', 21, 32, 'dona_baratinha.jpg', '9788532252050', 'Maria Eugênia', NULL),
(157, 167, 'Festa no Céu', '', 'festa-no-ceu', 14, 'BR', 21, 32, 'festa_no_ceu.jpg', '9788532252117', 'Marilda Castanha', NULL),
(158, 168, 'Histórias à Brasileira 1: A Moura Torta e outras', '', 'historias-a-brasileira-1-a-moura-torta-e-outras', 8, 'BR', 0, 79, 'hist_a_brasileira_1.jpg', '8574061557', 'Odilon Moraes', NULL),
(159, 169, 'Histórias à Brasileira 2: Pedro Malasartes e outras', '', 'historias-a-brasileira-2-pedro-malasartes-e-outras', 8, 'BR', 0, 87, 'hist_a_brasileira_2.jpg', '9788574062242', 'Odilon Moraes', NULL),
(160, 170, 'Histórias à Brasileira 3: O Pavão Misterioso e outras', '', 'historias-a-brasileira-3-o-pavao-misterioso-e-outras', 8, 'BR', 0, 88, 'historias_a_brasileira_3.jpg', '9788574062969', 'Odilon Moraes', NULL),
(161, 171, 'Histórias Árabes', '', 'historias-arabes', 14, 'BR', 22, 80, 'historias_arabes.jpg', '9788532280220', 'Laurent Cardon', NULL),
(162, 172, 'Histórias Chinesas', '', 'historias-chinesas', 14, 'BR', 22, 72, 'historias_chinesas.jpg', '9788532285805', 'Laurent Cardon', NULL),
(163, 173, 'João Bobo', '', 'joao-bobo', 14, 'BR', 21, 20, 'joao_bobo.jpg', '9788532252067', 'Roberto Weigand', NULL),
(164, 174, 'Odisseu e a Vingança do Deus do Mar', '', 'odisseu-e-a-vinganca-do-deus-do-mar', 20, 'BR', 20, 48, 'odisseu.gif', '9788516060381', 'Igor Machado e Luiza Resende', NULL),
(165, 175, 'Pescador e Mãe D''Água', 'O', 'o-pescador-e-mae-dagua', 20, 'BR', 20, 40, 'o_pescador_e_a_mae_dagua.jpg', '9788516060374', 'Igor Machado', NULL),
(166, 176, 'Pimenta no Cocuruto', '', 'pimenta-no-cocuruto', 14, 'BR', 19, 32, 'pimenta_no_cocuruto.jpg', '853225070X', 'Roberta Weigand', NULL),
(167, 177, 'Tapete Mágico', '', 'tapete-magico', 3, 'BR', 11, 88, 'tapete_magico.jpg', '9788508128426', 'Florence Breton', NULL),
(168, 178, 'Três Porquinhos', 'Os', 'os-tres-porquinhos', 14, 'BR', 21, 32, 'os_tres_porquinhos.gif', ' 8532252206', 'Gilles Eduar', NULL),
(169, 179, 'Boa Cantoria', 'Uma', 'uma-boa-cantoria', 14, 'BR', 19, 32, 'uma_boa_cantoria.jpg', '8532250661', 'Edu', NULL),
(170, 180, 'Veado e a Onça', 'O', 'o-veado-e-a-onca', 14, 'BR', 21, 32, 'o_veado_e_a_onca.jpg', '9788532252036', 'Suppa', NULL),
(171, 181, 'Balaio: Livros e Leituras', '', 'balaio-livros-e-leituras', 21, 'BR', 0, 223, 'balaio_livros_e_leituras.jpg', '9788520919699', NULL, NULL),
(172, 182, 'Como e por que ler os clássicos universais desde cedo', '', 'como-e-por-que-ler-os-classicos-universais-desde-cedo', 22, 'BR', 0, 146, 'comoeporqueler.jpg', '8573024496', NULL, 'Glenda Rubinstein'),
(173, 183, 'Contracorrente', '', 'contracorrente', 3, 'BR', 0, 159, 'contracorrente.jpg', '8508072848', 'Mário Fontes', NULL),
(174, 184, 'Esta Força Estranha', '', 'esta-forca-estranha', 4, 'BR', 0, 88, 'esta_forca_estranha.jpg', '9788570568298', NULL, NULL),
(175, 185, 'Ilhas no Tempo: algumas leituras', '', 'ilhas-no-tempo-algumas-leituras', 21, 'BR', 0, 176, 'ilhas_no_tempo.jpg', '8520916899', NULL, 'Luísa Baeta'),
(176, 186, 'Romântico, Sedutor e Anarquista: como e porque ler Jorge Amado hoje', '', 'romantico-sedutor-e-anarquista-como-e-porque-ler-jorge-amado-hoje', 22, 'BR', 0, 150, 'romantico_jorge_amado.jpg', '8573027975', ' Tita Nigrí', NULL),
(177, 187, 'Texturas - sobre Leituras e Escritos', '', 'texturas-sobre-leituras-e-escritos', 21, 'BR', 0, 224, 'texturas.jpg', '8520912109', NULL, NULL),
(178, 188, 'Uma, Duas, Três Princesas', '', 'uma-duas-tres-princesas', 3, 'BR', 11, 40, 'Uma duas tres Princesas.jpg', '9788508159376', 'Luani Guarnieri', NULL),
(181, 192, 'Sinais do Mar', '', 'sinais-do-mar', 29, 'BR', 0, 56, 'sinais_do_mar_poesia.jpg', '9788575037706', NULL, 'Luciana Facchini');

-- --------------------------------------------------------

--
-- Estrutura da tabela `author_collection_editors`
--

DROP TABLE IF EXISTS `author_collection_editors`;
CREATE TABLE IF NOT EXISTS `author_collection_editors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `uri` varchar(200) DEFAULT NULL,
  `country` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uri` (`uri`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Extraindo dados da tabela `author_collection_editors`
--

INSERT INTO `author_collection_editors` (`id`, `name`, `uri`, `country`) VALUES
(1, 'Agir', 'agir', 'BR'),
(2, 'Alfaguara', 'alfaguara', 'BR'),
(3, 'Ática', 'atica', 'BR'),
(4, 'Atual', 'atual', 'BR'),
(5, 'Berlendis', 'berlendis', 'BR'),
(6, 'Brasil - América', 'brasil-america', 'BR'),
(7, 'Companhia das Letras', 'companhia-das-letras', 'BR'),
(8, 'Companhia das Letrinhas', 'companhia-das-letrinhas', 'BR'),
(9, 'Ediouro', 'ediouro', 'BR'),
(10, 'Editora 34', 'editora-34', 'BR'),
(11, 'Editora Gaia', 'editora-gaia', 'BR'),
(12, 'Editora Objetiva', 'editora-objetiva', 'BR'),
(13, 'Formato', 'formato', 'BR'),
(14, 'FTD', 'ftd', 'BR'),
(15, 'Global', 'global', 'BR'),
(16, 'José Olympio', 'jose-olympio', 'BR'),
(17, 'Martins Fontes', 'martins-fontes', 'BR'),
(18, 'Melhoramentos', 'melhoramentos', 'BR'),
(19, 'Mercuryo Jovem', 'mercuryo-jovem', 'BR'),
(20, 'Moderna', 'moderna', 'BR'),
(21, 'Nova Fronteira', 'nova-fronteira', 'BR'),
(22, 'Objetiva', 'objetiva', 'BR'),
(23, 'Quinteto', 'quinteto', 'BR'),
(24, 'Record', 'record', 'BR'),
(25, 'Salamandra', 'salamandra', 'BR'),
(26, 'SM', 'sm', 'BR'),
(28, 'Edições Grupo Velox', 'edicoes-grupo-velox', 'BR'),
(29, 'Cosac Naify', 'cosac-naify', 'BR');

-- --------------------------------------------------------

--
-- Estrutura da tabela `author_collection_prizes`
--

DROP TABLE IF EXISTS `author_collection_prizes`;
CREATE TABLE IF NOT EXISTS `author_collection_prizes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `work` int(10) unsigned NOT NULL,
  `prize_name` varchar(200) NOT NULL,
  `institution_name` varchar(200) DEFAULT NULL,
  `category_name` varchar(200) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uri` (`category_name`),
  KEY `work` (`work`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Extraindo dados da tabela `author_collection_prizes`
--

INSERT INTO `author_collection_prizes` (`id`, `work`, `prize_name`, `institution_name`, `category_name`, `year`) VALUES
(1, 8, 'Prêmio Machado de Assis', 'Biblioteca Nacional', 'Melhor Obra de Ficção do Ano', '1999'),
(2, 15, 'Prêmio Passo Fundo Zaffari Bourbon de Literatura', 'Prefeitura Municipal de Passo Fundo', 'Melhor obra em língua portuguesa publicada no Brasil entre 2011 e 2013', '2013'),
(3, 25, 'Hors Concours', 'Fund. Nac. Livro Infantil e Juvenil', NULL, '2002'),
(4, 25, 'Altamente recomendado', 'Fund. Nac. Livro Infantil e Juvenil', 'Criança', '2002'),
(5, 32, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', NULL, '1985'),
(6, 64, 'Prêmio APCA', 'Ass. Paulista de Críticos de Arte', NULL, '1980'),
(7, 75, 'Prêmio Alejandro José Cabassa', 'UBE', 'Melhor Livro Infantil', '2000'),
(8, 80, 'Prêmio Américas', NULL, 'Melhores livros latinos nos EUA', '1997'),
(9, 80, 'Altamente Recomendável', 'Fundalectura, Bogotá, Colômbia', NULL, '1996'),
(10, 80, 'Melhor Livro Infantil Latino-americano', 'ALIJA - Buenos Aires', NULL, '1996'),
(11, 80, 'Prêmio Melhores do Ano', 'Biblioteca Nacional da Venezuela', NULL, '1995'),
(12, 80, 'Prêmio Bienal de São Paulo', 'Bienal de São Paulo ', 'Menção Honrosa - Uma das Cinco Melhores Obras do Biênio', '1988'),
(13, 101, ' Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', NULL, '1977'),
(14, 104, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', NULL, '2003'),
(15, 104, 'Prêmio Ofélia Fontes, O melhor para a criança', 'FNLIJ', 'Hors Concours', '2002'),
(16, 108, 'Lista Melhores do Ano', 'Fundalectura, Bogotá', NULL, '1994'),
(17, 108, 'Prêmio Jabuti', NULL, 'Camara Brasileira do Livro', '1978'),
(18, 108, ' João de Barro', 'Pref. Municipal de Belo Horizonte', NULL, '1977'),
(19, 109, ' Lista de Honra', 'IBBY', NULL, '1982'),
(20, 109, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', NULL, '1980'),
(21, 111, 'Prêmio APPLE', 'Instituto Jean Piaget, Suiça', NULL, '1988'),
(22, 115, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', 'Criança', '2003'),
(23, 116, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', 'Criança', '2006'),
(24, 118, 'Prêmio Ofélia Fontes - O melhor para a criança', 'FNLIJ', 'Hors Concours', '2006'),
(25, 118, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', 'Criança', '2005'),
(26, 125, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', NULL, '1997'),
(27, 126, 'Prêmio Fernando Chinaglia', 'União Brasileira dos Escritores', NULL, '1979'),
(28, 126, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', NULL, '1979'),
(29, 127, 'Américas Award for Children''s and Young Adult Literature', 'Consortium of Latin American Studies Programs (CLASP)', NULL, '2003'),
(30, 127, 'Os 40 Livros Essenciais', 'Nova Escola', NULL, '1996'),
(31, 127, 'Premio Noroeste', 'Bienal de São Paulo', 'Melhor Livro Infantil do Biênio', '1984'),
(32, 127, 'Prêmio Jabuti', 'Camara Brasileira do Livro', NULL, '1983'),
(33, 127, 'Melhor Livro Infantil do Ano', 'Ass. Paulista de Críticos de Arte', NULL, '1982'),
(34, 127, 'Lista de Honra', 'IBBY', NULL, '1982'),
(35, 127, 'Selo de Ouro', 'Fund. Nac. do Livro Infantil e Juvenil', 'Melhor livro juvenil do ano', '1982'),
(36, 127, 'Prêmio Maioridade Crefisul', 'Crefisul', 'Originais Inéditos', '1981'),
(37, 128, 'Prêmio Bienal de São Paulo', 'Bienal de São Paulo ', 'Melhor livro juvenil do biênio', '1988'),
(38, 128, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', NULL, '1986'),
(39, 129, 'Prêmio Casa de Las Americas', 'Casa de Las Americas, Cuba', NULL, '1981'),
(40, 129, ' Melhor Livro Infantil do Ano', 'Ass. Paulista de Críticos de Arte', NULL, '1981'),
(41, 129, 'Selo de Ouro', 'Fund. Nac. do Livro Infantil e Juvenil', 'Melhor livro juvenil do ano', '1981'),
(42, 133, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', 'Melhor Texto Juvenil', '1994'),
(43, 136, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', 'O Melhor para o Jovem', '1992'),
(44, 137, 'Selo de Ouro', 'Fund. Nac. do Livro Infantil e Juvenil', 'Melhor Livro Infantil do Ano', '1980'),
(45, 139, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', NULL, '1990'),
(46, 140, ' Prêmio Jabuti', 'Camara Brasileira do Livro', NULL, '2000'),
(47, 140, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', 'Criança', '1999'),
(48, 140, ' Hors Concours', 'Fund. Nac. do Livro Infantil e Juvenil', 'Criança', '1999'),
(49, 141, 'Premio Dramaturgia Infantil', 'Fund. Teatro Guaíra, Paraná', NULL, '1979'),
(50, 142, 'Prêmio Jabuti', 'Camara Brasileira do Livro', 'Coleção', '1986'),
(51, 144, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', NULL, '1982'),
(52, 144, 'Melhor ilustração', 'Noma, Japão', NULL, '1982'),
(53, 155, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', 'Melhor Livro Informativo', '1992'),
(54, 152, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', 'Criança', '2001'),
(55, 163, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', 'reconto', '2005'),
(56, 163, 'Prêmio Figueiredo Pimentel  - O melhor livro reconto', 'Fund. Nac. do Livro Infantil e Juvenil', 'reconto', '2005'),
(57, 164, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', 'Tradução e Adaptação', '2006'),
(58, 168, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', 'reconto', '2003'),
(59, 168, 'Prêmio Figueiredo Pimentel - O melhor livro reconto', 'FNLIJ', 'Hors Concours', '2002'),
(60, 169, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', 'reconto', '2004'),
(61, 181, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', 'Teórico', '2007'),
(62, 183, 'Premio ALIJA', 'ALIJA, Buenos Aires', NULL, '1999'),
(63, 183, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', 'Teórico', '1999'),
(64, 183, 'Melhor livro', 'Fund. Nac. do Livro Infantil e Juvenil', 'Teórico', '1999'),
(65, 184, 'Prêmio Jabuti', 'Camara Brasileira do Livro', NULL, '1997'),
(66, 185, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', 'Teórico', '2004'),
(67, 186, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', 'Teórico', '2006'),
(68, 187, 'Prêmio Cecília Meirelles - O melhor livro Teórico', 'Fund. Nac. do Livro Infantil e Juvenil', NULL, '2002'),
(69, 187, 'Altamente Recomendável', 'Fund. Nac. do Livro Infantil e Juvenil', 'Teórico', '2001'),
(70, 187, 'Melhor livro', 'Fund. Nac. do Livro Infantil e Juvenil', 'Teórico', '2001');

-- --------------------------------------------------------

--
-- Estrutura da tabela `author_collection_series`
--

DROP TABLE IF EXISTS `author_collection_series`;
CREATE TABLE IF NOT EXISTS `author_collection_series` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `editor` int(10) unsigned NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `uri` varchar(200) DEFAULT NULL,
  `country` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uri` (`uri`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Extraindo dados da tabela `author_collection_series`
--

INSERT INTO `author_collection_series` (`id`, `editor`, `name`, `uri`, `country`) VALUES
(1, 25, 'Mico Maneco', 'mico-maneco', 'BR'),
(2, 20, 'Uni duni tê', 'uni-duni-te', 'BR'),
(3, 3, 'Barquinho de Papel', 'barquinho-de-papel', 'BR'),
(4, 20, 'Ana Maria Machado', 'ana-maria-machado-moderna-br', 'BR'),
(5, 25, 'Batutinha', 'batutinha', 'BR'),
(6, 15, 'Abre o olho', 'abre-o-olho', 'BR'),
(7, 20, 'Girassol', 'girassol', 'BR'),
(8, 14, 'Primeiras Histórias', 'primeiras-historias', 'BR'),
(9, 25, 'Gato Escondido', 'gato-escondido', 'BR'),
(10, 3, 'Celeste', 'celeste', 'BR'),
(11, 3, 'Abrindo Caminho', 'abrindo-caminho', 'BR'),
(12, 3, 'Para Gostar de Ler Junior', 'para-gostar-de-ler-junior', 'BR'),
(13, 23, 'Isto ou Aquilo', 'isto-ou-aquilo', 'BR'),
(14, 3, 'Ana Maria Machado', 'ana-maria-machado-atica-br', 'BR'),
(15, 5, 'Arte para Crianças', 'arte-para-criancas', 'BR'),
(16, 15, 'Teatro Jovem', 'teatro-jovem', 'BR'),
(17, 25, 'Adivinhe Só', 'adivinhe-so', 'BR'),
(18, 3, 'Sinal Verde', 'sinal-verde', 'BR'),
(19, 14, 'Conta de novo', 'conta-de-novo', 'BR'),
(20, 20, 'Sete mares', 'sete-mares', 'BR'),
(21, 14, 'Lê pra mim', 'le-pra-mim', 'BR'),
(22, 14, 'Histórias de outras terras', 'historias-de-outras-terras', NULL),
(23, 4, 'Passando a limpo', 'passando-a-limpo', 'BR');

-- --------------------------------------------------------

--
-- Estrutura da tabela `author_collection_works`
--

DROP TABLE IF EXISTS `author_collection_works`;
CREATE TABLE IF NOT EXISTS `author_collection_works` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `prefix` varchar(10) DEFAULT NULL,
  `uri` varchar(200) DEFAULT NULL,
  `description` text,
  `summary` text,
  `type` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=193 ;

--
-- Extraindo dados da tabela `author_collection_works`
--

INSERT INTO `author_collection_works` (`id`, `title`, `prefix`, `uri`, `description`, `summary`, `type`) VALUES
(2, 'Recado do Nome ', '', 'recado-do-nome-', 'Tese de doutorado de Ana Maria Machado, orientada pelo famoso semiólogo Roland Barthes.Leitura da obra de Guimarães Rosa à luz do nome de seus personagens. Indispensável para aqueles que pretendem fruir toda a riqueza do universo de Rosa.', 'Tese de doutorado de Ana Maria Machado, orientada pelo famoso semiólogo Roland Barthes.', 4000),
(3, 'Alice e Ulisses ', '', 'alice-e-ulisses-', 'Como a Alice de Carroll, ela está disposta a explorar o país das maravilhas e experimentar todas as novas sensações. Como Ulisses, ele está disposto a grandes aventuras e a se divertir pelo caminho, mas não perde de vista que um dia vai voltar para casa. Um estudo sobre o comportamento masculino e feminino, com fascinante qualidade literária.', 'Uma história de amor contando a paixão entre um homem casado e uma mulher descasada.', 3000),
(4, 'Tropical Sol da Liberdade', '', 'tropical-sol-da-liberdade', 'Emocionante relato das desventuras da juventude brasileira pós-64. Uma jornalista, em um momento de crise, faz um balanço de sua existência. Sua trajetória íntima se confunde com o próprio tempo, num romance cuja mola-mestra é a emoção. Segundo Eduardo Portella, é, provavelmente, o melhor e mais importante romance político da literatura brasileira contemporânea.\r\n', 'Os fatos políticos passados na década de 60 são contados do ponto de vista de uma mulher.', 3000),
(5, 'Canteiros de Saturno', '', 'canteiros-de-saturno', 'Do jardim na serra fluminense ao sertão nordestino, passando pelos bairros do Rio, as ruas de Praga e os canais de Veneza, a leitura deste romance é uma viagem em companhia variada e interessante. Os personagens, que passam por questões morais ao longo do livro, são fortes e carregados de emoções.', 'Trata do tempo e seu efeito sobre as pessoas, abordando questões morais como traição e egoísmo.', 3000),
(6, 'Aos Quatro Ventos', '', 'aos-quatro-ventos', 'Partindo de uma lenda medieval, um anel de misterioso metal de forma adaptável, oriundo dos tempos de Carlos Magno, Ana Maria Machado desenvolve, a partir desta base fantástica, as vivências de seus personagens às voltas com alguns dos temas mais palpitantes da nossa atualidade, sobretudo a vocação primordial do homem para se expressar através da palavra escrita.', 'Uma lenda medieval recontada nos dias atuais, onde se aproveita para discutir temas como paixão, natureza e obsessão.', 3000),
(7, 'Mar Nunca Transborda', 'O', 'o-mar-nunca-transborda', 'A história de um pequeno lugarejo do litoral do Espírito Santo, do século XVI aos dias de hoje, em contraponto com a trajetória de uma mulher que vive intensamente os conflitos do mundo no fim do milênio.', 'Cinco séculos da nossa história em uma pequena vila de pescadores chamada Manguezal.', 3000),
(8, 'Audácia Dessa Mulher', 'A', 'a-audacia-dessa-mulher', 'Como num jogo de caixas que se abrem e revelam outras caixinhas, vão surgindo ao longo do texto novos enredos, sempre com personagens marcantes e vivos. É o dono do restaurante que coleciona receitas, a autora de livros de viagens, o bancário que não quer que a noiva trabalhe, o aprendiz de roteirista, o analista de sistemas que trabalha com meninos de favela, o diretor de televisão que faz das pessoas seus ratinhos de laboratório e muito mais. Atual e imperdível!', 'Um romance que engloba varias vertentes e vem do século XIX aos nossos dias.', 3000),
(9, 'Para sempre', '', 'para-sempre', 'Nelson e Susana se conheceram no interior, nos anos 40. E deles se pode dizer que amaram muito, que sofreram e lutaram juntos pela vida. Que tiveram decepções e recompensas. E que o amor deles nasceu para ter história. Foi desses que recebem e deixam sua herança amorosa...\r\nNão há maior mito sobre o amor do que o que desdenha a impossibilidade de ele durar para sempre.', 'O mito do amor eterno é abordado nesse romance que mescla as formas de ensaio e romance, sobre amor, paixão e tempo.\r\n', 3000),
(10, 'Banho Sem Chuva', '', 'banho-sem-chuva', 'Mico Maneco queria ficar cheiroso para poder dançar forró com a Mona Maluca. Mas tomar banho como, se não está chovendo?', 'Da série Mico Maneco. Essa divertida história ajuda a treinar a leitura de palavras com dígrafos.', 1000),
(13, 'Palavra de Honra', '', 'palavra-de-honra', 'História de cinco gerações de uma família luso-brasileira, desde a vinda, no século XIX, do jovem José Almada para o Brasil com o propósito de ganhar a vida sem deixar de ser um homem de bem, honrado, íntegro, ético e de palavra. Almada instala-se em Petrópolis e constrói um grande patrimônio. As gerações se sucedem até chegar à Letícia, que costura relatos esparsos para reconstruir a história dos Almada.', 'História de uma família cujo patriarca veio de Portugal para o Brasil, ainda menino, no século XIX. Uma saga de cinco gerações, pautada pela discussão de valores como honra, ética e vergonha.', 3000),
(15, 'Infâmia', '', 'infamia', 'Ana Maria Machado questiona os artifícios e as calúnias que com tanta freqüência encobrem a verdade no mundo atual. O romance narra duas histórias em paralelo, centradas numa família de diplomatas e seus amigos mais próximos. Ao longo da narrativa são entrelaçados fatos da história recente do Brasil em que a verdade, em meio a distorções e calúnias, nem sempre prevalece. O resultado é um livro impactante sobre as múltiplas e traiçoeiras faces da realidade.', 'Um romance sobre como a verdade pode ser camuflada entre distorções e calúnias. Duas histórias narradas em paralelo que questionam os artifícios usados para encobrir a verdade e forjar versões.', 3000),
(19, 'Silenciosa Algazarra ', '', 'silenciosa-algazarra-', 'O livro discute temas diversos como os pontos de contato entre o folclore brasileiro e a obra dos irmãos Grimm, os problemas de convívio entre escritores e críticos, a ilustração nos livros infantis, a prática da literatura com os pequenos pacientes de hospitais, entre outros.', 'Questões urgentes da cultura do século XXI são respondidas por Ana Maria Machado nessa seleção de artigos, palestras e conferências.', 4000),
(21, 'Boladas e Amigos', '', 'boladas-e-amigos', 'O macaco jogava bola com o gato e pediu ao galo: "Galo, vem cá. Joga bola comigo e com ele?". Mas o galo disse que não joga bola. E para o macaco, quem não joga bola leva bolada.', 'Divertida história da segunda fase da série Mico Maneco, boa para treinar as palavras com os fonemas "f" e "v" e com "g" e "j".', 1000),
(22, 'Brincadeira de Sombra', '', 'brincadeira-de-sombra', 'A menina Luísa sai para passear com seu avô. Na ida à padaria, dentro de casa, as sombras estão em todos os lugares. Que gostosa brincadeira!', 'Quem nunca brincou com a própria sombra? Luísa se diverte enquanto aprende a mexer com a sua.', 1000),
(23, 'Cabe na Mala', '', 'cabe-na-mala', 'A vaca vai à vila carregando uma mala de lona. O cavalo vai à vila carregando uma maleta de pano. O que será que eles estão levando e trazendo?', 'Primeira fase da série Mico Maneco, para leitura de palavras bem simples.', 1000),
(24, 'Com Prazer e Alegria', '', 'com-prazer-e-alegria', 'Benedito e Janaína hoje fizeram uma viagem diferente. Não precisaram levar bagagem, tomar condução nem trocar de roupa. E cada um viu uma coisa mais interessante que o outro. Você quer embarcar com eles na próxima viagem?', 'Última fase da série Mico Maneco, que lembra a importância e o prazer de ler.', 1000),
(25, 'Dia de Chuva', '', 'dia-de-chuva', 'Henrique e Isadora vem visitar Guido em um dia de chuva. Suas mães acham uma pena eles não terem podido sair para brincar. Mal sabem elas que os três viajaram nas costas de elefantes, entraram em cavernas de ursos, atravessaram abismos e até navegaram em um navio mágico, entre ataques de piratas e jacarés.', 'Guido, Henrique e Isadora percorrem mundos incríveis em um dia de chuva.', 1000),
(26, 'Eu era um Dragão', '', 'eu-era-um-dragao', 'Marco chega à casa de Luísa e de Taís usando uma capa preta e uma espada. Sentando-se um herói, convida as meninas para cavalgarem por lugares longínquos, misteriosos. Em um passe de mágica, rainhas, princesas, um super-herói e um dragão terrível entram em cena.', 'Num jogo permanente entre o texto e a ilustração, este livro sublinha a riqueza da imaginação infantil em suas sutilezas, que nem sempre ficam visíveis para os adultos.', 1000),
(27, 'Fim de semana', '', 'fim-de-semana', 'Livro da série Uni duni tê sobre as brincadeiras e as divertidas possibilidades que podem estar contidas num fim de semana. Aborda temas como lazer e preferências.', 'Um livro delicioso e divertido como um fim de semana. Da série Uni duni tê.', 1000),
(28, 'Fome Danada', '', 'fome-danada', 'Um dia Mico Maneco estava com uma fome danada e foi a uma loja de comida. Comeu bolo de nata e gostou muito. Comeu feijoada e gostou muito mais. Como o ovo não estava bom, Mico Maneco jogou pela janela e acertou no pé do Tatu Jeca. Na história de comilança, a série continua a ajudar os que aprendem a ler.', 'Uma história de comilança, que ajuda os que estão aprendendo a ler a diferenciar os sons "f" e "v" e as letras "g" e "j".', 1000),
(29, 'Maré Baixa, Maré Alta', '', 'mare-baixa-mare-alta', 'Luísa vai para a praia com seus pais e rapidamente constrói bolos e castelos na areia, brinca na água... Que delícia de passeio!', 'Luísa sai para passear na praia com seus pais e descobre gostosas brincadeiras.', 1000),
(30, 'Menino Poti', '', 'menino-poti', 'Lá na mata vive o menino Poti, que é amigo dos animais. Poti levava um pote cheio de bananas dentro de uma canoa quando avistou um macaquinho ferido.', 'A história do menino Poti diverte e ensina quem está na primeira fase da série Mico Maneco, que possui palavras bem simples.', 1000),
(31, 'Mico Maneco', '', 'mico-maneco', 'Mico Maneco é um macaco muito levado. Mona Maluca é um macaca meio de miolo mole. O que será que eles aprontam quando se juntam?', 'A história do Mico Maneco, sempre muito levado, é ideal para quem está começando a ler. Pertence a primeira fase da série, com leitura de palavras bem simples.', 1000),
(32, 'No Barraco do Carrapato', '', 'no-barraco-do-carrapato', 'A sapa saiu pela rua toda catita. Uma sapa muito bonita. De roupa nova e laço de fita. Mas no pé nada de sapato. Sem bota ou botina, sem pé-de-pato. A sapa vai ter que voltar até o barraco do carrapato.', 'Terceira fase da premiada série Mico Maneco. Ótimo para treinar os sons "r" e "s".', 1000),
(33, 'No Imenso Mar Azul  ', '', 'no-imenso-mar-azul-', 'A mãe do peixe-palhaço sempre avisava: cuidado! Não saia daqui. Não vá para longe que é perigoso. Mas o maior perigo para um peixe-palhaço é ir para um aquário.', 'História divertida para treinar a leitura de palavras com dígrafos. Pertence a quarta fase da série Mico Maneco.', 1000),
(34, 'Palhaço Espalhafato', 'O', 'o-palhaco-espalhafato', 'O espantalho sempre quis ter muitos amigos, mas ninguém falava com ele. Um belo dia um passarinho pediu sua ajuda e em troca realizou o desejo do espantalho.', 'Enquanto lê a história de um espantalho, a criança treina a leitura de palavras com dígrafos. Parte da quarta fase da premiada série Mico Maneco.', 1000),
(35, 'Pena de Pato e de Tico-tico', '', 'pena-de-pato-e-de-tico-tico', 'A menina Janaína tem uma bela boneca. O menino Benedito tem uma bonita bola. Mas a bola de Benedito cai lá no mato e a boneca da Janaína cai da janela. Cadê a bola? Cadê a boneca?', 'Livro da segunda fase da série Mico Maneco, para leitura das palavras com "f" e "v" e com "g" e "j".', 1000),
(37, 'Quando eu crescer...  ', '', 'quando-eu-crescer-', 'Quando eu crescer\r\nO que é que eu vou ser?\r\nVou trabalhar num estaleiro?\r\nVou num barco navegar?\r\nSer salva-vidas na praia?\r\nMergulhador? Petroleiro em plataforma no mar?\r\n\r\nQuando eu crescer... é um livro de poemas a partir de uma pergunta clássica do universo infantil: o que vou ser quando crescer?', 'Quando eu crescer... apresenta aos pequenos o tema da escolha da profissão com rimas e jogos com palavras. Da série Uni duni tê.', 1000),
(38, 'Quem sou eu?', '', 'quem-sou-eu', 'Quem sou eu?\r\nVê se adivinha.\r\nÀs vezes eu saltito, pulo pra lá e pra cá,\r\ncorro de cá para lá.\r\nviro cambalhota...\r\nQuem sou eu?\r\n\r\nVamos ver se os pequenos se identificam e adivinham?', 'Mais um livro da série Uni duni tê, Quem sou eu? é uma gostosa brincadeira de adivinha que une um texto cheio de poesia e imagens divertidas.', 1000),
(39, 'Rato Roeu a Roupa', 'O', 'o-rato-roeu-a-roupa', 'O rato estava com fome, mas não tinha nem um resto de rosca para roer. Então ele roeu o reboco, o rádio, o remo e a rolha. Nada matava sua fome. Aí ele roeu a roupa nova do Rei de Roma.', 'Parte da terceira fase da série Mico Maneco. Enquanto se diverte a criança aprende a leitura dos sons com "r".', 1000),
(40, 'Surpresa na Sombra ', '', 'surpresa-na-sombra-', 'Mico Maneco acordou com vontade de brincar, mas procurou em todos os lugares e não achou ninguém. Onde será que estava todo mundo?', 'História divertida e fácil de ler, que ajuda a treinar os encontros consonantais. Da última fase da série Mico Maneco.', 1000),
(41, 'Tatu Bobo', '', 'tatu-bobo', 'Caiu um toco de madeira no pé do tatu. Ele pega e dá um teco na cotia. Brincando com as sílabas, a criança vai aprendendo pouco a pouco a ler.', 'Uma história engraçada de um tatu muito bobo, contada em palavras bem simples para quem está começando. Primeira fase da série Mico Maneco.', 1000),
(42, 'Tesouro da Raposa', 'O', 'o-tesouro-da-raposa', 'Todo dia era a mesma coisa. A raposa passava carregando alguma coisa e o Mico Maneco via e ficava curioso. "É para meu tesouro, Mico Maneco", falava a raposa. Mas que tesouro será esse?', 'Uma história curiosa que ajuda a treinar as palavras que tem os sons de "r" e "s", pertencente à terceira fase da série Mico Maneco.', 1000),
(43, 'Troca-Troca', '', 'troca-troca', 'André estava estreando sua nova bicicleta, quando viu Benedito puxando um lindo caminhão de brinquedo que ele mesmo fizera. Na mesma hora André perguntou se o Benedito não queria trocar por uma bicicleta. E as trocas estavam apenas começando.', 'Para quem já domina todos os sons da língua, uma história divertida que ajuda a treinar os encontros consonantais. Pertencente a última fase da série Mico Maneco.', 1000),
(44, 'Dragão no Piquenique', 'Um', 'um-dragao-no-piquenique', 'Dona Glória levou todos os alunos para um piquenique numa praia tranqüila, perto de uma mata. Mas eles não sabiam que nessa praia existia um monstro horrível.', 'Uma grande aventura fácil de ler e que ajuda a treinar os encontros consonantais. Para quem já está na última fase da série Mico Maneco.', 1000),
(45, 'Um, dois, três, agora é sua vez! ', '', 'um-dois-tres-agora-e-sua-vez-', 'Um, dois, três\r\nvenha contar comigo,\r\nquatro, cinco, seis, \r\nconte com seu amigo,\r\nagora é sua vez.\r\n\r\nNeste livro as crianças aprenderão a contar rimando! Ou seria a rimar contando?', 'Um, dois, três, agora é sua vez! é mais um livro da série Uni duni tê. Nessa história, matemática e poesia estão juntas de forma divertida.', 1000),
(46, 'Arara e Sete Papagaios', 'Uma', 'uma-arara-e-sete-papagaios', 'Poti viu uma arara linda no alto do pé de guaraná. O indiozinho subiu no pé de guaraná, pegou a Arara e levou para a aldeia. Mas ele não sabia que o pássaro era tão tagarela.', 'A história da arara tagarela diverte enquanto ajuda a treinar os sons "r" e "s". Parte da terceira fase da série Mico Maneco.', 1000),
(47, 'Gota de Mágica', 'Uma', 'uma-gota-de-magica', 'Todo dia, Joana toma café com bolo de fubá, pega a lata d?água e vai para a fila da bica. Até que um dia achou um bola de gude, que alumiava feito uma lua.', 'Enquanto se concentra na história de Joana, aprende-se a leitura de palavras com "f" e "v" e com "g" e "j".', 1000),
(48, 'Zabumba do Quati', 'A', 'a-zabumba-do-quati', 'Quico estava querendo fazer forró. Fez uma flauta de taquara e chamou o amigo Quati para tocar zabumba. Só que o Quati não sabe o que é zabumba, mas não quer que ninguém saiba disso.', 'A história do Quico com o forró faz parte da quarta fase da série Mico Maneco, para os que querem treinar a leitura de palavras com dígrafos.', 1000),
(49, 'Alguns Medos e Seus Segredos', '', 'alguns-medos-e-seus-segredos', 'Velho-que-vem-com-um-saco, caldeirão de bruxa, gigante-que-come-criança, lobo mau, bicho-papão; todo mundo teme alguma coisa. Neste livro até os adultos confessam ter medo, mesmo que seja de uma simples lagartixa.', 'Reunião de três histórias cheias de humor, em torno aos medos de todos nós, em qualquer idade. Medos concretos ou abstratos, reais ou imaginários, justificados ou não.', 1000),
(50, 'Arara e o Guaraná', 'A', 'a-arara-e-o-guarana', 'A arara adorava guaraná porque a fruta é vermelha, que nem ela. Mas não queria ver ninguém comendo sua frutinha e resolveu esconder todo o guaraná que encontrasse pela mata. Uma divertida história ecológica e bem brasileira.', 'Para quem está começando a ler, uma divertida história com jeito de Brasil.', 1000),
(51, 'Avental Que o Vento Leva', '', 'avental-que-o-vento-leva', 'Um dia Corina tirou o avental e pendurou num galho para brincar bastante, sem nada que atrapalhasse. Mas quando ela foi procurar, ele não estava mais lá. Ela vai precisar de muita ajuda para achar seu avental.', 'Onde está o avental da menina Corina? Você sabe quem pegou?', 1000),
(52, 'Balas, Bombons, Caramelos', '', 'balas-bombons-caramelos', 'Pipo, o hipopótamo, era alegre, brincalhão, amigo de todos os animais e bastante sorridente. Mas ele era também muito comilão, e devorava todo tipo de doce quando ninguém estava vendo.', 'Para quem está começando a ler, as aventuras do hipopótamo Pipo divertem e ensinam.', 1000),
(53, 'Besouro e Prata', '', 'besouro-e-prata', 'A história de um besouro que entra dentro de uma casa é o assunto de um texto cuidadoso e delicado, ideal para quem está começando a ler.\r\n', 'Com um texto leve e delicado, Ana Maria conta a história de um besouro que entrou em uma casa.', 1000),
(54, 'Beto, o Carneiro ', '', 'beto-o-carneiro-', 'Bebeto era um carneiro cansado de fazer tudo o que lhe mandavam. Num belo dia resolveu ir embora e virar nuvem, para poder voar livremente por aí. Mas até uma nuvem tem que fazer o que o vento mandar, e o carneiro Bebeto muda de novo.', 'Para ler e ficar feliz, respeitando a si mesmo e às diferenças.', 1000),
(55, 'Camilão, o Comilão', '', 'camilao-o-comilao', 'Camilo era um leitão. Um porco grande e comilão. Mas ele não queria trabalhar para comprar comida, preferia pedir aos amigos. E Camilo sempre teve muitos amigos, porque pode ser comilão, mas sempre divide o que tem.\r\n', 'Uma divertida história de comilança e de brincadeira com números, cujo personagem principal é o leitão Camilo.', 1000),
(56, 'Currupaco Papaco ', '', 'currupaco-papaco-', 'O maior sucesso da venda de seu Manuel era um papagaio que se chamava Paco Papaco. Cansado de ficar acorrentado e vendo sempre as mesmas pessoas Paco resolveu fugir e conhecer o mundo. Passou por muitos lugares, viu muitas pessoas e se divertiu pra valer.', 'O papagaio Paco sempre fez o maior sucesso na venda do seu Manoel, mas cansado de tanta mesmice ele resolveu partir para conhecer o mundo.', 1000),
(57, 'Curvo ou reto: olhar secreto', '', 'curvo-ou-reto-olhar-secreto', 'Esse livro é fruto de uma parceria entre Ana Maria Machado e sua filha Luísa Baeta, e é o primeiro da coleção Abre o Olho que explora um olhar de forma diferente, de descobrir detalhes e surpresas em volta do nosso dia a dia.\r\n\r\nQuem conhece esse livro fica vendo curvas e retas espalhadas e misturadas por toda parte.', 'Retas e curvas, paralelas e transversais, formas abertas e fechadas, ângulos retos, agudos e obtusos e tanta coisa mais. Um excelente ponto de partida para experiências divertidas e enriquecedoras de ver o mundo.', 1000),
(58, 'Dedo Mindinho', '', 'dedo-mindinho', 'Lembra do mindinho, seu-vizinho, pai-de-todos, fura-bolo e mata-piolho? Pois é, esta história começou com uma vovó daquelas que gostam de fazer doces supergostosos, e seu netinho, daqueles que adoram fazer travessuras. Contando nos dedos se conta uma história.', 'Hummmm.... Os doces da vovó sempre são os mais gostosos, e as suas histórias e brincadeiras também. Que relação delicada aparece nessa história!', 1000),
(59, 'Dia Desses ', 'Um', 'um-dia-desses-', 'João sempre perguntava para a mãe o que era a semana. Sua mãe sempre respondia, mas João se enrolava. Até que suas aulas começaram e ele foi à escola pela primeira vez - era uma segunda feira. O que acontece nos outros dias torna tudo muito divertido. Um dos favoritos entre os pequenos.\r\n', 'Uma história divertida para explicar os dias da semana.\r\n', 1000),
(60, 'Distraído Sabido ', 'O', 'o-distraido-sabido-', 'Pedrinho parecia viver no mundo da Lua. As vezes esquecia o que tinha ido buscar, outras vezes ficava tão entretido em alguma coisa que nem saía do lugar. Alguns colegas achavam graça, mas Pedrinho nem ligava, já que tinha bons amigos.\r\nSerá que ele era distraído mesmo? Faça um passeio pela mata com Pedrinho e sua turma e tire suas conclusões.\r\n', 'Pedrinho parecia viver no mundo da Lua. Será que ele era distraído mesmo? Um passeio pela mata vai tirar essa dúvida.\r\n', 1000),
(61, 'Dorotéia, a Centopéia ', '', 'doroteia-a-centopeia-', 'Todo dia parecia uma festa no canteiro do jardim, onde os insetos brincavam depois do trabalho. O único bichinho que estava meio triste era Dorotéia, a centopéia. O que será que ela tinha?\r\n', 'História da centopéia Dorotéia, que andava meio triste.\r\n', 1000),
(62, 'Elefantinho Malcriado ', 'O', 'o-elefantinho-malcriado-', 'Dizem que um elefante incomoda muita gente. Malcriado então....Nesta história você vai conhecer um filhote de elefante que, além de malcriado, ficava fazendo tromba para todo mundo.\r\n', 'O bebê elefante adorava fazer birra, até que aprendeu uma grande lição.\r\n', 1000),
(63, 'Elfo e a Sereia  ', 'O', 'o-elfo-e-a-sereia-', 'O livro conta a história de amor entre um elfo (uma pequena criatura que vive na mata) e uma sereia (que vive no mar). Juntos eles descobrem as dificuldades de viver esse amor, por serem tão diferentes. Será que eles encontrarão uma forma de viver juntos?\r\n', 'Nas histórias de Ana Maria Machado, nada é impossível. A bonita história de amor entre um elfo e uma sereia se desenrola apesar das dificuldades.\r\n', 1000),
(64, 'Era Uma Vez Três', '', 'era-uma-vez-tres', 'Para que as crianças conheçam de maneira divertida a arte de Volpi, Ana relaciona seus quadros com uma história muito divertida de três triângulos.\r\n', 'A arte de Volpi é o pretexto de Ana Maria para contar uma história.\r\n', 1000),
(65, 'Esta Casa é Minha', '', 'esta-casa-e-minha', 'Uma família decide ter uma casa na praia, pertinho da mata. O entusiasmo de viver perto da natureza é grande, e aos poucos eles vão modificando o ambiente em que vivem. Afinal, como fica a mata e a praia com essa família?\r\n', 'Uma casa nova num lugar onde muitos bichos já moravam.\r\n', 1000),
(66, 'Galinha Que Criava Um Ratinho', 'A', 'a-galinha-que-criava-um-ratinho', 'Numa casinha branca com telhado de sapê moravam um galo e uma galinha. Mas eles não tinham pintinhos, e como queriam ter muitos filhos, pegaram um ratinho para cuidar. Inspirada num conto tradicional, uma história deliciosa para os pequeninos.\r\n', 'Inspirada num conto tradicional, uma história deliciosa para os pequeninos.\r\n', 1000),
(70, 'Gato do Mato e o Cachorro do Morro', 'O', 'o-gato-do-mato-e-o-cachorro-do-morro', 'Quem é mais valente : o Gato do mato ou o Cachorro do morro? No meio dessa discussão apareceu um bicho muito mais valente que os dois. O que será que vai acontecer? Divertida história cheia de rimas.\r\n', 'Muita aventura e ação nessa história, feita sob medida para os valentões.', 1000),
(71, 'Gato Massamê e Aquilo Que Ele Vê ', 'O', 'o-gato-massame-e-aquilo-que-ele-ve-', 'Era um gato amarelo rajado, desses que parecem filhote de tigre. Mas tinha uma coisa que ninguém sabia. É que o gato Massamê não enxergava bem de longe.\r\n', 'O gato da menina Luísa era lindo, só não enxergava muito bem.', 1000),
(72, 'Gente, Bicho, Planta: o Mundo me Encanta', '', 'gente-bicho-planta-o-mundo-me-encanta', 'A terra e o ar viviam medindo forças e acabaram causando outros fenômenos. A criação do mundo segundo a ciência, contada como se fosse uma história.', 'Três histórias divertidíssimas sobre as pessoas e o lugar em que vivem: "De Pergunta em Pergunta", "Um Problema chamado Coiote" e "A Briga da Terra com o Ar".\r\n', 1000),
(73, 'Grande Aventura de Maria Fumaça', 'A', 'a-grande-aventura-de-maria-fumaca', 'Maria Fumaça era uma locomotiva que estava abandonada num canto da estação. Cansada de ficar parada enferrujando num canto, Maria Fumaça resolveu seguir os trilhos e conhecer o mundo.\r\n', 'Acompanhe Maria Fumaça na sua aventura pelo mundo.\r\n', 1000),
(74, 'Jabuti Sabido e Macaco Metido   ', '', 'jabuti-sabido-e-macaco-metido-', 'Num concurso entre os bichos da mata, a onça quer impor sua vontade e o macaco quer bancar o espertinho.\r\n', 'Quem é o bicho mais esperto da floresta? Só lendo para saber.\r\n', 1000),
(75, 'Jararaca, a Perereca e a Tiririca', 'A', 'a-jararaca-a-perereca-e-a-tiririca', 'Era uma vez um terreno baldio cheio de mato. Nesse terreno acabaram se encontrando uma tiririca, uma perereca e uma jararaca. Mas os homens chegam para limpar o terreno. Uma enfrenta, uma foge, outra se esconde. O que será delas agora?', 'O encontro inusitado de uma jararaca, uma perereca e uma tiririca é o assunto da vez nessa história que faz refletir.', 1000),
(76, 'Jeca, o Tatu', '', 'jeca-o-tatu', 'Quando os animais se juntavam para contar o que tinham visto durante o dia, o único que não tinha nada para falar era Jeca, o tatu, que passava o dia todo debaixo da terra. Até que um dia Jeca conheceu uma coisa que mudou sua vida.\r\n', 'O tatu Jeca vivia desanimado, até que fez um passeio inesquecível pela cidade.\r\n', 1000),
(77, 'Maravilhosa Ponte do Meu Irmão  ', 'A', 'a-maravilhosa-ponte-do-meu-irmao-', 'Todos os adultos querem saber o que será essa tal de Ponte Maravilhosa. O presente cobiçado pelos amigos. Mas é preciso muita imaginação para descobrir do que se trata. Quer tentar?\r\n', 'Criança brinca com cada coisa... Elas ganham uma boneca, mas brincam com a caixa. Todas as crianças querem a Ponte Maravilhosa, mas ninguém encontra para comprar. O que será essa ponte?\r\n', 1000),
(78, 'Maria Sapeba ', '', 'maria-sapeba-', 'Lenda indígena, narrada nos tempos dos jesuítas, que explica porque o peixe conhecido como linguado, e que os índios chamavam de marassapé, tem a boca torta e os dois olhos do mesmo lado.\r\n', 'A história do surgimento do peixe linguado, de acordo com uma lenda indígena.\r\n', 1000),
(79, 'Mas Que Festa!', '', 'mas-que-festa', 'Oba! O aniversário da menina está chegando, e sua mãe pediu para chamar seus amigos. Cada amigo chamou um amigo que trouxe umas comidinhas... Veja no que deu essa festa!\r\n', 'Uma festa bem brasileira está sendo organizada, com uma mistura bem divertida.\r\n', 1000),
(80, 'Menina Bonita do Laço de Fita', '', 'menina-bonita-do-laco-de-fita', 'Era uma menina linda. A pele era escura e lustrosa, que nem pêlo da pantera quando pula na chuva. Do lado da casa dela morava um coelho que achava a menina a pessoa mais linda que ele já vira na vida. Queria ter uma filha linda e pretinha como ela. Um dos maiores sucesso da autora.\r\n', 'História de uma menina que, de tão bonita, deixa até um coelho apaixonado.\r\n', 1000),
(81, 'Meu Reino por um Cavalo ', '', 'meu-reino-por-um-cavalo-', 'Príncipe Ricardo tinha tantas roupas, tantos brinquedos mas não tinha um cavalo. Se ele pudesse trocava seu futuro reino por um cavalo. Um dia, um desafio que exige coragem lhe dá uma oportunidade de realizar seu sonho.\r\n', 'Um príncipe que se preza deve ter um cavalo, correto? Pois o príncipe Ricardo não tinha nenhum, até que surge uma chance de concretizar esse sonho.', 1000),
(82, 'Minhoca da Sorte', 'A', 'a-minhoca-da-sorte', 'A história singela de um pintinho solitário que só queria alguém para brincar, contar histórias e abraçá-lo quando estivesse triste. Sua aventura começa quando ele persegue seu milho da sorte. Afastando-se do terreiro abandonado onde vivia, o pintinho terá uma grata surpresa.\r\n', 'A partir de um motivo da tradição oral - o grão da sorte - a autora cria uma história simples e comovente, que aborda as dores e alegrias do crescimento: o medo da solidão e o desejo de independência.\r\n', 1000),
(83, 'Natal de Manuel ', 'O', 'o-natal-de-manuel-', 'André estava querendo saber o que era o natal, mas cada um dava uma resposta diferente. Até que ele perguntou ao Manuel, seu melhor amigo da escola, que deu a melhor resposta de todas.\r\n', 'A história do Natal, contada de uma maneira bem diferente.\r\n', 1000),
(84, 'Pavão do Abre-e-Fecha', 'O', 'o-pavao-do-abre-e-fecha', 'O pavão se achava lindo com a cauda aberta toda colorida, mas quando olhava para seus pés se sentia desajeitado. Quando foi convidado para uma festa no céu, tratou de ensaiar uns passos de dança. Mas não tinha jeito, o pobre pavão dançava meio esquisito.', 'Desde quando pavão dança? É só ler o livro para descobrir.', 1000),
(85, 'Quem foi que fez? ', '', 'quem-foi-que-fez-', 'Esse é o segundo livro da coleção Abre o Olho, fruto de uma parceria entre Ana Maria Machado e sua filha Luísa Baeta, que explora um olhar de forma diferente, de descobrir detalhes e surpresas em volta do nosso dia a dia.\r\n', 'Para o leitor sair passeando de olhos abertos, ouvidos atentos e percepção aguçada, procurando descobrir o que foi feito por mãos humanas e o que brota sozinho na natureza.\r\n', 1000),
(87, 'Quem Perde Ganha ', '', 'quem-perde-ganha-', 'Era uma vez um boto sonhador, que saltava e achava que era bicho voador. Num desses saltos, de repente, apaixonou-se por uma luz que deslizava no céu. Uma história de amores possíveis e impossíveis, perdas e ganhos.\r\n', 'Três histórias poéticas e divertidas sobre a perda: "Fiapo de trapo", "A menina que vivia perdendo" e "O boto e a estrela".\r\n', 1000),
(88, 'Quenco, o Pato', '', 'quenco-o-pato', 'Seu Pato e Dona Pata estavam muito contentes, hoje seus filhotes vão dar o primeiro mergulho na lagoa. Mais um dos patinhos, Quenco, não gostou nada dessa tal de água. Era molhada demais...\r\n', 'Pato gosta de água, correto? Nem todos! O patinho Quenco não gostava, veja o que aconteceu.', 1000),
(89, 'Quem me Dera', '', 'quem-me-dera', 'Vera quer brincar mas todos estão ocupados: uns trabalham, outros estudam, o gato tem que caçar o rato, a abelha tem que fazer o mel....será que ela vai conseguir companhia para brincar?\r\n', 'Vera quer brincar, mas ninguém tem tempo para ela. Todos muitos ocupados, querendo mas não podendo. E você, quer brincar com Vera?\r\n', 1000),
(90, 'Segredo da Oncinha', 'O', 'o-segredo-da-oncinha', 'A floresta se prepara para o carnaval, cada bicho com a sua fantasia. Todos menos a onça Afonsinha, que foi proibida pelo pai de desfilar. Chateada, ela sai para dar uma volta e descobre um outro desfile. Entre com ela nessa folia!\r\n', 'A floresta está em polvorosa, todos os bichos se preparam para o baile de Carnaval. Como se divertirá a onça Afonsinha, que não pode desfilar?\r\n', 1000),
(91, 'Severino Faz Chover', '', 'severino-faz-chover', 'Severino não tinha nada demais, era parecido com muitos outros. Mas onde ele morava não era muito parecido com outros lugares. Era seco. A terra era seca, cheia de poeira. Então Severino chamou os amigos e começou a pedir um pouco de chuva para as nuvens. Uma celebração dos brinquedos infantis tradicionais.\r\n', 'A história de tantos Severinos que existem no Nordeste, e que apesar da seca inventam brincadeiras.\r\n', 1000),
(92, 'Gato no Telhado', 'Um', 'um-gato-no-telhado', 'Renato era um gato que via muito televisão e vivia fazendo arte. Nem quando sua mãe o colocou de castigo ele se comportou. Mas acaba mostrando que quem é esperto aprende coisa útil em todo canto.\r\n', 'O gato Renato vivia aprontando, até que aprendeu uma lição.', 1000),
(93, 'pra lá, Outro pra cá', 'Um', 'um-pra-la-outro-pra-ca', 'Sabe aquele ditado que diz "quando um não quer, dois não brigam"? Pois então. Lolô, uma elegante locomotiva, e Janjão, um belo vagão, faziam tudo juntos, até o dia em que descobriram que cada um queria fazer as coisas a seu modo. Perceberam que desse jeito, respeitando as vontades de cada um, poderiam ser mais felizes. E assim cada um seguiu seu caminho, ouvindo seu coração!', 'A locomotiva e o vagão de carvão resolvem se separar e cada um vai para um lado. O que acontece com os vagõezinhos que eles puxam?', 1000),
(95, 'História de Páscoa ', 'Uma', 'uma-historia-de-pascoa-', 'Com a páscoa chegando Joãozinho só pensava no coelhinho que ia trazer seus ovos de chocolate. Mas os coelhinhos nessa época do ano também só pensam nos meninos que vão trazer umas cenouras coloridas para eles.\r\n', 'Quando chega a Páscoa, todos ficam ansiosos para ganhar seus presentes: os meninos querem ovos de chocolate e, os coelhinhos, suas cenouras coloridas.', 1000),
(96, 'Noite Sem Igual ', 'Uma', 'uma-noite-sem-igual-', 'O nascimento de Jesus contado sob a ótica do menino pastor chamado Benjamin. Amigo do anjo Gabriel, que sempre o visitava, Benjamin recebeu a notícia em primeira mão da chegada desta criança.\r\n', 'O nascimento de Jesus é contado sob a ótica de um menino pastor.\r\n', 1000),
(97, 'Velha Misteriosa', 'A', 'a-velha-misteriosa', 'No meio de muitos edifícios havia uma casa, onde morava uma velha misteriosa, sempre às voltas com um caldeirão. As crianças pensam que é uma bruxa. Mas Tião Risonho não acredita nisso e resolve entrar na casa para conhecer a velha pessoalmente.', 'Será que na única casa do bairro, cheio de prédios altos, vive uma bruxa? Leia e descubra.\r\n', 1000),
(98, 'Velhinha Maluquete ', 'A', 'a-velhinha-maluquete-', 'Quem não tem avião nem caminhão viaja de balão. O balão da velhinha maluquete vai subir, mas para viajar com ela os animais têm que se comportar. Será?\r\n', 'Com vontade de viajar, a velhinha maluquete resolve fazer um balão. Os animais da fazenda decidem ir junto, aprontando uma grande confusão.', 1000),
(99, 'Abrindo Caminho', '', 'abrindo-caminho', 'No meio do caminho de Carlos tinha uma pedra.\r\nA história da humanidade traz exemplos de pessoas que abriram caminhos para mudar o mundo e nossa maneira de compreende-lo.\r\nEsse livro emociona ao mostrar que enfrentar obstáculos pode trazer tesouros e invenções que acabam mudando a história de um monte de gente.\r\nUma linda homenagem a todos os que abriram caminho, através da poesia ou da coragem.', 'Um livro em prosa e verso, em homenagem a grandes figuras que abriram caminhos para mudar o mundo.\r\n', 1000),
(100, 'Beijos Mágicos ', '', 'beijos-magicos-', 'Nanda tinha duas casas, em uma vivia seu pai e na outra sua mãe. Reinava tranquila até que apareceu Bebel, a namorada do seu pai. Para Nanda, Bebel era uma bruxa, só faltava a vassoura. Será ciúme? Quando Nanda vai aceitar essa nova família?', 'Uma história que ensina as crianças a conviverem com a realidade de pais separados, sendo feliz mesmo assim.\r\n', 1000),
(101, 'Bento que Bento é o Frade ', '', 'bento-que-bento-e-o-frade-', 'Uma turminha muita animada começa a brincar, mas a menina Nita não se conforma em fazer sempre igual. Alguém manda e os outros obedecem, porque tem que ser sempre assim? E porque não fazer o comum diferente? É em busca dessas respostas que a menina Nita parte para uma bonita aventura.', 'Quem nunca brincou de "adoleta"? E de "bento-que-bento-é-o-frade", em que cada hora tem um mestre, para comandar a brincadeira? As brincadeiras de criança são o tema dessa história.\r\n', 1000),
(102, 'Cadê meu travesseiro? ', '', 'cade-meu-travesseiro-', 'Em busca de seu travesseiro, Isadora viaja ao mundo do sono e dos sonhos, nas asas das cantigas infantis e dos contos de fadas.\r\n', 'Na hora de dormir, procurando o travesseiro, esta história em versinhos conta como uma menina passeia pelo mundo dos contos de fadas e das cantigas de ninar.\r\n', 1000),
(103, 'Cidade: arte para as crianças ', 'A', 'a-cidade-arte-para-as-criancas-', 'Uma viagem por alguns quadros famosos de pintores latinoamericanos, usados como ilustrações que servem de ponto de partida para uma visão lírica da cidade e da realidade urbana.\r\n\r\n', 'Uma celebração ao ambiente urbano, a partir das obras de grandes pintores latino-americanos.', 1000),
(104, 'De Carta em Carta ', '', 'de-carta-em-carta-', 'A história de Pepe e seu avô, o jardineiro José.\r\nO menino queria ficar brincando em casa em vez de ir à escola e dizia para os seus pais que tinha que ficar ajudando seu José. Mas de vez em quando brigavam.\r\nUm dia, o menino resolveu mandar uma carta para seu José. Como não sabia escrever, pediu ajuda a um escrevedor, enquanto trocava cartas com o avô, Pepe fez grandes descobertas.\r\n', 'Pepe não ia à escola. Um dia, resolveu mandar uma carta para o avô, e pediu ajuda a um escrevedor. De carta em carta, Pepe descobre que a escola é um lugar legal.\r\n', 1000),
(105, 'De Fora da Arca ', '', 'de-fora-da-arca-', 'Quando os homens desagradaram a Deus, ele mandou Noé construir uma arca bem grande que coubesse todos os animais. Mas e aqueles que não entraram, ou não quiseram entrar? É ler para descobrir o que aconteceu com eles. Inspirada numa canção e nos bestiários medievais, a autora celebra a imaginação.\r\n', 'Todo mundo conhece a história da Arca de Noé. Mas o que aconteceu com quem ficou de fora da Arca?\r\n', 1000),
(106, 'Delícias e Gostosuras ', '', 'delicias-e-gostosuras-', 'Fim de semana na casa da avó é sempre uma delícia. Quando há festa de aniversário, ela prepara receitas de dar água na boca! Isadora, Henrique e seus amigos vão saborear muitas gostosuras da cozinha brasileira.\r\n', 'Narrativa divertida, toda em versos e rimas, que brinca com os prazeres do paladar na hora de comer, por entre ecos de histórias tradicionais e cantigas infantis.\r\n', 1000),
(107, 'Gente Bem Diferente', '', 'gente-bem-diferente', 'Essa é a história de uma família aparentemente normal, mas que vai se revelando especial a cada descoberta dos netos Rodrigo e Andréia. Será essa uma família igual às outras ou uma muito especial cheia de segredos e de identidades secretas e misteriosas? \r\nPara saber, trate de ler. A história contada pelo Rodrigo e os versinhos inventados pela Andréia. E no final ainda tem mais, adivinhe se for capaz.', 'Os netos Rodrigo e Andréia vão fazendo descobertas sobre a sua família. Acompanhe essa deliciosa procura.\r\n', 1000),
(108, 'História Meio ao Contrário ', '', 'historia-meio-ao-contrario-', 'Você conhece alguma história que começa com: "E então eles se casaram, tiveram uma filha linda como um raio de sol e viveram felizes para sempre"? Pois esta, com rei, príncipe, princesa e dragão, começa exatamente assim. Quer saber como ela termina?\r\n', 'Você vai encontrar aqui uma história meio diferente, que começa exatamente no fim das outras histórias normais. Curioso(a)? Você ainda não viu nada.\r\n', 1000),
(109, 'Menino Pedro e seu Boi Voador', 'O', 'o-menino-pedro-e-seu-boi-voador', 'Pedro volta da escola cheio de novidades. Tinha feito um novo amigo, um boi voador negro e lindo que não cansa de brincar. O difícil é convencer sua família que sua nova amizade realmente existe.\r\n', 'Quantas crianças não tem um amigo imaginário? O amigo que ninguém vê pode ser uma ótima companhia para a criança, mas é difícil fazer a família compreender isso.\r\n', 1000),
(110, 'Nas asas do mar', '', 'nas-asas-do-mar', 'Antologia composta por dezesseis textos que apresentam temas de grande importância na obra de Ana Maria Machado. São contos, recontos de tradição popular, poesias e trechos de narrativas de diferentes momentos da carreira da premiada escritora.\r\n“O barbeiro e o coronel”, “Ah, cambaxirra, se eu pudesse...”, “A princesa que escolhia” e “O boto e a estrela” são algumas das histórias do rico universo de Ana Maria Machado reunidas em “Nas asas do mar”.\r\n', 'Crianças levam à loucura um síndico mandão, um boto fica apaixonado por uma estrela cadente, um barbeiro ameaçado por um coronel tirano. Essas e outras histórias de diferentes momentos da carreira de Ana Maria Machado apresentam aos jovens leitores o fascinante universo da escritora.\r\n', 1000),
(111, 'Palavras, Palavrinhas, Palavrões  ', '', 'palavras-palavrinhas-palavroes-', 'Uma menina gostava de colecionar palavras. Quando escutava uma, logo repetia, mesmo sendo um palavrão. A família criticava, mas a menina não entendia porque certas palavras eram proibidas e outras não. Será que era o tamanho das palavras que determinava a proibição? Brincando com as palavras e costumes, o livro aborda com humor essa questão. E ainda fala das dores e ciúmes que a gente tem quando chega um irmãozinho.\r\n', 'A boa educação ensina a não falar palavrões. Mas como explicar isso para uma criança? O que é palavrão, afinal? Brincando com as palavras, e com o jeito das crianças, tudo fica claro nesse livro.\r\n', 1000),
(112, 'Palmas para João Cristiano', '', 'palmas-para-joao-cristiano', 'O maior sonho de Hans Cristian Andersen, o nosso João Cristiano, era ser importante, reconhecido por todos, receber aplausos de muita gente. Como isso poderia acontecer, se era um filho de um sapateiro e uma lavadeira, neto de uma jardineira?\r\nHoje, duzentos anos depois de seu nascimento, o mundo inteiro conhece e aplaude as maravilhosas histórias do escritor. Ana Maria Machado, detentora do Prêmio Hans Christian Andersen, faz parte dessa imensa platéia e lhe oferece como presente de aniversário Palmas para João Cristiano.', 'Homenagem a Hans Christian Andersen, o dinamarquês conhecido como "o pai da literatura infantil". Sua vida, suas histórias, seu sucesso.\r\n', 1000),
(113, 'Passarinho me Contou ', '', 'passarinho-me-contou-', 'Com ilustrações lindas e cheio de referências ao Brasil, "Passarinho me Contou" trata da história de um rei que não via problemas no seu reino. Até a hora em que ele descobre através de um velho sábio que a vida na sua terra não é bem assim...\r\n', 'Fábula moderna sobre a ambição dos homens, que vira uma lição de vida para todos.\r\n', 1000),
(114, 'Ponto de Vista', '', 'ponto-de-vista', 'Nesse livro comemorativo dos seus 25 anos na Editora Melhoramentos, Ziraldo escreveu em um recado para a Ana, dizendo que essa poderia ser a história verídica de muitos meninos nascidos em lados diferentes dessa cidade partida. Um soltava pipa, o outro andava de bicicleta, cada um para o seu lado. Um dia eles se viram e se descobriram como irmãos, cada um tendo muito a ensinar ao outro. Uma história sobre a descoberta da possibilidade que existe de sermos todos iguais diante de nossos sonhos.\r\n', 'A aventura de dois amigos que pareciam ser diferentes por viver numa cidade partida.\r\n', 1000),
(115, 'Portinholas   ', '', 'portinholas-', 'Um feliz encontro de uma escritora, que também é pintora, com um pintor que gostava de escrever.\r\nNesse belíssimo livro, Ana Maria Machado conta a história de uma menina que prestava muita atenção nas palavras e adorava pintar e desenhar na areia da praia.\r\nUm dia a menina ganhou um livro sobre Portinari. Cada página do livro abria portas, portinhas e portinholas para um mundo mágico de diversão e alegria.', 'A menina gostava muito de pintar. Um dia ela encontrou um livro lindo que abriu um monte de portinholas mágicas.\r\n', 1000),
(116, 'Princesa que Escolhia', 'A', 'a-princesa-que-escolhia', 'Era uma vez, num reino não muito distante, moderno e computadorizado, uma princesa muito boazinha, obediente e bem-comportada. Mas ela não seria assim pra sempre. Afinal, esse não é o fim da história e sim o começo. Um dia a princesa decidiu que não seria uma (itálico) maria-vai-com-as-outras(/itálico), que expressaria suas opiniões e faria suas próprias escolhas. Todos ficaram espantados e ela acabou de castigo na torre, o que foi uma baita sorte. Na torre, a princesa descobriu várias coisas: pessoas, animais, personagens, livros, histórias e princípios que mudariam a sua vida, se não por toda a eternidade, pelo menos até a próxima escolha. Neste livro divertido e encantador, Ana Maria Machado revive o melhor dos contos de fadas, levando o leitor a uma fantástica viagem pelo mundo da leitura.', 'Uma princesa sempre boazinha e que concordava com tudo um dia resolve dizer não. Defende o direito de pensar por conta própria e de escolher tudo. Certo ou errado? A gente tem sempre de concordar com tudo?', 1000),
(117, 'Príncipe que Bocejava', 'O', 'o-principe-que-bocejava', 'Era uma vez, num reino não muito distante, moderno e computadorizado, um príncipe que há muito se preparava para ser rei. Aprendeu a se comportar direitinho nas festas do reino, a não correr nos corredores do palácio, a ser gentil... Estudou com os melhores professores da corte: golfe, equitação, economia, direito, línguas, história e geografia. Agora era chegada a hora de se casar. E quem seria a noiva deste nobre cavalheiro? Vários bailes foram oferecidos pela realeza, para que o príncipe pudesse encontrar sua cara-metade. Mas, para a surpresa de todos, algo de muito desagradável acontecia a cada encontro. ', 'Um príncipezinho muito bem educado cresce e toda a corte quer que ele escolha uma princesa para se casar. Mas todas são tão chatas, com umas conversas tão bobas...\r\n', 1000),
(118, 'Procura-se Lobo', '', 'procura-se-lobo', 'Manoel Lobo estava procurando emprego e achou um anúncio que começava assim: "Procura-se Lobo, adulto de boa aparência, com experiência comprovada para trabalho de responsabilidade."\r\nJá que ele se chamava Lobo, se fez de bobo e respondeu ao anúncio. Não era o que queriam, mas acabou dando certo. Manoel arrumou um emprego para responder às cartas de todos os lobos que queriam o emprego.', 'Manoel Lobo gostava muito de ler. E por isso, escrevia bem direitinho. Foi assim que ele arrumou um emprego para responder cartas.', 1000),
(119, 'Que Lambança!', '', 'que-lambanca', 'Henrique e Isadora fazem na casa da avó uma gostosa viagem pelo país das brincadeiras e das cantigas infantis.', 'Entre sorrisos, muita risada e brincadeiras em casa da avó, duas crianças e um cachorro muito sujinhos enfrentam a hora do banho, pelo meio de muitas referências divertidas a histórias e versos do folclore.', 1000),
(120, 'Senhora dos Mares ', '', 'senhora-dos-mares-', 'A personagem central, Marina, foi criada em uma praia tropical e pertencia a uma família de pescadores. Os avôs, os tios, o pai, o irmão saíam de madrugada para o mar com anzóis, redes e iscas e só voltavam no fim do dia. O desejo de Mariana era ir com eles, pescar, viajar, conhecer outros lugares. Porém, só os homens podiam. Mas, determinada, Marina conseguiu mudar a postura do pai. E, no final, ainda ganhou uma homenagem.\r\n', 'Senhora dos Mares conta a história de Marina, uma menina que pensava diferente. Determinada em seus sonhos ela consegue mudar o rumo da sua vida.\r\n', 1000),
(121, 'Montão de Unicórnios', 'Um', 'um-montao-de-unicornios', 'Era um prédio de apartamentos, com porteiro, elevador e ar condicionado para os dias de calor. E também tinha um síndico, com cara de poucos amigos, que resolveu proibir animais no prédio. Até que um dia apareceu um unicórnio para enlouquecer o tal síndico.\r\n', 'Era um prédio de apartamentos, com porteiro, elevador e ar condicionado para os dias de calor. Até que um dia apareceu um unicórnio.\r\n', 1000),
(122, 'Natal Que não Termina', 'Um', 'um-natal-que-nao-termina', 'A história do nascimento de Jesus é contada em versos, ressaltando a necessidade de paz e amor entre homens.\r\n', 'Em versos como numa cantoria nordestina, a autora reconta o Natal, lembrando o encontro do Rei Herodes com os Reis Magos.\r\n', 1000),
(123, 'Vamos Brincar de Escola ?', '', 'vamos-brincar-de-escola-', 'Henrique e Isadora começam a frequentar a escola. Lá, vão aprender e brincar. Mas sempre vai sobrar tempo para, junto com a avó, mergulhar no mundo das cantigas infantis e dos contos de fadas.\r\n', 'Aprender e ensinar podem ser uma gostosa brincadeira para Henrique e Isadora, entre rimas, histórias da avó e cantigas.', 1000),
(124, 'Amigo é Comigo', '', 'amigo-e-comigo', 'Tatiana é uma típica adolescente. Tem suas amigas inseparáveis - Adriana e Cristina. Demora horas para se vestir e sempre fica meio insegura. Joga vôlei e participa dos torneios da escola. E odeia injustiça e falta de educação. As suas aventuras e desventuras são contadas aqui com charme. Qualquer pessoa que já foi adolescente vai se identificar com Tati na hora.\r\n', 'A amizade é posta à prova por Ana Maria Machado, que discute esse elemento importante na vida de todas as pessoas.\r\n', 2000);
INSERT INTO `author_collection_works` (`id`, `title`, `prefix`, `uri`, `description`, `summary`, `type`) VALUES
(125, 'Amigos Secretos', '', 'amigos-secretos', 'Quem já não desejou topar com personagens dos livros que leu com paixão? POis é justamente o que acontece com Pereba e seus amigos, a turma do "Clube da Árvore". Colocando por acidente um livro no aparelho de videocassete, eles abrem um portal imaginário para o mundo da ficção e se metem numa incrível aventura, na companhia de ninguém mais ninguém menos que Peter Pan e Capitão Gancho, Dom Quixote e Sancho Pança, Tom Sawyer e Huckleberry Finn; além é claro, de Narizinho, Pedrinho, Emília e o povo do Picapau Amarelo. \r\nO que se encontra aqui é uma homenagem sincera à capacidade que os livros têm de aproximar as pessoas e de, pelo auxílio da imaginação, nos ajudar a compreender e a transformar a nossa realidade.\r\n', 'Graças a um defeito em um velho aparelho de televisão, uma turma de crianças recebe a companhia inesperada de vários personagens de histórias - como Dom Quixote, Peter Pan e Emília.\r\n', 2000),
(126, 'Bem do Seu Tamanho', '', 'bem-do-seu-tamanho', 'Helena sempre quis saber qual era seu tamanho. Na hora de ajudar no trabalho ela já era bem grande. Na hora de tomar banho no rio e nadar no fundo ela ainda era muito pequena. Afinal qual o tamanho de Helena? O leitor vai com ela numa viagem em busca de si mesma.\r\n', 'Criança cresce depressa, e acaba deixando todos confusos. Na vida tem idade para tudo, e são esses pode-isso-mas-não-aquilo que acabam deixando a menina Helena aturdida.\r\n', 2000),
(127, 'Bisa Bia, Bisa Bel', '', 'bisa-bia-bisa-bel', 'A menina Bel encontra um dia uma foto de sua bisavó Bel, entre as coisas de sua mãe. A partir daí, ela inicia uma relação de muitas descobertas com essa pessoa tão importante na vida de sua família e na da própria. Até que surge uma menina inesperada. Uma relação de amizade e troca, capaz de emocionar a todos.', 'Com mais de 2.500.000 exemplares vendidos, a história de Bel e sua bisavó Bia mostra com ternura essa relação tão delicada.\r\n', 2000),
(128, 'Canto da Praça', 'O', 'o-canto-da-praca', 'Um grito de paz em meio a violência que permeia esse mundo. Quem não gosta de guerras, armas e de todo o mal que têm nos afligido, encontrará no "O Canto da Praça" o seu refúgio e apoio. Tudo isso com muita polêmica e feito como um convite à reflexão.\r\n', 'Com uma linguagem extremamente atraente, é uma denúncia das guerras e, em paralelo, conta uma história de amor adolescente.\r\n', 2000),
(129, 'De Olho nas Penas', '', 'de-olho-nas-penas', 'Miguel faz uma viagem maravilhosa mundo afora. Assim, vai desvendando os segredos da América Latina, da África e da sua própria vida.\r\n', 'Miguel tinha 8 anos, 2 pais e uns 5 países pelo mundo.\r\n', 2000),
(130, 'Do Outro Lado Tem Segredos ', '', 'do-outro-lado-tem-segredos-', 'O menino Bino vive em uma aldeia de pescadores. Desde pequeno ajuda os pescadores no que pode, e aguarda o dia em que poderá ir com eles. De frente para o mar, quer saber o que há do outro lado da linha do horizonte. Aos poucos, Bino vai descobrindo a África e aprendendo suas tradições e cultura. Bino está crescendo.\r\n', 'História de Bino, filho de pescadores, que começa a descobrir e aprender as tradições e cultura de sua gente.\r\n', 2000),
(131, 'Do Outro Mundo', '', 'do-outro-mundo', 'Ruidos muito estranhos arrepiam os cabelos de Mariano e sua turma. Será que antiga fazenda de café onde foram passar uns dias é mal-assombrada?\r\nMariano nos conta a aventura para desvendar esse mistério, enquanto escreve um livro sobre os fantasmas da escravidão.\r\n', 'Ruidos muito estranhos arrepiam os cabelos de Mariano e sua turma. Será que a antiga fazenda de café onde foram passar uns dias é mal-assombrada?\r\n', 2000),
(132, 'Era Uma Vez Um Tirano', '', 'era-uma-vez-um-tirano', 'As pessoas viviam felizes no seu país. Cantavam, trabalhavam, conversavam e tinham idéias. Até que apareceu um certo tirano, que resolveu mudar tudo e atrapalhar a felicidade dessas pessoas. Reclamou das cores e até das estrelas. Se não fossem aquelas crianças...\r\n', 'Um país vivia bem até que apareceu um tirano querendo mudar tudo. Veja o que aconteceu!\r\n', 2000),
(133, 'Isso Ninguém Me Tira', '', 'isso-ninguem-me-tira', 'A menina Gabi se apaixona por Bruno, que também ama Gabi. Até aí tudo certo, mas Bruno é a paixão platônica de Dora, prima de Gabi. A família de Gabi e Dora se mobiliza para impedir o romance de Bruno e Gabi, que tenta defender com unhas e dentes o direito de ser feliz.', 'Paixão não se escolhe, já foi dito há muito tempo. Gabi se apaixona pelo mesmo rapaz que sua prima. Como fica isso?\r\n', 2000),
(134, 'Mensagem para você', '', 'mensagem-para-voce', 'Soninha, Zé Miguel, Mateus, Fabiana e Guilherme deviam estar felizes: o trabalho deles de história sobre o Egito foi escolhido o melhor da classe. Mas, na verdade, eles estão com a pulga atrás da orelha. Ninguém do grupo pesquisou a importância intelectual da rainha Nefertiti - justo a parte mais elogiada pelo professor. Como então isso foi parar no texto?\r\nMais estranho ainda são as mensagens que eles começaram a receber. No computador, no celular e até em forma de rap! \r\nQue conexão existe entre essas mensagens? E por que elas soam como um pedido de socorro? Quem está por trás disso? Um hacker? Um gozador erudito? Ou seria mesmo algo mais fantástico? A investigação revelará muito mais do que eles imaginam...', 'Um estranho vírus no computador? Um perigoso hacker brincando de invadir telas alheias? Na tentativa de decifrar o mistério, uma turma de amigos se vê às voltas com misteriosas viagens no tempo.\r\n', 2000),
(135, 'Mistério da Ilha', 'O', 'o-misterio-da-ilha', 'Carlos é um menino mimado, que sempre tem tudo em suas mãos. Quando quer alguma coisa, é só gritar e mandar em todos que consegue, como se fosse um senhor de engenho com seus escravos. Em um passeio de barco, ele começa a aprender o valor do respeito e do caráter em um ser humano.', 'O respeito ao próximo associado à herança escravocrata é o tema deste livro, que ensina o valor do próprio trabalho.\r\n', 2000),
(136, 'Mistérios do Mar Oceano', '', 'misterios-do-mar-oceano', 'Onde você pensa que vai? Farta de ouvir essa pergunta e tendo que decidir o que fazer na vida, Cris olha o mar enquanto pensa. Certa vez, uma traineira desperta a sua atenção, e partir daí tudo muda em sua vida misturando uma adolescente de hoje com as grandes navegações.\r\n', 'Um livro que evoca aventuras passadas e, ao mesmo tempo, mergulha na alma de adolescentes atuais.', 2000),
(137, 'Raul da Ferrugem Azul ', '', 'raul-da-ferrugem-azul-', 'Raul da Ferrugem Azul   editar  apagar \r\n\r\nO menino Raul repara um dia que tem umas manchas azuis esquisitas no braço, mas não sabe o que fazer. Pergunta para os pais, amigos, mas ninguém vê as tais manchas. Elas começam a se espalhar, e o problema toma conta da vida do menino. O que fazer? Para quem pedir ajuda, já que ninguém vê a sua "ferrugem azul"? E afinal, por que Raul estava ficando manchado de azul? \r\n', 'Se você tem um problema, conta para quem? Raul arranja um problema que ninguém vê, e não sabe como solucionar ou para quem pedir ajuda. Quem pode lhe ajudar?\r\n', 1000),
(138, 'Tudo Ao Mesmo Tempo Agora', '', 'tudo-ao-mesmo-tempo-agora', 'Jajá estudava em uma escola particular, tinha amigos ricos e vivia em um prédio de classe alta. Até aí tudo bem, mas Jajá é na verdade filho do porteiro do prédio, e só estuda porque tem uma bolsa da escola. O dia-a-dia desse menino, que só queria ajudar o mundo, é contado aos poucos. Preconceito, ética, justiça e solidariedade são questões que ele enfrenta com seus amigos, tentando tornar tudo melhor nessa vida.\r\n', 'A vida de um menino pobre que convive com pessoas de classe média no seu dia-a-dia. Durante todo um ano, uma turma de amigos enfrenta questões inesperadas com valentia.\r\n', 2000),
(139, 'Vontade Louca', 'Uma', 'uma-vontade-louca', 'Mariana é uma garota criativa e sonhadora. Jorge é um rapaz muito racional, do tipo que só acredita no que vê. As suas vidas se cruzam, e aí tudo pode acontecer...\r\nO livro é contado sob a ótica de Marcos, irmão de Mariana e melhor amigo de Jorge, que não perde a oportunidade de comentar de um jeito muito especial tudo o que vive.', 'A história de Mariana e Jorge, tão diferentes e tão próximos, contada pelo ponto de vista de Marcos, irmão dela e amigo dele.\r\n', 2000),
(140, 'Fiz Voar o meu Chapéu ', '', 'fiz-voar-o-meu-chapeu-', 'O chapéu voou, e passou pelo coronel, pela senhora, pelo macaco e por mais um monte de coisas. É ler para descobrir por onde mais ele passou e se divertir.', 'Para ler e ir se divertindo aos poucos, na brincadeira com as palavras.', 1000),
(141, 'Hoje Tem Espetáculo', '', 'hoje-tem-espetaculo', 'Roteiro de duas peças de teatro que abordam temas variados, como desobediência, autoritarismo e preconceito.', 'Reúne duas peças infantis de Ana Maria Machado: "As Cartas Não Mentem Jamais" e "No País dos Prequetés".', 2000),
(142, 'Peleja', 'A', 'a-peleja', 'História fantasiosa sobre os feitos do Zé Ribamar, que enfrentou o Monstro para ficar com a donzela bonita. Todo contado em redondilhas, como os versos dos contadores nordestinos.\r\n', 'Parte da coleção Arte para Criança, esse livro é dedicado à arte popular. As ilustrações são feitas a partir de esculturas feitas de barro.\r\n', 1000),
(143, 'Três Mosqueteiros', 'Os', 'os-tres-mosqueteiros', '"Que é que eu posso dizer dessa experiência de adaptar Os três mosqueteiros para o palco? Primeiro, que foi um barato. Foi fascinante mergulhar no folhetim de Alexandre Dumas a esta altura, apreciando o pleno domínio que ele tinha no gênero que ajudou a criar. Impossível não admirar sua noção de tempo, sua mestria para plantar um indício aqui, colher um vestígio adiante, amarrar a ação toda, com um ar displicente de quem não quer nada, como alguém que trava um duelo enquanto janta um leitão assado regado a vinho e, nos intervalos, ainda sapeca uns beijinhos na criada que o serve."\r\n', 'Os três mosqueteiros é o primeiro livro da coleção Hoje Tem Espetáculo, que se propõe a publicar peças teatrais para o público infanto-juvenil. Trata-se de uma ótima oportunidade para o jovem leitor.\r\n', 2000),
(144, 'Avião e uma Viola', 'Um', 'um-aviao-e-uma-viola', 'Um avião e uma viola, um matagal e uma tagarela, um amuleto e uma muleta e muito outros pares disparatados se reuniram e formaram este livro, que, como você vai ver, é uma grande brincadeira.\r\n', 'Uma gostosa brincadeira com as palavras, que formam pares inusitados.\r\n', 1000),
(148, 'ABC do Brasil', '', 'abc-do-brasil', 'A exuberância da fauna e da flora, o racismo, a miscigenação, a importância do futebol e a vivacidade do carnaval, sem falar da literatura de Machado de Assis, Drummond, Guimarães Rosa, da arquitetura de Niemeyer, da música de Tom Jobim. É isso e de muito mais que se faz o Brasil, sobre o qual Ana Maria Machado se debruça, proporcionando ao leitor a compreensão histórica e cultural da formação de seu povo e do país.', 'Com um verbete para cada letra, em um mosaico despretensioso mas nítido, a autora ressalta a diversidade deste país enorme e mestiço.', 1000),
(149, 'Anjos Pintores ', 'Os', 'os-anjos-pintores-', 'Usando um pouco de imaginação Ana Maria Machado conta a história de dois artistas que nasceram quase na mesma época e no mesmo lugar, mas que tiveram destinos bem diferentes, Amadeo Modigliani e Alfredo Volpi.\r\n', 'História dos artistas Amadeo Modigliani e Alfredo Volpi, baseada na pesquisa de Donatela Berlendis.\r\n', 1000),
(150, 'Explorando a América Latina ', '', 'explorando-a-america-latina-', 'Uma viagem através do espaço e do tempo da América Latina. Leia sobre suas montanhas e florestas tropicais. Uma visão panorâmica do território latino-americano antes e depois da chegada dos europeus.', 'Livro informativo feito para uma coleção internacional organizada por uma editora inglesa. Cada volume foi entregue a um grande autor de uma parte diferente do mundo.', 1000),
(151, 'Manos Malucos I ', '', 'manos-malucos-i-', 'Uma série de adivinhações engraçadas, todas ilustradas, é a forma encontrada por Ana Maria para ensinar os homônimos e parônimos. Aos poucos, a criança vai percebendo que uma mesma palavra pode ter vários significados, como a manga da camisa e a manga fruta. Aprender fica mais divertido aqui.\r\n', 'Uma série de adivinhações que estimulam a fantasia das crianças, incentivando o interesse pelos homônimos e parônimos.\r\n', 1000),
(152, 'Menino que Virou Escritor ', 'O', 'o-menino-que-virou-escritor-', 'A infância do escritor José Lins do Rego é contada aqui por Ana Maria Machado. A vida no engenho, sem pai nem mãe, e as histórias que aconteceram com o menino Dedé - que ainda nem sonhava em virar o grande romancista conhecido em todo o Brasil e no exterior.', 'A infância do menino Dedé, criado em um engenho, e que viraria o famoso escritor José Lins do Rego.\r\n', 1000),
(154, 'Manos Malucos II', '', 'manos-malucos-ii', 'O que é? Com o apelido de pipa, de pandorga ou de arraia, um irmão tem rabiola, tem cerol, maracutaia. O outro voa aonde quer, fala muito e dá o pé, é verde e não é de praia. Uma brincadeira com adivinhas, sons, imagens e com a grafia das palavras.', 'Uma série de adivinhações, que lidam com a riqueza da língua portuguesa e seus homônimos e parônimos. Diverte enquanto ensina.\r\n', 1000),
(155, 'Na Praia e No Luar, Tartaruga Quer o Mar ', '', 'na-praia-e-no-luar-tartaruga-quer-o-mar-', 'A menina Luísa e seu irmão Pedro encontram uma grande tartaruga em dificuldades na praia. Além de estar machucada, um monte de crianças querem aproveitar e fazer algumas coisas com ela: transformar em sopa, sapato e ganhar dinheiro. Luísa e Pedro salvam a tartaruga, mas esse é só o começo de uma grande confusão que vai envolver toda a cidade.', 'Uma emocionante história de amor à natureza e às tartarugas. Ensina sem ser chato e trata do assunto de maneira completa.', 1000),
(156, 'Não se mata na Mata: lembranças de Rondon', '', 'nao-se-mata-na-mata-lembrancas-de-rondon', 'Com a internet, os recursos tecnológicos e os celulares cada vez mais sofisticados, o mundo parece ter ficado menor e muitas barreiras da comunicação foram rompidas.\r\nOs brasileiros, mesmo sem viajar como gostariam, não deconhecem lugares longínquos de seu país. Sabemos como é exuberante a Amazônia, mesmo sem ter estado lá. Sabemos também que o carnaval da Bahia tem características diferentes do de Recife e que ambos diferem da festa carnavalesca do Rio de Janeiro.\r\nNo século XIX essa rapidez de informação não existia. O brasileiro desconhecia seu próprio país. Não tinha idéia das belezas, das grandezas e das misérias e paradoxos de muitas regiões.\r\nFoi necessário que um homem, descendente de portugueses e índios, aceitasse a missão de abrir caminhos, descobrir rios e povoados, para lançar as linhas telegráficas no centro-oeste brasileiro. E nessa missão foi além das descobertas. Registrou a topografia, estudou a flora e a fauna, se encantou com a riqueza do povo brasileiro e, principalmente, estabeleceu relações respeitosas com os índios, considerados, na época, selvagens sem alma, que culminou na criação do Serviço Nacional de Proteção dos Índios, atual Funai.\r\nRondon, o protetor dos filhos da floresta, encurtou distâncias e trouxe o brasileiro para dentro de seu país.', 'Edição comemorativa do centenário da expedição Rondon. Uma homenagem ao brasileiro que foi chamado de "Marechal da Paz", criador e inspirador de uma política de respeito aos índios.', 1000),
(157, 'Piadinhas Infames ', '', 'piadinhas-infames-', 'Série de piadinhas infantis, para rir aos montes e deixar todos os amigos dando gargalhada. Todas as piadas são ilustradas.', 'Série de piadinhas leves, para rir e fazer os outros rirem.\r\n', 1000),
(158, 'Que É? ', 'O', 'o-que-e-', 'O Que é? Tem coroa e não é rei, tem raiz e não é planta? Explorando as adivinhas do folclore, com divertidíssimos desenhos de Claudius,uma boa brincadeira com os sentidos das palavras.', 'Brincando com adivinhas, sons, imagens e grafia das palavras, a criança aprende enquanto se diverte.', 1000),
(159, 'Ah, Cambaxirra, Se Eu Pudesse... ', '', 'ah-cambaxirra-se-eu-pudesse-', 'Uma cambaxirra contruiu o seu ninho na árvore mais bonita da floresta. Veio o lenhador cortar a árvore, mas o pássaro não perdeu tempo. Lutou com bravura para defender o que é seu, falando com todos os poderosos.\r\n', 'Uma história de amor às árvores, de respeito e defesa dos direitos e que ainda deixa uma pontinha de esperança.\r\n', 1000),
(160, 'Argonautas ', 'Os', 'os-argonautas-', 'Uma famosa aventura marítima que começou em terra.\r\nCoragem, astúcia e persistência guiarão os heróis dessa mitológica aventura marítima.', 'Os Argonautas é um livro que desperta a curiosidade do leitor pela mitologia clássica. Uma das narrativas clássicas fundamentais da mitologia grega. \r\n', 1000),
(161, 'Barbeiro e o Coronel ', 'O', 'o-barbeiro-e-o-coronel-', 'Será que o Barbeiro consegue saber quantos fios de cabelo há na cabeça do Coronel? É melhor ele descobrir logo, se não quiser sofrer nas mãos dos capangas do poderoso e temido fazendeiro.\r\n', 'Quantos fios de cabelo tem na cabeça do coronel? É melhor ele descobrir se não quiser sofrer na mão dos capangas do fazendeiro.\r\n', 1000),
(162, 'Cachinhos de Ouro ', '', 'cachinhos-de-ouro-', 'Era uma vez uma menina muito lourinha que morava numa casa pequenina perto de uma floresta. Num belo dia, andando pela floresta, a menina viu uma casinha linda e, cansada de tanto andar e brincar, resolveu entrar para descansar. Conto popular recontado por Ana Maria Machado.', 'Era uma vez uma menina muito loura que, andando pela floresta, viu uma casinha linda e resolveu entrar. De quem será essa casa tão linda?\r\n', 1000),
(163, 'Cavaleiro do Sonho: As aventuras e desventuras de Dom Quixote de la Mancha ', 'O', 'o-cavaleiro-do-sonho-as-aventuras-e-desventuras-de-dom-quixote-de-la-mancha-', 'Tem gente que olha para o mundo e acha que tudo está em perfeita ordem. Outros se assustam com as injustiças. Outros ainda decidem, com coragem, lutar contra o que consideram errado. Cheios de sonhos, por acreditar num mundo melhor, não temem ser ridicularizados e chamados de loucos. Saem corajosamente lutando contra moinhos de vento, desafiando ovelhas e vacas como se fossem exércitos armados. \r\nAssim era Dom Quixote, leitor de muitos livros. Inspirado em heróis de cavalaria, transformou-se em cavaleiro andante que com Sancho Pança, seu fiel escudeiro, colocou em prática seu maior sonho: consertar o mundo, nem que perdesse a própria vida.\r\nEsta bela história é ilustrada por Candido Portinari, o artista que também sonhava com um mundo melhor. Dom Quixote protegia os fracos e combatia os poderosos com sua velha lança. Portinari denunciava as injustiças com as tintas, que tão mal faziam a sua saúde. E Ana Maria Machado, em tão boas companhias, reescreve a história de Dom Quixote de la Mancha para que você, jovem leitor, lute sempre por um mundo melhor e mais justo, sem medo de parecer tolo aos olhos dos outros.', 'A partir das ilustrações de Cândido Portinari para a obra de Cervantes, a autora evoca esse clássico da literatura e a permanência da utopia no sonho humano.\r\n', 1000),
(164, 'Clássicos de Verdade: Mitos e Lendas greco-romanos ', '', 'classicos-de-verdade-mitos-e-lendas-greco-romanos-', 'Grande parte de nossa cultura nasceu com os gregos e romanos, que nos deixaram um tesouro valiosíssimo - mitos, lendas, fábulas, tragédias e comédias -, cujas marcas nos acompanham até hoje. Reunimos aqui algumas dessas histórias, que vão deixar seus ecos em todos os séculos de nossa era. Às vezes elas parecem contos de fadas, outras vezes fazem lembrar um filme de aventura. São apenas uma pequena amostra da riqueza e da variedade daquilo que a literatura clássica nos deixou como legado. Essas e muitas outras histórias fazem parte da inestimável herança da Antiguidade Clássica. Vale a pena conhecer.\r\n', 'Algumas das mais belas histórias da mitologia clássica, difundidas por Esopo, Apuleio, Putarco e Ovidio, e recontadas para os leitores de hoje.\r\n', 2000),
(165, 'Domador de Monstros', 'O', 'o-domador-de-monstros', 'Sérgio está tentando dormir, mas vê refletido na parede do seu quarto a sombra de árvores, que se parecem monstros cada vez mais feios. Aos poucos, ele aprende a domar os "monstros" junto do seu medo.\r\n', 'O medo natural das crianças com o escuro é abordado com humor e sensibilidade neste livro.\r\n', 1000),
(166, 'Dona Baratinha', '', 'dona-baratinha', 'Dona Baratinha estava varrendo a casa quando achou uma moeda e resolveu se casar. Guardou o dinheiro com cuidado, tomou banho, se arrumou toda, botou uma fita no cabelo e foi para a janela procurar um noivo. Quem vai se casar com Dona Baratinha?\r\n', 'Conto popular recontado por Ana Maria Machado. História doce, que já faz parte do imaginário popular brasileiro.\r\n', 1000),
(167, 'Festa no Céu ', '', 'festa-no-ceu-', 'Na floresta não se falava outra coisa: vai ter uma festa enorme, uma festa ótima. Mas o problema é que a festa vai ser no céu, e bicho que não voa não vai poder ir. Mas o Jabuti quer muito participar dessa festança. Conto popular recontado por Ana Maria Machado.\r\n', 'Vai haver uma festa no céu. Mas como os bichos que não voam vão poder ir?\r\n', 1000),
(168, 'Histórias à Brasileira 1: A Moura Torta e outras', '', 'historias-a-brasileira-1-a-moura-torta-e-outras', 'Não se sabe ao certo quem inventou as narrativas do livro: as pessoas as contam porque ouviram alguém contar para elas. No caso de Ana Maria Machado, quem contava algumas dessas histórias era a avó da escritora. E a avó da Ana Maria, por sua vez, tinha ouvido as mesmas histórias da avó ela. É o caso de "Pimenta no cocuruto", que conta a história de uma galinha que, um belo dia, ciscava debaixo de uma pimenteira. De repente, cai uma pimenta no alto da cabeça dela, bem no cocuruto. A pobre galinha acha que é um aviso de que o mundo está acabando e sai espalhando a notícia para a bicharada."A Moura Torta" é a história de uma velha feiticeira caolha que todo mundo chamava de Moura Torta porque parecia uma bruxa. Ela vai buscar água no riacho, vê o reflexo de uma bela figura feminina na água e pensa que está vendo a si própria. A moça do reflexo, na verdade, é uma princesa encantada. A Moura Torta faz um feitiço e a transforma numa pomba branca para tentar roubar o príncipe da garota.Além de "A Moura Torta" e "Pimenta no cocuruto", o livro traz também os contos "O macaco e a viola", "João Bobo", "Festa no céu", "Dona Baratinha", "O Bicho Folhagem", "O Veado e a Onça", "Maria Sapeba" e "A galinha que criava um ratinho". ', 'Antologia de dez histórias populares de nossa tradição oral, recontadas com a visão e o estilo inconfundíveis da autora.\r\n', 2000),
(169, 'Histórias à Brasileira 2: Pedro Malasartes e outras ', '', 'historias-a-brasileira-2-pedro-malasartes-e-outras-', 'Neste segundo volume, Ana Maria Machado traz mais dez histórias: três episódios envolvendo o personagem Pedro Malasartes - "Pedro Malasartes e o lamaçal colossal", "Pedro Malasartes e o surrão mágico", "Pedro Malasartes e a sopa de pedra" -, além de "Poltrona de piolho", "O boneco de piche", "Os figos da figueira", "O jabuti e o teiú", "O jabuti e o caipora", "A galinha ruiva" e "A vida do gigante".\r\n', 'Segundo volume de coletânea de histórias populares de nossa tradição oral, recontadas com a graça e a linguagem características da autora.\r\n', 2000),
(170, 'Histórias à Brasileira 3: O Pavão Misterioso e outras ', '', 'historias-a-brasileira-3-o-pavao-misterioso-e-outras-', 'Gerações de narradores anônimos ajudaram a construir as mais diferentes versões dessas histórias da cultura oral e do folclore brasileiro e universal. Para criar a sua própria, a escritora leu obras de estudiosos da cultura popular - como Luís da Câmara Cascudo, Sílvio Romero, Monteiro Lobato, entre outros -, pesquisou coletâneas de contos de tradições variadas e, no caso específico da história "O pavão misterioso", buscou inspiração também na literatura de cordel, onde essa narrativa foi imortalizada. \r\nNeste terceiro volume, ela narra "O pavão misterioso", "Cabra Cabrês", "Maria Sabida", "A minhoca da sorte", "O jabuti e a fruta", "O pescador e a Mãe-d''Água", "O pinto Pimpão", "O Príncipe das Penas Verdes", "Quatro vinténs" e "O corcunda e o ricaço"; enquanto as ilustrações de Odilon Moraes recriam o ambiente brasileiro dos contos com liberdade, dando origem a uma nova versão, ilustrada, de cada história.', 'Terceiro volume da série de recontos autorais de contos populares recolhidos na rica tradição oral brasileira.\r\n', 2000),
(171, 'Histórias Árabes', '', 'historias-arabes', 'Caravanas e tapetes mágicos, califas e vizires, povoam as páginas desse belo livro que fala de um Oriente Médio um tanto diferente do que anda pelo noticiário dos jornais.\r\n', 'O livro reúne histórias conhecidas como Ali Babá e os Quarenta Ladrões e outras menos famosas, oriundas das Mil e Uma Noites.\r\n', 1000),
(172, 'Histórias Chinesas', '', 'historias-chinesas', 'A obra reúne quatro histórias da fascinante civilização chinesa: “A casa de porcelana azul”, “A lenda do salgueiro”, “O príncipe e a tartaruga” e “Passeio nas nuvens”, recontadas pela escritora.\r\n', 'Terceiro volume de uma coleção com recontos de histórias de diversos países. Depois da mitologia grega e dos contos árabes das Mil e uma Noites, agora vamos ao outro lado do mundo, com contos da China.\r\n', 1000),
(173, 'João Bobo', '', 'joao-bobo', 'Era uma vez um menino que nasceu meio bobo e foi crescendo mais bobo ainda. Todo mundo zombava dele por causa disso. Na aldeia onde morava, puseram logo nele o apelido de João Bobo. Mas será que ele vai ser bobo para sempre?\r\n', 'A história do João, que era conhecido por ser bobo. Conto popular recontado por Ana Maria Machado.\r\n', 1000),
(174, 'Odisseu e a Vingança do Deus do Mar', '', 'odisseu-e-a-vinganca-do-deus-do-mar', 'Amarrado com sete cordas, um saco de couro não para de se contorcer. Por um descuido de Odisseu, o grande perigo que se escondia dentro do saco está à solta. E o herói grego terá que enfrentar uma grande tempestade, a fúria dos mares e passar por muitas aventuras e sustos até conseguir voltar são e salvo para casa.', 'Segundo volume da série 7 Mares. Nas águas gregas da antiguidade, a autora reconta os perigos marítimos que o herói teve de enfrentar em sua volta para casa depois que acabou a guerra de Troia.\r\n', 1000),
(175, 'Pescador e Mãe D''Água', 'O', 'o-pescador-e-mae-dagua', 'A beleza física e a tristeza do canto da Mãe-d''água impressinam o pescador, que não está mais preocupado com peixes e pescarias. Lua após lua, tudo o que ele quer é poder contemplar a linda moça de cabelos claros e esverdeados sentada numa pedra sobre as ondas. Mas ele terá que aprender a lição de não renegar aquilo que lhe faz bem.\r\n', 'Primeiro título da série 7 Mares. Nas águas tropicais que se estendem entre a Africa e o litoral do Brasil, a autora reconta uma história densa e misteriosa, de paixão e tradição, com toques sobrenaturais.', 1000),
(176, 'Pimenta no Cocuruto', '', 'pimenta-no-cocuruto', 'Uma galinha que com tudo se apavora deixa todos os bichos apavorados. Será mesmo que o mundo vai acabar, como pensa a galinha? Conto folclórico recontado.\r\n', 'Uma história com jeito de vó, contada com carinho sobre uma galinha apavorada.\r\n', 1000),
(177, 'Tapete Mágico', '', 'tapete-magico', 'Este livro reúne quatro histórias de sucesso publicadas isoladamente na coleção Tapete Mágico. Um touro de língua de ouro, um herói que decide sair pelo mundo a procura de uma noiva, uma mulher que se transforma em serpente da cintura para baixo, e dois irmãos gêmeos que brigam desde o nascimento. Vindas de diversos lugares, essas histórias nos revelam a percepção de mundo de diferentes povos, cada qual com seus mitos, crenças e cultura.\r\n', 'Reunião de contos tradicionais de quatro países - Finlândia, França, Jamaica e Canadá - recolhidos pela autora em suas viagens e trazidos para os leitores brasileiros.\r\n', 0),
(178, 'Três Porquinhos', 'Os', 'os-tres-porquinhos', 'Era uma vez três porquinhos que resolveram sair pelo mundo em busca de aventuras. Mas para se proteger do Lobo Mau eles precisavam construir suas casas. Conto popular recontado por Ana Maria Machado.\r\n', 'A clássica história dos três porquinhos, contada por Ana Maria Machado.', 1000),
(179, 'Boa Cantoria', 'Uma', 'uma-boa-cantoria', 'O rei, muito mandão, proibiu: ninguém mais pode cantar nesse reino. E as pessoas, por medo do rei, ficaram anos sem cantar. É claro que um dia isso ia mudar...\r\n', 'O rei não deixa mais ninguém cantar. Como fica o reino sem a música?\r\n', 1000),
(180, 'Veado e a Onça', 'O', 'o-veado-e-a-onca', 'A Onça estava precisando de uma casa para morar e achou um lugar perfeito. O Veado também estava procurando um lugar para montar sua casinha e achou um ótimo espaço. Será que eles vão ser vizinhos?', 'Conto popular recontado por Ana Maria Machado, que trata da convivência entre vizinhos.', 1000),
(181, 'Balaio: Livros e Leituras', '', 'balaio-livros-e-leituras', 'É necessário que uma sociedade que se quer democrática seja capaz de garantir a todos o acesso aos primeiros livros de literatura. E, em seguida, mostrar o caminho para que o leitor possa seguir sozinho com as leituras que irão acompanhá-lo por toda vida. Só livro didático ou leitura de aprimoramento profissional e informação sobre o mundo são absolutamente insuficientes. Nem ao menos são prioritários. É preciso ler literatura, em dieta variada, incluindo livros diferentes, de autores diversos, de estilos variados, de muitas épocas. Nada se compara a ela a esse respeito.', 'Coletânea de 16 textos de palestras e artigos, incluindo Alguns segredos de quem escreve, questões de identidade e cultura no Brasil.\r\n', 4000),
(182, 'Como e por que ler os clássicos universais desde cedo', '', 'como-e-por-que-ler-os-classicos-universais-desde-cedo', 'Ana Maria nos conta nesse livro como, desde cedo, aprendeu a se apaixonar por Dom Quixote. Estava bem acompanhada por Drummond e Robinson Crusoé, Clarice e Narizinho, Hemingway e Huckleberry Finn.\r\nO livro parte de premissas evidentes, mas nem sempre compreendidas: ler não é obrigação, é direito; clássico não é o que é velho, mas o que é eterno sem sair de moda; forçar a ler é inocular o horror a livro; e para começar a ler os clássicos, não é preciso ler o original.\r\nA partir dessas quatro regrinhas básicas, Ana Maria nos conduz por uma irresistível viagem pelo maravilhoso mundo dos clássicos.\r\n', 'Ler é um direito. Que nem comida. Todo mundo deve ter livros ao seu alcance e de preferência, de boa qualidade.\r\n', 4000),
(183, 'Contracorrente ', '', 'contracorrente-', 'Coletânea de artigos e conferências cuja preocupação principal é a literatura. Longe de tratar o assunto com excessos teóricos e tentativas de interpretações originais, Ana Maria Machado prefere o diálogo franco com o leitor.\r\nOs temas vão se sucedendo como nas conversas entre amigos: globalização, curiosidade e coragem, leitura, livros e tecnologias.', 'Coletânea de artigos e conferências sobre leitura e política.\r\n', 4000),
(184, 'Esta Força Estranha ', '', 'esta-forca-estranha-', 'Os fãs da obra de Ana Maria Machado se deliciarão com as histórias de sua vida. Detalhes de sua infância e a trajetória que a tornou escritora estão presentes neste livro-depoimento, em que Ana estabelece um contato pessoal e cúmplice com o leitor.\r\n', 'Pequena auto-biografia da autora, em que conta como se tornou escritora.\r\n', 4000),
(185, 'Ilhas no Tempo: algumas leituras', '', 'ilhas-no-tempo-algumas-leituras', 'Às vezes, no meio do oceano de compromissos e da correria da vida moderna, a gente consegue roubar algum tempinho e cria um hiato que suspende as interferências externas. Um pequeno paraíso em que tudo o mais fica de fora. Pode ser um fim de semana com alguém que se ama, uma tarde no circo com crianças, um ótimo filme, um bom livro, uma caminhada em meio a uma paisagem bonita, uma conversa descontraída com velhos amigos, uma hora sem interrupções ouvindo um CD preferido, uma deliciosa refeição em boa companhia e sem pressa. Costumo pensar nisso como ilhas no tempo".\r\nE é um pouco disso tudo que Ana Maria Machado aborda nestas páginas: conversas sobre leitura, livros, escrita, prazer, política e algumas pessoas que admira.', 'Coletâneas de textos de conferências, palestras e artigos da autora, sobre temas culturais que abrangem o prazer, a leitura, a língua portuguesa e alguns artistas admiráveis da atualidade.\r\n', 4000),
(186, 'Romântico, Sedutor e Anarquista: como e porque ler Jorge Amado hoje', '', 'romantico-sedutor-e-anarquista-como-e-porque-ler-jorge-amado-hoje', 'Ler Jorge Amado é um prazer. Mas, assim como conquistou milhões de leitores mundo afora, o autor baiano sempre encontrou resistência dos intelectuais. Foi alvo de uma crítica equivocada e preconceituosa, que este livro demole com erudição, charme e lucidez.\r\n', 'Após dar um curso na Universidade de Oxford sobre a obra do romancista, Ana Maria faz um balanço do papel do escritor baiano na literatura brasileira.\r\n', 4000),
(187, 'Texturas - sobre Leituras e Escritos  ', '', 'texturas-sobre-leituras-e-escritos-', 'Com o intuito de discutir leituras, livros e personagens, Ana Maria reuniu artigos, ensaios, palestras e prefácios neste livro. Textos distintos, mas que reunidos formam um conjunto de idéias a respeito dessas questões.\r\n', 'Reunião de ensaios, artigos, palestras e prefácios que tratam de livros e escritos.\r\n', 4000),
(188, 'Uma, Duas, Três Princesas', '', 'uma-duas-tres-princesas', 'Em busca de uma solução para livrar o reino de um feitiço terrível que fez o rei adoecer, as filhas colocam em prática tudo o que aprenderam nos livros, revistas, computadores e tablets. Chapeuzinho Vermelho, Gato de Botas, Lobo Mau, João e o Pé de Feijão e a Galinha dos Ovos de Ouro são alguns dos personagens clássicos que aparecem na história. As meninas descobrem nessa jornada que para ter sabedoria é preciso ler muitos livros, conhecer diferentes histórias por completo e conciliar tudo isso com o uso da internet.', 'O que acontece quando um mal misterioso faz o rei cair de cama? No livro de Ana Maria Machado, esse rei tem três filhas, muito estudiosas, que recebem a missão de sair pelo mundo para encontrar um remédio mágico que possa curá-lo. Uma, duas, três princesas é uma releitura contemporânea das clássicas histórias de princesas.', 1000),
(192, 'Sinais do Mar', '', 'sinais-do-mar', 'Ao longo de vinte anos, o mar enviou sinais. Ana Maria Machado soube traduzir, num breve conjunto de poemas, suas misteriosas mensagens. A bússula lírica oscila entre pequenos naufrágios cotidianos e a celebração de uma memória pessoal. Cada verso traz à tona uma discreta música de fundo, uma sutil rede de som e sentido. Neste primeiro livro de poemas, Ana Maria Machado reencontra a longa tradição de nosso cancioneiro.', 'Antologia de poemas sobre o mar, seus sutis sinais, seus vestígios, suas miudezas.', 3000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `moxca_auth_users`
--

DROP TABLE IF EXISTS `moxca_auth_users`;
CREATE TABLE IF NOT EXISTS `moxca_auth_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(80) NOT NULL,
  `name` varchar(120) NOT NULL,
  `password` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `role` int(10) unsigned NOT NULL,
  `status` varchar(80) DEFAULT NULL,
  `first_login` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `apelidoUsuario` (`password`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `moxca_auth_users`
--

INSERT INTO `moxca_auth_users` (`id`, `login`, `name`, `password`, `email`, `role`, `status`, `first_login`, `last_login`) VALUES
(1, 'admin', '', '1cebede82348cd151992cc41693f795d', 'admin@localhost', 10000, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `moxca_blog_posts`
--

DROP TABLE IF EXISTS `moxca_blog_posts`;
CREATE TABLE IF NOT EXISTS `moxca_blog_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `uri` varchar(200) DEFAULT NULL,
  `content` text,
  `summary` text,
  `category` int(10) unsigned DEFAULT NULL,
  `publication_date` datetime DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `last_edition_date` datetime DEFAULT NULL,
  `author` int(10) unsigned NOT NULL,
  `author_name` varchar(200) DEFAULT NULL,
  `status` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `moxca_blog_posts`
--

INSERT INTO `moxca_blog_posts` (`id`, `title`, `uri`, `content`, `summary`, `category`, `publication_date`, `creation_date`, `last_edition_date`, `author`, `author_name`, `status`) VALUES
(1, 'Encontros com os leitores', 'encontros-com-os-leitores', 'Durante o mês de junho, Ana Maria Machado teve a oportunidade de encontrar com seus leitores em diferentes pontos do país.\r\n\r\nNo Salão do Livro Infantil da FNLIJ, no Rio, fez o lançamento de “Histórias Chinesas”, conversou com a criançada e deu autógrafos.\r\n\r\nJá em Mato Grosso, no Salão do Livro de Tangará da Serra, encontrou meninas e bonecas vestidas como a personagem de “Menina Bonita do Laço de Fita”, fez palestras para professores e assistiu a dramatizações de obras suas como “O Menino Pedro e seu Boi Voador” - às voltas com um imenso boi , feito pelas crianças, que dançava pelo meio da multidão. As fotos do evento mostram a alegria de crianças e adultos com a presença da autora no Salão do Livro.', '', 1, '2013-10-07 18:45:00', '2013-10-07 18:42:05', NULL, 1, '', 3000),
(2, 'Ana Maria Machado faz discurso de abertura em Frankfurt', 'ana-maria-machado-faz-discurso-de-abertura-em-frankfurt', '<p>Ana Maria Machado,&nbsp;juntamente com o escritor mineiro Luiz Rufatto, fez o discurso de abertura da Feira Internacional do Livro de Frankfurt.&nbsp;O evento deste ano acontece de 9 a 13 outubro e o Brasil &eacute; o pa&iacute;s homenageado.</p>\r\n<p>&ldquo;Ao agradecermos o convite para esta vinda a Frankfurt, retribu&iacute;mos tamb&eacute;m com outro convite: venham conhecer o Brasil que est&aacute; nos livros, o Brasil que escreve e se escreve&rdquo;, afirmou Ana Maria Machado em seu discurso.</p>\r\n<p>Ana Maria Machado disse, ainda, que a literatura feita no Brasil tem muito a oferecer, na variedade de prot&oacute;tipos, na inquieta&ccedil;&atilde;o, na inova&ccedil;&atilde;o, nos mais variados registros de di&aacute;logo ir&ocirc;nico com o c&acirc;none em piscadelas liter&aacute;rias do todo tipo, das mais refinadas e sutis &agrave;s mais divertidas e escrachadas par&oacute;dias, pastiches, intertextualidades: &ldquo;Mas tenham certeza de que v&atilde;o encontrar o reverberar dos problemas brasileiros nas obras de variados autores de percep&ccedil;&atilde;o aguda&rdquo;.</p>', '', 1, '2013-10-08 14:19:17', '2013-10-08 14:15:17', NULL, 1, '', 3000),
(5, 'Autora participa de eventos na Inglaterra e Bélgica', 'autora-participa-de-eventos-na-inglaterra-e-belgica', '<p>Antes da Feira Internacional do Livro de Frankfurt, Ana Maria Machado participou de uma s&eacute;rie de atividades na Europa.</p>\r\n<p>Nos dias 26 e 27 de setembro, a convite da Embaixada do Brasil na B&eacute;lgica, a autora participou um programa de leitura sobre sua obra, com debates e confer&ecirc;ncias nas Universidades de Bruxelas e da Antu&eacute;rpia.&nbsp;</p>\r\n<p>Em seguida, de 3 a 6 de outubro, marcou presen&ccedil;a na&nbsp;FLIPSIDE, em Snape Maltings, no&nbsp;Festival Liter&aacute;rio do Reino Unido, onde fez parte de uma mesa-redonda, al&eacute;m de uma sess&atilde;o de leituras de sua obra e de um encontro com crian&ccedil;as.</p>', '', 1, '2013-10-08 14:36:29', '2013-10-08 14:36:29', NULL, 1, '', 3000),
(7, 'Tropical Sol Da liberdade ganha resenha em "El País"', 'tropical-sol-da-liberdade-ganha-resenha-em-el-pais', '<p>O jornal espanhol &ldquo;El Pa&iacute;s&rdquo; publicou, no dia 28 de setembro, resenha do livro Tropical Sol da Liberdade.</p>\r\n<p>&ldquo;Um romance de intensa profundidade, carregado de sabedoria narrativa e sensibilidade, cujo tom nunca se perde, que alcan&ccedil;a a outra margem do rio que atravessa o bosque dos enormes jequitib&aacute;s com a batida r&iacute;tmica, segura, de um cora&ccedil;&atilde;o apaixonado, rebelde&rdquo;.</p>\r\n<p>Veja o texto completo da resenha no link abaixo:</p>\r\n<p><a href="http://cultura.elpais.com/cultura/2013/09/25/actualidad/1380120107_293167.html">http://cultura.elpais.com/cultura/2013/09/25/actualidad/1380120107_293167.html</a></p>', '', 2, '2013-10-08 15:08:58', '2013-10-08 15:08:58', NULL, 1, '', 3000),
(8, 'Primeiros Passos', 'primeiros-passos', '<p><img style="float: right;" src="/img/up/eu_e_pais.jpg" alt="Eu e meus pais, em 1942." width="320" />Meu nome &eacute; Ana Maria Machado e eu vivo inventando hist&oacute;rias. E dessas que eu escrevo, algumas viram livros. Adoro o meu trabalho. Ainda bem, porque acho que n&atilde;o ia conseguir viver se n&atilde;o escrevesse. J&aacute; fui professora, j&aacute; fui jornalista, j&aacute; fiz programa de r&aacute;dio, j&aacute; tive uma livraria e nesse tempo todo nunca parei de escrever. &nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img style="float: left;" src="/img/up/mang_antigo.jpg" alt="Manguinhos, 1952. S&iacute;tio como o do Pica Pau Amarelo, s&oacute; que com mar na porteira." width="240" />Nasci e me criei no Rio, mas quando era crian&ccedil;a costumava passar os ver&otilde;es na praia de Manguinhos, no Esp&iacute;rito Santo. Ficava quase tr&ecirc;s meses por ano &agrave; beira do mar, com meus av&oacute;s, junto &agrave; natureza e &agrave;s tradi&ccedil;&otilde;es. Como n&atilde;o havia eletricidade, todas as noites as pessoas se reuniam para contar e escutar hist&oacute;rias. Cada adulto tinha a sua especialidade, contando os mais variados tipos de hist&oacute;ria. Tenho certeza que sem os ver&otilde;es em Manguinhos eu escreveria bem diferente.</p>\r\n<p><img style="float: right;" src="/img/up/crescidinha.jpg" alt="Eu, aos 5 anos, em 1947" width="200" />Aprendi a ler sozinha, com menos de cinco anos. Depois de deixar minha professora e minha m&atilde;e assustadas (acharam que poderia fazer mal!), comecei a mergulhar em leituras como o Almanaque do Tico-Tico e os livros de Monteiro Lobato. Foi nesse per&iacute;odo que encontrei o livro que marcaria a minha vida para sempre: Reina&ccedil;&otilde;es de Narizinho.</p>\r\n<p style="text-align: left;">No meu anivers&aacute;rio de sete anos, ganhei de presente um marcante e inesquec&iacute;vel di&aacute;rio. Era um fich&aacute;rio preto, de tr&ecirc;s furos, onde eu podia guardar tudo o quisesse e trancar para ningu&eacute;m ver. Na primeira p&aacute;gina tinha um desenho lindo, feito por encomenda a um pintor argentino chamado Caryb&eacute;. Nesse tempo ele ainda n&atilde;o tinha virado baiano nem ilustrador de Jorge Amado e Garcia M&aacute;rquez. Sa&iacute; escrevendo furiosamente no di&aacute;rio.</p>\r\n<p style="text-align: left;"><img style="float: left;" src="/img/up/arrastao.jpg" alt="Pesca de arrast&atilde;o em Manguinhos" width="320" />Era uma boa aluna e vivia ganhando pr&ecirc;mios &ndash; em geral livros, da fam&iacute;lia. Uma das minhas reda&ccedil;&otilde;es foi t&atilde;o elogiada e premiada que a mostrei em casa. Meu tio Nelson, que estava l&aacute;, levou o texto para o meu tio Guilherme, folclorista &ndash; e essa acabou sendo a minha estr&eacute;ia liter&aacute;ria. Devidamente assinado e aumentado, por encomenda da revista Folclore, saiu publicado meu Arrast&atilde;o, sobre as redes de pesca artesanal em Manguinhos. O meu orgulho supremo foi que a revista n&atilde;o falava que o texto tinha sido feito por uma menina de doze anos.</p>', '', 1, '2014-01-09 17:41:09', '2013-10-09 12:44:09', NULL, 1, '', 3000),
(9, 'Pintando o caneco', 'pintando-o-caneco', '<p><img style="float: right;" title="Rubem Braga" src="/img/up/02_01.gif" alt="Rubem Braga" width="200" />A minha adolesc&ecirc;ncia foi repleta de livros, que me proporcionaram grandes prazeres e descobertas. Ficava abismada com o jeito de escrever de grandes autores e cronistas, como Rubem Braga. Na escola, em casa e com meus amigos, estava sempre rodeada de gente que tamb&eacute;m gostava de curtir a vida tendo bons livros ao seu lado.</p>\r\n<p>&nbsp;</p>\r\n<p><img style="float: left;" title="Eu e Alo&iacute;sio Carv&atilde;o." src="/img/up/02_02.jpg" alt="Eu e Alo&iacute;sio Carv&atilde;o." width="200" />Estava no cient&iacute;fico quando comecei a estudar pintura, primeiro na Escolinha de Arte do Brasil, depois no Atelier Livre do Museu de Arte Moderna. Foi nesse curso que tive o privil&eacute;gio de ter aulas com Alo&iacute;sio Carv&atilde;o, por quem guardo at&eacute; hoje um carinho muito grande. Nunca algu&eacute;m tinha sido t&atilde;o exigente comigo e ao mesmo tempo me dado tanta for&ccedil;a, me preparando para a dureza de ser artista.</p>\r\n<p><img style="float: right;" title="Pintando nos idos da d&eacute;cada de 70." src="/img/up/02_03.jpg" alt="Pintando nos idos da d&eacute;cada de 70." width="240" />Chegou a hora de fazer vestibular, e eu n&atilde;o tinha id&eacute;ia de que curso escolher. Na d&uacute;vida entre qu&iacute;mica e arquitetura, acabei optando por geografia, pensando que aprenderia assuntos como geografia econ&ocirc;mica ou entenderia de modo mais profundo a sociedade brasileira. Mas a faculdade me desapontou, com a exig&ecirc;ncia de muito conhecimento exato. Para mim, no fundo, nada disso importava ou teria utilidade. O que eu queria mesmo era trabalhar como pintora.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img style="float: left;" title="Conversando com algumas crian&ccedil;as." src="/img/up/02_04.jpg" alt="Conversando com algumas crian&ccedil;as." width="240" />Menos de um ano depois, cansada de examinar rochas e eixos de cristalografia, mudei de curso e fui estudar letras. Tamb&eacute;m comecei a trabalhar como professora, dando aulas de portugu&ecirc;s, latim e franc&ecirc;s (em ingl&ecirc;s!) numa escola americana. Mesmo com tantas atividades, ia seguindo com a carreira de pintora, fazendo exposi&ccedil;&otilde;es individuais e coletivas.</p>\r\n<p>&nbsp;</p>\r\n<p><img style="float: right;" title="Eu e Ruth em Berlim, 1994." src="/img/up/02_07.jpg" alt="Eu e Ruth em Berlim, 1994." width="240" />De repente, tudo ficou mais s&eacute;rio. Me formei e fiz mestrado, casei com o m&eacute;dico &Aacute;lvaro Machado, mudei de sobrenome e de cidade, indo para S&atilde;o Paulo. Passei a escrever artigos para a revista Realidade e a Enciclop&eacute;dia Bloch, al&eacute;m de traduzir textos e continuar pintando. Nesse per&iacute;odo nasceu meu primeiro filho, Rodrigo. Tamb&eacute;m ganhei uma amiga para a vida toda, a escritora Ruth Rocha, que virou minha cunhada.</p>\r\n<p>Recebi certo dia uma liga&ccedil;&atilde;o da Editora Abril, me chamando para escrever em uma nova revista voltada para crian&ccedil;as, e que se chamaria Recreio. N&atilde;o acreditei no convite, afinal era professora universit&aacute;ria, nunca tinha feito nada parecido. Mesmo assim, insistiram em mim e acabei topando. A revista fez um sucesso imenso, e acabou abrindo caminhos para a nova literatura infantil brasileira.</p>\r\n<p><img style="float: left;" title="Capa de uma das primeiras revistas Recreio." src="/img/up/02_06.jpg" alt="Capa de uma das primeiras revistas Recreio." width="240" /></p>', '', NULL, '2014-01-08 17:41:09', '2013-10-09 12:47:05', NULL, 1, '', 3000),
(10, 'Aquele Abraço', 'aquele-abraco', '<p><img style="float: right;" title="Casa de meus pais em Manguinhos, descrita no livro." src="/img/up/03_01.jpg" alt="Casa de meus pais em Manguinhos, descrita no livro." width="240" />Em 1969, o pa&iacute;s estava em plena ditadura. J&aacute; viv&iacute;amos sob o peso do Ato Institucional no 5, que fechou o Congresso, instituiu a censura e consolidou a tortura. O segundo semestre desse ano foi particularmente dif&iacute;cil para mim. Fui presa, tive colegas, amigos e alunos detidos. Quando o ano acabou, estava desmontando minha casa e fazendo malas para deixar o pa&iacute;s. Anos depois, escreveria sobre essa &eacute;poca no romance "Tropical Sol da Liberdade".</p>\r\n<p><img style="float: left;" title="Em Paris, brincando com meu filho Rodrigo." src="/img/up/03_02.jpg" alt="Em Paris, brincando com meu filho Rodrigo." width="240" />Fui para Paris em janeiro de 1970, onde trabalhei como jornalista na revista Elle e como professora em Sorbonne. Tamb&eacute;m trabalhei numa biblioteca, cuidando do setor sobre a Am&eacute;rica Latina, fiz dublagem de document&aacute;rios e participei de exposi&ccedil;&otilde;es de pintura. E tratei de aproveitar a oportunidade para estudar e aprender bastante.</p>\r\n<p>&nbsp;</p>\r\n<p><img style="float: right;" title="Cart&atilde;o de identifica&ccedil;&atilde;o como aluna de Barthes." src="/img/up/03_03.jpg" alt="Cart&atilde;o de identifica&ccedil;&atilde;o como aluna de Barthes." width="280" />Virei aluna da Ecole Pratique des Hautes Etudes, onde reinava soberano o famoso semi&oacute;logo Roland Barthes. Em suas aulas, ele chegava a encher um anfiteatro com 800 estudantes, mas tamb&eacute;m orientava em separado a um pequeno grupo de 20 estudantes. Depois de uma entrevista, ele me chamou para pertencer a esse grupo. Sob a sua orienta&ccedil;&atilde;o, escrevi a tese de doutorado que acabou virando livro - "O Recado do Nome", que trata da obra de Guimar&atilde;es Rosa. Nesse per&iacute;odo, em abril de 1971, nasceu Pedro, meu segundo filho.</p>\r\n<p><img style="float: left;" title="m Londres, com meus filhos Rodrigo e Pedro." src="/img/up/03_04.jpg" alt="m Londres, com meus filhos Rodrigo e Pedro." width="240" />Estava com dois filhos pequenos em um pa&iacute;s estranho, tinha o trabalho, a tese e a casa para cuidar. Mesmo assim, n&atilde;o parei de escrever as hist&oacute;rias infantis. J&aacute; estava definitivamente viciada em escrev&ecirc;-las. Quando n&atilde;o as mandava para a revista Recreio publicar, guardava na gaveta o que escrevia. Surgiu uma oportunidade e fui para Londres, trabalhar na BBC. Ficaria por um ano e meio. O fim do ex&iacute;lio estava pr&oacute;ximo...</p>\r\n<p>&nbsp;</p>', '', NULL, '2014-01-07 17:41:09', '2013-10-09 12:50:49', NULL, 1, '', 3000),
(11, 'Agora para ficar', 'agora-para-ficar', '<p><img style="float: right;" title="Com Caetano Veloso, na R&aacute;dio Jornal do Brasil, em 1976." src="/img/up/04_01.jpg" alt="Com Caetano Veloso, na R&aacute;dio Jornal do Brasil, em 1976." width="240" />A volta ao Brasil veio no final de 1972. Concentrei-me na imprensa e fui trabalhar no Jornal do Brasil. De rep&oacute;rter passei a chefe do departamento de jornalismo da R&aacute;dio JB, onde fiquei durante sete anos. Entrevistei um monte de gente, orientei mais um monte, e ganhei muita intimidade com um tipo de linguagem oral e acess&iacute;vel.</p>\r\n<p><img style="float: left;" title="Carta do escritor Carlos Drummond de Andrade falando do livro." src="/img/up/04_02.jpg" alt="Carta do escritor Carlos Drummond de Andrade falando do livro." width="240" />Meu primeiro livro infantil, "Bento-que-bento-&eacute;-o-frade", foi publicado cinco anos depois da minha chegada. Ele fazia parte da cole&ccedil;&atilde;o Livros de Recreio. Outra s&eacute;rie foi montada pela Editora Abril - Hist&oacute;rias de Recreio. Nesta, foram selecionados os contos de maior sucesso da revista, divididos por autor. Os meus t&iacute;tulos foram "Severino faz chover", "Currupaco Papaco" e "Camil&atilde;o, o Comil&atilde;o", cada um com quatro hist&oacute;rias.</p>\r\n<p>&nbsp;</p>\r\n<p><img style="float: right;" title="Capa de uma das primeiras edi&ccedil;&otilde;es do livro Hist&oacute;ria meio ao contr&aacute;rio." src="/img/up/04_03.jpg" alt="Capa de uma das primeiras edi&ccedil;&otilde;es do livro Hist&oacute;ria meio ao contr&aacute;rio" width="160" />O primeiro pr&ecirc;mio viria logo a seguir. Em 1978, participei de um concurso, sob pseud&ocirc;nimo, e acabei ganhando o pr&ecirc;mio Jo&atilde;o de Barro, com "Hist&oacute;ria Meio ao Contr&aacute;rio", que depois tamb&eacute;m ganhou o Jaboti. Al&eacute;m da publica&ccedil;&atilde;o do livro, essa premia&ccedil;&atilde;o desencadeou uma s&eacute;rie de convites de editores para publicar mais textos meus, e fui tirando o que tinha guardado nas gavetas. Acabei ganhando mais pr&ecirc;mios e me dedicando cada vez mais a escrever.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img style="float: left;" title="Malasartes, 1990." src="/img/up/04_04.jpg" alt="Malasartes, 1990." width="240" />Em 1979, um dia quis dar um livro a uma sobrinha que fazia anos. Bati perna por todas as livrarias de Ipanema e Copacabana e n&atilde;o achei um &uacute;nico livro infantil que me agradasse! Percebi logo que estava faltando uma livraria especializada, onde as crian&ccedil;as pudessem ler e encontrar bons livros. Com a ajuda de uma s&oacute;cia surgiu a Livraria Malasartes, onde eu ficaria por 18 anos.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img style="float: right;" title="Eu e Louren&ccedil;o, em 1989." src="/img/up/04_05.jpg" alt="Eu e Louren&ccedil;o, em 1989.o" width="240" /></p>\r\n<p>&nbsp;</p>\r\n<p>Em 1980, passei por um momento decisivo dentro da R&aacute;dio JB. Diante de uma ordem para demitir um ter&ccedil;o da reda&ccedil;&atilde;o, optei pela minha pr&oacute;pria demiss&atilde;o. Com o jornalismo devidamente abandonado, mudei de vida. Iniciava um segundo casamento, com o m&uacute;sico Louren&ccedil;o Baeta. Passei a cuidar de minha livraria e me dediquei mais a escrever, dando seguimento a um romance que come&ccedil;ara dois anos antes, "Alice e Ulisses".</p>', '', NULL, '2014-01-06 17:41:09', '2013-10-09 12:52:03', NULL, 1, '', 3000),
(12, 'Mil Histórias', 'mil-historias', '<p><img style="float: right;" title="Lan&ccedil;amento do livro " src="/img/up/05_01.jpg" alt="Lan&ccedil;amento do livro " width="200" />Em seguida, o que houve foi uma verdadeira surpresa para mim: comecei a ganhar pr&ecirc;mios, de melhor livro nacional do ano, de melhor livro do bi&ecirc;nio, e muitos outros. At&eacute; mesmo do exterior veio o reconhecimento, com o Pr&ecirc;mio Casa de las Am&eacute;ricas, em Cuba, ao qual concorri num gesto de ousadia, com um livro infantil ("De Olho nas Penas") competindo com literatura adulta, e venci. Foi muito emocionante perceber que aquilo que eu gostava tanto de fazer chegava a outras pessoas.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img style="float: left;" title="Eu e minha filha Lu&iacute;sa." src="/img/up/05_02.jpg" alt="Eu e minha filha Lu&iacute;sa." width="240" />Em 1983, nasceu Lu&iacute;sa. No mesmo ano, tomei coragem e publiquei meu primeiro romance para adultos, "Alice e Ulisses", muito bem recebido pela cr&iacute;tica. Ao mesmo tempo, meus livros foram come&ccedil;ando a ser traduzidos no exterior, primeiro nos pa&iacute;ses escandinavos e, em seguida, na Alemanha, na Fran&ccedil;a e na Espanha. Paralelamente, fui passando a fazer palestras para professores pelo interior do Brasil e desenvolvi cursos e semin&aacute;rios sobre promo&ccedil;&atilde;o de leitura no exterior.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img style="float: right;" title="Feliz com a tranq&uuml;ilidade de Manguinhos." src="/img/up/05_03.jpg" alt="Feliz com a tranq&uuml;ilidade de Manguinhos." width="240" />De 1986 a 1988, fizemos uma coisa maravilhosa: deixamos a cidade grande e nos mudamos para uma casinha pequenina em Manguinhos. Uma verdadeira volta as ra&iacute;zes. Uma vida muito modesta e recolhida, em contato direto com o mar e a natureza. Lu&iacute;sa ia a escola com os filhos dos moradores locais, Louren&ccedil;o compunha e tocava, eu escrevia.</p>\r\n<p><img style="float: left;" title="Passeando no Regent&acute;s Park, Londres - 1990." src="/img/up/05_04.jpg" alt="Passeando no Regent&acute;s Park, Londres - 1990." width="240" />De Manguinhos para o mundo... Em fim de 1989, me ofereceram um novo contrato com a BBC e voltei para Londres, onde passei oito meses e terminei de escrever o romance "Canteiros de Saturno". Pouco depois de voltar ao Brasil, em meio a muito trabalho, tive problemas de sa&uacute;de muito s&eacute;rios. Por um longo tempo toda minha vida ficou direcionada a enfrentar essa situa&ccedil;&atilde;o, ajudada pelo carinho de tanta gente que me quer bem e apoiada pelo meu trabalho.</p>\r\n<p><img style="float: right;" title="Junto da est&aacute;tua de Hans Christian Andersen, em Nova Iorque." src="/img/up/05_05.jpg" alt="Junto da est&aacute;tua de Hans Christian Andersen, em Nova Iorque." width="200" />Os &uacute;ltimos anos tem sido principalmente de coisas boas, que as outras a gente esquece. Dois netos maravilhosos: Henrique em 1996 e Isadora em 2000. Nesse mesmo ano, ganhei tamb&eacute;m o pr&ecirc;mio Hans Christian Andersen, coisa que me trouxe muita alegria. &Eacute; incr&iacute;vel saber que um j&uacute;ri internacional, sem nenhum brasileiro, analisou o conjunto de minha obra e concluiu que eu merecia ser considerada a melhor autora do mundo...</p>\r\n<p>Em 2001, tive uma surpresa maravilhosa: ganhei o maior pr&ecirc;mio liter&aacute;rio nacional, o Machado de Assis, que a Academia Brasileira de Letras confere por toda a obra de um autor. Uma honra dessas ainda veio se somar as condecora&ccedil;&otilde;es. Recebi a Medalha Tiradentes, da Assembl&eacute;ia Legislativa do Rio, e a Ordem do M&eacute;rito Cultural, da Presid&ecirc;ncia da Rep&uacute;blica. Uma verdadeira consagra&ccedil;&atilde;o. Puxa, nem com uma varinha m&aacute;gica uma fada-madrinha podia me dar isso...&nbsp;</p>\r\n<p><img style="float: left;" title="Com o presidente Fernando Henrique Cardoso, recebendo a Ordem do M&eacute;rito Cultural." src="/img/up/05_06.jpg" alt="Com o presidente Fernando Henrique Cardoso, recebendo a Ordem do M&eacute;rito Cultural." width="280" /></p>', '', NULL, '2014-01-05 17:41:09', '2013-10-09 12:53:27', NULL, 1, '', 3000),
(13, 'Uma conquista histórica', 'uma-conquista-historica', '<p><img style="float: right;" title="Com o Dr. Evandro Lins e Silva durante cerim&ocirc;nia de premia&ccedil;&atilde;o do Pr&ecirc;mio Machado de Assis na ABL em 2001" src="/img/up/06_01.jpg" alt="Com o Dr. Evandro Lins e Silva durante cerim&ocirc;nia de premia&ccedil;&atilde;o do Pr&ecirc;mio Machado de Assis na ABL em 2001" width="240" />Eu era muito amiga do doutor Evandro Lins e Silva. Minha irm&atilde; foi casada com um filho dele, ent&atilde;o a gente conviveu muito. Ele v&aacute;rias vezes me falou que eu deveria me candidatar, que ele gostaria muito de me ver na Academia Brasileira de Letras. E quando ele morreu eu fiquei muito triste com o acontecido, mas pensei que a hora era aquela.</p>\r\n<p>Candidatei-me e fui eleita para a cadeira n&uacute;mero 1. Esta escolha &eacute; um marco, pois at&eacute; hoje jamais havia sido escolhido para a Academia um autor com uma obra significativa para o p&uacute;blico infantil. Nem mesmo Monteiro Lobato quando se candidatou.</p>\r\n<p><img style="float: left;" title="Em recep&ccedil;&atilde;o ocorrida na Editora Nova Fronteira, com os acad&ecirc;micos Evanildo Bechara, Alberto da Costa e Silva, Murilo Melo Filho no dia da elei&ccedil;&atilde;o para a ABL" src="/img/up/06_02.jpg" alt="Em recep&ccedil;&atilde;o ocorrida na Editora Nova Fronteira, com os acad&ecirc;micos Evanildo Bechara, Alberto da Costa e Silva, Murilo Melo Filho no dia da elei&ccedil;&atilde;o para a ABL" width="240" />A posse aconteceu no dia 29 de agosto de 2003. Faz parte da tradi&ccedil;&atilde;o da Academia quem est&aacute; tomando posse homenagear o antecessor. Para mim, essa tarefa foi muito prazeirosa, j&aacute; que pude falar de afetuosas lembran&ccedil;as do meu conv&iacute;vio pessoal com o meu querido amigo Evandro Lins e Silva.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img style="float: right;" title="Inaugura&ccedil;&atilde;o de Sala de Leitura Ana Maria Machado na Escola Normal Julia Kubitschek, Rio de Janeiro, em 2006" src="/img/up/06_03.jpg" alt="Inaugura&ccedil;&atilde;o de Sala de Leitura Ana Maria Machado na Escola Normal Julia Kubitschek, Rio de Janeiro, em 2006" width="240" />Mas, acad&ecirc;mica ou n&atilde;o, continuo muito dedicada &agrave;s quest&otilde;es de incentivo &agrave; leitura. Viajo muito, no Brasil e no exterior, tendo reuni&otilde;es e fazendo conferencias sobre esse assunto e temas ligados a ele. Sei muito bem que hoje em dia, com as novas tecnologias, o livro n&atilde;o &eacute; mais o eixo central em torno do qual gira toda a cultura. Mas acho justo que todas as pessoas possam ter acesso a tudo o que a leitura pode nos trazer.</p>\r\n<p>Sobretudo, continuo muito interessada em ler e escrever. E meus leitores crescem, se espalham, se multiplicam por toda parte, o que me enche de alegria. Mais at&eacute; do que as tradu&ccedil;&otilde;es e os premios em diferentes pa&iacute;ses, que evidentemente me deixam contente. Mas &eacute; para o leitor que um autor escreve. S&oacute; com um leitor &eacute; que o livro se completa.</p>\r\n<p><img style="float: left;" title="Sinais do Mar, lan&ccedil;ado pela Cosac Naify em 2009, com projeto gr&aacute;fico de Luciana Facchini" src="/img/up/06_04.jpg" alt="Sinais do Mar, lan&ccedil;ado pela Cosac Naify em 2009, com projeto gr&aacute;fico de Luciana Facchini" width="240" />Em 2009, lancei um livro muito especial para mim: Sinais do Mar. Uma reuni&atilde;o de poemas que vim escrevendo ao longo de muitos anos. Todos sobre o mar. n&atilde;o sei dizer para que idade de leitores ele se destina. Por isso, quis que fosse bem neutro, ao alcance de adultos e crian&ccedil;as. Sem ilustra&ccedil;&atilde;o, apenas com um bel&iacute;ssimo trabalho gr&aacute;fico. Uma maneira de continuar meu di&aacute;logo com o mar, que me acompanha desde que nasci.</p>', '', 1, '2014-01-04 17:41:09', '2013-10-09 12:54:49', NULL, 1, '', 3000),
(14, 'Do outro lado tem segredos', 'do-outro-lado-tem-segredos', '<p>A autora d&aacute; seu depoimento sobre esse livro:<br /><br /><em>Este &eacute; um livro em que mergulhei de modo muito forte na minha rela&ccedil;&atilde;o de vida com Manguinhos (Esp&iacute;rito Santo): o mar, os amigos pescadores, as festas e folguedos tradicionais em que sempre vivi imersa l&aacute;, desde a inf&acirc;ncia. H&aacute; alguns c&acirc;nticos que eu nem lembrava que sabia e, &agrave; medida que ia escrevendo o livro, voltavam com for&ccedil;a a mem&oacute;ria. Num deles, quando eu quis conferir uma palavra que tinha esquecido e telefonei a minha m&atilde;e para tentar saber, ela at&eacute; levou um susto. Disse que era incr&iacute;vel eu lembrar, porque quem puxava essa cantoria era um velho pescador que morreu antes de eu fazer dez anos, e nunca mais ela ouvira cantar&hellip; De qualquer modo, continua muito forte a presen&ccedil;a do Congo na tradi&ccedil;&atilde;o capixaba, e as novas gera&ccedil;&otilde;es n&atilde;o deixam que ele se acabe. Tenho muito orgulho de que, em Manguinhos, eu, meus irm&atilde;os, filhos e sobrinhos somos aceitos como &ldquo;nativos&rdquo; e incorporados na hora de bater congo, chamados a cantar ou dan&ccedil;ar juntos.<br /><br />Tamb&eacute;m o ambiente de pescaria com rede de arrast&atilde;o est&aacute; muito presente nessa hist&oacute;ria. E tamb&eacute;m n&atilde;o &eacute; s&oacute; da inf&acirc;ncia. &Eacute; de sempre. Tenho fotos em que minha m&atilde;e aparece, menina, em 1929, no meio da crian&ccedil;ada que ajudava os adultos (como meu av&ocirc;) a puxar a rede. E tenho fotos minhas, de meus filhos, de meu neto na mesma atividade. O que mudou foi a import&acirc;ncia dessa forma de pesca para a comunidade e os resultados dela. Hoje se pesca menos manjuba, menos peixe em geral &ndash; efeito de muito tempo de pesca predat&oacute;ria nas redondezas , das redes de nylon, da constru&ccedil;nao de grandes portos nas vizinhan&ccedil;as. A rede de arrast&atilde;o, artesanal, deixou de ser uma modalidade importante de pesca, mas ainda acontece por l&aacute;.<br /><br />E vale a pena lembrar uma curiosidade: meu primeiro texto publicado em toda a vida se chamava &lsquo;Arrast&atilde;o&rdquo;, na revista Folclore. Eu tinha uns 12 anos e descrevia justamente uma pesca desse tipo em Manguinhos. N&atilde;o guardei nada, claro. Mas ficou na mem&oacute;ria. E muitos anos depois, ap&oacute;s a publica&ccedil;&atilde;o de Do outro lado tem segredos, apareceu esse original, manuscrito em papel alma&ccedil;o, que tinha sido guardado por um de meus tios. Fiquei surpresa em ver quanto da descri&ccedil;&atilde;o que fiz no livro j&aacute; estava embrion&aacute;ria na reda&ccedil;&atilde;o infantil.<br /><br />Tenho a impress&atilde;o de que, ao escrever sobre esses outros lados todos, despertei segredos misteriosos que v&atilde;o muito al&eacute;m da mem&oacute;ria de nossa cultura e falam tamb&eacute;m de profundezas da minha vida.<br /></em><br /><br />Quando esse livro foi lancado, o grande cr&iacute;tico brasileiro Alceu Amoroso Lima, que tamb&eacute;m usava o pseud&ocirc;nimo Trust&atilde;o de Athayde, escreveu sobre ele a seguinte cr&ocirc;nica, no Jornal do Brasil:<br /><br /><br />Um id&iacute;lio<br />Trist&atilde;o de Athayde<br /><br /><em>Ana Maria Martins foi uma de minhas melhores alunas na Faculdade Nacional de Filosofia. Seu primeiro livro, j&aacute; com o nome de Ana Maria Machado, foi uma tese t&atilde;o importante sobre o Recado do Nome. Leitura de Guimar&atilde;es Rosa &agrave; luz do nome de seus personagens (1976), que Antonio Houaiss escreveu, em seu pref&aacute;cio, que &ldquo;este ensaio, que &eacute; inclusive um desvairo de beleza verbal, levanta um divisor de &aacute;guas no g&ecirc;nero, antes dele e o que se tentar&aacute; depois&rdquo;. Disc&iacute;pula de Roland Barthes e familiar dos segredos mais atuais do linguist&ecirc;s, idioma cr&iacute;tico moderno equivalente ao econom&ecirc;s dos mais modernos economistas, Ana Maria Machado (na linha filos&oacute;fica de Heidegger, de que a palavra cria a coisa), ingressou nas letras como um adestrado piloto, no arquip&eacute;lago da cr&iacute;tica mais moderna e sofisticada, na qual o mist&eacute;rio da palavra &eacute; dissecado em sua mais &iacute;ntima anatomia.<br />Pois bem, essa jovem capit&atilde; de longo curso semi&oacute;tico volta agora &agrave;s letras ou pelo menos lan&ccedil;a a sua rede liter&aacute;ria a cardumes totalmente diversos. Em vez do mar alto das extremas complexidades formal&iacute;sticas, em que Guimar&atilde;es Rosa foi maestro di color che sanno, fica na praia, com o seu jovem her&oacute;i Benedito ou Bino, filho de pescador, de um recanto de nosso litoral n&atilde;o identificado. O menino fica na praia, mas olhando nostalgicamente para o alto-mar e prevendo que &ldquo;do outro lado tem segredo&rdquo;. &Eacute; o t&iacute;tulo dessa pequena novela, entendida como uma narrativa para crian&ccedil;as. O problema da literatura infantil sempre me preocupou e no primeiro volume dos meus pr&oacute;prios Estudos (1927) sustentei que as crian&ccedil;as e n&atilde;o os adultos deveriam escrever &ldquo;para crian&ccedil;as&rdquo;. Mas, se &eacute; verdade &ldquo;a eterna contradi&ccedil;&atilde;o humana&rdquo;, do nosso mestre em mist&eacute;rios psicoliter&aacute;rios, tamb&eacute;m &eacute; verdade que os adultos se interessam, cada vez mais, com coisas de crian&ccedil;a e estas com coisas de adultos.<br />Seja como for, essa volta de Ana Maria Machado &agrave;s letras, j&aacute; n&atilde;o mais como analista de literatura, mas como criadora, &eacute; uma p&aacute;gina de alta beleza formal e de sutis alus&otilde;es parab&oacute;licas, que bem mostram como a verdadeira simplicidade liter&aacute;ria, n&atilde;o por defici&ecirc;ncia mas por opul&ecirc;ncia, &eacute; a plenitude da complexidade. &Eacute; preciso ter percorrido, ao menos em imagina&ccedil;&atilde;o, todos os horizontes do mundo, como dizia Chesterton, para descobrirmos que a verdade, o bem e a beleza est&atilde;o em nossa casa, ao alcance de nossas m&atilde;os. Parca domus magna veritas. Quando comecei a ler esse pequeno e delicioso id&iacute;lio, imaginei que o pequeno Bino pegasse de um bote para ver, realmente, o que havia &ldquo;do outro lado do mar e se perdesse no oceano&rdquo;. Era literatura bonita demais para agradar &agrave;s crian&ccedil;as. Agradaria aos adultos, cansados de sofistica&ccedil;&atilde;o liter&aacute;ria. Mas quando terminei, fiquei pensando no motivo pelo qual Jesus escolheu o estilo parab&oacute;lico para revelar aos homens os segredos que trazia de suas confid&ecirc;ncias com o Pai. A raz&atilde;o dessa escolha n&atilde;o era a prefer&ecirc;ncia que os orientais t&ecirc;m pela linguagem figurada. Era realmente a escolha de um terceiro estilo, que n&atilde;o fosse exclusivamente nem para adultos nem para crian&ccedil;as, e sim para seres humanos cuja perfei&ccedil;&atilde;o devia ser a semelhan&ccedil;a ou antes a integra&ccedil;&atilde;o no esp&iacute;rito da inf&acirc;ncia.<br />O estilo parab&oacute;lico era, realmente, um tra&ccedil;o de uni&atilde;o entre as diferentes idades do homem e, particularmente, essa verdade psicol&oacute;gica de que a velhice &eacute; uma volta &agrave; inf&acirc;ncia. Ou aut&ecirc;ntica, quando por superabund&acirc;ncia. Ou deformada, quando por esgotamento.<br />Esse pequeno id&iacute;lio, &ldquo;Do outro lado tem segredos&rdquo;, possui a simplicidade das letras que superam o beletrismo. &Eacute; uma par&aacute;bola que se passa entre pescadores, o menino Bino e a menina Maria, em que Bino olha para l&aacute; do oceano, em dire&ccedil;&atilde;o &agrave; &Aacute;frica de Aruanda, de onde vieram os seus antepassados. E a menina Maria, descendente de &iacute;ndios, olha para l&aacute; dos montes, de onde vieram os seus, no horizonte tel&uacute;rico. S&atilde;o duas faces do mundo brasileiro, refletidas nessas duas crian&ccedil;as praieiras e no encontro de duas ra&ccedil;as nost&aacute;lgicas, do oceano e da floresta, com seus mist&eacute;rios invis&iacute;veis e indiz&iacute;veis.<br />H&aacute;, nessa historieta de crian&ccedil;as, &agrave; flor de sua natureza ainda virgem, uma intensa beleza de dores ainda n&atilde;o sofridas e das decep&ccedil;&otilde;es ainda n&atilde;o tocadas pelo crep&uacute;sculo futuro de esperan&ccedil;as malogradas. Mais uma vez, o mist&eacute;rio do encontro secreto entre a inf&acirc;ncia e a velhice, entre a vida previvida e a vida sobrevivida. Entre a ignor&acirc;ncia e a sabedoria, mist&eacute;rio que transcende nossa ci&ecirc;ncia e nossa cultura.<br />Ana Maria Machado leu muitos livros e sabe muitos segredos da literatura. Sabe que pra l&aacute; dos mares h&aacute; todos os mist&eacute;rios mitol&oacute;gicos de Netuno. Como pr&aacute; l&aacute; dos morros h&aacute; todos os segredos de Demeter. Os mitos mais antigos da humanidade se conjugam e se traduzem pela linguagem intocada desse casal de crian&ccedil;as da praia e do morro. S&oacute; falta o portugu&ecirc;s para que todo o Brasil ali esteja. Praieiro e tel&uacute;rico. &Eacute; a nossa intelig&ecirc;ncia, solicitada pela tenta&ccedil;&atilde;o da cultura conquistada e pela intui&ccedil;&atilde;o mais inata. &Eacute; a hesita&ccedil;&atilde;o entre o canto das cigarras e a resson&acirc;ncia dos b&uacute;zios. &Eacute; o segredo inspirado pelas palavras de Cristo, em que Deus colocou o mist&eacute;rio de sua criatividade. Na faculdade, Ana Maria era uma aluna que n&atilde;o se contentava com os textos e as li&ccedil;&otilde;es e j&aacute; sofria a tenta&ccedil;&atilde;o da pintura mais abstrata e... das guerrilhas mais concretas. Foi ela, se n&atilde;o me engano, uma das organizadoras, na faculdade, de uma exposi&ccedil;&atilde;o dos posters mais revolucion&aacute;rios. E hoje, depois de incurs&otilde;es pelas letras mais sofisticadas, nos presenteia com essa curta par&aacute;bola de uma cristalinidade de fonte. E ainda tem por diante, em sua juventude preservada, largos horizontes a percorrer, para l&aacute; de praias e de montes.<br /><br /><br />Jornal do Brasil, Opini&atilde;o<br />P&aacute;g. 11, 1/3/79</em></p>', '', NULL, '2014-08-28 10:52:16', '2014-06-16 16:15:25', NULL, 1, '', 3000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `moxca_faq_questions`
--

DROP TABLE IF EXISTS `moxca_faq_questions`;
CREATE TABLE IF NOT EXISTS `moxca_faq_questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `uri` varchar(200) DEFAULT NULL,
  `question` text,
  `answer` text,
  `rank` int(10) unsigned NOT NULL,
  `status` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Extraindo dados da tabela `moxca_faq_questions`
--

INSERT INTO `moxca_faq_questions` (`id`, `title`, `uri`, `question`, `answer`, `rank`, `status`) VALUES
(1, 'Quando você era criança, já sonhava em ser escritora?', 'Quando você era criança, já sonhava em ser escritora?', 'Quando você era criança, já sonhava em ser escritora?', 'Não. Sonhava em ser artista de cinema, mas achava que ia mesmo era ser professora. Estudei para isso. E fui professora por um bom tempo. Só depois é que descobri que era escritora. Mas sempre gostei de escrever. Fazia diário, escrevia muitas cartas, fazia parte da equipe do jornalzinho da escola, essas coisas…', 1, 2000),
(2, 'De onde você tira as idéias para os seus livros?', 'De onde você tira as idéias para os seus livros?', 'De onde você tira as idéias para os seus livros?', 'Da cabeça, como todo mundo. O importante não é isso, é como elas entram na cabeça. Acho que um livro começa muito antes da hora em que a gente senta para escrever. É um jeito de prestar atenção no mundo, em todas as coisas, nas pessoas, e ficar pensando sobre tudo…\r\n', 2, 2000),
(3, 'Quais são os seus temas favoritos?', 'quais-sao-os-seus-temas-favoritos', '<p>Quais s&atilde;o os seus temas favoritos?</p>', 'Os críticos em geral dizem que eu escrevo com uma visão crítica, sobre temas como a rebeldia, o combate ao autoritarismo, a ética, a fome de justiça… Mas do meu ponto de vista não é bem assim: eu acho que cada vez estou querendo contar uma história diferente, acontecida comigo mesma ou com gente que eu conheço, e transformada pelas coisas que eu sonho ou imagino a partir daí.', 3, 2000),
(4, 'Qual o ponto de partida para o que você escreve?', 'qual-o-ponto-de-partida-para-o-que-voce-escreve', 'Qual o ponto de partida para o que você escreve?', 'Do meu ponto de vista, eu escrevo sempre a partir de duas coisas: o que eu lembro e o que eu invento. Memória e imaginação são as duas grandes fontes do que eu faço.\r\n', 4, 2000),
(5, 'Como é que você escolhe seus ilustradores?', 'como-e-que-voce-escolhe-seus-ilustradores', 'Como é que você escolhe seus ilustradores?', 'Muitas vezes quem escolhe não sou eu, são os editores. Mas alguns aceitam que eu dê palpites. Nesse caso, eu tento escolher aqueles com quem eu tenho mais afinidade, ou cujo trabalho eu admiro, e que sejam bons de trabalhar. Quer dizer, conversem comigo, leiam o livro com atenção, se disponham a trocar idéias e cumprir prazos.', 5, 2000),
(6, 'Você também é pintora. Por que nunca ilustrou um livro seu?', 'voce-tambem-e-pintora-por-que-nunca-ilustrou-um-livro-seu', 'Você também é pintora. Por que nunca ilustrou um livro seu?', 'Porque eu acho que pintura e ilustração são duas coisas completamente diferentes. Uma pintura tem apenas que resolver problemas visuais que ela mesma inventa a cada vez. Uma ilustração, como o nome está dizendo, tem que dar um lustre, um brilho, lançar uma luz sobre algo que está escrito. Tem que ser narrativa também. E o tipo de pintura que eu faço não é narrativo. Acho muito mais difícil ilustrar do que pintar, e eu não tenho capacidade para isso.', 6, 2000),
(7, 'Que mensagem você gostaria de mandar para seus leitores?', 'que-mensagem-voce-gostaria-de-mandar-para-seus-leitores', 'Que mensagem você gostaria de mandar para seus leitores?', 'Antigamente eu dizia que quem tem que mandar mensagem é telegrafista. Hoje diria que é a Internet. Um escritor não tem que se preocupar com mensagens. Tem que contar uma boa história, de uma maneira interessante, com surpresas de linguagem, e criar um livro que divirta, faça pensar e fique na lembrança do leitor de alguma maneira, dando vontade de reler ou relembrar de vez em quando.', 7, 2000),
(8, 'O que a levou a escrever para crianças?', 'o-que-a-levou-a-escrever-para-criancas', 'O que a levou a escrever para crianças?', 'Eu já escrevia para adultos e sabia que "tinha jeito" para escrever. Conhecia muito bem a língua (era professora de português), estava começando a trabalhar numa tese de doutorado sobre Guimarães Rosa. Quer dizer, língua e literatura eram meu elemento. Por que não para crianças também? Não vi nenhum motivo para excluí-las de minha preocupação estética com o uso da linguagem, terreno onde sempre me movi. Então somei, ampliei, e incluí a criança nessas minhas vivências da arte da palavra.\r\n', 8, 2000),
(9, 'Como é a sua rotina de trabalho?', 'como-e-a-sua-rotina-de-trabalho', 'Como é a sua rotina de trabalho?', 'Escrevo o tempo todo, não só quando estou diante do papel ou do computador - esse é só o momento final, em que as palavras saem de mim e tomam forma exterior. A minha criação é assim, um processo meio mágico, que a gente não sabe de onde vêm nem como se desenrola. Procuro merecer, estar pronta, criar condições. Essas condições passam por trabalho e disciplina. Em geral, escrevo todo dia, sempre de manhã, quanto mais cedo melhor. Sem interrupções de fora. E com possibilidade de uma vista agradável, quando levanto os olhos da página.', 9, 2000),
(10, 'experiencia-como-livreira', 'experiencia-como-livreira', 'Você foi uma das pioneiras, no Rio de Janeiro, na criação de uma livraria voltada para o público infanto-juvenil. O que aprendeu dessa experiência?', 'Criei a Malasartes em 1979 e vendi a minha parte em 1996. Durante esse período, descobri que acaba se tornando impossível tentar compatibilizar as duas coisas. Um escritor é um artista, tem que ser livre. Um livreiro é um comerciante, tem que dar sempre razão ao freguês.\r\n', 10, 2000),
(11, 'Qual foi o primeiro livro que você escreveu?', 'qual-foi-o-primeiro-livro-que-voce-escreveu', 'Qual foi o primeiro livro que você escreveu?', 'O meu primeiro livro foi para adultos, em 1976 - Recado do Nome. Em 1977, veio o primeiro infantil, Bento-que-bento-é-o-frade, saído quase ao mesmo tempo que os três volumes das "Histórias de Recreio", reunindo alguns dos contos publicados na revista, sob os títulos Camilão, o Comilão, Severino Faz Chover e Currupaco Papaco. Hoje, novamente desmembrados nas doze histórias originais que constituem doze livros, eles estão sendo publicados separadamente por diferentes editoras.', 11, 2000),
(12, 'Livros em diversos idiomas', 'livros-em-diversos-idiomas', 'Seus livros foram traduzidos em diversos idiomas para vários países. Como ficam os valores e referências mais regionais, explorados por você nos textos, no caso dessas traduções?', 'Não sei bem. Toda tradução sempre perde muita coisa, por melhor que seja. Mas quando é boa, pode ganhar outras, por ser uma recriação. Alguns dos autores que mais me fascinaram na vida (de Cervantes a Garcia Marques, de Shakespeare a Camus) tinham valores regionais muito fortes, mas nem por isso deixaram de ser universais.', 12, 2000),
(13, 'Dos livros que você escreveu, qual você gosta mais?', 'dos-livros-que-voce-escreveu-qual-voce-gosta-mais', 'Dos livros que você escreveu, qual você gosta mais?', 'Taí uma coisa que não existe. Acho que livro é que nem filho, a gente gosta de todos igualmente com muita intensidade, mesmo sabendo que cada um tem características diferentes do outro.', 13, 2000),
(14, 'Tem algum que você gosta menos, ou não gosta?', 'tem-algum-que-voce-gosta-menos-ou-nao-gosta', 'Tem algum que você gosta menos, ou não gosta?', 'Já teve muitos, mas eu não publiquei. Para isso existe lata de lixo.', 14, 2000),
(15, 'Qual o livro mais difícil que você já escreveu? E o mais fácil?', 'qual-o-livro-mais-dificil-que-voce-ja-escreveu-e-o-mais-facil', 'Qual o livro mais difícil que você já escreveu? E o mais fácil?', 'Na verdade não dá para responder objetivamente a essas duas perguntas. Depois que passa o momento de escrever o que fica é só a memória desse momento, que pode não corresponder a verdade. Eu lembro que um dos mais difíceis, entre os infantis, foi "Um Avião e uma Viola", que só tem uma linha por página. Os primeiros da série Mico Maneco também foram muito difíceis, por trabalharem com um repertório de sílabas muito limitado. Entre os de adulto, dois foram especialmente difíceis: "Tropical Sol da Liberdade", por ter me lançado numa profundidade de dor para a qual eu não estava preparada, e "E o Mar nunca Transborda", pelo intenso trabalho de pesquisa e recriação de linguagem que ele exigiu. Fácil, nenhum é.', 15, 2000),
(16, 'Alguma história que você escreveu já aconteceu de verdade?', 'alguma-historia-que-voce-escreveu-ja-aconteceu-de-verdade', 'Alguma história que você escreveu já aconteceu de verdade?', 'Quase todas. Mas sempre muito misturadas com outras que não aconteceram.', 16, 2000),
(17, 'Qual a sua relação com a escritora Ruth Rocha?', 'qual-a-sua-relacao-com-a-escritora-ruth-rocha', 'Qual a sua relação com a escritora Ruth Rocha?', 'Eu sou a mais velha de onze irmãos e acho que sempre quis ter uma irmã mais velha. Quando casei com o irmão da Ruth, compreendi que tinha ganho essa irmã tão desejada. Até hoje continuamos muito amigas e o fato de termos posteriormente começado a escrever na mesma revista só nos aproximou.', 17, 2000),
(18, 'Como é a sua relação com seus pequenos ou grandes leitores?', 'como-e-a-sua-relacao-com-seus-pequenos-ou-grandes-leitores', 'Como é a sua relação com seus pequenos ou grandes leitores?', 'Eu costumo dizer que o maior prêmio de um escritor é um bom leitor. Um leitor que entende, qualquer que seja a sua idade, é um presente. E quando ele entende, não confunde a relação com o livro e a relação com uma pessoa. Para mim, o importante é que meu leitor se aproxime do que eu escrevo, e não de mim. Muitas vezes a pessoa física do escritor pode atrapalhar o contato com a obra. Uma coisa que me preocupa muito nessa esfera é não ser injusta, não privilegiar um leitor em detrimento de outro. Se eu começar a conversar muito com um, como vou fazer para conversar igualmente com todos os outros? Só através do livro, que é justo e democrático. Mas adoro quando o leitor se manifesta.', 18, 2000),
(19, 'Que tipo de livro você mais gosta de ler?', 'que-tipo-de-livro-voce-mais-gosta-de-ler', 'Que tipo de livro você mais gosta de ler?', 'Qualquer livro bem escrito. Devoro romances e ensaios, leio e releio poesias.', 19, 2000),
(20, 'Como você escolhe o título dos seus livros?', 'como-voce-escolhe-o-titulo-dos-seus-livros', 'Como você escolhe o título dos seus livros?', 'Quase sempre o título é a última coisa. Com muita freqüência o livro fica pronto e eu não sei como ele vai se chamar. Muitas vezes depois do título escolhido eu percebo que de alguma forma esse título já estava escondido dentro do livro, de tantas referências que havia pelo meio do texto. Mas não é uma coisa que eu tenha facilidade em decidir.', 20, 2000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `moxca_terms`
--

DROP TABLE IF EXISTS `moxca_terms`;
CREATE TABLE IF NOT EXISTS `moxca_terms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `term` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `uri` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uri` (`uri`),
  KEY `term` (`term`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Extraindo dados da tabela `moxca_terms`
--

INSERT INTO `moxca_terms` (`id`, `term`, `uri`) VALUES
(1, 'Leitura', 'leitura'),
(2, 'Agenda', 'agenda'),
(3, 'Histórias', 'historias'),
(4, 'Escola', 'escola'),
(5, 'Exposição Virtual', 'exposicao-virtual'),
(6, 'Leitor', 'leitor'),
(7, 'Prêmio', 'premio'),
(10, 'ABL', 'abl'),
(11, 'Mico Maneco', 'mico-maneco'),
(12, 'caminhos', 'caminhos'),
(13, 'Carlos Drummond de Andrade', 'carlos-drummond-de-andrade'),
(14, 'Tom Jobim', 'tom-jobim'),
(15, 'Amadeo Modigliani', 'amadeo-modigliani'),
(16, 'Alfredo Volpi', 'alfredo-volpi'),
(17, 'Pintores', 'pintores'),
(18, 'Artes Plásticas', 'artes-plasticas'),
(19, 'Árvores', 'arvores'),
(20, 'Esperança', 'esperanca'),
(21, 'Meio Ambiente', 'meio-ambiente'),
(22, 'Poderosos', 'poderosos'),
(23, 'Direitos', 'direitos'),
(24, 'Medos', 'medos'),
(25, 'Folclore', 'folclore'),
(26, 'Alice', 'alice'),
(27, 'Ulisses', 'ulisses'),
(28, 'Paixão', 'paixao'),
(29, 'Amor', 'amor'),
(30, 'Amizade', 'amizade'),
(31, 'Adolescência', 'adolescencia'),
(32, 'Livros', 'livros'),
(33, 'Aventura', 'aventura'),
(34, 'Fauna Brasileira', 'fauna-brasileira'),
(35, 'Imaginação', 'imaginacao'),
(36, 'Lendas', 'lendas'),
(37, 'Natureza', 'natureza'),
(38, 'Obsessão', 'obsessao'),
(39, 'Escrever', 'escrever'),
(40, 'Ecologia', 'ecologia'),
(41, 'Brasil', 'brasil'),
(42, 'Mitologia', 'mitologia'),
(43, 'Romance', 'romance'),
(44, 'Tramas', 'tramas'),
(45, 'Brincadeira', 'brincadeira'),
(46, 'Palavras', 'palavras'),
(47, 'Cultura', 'cultura'),
(48, 'Identidade', 'identidade'),
(49, 'Literatura', 'literatura'),
(50, 'Banho', 'banho'),
(51, 'Doces', 'doces'),
(52, 'Gulodice', 'gulodice'),
(53, 'Esperteza', 'esperteza'),
(54, 'Quantidade', 'quantidade'),
(55, 'Família', 'familia'),
(56, 'Pais e Filhos', 'pais-e-filhos'),
(57, 'Crescer', 'crescer'),
(58, 'Liberdade', 'liberdade'),
(59, 'Independência', 'independencia'),
(60, 'Memória', 'memoria'),
(61, 'Brigas', 'brigas'),
(62, 'Música', 'musica'),
(63, 'Contos de Fadas', 'contos-de-fadas'),
(64, 'Cantigas de Ninar', 'cantigas-de-ninar'),
(65, 'Hora de Dormir', 'hora-de-dormir'),
(66, 'Sono', 'sono'),
(67, 'Dividir', 'dividir'),
(68, 'Tempo', 'tempo'),
(69, 'Traição', 'traicao'),
(70, 'Egoismo', 'egoismo'),
(71, 'Guerra', 'guerra'),
(72, 'Paz', 'paz'),
(73, 'Surpresa', 'surpresa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `moxca_terms_relationships`
--

DROP TABLE IF EXISTS `moxca_terms_relationships`;
CREATE TABLE IF NOT EXISTS `moxca_terms_relationships` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `object` int(10) unsigned NOT NULL,
  `term_taxonomy` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `object_term_taxonomy` (`object`,`term_taxonomy`),
  KEY `term_taxonomy` (`term_taxonomy`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Extraindo dados da tabela `moxca_terms_relationships`
--

INSERT INTO `moxca_terms_relationships` (`id`, `object`, `term_taxonomy`) VALUES
(1, 2, 2),
(28, 3, 25),
(29, 3, 26),
(30, 3, 27),
(31, 3, 28),
(105, 5, 68),
(106, 5, 69),
(107, 5, 70),
(41, 6, 27),
(40, 6, 35),
(42, 6, 36),
(43, 6, 37),
(44, 6, 38),
(3, 8, 5),
(51, 8, 42),
(52, 8, 43),
(9, 9, 5),
(10, 10, 5),
(60, 10, 9),
(61, 10, 50),
(11, 11, 5),
(12, 12, 5),
(13, 13, 5),
(7, 14, 3),
(4, 14, 10),
(5, 15, 3),
(84, 21, 9),
(86, 21, 29),
(85, 21, 44),
(87, 21, 61),
(89, 22, 34),
(88, 22, 44),
(94, 23, 9),
(95, 23, 33),
(8, 24, 9),
(112, 40, 9),
(113, 40, 73),
(36, 46, 9),
(37, 46, 20),
(38, 46, 33),
(26, 49, 23),
(27, 49, 24),
(45, 50, 20),
(46, 50, 33),
(47, 50, 39),
(48, 50, 40),
(53, 51, 44),
(63, 52, 44),
(62, 52, 51),
(64, 52, 52),
(80, 54, 55),
(79, 54, 58),
(78, 54, 59),
(103, 55, 29),
(102, 55, 52),
(101, 55, 54),
(104, 55, 67),
(14, 99, 10),
(15, 99, 11),
(16, 99, 13),
(69, 100, 34),
(68, 100, 55),
(70, 100, 56),
(75, 101, 34),
(74, 101, 44),
(76, 101, 46),
(77, 101, 59),
(100, 102, 34),
(96, 102, 63),
(97, 102, 64),
(98, 102, 65),
(99, 102, 66),
(32, 124, 29),
(33, 124, 30),
(34, 125, 31),
(35, 125, 32),
(39, 125, 34),
(71, 126, 57),
(72, 126, 58),
(73, 126, 59),
(83, 127, 29),
(81, 127, 55),
(82, 127, 60),
(110, 128, 28),
(111, 128, 30),
(108, 128, 71),
(109, 128, 72),
(54, 144, 45),
(17, 149, 14),
(18, 149, 15),
(19, 149, 16),
(20, 149, 17),
(21, 159, 18),
(22, 159, 19),
(23, 159, 20),
(24, 159, 21),
(25, 159, 22),
(50, 160, 32),
(49, 160, 41),
(65, 161, 21),
(66, 161, 53),
(67, 161, 54),
(90, 179, 21),
(91, 179, 46),
(92, 179, 58),
(93, 179, 62),
(58, 181, 31),
(55, 181, 46),
(56, 181, 47),
(57, 181, 48),
(59, 181, 49);

-- --------------------------------------------------------

--
-- Estrutura da tabela `moxca_terms_taxonomy`
--

DROP TABLE IF EXISTS `moxca_terms_taxonomy`;
CREATE TABLE IF NOT EXISTS `moxca_terms_taxonomy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` int(10) unsigned NOT NULL,
  `taxonomy` varchar(32) CHARACTER SET utf8 DEFAULT '',
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `term_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Extraindo dados da tabela `moxca_terms_taxonomy`
--

INSERT INTO `moxca_terms_taxonomy` (`id`, `term_id`, `taxonomy`, `count`) VALUES
(1, 1, 'category', 0),
(2, 2, 'category', 1),
(3, 3, 'category', 2),
(4, 4, 'category', 0),
(5, 5, 'category', 6),
(6, 6, 'category', 0),
(7, 10, 'category', 1),
(8, 7, 'post_tag', 0),
(9, 11, 'work_keyword', 6),
(10, 12, 'work_keyword', 1),
(11, 13, 'work_keyword', 1),
(12, 0, 'work_keyword', 0),
(13, 14, 'work_keyword', 1),
(14, 15, 'work_keyword', 1),
(15, 16, 'work_keyword', 1),
(16, 17, 'work_keyword', 1),
(17, 18, 'work_keyword', 1),
(18, 19, 'work_keyword', 1),
(19, 20, 'work_keyword', 1),
(20, 21, 'work_keyword', 3),
(21, 22, 'work_keyword', 3),
(22, 23, 'work_keyword', 1),
(23, 24, 'work_keyword', 1),
(24, 25, 'work_keyword', 1),
(25, 26, 'work_keyword', 1),
(26, 27, 'work_keyword', 1),
(27, 28, 'work_keyword', 2),
(28, 29, 'work_keyword', 2),
(29, 30, 'work_keyword', 4),
(30, 31, 'work_keyword', 2),
(31, 32, 'work_keyword', 2),
(32, 33, 'work_keyword', 2),
(33, 34, 'work_keyword', 3),
(34, 35, 'work_keyword', 5),
(35, 36, 'work_keyword', 1),
(36, 37, 'work_keyword', 1),
(37, 38, 'work_keyword', 1),
(38, 39, 'work_keyword', 1),
(39, 40, 'work_keyword', 1),
(40, 41, 'work_keyword', 1),
(41, 42, 'work_keyword', 1),
(42, 43, 'work_keyword', 1),
(43, 44, 'work_keyword', 1),
(44, 45, 'work_keyword', 5),
(45, 46, 'work_keyword', 1),
(46, 47, 'work_keyword', 3),
(47, 48, 'work_keyword', 1),
(48, 49, 'work_keyword', 1),
(49, 1, 'work_keyword', 1),
(50, 50, 'work_keyword', 1),
(51, 51, 'work_keyword', 1),
(52, 52, 'work_keyword', 2),
(53, 53, 'work_keyword', 1),
(54, 54, 'work_keyword', 2),
(55, 55, 'work_keyword', 3),
(56, 56, 'work_keyword', 1),
(57, 57, 'work_keyword', 1),
(58, 58, 'work_keyword', 3),
(59, 59, 'work_keyword', 3),
(60, 60, 'work_keyword', 1),
(61, 61, 'work_keyword', 1),
(62, 62, 'work_keyword', 1),
(63, 63, 'work_keyword', 1),
(64, 64, 'work_keyword', 1),
(65, 65, 'work_keyword', 1),
(66, 66, 'work_keyword', 1),
(67, 67, 'work_keyword', 1),
(68, 68, 'work_keyword', 1),
(69, 69, 'work_keyword', 1),
(70, 70, 'work_keyword', 1),
(71, 71, 'work_keyword', 1),
(72, 72, 'work_keyword', 1),
(73, 73, 'work_keyword', 1);

