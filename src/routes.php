<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();
    
    $app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', '[GET, POST, PUT, DELETE, PATCH, OPTIONS]');
});

    // vieww data survei

    $app->get('/survei', function ($request, $response, $args) {
        $query = $this->db->prepare("SELECT * FROM survei ORDER BY create_at DESC");
        $query->execute();
        $views = $query->fetchAll();
        return $this->response->withJson(["status" => "success", "data" => $views], 200);
    });
 
    // view detail data survei

    $app->get('/survei/{id}', function ($request, $response, $args) {
        $id = $args['id'];
        $query = $this->db->prepare("SELECT * FROM survei WHERE nik=:nik");
        $query->execute([":nik" => $id]);
        $views = $query->fetch();
        return $this->response->withJson($views);
    });

    // insert new data survei

    $app->post('/survei', function ($request, $response) {

        $input = $request->getParsedBody();

        $sql = "INSERT INTO survei (nik, nama, domisili, gender, create_at, lat, lng) 
                            VALUES (:nik, :nama, :domisili, :gender, :create_at, :lat, :lng)";
        $prepare = $this->db->prepare($sql);
        
        $data = [
            ":nik" => $input["nik"],
            ":nama" => $input["nama"],
            ":domisili" => $input["domisili"],
            ":gender" => $input["gender"],
            ":create_at" => $input["create_at"],
            ":lat" => $input["lat"],
            ":lng" => $input["lng"]
        ];

        if($prepare->execute($data))
            return $response->withJson(["status" => "success", "data" => "1"], 200);
        
            return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });

    // update data survei

    $app->put('/survei/{id}', function ($request, $response, $args) {
        $id = $args["id"];
        $input = $request->getParsedBody();

        $sql = "UPDATE survei SET nik=:nik, nama=:nama, domisili=:domisili, gender=:gender, create_at=:create_at, lat=:lat, lng=:lng 
                                WHERE id_barang=:id";
        $prepare = $this->db->prepare($sql);

        $data = [
           ":nik" => $input["nik"],
            ":nama" => $input["nama"],
            ":domisili" => $input["domisili"],
            ":gender" => $input["gender"],
            ":create_at" => $input["create_at"],
            ":lat" => $input["lat"],
            ":lng" => $input["lng"]
        ];

        if($prepare->execute($data))
            return $response->withJson(["status" => "success", "data" => "1"], 200);

            return $response->withJson(["status" => "failed", "data" => "0"], 200);

    });

    //delete data survei

    $app->delete('/survei/{id}', function($request, $response, $args){
        $id = $args["id"];
        $sql = "DELETE FROM survei where nik=:nik";
        $prepare = $this->db->prepare($sql);

        $data = [
            ":nik" => $id
        ];

        if($prepare->execute($data))
            return $response->withJson(["status" => "success", "data" => "1"], 200);
            return $response->withJson(["status" => "failed", "data" => "0"], 200);
    });
    
      // vieww data inspirasinama

    $app->get('/nama', function ($request, $response, $args) {
        $query = $this->db->prepare("SELECT a.id_nama, a.nama, b.kategori, a.arti FROM inspirasinama_nama a 
                                    JOIN inspirasinama_kategori b ON a.id_kategori=b.id_kategori");
        $query->execute();
        $views = $query->fetchAll();
        return $this->response->withJson(["status" => "success", "data" => $views], 200);
    });

    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });
};