<?php

$html = '
<form class="mt-5" action="/admin/edit/cartorio/info" method="POST" id="form-search-cartorio">
  <div class="form-group col-12 mb-2">
    <div class="form-group row">
        <input type="input" class="form-control" value="' . (($cartorio['nome'])? $cartorio['nome'] : '') . '" name="nome" id="nome" placeholder="Nome">
        <input type="input" class="form-control" value="' . (($cartorio['razao'])? $cartorio['razao'] : '') . '" name="razao" id="razao" placeholder="Razão">
        <input type="input" class="form-control" value="' . (($cartorio['tipo_documento'])? $cartorio['tipo_documento'] : '') . '" name="tipo_documento" id="tipo_documento" placeholder="Tipo documento">
        <input type="input" class="form-control" value="' . (($cartorio['documento'])? $cartorio['documento'] : '') . '" name="documento" id="documento" placeholder="Documento">
        <input type="input" class="form-control" value="' . (($cartorio['cep'])? $cartorio['cep'] : '') . '" name="cep" id="cep" placeholder="CEP">
        <input type="input" class="form-control" value="' . (($cartorio['endereco'])? $cartorio['endereco'] : '') . '" name="endereco" id="endereco" placeholder="Endereco">
        <input type="input" class="form-control" value="' . (($cartorio['bairro'])? $cartorio['bairro'] : '') . '" name="bairro" id="bairro" placeholder="Bairro">
        <input type="input" class="form-control" value="' . (($cartorio['cidade'])? $cartorio['cidade'] : '') . '" name="cidade" id="cidade" placeholder="Cidade">
        <input type="input" class="form-control" value="' . (($cartorio['uf'])? $cartorio['uf'] : '') . '" name="uf" id="uf" placeholder="UF">
        <input type="input" class="form-control" value="' . (($cartorio['tabeliao'])? $cartorio['tabeliao'] : '') . '" name="tabeliao" id="tabeliao" placeholder="Tabelião">
        <input type="input" class="form-control" value="' . (($cartorio['ativo'])? $cartorio['ativo'] : '') . '" name="ativo" id="ativo" placeholder="Ativo">
        <input type="input" class="form-control" value="' . (($cartorio['ativo'])? $cartorio['telefone'] : '') . '" name="telefone" id="telefone" placeholder="Telefone">
        <input type="email" class="form-control" value="' . (($cartorio['ativo'])? $cartorio['email'] : '') . '" name="email" id="email" placeholder="E-mail">
        <input type="hidden" name="id" value="' . $cartorio['id'] . '">
    </div>
    <button class="btn btn-outline-warning btn-block mb-2">Editar</button>
  </div>
</form>
';

return $html;

