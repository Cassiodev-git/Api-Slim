<?php
    namespace App\Controller;

    use App\Repository\UsuarioRepository;
    use Psr\Http\Message\ResponseInterface;
    use Psr\Http\Message\ServerRequestInterface;

    class UsuarioController {
        private UsuarioRepository $repository;

        public function __construct(UsuarioRepository $repository) {
            $this->repository = $repository;
        }

        public function getUsuarios(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface {
            $usuarios = $this->repository->getUsuarios();
            $response->getBody()->write(json_encode($usuarios, JSON_UNESCAPED_UNICODE));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        }
        public function cadastroUsuario(ServerRequestInterface $request, ResponseInterface $response) : ResponseInterface{
            $post =  $request->getParsedBody();
            $nome = $post['nome'];
            $email = $post['email'];
            $novoUsuario = $this->repository->setUsuario($nome, $email);
            $response->getBody()->write(json_encode($novoUsuario, JSON_UNESCAPED_UNICODE));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        }
    }
?>