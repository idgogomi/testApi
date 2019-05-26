<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    // view data

    $app->get('/views', function ($request, $response, $args) {
        $query = $this->db->prepare("SELECT * FROM barang ORDER BY id_barang");
        $query->execute();
        $views = $query->fetchAll();
        return $this->response->withJson(["status" => "success", "data" => $views], 200)
                                ->withHeader('Access-Control-Allow-Origin', '*')
                                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });

    // view detail data

    $app->get('/views/{id}', function ($request, $response, $args) {
        $id = $args['id'];
        $query = $this->db->prepare("SELECT * FROM barang WHERE id_barang=:id");
        $query->execute([":id" => $id]);
        $views = $query->fetch();
        return $this->response->withJson($views);
    });

    // insert new data

    $app->post('/views', function ($request, $response) {

        $input = $request->getParsedBody();

        $sql = "INSERT INTO barang (nama_barang, qty, harga) VALUES (:nama_barang, :qty, :harga)";
        $prepare = $this->db->prepare($sql);
        
        $data = [
        	":nama_barang" => $input["nama_barang"],
        	":qty" => $input["qty"],
        	":harga" => $input["harga"]
        ];

        if($prepare->execute($data))
           	return $response->withJson(["status" => "success", "data" => "1"], 200);
        
        	return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });

    // update data

    $app->put('/views/{id}', function ($request, $response, $args) {
        $id = $args["id"];
        $input = $request->getParsedBody();

        $sql = "UPDATE barang SET nama_barang=:nama_barang, qty=:qty, harga=:harga WHERE id_barang=:id";
        $prepare = $this->db->prepare($sql);

        $data = [
            ":id" => $id,
            ":nama_barang" => $input["nama_barang"],
            ":qty" => $input["qty"],
            ":harga" => $input["harga"]
        ];

        if($prepare->execute($data))
            return $response->withJson(["status" => "success", "data" => "1"], 200);

            return $response->withJson(["status" => "failed", "data" => "0"], 200);

    });

    //delete data

    $app->delete('/views/{id}', function($request, $response, $args){
        $id = $args["id"];
        $sql = "DELETE FROM barang where id_barang=:id";
        $prepare = $this->db->prepare($sql);

        $data = [
            ":id" => $id
        ];

        if($prepare->execute($data))
            return $response->withJson(["status" => "success", "data" => "1"], 200);
            return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });

    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });
};
