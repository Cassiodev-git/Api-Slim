<?php
    namespace App\Middleware;

    use Psr\Http\Message\ResponseInterface;
    use Psr\Http\Message\ServerRequestInterface;
    use Psr\Http\Server\RequestHandlerInterface;

    class AuthMiddleware{
        public function __invoke(
            ServerRequestInterface $request,
            RequestHandlerInterface $handler
        ): ResponseInterface {
            $post = $request->getParsedBody();
            $nome = $post['nome'];
            $email = $post['email'];
            if(!isset($nome) || !isset($email)){
            
                $response = new \Slim\Psr7\Response();
                $response->getBody()->write(json_encode([
                    "Success" => false,
                    "Mensagen" => "Nome e Email obrigatorios"
                
                ]));
                return $response->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
            }else{
                return $handler->handle($request);
            }

        }

    }

?>