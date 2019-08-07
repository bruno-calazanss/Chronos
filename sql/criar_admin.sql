SET SESSION sql_mode='NO_AUTO_VALUE_ON_ZERO';
INSERT INTO `usuario` (`id`, `nome`, `matricula`, `email`, `nome_usr`, `senha`, `tipo`, `status`) 
VALUES (0, 'admin', '0000000000000', 'admin@chronos.com', 'admin', '$2y$10$QPtNQlVwIe0xKS51wy.8leHFsDECA3qNYpnxIGggE8yI1vMjP8iR2', 'ADM', 1); 
INSERT INTO `administrador` (`usuario_id`) 
VALUES (0); 