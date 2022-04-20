var resultado = [];
resultado[0] = { name : 'endereco-valor', value : 'Posto Ipiranga (Rua Ceará), Parangaba, CE, Brazil'};
resultado[1] = { name : 'endereco', value : 'Posto Ipiranga (Rua Ceará), Parangaba, CE, Brazil'};
resultado[2] = { name : 'latlog', value : '-3.763507, -38.558475'};
resultado[3] = { name : 'metodo', value : '2'};
resultado[4] = { name : 'metodovalor', value : '800'};
resultado[5] = { name : 'padrao', value : '3'};
resultado[6] = { name : 'grupo', value : '2'};
resultado[7] = { name : 'tipo', value : '2'};
resultado[8] = { name : 'metros', value : '64'};
// Simple Addition Function in Javascript
function add(variavel) {
    var arrayOfStrings = variavel[2]['value'].split(',');
    variavel[2] = { name : 'lat', value : arrayOfStrings[0].trim()};
    variavel.push({ name : 'lon', value : arrayOfStrings[1].trim()});
    return variavel;
}

var test = JSON.stringify(add(resultado));

console.log(test);