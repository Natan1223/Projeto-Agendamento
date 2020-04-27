<?php

session_start();

use function src\slimConfiguration;
use App\Controllers\AutenticaController;
use App\Controllers\EmailPessoaController;
use App\Controllers\ParametroController;
use App\Controllers\PerguntaController;
use App\Controllers\PerguntaParametroController;
use App\Controllers\PessoaController;
use App\Controllers\RespostaController;
use App\Controllers\TipoPerguntaController;

use Tuupola\Middleware\JwtAuthentication;

$app = new \Slim\App(slimConfiguration());

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Credentials', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Token, X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->post('/login', AutenticaController::class . ':login');

$app->get('/apresentacao', function ($request, $response, $args) {
    return $response
                ->withStatus(200)
                ->withjson([
                    'message' => 'DPC - Doação de plasma convalescente.',
                    "status" => "Em Desenvolvimento",
                    "version" => "1.0.0",
                    "date" => (new \DateTime())->format('d-m-Y H:i:s')
                ]);
});

//14042020 118
    $app->get('/pessoa', PessoaController::class . ':buscaPessoas');
    $app->post('/pessoa', PessoaController::class . ':inserePessoa');
    $app->get('/acompanhamento-pessoa/[{codigoPessoa}]', PessoaController::class . ':buscaStatusAcompanhamentoPessoa');

    $app->get('/tipo-pergunta', TipoPerguntaController::class . ':buscaTipoPerguntas');
    $app->get('/tipo-pergunta/[{descricao}]', TipoPerguntaController::class . ':buscaTipoPergunta');
    $app->post('/tipo-pergunta', TipoPerguntaController::class . ':insereTipoPergunta');
    $app->put('/tipo-pergunta', TipoPerguntaController::class . ':atualizaTipoPergunta');

    $app->get('/parametro', ParametroController::class . ':buscaParametros');
    $app->get('/parametro/[{descricao}]', ParametroController::class . ':buscaParametro');
    $app->post('/parametro', ParametroController::class . ':insereParametro');
    $app->put('/parametro', ParametroController::class . ':atualizaParametro');

    $app->get('/pergunta', PerguntaController::class . ':buscaPerguntas');
    $app->get('/pergunta/[{descricao}]', PerguntaController::class . ':buscaPergunta');
    $app->post('/pergunta', PerguntaController::class . ':inserePergunta');
    $app->put('/pergunta', PerguntaController::class . ':atualizaPergunta');

    $app->get('/pergunta-parametro', PerguntaParametroController::class . ':buscaPerguntaParametros');
    $app->post('/pergunta-parametro', PerguntaParametroController::class . ':inserePerguntaParametro');
    $app->delete('/pergunta-parametro/[{codigoPergunta}]', PerguntaParametroController::class . ':atualizaPerguntaParametro');

    $app->post('/resposta', RespostaController::class . ':insereResposta');
    $app->get('/resposta', RespostaController::class . ':buscaRespostas');
    $app->post('/resposta-imagem', RespostaController::class . ':insereRespostaImagem');

    $app->post('/email', EmailPessoaController::class . ':enviaEmail');

$app->group('',function() use ($app){

   
    $app->get('/verifica-autenticacao', function ($request, $response, $args) {
        return $response
                    ->withStatus(200);
    });
    
})
->add(
    function($request, $response, $next){
        $token = $request->getAttribute("jwt");
        $expireDate = date_format(new \DateTime($token['data_expira']), 'Y-m-d H:i:s');

        $_SESSION["codigoUsuario"] = $token['sub'];

        $now = new \DateTime();
        $now = date_format($now, 'Y-m-d H:i:s');
        if($expireDate < $now)
            return $response->withJson([
                                "menssagem " => 'Token expirou. Favor faça login'
                            ])
                            ->withStatus(401);
        $response = $next($request, $response);
        return $response;
    }
)
->add(
    new JwtAuthentication([
        "secret" => getenv('JWT_SECRET_KEY'),
        "attribute" => "jwt",
        "relaxed" => ["localhost", "200.129.161.227"],
        "error" => function ($response, $arguments) {
            $data["status"] = "error";
            $data["message"] = $arguments["message"];
            return $response
                ->withHeader("Content-Type", "application/json")
                ->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        }
    ])
);
    
$app->run();