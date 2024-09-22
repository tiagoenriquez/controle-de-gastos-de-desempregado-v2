<nav>
    <ul class="menu">
        <li><a href="#">Gasto</a>
            <ul>
                <li><a href="{{ route('gastos-do-mes') }}">Gastos do Mês</a></li>
                <li><a href="{{ route('cadastrar-gasto') }}">Cadastrar</a></li>
            </ul>
        </li>
        <li><a href="#">Arquivo</a>
            <ul>
                <li><a href="{{ route('gerar-arquivo') }}">Gerar</a></li>
                <li><a href="{{ route('cadastrar-arquivo') }}">Inserir</a></li>
            </ul>
        </li>
        <li><a href="#">Expectativa</a>
            <ul>
                <li><a href="{{ route('expectativa-por-prazo') }}">Calcular por Prazo</a></li>
                <li><a href="{{ route('expectativa-por-meta-mensal') }}">Calcular por Meta Mensal</a></li>
            </ul>
        </li>
        <li><a href="#">Estatistica</a>
            <ul>
                <li><a href="{{ route('gastos-por-genero') }}">Gastos por Gênero</a></li>
            </ul>
        </li>
        <li><a href="#">Item</a>
            <ul>
                <li><a href="{{ route('pesquisar-item') }}">Pesquisar</a></li>
                <li><a href="{{ route('cadastrar-item') }}">Cadastrar</a></li>
            </ul>
        </li>
        <li><a href="#">Gênero</a>
            <ul>
                <li><a href="{{ route('generos') }}">Todos</a></li>
                <li><a href="{{ route('cadastrar-genero') }}">Cadastrar</a></li>
            </ul>
        </li>
        <li><a href="#">Loja</a>
            <ul>
                <li><a href="{{ route('lojas') }}">Todas</a></li>
                <li><a href="{{ route('cadastrar-loja') }}">Cadastrar</a></li>
            </ul>
        </li>
        <li><a href="#">Conta</a>
            <ul>
                <li><a href="{{ route('saldo-da-conta') }}">Saldo</a></li>
                <li><a href="{{ route('editar-conta') }}">Editar</a></li>
                <li><a href="{{ route('cadastrar-conta') }}">Cadastrar</a></li>
            </ul>
        </li>
        <li><a href="#">Consulta</a>
            <ul>
                <li><a href="{{ route('cadastrar-gastos-com-item') }}">Gastos com Item</a></li>
            </ul>
        </li>
    </ul>
</nav>