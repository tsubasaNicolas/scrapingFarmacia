const cheerio = require('cheerio');
const request = require('request-promise');
const fs = require('fs-extra');
const writeStream = fs.createWriteStream('belleza.csv');

async function init(){
    writeStream.write(`Indice|Categoria|Marca|Descripcion|Precio\n`)// agregar categoría

   var pagina = 0;
   cadena1='https://salcobrand.cl/t/belleza?current_store_id=1&page=';
   cadena2= '&per_page=100&search%5Bprice_range_any%5D=0%2C+999999&search%5Bsort_price_dir%5D=&taxon_id=';
  
   //25 paginas
   while (pagina < 26) {// un if para identificar las paginas
   const $ = await request({
        uri: cadena1+pagina+cadena2 ,
        transform: body => cheerio.load(body)
    });
        $('.info').each((i, el) => {
        const marca = $(el).find('.product-name').text();
        const descripcion = $(el).find('.product-info').text();
        const precio = $(el).find('.price span').text();    
       
        writeStream.write(`${i}|belleza|${marca}|${descripcion}|${precio}\n`)
        // console.log(i, marca.html(), descripcion.html(), precio.html());  
    })  
    pagina++

    
}
    };


init();

