SET SESSION sql_mode='NO_AUTO_VALUE_ON_ZERO';
INSERT INTO `usuario` (`id`, `nome`, `matricula`, `email`, `nome_usr`, `senha`, `tipo`, `status`) 
VALUES (0, 'admin', '0000000000000', 'admin@chronos.com', 'admin', '$2a$10$tIWNbqazR20AAEKpaRNLHuyUwa8jQYJNjEeRKAvsCYIE/1kbvBMce', 'ADM', 1); 
INSERT INTO `administrador` (`usuario_id`) 
VALUES (0); 