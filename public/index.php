<?php
    require '../vendor/autoload.php';//Conposer

    use App\Controller\UsuarioController;
    use App\Repository\UsuarioRepository;
    use Dotenv\Dotenv;
    use Slim\Factory\AppFactory;

    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');//acessa a raiz do projeto e instancia da classe que vasculha o arquivo
    $dotenv->load();

    $pdo = new PDO(//cria um PDO, com as informações la do .envi
        "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8",
        $_ENV['DB_USER'],
        $_ENV['DB_PASS']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $usuarioRepo = new UsuarioRepository($pdo);//cria uma instancia do repositorio
    $usuarioController = new UsuarioController($usuarioRepo);//passa a instancia do repositorio PDO, la para o controller


    $app = AppFactory::create();
    $app->addRoutingMiddleware();
    $app->addBodyParsingMiddleware();
    $app->addErrorMiddleware(true, true, true);


    $app->get('/usuarios', function($request, $response) use ($usuarioController) {//usa o controller em especifico
        return $usuarioController->getUsuarios($request, $response);//retorna o resultado do metodo, passando o request e response
    });
    $app->post('/usuario', function($request, $response) use ($usuarioController){
        return $usuarioController->cadastroUsuario($request, $response);
    })->add(new App\Middleware\AuthMiddleware);

    $app->run();
?>