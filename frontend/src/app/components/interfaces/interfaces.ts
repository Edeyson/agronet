export interface countries {
    isoCode: string;
    name: string;
    phonecode: string;
    flag: string;
    currency: string;
    latitude: string;
    longitude: string;
    timezones: Timezone[];
  }
  
 export interface Timezone {
    zoneName: string;
    gmtOffset: number;
    gmtOffsetName: string;
    abbreviation: string;
    tzName: string;
  }

  export interface states {
    name: string;
    isoCode: string;
    countryCode: string;
    latitude: string;
    longitude: string;
  }

  export interface cities {
    name: string;
    countryCode: string;
    stateCode: string;
    latitude: string;
    longitude: string;
  }

  export interface UsuarioI {
    nombre?: string;
    apellido?: string;
    email?: string;    
    password?: string;
    nameToken?:string;
    departamento?: string;
    ciudad?: string;
    telefono?: string;
    // direccion?: string;
    // comentarios?: string;
  }

  export interface Product
  {
    type:string,
    id:number,
    attributes:{
      producer_id:number,
      category_id:number,
      image_path:string,
      name:string,
      description:string,
      measurement:number,
      price:number
    } 
  }

