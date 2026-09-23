<?php

header("Content-type: application/json");

require "conexao.php";

$metodo = $_SERVER["REQUEST_METHOD"];

if ($metodo == "POST"){
    $json = file_get_contents("php://input");

    $dados = json_decode($json,true);

    $sql = "INSERT INTO produtos (equipamento, setor, descricao, prioridade, status) VALUES (?,?,?,?,?)";

    $comando = $pdo->prepare($sql);
    if (
    $dados["prioridade"] == "baixa" ||  $dados["prioridade"] == "media" || $dados["prioridade"] == "alta" && $dados["status"] == "aberto" || $dados["status"] == "em andamento" || $dados["status"] == "finalizado"){
        $comando -> execute([
        $dados["equipamento"],
        $dados["setor"],
        $dados["descricao"],
        $dados["prioridade"],
        $dados["status"]
    ]);
    echo json_encode(["mensagem" => "Chamado aberto com sucesso"]);
    } else {
        echo json_encode(["Mensagem" => "Verifique os dados e tente novamente!"]);
    };

};

if ($metodo == "GET"){
    $sql = "SELECT * FROM produtos ORDER BY id";
    $comando = $pdo-> query($sql);
    $produtos = $comando -> fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($produtos);
};

if ($metodo == "PUT"){
    $json = file_get_contents("php://input");
    $dados = json_decode($json,true);
    $sql = "UPDATE produtos SET equipamento=?, descricao=? WHERE id=?";
    $comando = $pdo -> prepare($sql);
    $comando -> execute([
        $dados["equipamento"],
        $dados["descricao"],
        $dados["id"]
    ]);

    echo json_encode(["Mensagem" =>"Chamado atualizado com sucesso!"]);
};

if ($metodo == "DELETE"){
    $json = file_get_contents("php://input");
    $dados = json_decode($json,true);
    $sql = "DELETE FROM produtos WHERE id=?";
    $comando = $pdo->prepare($sql);
    $comando -> execute([
        $dados["id"]
    ]);

    echo json_encode(["mensagem" => "Chamado deletado com sucesso!"]);
    };





