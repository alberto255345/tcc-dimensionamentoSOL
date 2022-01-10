<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0">
    <title>TCC - Alberto Vitoriano</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css"
        type="text/css" media="all" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

<div id="entra" class="card entrada">
    <p>Esse é um trabalho de TCC aprensentado pelo o Aluno Alberto Vitoriano - Estudante de Engenharia Elétrica da Universidade de Fortaleza</p>
</div>


    <div id="carouselExample" class="my-slider">


        <div stage="0">

            <div class="card miid shadow-lg"> Informe o endereço:
                <form id="form" style="display: grid;">
                    <input type="text" name="endereco-valor" id="campo-busca">
                    <input type="hidden" name="endereco" id="subject_name">
                    <input type="hidden" name="latlog" id="subject_code">
                </form>
            </div>

        </div>
        <div stage="1">

            <div class="card miid shadow-lg"> Metodo de dimensionamento:
                <form id="form" style="display: grid;">
                    <select id="select1" name="metodo">
                        <option disabled selected value=""></option>
                        <option value="1">Potência Instalada</option>
                        <option value="2">Consumo Mensal</option>
                    </select>
                </form>
            </div>

        </div>
        <div stage="2">

            <div class="card miid shadow-lg"> Informe o valor da <span id="saida1" style="display: contents;"></span>:
                <form id="form" style="display: grid;">
                    <input type="text" name="dim" id="campo-kwh">
                </form>
            </div>

        </div>
        <div stage="3">

            <div class="card miid shadow-lg"> Qual o padrão de fornecimento de energia:
                <form id="form" style="display: grid;">
                    <select id="select2" name="padrao">
                        <option disabled selected value=""></option>
                        <option value="1">Monofásico</option>
                        <option value="2">Bifásico</option>
                        <option value="3">Trifásico</option>
                    </select>
                </form>
            </div>

        </div>
        <div stage="4">

            <div class="card miid shadow-lg"> Qual o grupo de cliente:
                <form id="form" style="display: grid;">
                    <select id="select3" name="grupo">
                        <option disabled selected value=""></option>
                        <option value="1">Grupo A</option>
                        <option value="2">Grupo B</option>
                    </select>
                </form>
            </div>

        </div>
        <div stage="5">

            <div class="card miid shadow-lg"> Qual tipo de inversor:
                <form id="form" style="display: grid;">
                    <select id="select4" name="tipo">
                        <option disabled selected value=""></option>
                        <option value="1">Inversor com Strings</option>
                        <option value="2">Micro-Inversor</option>
                    </select>
                </form>
            </div>

        </div>
        <div stage="6">

            <div class="card miid shadow-lg"> Quantos metros quadrados tem o telhado<br> ou a area de instalação:
                <form id="form" style="display: grid;">
                    <input type="number" name="metros" id="metros-q">
                </form>
            </div>

        </div>
        <div stage="7">

            <div class="card miid shadow-lg"> 
            <button type="button" class="btn btn-primary" id="make-projet">Gerar Projeto Solar</button>
            </div>

        </div>

    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
    <script src="node_modules/jquery.redirect/jquery.redirect.js"></script>
    <script src="./js/index.js"></script>
</body>

</html>