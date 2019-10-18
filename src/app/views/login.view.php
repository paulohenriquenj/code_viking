<?php


return <<< html

<form action="/login" method="POST">
    <div>
    <div class="form-group">
        <label for="email">Digite seu e-mail</label>
        <input type="email" class="form-control" id="email" name="login" aria-describedby="emailHelp" placeholder="E-mail" required>
        <label for="password">Senha</label>
        <input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp" placeholder="Senha" required>
        <button type="submit" class="btn btn-outline-success btn-block mt-3">Entrar</button>
    </div>
    <div class="col align-self-center">

    </div>

    </div>
</form>


html;



