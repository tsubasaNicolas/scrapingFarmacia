const cheerio = require('cheerio');
const request = require('request-promise');
const fs = require('fs-extra');
const writeStream = fs.createWriteStream('mundo-mascotas.csv');

async function init(){
    writeStream.write(`Indice|Categoria|Marca|Descripcion|Precio\n`)
//una sola pagina
 
   const $ = await request({
        uri: 'https://salcobrand.cl/t/mundo-mascotas?utf8=%E2%9C%93&taxon_id=&per_page=100&search%5Bsort_price_dir%5D=&search%5Bprice_range_any%5D=1799%2C+26999',
        transform: body => cheerio.load(body)
    });
        $('.info').each((i, el) => {
        const marca = $(el).find('.product-name').text();
        const descripcion = $(el).find('.product-info').text();
        const precio = $(el).find('.price span').text();    
       
        writeStream.write(`${i}|mundomascotas|${marca}|${descripcion}|${precio}\n`)
        // console.log(i, marca.html(), descripcion.html(), precio.html());  
    })  


    
}
   


init();

