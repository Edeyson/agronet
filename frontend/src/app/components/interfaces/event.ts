export interface Event
{
  producer_id?: string;
  addr_id: string;
  fecha: string;
  hora: string;
  duracion: number;
  title:string;
  desc:string;
  state?: string;
  created_at?: string;
}
