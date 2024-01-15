<div>
    <livewire:componentes.navbar.navbar />
    <main>
        <form class="form-login">
            <div class="titulo-subtitulo">
                <h1>Que bom te ver de novo!</h1>
                <h3>Acesse e use agora mesmo!</h3>
            </div>
            <div class="grupo-input-login">
                <label for="email" class="label-input-login">E-mail</label>
                <input type="email" id="email" class="input-input-login">
            </div>
            <div class="grupo-input-login">
                <label for="password" class="label-input-login">Senha (minimo de 8 caracteres)</label>
                <input type="password" id="password" class="input-input-login">
            </div>

            <div class="opcoes-form-login">
                <div class="grupo-input-checkbox-login">
                    <label for="lembraSenha" class="label-input-login">Lembra senha</label>
                    <input type="checkbox" id="lembraSenha" class="input-input-login">
                </div>
                <a href="#" class="esqueceuSenha">Esqueceu sua senha?</a>
            </div>
            <input type="submit" value="Entrar" class="botaoLogin"/>
        </form>
    </main>
</div>
