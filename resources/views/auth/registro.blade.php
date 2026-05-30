@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@section('content')

<style>
    body{
        font-family: Sora;
    }
    input, select{ 
        border: 2px solid #fa4101; 
        border-radius: 7px;
        width: 100%;
        padding: 8px 20px;
        padding-left: 8px;
    }
    input:focus, select:focus {
        border-color: #fa4101;
        box-shadow: 0 0 0 4px rgba(250, 65, 1, 0.15);
    }
    label{
        font-weight: 600;
        color: #000000;

    }

    .titulo{
        font-size: 25px;
        color: #ffffff;
        font-family: Sora;
        font-weight: 900;
        margin-bottom: -5px;
        margin-top: 40px;
        background: linear-gradient(90deg, #fa4101, #f97316);
        padding: 10px 20px;
        max-width: 100%;
        border-radius: 15px;
        margin: auto;

    }
    h6{

        color: #000000;
        font-family: Sora;
        font-weight: 900;
    }

</style>

<div class="d-flex justify-content-center align-items-center py-5" >
    <div class="card p-4" style="width: 100%; max-width: 740px; border-radius: 15px; margin-top:100px;">
        <div class="text-center mb-4">

            <p class=titulo>CRIE SUA CONTA</p>
            <p style="color:#000000; margin-top:10px">Preencha os campos abaixo para criar sua conta</p>
        </div>

        <form style="border-radius:150px;" action="{{ route('registro') }}" method="POST">
            @csrf

            <div class="row g-3">
                <hr><h6>DADOS PESSOAIS</h6>
                <div class="col-md-6">
                    <label>Nome completo</label>
                    <input type="text" name="nome"  placeholder="Seu nome" required>
                </div>

                <div class="col-md-6">
                    <label>E-mail</label>
                    <input type="email" name="email" placeholder="seu@email.com" required>
                </div>

                <div class="col-md-6">
                    <label>Telefone</label>
                    <input type="text" name="telefone"  placeholder="(00) 00000-0000">
                </div>

                <div class="col-md-6">
                    <label>Tipo de conta</label>
                    <select name="tipo"  required onchange="toggleTipo(this.value)">
                        <option value="">Selecione...</option>
                        <option value="cliente">Cliente</option>
                        <option value="prestador">Prestador de Serviço</option>
                    </select>
                </div>

               
                <div id="campos-prestador" class="col-12 d-none">
                    <hr><h6 class="fw-bold text-muted">Dados do Prestador</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>Tipo Pessoa</label>
                            <select name="tipo_pessoa" onchange="togglePessoa(this.value)">
                                <option value="">Selecione...</option>
                                <option value="fisico">Pessoa Física</option>
                                <option value="juridico">Pessoa Jurídica</option>
                            </select>
                        </div>

                        <div class="col-md-6" id="campo-cpf">
                            <label >CPF</label>
                            <input type="text" name="cpf_cnpj"  placeholder="000.000.000-00">
                        </div>

                        <div class="col-md-6 d-none" id="campo-cnpj">
                            <label >CNPJ</label>
                            <input type="text" name="cpf_cnpj"  placeholder="00.000.000/0000-00">
                        </div>

                        <div class="col-md-6 d-none" id="campo-razao">
                            <label >Razão Social</label>
                            <input type="text" name="razao_social"  placeholder="Razão Social">
                        </div>

                        <div class="col-md-6 d-none" id="campo-fantasia">
                            <label >Nome Fantasia</label>
                            <input type="text" name="nome_fantasia"  placeholder="Nome Fantasia">
                        </div>

                        <div class="col-md-12">
                            <label>Especialidade</label>
                            <input type="text" name="especialidade" placeholder="Ex: Eletricista, Pintor, Encanador...">
                        </div>
                    </div>
                </div>

                {{-- Endereço --}}
                <div class="col-12"><hr><h6 class="fw-bold text-muted">Endereço</h6></div>

                <div class="col-md-4">
                    <label >CEP</label>
                    <input type="text" name="cep"  placeholder="00000-000" onblur="buscaCep(this.value)">
                </div>
                <div class="col-md-8">
                    <label >Logradouro</label>
                    <input type="text" name="logradouro" id="logradouro"  placeholder="Rua, Avenida...">
                </div>
                <div class="col-md-2">
                    <label >Número</label>
                    <input type="text" name="numero"  placeholder="Nº">
                </div>

                <div class="col-md-4">
                    <label >Bairro</label>
                    <input type="text" name="bairro" id="bairro"  placeholder="Bairro">
                </div>
                <div class="col-md-4">
                    <label >Cidade</label>
                    <input type="text" name="cidade" id="cidade"  placeholder="Cidade">
                </div>
                <div class="col-md-2">
                    <label >UF</label>
                    <input type="text" name="estado" id="estado"  maxlength="2" placeholder="UF">
                </div>

                {{-- Senha --}}
                <div class="col-12"><hr><h6 class="fw-bold text-muted">Senha</h6></div>
                <div class="col-md-6">
                    <label >Senha</label>
                    <input type="password" name="password"  placeholder="Mínimo 6 caracteres" required>
                </div>
                <div class="col-md-6">
                    <label >Confirmar senha</label>
                    <input type="password" name="password_confirmation"  placeholder="Repita a senha" required>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" style="background-color: #000000; color:#fff; font-family: Sora; font-weight: 900; padding: 10px 20px; border-radius: 10px;" >
                    <i class="fa-solid fa-circle-user"></i> CADASTRAR
                </button>
            </div>
        </form>

        <hr>
        <p class="text-center text-muted mb-0">
            Já tem conta?
            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Entrar</a>
        </p>
    </div>
</div>
@endsection

@section('scripts')
<script>
function toggleTipo(tipo) {
    const campos = document.getElementById('campos-prestador');
    campos.classList.toggle('d-none', tipo !== 'prestador');
}

function togglePessoa(tipo) {
    document.getElementById('campo-cpf').classList.add('d-none');
    document.getElementById('campo-cnpj').classList.add('d-none');
    document.getElementById('campo-razao').classList.add('d-none');
    document.getElementById('campo-fantasia').classList.add('d-none');

    if (tipo === 'fisico') {
        document.getElementById('campo-cpf').classList.remove('d-none');
    } else if (tipo === 'juridico') {
        document.getElementById('campo-cnpj').classList.remove('d-none');
        document.getElementById('campo-razao').classList.remove('d-none');
        document.getElementById('campo-fantasia').classList.remove('d-none');
    }
}

async function buscaCep(cep) {
    cep = cep.replace(/\D/g, '');
    if (cep.length !== 8) return;
    try {
        const res = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const data = await res.json();
        if (!data.erro) {
            document.getElementById('logradouro').value = data.logradouro;
            document.getElementById('bairro').value = data.bairro;
            document.getElementById('cidade').value = data.localidade;
            document.getElementById('estado').value = data.uf;
        }
    } catch(e) {}
}
</script>
@endsection