import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'filter'
})
export class FilterPipe implements PipeTransform {

  transform(value: any, arg: string): any {
    if(arg != ''){
      const resultProductos = [];
    for(let producto of value){
      if(producto.attributes.name.toLowerCase().indexOf(arg.toLowerCase()) > -1){
        resultProductos.push(producto);
        console.log("sip");
      }
    }
    return resultProductos;
    }else{
      return value;
    }
  }

}
