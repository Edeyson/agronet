export interface Event
{
  producer_id: string;
  addr_id: string;
  fecha: string;
  hora: string;
  duracion: number;
  state?: string;
  created_at?: string;
}
